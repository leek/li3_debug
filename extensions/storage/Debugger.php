<?php

namespace li3_debug\extensions\storage;

use lithium\core\Environment;
use lithium\core\Libraries;
use lithium\action\Controller;
use lithium\storage\Session;
use lithium\security\Auth;
use lithium\data\Connections;
use lithium\net\http\Media;
use lithium\template\View;

class Debugger extends \lithium\core\StaticObject
{
    /**
     * Class dependencies.
     *
     * @var array
     */
    protected static $_classes = array();

    /**
     * Configuration directives for writing, storing, and rendering flash messages.
     *
     * @var array
     */
    protected static $_config = array();

    protected static $_view;

    protected static $_data = array();

    public static function init()
    {
        static::$_data['start']        = microtime(true);
        static::$_data['memory.start'] = memory_get_usage(true);
        static::$_data['events']       = array();
        static::$_data['events.time']  = 0;

        static::push('events', array('name' => 'initialize', 'time' => 0));

        static::initMedia();
        static::initConnections();
    }

    public static function terminate()
    {
        static::initSession();
        static::initAuth();

        static::$_data['end']          = microtime(true);
        static::$_data['environment']  = Environment::get();
        static::$_data['events.count'] = count(static::$_data['events']);
        static::$_data['db.count']     = count(static::$_data['db']);
        static::$_data['runtime']      = static::$_data['end'] - static::$_data['start'];
        static::$_data['memory.end']   = memory_get_usage(true);
        static::$_data['memory.usage'] = memory_get_peak_usage(true);

        if (static::$_view) {
            try {
                echo static::$_view->render(array('element' => 'debug_bar'));
            } catch (\lithium\template\TemplateException $e) {
                $view = new View(array('paths' => array('element' => '{:library}/views/elements/{:template}.{:type}.php')));
                echo $view->render(array('element' => 'debug_bar'), array(), array('library' => 'li3_debug'));
            }
        }
    }

    public static function initMedia()
    {
        Media::applyFilter('_handle', function ($self, $params, $chain) {
            Debugger::setResponse($params['response']);
            if ($params['handler']['type'] === 'html') {
                Debugger::setView($self, $params['handler'], $params['response']);
            }
            return $chain->next($self, $params, $chain);
        });
    }

    public static function initConnections()
    {
        static::$_data['db']         = array();
        static::$_data['db.time']    = 0;
        static::$_data['db.invalid'] = 0;

        Connections::applyFilter('_initAdapter', function ($self, $params, $chain) {
            $adapter = $chain->next($self, $params, $chain);
            $adapter->applyFilter(array('read', 'create', 'update', 'delete'), function($self, $params, $chain) {
                $options = $params['options'];
                $query   = $params['query'];
                $data            = array();
                $data['start']   = microtime(true);
                $data['memory']  = memory_get_usage(true);
                $data['name']    = '[DB] ' . $options['model'] . '->' . $options['type'];
                if ($result = $chain->next($self, $params, $chain)) {
                    $data['name'] .= ' (' . count($result) . ')';
                } else {
                    Debugger::inc('db.invalid', 1);
                }
                $data['end']     = microtime(true);
                $data['memory']  = memory_get_usage(true) - $data['memory'];
                $data['time']    = $data['end'] - $data['start'];
                Debugger::push('events', $data);
                Debugger::inc('events.time', $data['time']);
                Debugger::push('db', $data);
                Debugger::inc('db.time', $data['time']);
                return $result;
            });
            return $adapter;
        });
    }

    public static function initSession()
    {
        static::$_data['session.started'] = Session::isStarted();
    }

    public static function initAuth()
    {
        static::$_data['auth']    = false;
        static::$_data['auth.id'] = 'anon';

        foreach (Auth::config() as $name => $config) {
            if ($result = Auth::check($name)) {
                static::$_data['auth']      = true;
                static::$_data['auth.id']   = isset($result['email']) ? $result['email'] : $result['_id'];
                static::$_data['auth.data'] = $result;
            }
        }
    }

    public static function setView($class, $handler, $response)
    {
        static::$_view = $class::view($handler, array(), $response);
    }

    public static function setRequest($request)
    {
        static::$_data['url']        = $request->url;
        static::$_data['controller'] = $request->params['controller'];
        static::$_data['action']     = $request->params['action'];
        static::$_data['args']       = isset($request->params['args']) ? $request->params['args'] : array();
        static::$_data['library']    = isset($request->params['library']) ? $request->params['library'] : 'app';
    }

    public static function setResponse($response)
    {
        static::$_data['status.code']    = $response->status['code'];
        static::$_data['status.message'] = $response->status['message'];
    }

    public static function get($key)
    {
        return static::$_data[$key];
    }

    public static function set($key, $value)
    {
        static::$_data[$key] = $value;
    }

    public static function push($key, $value)
    {
        static::$_data[$key][] = $value;
    }

    public static function inc($key, $value)
    {
        static::$_data[$key] += $value;
    }

    /**
     * Binds the messaging system to a controller to enable `'message'` option flags in various
     * controller methods, such as `render()` and `redirect()`.
     *
     * @param object $controller An instance of `lithium\action\Controller`.
     * @param array $options Options.
     * @return object Returns the passed `$controller` instance.
     */
    public static function bindTo(Controller $controller, array $options = array())
    {
        $controller->applyFilter('__invoke', function($self, $params, $chain) {
            $data            = array();
            $data['start']   = microtime(true);
            $data['memory']  = memory_get_usage(true);
            $data['name']    = Debugger::get('controller') . ':' . Debugger::get('action') . '->__invoke()';
            $result          = $chain->next($self, $params, $chain);
            $data['end']     = microtime(true);
            $data['memory']  = memory_get_usage(true) - $data['memory'];
            $data['time']    = $data['end'] - $data['start'];
            Debugger::push('events', $data);
            Debugger::inc('events.time', $data['time']);
            return $result;
        });

        // $controller->applyFilter('redirect', function($self, $params, $chain) use ($options) {
            // $options =& $params['options'];
        //     if (isset($params['options']['message'])) {
        //         DebugBar::write($params['options']['message']);
        //         unset($params['options']['message']);
        //     }
        //     return $chain->next($self, $params, $chain);
        // });

        return $controller;
    }
}

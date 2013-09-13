<?php

namespace li3_debug\extensions\helper;

use lithium\template\TemplateException;
use li3_debug\extensions\storage\Debugger;

/**
 * Helper to output debug bar.
 *
 * @see li3_debug\extensions\storage\Debugger
 */
class DebugBar extends \lithium\template\Helper
{
    /**
     * A string identifier for a known IDE/text editor, or a closure
     * that resolves a string that can be used to open a given file
     * in an editor. If the string contains the special substrings
     * %file or %line, they will be replaced with the correct data.
     *
     * @example
     *  "txmt://open?url=%file&line=%line"
     * @var mixed $editor
     */
    protected $editor = 'sublime';

    /**
     * A list of known editor strings
     * @var array
     */
    protected $editors = array(
        'sublime'  => 'subl://open?url=file://%file&line=%line',
        'textmate' => 'txmt://open?url=file://%file&line=%line',
        'emacs'    => 'emacs://open?url=file://%file&line=%line',
        'macvim'   => 'mvim://open/?url=file://%file&line=%line'
    );

    /**
     * Sets up defaults and passes to parent to setup class.
     *
     * @param  array $config Configuration options.
     * @return void
     */
    public function __construct(array $config = array())
    {
        parent::__construct($config);

        if (extension_loaded('xdebug')) {
            // Register editor using xdebug's file_link_format option.
            $this->editors['xdebug'] = function($file, $line) {
                return str_replace(array('%f', '%l'), array($file, $line), ini_get('xdebug.file_link_format'));
            };
        }
    }

    /**
     * Adds an editor resolver, identified by a string
     * name, and that may be a string path, or a callable
     * resolver. If the callable returns a string, it will
     * be set as the file reference's href attribute.
     *
     * @example
     *  $run->addEditor('macvim', "mvim://open?url=file://%file&line=%line")
     * @example
     *   $run->addEditor('remove-it', function($file, $line) {
     *       unlink($file);
     *       return "http://stackoverflow.com";
     *   });
     * @param  string $identifier
     * @param  string $resolver
     */
    public function addEditor($identifier, $resolver)
    {
        $this->editors[$identifier] = $resolver;
    }

    /**
     * Set the editor to use to open referenced files, by a string
     * identifier, or a callable that will be executed for every
     * file reference, with a $file and $line argument, and should
     * return a string.
     *
     * @example
     *   $run->setEditor(function($file, $line) { return "file:///{$file}"; });
     * @example
     *   $run->setEditor('sublime');
     *
     * @throws InvalidArgumentException If invalid argument identifier provided
     * @param string|callable $editor
     */
    public function setEditor($editor)
    {
        if (!is_callable($editor) && !isset($this->editors[$editor])) {
            throw new InvalidArgumentException(
                "Unknown editor identifier: $editor. Known editors:" .
                implode(",", array_keys($this->editors))
            );
        }

        $this->editor = $editor;
    }

    /**
     * Given a string file path, and an integer file line,
     * executes the editor resolver and returns, if available,
     * a string that may be used as the href property for that
     * file reference.
     *
     * @throws InvalidArgumentException If editor resolver does not return a string
     * @param  string $filePath
     * @param  int    $line
     * @return string|bool
     */
    public function getEditorHref($filePath, $line)
    {
        if ($this->editor === null) {
            return false;
        }

        $editor = $this->editor;
        if (is_string($editor)) {
            $editor = $this->editors[$editor];
        }

        if (is_callable($editor)) {
            $editor = call_user_func($editor, $filePath, $line);
        }

        // Check that the editor is a string, and replace the
        // %line and %file placeholders:
        if (!is_string($editor)) {
            throw new \InvalidArgumentException(
                __METHOD__ . " should always resolve to a string; got something else instead"
            );
        }

        $editor = str_replace("%line", rawurlencode($line), $editor);
        $editor = str_replace("%file", rawurlencode($filePath), $editor);

        return $editor;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return Debugger::get($key);
    }

    /**
     * Outputs a debug bar using a template. The message will be cleared afterwards.
     * With defaults settings it looks for the template
     * `app/views/elements/debug_bar.html.php`. If it doesn't exist, the  plugin's view
     * at `li3_debug/views/elements/debug_bar.html.php` will be used. Use this
     * file as a starting point for your own debug bar element. In order to use a
     * different template, adjust `$options['type']` and `$options['template']` to your needs.
     *
     * @param array [$options] Optional options.
     *              - type: Template type that will be rendered.
     *              - template: Name of the template that will be rendered.
     *              - data: Additional data for the template.
     *              - options: Additional options that will be passed to the renderer.
     * @return string Returns the rendered template.
     */
    public function show(array $options = array()) {
        $defaults = array(
            'type'     => 'element',
            'template' => 'debug_bar',
            'data'     => array(),
            'options'  => array(),
        );

        $options += $defaults;
        $view     = $this->_context->view();
        $type     = array($options['type'] => $options['template']);

        try {
            return $view->render($type, $options['data'], $options['options']);
        } catch (TemplateException $e) {
            return $view->render($type, $options['data'], array('library' => 'li3_debug'));
        }
    }
}

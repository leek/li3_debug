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
     * Holds the instance of the debug bar storage class
     *
     * @see \li3_debug\extensions\storage\DebugBar
     */
    protected $_classes = array(
        'storage' => 'li3_debug\extensions\storage\Debugger'
    );

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

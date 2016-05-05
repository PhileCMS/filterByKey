<?php

namespace Phile\Plugin\Phile\FilterByKey;

use Phile\Plugin\AbstractPlugin;

use Twig_SimpleFunction as TwigFunction;

/**
 * Class Plugin
 * A Twig function that filters a Page by specific meta keys
 *
 * @author  PhileCMS
 * @link    https://philecms.com
 * @license http://opensource.org/licenses/MIT
 * @package Phile\Plugin\Phile\FilterByKey
 */
class Plugin extends AbstractPlugin
{

    protected $events = ['template_engine_registered' => 'templateEngineRegistered'];

    /**
     * templateEngineRegistered method
     *
     * @param array $vars
     * @param null  $noop
     *
     * @return mixed|void
     */
    public function templateEngineRegistered($vars, $noop = null)
    {
        $filter_by_key = new TwigFunction('filter_by_key', function ($array, $key) {
            return array_filter($array->toArray(), function ($item) use ($key) {
                return isset($item->getMeta()[$key]);
            });
        });
        $vars['engine']->addFunction($filter_by_key);
    }
}

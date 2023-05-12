<?php
/**
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;

/**
 * Web Services adapter for example.
 *
 * @since  1.0.0
 */
class PlgWebservicesExample extends CMSPlugin
{
    public function onBeforeApiRoute(&$router)
    {
        $router->createCRUDRoutes('v1/example/items', 'items', ['component' => 'com_example']);
        $router->createCRUDRoutes('v1/example/categories', 'categories', ['component' => 'com_example']);
    }
}

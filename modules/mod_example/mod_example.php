<?php

/**
 * @version     CVS: 1.0.0
 * @package     com_example
 * @subpackage  mod_example
 * @author      Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright   2023 Lukeedzo
 * @license
 */
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$wr = $wa->getRegistry();
$wr->addRegistryFile('media/mod_example/joomla.asset.json');
$wa->useStyle('mod_example.style')
    ->useScript('mod_example.script');

require ModuleHelper::getLayoutPath('mod_example', $params->get('content_type', 'blank'));

<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Example\Component\Example\Administrator\Service\Html\EXAMPLE;
use Joomla\CMS\Association\AssociationServiceTrait;
use Joomla\CMS\Categories\CategoryServiceInterface;
use Joomla\CMS\Categories\CategoryServiceTrait;
use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Joomla\CMS\Tag\TagServiceTrait;
use Psr\Container\ContainerInterface;

/**
 * Component class for Example
 *
 * @since  1.0.0
 */
class ExampleComponent extends MVCComponent implements RouterServiceInterface, BootableExtensionInterface, CategoryServiceInterface
{
    use AssociationServiceTrait;
    use RouterServiceTrait;
    use HTMLRegistryAwareTrait;
    use CategoryServiceTrait, TagServiceTrait {
        CategoryServiceTrait::getTableNameForSection insteadof TagServiceTrait;
        CategoryServiceTrait::getStateColumnForSection insteadof TagServiceTrait;
    }

    /** @inheritdoc  */
    function boot(ContainerInterface $container)
    {
        $db = $container->get('DatabaseDriver');
        $this->getRegistry()->register('example', new EXAMPLE($db));
    }

    /**
     * Returns the table for the count items functions for the given section.
     *
     * @param   string    The section
     *
     * * @return  string|null
     *
     * @since   4.0.0
     */
    function getTableNameForSection(string $section = null)
    {
    }
}

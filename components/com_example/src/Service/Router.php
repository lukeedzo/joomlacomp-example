<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Site\Service;

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Categories\Categories;
use Joomla\CMS\Categories\CategoryFactoryInterface;
use Joomla\CMS\Categories\CategoryInterface;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Factory;
use Joomla\CMS\Menu\AbstractMenu;
use Joomla\Database\DatabaseInterface;

/**
 * Class ExampleRouter
 *
 */
class Router extends RouterView
{
    private $noIDs;
    /**
     * The category factory
     *
     * @var    CategoryFactoryInterface
     *
     * @since  1.0.0
     */
    private $categoryFactory;

    /**
     * The category cache
     *
     * @var    array
     *
     * @since  1.0.0
     */
    private $categoryCache = [];

    public function __construct(SiteApplication $app, AbstractMenu $menu, CategoryFactoryInterface $categoryFactory, DatabaseInterface $db)
    {
        $params = Factory::getApplication()->getParams('com_example');
        $this->noIDs = (bool) $params->get('sef_ids');
        $this->categoryFactory = $categoryFactory;

        $items = new RouterViewConfiguration('exampleitems');
        $this->registerView($items);
        $ccItem = new RouterViewConfiguration('exampleitem');
        $ccItem->setKey('id')->setParent($items);
        $this->registerView($ccItem);
        $itemform = new RouterViewConfiguration('exampleitemform');
        $itemform->setKey('id');
        $this->registerView($itemform);

        parent::__construct($app, $menu);

        $this->attachRule(new MenuRules($this));
        $this->attachRule(new StandardRules($this));
        $this->attachRule(new NomenuRules($this));
    }

    /**
     * Method to get the segment(s) for an exampleitem
     *
     * @param   string  $id     ID of the exampleitem to retrieve the segments for
     * @param   array   $query  The request that is built right now
     *
     * @return  array|string  The segments of this item
     */
    public function getExampleitemSegment($id, $query)
    {
        return array((int) $id => $id);
    }
    /**
     * Method to get the segment(s) for an exampleitemform
     *
     * @param   string  $id     ID of the exampleitemform to retrieve the segments for
     * @param   array   $query  The request that is built right now
     *
     * @return  array|string  The segments of this item
     */
    public function getExampleitemformSegment($id, $query)
    {
        return $this->getExampleitemSegment($id, $query);
    }

    /**
     * Method to get the segment(s) for an exampleitem
     *
     * @param   string  $segment  Segment of the exampleitem to retrieve the ID for
     * @param   array   $query    The request that is parsed right now
     *
     * @return  mixed   The id of this item or false
     */
    public function getExampleitemId($segment, $query)
    {
        return (int) $segment;
    }
    /**
     * Method to get the segment(s) for an exampleitemform
     *
     * @param   string  $segment  Segment of the exampleitemform to retrieve the ID for
     * @param   array   $query    The request that is parsed right now
     *
     * @return  mixed   The id of this item or false
     */
    public function getExampleitemformId($segment, $query)
    {
        return $this->getExampleitemId($segment, $query);
    }

    /**
     * Method to get categories from cache
     *
     * @param   array  $options   The options for retrieving categories
     *
     * @return  CategoryInterface  The object containing categories
     *
     * @since   1.0.0
     */
    private function getCategories(array $options = []): CategoryInterface
    {
        $key = serialize($options);

        if (!isset($this->categoryCache[$key])) {
            $this->categoryCache[$key] = $this->categoryFactory->createCategory($options);
        }

        return $this->categoryCache[$key];
    }
}

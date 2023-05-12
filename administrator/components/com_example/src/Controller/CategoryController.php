<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Administrator\Controller;

\defined ('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Category controller class.
 *
 * @since  1.0.0
 */
class CategoryController extends FormController
{
    protected $view_list = 'categories';
}

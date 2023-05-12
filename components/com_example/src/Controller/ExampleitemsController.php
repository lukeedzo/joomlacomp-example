<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Site\Controller;

\defined ('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\FormController;

/**
 * Items class.
 *
 * @since  1.0.0
 */
class ExampleitemsController extends FormController
{
    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional
     * @param   array   $config  Configuration array for model. Optional
     *
     * @return  object    The model
     *
     * @since   1.0.0
     */
    public function getModel($name = 'Exampleitems', $prefix = 'Site', $config = array())
    {
        return parent::getModel($name, $prefix, array('ignore_request' => true));
    }
}

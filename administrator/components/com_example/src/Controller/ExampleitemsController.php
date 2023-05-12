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

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\Utilities\ArrayHelper;

/**
 * Items list controller class.
 *
 * @since  1.0.0
 */
class ExampleitemsController extends AdminController
{
    /**
     * Method to clone existing Items
     *
     * @return  void
     *
     * @throws  Exception
     */
    public function duplicate()
    {
        // Check for request forgeries
        $this->checkToken();

        // Get id(s)
        $pks = $this->input->post->get('cid', array(), 'array');

        try
        {
            if (empty($pks)) {
                throw new \Exception (Text::_('COM_EXAMPLE_NO_ELEMENT_SELECTED'));
            }

            ArrayHelper::toInteger($pks);
            $model = $this->getModel();
            $model->duplicate($pks);
            $this->setMessage(Text::_('COM_EXAMPLE_ITEMS_SUCCESS_DUPLICATED'));
        } catch (\Exception $e) {
            Factory::getApplication()->enqueueMessage($e->getMessage(), 'warning');
        }

        $this->setRedirect('index.php?option=com_example&view=exampleitems');
    }

    /**
     * Proxy for getModel.
     *
     * @param   string  $name    Optional. Model name
     * @param   string  $prefix  Optional. Class prefix
     * @param   array   $config  Optional. Configuration array for model
     *
     * @return  object    The Model
     *
     * @since   1.0.0
     */
    public function getModel($name = 'Exampleitem', $prefix = 'Administrator', $config = array())
    {
        return parent::getModel($name, $prefix, array('ignore_request' => true));
    }

    /**
     * Method to save the submitted ordering values for records via AJAX.
     *
     * @return  void
     *
     * @since   1.0.0
     *
     * @throws  Exception
     */
    public function saveOrderAjax()
    {
        // Get the input
        $pks = $this->input->post->get('cid', array(), 'array');
        $order = $this->input->post->get('order', array(), 'array');

        // Sanitize the input
        ArrayHelper::toInteger($pks);
        ArrayHelper::toInteger($order);

        // Get the model
        $model = $this->getModel();

        // Save the ordering
        $return = $model->saveorder($pks, $order);

        if ($return) {
            echo "1";
        }

        // Close the application
        Factory::getApplication()->close();
    }
}

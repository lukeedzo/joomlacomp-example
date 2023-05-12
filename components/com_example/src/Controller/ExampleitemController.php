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

use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\MVC\Controller\BaseController;
use \Joomla\CMS\Router\Route;

/**
 * Item class.
 *
 * @since  1.6.0
 */
class ExampleitemController extends BaseController
{
    /**
     * Method to check out an item for editing and redirect to the edit form.
     *
     * @return  void
     *
     * @since   1.0.0
     *
     * @throws  Exception
     */
    public function edit()
    {
        // Get the previous edit id (if any) and the current edit id.
        $previousId = (int) $this->app->getUserState('com_example.edit.exampleitem.id');
        $editId = $this->input->getInt('id', 0);

        // Set the user id for the user to edit in the session.
        $this->app->setUserState('com_example.edit.item.id', $editId);

        // Get the model.
        $model = $this->getModel('Exampleitem', 'Site');

        // Check out the item
        if ($editId) {
            $model->checkout($editId);
        }

        // Check in the previous user.
        if ($previousId && $previousId !== $editId) {
            $model->checkin($previousId);
        }

        // Redirect to the edit screen.
        $this->setRedirect(Route::_('index.php?option=com_example&view=exampleitemform&layout=edit', false));
    }

    /**
     * Method to save data
     *
     * @return    void
     *
     * @throws  Exception
     * @since   1.0.0
     */
    public function publish()
    {
        // Checking if the user can remove object
        $user = $this->app->getIdentity();

        if ($user->authorise('core.edit', 'com_example') || $user->authorise('core.edit.state', 'com_example')) {
            $model = $this->getModel('Exampleitem', 'Site');

            // Get the user data.
            $id = $this->input->getInt('id');
            $state = $this->input->getInt('state');

            // Attempt to save the data.
            $return = $model->publish($id, $state);

            // Check for errors.
            if ($return === false) {
                $this->setMessage(Text::sprintf('Save failed: %s', $model->getError()), 'warning');
            }

            // Clear the profile id from the session.
            $this->app->setUserState('com_example.edit.exampleitem.id', null);

            // Flush the data from the session.
            $this->app->setUserState('com_example.edit.exampleitem.data', null);

            // Redirect to the list screen.
            $this->setMessage(Text::_('COM_EXAMPLE_ITEM_SAVED_SUCCESSFULLY'));
            $menu = Factory::getApplication()->getMenu();
            $item = $menu->getActive();

            if (!$item) {
                // If there isn't any menu item active, redirect to list view
                $this->setRedirect(Route::_('index.php?option=com_example&view=exampleitems', false));
            } else {
                $this->setRedirect(Route::_('index.php?Itemid=' . $item->id, false));
            }
        } else {
            throw new \Exception (500);
        }
    }

    /**
     * Check in record
     *
     * @return  boolean  True on success
     *
     * @since   1.0.0
     */
    public function checkin()
    {
        // Check for request forgeries.
        $this->checkToken('GET');

        $id = $this->input->getInt('id', 0);
        $model = $this->getModel();
        $item = $model->getItem($id);

        // Checking if the user can remove object
        $user = $this->app->getIdentity();

        if ($user->authorise('core.manage', 'com_example') || $item->checked_out == $user->id) {

            $return = $model->checkin($id);

            if ($return === false) {
                // Checkin failed.
                $message = Text::sprintf('JLIB_APPLICATION_ERROR_CHECKIN_FAILED', $model->getError());
                $this->setRedirect(Route::_('index.php?option=com_example&view=exampleitem' . '&id=' . $id, false), $message, 'error');
                return false;
            } else {
                // Checkin succeeded.
                $message = Text::_('COM_EXAMPLE_CHECKEDIN_SUCCESSFULLY');
                $this->setRedirect(Route::_('index.php?option=com_example&view=exampleitem' . '&id=' . $id, false), $message);
                return true;
            }
        } else {
            throw new \Exception (Text::_('JERROR_ALERTNOAUTHOR'), 403);
        }
    }

    /**
     * Remove data
     *
     * @return void
     *
     * @throws Exception
     */
    public function remove()
    {
        // Checking if the user can remove object
        $user = $this->app->getIdentity();

        if ($user->authorise('core.delete', 'com_example')) {
            $model = $this->getModel('Exampleitem', 'Site');

            // Get the user data.
            $id = $this->input->getInt('id', 0);

            // Attempt to save the data.
            $return = $model->delete($id);

            // Check for errors.
            if ($return === false) {
                $this->setMessage(Text::sprintf('Delete failed', $model->getError()), 'warning');
            } else {
                // Check in the profile.
                if ($return) {
                    $model->checkin($return);
                }

                $this->app->setUserState('com_example.edit.exampleitem.id', null);
                $this->app->setUserState('com_example.edit.exampleitem.data', null);

                $this->app->enqueueMessage(Text::_('COM_EXAMPLE_ITEM_DELETED_SUCCESSFULLY'), 'success');
                $this->app->redirect(Route::_('index.php?option=com_example&view=exampleitems', false));
            }

            // Redirect to the list screen.
            $menu = Factory::getApplication()->getMenu();
            $item = $menu->getActive();
            $this->setRedirect(Route::_($item->link, false));
        } else {
            throw new \Exception (500);
        }
    }
}

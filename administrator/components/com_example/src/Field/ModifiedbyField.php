<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Administrator\Field;

defined('JPATH_BASE') or die;

use \Joomla\CMS\Factory;

/**
 * Supports an HTML select list of categories
 *
 * @since  1.0.0
 */
class ModifiedbyField extends \Joomla\CMS\Form\FormField

{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $type = 'modifiedby';

    /**
     * Method to get the field input markup.
     *
     * @return  string    The field input markup.
     *
     * @since   1.0.0
     */
    protected function getInput()
    {
        // Initialize variables.
        $html = array();
        $user = Factory::getApplication()->getIdentity();
        $html[] = '<input type="hidden" name="' . $this->name . '" value="' . $user->id . '" />';
        if (!$this->hidden) {
            $html[] = "<div>" . $user->name . " (" . $user->username . ")</div>";
        }

        return implode($html);
    }
}

<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Site\Field;

defined('JPATH_BASE') or die;

use \Joomla\CMS\Date\Date;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Form\FormField;
use \Joomla\CMS\Language\Text;

/**
 * Supports an HTML select list of categories
 *
 * @since  1.0.0
 */
class TimeupdatedField extends FormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  1.0.0
     */
    protected $type = 'timeupdated';

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

        $old_time_updated = $this->value;
        $hidden = (boolean) $this->element['hidden'];

        if ($hidden == null || !$hidden) {
            if (!strtotime($old_time_updated)) {
                $html[] = '-';
            } else {
                $jdate = new Date($old_time_updated);
                $pretty_date = $jdate->format(Text::_('DATE_FORMAT_LC2'));
                $html[] = "<div>" . $pretty_date . "</div>";
            }
        }

        $time_updated = Factory::getDate()->toSql();
        $html[] = '<input type="hidden" name="' . $this->name . '" value="' . $time_updated . '" />';

        return implode($html);
    }
}

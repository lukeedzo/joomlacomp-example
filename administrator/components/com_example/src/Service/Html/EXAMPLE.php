<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

namespace Example\Component\Example\Administrator\Service\Html;

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Model\DatabaseAwareTrait;
use Joomla\Database\DatabaseDriver;
use Joomla\Utilities\ArrayHelper;

/**
 * Example HTML Helper.
 *
 * @since  1.0.0
 */
class EXAMPLE
{
    use DatabaseAwareTrait;

    /**
     * Public constructor.
     *
     * @param   DatabaseDriver  $db  The Joomla DB driver object for the site's database.
     */
    public function __construct(DatabaseDriver $db)
    {
        $this->setDbo($db);
    }

    public function toggle($value = 0, $view = '', $field = '', $i = '')
    {
        $states = array(
            0 => array('icon-unpublish', Text::_('Toggle'), ''),
            1 => array('icon-publish', Text::_('Toggle'), ''),
        );

        $state = ArrayHelper::getValue($states, (int) $value, $states[0]);
        $text = '<span aria-hidden="true" class="' . $state[0] . '"></span>';
        $html = '<a href="javascript:void(0);" class="tbody-icon ' . $state[2] . '"';
        $html .= 'onclick="return Joomla.toggleField(\'cb' . $i . '\',\'' . $view . '.toggle\',\'' . $field . '\')" title="' . Text::_($state[1]) . '">' . $text . '</a>';

        return $html;
    }
}

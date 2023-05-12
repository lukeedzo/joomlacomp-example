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

use Example\Module\Example\Site\Helper\ExampleHelper;

$elements = ExampleHelper::getList($params);

$tableField = explode(':', $params->get('field'));
$table_name = !empty($tableField[0]) ? $tableField[0] : '';
$field_name = !empty($tableField[1]) ? $tableField[1] : '';
?>

<?php if (!empty($elements)): ?>
	<table class="jcc-table">
		<?php foreach ($elements as $element): ?>
			<tr>
				<th><?php echo ExampleHelper::renderTranslatableHeader($table_name, $field_name); ?></th>
				<td><?php echo ExampleHelper::renderElement(
    $table_name, $params->get('field'), $element->{$field_name}
); ?></td>
			</tr>
		<?php endforeach;?>
	</table>
<?php endif;

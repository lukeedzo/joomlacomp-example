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

$element = ExampleHelper::getItem($params);
?>

<?php if (!empty($element)): ?>
	<div>
		<?php $fields = get_object_vars($element);?>
		<?php foreach ($fields as $field_name => $field_value): ?>
			<?php if (ExampleHelper::shouldAppear($field_name)): ?>
				<div class="row">
					<div class="span4">
						<strong><?php echo ExampleHelper::renderTranslatableHeader($params->get('item_table'), $field_name); ?></strong>
					</div>
					<div
						class="span8"><?php echo ExampleHelper::renderElement($params->get('item_table'), $field_name, $field_value); ?></div>
				</div>
			<?php endif;?>
		<?php endforeach;?>
	</div>
<?php endif;

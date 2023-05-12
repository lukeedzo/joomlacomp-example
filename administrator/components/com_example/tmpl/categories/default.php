<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Example
 * @author     Lukeedzo <lukasplycneris@protonmail.com>
 * @copyright  2023 Lukeedzo
 * @license
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Session\Session;
use \Joomla\CMS\Factory;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Layout\LayoutHelper;
use \Joomla\CMS\Router\Route;

HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.multiselect');

// Import CSS
$wa = $this->document->getWebAssetManager();
$wa->useStyle('com_example.admin')
    ->useScript('com_example.admin');

$user = Factory::getApplication()->getIdentity();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canOrder = $user->authorise('core.edit.state', 'com_example');

$saveOrder = $listOrder == 'a.ordering';

if (!empty($saveOrder)) {
    $saveOrderingUrl = 'index.php?option=com_example&task=categories.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
    HTMLHelper::_('draggablelist.draggable');
}?>

<form action="<?php echo Route::_('index.php?option=com_example&view=categories'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
				<?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
				<div class="clearfix"></div>
				<table class="table table-striped" id="categoryList">
					<thead>
						<tr>
							<th scope="col" class="w-1">
								<?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
							</th>
							<th scope="col" class="w-1">
								<?php echo HTMLHelper::_('searchtools.sort', 'COM_EXAMPLE_CATEGORIES_NAME', 'a.state', $listDirn, $listOrder); ?>
							</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>
					<tbody <?php if (!empty($saveOrder)): ?> class="js-draggable" data-url="<?php echo $saveOrderingUrl; ?>" data-direction="<?php echo strtolower($listDirn); ?>" <?php endif;?>>
						<?php foreach ($this->items as $i => $item):
						$ordering = ($listOrder == 'a.ordering');
						$canCreate = $user->authorise('core.create', 'com_example');
						$canEdit = $user->authorise('core.edit', 'com_example');
						$canCheckin = $user->authorise('core.manage', 'com_example');
						$canChange = $user->authorise('core.edit.state', 'com_example');?>
						<tr class="row<?php echo $i % 2; ?>" data-draggable-group='1' data-transition>
						<td class="">
							<?php echo HTMLHelper::_('jgrid.published', $item->state, $i, 'categories.', $canChange, 'cb'); ?>
						</td>
						<td class="">
							<?php if (isset($item->checked_out) && $item->checked_out && ($canEdit || $canChange)): ?>
								<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'items.', $canCheckin); ?>
							<?php endif;?>
							<?php if ($canEdit): ?>
							<a href="<?php echo Route::_('index.php?option=com_example&task=category.edit&id=' . (int) $item->id); ?>">
								<?php echo $this->escape($item->name); ?>
							</a>
							<?php else: ?>
							<?php echo $this->escape($item->name); ?>
							<?php endif;?>
							</td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
				<input type="hidden" name="task" value="" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="list[fullorder]" value="<?php echo $listOrder; ?> <?php echo $listDirn; ?>" />
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>
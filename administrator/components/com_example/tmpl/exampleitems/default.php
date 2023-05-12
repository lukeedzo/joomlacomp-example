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

if (!empty($saveOrder)) {
    $saveOrderingUrl = 'index.php?option=com_example&task=exampleitems.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
    HTMLHelper::_('draggablelist.draggable');
} ?>

<form action="<?php echo Route::_('index.php?option=com_example&view=exampleitems'); ?>" method="post" name="adminForm" id="adminForm">
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
				<?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
				<div class="clearfix"></div>
				<table class="table table-striped" id="itemList">
					<thead>
						<tr>
							<th class="w-1 text-center">
								<input type="checkbox" autocomplete="off" class="form-check-input" name="checkall-toggle" value="" title="<?php echo Text::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
							</th>
							<th class='left'>
								<?php echo HTMLHelper::_('searchtools.sort', 'COM_EXAMPLE_ITEMS_TITLE', 'a.title', $listDirn, $listOrder); ?>
							</th>
							<th class='left'>
								<?php echo HTMLHelper::_('searchtools.sort', 'COM_EXAMPLE_ITEMS_DESCRIPTION', 'a.description', $listDirn, $listOrder); ?>
							</th>
							<th class='left'>
								<?php echo HTMLHelper::_('searchtools.sort', 'COM_EXAMPLE_ITEMS_CATEGORY', 'a.category', $listDirn, $listOrder); ?>
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
					$canChange = $user->authorise('core.edit.state', 'com_example'); ?>
					<tr class="row<?php echo $i % 2; ?>" data-draggable-group='1' data-transition>
					<td class="text-center">
						<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
					</td>
					<td>
						<?php if (isset($item->checked_out) && $item->checked_out && ($canEdit || $canChange)): ?>
							<?php echo HTMLHelper::_('jgrid.checkedout', $i, $item->uEditor, $item->checked_out_time, 'items.', $canCheckin); ?>
							<?php endif;?>
							<?php if ($canEdit): ?>
							<a href="<?php echo Route::_('index.php?option=com_example&task=exampleitem.edit&id=' . (int) $item->id); ?>">
								<?php echo $this->escape($item->title); ?>
							</a>
							<?php else: ?>
								<?php echo $this->escape($item->title); ?>
								<?php endif;?>
							</td>
							<td>
								<?php echo $item->description; ?>
							</td>
							<td>
								<?php echo $item->category; ?>
							</td>
						</tr>
					<?php endforeach;?>
					</tbody>
				</table>
				<input type="hidden" name="task" value=""/>
				<input type="hidden" name="boxchecked" value="0"/>
				<input type="hidden" name="list[fullorder]" value="<?php echo $listOrder; ?> <?php echo $listDirn; ?>"/>
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>
<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * page.config.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 07/07/2016 - 13:33
 */

if(!defined('PAGESTUDIO_ROOT')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="wrap">
	<h2><?php echo ps_trans('Configurations') . ' - ' . ps_trans('Permissions'); ?></h2>
	<?php ps_settings_tab(); ?>

	<form id="mainform" method="post" action="" enctype="multipart/form-data">
		<input id="act" name="act" value="perm" type="hidden">
		<input id="wp-ref" name="wp_ref" value="<?php echo ps_get('page'); ?>" type="hidden">
		<?php wp_nonce_field(ps_get('page')); ?>

		<div class="content">
			<h3><?php echo ps_trans('Editor Permissions'); ?></h3>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th class="titledesc" scope="row"><?php echo ps_trans('Permissions'); ?></th>
						<td class="forminp forminp-checkbox">
							<label for="ps_usepermission">
								<input id="ps_usepermission"<?php echo (ps_get_internal('usepermission') ? ' checked="checked"' : '' ); ?> name="config[usepermission]" value="1" type="checkbox">
								<?php echo ps_trans('Enable permissions for all roles'); ?>
								<p class="description indicator-hint"><?php echo ps_trans('By enabling the permissions you will need to adjust the accesses to the editor, for all wordpress roles. Keeping disabled, all users will have full access to the editor.'); ?></p>
								<code><?php echo sprintf(ps_trans('To have access to more options and full support unlock the PageStudio Pro. %sLearn more%s'), '<a href="'.PAGESTUDIO_PREMIUM_URL.'">','</a>'); ?>.</code>
							</label>
						</td>
					</tr>
				</tbody>
			</table>

			<div class="permission-accordeon">
				<?php foreach ( ps_get_roles() as $key => $value ): ?>
					<div class="widget">
						<div class="widget-top chk_widget_box">
							<div class="widget-title-action">
								<a class="widget-action hide-if-no-js" data-ref="role-<?php echo $key; ?>" href="#available-widgets"></a>
							</div>
							<a class="check-opt perm-check" href="#"><?php echo ps_trans('Check all'); ?></a>
							<a class="check-opt perm-uncheck" href="#"><?php echo ps_trans('Uncheck all'); ?></a>
							<div class="widget-title ui-sortable-handle"><h3><?php echo $value; ?><span class="in-widget-title"></span></h3></div>
						</div>

						<div id="role-<?php echo $key; ?>" class="widget-inside">
							<div class="wrap permission-block">
								<div class="premium-info">&nbsp;</div>
								<ul>
									<?php foreach ( ps_all_permissions() as $p ): ?>
										<li>
											<label for="permission_<?php echo $key; ?>_<?php echo $p; ?>">
												<input type="checkbox" id="permission_<?php echo $key; ?>_<?php echo $p; ?>" checked disabled name="permission[<?php echo $key; ?>][<?php echo $p; ?>]" value="1">
												<?php echo (isset(ps_get_componentdata($p)['data']['name']) ? ps_get_componentdata($p)['data']['name'] : ps_defaultper_name($p)); ?>
											</label>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<?php if (ps_get_permission('saveconfig')): ?>
				<p class="submit"><input name="submit_btn" id="submit_btn" class="button button-primary" value="<?php echo ps_trans('Save Changes'); ?>" type="submit"></p>
			<?php endif; ?>
		</div>
	</form>
</div>
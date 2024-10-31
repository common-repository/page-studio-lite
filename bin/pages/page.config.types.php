<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * page.config.types.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 18/01/2017 - 16:05
 */
?>
<div class="wrap">
	<h2><?php echo ps_trans('Configurations'); ?></h2>
	<?php ps_settings_tab(); ?>

	<form id="mainform" method="post" action="" enctype="multipart/form-data">
		<input id="act" name="act" value="pstype" type="hidden">
		<input id="wp-ref" name="wp_ref" value="<?php echo ps_get('page'); ?>" type="hidden">
		<?php wp_nonce_field(ps_get('page')); ?>
		<div class="content">
			<h3><?php echo ps_trans('All Post Types'); ?></h3>
			<p class="description" id="admin-email-description"><?php echo ps_trans('Attention, enabling the pagestudio for post types of third-party plugins may not be compatible. Disabling of all objects will make the pagestudio inaccessible.'); ?></p>
			<div class="posttype-accordeon">
				<?php
				$post_types = get_post_types();
				if (count($post_types) > 0) {
					foreach ( $post_types as $key => $value ) {
						if (!in_array($key, array('attachment','nav_menu_item','revision','custom_css','customize_changeset','wpcf7_contact_form'))) {
							$post_type_data = ps_posttype_data($key);
							?>
							<div class="widget">
								<div class="widget-top chk_widget_box">
									<div class="widget-title-action">
										<a class="widget-action hide-if-no-js" data-ref="role-<?php echo $key; ?>" href="#available-widgets"></a>
									</div>
									<div class="widget-title ui-sortable-handle"><h3><?php echo ucwords(str_replace("_", " ", $value)); ?><span class="in-widget-title"></span></h3></div>
								</div>
								<div id="role-<?php echo $key; ?>" class="widget-inside">
									<div class="wrap permission-block" style="padding-left: 20px; padding-right: 20px;">
										<table class="form-table">
											<tbody>
											<tr valign="top">
												<th class="titledesc" scope="row"><?php echo ps_trans('PageStudio'); ?></th>
												<td class="forminp forminp-checkbox">
													<select class="pagestudio_activation" data-for="sec-<?php echo $key; ?>" name="config[<?php echo $key; ?>][activated]" style="width: 200px;">
														<option value="y"<?php echo ($post_type_data->active ? ' selected' : ''); ?>><?php echo ps_trans('Enabled'); ?></option>
														<option value="n"<?php echo (!$post_type_data->active ? ' selected' : ''); ?>><?php echo ps_trans('Disabled'); ?></option>
													</select>
												</td>
											</tr>
											<tr valign="top" class="secondary-option sec-<?php echo $key; ?>">
												<th class="titledesc" scope="row">&nbsp;</th>
												<td class="forminp forminp-checkbox">
													<label for="ps_inlist">
														<code><?php echo sprintf(ps_trans('To have access to more options and full support unlock the PageStudio Pro. %sLearn more%s'), '<a href="'.PAGESTUDIO_PREMIUM_URL.'">','</a>'); ?>.</code>
													</label>
												</td>
											</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<?php
						}
					}
				}
				?>
			</div>









			<?php if (ps_get_permission('saveconfig')): ?>
				<p class="submit"><input name="submit_btn" id="submit_btn" class="button button-primary" value="<?php echo ps_trans('Save Changes'); ?>" type="submit"></p>
			<?php endif; ?>
		</div>
	</form>
</div>


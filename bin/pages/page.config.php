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
	<h2><?php echo ps_trans('Configurations'); ?></h2>
	<?php ps_settings_tab(); ?>

	<form id="mainform" method="post" action="" enctype="multipart/form-data">
		<input id="act" name="act" value="config" type="hidden">
		<input id="wp-ref" name="wp_ref" value="<?php echo ps_get('page'); ?>" type="hidden">
		<?php wp_nonce_field(ps_get('page')); ?>
		<div class="content">
			<h3><?php echo ps_trans('Editor Options'); ?></h3>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th class="titledesc" scope="row"><?php echo ps_trans('Minify Custom CSS'); ?></th>
						<td class="forminp forminp-checkbox">
							<label for="ps_minifycss">
								<input id="ps_minifycss"<?php echo (ps_get_internal('minifycss', true) ? ' checked="checked"' : '' ); ?> name="config[minifycss]" value="1" type="checkbox">
								<?php echo ps_trans('Page Studio generates custom css automatically, minifying this file can reduce the final size. (recomended)'); ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row"><?php echo ps_trans('Blank Space'); ?></th>
						<td class="forminp forminp-checkbox">
							<label for="ps_blankspace">
								<input id="ps_blankspace"<?php echo (ps_get_internal('blankspace') ? ' checked="checked"' : '' ); ?> name="config[blankspace]" value="1" type="checkbox">
								<?php echo ps_trans('Enable the blank space inside the frontend editor.'); ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row"><?php echo ps_trans('Editor Help Hints'); ?></th>
						<td class="forminp forminp-checkbox">
							<label for="ps_helpsys">
								<input id="ps_helpsys"<?php echo (ps_get_internal('helpsys') ? ' checked="checked"' : '' ); ?> name="config[helpsys]" value="1" type="checkbox">
								<?php echo ps_trans('Enable the "Take a tour" option to help you to use the editor for the first time.'); ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row"><?php echo ps_trans('PageStudio Sign'); ?></th>
						<td class="forminp forminp-checkbox">
							<label for="ps_pagestudiosign">
								<input id="ps_pagestudiosign"<?php echo (ps_get_internal('pagestudiosign') ? ' checked="checked"' : '' ); ?> name="config[pagestudiosign]" value="1" type="checkbox">
								<?php echo ps_trans('At the end of all pages managed by pagestudio a little sign will appear, unchecking this box will remove this sign of all your pages.'); ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th class="titledesc" scope="row"><?php echo ps_trans('Auto Save'); ?></th>
						<td class="forminp forminp-checkbox">
							<label for="ps_editorautosave">
								<input id="ps_editorautosave"<?php echo (ps_get_internal('editorautosave') ? ' checked="checked"' : '' ); ?> name="config[editorautosave]" value="1" type="checkbox">
								<?php echo ps_trans('Enable Auto Save'); ?>
							</label>
						</td>
					</tr>
					<tr valign="top" id="autosavetimer-toggler">
						<th class="titledesc" scope="row"><?php echo ps_trans('Auto Save timer'); ?></th>
						<td class="forminp forminp-checkbox">
							<select id="ps_autosavetimer" name="config[autosavetimer]" style="width: 200px;">
								<?php for ($i = 5; $i <= 30; $i+=5 ): ?>
									<option value="<?php echo $i; ?>"<?php echo (ps_get_internal('autosavetimer') == $i ? ' selected' : ''); ?>><?php echo $i.' '.ps_trans('Minutes'); ?></option>
								<?php endfor; ?>
							</select>
						</td>
					</tr>
				</tbody>
			</table>
			<?php if (ps_get_permission('saveconfig')): ?>
				<p class="submit"><input name="submit_btn" id="submit_btn" class="button button-primary" value="<?php echo ps_trans('Save Changes'); ?>" type="submit"></p>
			<?php endif; ?>
		</div>
	</form>
</div>

<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * page.about.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 18/08/2016 - 15:54
 */

if(!defined('PAGESTUDIO_ROOT')) {
	header('HTTP/1.0 403 Forbidden');
	exit;
}
?>
<div class="wrap about-wrap">
	<h1><?php echo sprintf(ps_trans('Welcome to the %s'), PAGESTUDIO_PLUGIN_NAME); ?></h1>
	<div class="about-text">
		<?php echo ps_trans('PageStudio is a simple and easy page editor for wordpress, where you can create your pages in a few minutes.'); ?>
	</div>
	<div class="pagestudio-badge">
		<?php echo sprintf(ps_trans('Version: %s - Lite'), PAGESTUDIO_PLUGIN_VERSION); ?>
	</div>
	<h2 class="nav-tab-wrapper wp-clearfix">
		<a class="about-menu-nav nav-tab nav-tab-active" ref="main" href="#"><?php echo ps_trans('The PageStudio'); ?></a>
		<a class="nav-tab" target="_blank" href="http://changelog.pagestudio.pro/"><?php echo ps_trans('Changelog'); ?></a>
		<a class="nav-tab" target="_blank" href="http://pagestudio.pro/knowledge-base/"><?php echo ps_trans('Knowledge Base'); ?></a>
		<a class="about-menu-nav nav-tab" href="#" ref="pspro"><?php echo ps_trans('Upgrade to Pro'); ?></a>
	</h2>

	<div id="main" class="feature-section">
		<h3><?php echo ps_trans('See the plataform in Action'); ?></h3>
		<p><?php echo ps_trans('Watch a video showing how to design a webpage using PageStudio.'); ?></p>
		<iframe src="https://player.vimeo.com/video/178221578?color=ff0179&title=0&byline=0&portrait=0" width="800" height="450" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>

	<style type="text/css">
		.feature-section p {
			margin-left: 0 !important;
		}

		.feature-section ul {
			margin-left: 20px;
			font-size: 14px;
		}

		.green {
			background: #30B72D !important;
			border-color: #1C801A #368334 !important;
			box-shadow: 0 1px 0 #368334 !important;
			text-shadow: 0 -1px 1px #368334, 1px 0 1px #368334, 0 1px 1px #368334, -1px 0 1px #368334 !important;
			font-size: 18px !important;
			padding: 0 20px 1px !important;
			height: 40px !important;
			line-height: 35px !important;
		}
	</style>

	<div id="pspro" class="feature-section">
		<h3><?php echo ps_trans('Unleash the full power of PageStudio!'); ?></h3>
		<br>
		<p><?php echo ps_trans('A LOT more features, components and modules to save your time and make your website even better!'); ?></p>
		<p><strong><?php echo ps_trans('Features:'); ?></strong></p>
		<ul>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Social modules: Facebook, Pinterest, Vimeo, Vine, Twitter.'); ?></li>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Design Modules such as: Contact form 7, Sliders, Icons, Counters, Progress Bars and Social Buttons.'); ?></li>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Access to predefined elements that makes easy to build every page.'); ?></li>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Full Premium Support.'); ?></li>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Full integration with all other plugins that uses shortcodes.'); ?></li>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Complete permission control of your editor for different kind of users.'); ?></li>
			<li><i class="fa fa-check" aria-hidden="true"></i> <?php echo ps_trans('Complete control of the post types.'); ?></li>
		</ul>

		<a class="button button-primary green" href="<?php echo ps_frm_initialize()->get_upgrade_url(); ?>"><?php echo ps_trans('Upgrade Now!'); ?></a>
	</div>

</div>

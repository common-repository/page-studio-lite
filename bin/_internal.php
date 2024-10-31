<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _internal.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 16:01
 */

//Registra os controles básicos onde serão registrados os elementos
ps_register_control( 'layout', ps_trans( 'Layout' ), 'layout', true );
ps_register_control( 'elements', ps_trans( 'Elements' ), 'elements', true );
ps_register_control( 'components', ps_trans( 'Components' ), 'elements', true );
//ps_register_control( 'templates', ps_trans( 'Templates' ), 'template', false );
//ps_register_control( 'predef', ps_trans( 'Predefined Elements' ), 'template', false );
ps_register_control( 'wordpress', ps_trans( 'Wordpress Widgets' ), 'elements', true );

$controlsDefault = PAGESTUDIO_BIN . 'plugins/Default/Controls/';
$pluginsDefault  = PAGESTUDIO_BIN . 'plugins/Default/';
$wordpressDefault = PAGESTUDIO_BIN . 'plugins/Wordpress/';

ps_register_component_control( $controlsDefault . 'Transform.php' );
ps_register_component_control( $controlsDefault . 'Typography.php' );
ps_register_component_control( $controlsDefault . 'SimpleEditor.php' );
ps_register_component_control( $controlsDefault . 'Editor.php' );
ps_register_component_control( $controlsDefault . 'Grid.php' );
ps_register_component_control( $controlsDefault . 'Hyperlink.php' );
ps_register_component_control( $controlsDefault . 'Url.php' );
ps_register_component_control( $controlsDefault . 'Background.php' );
ps_register_component_control( $controlsDefault . 'Media.php' );
ps_register_component_control( $controlsDefault . 'Class.php' );
ps_register_component_control( $controlsDefault . 'Effects.php' );
ps_register_component_control( $controlsDefault . 'Fullpage.php' );
ps_register_component_control( $controlsDefault . 'Responsive.php' );

ps_register_component_file( $pluginsDefault . 'plg_heading.php' );
ps_register_component_file( $pluginsDefault . 'plg_button.php' );
ps_register_component_file( $pluginsDefault . 'plg_image.php' );
ps_register_component_file( $pluginsDefault . 'plg_paragraph.php' );
ps_register_component_file( $pluginsDefault . 'plg_row.php' );
ps_register_component_file( $pluginsDefault . 'plg_rowcolx2.php' );
ps_register_component_file( $pluginsDefault . 'plg_rowcolx3.php' );
ps_register_component_file( $pluginsDefault . 'plg_spacing.php' );
ps_register_component_file( $pluginsDefault . 'plg_hr.php' );
ps_register_component_file( $pluginsDefault . 'plg_html.php' );
//ps_register_component_file( $pluginsDefault . 'plg_shortcode.php' );

//Adiciona os elementos Wordpress
ps_register_component_file($wordpressDefault . 'WP.Archives.php');
ps_register_component_file($wordpressDefault . 'WP.Calendar.php');
ps_register_component_file($wordpressDefault . 'WP.Categories.php');
ps_register_component_file($wordpressDefault . 'WP.Comments.php');
ps_register_component_file($wordpressDefault . 'WP.Links.php');
ps_register_component_file($wordpressDefault . 'WP.Pages.php');
ps_register_component_file($wordpressDefault . 'WP.Posts.php');
ps_register_component_file($wordpressDefault . 'WP.rss.php');
ps_register_component_file($wordpressDefault . 'WP.search.php');
ps_register_component_file($wordpressDefault . 'WP.tagcloud.php');
ps_register_component_file($wordpressDefault . 'WP.wtext.php');
ps_register_component_file($wordpressDefault . 'WP.navmenu.php');

ps_register_component_file( PAGESTUDIO_BIN . 'plugins/Addons/_main.php' );
//ps_register_component_file( PAGESTUDIO_BIN . 'plugins/Predefined/PredefinedElements.php' );
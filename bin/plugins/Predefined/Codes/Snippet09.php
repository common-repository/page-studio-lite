<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Snippet09.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 08/12/2016 - 19:00
 */

$predefinedelement9 = array(
	'name' => ps_trans('Snippet') . ' 09',
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/ctr-snippet09.png',
	'html' => '<div class="chk_element chk_main_int" data-mdl="check_row" data-edit="[transform,grid,class,background,responsive]" data-can="[move,edit,clone,delete]" data-element="Row" data-default="grid" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); background-color: transparent; margin-top: 0px; padding-top: 100px; padding-bottom: 100px; background-image: url(&quot;https://placeimg.com/1000/480/animals/grayscale&quot;); background-size: cover; background-position: center center;" data-media="false"><div class="chk_row column-sortable container"><div class="chk_element chk_column chk_column_int gr-12" data-mdl="check_column" data-edit="[transform,class,background,responsive]" data-can="[move,edit,delete]" data-element="Column"><div class="chk_column_container"><div class="chk_column_inner"><div class="chk-element-container element-sortable element-connected-sortable"><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_icon" data-edit="[transform,icon,class,effect]" data-mdl="chk_icon" data-element="Icon" data-content="false" data-default="icon"><div class="chk_icon" data-icon="fa-camera-retro" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); color: rgb(255, 255, 255); font-size: 89px ! important; text-align: center;"><i class="fa fa-camera-retro" aria-hidden="true"></i></div></div><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_heading" data-edit="[transform,typo,hyperlink,class,effect,simple-editor]" data-mdl="check_h1" data-element="Heading" data-content="true" data-default="typo"><h2 class="chk_heading font-nilland-paint" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); color: rgb(255, 255, 255); font-size: 47px ! important; line-height: 63px ! important; text-align: center; margin-bottom: 20px;">Enter your text</h2></div><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".trg_button" data-edit="[transform,typo,simple-editor,url,class,effect]" data-mdl="check_button" data-element="Button" data-content="true" data-default="url"><a class="trg_button chk_button btn_white font-raleway" data-color="btn_white" href="#" style="border-width: 2px ! important; border-radius: 0px ! important; border-color: rgb(45, 126, 219); color: rgb(45, 126, 219); font-size: 15px ! important; line-height: 15px ! important; text-align: center; margin: auto; padding: 15px 30px;">See More...</a></div></div></div></div></div></div></div>'
);

ps_register_component('chk_predefined_snippet09', 'predef', $predefinedelement9);
<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Snippet01.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 08/12/2016 - 16:13
 */

$predefinedelement1 = array(
	'name' => ps_trans('Snippet') . ' 01',
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/ctr-snippet01.png',
	'html' => '<div class="chk_element chk_main_int" data-mdl="check_row" data-edit="[transform,grid,class,background,responsive]" data-can="[move,edit,clone,delete]" data-element="Row" data-default="grid" style="margin-bottom: 15px; padding-top: 0px; border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); background-color: transparent; margin-top: 15px;"><div class="chk_row column-sortable container"><div class="chk_element chk_column chk_column_int gr-12" data-mdl="check_column" data-edit="[transform,class,background,responsive]" data-can="[move,edit,delete]" data-element="Column"><div class="chk_column_container"><div class="chk_column_inner"><div class="chk-element-container element-sortable element-connected-sortable"><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_heading" data-edit="[transform,typo,hyperlink,class,effect,simple-editor]" data-mdl="check_h1" data-element="Heading" data-content="true" data-default="typo"><h2 class="chk_heading font-nilland-paint" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); color: rgb(139, 65, 177); font-size: 53px ! important; line-height: 69px ! important; text-align: center;">Enter your text</h2></div><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_heading" data-edit="[transform,typo,hyperlink,class,effect,simple-editor]" data-mdl="check_h1" data-element="Heading" data-content="true" data-default="typo"><h2 class="chk_heading font-comfortaa" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-size: 25px ! important; line-height: 25px ! important; text-align: center; margin-top: 15px; margin-bottom: 15px;">Enter your second text</h2></div><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".trg_button" data-edit="[transform,typo,simple-editor,url,class,effect]" data-mdl="check_button" data-element="Button" data-content="true" data-default="url"><a class="trg_button font-montserrat chk_button btn_purple_rev" data-color="btn_purple_rev" href="#" style="border-width: 2px ! important; border-radius: 3px ! important; border-color: rgb(45, 126, 219); color: rgb(45, 126, 219); font-size: 15px ! important; line-height: 15px ! important; margin: auto;">See More...</a></div></div></div></div></div></div></div>'
);

ps_register_component('chk_predefined_snippet01', 'predef', $predefinedelement1);
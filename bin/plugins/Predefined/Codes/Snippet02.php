<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Snippet02.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 08/12/2016 - 16:30
 */

$predefinedelement2 = array(
	'name' => ps_trans('Snippet') . ' 02',
	'ico' => PAGESTUDIO_PLUGIN_PATH . '/assets/img/ctr-snippet02.png',
	'html' => '<div class="chk_element chk_main_int" data-mdl="check_row" data-edit="[transform,grid,class,background,responsive]" data-can="[move,edit,clone,delete]" data-element="Row" data-default="grid" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); background-color: transparent; margin-top: 15px; margin-bottom: 15px;"><div class="chk_row column-sortable container"><div class="chk_element chk_column chk_column_int gr-6" data-mdl="check_column" data-edit="[transform,class,background,responsive]" data-can="[move,edit,delete]" data-element="Column"><div class="chk_column_container"><div class="chk_column_inner"><div class="chk-element-container element-sortable element-connected-sortable"><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_heading" data-edit="[transform,typo,hyperlink,class,effect,simple-editor]" data-mdl="check_h1" data-element="Heading" data-content="true" data-default="typo"><h2 class="chk_heading font-nilland-paint" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); color: rgb(139, 65, 177); font-size: 30px ! important; line-height: 39px ! important; font-weight: normal;">'.ps_trans('Enter your text').'</h2></div><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_paragraph" data-edit="[transform,typo,hyperlink,class,effect,editor]" data-mdl="check_p" data-element="Paragraph" data-content="true" data-default="typo"><div class="chk_paragraph font-raleway" style="margin-top: 15px; border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0); color: rgb(0, 0, 0); font-size: 15px ! important; line-height: 26px ! important;"><p>'.ps_trans('The noise had brought Dejah Thoris to the door of her apartment, and there she stood throughout the conflict with Sola at her back peering over her shoulder.  Her face was set and emotionless and I knew that she did not recognize me, nor did Sola.').'</p></div></div></div></div></div></div><div class="chk_element chk_column chk_column_int gr-6" data-mdl="check_column" data-edit="[transform,class,background,responsive]" data-can="[move,edit,delete]" data-element="Column"><div class="chk_column_container"><div class="chk_column_inner"><div class="chk-element-container element-sortable element-connected-sortable"><div class="chk_element chk_element_int" data-can="[Move,Edit,Clone,Delete]" data-target=".chk_image_source" data-edit="[transform,media,hyperlink,class,effect]" data-mdl="check_image" data-element="Image" data-content="true" data-default="media" data-media="false"><div class="chk_image_wrapper">					<img class="chk_image_source lazy" src="https://placeimg.com/1000/480/any" data-original="https://placeimg.com/1000/480/any" alt="any" style="border-width: 0px ! important; border-radius: 0px ! important; border-color: rgb(0, 0, 0);" data-media="false" width="1000" height="480"></div></div></div></div></div></div></div></div>'
);

ps_register_component('chk_predefined_snippet02', 'predef', $predefinedelement2);
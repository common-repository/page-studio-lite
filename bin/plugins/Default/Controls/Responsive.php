<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Responsive.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 10/11/2016 - 15:48
 */

$html = '<label>' . ps_trans( 'Visibility Settings' ) . '<div class="marker"></div></label>
	<label class="pres">'.ps_trans('Use this feature to define different style rules for different media type/devices.').'</label>
	<div class="responsive-selection">
		<div class="opt-line">
			<span class="icon-centralizer"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
		</div>
		<div class="opt-line">
			<a class="resp-button active tooltip" title="'.ps_trans('Desktop Resolution (full)').'" data-width="all" href="#"><i class="fa fa-laptop" aria-hidden="true"></i></a>
		</div>
		<div class="opt-line">
			<a class="resp-button active tooltip" title="'.ps_trans('Resolution of:').' 1024px" data-width="1024" href="#"><i class="fa fa-tablet fa-rotate-90" aria-hidden="true"></i></a>
		</div>
		<div class="opt-line">
			<a class="resp-button active tooltip" title="'.ps_trans('Resolution of:').' 768px" data-width="768" href="#"><i class="fa fa-tablet" aria-hidden="true"></i></a>
		</div>
		<div class="opt-line">
			<a class="resp-button active tooltip" title="'.ps_trans('Resolution of:').' 480px" data-width="480" href="#"><i class="fa fa-mobile fa-rotate-90" aria-hidden="true"></i></a>
		</div>
		<div class="opt-line">
			<a class="resp-button active tooltip" title="'.ps_trans('Resolution of:').' 320px" data-width="320" href="#"><i class="fa fa-mobile" aria-hidden="true"></i></a>
		</div>
	</div>

	<div class="style-checkbox">
		<div class="checkbox-item">
            <span class="checkbox-title">' . ps_trans( 'Display area control') . '</span>
            <div class="checkbox-position">
                <input type="checkbox" name="display-esc" value="1">
            </div>
        </div>
	</div>
	<label class="pres">'.ps_trans('This is just a simple resource to show or hide elements. If you want to use a full @media feature, you can use the CSS Editor.').'</label>
';

ps_register_editor('responsive', ps_trans('Responsive Options'), $html);
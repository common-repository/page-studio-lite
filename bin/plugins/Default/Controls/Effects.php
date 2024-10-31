<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Effects.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 21/06/2016 - 17:09
 */

$effectList = array('bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceOut','bounceOutDown','bounceOutLeft','bounceOutRight','bounceOutUp','fadeIn','fadeInDown','fadeInDownBig','fadeInLeft','fadeInLeftBig','fadeInRight','fadeInRightBig','fadeInUp','fadeInUpBig','fadeOut','fadeOutDown','fadeOutDownBig','fadeOutLeft','fadeOutLeftBig','fadeOutRight','fadeOutRightBig','fadeOutUp','fadeOutUpBig','flipInX','flipInY','flipOutX','flipOutY','lightSpeedIn','lightSpeedOut','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','rotateOut','rotateOutDownLeft','rotateOutDownRight','rotateOutUpLeft','rotateOutUpRight','hinge','rollIn','rollOut','zoomIn','zoomInDown','zoomInLeft','zoomInRight','zoomInUp','zoomOut','zoomOutDown','zoomOutLeft','zoomOutRight','zoomOutUp','slideInDown','slideInLeft','slideInRight','slideInUp','slideOutDown','slideOutLeft','slideOutRight','slideOutUp');
$optionList = '';
foreach($effectList as $e) {
	$optionList .= '<option value="' . $e . '">' . $e . '</option>';
}

$html = '<label>' . ps_trans( 'Special Effects' ) . '<div class="marker"></div></label>
	<label class="pres no-mrg">' . ps_trans( 'Scroll down Effects' ) . '</label>
	<div class="dropdown dropdown-dark">
	    <select class="dropdown-select" name="css-effect">
			<option value="none">' . ps_trans( 'None' ) . '</option>
			'.$optionList.'
	    </select>
	</div>
';

ps_register_editor('effect', ps_trans( 'Effects' ), $html);
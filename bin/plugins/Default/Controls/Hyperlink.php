<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * Hyperlink.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 04/08/2016 - 13:19
 */


$html = '<label>' . ps_trans( 'Enter the destination URL' ) . '<div class="marker"></div></label>
    <label class="pres">' . ps_trans( 'URL (Use http://)' ) . '</label>
    <input class="no-abs" type="text" name="link-url">
    <label>' . ps_trans( 'Or link to existing content' ) . '<div class="marker"></div></label>
	<ul class="chk-page-selector">
		' . ps_getPagePost() . '
	</ul>
	<label>' . ps_trans( 'Link Settings' ) . '<div class="marker"></div></label>

		<label class="pres small-sep">' . ps_trans( 'Target' ) . '</label>
		<div class="dropdown dropdown-dark">
			<select class="dropdown-select" name="link-target">
				<option value="_blank">' . ps_trans( 'Blank' ) . '</option>
				<option value="_parent">' . ps_trans( 'Parent' ) . '</option>
				<option value="_self">' . ps_trans( 'Self' ) . '</option>
			</select>
		</div>

		<label class="pres small-sep">' . ps_trans( 'Relationship' ) . '</label>
		<div class="dropdown dropdown-dark">
			<select class="dropdown-select" name="link-rel">
				<option value="alternate">' . ps_trans( 'alternate' ) . '</option>
				<option value="author">' . ps_trans( 'author' ) . '</option>
				<option value="bookmark">' . ps_trans( 'bookmark' ) . '</option>
				<option value="help">' . ps_trans( 'help' ) . '</option>
				<option value="license">' . ps_trans( 'license' ) . '</option>
				<option value="next">' . ps_trans( 'next' ) . '</option>
				<option value="nofollow">' . ps_trans( 'nofollow' ) . '</option>
				<option value="noreferrer">' . ps_trans( 'noreferrer' ) . '</option>
				<option value="prefetch">' . ps_trans( 'prefetch' ) . '</option>
				<option value="prev">' . ps_trans( 'prev' ) . '</option>
				<option value="search">' . ps_trans( 'search' ) . '</option>
				<option value="tag">' . ps_trans( 'tag' ) . '</option>
			</select>
		</div>';

ps_register_editor('hyperlink', ps_trans( 'Hyperlink' ), $html);
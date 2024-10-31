<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.editorbase.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 01/06/2016 - 14:51
 */

namespace Checkcms\Editor {

	/**
	 * Class EditorBase
	 * @package Checkcms\Editor
	 */
	class EditorBase {

		public static function window_base_normal() {
			return '<div class="checkcms-w-content-page">
				   		<div class="checkcms-w-holder"></div>
			       </div>
			       <div class="checkcms-w-content-bottom">
			          <div class="bottom-button-holder">
			              <a class="save-button-window" href="#">' . ps_trans( 'Save' ) . '</a>
			              <a class="close-this-window" href="#">' . ps_trans( 'Cancel' ) . '</a>
			          </div>
			       </div>';
		}

		public static function window_base_table() {
			return '<div class="checkcms-w-content-table">
			           <div class="table-wrapper"></div>
			       </div>
			       <div class="checkcms-w-content-bottom">
			          <div class="bottom-button-holder">
			              <a class="save-button-window" href="#">' . ps_trans( 'Save' ) . '</a>
			              <a class="close-this-window" href="#">' . ps_trans( 'Cancel' ) . '</a>
			          </div>
			       </div>';
		}

		public static function css3_window() {
			return '<label for="elementText">' . ps_trans( 'Customizable CSS' ) . '</label>' .
			       '<cite>' . ps_trans( 'This CSS code will only work in this page.' ) . '</cite>' .
			       '<div class="chk_css-editor" id="edit-css-page"></div>';
		}

		public static function template_window() {
			//TODO: Editar de forma que o usuário não possa baixar os temas.
			$licode   = '';
			$response = wp_remote_get( 'http://pagestudio.checkmatedigital.com/api/router/template/list/' );
			if ( is_array( $response ) ) {
				$body = $response['body'];
				$code = json_decode( $body, true );

				if ( ! is_null( $code ) ) {
					foreach ( $code as $c ) {
						$licode .= '
						<li>
							<a data-uuid="' . $c['uuid'] . '" class="tmp_lkn" href="#">
								<div class="load_tmp"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>
								<img src="' . $c['thumbnail'] . '" width="170" height="200">
								<div class="chk_templates_description">
									<span class="name">' . $c['name'] . '</span>
								</div>
							</a>
						</li>
					';
					}
				} else {
					$licode = '
					<li class="error-line">
						' . ps_trans( 'Failed to get the template list, please, reload and try again, if the problem persists, send a ticked to our support.' ) . '
					</li>
					';
				}
			}

			return '<div class="checkcms-lite-ad">
						<div class="hold">
							<h2>' . ps_trans( 'With the PageStudio Pro, you can fire your criativity with dozens of ready to use templates.' ) . '</h2>
							<a class="button button-primary green" target="_blank" href="' . PAGESTUDIO_PREMIUM_URL . '">' . ps_trans( 'Upgrade Now!' ) . '</a>
						</div>
					</div>
					<label for="elementText">' . ps_trans( 'PageStudio Templates' ) . '</label>' .
			       '<cite>' . ps_trans( 'You can download templates to use as your pages. All templates uses free images.' ) . '</cite>' .
			       '<div class="chk_templates">
						<ul>' . $licode . '</ul>
					</div>
					';
		}

		public static function html_editor() {
			return '<label for="elementText">' . ps_trans( 'Customizable Html' ) . '</label>' .
			       '<div class="chk_css-editor" id="edit-html-page"></div>';
		}

		public static function wordpresseditor_window() {
			return '<label for="elementText">' . ps_trans( 'Paragraph Editor' ) . '</label>' .
			       '<textarea class="theEditor" name="check_full_editor" id="check_full_editor"></textarea> ';
		}

		public static function styletab() {
			$tabData       = ps_editor_sort();
			$generatedHtml = null;
			foreach ( $tabData as $t ) {
				$generatedHtml .= '<div class="element-control" data-rel="position-' . $t['id'] . '">
								        <div class="elm-arrow-base elm-arrow-up"></div>
								        <div class="label">' . ps_trans($t['name']) . '</div>
								    </div>
								    <div class="element-wrapper" data-control="position-' . $t['id'] . '">
										' . $t['controls'] . '
								    </div>';
			}
			return $generatedHtml;
		}

		public static function editorComponents() {
			$component_data = ps_controls_sort( 'id' );
			$generatedHtml  = null;
			foreach ( $component_data as $c ) {
				if ( ps_have_components( $c['id'] ) ) {

					if ( ! is_null( ps_get_components( $c['id'] ) ) ) {

						$generatedHtml .= '<div class="element-control" data-rel="position-' . $c['id'] . '">
								        <div class="elm-arrow-base elm-arrow-up"></div>
								        <div class="label">' . ps_trans($c['name']) . '</div>
								    </div>
								    <div class="element-wrapper" data-control="position-' . $c['id'] . '">
								        ' . ( ! is_null( ps_get_components( $c['id'] ) ) ? '
								        <ul class="selectable-element ' . $c['base'] . '">
								            ' . ps_get_components( $c['id'] ) . '
								        </ul>
								        ' : '' ) . '
								    </div>';
					}
				}
			}

			return $generatedHtml;
		}
	}
}
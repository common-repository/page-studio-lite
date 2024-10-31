<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.shortcodes.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 22/05/2016 - 10:59
*/

add_shortcode('check_anchor', 'chkshort_check_anchor');
/**
 * Ancora principal, esta classe não deve ser mudada pois é através dela que o editor
 * consegue identificar o elemento "parent" para o qual deve trabalhar todo o editor
 *
 * @since 1.0.0
 * @return string
 *  Retrona o HTML que será substituído pela engine do wordpress através da função do_shortcode()
 * @shortcode [check_anchor]
 */
function chkshort_check_anchor() {
	$span = new CHKElement( 'div' );
	$span->attr( 'class', 'chk_container_anchor' )
	     ->attr( 'data-mdl', 'check_anchor' )
	     ->attr( 'style', 'display:none;' );
	return $span->render();
}

add_shortcode('check_row', 'chkshort_check_row');
/**
 * Este shortcode é responsável pela criação das linhas do checkcms.
 *
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 * @shortcode [check_row]
 */
function chkshort_check_row( $atts, $content = null ) {
	return ps_create_row('int-row', $atts, $content);
}

add_shortcode( 'check_fullpage', 'checkshort_check_fullpage' );
/**
 * Este shortcode é responsável pela criação das linhas fullpage
 *
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 * @shortcode [check_fullpage]
 */
function checkshort_check_fullpage( $atts, $content = null ) {
	return ps_create_row( 'int-fullpage', $atts, $content );
}

add_shortcode('check_column', 'chkshort_check_column');
/**
 * Este shortcode é responsável pela criação das colunas no checkcms e ajuste do grid
 *
 * @param array $atts
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 * @shortcode [check_column]
 */
function chkshort_check_column( $atts, $content = null ) {

	$defaultValues = array(
		'class' => null,
		'media' => null,
		'size'  => null,
		'id'    => null,
		'grid'  => null,
		'can'   => array( 'move', 'edit', 'clone', 'delete' ),
	);

	//Aqui o sistema avalia quais dos valores foram atualizados
	$systemAttr = shortcode_atts( $defaultValues, $atts );
	//Busca a base do componente
	$colBase = ps_component_base( 'int-col', $systemAttr );

	$colCreated = new CHKElement( 'div' );
	foreach ( $colBase['element'] as $attName => $attValue ) {
		$colCreated->attr( $attName, $attValue );
	}

	//Interior da coluna
	$columnContainer = new ChkElement( 'div' );
	$columnInner     = new ChkElement( 'div' );
	$elementSortable = new CHKElement( 'div' );

	$colCreated->appendChild(
		$columnContainer->attr( 'class', 'chk_column_container' )->appendChild(
			$columnInner->attr( 'class', 'chk_column_inner' )->appendChild(
				$elementSortable
					->attr( 'class', 'chk-element-container element-sortable element-connected-sortable' )
					->appendChild( do_shortcode( $content ) )
					->render()
			)->render()
		)->render()
	);

	ps_clean_elementattr($colCreated);

	return $colCreated->render();
}
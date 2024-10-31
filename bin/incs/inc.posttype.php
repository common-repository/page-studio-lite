<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.posttype.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 27/01/2017 - 14:56
*/

/**
 * Adiciona um determinado post type a lista de suporte do PageStudio
 *
 * @param string|array $post_type
 *  Nome do Post Type a ser adicionado a lista
 * @param array $attr
 *  Atributos a serem adicionados para este determinado post_type
 *
 * @return bool
 *  Retorna true|false para o registro do post type, false apenas será retornado caso o type não exista.
 * @since 1.0.5
 */
function ps_add_supported_posttype( $post_type, $attr = array() ) {

	$defaultValues = array(
		'inlist'        => true,
		'clone'         => false,
		'instaredirect' => false,
	);

	$options = ps_element_atts( $defaultValues, $attr );

	//retorna as configurações do sistema
	$cfg = get_option( PAGESTUDIO_PREFIX . '-config' );

	$base = array();
	if ( isset( $cfg['supportedtypes'] ) ) {
		//Não existe, então o sistema já cria uma base
		$base = $cfg['supportedtypes'];
	}

	if ( is_string( $post_type ) ) {
		if ( post_type_exists( $post_type ) ) {
			$base[ $post_type ] = $options;
		} else {
			return false;
		}
	} else if ( is_array( $post_type ) ) {
		foreach ( $post_type as $x ) {
			if ( post_type_exists( $x ) ) {
				$base[ $x ] = $options;
			} else {
				return false;
			}
		}
	}
	$cfg['supportedtypes'] = $base;

	return update_option( PAGESTUDIO_PREFIX . '-config', $cfg );
}

/**
 * Remove suporte a um determinado tipo de post type
 *
 * @param string $post_type
 *  Nome do post type a ser removido da lista de suporte.
 *
 * @return bool
 *  Retorna True\False dependendo se o post type existe ou não para ser removido
 * @since 1.0.5
 */
function ps_remove_supported_posttype( $post_type ) {
	$cfg = get_option( PAGESTUDIO_PREFIX . '-config' );
	if ( isset( $cfg['supportedtypes'] ) ) {

		if ( isset( $cfg['supportedtypes'][ $post_type ] ) ) {
			unset( $cfg['supportedtypes'][ $post_type ] );
			update_option( PAGESTUDIO_PREFIX . '-config', $cfg );

			return true;
		} else {
			return false;
		}
	}
}

/**
 * Verifica se um determinado post type, está habilitado para ser editado pelo editor visual do PageStudio
 *
 * @param string $post_type
 *  Nome do post type
 *
 * @return bool
 *  Retorna true dependendo da disponibilidade.
 * @since 1.0.5
 */
function ps_support_editor( $post_type ) {
	//retorna as configurações do sistema
	$cfg = get_option(PAGESTUDIO_PREFIX . '-config');

	if (isset($cfg['supportedtypes'])) {
		if ( isset( $cfg['supportedtypes'][ $post_type ] ) ) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}

	//return in_array( $post_type, $_PS_EDIT_PERMITED );
}

/**
 * Retorna as informações de um determinado Post Type
 *
 * @param $post_type
 *  Nome do Post Type a ser analizado
 *
 * @return bool|\Checkcms\Internal\PostType
 *  Dados do PostType
 * @since 1.0.5
 */
function ps_posttype_data( $post_type ) {
	return \Checkcms\Internal\PostType::instance( $post_type );
}

function ps_editorlist_option( $post_type ) {
	//retorna as configurações do sistema
	$post_type_data = ps_posttype_data( $post_type );
	if ( ! is_null( $post_type_data ) ) {
		return $post_type_data->in_list;
	} else {
		return false;
	}
}

function ps_editorsize_for( $post_type, $width, $height ) {
	global $_PS_EDITOR_SIZE;
	if ( ! array_key_exists( $post_type, $_PS_EDITOR_SIZE ) ) {
		$_PS_EDITOR_SIZE[ $post_type ] = array( $width, $height );
	}
}

/**
 * Se o editor possui um tamanho específico, então o sistema irá detectar aqui
 *
 * @param string $post_type
 *  Nome do post type
 *
 * @return string
 *  String relativa ao tamanho para ser interpretada pelo editor.
 * @since 1.0.5
 */
function ps_get_editorsize( $post_type ) {
	global $_PS_EDITOR_SIZE;
	//Verifica se para o determinado post type, o editor precisa abrir em um tamanho específico
	if ( array_key_exists( $post_type, $_PS_EDITOR_SIZE ) ) {
		//Sim, então será indicado qual o tamanho a ser aberto do editor
		return sprintf( '%sx%s', $_PS_EDITOR_SIZE[ $post_type ][0], $_PS_EDITOR_SIZE[ $post_type ][1] );
	} else {
		//Não, o editor abre em modo full screen
		return 'full';
	}
}
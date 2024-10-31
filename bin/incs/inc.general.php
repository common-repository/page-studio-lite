<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.general.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 20/05/2016 - 15:33
*/

/**
 * Registras scripts principais do sistema
 * @since 1.0.0
 * @since 1.0.3 Reorganizado o modo como o wordpress é inicializado
 */
function ps_admin_scripts() {

	wp_enqueue_style( 'pagestudio-main-style', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.plugin.min.css' );
	wp_enqueue_script( 'pagestudio-main-script', PAGESTUDIO_PLUGIN_PATH . '/assets/js/main.min.js', '', '', true );

	/*
	//Scripts
	wp_enqueue_script( 'pagestudio-main-script', PAGESTUDIO_PLUGIN_PATH . '/assets/js/main.min.js', '', '', true );
	wp_enqueue_script( 'pagestudio-default-script', PAGESTUDIO_PLUGIN_PATH . '/assets/js/chk.min.js', '', '', true );
	wp_enqueue_script( 'pagestudio-main-editor', PAGESTUDIO_PLUGIN_PATH . '/assets/js/editor.min.js', '', '', true );
	wp_enqueue_script( 'pagestudio-raphael', PAGESTUDIO_PLUGIN_PATH . '/assets/js/raphael-min.js');
	wp_enqueue_script( 'pagestudio-main-ace', PAGESTUDIO_PLUGIN_PATH . '/assets/ace/ace.js', '', '', true );

	//Styles
	wp_enqueue_style( 'pagestudio-main-style', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.plugin.min.css' );
	wp_enqueue_style( 'pagestudio-preview-styles', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.preview.min.css' );
	wp_enqueue_style( 'pagestudio-default-styles', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.default.min.css' );
	wp_enqueue_style( 'pagestudio-editor-style', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.editor.min.css' );
	wp_enqueue_style( 'pagestudio-page-styles', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.page.min.css' );
	wp_enqueue_style( 'pagestudio-jquery-ui', 'https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css' );
	*/
}

/**
 * Esta função é um atalho da função __() do wordpress, realizando a tradução de textos sem a necessidade de
 * indicar o domínio pré definido sempre que a função for chamada, uma vez que o domínio é sempre o mesmo
 * para todo o sistema
 *
 * @param string $toTranslate
 *      Texto a ser traduzido
 *
 * @return string
 *      Texto traduzido utilizando o subdominio padrão do sistema
 * @since 1.0.0
 * @const {@see PAGESTUDIO_TRANSLATION}
 */
function ps_trans( $toTranslate ) {
	return __( $toTranslate, PAGESTUDIO_TRANSLATION );
}

/**
 * Esta função trata os valores que são lidos pelo sistema que vem pela querystring da URL
 * Caso o Parâmetro não exista, será substituido por $defaultValue, esta função apenas identifica
 * valores em $_GET.
 *
 * @param string $param
 *  Nome do parâmetro da query string
 * @param null $defaultValue
 *  Valor padrão a ser retornado caso o parâmetro da query string não seja encontrada
 *
 * @since 1.0.0
 *
 * @return string
 *  Retorna o valor específicado em $param ou, caso o parâmetro não exista, retornar null
 */
function ps_get( $param, $defaultValue = null ) {
	return ps_check( $param, $defaultValue, 'get' );
}

/**
 * Esta função trata os valores que são lidos pelo sistema que vem pela querystring da URL
 * Caso o Parâmetro não exista, será substituido por $defaultValue, esta função apenas identifica
 * valores em $_POST.
 *
 * @param string $param
 *  Nome do parâmetro da query string
 * @param null $defaultValue
 *  Valor padrão a ser retornado caso o parâmetro da query string não seja encontrada
 *
 * @since 1.0.0
 *
 * @return string
 *  Retorna o valor específicado em $param ou, caso o parâmetro não exista, retornar null
 */
function ps_post( $param, $defaultValue = null ) {
	return ps_check( $param, $defaultValue, 'post' );
}

/**
 * Esta função trata os valores que são lidos pelo sistema que vem pela querystring da URL
 * Caso o Parâmetro não exista, será substituido por $defaultValue, esta função apenas identifica
 * valores em $_REQUEST.
 *
 * @param string $param
 *  Nome do parâmetro da query string
 * @param null $defaultValue
 *  Valor padrão a ser retornado caso o parâmetro da query string não seja encontrada
 *
 * @since 1.0.0
 *
 * @return string
 *  Retorna o valor específicado em $param ou, caso o parâmetro não exista, retornar null
 */
function ps_request( $param, $defaultValue = null ) {
	return ps_check( $param, $defaultValue, 'request' );
}

/**
 * Esta função trata os valores que são lidos pelo sistema que vem pela querystring da URL
 * Caso o Parâmetro não exista, será substituido por $defaultValue
 *
 * @param string $param
 *  Nome do parâmetro da query string
 * @param null $defaultValue
 *  Valor padrão a ser retornado caso o parâmetro da query string não seja encontrada
 *
 * @since 1.0.0
 *
 * @return string
 *  Retorna o valor específicado em $param ou, caso o parâmetro não exista, retornar null
 */
function ps_param( $param, $defaultValue = null ) {
	if ( $_SERVER['REQUEST_METHOD'] == 'GET' ) {
		return ps_check( $param, $defaultValue, 'get' );
	} else if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		return ps_check( $param, $defaultValue, 'post' );
	}
}

/**
 * Esta função trata os valores que são lidos pelo sistema que vem pela querystring da URL
 * Caso o Parâmetro não exista, será substituido por $defaultValue
 *
 * @param string $param
 *  Nome do parâmetro da query string
 * @param null $defaultValue
 *  Valor padrão a ser retornado caso o parâmetro da query string não seja encontrada
 * @param string $paramtype
 *  Tipo de parâmetro a ser lido 'get', 'post' e 'request'
 *
 * @since 1.0.0
 * @since 1.0.3 Adicionados IFs para impedir bugs e remover erros no PHP caso estejam com o E_ALL ligados
 *
 * @return string
 *  Retorna o valor específicado em $param ou, caso o parâmetro não exista, retornar null
 */
function ps_check( $param, $defaultValue = null, $paramtype = 'get' ) {
	if ( $paramtype == 'get' ) {
		if ( isset( $_GET[ $param ] ) ) {
			return ! is_null( $_GET[ $param ] ) ? $_GET[ $param ] : $defaultValue;
		} else {
			return $defaultValue;
		}
	} else if ( $paramtype == 'request' ) {
		if ( isset( $_REQUEST[ $param ] ) ) {
			return ! is_null( $_REQUEST[ $param ] ) ? $_REQUEST[ $param ] : $defaultValue;
		} else {
			return $defaultValue;
		}
	} else if ( $paramtype == 'post' ) {
		if ( isset( $_POST[ $param ] ) ) {
			return ! is_null( $_POST[ $param ] ) ? $_POST[ $param ] : $defaultValue;
		} else {
			return $defaultValue;
		}
	}
}

/**
 * Salva o conteúdo customCSS retornado do editor diretamente no banco de dados
 *
 * @param int $post_id
 *  ID do post
 * @param string $cssContent
 *  String completa do CSS
 *
 * @since 1.0.0
 * @return mixed
 *  Retorna o mesmo valor de ps_saveMeta
 */
function ps_saveCustomCSS( $post_id, $cssContent ) {
	return ps_saveMeta( $post_id, '_custom_css', $cssContent );
}

/**
 * Retorna o CSS customizado da página, aquele informado pelo usuário
 *
 * @param $post_id
 *  ID do post
 *
 * @since 1.0.0
 * @return string
 *  Retorna o código CSS formatado.
 */
function ps_getCustomCSS( $post_id ) {
	return ps_getMeta( $post_id, '_custom_css', false );
}

/**
 * Salva um array de estilos CSS
 *
 * @param int $post_id
 *  ID do post
 * @param array $css_array
 *  Array com os dados gerados pelo editor
 *
 * @since 1.0.0
 * @return mixed
 *  Retorna o mesmo valor de ps_saveMeta
 */
function ps_savepost_styles( $post_id, $css_array ) {

	$styles = ps_getpost_styles( $post_id );
	if ( $styles ) {
		//Adiciona linha a linha ao array já existente.
		foreach ( $css_array as $key => $css ) {
			$styles[0][ $key ] = $css;
		}

		ps_saveMeta( $post_id, '_styles', $css_array );
	} else {
		return ps_saveMeta( $post_id, '_styles', $css_array );
	}
}

/**
 * Retorna um array com todos os estilos da página em forma de array.
 *
 * @param int $post_id
 *  ID do post
 *
 * @since 1.0.0
 * @return array
 *  Retorna um array com todos os estilos registrados no banco de dados
 */
function ps_getpost_styles( $post_id ) {
	return ps_getMeta( $post_id, '_styles', false );
}

/**
 * Função de atalho para salvar uma nova informação de meta.
 *
 * @param int $post_id
 *  ID do post
 * @param string $metaname
 *  Nome da meta desejada (O sistema já realiza a junção com o metaprefix)
 * @param mixed $metavalue
 *  Valor a ser adicionado junto com o meta.
 * @param string $prev_value
 *  Valor anterior, apenas para fins de comparação
 *
 * @since 1.0.0
 * @return mixed
 *  Retorna o meta ID se ele não existe, caso contrário irá retornar true para sucesso e false para falha.
 *  caso o valor passado a esta função seja a mesma já registrada no banco de dados, a função irá retornar
 *  false.
 */
function ps_saveMeta( $post_id, $metaname, $metavalue, $prev_value = '' ) {
	return update_post_meta( $post_id, PAGESTUDIO_METAPREFIX . $metaname, $metavalue, $prev_value );
}

/**
 * Transforma um post ID em hash para ser a assinatura do sistema universal para todos os usuários
 *
 * @param int $post_id
 *  ID do post que será convertido em hash
 *
 * @since 1.0.0
 * @return string
 *  Retorna o hash do post
 */
function ps_hashid( $post_id ) {
	return substr( sha1( $post_id ), 0, 12 );
}

/**
 * Assina um post que foi editado ou criado pelo checkcms
 *
 * @param int $post_id
 *  ID do post que deve ser assinado
 *
 * @since 1.0.0
 * @return mixed
 *  Retorna o ID do meta caso não existe, caso contrário irá retornar true para sucesso e false para falha.
 *  caso o valor passado a esta função seja a mesma já registrada no banco de dados, a função irá retornar
 *  false.
 */
function ps_sign( $post_id ) {
	return ps_saveMeta( $post_id, '_sign', ps_hashid( $post_id ) );
}

/**
 * Verifica se a assinatura de um determinado post é valida para qualquer usuário
 *
 * @param int $post_id
 *  ID do post que está sendo validado
 *
 * @since 1.0.0
 * @return bool
 *  Retorna true ou false para a validação do post
 */
function ps_validate_sign( $post_id ) {
	$fromdb = ps_getMeta( $post_id, '_sign' );
	if (isset($fromdb[0])) {
		return ( $fromdb[0] == ps_hashid( $post_id ) );
	} else {
		return false;
	}
}

/**
 * Função de atalho para retornar meta posts relativos a páginas abertas pelo sistema.
 *
 * @param int $post_id
 *  ID do post
 * @param string $metaname
 *  Nome da meta desejada (O sistema já realiza a junção com o metaprefix)
 * @param bool|false $single
 *  True caso você deseja retornar um único valor
 *
 * @since 1.0.0
 * @return mixed
 *  Retorna uma string ou um objeto relativo a meta que foi pesquisada.
 */
function ps_getMeta( $post_id, $metaname, $single = false ) {
	return get_post_meta( $post_id, PAGESTUDIO_METAPREFIX . $metaname, $single );
}

/**
 * Esta função monta uma URL padrão para ser utilizada pelo sistema quando for acessar o CSS customizado
 * (gerado dinâmicamente pelo editor). Apenas utilizar esta função para retornar esta URL, não tente montá-la
 * manualmente.
 *
 * @param int $post_id
 *  ID do post base para gerar a URL
 *
 * @since 1.0.0
 * @return string
 * URL do Custom CSS
 */
function ps_customcss_url( $post_id ) {
	$cssQuery     = array( 'chkcustom' => 'pagecss', 'pid' => $post_id, 't' => wp_create_nonce( time() ) );
	$predefCssUrl = get_site_url() . '/?' . http_build_query( $cssQuery );

	return $predefCssUrl;
}

/**
 * Carrega todos os posts e páginas dentro do editor para escolha de links. Esta função é
 * apenas uma substituição a função do wp_links para uma versão melhor gerenciada pelo sistema.
 * @since 1.0.0
 * @return string
 *  Retorna a lista <li> de páginas e posts
 */
function ps_getPagePost() {
	$pages = get_pages( array(
		'sort_order'   => 'asc',
		'sort_column'  => 'post_title',
		'hierarchical' => 1,
		'post_type'    => 'page',
		'post_status'  => 'publish'
	) );

	$list = '';

	if ( count( $pages ) ) {
		foreach ( $pages as $p ) {
			$list .= '<li>
		<input class="item-permalink" value="' . $p->guid . '" type="hidden">
		<span class="pgs-item-title">' . $p->post_title . '</span>
		<span class="pgs-item-info">' . $p->post_type . '</span>
	</li>';
		}
	}

	$posts = get_posts();

	if ( count( $pages ) ) {
		foreach ( $posts as $ps ) {
			$list .= '<li>
		<input class="item-permalink" value="' . $ps->guid . '" type="hidden">
		<span class="pgs-item-title">' . $ps->post_title . '</span>
		<span class="pgs-item-info">' . $ps->post_type . '</span>
	</li>';
		}
	}

	return $list;

}

/**
 * Atalho para realização de postagem no sistema
 *
 * @param string $typePost
 *  Tipo de postagem que está sendo realizada, pode ser de qualquer tipo que esteja registrada no framework do wordpress
 *
 * @see https://codex.wordpress.org/Post_Status
 * @since 1.0.0
 * @return string
 *  Retorna uma string em json informando se o objeto foi ou não salvo
 */
function ps_post_page( $typePost ) {
	if ( isset( $_POST ) ) {
		//remove_filter( "the_content", "wpautop" );
		// Primeiramente o sistema precisa resgatar os dados do post, pois é necessário saber se ele já
		// foi publicado (no caso de esta função estar sendo chamada para salvar draft)
		$postData = get_post( ps_post( 'post' ), ARRAY_A );

		$postNew = array(
			'ID'           => ps_post( 'post' ),
			'post_status'  => ( $postData['post_status'] == 'publish' ? 'publish' : $typePost ),
			'post_title'   => ps_post( 'post_title' ),
			'post_content' => ps_post( 'pageContent' )
		);

		//Atualiza o post
		if ( wp_update_post( $postNew ) != 0 ) {
			//Retorna o CSSData que é um ARRAY e o salva como META do post, a verificação por IF é precisa
			// porque este post é feito pelo JQuery, e o valor padrão desta variável é "null", portanto,
			// se na hora que enviar o formulário ela for nula, o jquery irá excluir a variável do send.
			// Ler sem esse IF ocasionará em um exception.
			if ( ps_post( 'pageCSSData', false ) ) {
				ps_savepost_styles( ps_post( 'post' ), ps_post( 'pageCSSData' ) );
			}
			// Salva o custom CSS da página
			ps_saveCustomCSS( ps_post( 'post' ), ps_post( 'pageCustomCSS' ) );
			// Informa que este documento está sendo editado pelo Checkcms Frontend
			ps_saveMeta( ps_post( 'post' ), '_editedby', ps_post( 'from' ) );

			// Executa um hook para expandir o framework, ele pode ser utilizado para gravar metas depois
			// que o objeto for salvo e coisas do tipo, ele passa apenas o post_id como parâmetro.
			// TODO: Buscar alternativas, o método atual não funciona.
			do_action( 'chk_after_post', array( ps_post( 'post' ) ) );

			$output = array(
				'saved' => true
			);

			return json_encode( $output );
		} else {
			$output = array(
				'saved' => false
			);

			return json_encode( $output );
		}
	} else {
		$output = array(
			'saved' => false
		);

		return json_encode( $output );
	}
}

/**
 * Lista todas as fontes disponíveis no sistema
 *
 * @param bool|true $formatted
 *  Caso true, o valor retornado estará organizado em forma de LI, caso false, o valor retornado será um array.
 *
 * @since 1.0.0
 * @return array|null|string
 *  Caso $formatted seja true, o valor retornado será string, caso false, será array
 */
function ps_get_fonts( $formatted = true ) {
	$font_li  = null;
	$fontFile = PAGESTUDIO_PATH . '/assets/js/fbuilder.json';
	if ( file_exists( $fontFile ) ) {
		//Recupera o código JSON e o converte em array
		$font_data = json_decode( file_get_contents( $fontFile ), true );
		//Organiza todas as fontes utilizando a própria variável ps_sort do pagestudio
		//especial para organizar variáveis multisort
		$font_data['fonts'] = ps_sort('family', $font_data['fonts']);

		//Verifica se é necessário formatação como listagem
		if ( $formatted ) {
			foreach ( $font_data['fonts'] as $rf ) {
				$font_li .= '<li class="' . $rf['classname'] . '"><a href="#" font-name="' . $rf['family'] . '">' . $rf['family'] . '</a></li>';
			}
			return $font_li;
		} else {
			return $font_data;
		}
	} else {
		return $font_li;
	}
}

/**
 * Retorna todos os icones disponíveis no font-awesome, lidos através do arquivo icons.yml
 * convertido em json do source
 * @since 1.0.0
 * @return array
 *  Retorna um array completo, separando os icones por categorias, pois são mais de 600 e é o ideal.
 */
function ps_get_icons() {
	$iconfile  = PAGESTUDIO_PATH . '/assets/js/icons.json';
	$iconArray = array();
	if ( file_exists( $iconfile ) ) {
		//Recupera o código JSON e o converte em array
		$icon_data = json_decode( file_get_contents( $iconfile ), true );

		foreach ( $icon_data['icons'] as $f ) {
			foreach ( $f['categories'] as $c ) {
				$iconArray[ $c ][] = array(
					'id'   => 'fa-' . $f['id'],
					'name' => $f['name']
				);
			}
		}

		return $iconArray;
	}
}

/**
 * Verifica se uma determinada página está marcada como listagem de blog. Esta função é uma
 * alternativa ao is_front_page() do wordpress.
 *
 * @param int $id_post
 *  ID do post a ser verificado
 *
 * @since 1.0.0
 * @return bool
 *  True caso a página esteja marcada como post, ou false caso não esteja
 */
function ps_is_postpage( $id_post ) {
	return ( get_option( 'page_for_posts' ) == $id_post );
}

/**
 * Analisa uma página de forma a verificar se ela é elegível ou não para ser editada pelo checkcms
 * @issue https://bitbucket.org/checkmate/checkcms/issues/2/bugs-quando-voc-tenta-editar-uma-pagina
 * @since 1.0.0
 * @since 1.0.4
 *  Editor não faz mais diferenciação entre post e page, agora ele permite editar os dois
 * @since 1.0.6
 *  Adaptação para o editor poder editar mais de um tipo de posttype diferente
 *  Tamanho diferenciado do editor
 */
function ps_page_analyzer() {
	global $_PS_EDITOR_SIZE;
	//Esta função precisa rodar em toda a página do wordpress
	$screen = get_current_screen();
	if ( $screen->base == 'post' && ps_support_editor( $screen->post_type ) ) {
		$pageData = array();
		//Verifica se o action está informado
		if ( $screen->action == 'add' ) {
			//É uma página nova que está sendo adicionada, então o sistema apenas informa que é possível sim editar a página e que ela é nova
			$pageData['canEdit'] = true;
			$pageData['isNew']   = true;
		} else {
			// É preciso prevenir o editor aparecer para uma página aberta que está bloqueada (Naturalmente) por
			// ser uma página de apenas listagem de posts
			if ( ! ps_is_postpage( ps_get( 'post' ) ) ) {
				$pageData['canEdit'] = true;
				$pageData['isNew']   = false;
				$pageData['signed']  = ps_validate_sign( ps_get( 'post' ) );
				$pageData['id']      = ps_get( 'post' );
			} else {
				$pageData['canEdit'] = false;
				$pageData['isNew']   = false;
				$pageData['id']      = ps_get( 'post' );
			}
		}

		$pageData['h']          = $_SERVER['HTTP_HOST'];
		$pageData['perm']       = ps_get_permission( 'accesseditor' );
		$pageData['editortext'] = ps_trans( 'Open Page Studio' );
		$pageData['logo']       = PAGESTUDIO_PLUGIN_PATH . '/assets/img/menu_img_16.png';
		$pageData['config']     = admin_url( 'admin.php?page=' . PAGESTUDIO_SLUG . '-config' );
		$pageData['size'] = ps_get_editorsize($screen->post_type);

		return (object) $pageData;
	} else {
		return (object) array();
	}
}

/**
 * Verifica se a permissão de redirecionamento automátco para o editor está ativa
 * @since 1.0.0
 * @since 1.0.5
 *  Adaptado ao novo sistema de post_type multiplo
 */
function ps_redirect_activated() {
	global $post;
	if (!is_null($post)) {
		//$screen = get_current_screen();
		if ( ps_support_editor( $post->post_type ) ) {

			$querystring = array(
				'page'     => PAGESTUDIO_SLUG . '-post',
				'checkcms' => 'fulleditor',
				'pid'      => $post->ID,
				'ptype'    => $post->post_type,
			);

			//Verifica se o editor possui um tamanho em específico
			$editor_size = ps_get_editorsize( $post->post_type );
			if ( $editor_size != 'full' ) {
				$querystring['s'] = $editor_size;
			}

			if ( ps_get_permission( 'ignore-default-editor' ) ) {
				?>
				<script id="check_redirect" type="text/javascript">
					window.location = '<?php echo admin_url( 'admin.php?' . http_build_query( $querystring ) ); ?>';
				</script>
				<?php
			} else {
				$post_type_data = ps_posttype_data( $post->post_type );
				if ( $post_type_data->redirect ) {
					?>
					<script id="check_redirect" type="text/javascript">
						window.location = '<?php echo admin_url( 'admin.php?' . http_build_query( $querystring ) ); ?>';
					</script>
					<?php
				}
			}
		}
	}
}

/**
 * Verifica a post meta de "Edited By" de um determinado post_id para saber se ele está ou não sendo editado
 * pelo checkcms
 *
 * @param $post_id
 *  ID Do post a ser analizado
 *
 * @return bool
 * @deprecated Usar ps_validate_sign()
 * @issue https://bitbucket.org/checkmate/checkcms/issues/2/bugs-quando-voc-tenta-editar-uma-pagina
 * @since 1.0.0
 */
function ps_check_pageeditor( $post_id ) {
	$editedBy = ps_getMeta( $post_id, '_editedby' );
	if ( $editedBy ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Retorna em forma de string um widget completo, utilizado apenas para criação de componentes que
 * dependem de widgets do wordpress e de outros módulos.
 *
 * @param string $widget
 *  Nome do Widget
 *
 * @since 1.0.0
 * @return string
 *  Código HTMl do widget que está sendo pesquisado.
 */
function ps_get_widget( $widget ) {
	global $wp_widget_factory;
	if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $widget ] ) ) {

		ob_start();
		the_widget( $widget );
		$widget = ob_get_contents();
		ob_end_clean();

		return ( $widget ) ? $widget : '';
	}
}

/**
 * Esta função força uma página ao erro 404, chamada apenas quando um usuário está tentando acessar uma
 * página que apenas o editor deveria.
 * @since 1.0.0
 */
function ps_force_404() {
	if ( is_page() ) { // your condition
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	}
}

/**
 * Reseta todas as opções pertinentes apenas a esse plugin.
 * @since 1.0.0
 */
function ps_reset_options() {
	$allConfs = new \Checkcms\Internal\General();
	//Retorna todas as opções que devem ser instaladas junto com o plugin
	$configArray = $allConfs->getAllOptions();
	//Adiciona todas elas no banco de dados em looping
	foreach ( $configArray as $opKey => $opValue ) {
		update_option( $opKey, $opValue );
	}
}

/**
 * Retorna um valor interno dentro das configurações deste plugin
 *
 * @param string $param
 *  Parâmetro da opção a ser retornada
 * @param null $defaultValue
 *  Valor padrão a ser retornado, este valor será utilizado caso a opção não seja encontrada
 *
 * @since 1.0.0
 * @return null
 *  Retorna o valor da opção, caso ela exista, ou retorna o valor referido em $defaultValue.
 */
function ps_get_internal( $param, $defaultValue = null ) {
	$configValue = get_option( PAGESTUDIO_PREFIX . '-config' );
	if ( array_key_exists( $param, $configValue ) ) {
		return $configValue[ $param ];
	} else {
		return $defaultValue;
	}
}

/**
 * Atualiza um determinado valor interno que diz respeito apenas a este plugin
 *
 * @param string $param
 *  Nome da opção a ser registrada
 * @param mixed $value
 *  O valor a ser registrado
 *
 * @since 1.0.0
 * @return bool
 *  True caso o valor foi alterado ou false, caso não tenha sido alterado
 */
function ps_updt_internal( $param, $value ) {
	$configValue = get_option( PAGESTUDIO_PREFIX . '-config' );
	if ( array_key_exists( $param, $configValue ) ) {

		$configValue[ $param ] = $value;

		return update_option( PAGESTUDIO_PREFIX . '-config', $configValue );
	} else {
		//Se a chave não existe, então ela é criada
		$configValue [ $param ] = $value;

		return update_option( PAGESTUDIO_PREFIX . '-config', $configValue );
	}
}

/**
 * Informa se um editor está ou não sendo utilizado
 * @since 1.0.0
 * @return bool
 *  True para a página de edição estar sendo utilizada, e false para não
 */
function ps_in_editormode() {
	global $_EDITOR_BEINGUSED;

	return $_EDITOR_BEINGUSED;
}

/**
 * Informa se o editor está ou não sendo utilizado
 *
 * @param bool $editorInUse
 *  Valor relativo a utilização do editor.
 *
 * @since 1.0.0
 */
function ps_editor_status( $editorInUse ) {
	global $_EDITOR_BEINGUSED;
	$_EDITOR_BEINGUSED = $editorInUse;
}

/**
 * Adiciona um notice para ser lido quando a página receber um reload ou for redirecionada
 *
 * @param string $id
 *  ID do notice
 * @param string $text
 *  Texto a ser enviado
 * @param string $type
 *  Tipo de notice ('error', 'success', 'info', 'warning')
 * @param bool|false $dismissible
 *  Marcando esta opção como true, o notice aparecerá com um botão de fechar
 *
 * @since 1.0.0
 * @since 1.0.4 Adicionado o parâmetro $ID nas notices
 */
function ps_add_notice($id, $text, $type = 'success', $dismissible = false ) {

	//Cria o objeto Notice
	$notice = new \Checkcms\Internal\Notice($id, $text, $type, $dismissible);
	$registerNotice = new \Checkcms\Internal\Notices();
	$registerNotice->register_notice($notice);


	/*
	$ps_notices = new Checkcms\Internal\Notices();
	$ps_notices->register_notice('psp_test', $text, $type);

	add_action('admin_notices', array($ps_notices, 'add_admin_notice'));
	*/
}

/**
 * Informa se o site está rodando dentro de um servidor localhost
 * @since 1.0.0
 * @since 1.0.4.2
 *  Corrigido um problema onde o sistema registra o endereço de IP e não o nome correto do website.
 */
function ps_is_localhost() {

	$url = $_SERVER['HTTP_HOST'];

	if ( in_array( $url, array( '::1' ) ) ) {
		return true;
	}

	if ( preg_match( '/localhost([0-9\:]+)?/', $url ) ) {
		return true;
	}

	if ( preg_match( '/\b((2[0-4]\d|25[0-5]|[01]?\d\d?)\.){3}(2[0-4]\d|25[0-5]|[01]?\d\d?)\b/', $url ) ) {
		return true;
	}

	return false;
}

/**
 * Esta função é uma query direta na tabela de posts do wordpress, infelizmente esta função não utiliza o
 * WP_query ou o get_posts do wordpress devido alguns plugins modificarem a query utilizando inner joins e etc...
 * Esta função foi criada devido a necessidade de retornar posts que não eram visíveis devido a um plugin de
 * tradução modificar a query principal do SQL.
 *
 * @param string $post_type
 *  Tipo de post a ser recuperado 'page' ou 'post'
 * @param string $post_status
 *  O status do post, 'publish', 'draft' e etc... Padrões do wordpress
 * @param string $order
 *  A ordem de retorno da query, ASC ou DESC
 *
 * @since 1.0.0
 * @return array|null|object
 *  Retorna a listagem de post sem interferência de nenhum outro plugin
 */
function ps_get_posts( $post_type = 'page', $post_status = 'publish', $order = 'asc' ) {
	global $wpdb;
	$querystr = "select t.ID, t.post_title from wp_posts as t where t.post_status = '{$post_status}' and t.post_type = '{$post_type}' order by t.post_title {$order};";

	return $wpdb->get_results( $querystr, OBJECT );
}

/**
 * Cria uma URL direta para encaminhar o usuário diretamente para o frontend editor.
 *
 * @param $post_id
 *  ID do post para ser montada a URL
 * @param $type
 *  Tipo de página
 *
 * @return string|void
 *  URL completa
 * @since 1.0.4
 * @since 1.0.5
 *  Adaptado ao sistema de tamanhos do multipost
 */
function ps_generate_frontend_link( $post_id, $type ) {
	$editorqs = array(
		'page'     => PAGESTUDIO_SLUG . '-post',
		'checkcms' => 'fulleditor',
		'pid'      => $post_id,
		'ptype'    => $type
	);

	//Verifica se o editor possui um tamanho em específico
	$editor_size = ps_get_editorsize( $type );
	if ( $editor_size != 'full' ) {
		$editorqs['s'] = $editor_size;
	}

	return admin_url( 'admin.php?' . http_build_query( $editorqs ) );
}

/**
 * Verificações para saber se o link pode ou não aparecer na listagem principal
 * @param \WP_Post $post
 *   Post ID a ser verificado
 *
 * @return bool
 *  Retorna true|false para o aparecimento ou não do botão na listagem principal
 * @since 1.0.4
 * @since 1.0.6
 *  Adicionada a verificação para tipos diferenciados de post_type
 */
function ps_open_link( WP_Post $post ) {
	//Verifica se é a página que linka os posts
	if ( ps_is_postpage( $post->ID ) ) {
		return false;
	}

	//Permissão para acessar o editor
	if ( ! ps_get_permission( 'accesseditor' ) ) {
		return false;
	}

	//Verifica se o post é privado ou está na lixeira
	if (in_array(get_post_status(), array('private', 'trash'))) {
		return false;
	}

	//Verifica se o post_type está liberado para ser editado
	if (!ps_support_editor($post->post_type)) {
		return false;
	} else {
		if (!ps_editorlist_option($post->post_type)) {
			return false;
		}
	}

	//Verifica se o usuário pode editar posts
	if (!current_user_can('edit_post', $post->ID)) {
		return false;
	}

	//Se não travou em nada, então liberou
	return true;
}

function ps_frm_initialize() {
	global $ps_frm_initialize;

	if ( ! isset( $ps_frm_initialize ) ) {
		// Include Freemius SDK.
		require_once dirname( __FILE__ ) . '/freemius/start.php';

		$ps_frm_initialize = fs_dynamic_init( array(
			'id'               => '1582',
			'slug'             => 'pagestudio',
			'type'             => 'plugin',
			'public_key'       => 'pk_efcc3a747262e2a66c28a23547e06',
			'is_premium'       => false,
			'has_addons'       => false,
			'has_paid_plans'   => true,
			'menu'             => array(
				'slug'       => PAGESTUDIO_SLUG.'-about',
				'first-path' => 'admin.php?page='.PAGESTUDIO_SLUG.'-about',
				'support'    => false,
			),
		) );
	}

	return $ps_frm_initialize;
}
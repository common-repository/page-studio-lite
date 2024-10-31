<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.extensible.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 08/06/2016 - 15:30
*/

/**
 * Função responsável por registrar os arquivos CSS e JS que devem ser carregados na pré-visualização,
 * esta função é atrelada ao action hook 'chk_theme_dependencies'.
 * @hook chk_theme_dependencies
 */
function ps_preview_dependencies() {
	//Jquery UI para o Verge
	wp_enqueue_style( 'pagestudio-jquery-ui', 'https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css' );
	//Primeiramente insere o CSS principal que vai reger a maior parte dos elementos
	wp_enqueue_style( 'pagestudio-preview-styles', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.preview.min.css' );
	//Estilo responsável pela base de estilos da maioria dos elementos
	wp_enqueue_style( 'pagestudio-default-styles', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.default.min.css' );
	//Javascript responsável pelos controles padrões do plugin
	wp_enqueue_script( 'pagestudio-default-script', PAGESTUDIO_PLUGIN_PATH . '/assets/js/chk.min.js', '', '', true );

	//Carrega as informações padrões da página, caso tenha.
	$url = ps_customcss_url( ps_get( 'pid', null ) );
	wp_enqueue_style( 'pagestudio-predefined-styles', $url );
}
add_action( 'chk_preview_dependencies', 'ps_preview_dependencies' );

/**
 * Função responsável por registrar os arquivos CSS e JS que devem ser carregados na visualização final da página,
 * repare que esta função nada tem haver com a ps_preview_dependencies que carrega informações APENAS NA
 * PRÉ-VISUALIZAÇÃO DENTRO DO EDITOR.
 * @hook wp_enqueue_scripts (Wordpress default)
 */
function ps_theme_dependencies() {
	if ( isset( ps_getMeta( get_the_ID(), '_editedby' )[0] ) && ps_getMeta( get_the_ID(), '_editedby' )[0] == 'frontendeditor' ) {
		//Abre o jquery pois ele é extremamente necessário
		wp_enqueue_script( 'jquery' );
		//Estilo responsável pela estilização da página como grids, e etc...
		wp_enqueue_style( 'pagestudio-page-styles', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.page.min.css' );
		//Scripts padrões do tema
		wp_enqueue_script( 'pagestudio-default-script', PAGESTUDIO_PLUGIN_PATH . '/assets/js/chk.min.js', '', '', true );

		do_action( 'chk_theme_dependencies' );

		//ESTA LINHA PRECISA ENTRAR POR ULTIMO. Para que as alterações feitas pelo usuário tenham realmente efeito.
		$url = ps_customcss_url( get_the_ID() );
		wp_enqueue_style( 'pagestudio-predefined-styles', $url );
	}
}

/**
 * Função responsável por registrar todos os arquivos CSS e JS que devem ser carregados no editor
 * esta função é atrelada ao action hook 'chk_editor_dependencies'
 * @hook chk_editor_dependencies
 */
function ps_editor_dependencies() {
	//Registra o sistema de media e thickbox
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'tiny_mce' );
	wp_enqueue_script( 'media-upload' );

	wp_enqueue_script( 'thickbox' );
	wp_enqueue_style( 'thickbox' );

	//Adiciona a esquemática do editor
	wp_enqueue_style( 'pagestudio-editor-style', PAGESTUDIO_PLUGIN_PATH . '/assets/css/main.editor.min.css' );

	wp_enqueue_script( 'pagestudio-raphael', PAGESTUDIO_PLUGIN_PATH . '/assets/js/raphael-min.js' );
	wp_enqueue_script( 'pagestudio-main-ace', PAGESTUDIO_PLUGIN_PATH . '/assets/ace/ace.js', '', '', true );

	wp_enqueue_script( 'pagestudio-main-script', PAGESTUDIO_PLUGIN_PATH . '/assets/js/main.min.js', '', '', true );
	wp_enqueue_script( 'pagestudio-main-editor', PAGESTUDIO_PLUGIN_PATH . '/assets/js/editor.min.js', '', '', true );
	wp_enqueue_script( 'wp-link' );

	//Controla os botões do TinyMCE
	add_filter( 'mce_buttons', 'ps_tinymce_cleaner' );
}
add_action( 'chk_editor_dependencies', 'ps_editor_dependencies' );

/**
 * Cria uma validação que deve ser lida pelo CheckCMS Javascript para verificar se a página que está sendo editada
 * ou criada, tem credenciais válidas para isso.
 * @hook admin_head (Wordpress default)
 * @since 1.0.0
 * @issue https://bitbucket.org/checkmate/checkcms/issues/2/bugs-quando-voc-tenta-editar-uma-pagina
 */
function ps_page_availability() {
	?>
	<script id="check_post_auth" type="text/javascript">
		var chk_pageData = <?php echo json_encode( ps_page_analyzer() ); ?>;
	</script>
	<?php
}
add_action('admin_head', 'ps_page_availability');
add_action('admin_head', 'ps_redirect_activated'); //inc.general.php @620

/**
 * Gerencia as Notificações do sistema
 * @hook admin_notices (Wordpress default)
 * @since 1.0.0
 */
function ps_check_notices() {
	$ps_notices = new \Checkcms\Internal\Notices();
	$ps_notices->check_notices();
}
add_action('admin_notices', 'ps_check_notices');

function ps_other_styles() {
	wp_enqueue_style( 'pagestudio-main-style' );
}

/**
 * Força a remoção do wpautop da execução do wordpress tanto no preview da página dentro do editor,
 * como no render final, porém apenas das páginas, dos posts do blog, tudo continuará o mesmo.
 *
 * @param $content
 *  Conteúdo transferido pelo Wordpress
 *
 * @return string
 *  O Conteúdo formatado corretamente com os parágrafos corretos
 * @since 1.0.0
 */
function ps_wpautop( $content ) {
	if ( get_post_type() == 'post' ) {
		return wpautop( $content );
	} else {
		//no autop
		return $content;
	}
}
add_filter('the_content','ps_wpautop');

function ps_pagestudioad( $content ) {
	if ( isset( ps_getMeta( get_the_ID(), '_editedby' )[0] ) && ps_getMeta( get_the_ID(), '_editedby' )[0] == 'frontendeditor' ) {
		if (ps_get_internal('pagestudiosign', false)) {
			$aftercontent = '<span class="ps_powered">Powered by <a href="' . PAGESTUDIO_PREMIUM_URL . '" target="_blank">PageStudio</a>.</span>';
			$fullcontent  = null;

			if ( is_page() || is_single() ) {
				$fullcontent = $content . $aftercontent;
			} else {
				$fullcontent = $content;
			}

			return $fullcontent;
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}
add_filter('the_content', 'ps_pagestudioad');

/**
 * Adiciona um link para o editor dentro da listagem de posts e páginas
 *
 * @param $actions
 *  Array de links retornados pelo Wordpress
 *
 * @return mixed
 * @since 1.0.4
 */
function ps_page_row( $actions ) {
	$post = get_post();

	//Verificações do sistema
	if ( ps_open_link( $post ) ) {
		$finallink          = ps_generate_frontend_link( $post->ID, $post->post_type );
		$actions['edit_ps'] = sprintf( '<a href="%s">%s</a>', $finallink, ps_trans( 'Open in PageStudio Editor' ) );
	}

	return $actions;
}
add_filter('page_row_actions', 'ps_page_row');
add_filter('post_row_actions', 'ps_page_row');

/**
 * Adiciona novos links no editor do wordpress tanto no backend quanto no frontend
 *
 * @param \WP_Admin_Bar $wp_admin_bar
 *  Objeto do admin bar retornado pelo wordpress
 *
 * @since 1.0.4
 */
function ps_admin_menulink( WP_Admin_Bar $wp_admin_bar ) {
	if ( ! is_object( $wp_admin_bar ) ) {
		global $wp_admin_bar;
	}

	$post = get_post();

	if ( is_singular() ) {
		if ( ps_open_link( $post ) ) {
			$wp_admin_bar->add_menu( array(
				'id'    => 'pagestudio-frontendeditor',
				'title' => ps_trans( 'Edit Using PageStudio' ),
				'href'  => ps_generate_frontend_link( $post->ID, 'page' ),
				'meta'  => array( 'class' => 'pagestudio-admin-link' ),
			) );
		}
	}

	if ( current_user_can( 'edit_pages' ) && ps_get_permission( 'accesseditor' ) ) {
		$wp_admin_bar->add_node( array(
			'parent' => 'new-content',
			'id'     => 'pagestudio-newpage',
			'title'  => ps_trans( 'New Page with PageStudio' ),
			'href'   => admin_url( 'admin.php?page=' . PAGESTUDIO_SLUG . '-post' )
		) );
	}
}
add_action('admin_bar_menu', 'ps_admin_menulink', 1000);
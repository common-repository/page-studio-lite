<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* _menu.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 20/05/2016 - 15:28
*/


/**
 * Registra um novo menu dentro do sistema permitindo que o usuário possa controlar o plugin de dentro dele.
 * @since 1.0.0
 */
function ps_settings_menu() {
	//Carrega os scripts padrões registrados
	ps_mainmenu();

}
add_action( 'admin_menu', 'ps_settings_menu' );

/**
 * Cria o sistema de rotas para o controle do menu montado diretamente pelo sistema
 * @since 1.0.0
 */
function ps_system_router() {
	// Retorna os detalhes atuais do Screen
	$screen = get_current_screen();

	if ( strpos( $screen->base, PAGESTUDIO_SLUG . '-post' ) !== false ) {
		//Executa todas as dependências do editor
		do_action( 'chk_editor_dependencies' );
		//Roda o editor
		include( PAGESTUDIO_BIN . '/editor/frontend.editor.php' );
	} elseif ( strpos( $screen->base, PAGESTUDIO_SLUG . '-config' ) !== false ) {
		do_action( 'chk_plugin_pages' );
		include( PAGESTUDIO_BIN . '/pages/page.config.php' );
	} elseif ( strpos( $screen->base, PAGESTUDIO_SLUG . '-permissions' ) !== false ) {
		do_action( 'chk_plugin_pages' );
		include( PAGESTUDIO_BIN . '/pages/page.config.access.php' );
	} elseif ( strpos( $screen->base, PAGESTUDIO_SLUG . '-types' ) !== false ) {
		do_action( 'chk_plugin_pages' );
		include( PAGESTUDIO_BIN . '/pages/page.config.types.php' );
	} elseif ( strpos( $screen->base, PAGESTUDIO_SLUG . '-about' ) !== false ) {
		include( PAGESTUDIO_BIN . '/pages/page.about.php' );
	}
}

/**
 * Função que cria o menu principal dentro do toolbar do wordpress
 * @since 1.0.0
 */
function ps_mainmenu() {

	//Primeiro é necessário saber se o usuário possui permissão de acessar
	$capability = 'manage_options';
	//Agora o sistema prepara o Icone do Plugin
	$icon = PAGESTUDIO_PLUGIN_PATH . '/assets/img/menu_img_16.png';

	$protoHook = add_menu_page(
		ps_trans( 'Page Studio' ),
		ps_trans( 'Page Studio' ),
		$capability,
		PAGESTUDIO_SLUG . '-about',
		'ps_system_router',
		$icon,
		PAGESTUDIO_MENU_POS
	);

	// Para acessar o front end corretamente, o usuário precisa ter tanto o capability do wordpress para editar
	// páginas, como também precisa ter a permissão de acesso ao editor nas permissões do Page Studio
	if ( current_user_can( 'edit_pages' ) && ps_get_permission( 'accesseditor' ) ) {
		add_submenu_page(
			'edit.php?post_type=page',
			ps_trans( 'Page Studio' ),
			ps_trans( 'New PageStudio Page' ),
			'edit_pages',
			PAGESTUDIO_SLUG . '-post',
			'ps_system_router'
		);
	}

	if ( ps_get_permission( 'configpage' ) ) {
		add_submenu_page(
			PAGESTUDIO_SLUG . '-about',
			ps_trans( 'Page Studio' ),
			ps_trans( 'Configuration' ),
			$capability,
			PAGESTUDIO_SLUG . '-config',
			'ps_system_router'
		);

		add_submenu_page(
			PAGESTUDIO_SLUG . '-about',
			ps_trans( 'Page Studio' ),
			ps_trans( 'Post Types' ),
			$capability,
			PAGESTUDIO_SLUG . '-types',
			'ps_system_router'
		);
	}

	if ( ps_get_permission( 'changepermission' ) ) {
		add_submenu_page(
			PAGESTUDIO_SLUG . '-about',
			ps_trans( 'Page Studio' ),
			ps_trans( 'Permissions' ),
			$capability,
			PAGESTUDIO_SLUG . '-permissions',
			'ps_system_router'
		);
	}

}

/**
 * Gera a tabela de navegação no menu de opções
 * @since 1.0.0
 */
function ps_settings_tab() {
	$menuOptions = array(
		PAGESTUDIO_SLUG . '-config'      => array(
			'name'       => ps_trans( 'Configurations' ),
			'permission' => 'configpage'
		),
		PAGESTUDIO_SLUG . '-types' => array(
			'name'       => ps_trans( 'Post Types' ),
			'permission' => 'configpage'
		),
		PAGESTUDIO_SLUG . '-permissions' => array(
			'name'       => ps_trans( 'Permissions' ),
			'permission' => 'changepermission'
		)
	);
	?>
	<h2 class="nav-tab-wrapper">
		<?php
		foreach ( $menuOptions as $k => $v ) {
			if ( ps_get_permission( $v['permission'] ) ) {
				echo '<a class="nav-tab' . ( ps_get( 'page' ) == $k ? ' nav-tab-active' : '' ) . '" href="' . admin_url( 'admin.php?page=' . $k ) . '">' . $v['name'] . '</a>';
			}
		}
		?>
	</h2>
	<?php
}


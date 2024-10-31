<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _actions.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/06/2016 - 17:25
 */

if (ps_post('act', false)) {
	//Publica um novo post
	if ( ps_post( 'act' ) == 'post' && ps_post( 'from' ) == 'frontendeditor' ) {
		echo ps_post_page( 'publish' );
		exit;
		//Salvamentos automáticos do editor, e também o save-draft original
	} else if ( ps_post( 'act' ) == 'draft' && ps_post( 'from' ) == 'frontendeditor' ) {
		echo ps_post_page( 'draft' );
		exit;
	} else if ( ps_post( 'act' ) == 'cdat' && ps_post( 'from' ) == 'frontendeditor' ) {

		ps_updt_internal( ps_post( 'configname' ), ( ps_post( 'configvalue' ) === 'true' ? true : false ) );

		echo json_encode( array( 'saved' => true ) );
		exit;
	} else if ( ps_post( 'act' ) == 'cusr' && ps_post( 'from' ) == 'frontendeditor' ) {

		add_user_meta( get_current_user_id(), ps_post( 'configname' ), ps_post( 'configvalue' ), true );

		echo json_encode( array( 'saved' => true ) );
		exit;
		//Página de configuração
	} else if ( ps_post( 'act' ) == 'config' ) {
		if ( check_admin_referer( ps_post( 'wp_ref' ) ) ) {

			ps_updt_internal( 'editorautosave', ( ps_post( 'config' )['editorautosave'] ? true : false ) );
			ps_updt_internal( 'pagestudiosign', ( ps_post( 'config' )['pagestudiosign'] ? true : false ) );
			ps_updt_internal( 'blankspace', ( ps_post( 'config' )['blankspace'] ? true : false ) );
			ps_updt_internal( 'helpsys', ( ps_post( 'config' )['helpsys'] ? true : false ) );
			ps_updt_internal( 'autosavetimer', ps_post( 'config' )['autosavetimer'] );

			ps_add_notice( PAGESTUDIO_METAPREFIX . '-config', ps_trans( 'Configurations Saved.' ) );
		} else {
			ps_add_notice( PAGESTUDIO_METAPREFIX . '-config', ps_trans( 'Failed to save, try again later.' ), 'error' );
		}

		wp_redirect( admin_url( 'admin.php?page=' . ps_post( 'wp_ref' ) ) );
		exit;
		//Página de permissões.
	} else if ( ps_post( 'act' ) == 'perm' ) {
		if ( check_admin_referer( ps_post( 'wp_ref' ) ) ) {

			ps_updt_internal( 'usepermission', ( ps_post( 'config' )['usepermission'] ? true : false ) );
			ps_add_notice( PAGESTUDIO_METAPREFIX . '-config', ps_trans( 'Permissions Saved.' ) );
		} else {
			ps_add_notice( PAGESTUDIO_METAPREFIX . '-config', ps_trans( 'Failed to save, try again later.' ), 'error' );
		}

		wp_redirect( admin_url( 'admin.php?page=' . ps_post( 'wp_ref' ) ) );
		exit;
	} else if (ps_post('act') == 'pstype') {
		//Página de post types
		if ( check_admin_referer( ps_post( 'wp_ref' ) ) ) {

			foreach($_POST['config'] as $post_type => $permissions) {
				if ($permissions['activated'] == 'y') {

					$perm = ps_element_atts(array(
						'inlist'        => true,
						'clone'         => false,
						'instaredirect' => false,
					),$permissions);
					ps_add_supported_posttype($post_type, $perm);

				} else {
					ps_remove_supported_posttype($post_type);
				}
			}

			ps_add_notice( PAGESTUDIO_METAPREFIX . '-config', ps_trans( 'Changes Saved.' ) );
		}

		wp_redirect( admin_url( 'admin.php?page=' . ps_post( 'wp_ref' ) ) );
		exit;
	}
}

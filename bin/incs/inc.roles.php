<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.roles.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 08/07/2016 - 12:50
*/

/**
 * Retorna todas as roles registradas no sistema
 * @since 1.0.0
 * @return array|null
 *  Retorna um array com todas as roles registradas no sistema, ou, null caso nenhuma seja encontrada.
 */
function ps_get_roles() {
	if ( ! function_exists( 'get_editable_roles' ) ) {
		include_once( ABSPATH . "/wp-admin/includes/user.php" );
	}
	$roleList = null;
	$allRoles = get_editable_roles();
	foreach ( $allRoles as $key => $data ) {
		$roleList[ $key ] = $data['name'];
	}

	return $roleList;
}

/**
 * Adiciona permissão a um determinado componente
 *
 * @param string $role
 *  Nome da role a ser adicionada a permissão
 * @param Array $component
 *  Nome do componente a ser associado a uma determinada role
 *
 * @since 1.0.0
 * @return bool
 *  Retorna true caso o objeto tenha sido associado corretamente, ou false, caso alum problema tenha
 *  ocorrido. Únicos possíveis problemas são: Role não encontrada, e ID do componente não encontrado.
 */
function ps_add_permission( $role, Array $component ) {
	$roleData = get_role( $role );
	if ( ! is_null( $roleData ) ) {
		//Retorna a lista de permissões do usuário registrada
		$permissionList = ps_get_internal( 'permissionlist' );
		//Adiciona ou substitui a lista existente por esta
		$permissionList[$role] = $component;
		return ps_updt_internal( 'permissionlist', $permissionList );

	} else {
		return false;
	}
}

/**
 * Verifica se um determinado componente está acessível ao usuário logado
 *
 * @param string $component
 *  ID do componente
 * @param string|null $role
 *  Role a ser verificada, caso null seja passado será verificado as roles do usuário logado
 *
 * @since 1.0.0
 * @return bool
 *  Retorna true caso o componente esteja acessível ao usuário logado, ou false, caso não esteja
 */
function ps_get_permission( $component, $role = null ) {

	//Esse arquivo precisa apenas ser carregado aqui, em nenhum outro lugar
	if ( ! function_exists( 'wp_get_current_user' ) ) {
		include_once( ABSPATH . "wp-includes/pluggable.php" );
	}

	global $current_user;

	//Primeiramente o sistema verifica para saber se o sistema está ou não utilizando o sistema de permissão
	if ( ps_get_internal( 'usepermission' ) ) {
		//Está usando, então é feito todo o esquema
		$permissionList = ps_get_internal( 'permissionlist' );

		if ( ! is_null( $permissionList ) ) {
			if ( is_null( $role ) ) {
				wp_get_current_user();
				if ( ! empty( $current_user->roles ) && is_array( $current_user->roles ) ) {
					foreach ( $current_user->roles as $rl ) {
						if ( array_key_exists( $rl, $permissionList ) ) {
							if ( array_key_exists( $component, $permissionList[ $rl ] ) ) {
								return true;
							}
						}
					}
				}
			} else {
				if ( array_key_exists( $component, $permissionList[ $role ] ) ) {
					return true;
				}
			}
		}

		//Caso tudo falhe, retorna false
		return false;
	} else {
		//Não está usando, então o sistema sempre torna true, caso seja um component
		$gen     = new \Checkcms\Internal\General();
		$allPerm = $gen->defaultPermissions();
		// Esta verificação é necessária porque nem todas as permissões padrões são consideradas true,
		// nem mesmo são registradas
		if ( array_key_exists( $component, $allPerm ) ) {
			return $allPerm[ $component ]['default'];
		} else {
			return true;
		}
	}
}

/**
 * Retorna todas as permissões disponíveis no sistema
 * @since 1.0.0
 * @return array|null
 */
function ps_all_permissions() {
	global $_EDITOR_COMPONENTS;
	$permissionArray = array();

	//Permissões referentes ao sistema e padronizações
	$gen = new \Checkcms\Internal\General();

	foreach ( $gen->defaultPermissions() as $id => $dt ) {
		array_push( $permissionArray, $id );
	}

	//Permissões referentes a componentes
	foreach ( $_EDITOR_COMPONENTS as $x ) {
		array_push( $permissionArray, $x['id'] );
	}

	return $permissionArray;
}

/**
 * Retorna o nome de uma permissão padrão pelo ID
 *
 * @param string $id
 *  ID da permissão padrão
 *
 * @since 1.0.0
 * @return string
 *  Nome real da permissão padrão
 */
function ps_defaultper_name( $id ) {
	$gen                = new \Checkcms\Internal\General();
	$defaultPermissions = $gen->defaultPermissions();

	return $defaultPermissions[ $id ]['name'];
}

/**
 * Retorna a propriedade padrão de uma determinada função
 *
 * @param string $id
 *  ID da permissão padrão
 *
 * @since 1.0.0
 * @return bool
 */
function ps_permission_default( $id ) {
	$gen                = new \Checkcms\Internal\General();
	$defaultPermissions = $gen->defaultPermissions();

	if (array_key_exists($id, $defaultPermissions)) {
		return $defaultPermissions[ $id ]['default'];
	} else {
		return true;
	}
}

/**
 * Retorna todas as permissões disponíveis a uma role específica
 *
 * @param string $role
 *  Nome da role
 *
 * @since 1.0.0
 * @return array|null
 *  Array completo com todas as permissões listadas a uma determinada role
 */
function ps_role_permissions( $role ) {
	$permissionList = ps_get_internal( 'permissionlist' );
	if ( array_key_exists( $role, $permissionList ) ) {
		return $permissionList[ $role ];
	} else {
		return null;
	}
}

/**
 * Reseta todas as permissões do sistema
 * @since 1.0.0
 */
function ps_reset_all_permissions() {
	$permissionArray = null;
	foreach ( ps_get_roles() as $k => $v ) {
		$permissionArray[ $k ] = array();

		foreach ( ps_all_permissions() as $key ) {
			if ( ps_permission_default( $key ) ) {
				$permissionArray[ $k ][$key] = true;
			}
		}
	}

	ps_updt_internal( 'permissionlist', $permissionArray );
}
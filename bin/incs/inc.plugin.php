<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.plugin.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 22/05/2016 - 21:52
*/

/**
 * Executa a incialização do plugin junto com o init do wordpress
 * @since 1.0.0
 */
function ps_initialize_plugin() {
	//Plugins internos do editor
	require_once( PAGESTUDIO_BIN . '_internal.php' );

	//Inicialização dos componentes logo após a inicialização do sistema e do carregamento das linguagens
	ps_render_component_sources();

	if ( is_admin() && get_option( PAGESTUDIO_PREFIX . '-installed', false ) ) {
		// Tudo que vai ser carregado dentro do administrador, caso o sistema esteja sendo
		// acessado de dentro do administrador e que tenha sido instalado com sucesso
		require_once( PAGESTUDIO_BIN . 'class/class.Notices.php' );
		require_once( PAGESTUDIO_BIN . 'class/Interface/int.EditorInferface.php' );
		require_once( PAGESTUDIO_BIN . 'class/class.editorbase.php' );
		require_once( PAGESTUDIO_BIN . 'class/class.EditorMessage.php' );
		require_once( PAGESTUDIO_BIN . 'class/class.frontend.php' );

		require_once( PAGESTUDIO_BIN . 'incs/inc.plugin.php' );
		require_once( PAGESTUDIO_BIN . 'incs/inc.update.php' );

		require_once( PAGESTUDIO_BIN . '_queue.php' );
		require_once( PAGESTUDIO_BIN . '_menu.php' );

		//Controle de actions do plugin que funcionam APENAS no admin
		require_once( PAGESTUDIO_BIN . '_actions.php' );

		//Para chamar qualquer objeto que precise ser executado via ajax
		do_action( 'chk_editor_ajax' );

		//Controle dos ajax que são realizados pelo editor
		require_once( PAGESTUDIO_BIN . '_ajax.php' );

	} else {
		require_once( PAGESTUDIO_BIN . 'incs/inc.shortcodes.php' );
		require_once( PAGESTUDIO_BIN . 'class/class.editorpreview.php' );
		require_once( PAGESTUDIO_BIN . 'class/class.customcss.php' );

		$preview = new \Checkcms\Editor\EditorPreview();
		$preview->Check();
	}
}

/**
 * Realiza a definição do custom CSS da página
 * @since 1.0.6
 */
function ps_custom_css() {
	require_once( PAGESTUDIO_BIN . '_custom.php' );
}

/**
 * Realiza a verificação de suporte dos postypes do sistema, isso deve ser executado depois do init
 * @since 1.0.6
 */
function ps_type_supporting() {
	global $_PS_EDIT_PERMITED;

	$cfg = get_option( PAGESTUDIO_PREFIX . '-config' );
	if (!isset($cfg['supportedtypes'])) {
		//Atualização para instalações antigas do pagestudio
		ps_add_supported_posttype(array('page', 'post'));
	}
}

/**
 * Registra um novo componente no editor que pode ser arrastado ou utilizado como elemento pré-definido
 * ou até mesmo template, esta função serve para calls inclusive fora do plugin. Esta função facilita a
 * utilização do sistema de templates utilizado pelo editor.
 *
 * @param string $component_id
 *  ID de identificação do componente, é a referência do template que será utilizada para abrir a
 *  janela. O padrão de texto deve ser seguido como: [a-zA-Z0-9_-]+
 * @param string $component_type
 *  Tipo de componente que será inserido, os valores inseridos aqui devem corresponder a:
 *  predef, elements, components, templates. Não é possível inserir nada em Layouts.
 * @param array $component_data
 *  Array com os parâmetros do componente que está sendo registrado
 * @param bool|true $in_list
 *  True para um componente que será listado e false para um componente mantido como hidden
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return bool
 *  Retorna o estado de registro do componente
 */
function ps_register_component( $component_id, $component_type, array $component_data, $in_list = true ) {
	//Apenas para se certificar que ninguém está tentando inserir nada dentro do layouts
	if ( strtolower( $component_type ) != 'layouts' ) {
		return ps_int_register_component( $component_id, $component_type, $component_data, $in_list );
	}
}

/**
 * Função interna do registro de componentes, por favor, utilize a função ps_register_component()
 *
 * @see ps_register_component()
 *
 * @param string $component_id
 *  ID de identificação do componente, é a referência do template que será utilizada para abrir a
 *  janela. O padrão de texto deve ser seguido como: [a-zA-Z0-9_-]+
 * @param string $component_type
 *  Tipo de componente que será inserido, os valores inseridos aqui devem corresponder a:
 *  predef, elements, components, templates. Não é possível inserir nada em Layouts.
 * @param array $component_data
 *  Array com os parâmetros do componente que está sendo registrado
 * @param bool|true $in_list
 *  True para um componente que será listado e false para um componente mantido como hidden
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return bool
 *  Retorna o estado de registro do componente
 */
function ps_int_register_component( $component_id, $component_type, $component_data, $in_list = true ) {
	global $_EDITOR_COMPONENTS;
	if ( preg_match( '/^[a-zA-Z0-9_-]+$/', $component_id ) ) {

		//Aqui é registrado a variável com os valores padrão do data type
		$defaultOpt = array(
			'name'         => null,
			'ico'          => null,
			'editor'       => array( 'transform' ),
			'default'      => null,
			'target'       => null,
			'model'        => null,
			'defaultClass' => array(),
			'html'         => null,
			'noContent'    => false,
			'widget'       => false,
			'widget-name'  => null,
		);

		$options = ps_element_atts( $defaultOpt, $component_data );

		//Gera a Array para inclusão
		$comp = array(
			'id'     => $component_id,
			'type'   => $component_type,
			'render' => 'text/x-jsrender',
			'listed' => $in_list,
			'data'   => $options
		);

		//Adiciona a lista final
		array_push( $_EDITOR_COMPONENTS, $comp );

		return true;
	} else {
		return false;
	}
}

/**
 * Retorna todos os componentes registrados apartir de um type específico formatados em forma de
 * <li> para carregar no editor
 *
 * @see ps_register_component()
 *
 * @param string $component_type
 *  Tipo de componente, por padrão o valor é all, o que significa que todos os componentes serão impressos
 *  sem filtros, caso contrário, os valores aceitos são: predef, elements, components, templates.
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return null|string
 */
function ps_get_components( $component_type = 'all', $showTitle = true ) {
	global $_EDITOR_COMPONENTS;

	$lielement = null;
	if ( $component_type == 'all' ) {
		foreach ( $_EDITOR_COMPONENTS as $el ) {
			if ( $el['listed'] ) {
				if ( ps_get_internal( 'usepermission', false ) ) {
					if ( ps_get_permission( $el['id'] ) ) {
						$lielement .= ps_render_complist( $el, $showTitle );
					}
				} else {
					$lielement .= ps_render_complist( $el, $showTitle );
				}
			}

		}
	} else {
		foreach ( $_EDITOR_COMPONENTS as $el ) {
			if ( $el['type'] == $component_type ) {
				if ( $el['listed'] ) {
					if ( ps_get_internal( 'usepermission', false ) ) {
						if ( ps_get_permission( $el['id'] ) ) {
							$lielement .= ps_render_complist( $el, ( $component_type != 'predef' ) );
						}
					} else {
						$lielement .= ps_render_complist( $el, ( $component_type != 'predef' ) );
					}
				}
			}
		}
	}

	return $lielement;
}


/**
 * Unifica a renderização da listagem de componentes
 *
 * @param array $el
 *  Array do componente
 * @param bool $showTitle
 *  Exibe o título do objeto
 *
 * @since 1.0.0
 * @return string
 *  Retorna o código HTML da listagem
 */
function ps_render_complist( $el, $showTitle ) {
	//Icone padrão caso não exista uma imagem para o componente
	$defaultIco = PAGESTUDIO_PLUGIN_PATH . '/assets/img/defaultComponent.png';
	if (is_null($el['data']['ico']) || $el['data']['ico'] == '') {
		$iconImage = $defaultIco;
	} else {
		$iconImage = $el['data']['ico'];
	}

	$li = '<li' . ( $showTitle ? ' class="tooltip" title="' . $el['data']['name'] . '" ' : '' ) . ' data-component="' . $el['id'] . '"' . ( ! is_null( $el['data']['default'] ) ? ' data-default="' . $el['data']['default'] . '"' : '' ) . ' data-name="' . $el['data']['name'] . '">
		<img src="' . $iconImage . '">
		' . ( $showTitle ? '<h4>' . ps_trans($el['data']['name']) . '</h4>' : '' ) . '
    </li>';

	return $li;
}

/**
 * Verifica se um determinado controle possui componentes.
 *
 * @param string $component_type
 *  ID do componente a ser verificado. Por padrão o valor é 'all', indicando todos os controles
 *
 * @since 1.0.0
 * @return bool
 *  Retorna true caso o controle possui componentes, e false caso não tenha
 */
function ps_have_components( $component_type = 'all' ) {
	global $_EDITOR_COMPONENTS;
	$numberOfComponents = 0;

	if ( $component_type == 'all' ) {
		foreach ( $_EDITOR_COMPONENTS as $el ) {
			if ( $el['listed'] ) {
				$numberOfComponents ++;
			}
		}
	} else {

		foreach ( $_EDITOR_COMPONENTS as $el ) {
			if ( $el['type'] == $component_type ) {
				if ( $el['listed'] ) {
					$numberOfComponents ++;
				}
			}
		}
	}

	return ( $numberOfComponents > 0 ? true : false );
}

/**
 * Combina os valores conhecidos padrões dos atributos de um elemento, com aquilo que foi informado pelo
 * usuário na criação dos plugins. O valor retornado sempre será os valores filtrados no atributo $pairs,
 * caso o valor não conste na variável enviada pelo usuário, será utilizado o valor padrão. Valores
 * informados que não estejam na lista em $pairs serão ignorados.
 *
 * @param array $pairs
 *  Lista completa dos atributos e seus valores padrões
 * @param array $atts
 *  Lista dos atributos alterados pelo usuário
 *
 * @since 1.0.0
 * @return array
 *  Array filtrado de atributos e valores corretos
 */
function ps_element_atts( $pairs, $atts ) {
	$atts = (array) $atts;
	$out  = array();
	foreach ( $pairs as $name => $default ) {
		if ( array_key_exists( $name, $atts ) ) {
			$out[ $name ] = $atts[ $name ];
		} else {
			$out[ $name ] = $default;
		}
	}

	return $out;
}

/**
 * Transforma um array de elementos em algo simples que pode ser lido pelo editor (sem estar no formato Json)
 *
 * @param array $array
 *  Array de atributos
 *
 * @since 1.0.0
 * @return string
 *  Retorna uma string formatada
 */
function ps_convert_readable( Array $array ) {
	return '[' . implode( ',', $array ) . ']';
}

/**
 * Gera uma tag base de elemento criando shortcodes caso tenha
 *
 * @param array $elementData
 *  Array com as atribuições do elemento
 * @param array $permissions
 *  Array base de permissões que um elemento possui
 * @param string $htmlData
 *  Valor HTML a ser inserido, caso nulo será inserido o valor padrão de $elementData
 *
 * @since 1.0.0
 * @return string
 *  HTML do elemento final
 */
function ps_element_base(
	$elementData, $htmlData = null, $permissions = array(
	'Move',
	'Edit',
	'Clone',
	'Delete'
)
) {
	$defaultArrayData = array(
		'name'         => null,
		'ico'          => null,
		'editor'       => array( 'transform' ),
		'default'      => null,
		'model'        => 'default_shortcode',
		'target'       => null,
		'defaultClass' => array(),
		'noContent'    => false,
		'widget'       => false,
		'widget-name'  => null,
		'html'         => ''
	);

	//Realiza a verificação dos elementos inseridos, com o elemento padrão para verificar quais opções foram editadas
	$dataOut = ps_element_atts( $defaultArrayData, $elementData['data'] );
	//Gera um array padrão dos atributos que serão registrados no Elemento DOM
	$elementAttr = array();

	//Adiciona as classes iniciais
	$elementAttr['class'] = "chk_element chk_element_int";

	//Verifica se as permissões são realmente um array (caso o usuário tenha passado alguma outra coisa
	if ( is_array( $permissions ) ) {
		$elementAttr['data-can'] = ps_convert_readable( $permissions );
	}

	if ( ! is_null( $dataOut['target'] ) ) {
		$elementAttr['data-target'] = $dataOut['target'];
	}

	$elementAttr['data-edit']    = ps_convert_readable( $dataOut['editor'] );
	$elementAttr['data-mdl']     = $dataOut['model'];
	$elementAttr['data-element'] = $dataOut['name'];
	$elementAttr['data-content'] = ( $dataOut['noContent'] ? 'false' : 'true' );

	if ( ! is_null( $dataOut['default'] ) ) {
		$elementAttr['data-default'] = $dataOut['default'];
	}

	$dom        = new DOMDocument( '1.0' );
	$elementDiv = $dom->createElement( 'div', '%s' );

	foreach ( $elementAttr as $key => $value ) {
		$attribute        = $dom->createAttribute( $key );
		$attribute->value = $value;
		$elementDiv->appendChild( $attribute );
	}

	$dom->appendChild( $elementDiv );

	if ( ! is_null( $htmlData ) ) {
		return sprintf( $dom->saveHTML(), $htmlData );
	} else {
		if ( $dataOut['widget'] ) {
			$contentChange = sprintf( $dataOut['html'], ps_get_widget( $dataOut['widget-name'] ) );

			return sprintf( $dom->saveHTML(), $contentChange );
		} else {
			return sprintf( $dom->saveHTML(), $dataOut['html'] );
		}
	}
}

/**
 * Registra um código de modelo que será utilizado nos elementos criados para referencias de classes
 * CSS auto-geradas. Essas classes auto-geradas serão criadas através de um arquivo que irá organizar
 * todo o sistema de CSS de um determinado post. As classes geradas serão do modelo: "chk_defined_8e44bd33fab62"
 * sendo que chk_defined_ é o prefixo, e o sufixo é a informação gerada por esta função.
 * @since 1.0.0
 * @return string
 *  Código do modelo único.
 */
function ps_genModel() {
	return substr( uniqid( md5( rand() ), true ), 0, 7 );
}

/**
 * Registra os componentes no footer da página utilizando o renderizador jsrender. Esta função
 * deve ser chamada APENAS utilizando o hook 'admin_footer' do add_action();
 *
 * @param string $component_type
 *  Tipo de componente, por padrão o valor é all, o que significa que todos os componentes serão impressos
 *  sem filtros, caso contrário, os valores aceitos são: predef, elements, components, templates.
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 */
function ps_load_components( $component_type = 'all' ) {
	global $_EDITOR_COMPONENTS;

	if ( $component_type == 'all' ) {
		foreach ( $_EDITOR_COMPONENTS as $el ) {
			if ( $el['listed'] ) {

				if ( isset( $el['data']['html'] ) && ! is_null( $el['data']['html'] ) ) {
					?>
					<script id="<?php echo $el['id']; ?>" type="<?php echo $el['render']; ?>">
						<?php if ($el['type'] == 'predef' || $el['type'] == 'template'): ?>
						<?php echo $el['data']['html']; ?>
						<?php else: ?>
						<?php echo ps_element_base($el); ?>
						<?php endif; ?>
					</script>
					<?php
				}
			}
		}
	} else {
		foreach ( $_EDITOR_COMPONENTS as $el ) {
			if ( $el['type'] == $component_type ) {
				if ( $el['listed'] ) {
					if ( isset( $el['data']['html'] ) && ! is_null( $el['data']['html'] ) ) {
						?>
						<script id="<?php echo $el['id']; ?>" type="<?php echo $el['render']; ?>">
							<?php if ($el['type'] == 'predef' || $el['type'] == 'template'): ?>
							<?php echo $el['data']['html']; ?>
							<?php else: ?>
							<?php echo ps_element_base($el); ?>
							<?php endif; ?>
						</script>
						<?php
					}
				}
			}
		}
	}
}

/**
 * Carrega o editor de forma externa especialmente para o plugin front-end. Esta função se
 * encontra aqui porque se ela for colocada dentro da classe principal, ocorrerá um erro de include.
 *
 * @param string $editor_id
 *  ID do editor que está sendo configurado
 * @param array $editor_settings
 *  Array dos settings que devem ser utilizados para este editor. Caso não seja informado,
 *  os valores padrões do wordpress serão utilizados.
 *
 * @since 1.0.0
 */
function ps_loadtinymce( $editor_id, $editor_settings = array() ) {
	//Se a classe do _WP_Editors não estiver instanciada então o sistema simplesmente a coloca aqui
	if ( ! class_exists( '_WP_Editors', false ) ) {
		require( ABSPATH . WPINC . '/class-wp-editor.php' );
	}
	$settings = _WP_Editors::parse_settings( $editor_id, $editor_settings );
	_WP_Editors::editor_settings( 'check_full_editor', $settings );
}

/**
 * Esta função apenas só pode ser acessada através do filtro mce_buttons, executado dentro do hook
 * chk_editor_dependencies. Não executá-lo em nenhum outro lugar.
 *
 * @param array $buttons
 *  Array de botões ativos no editor que são informados como callback do filtro pelo wordpress.
 *
 * @since 1.0.0
 * @return array
 *  Devolve ao wordpress o array de botões filtrados.
 */
function ps_tinymce_cleaner( $buttons ) {
	$removeFromEditor = array( 'wp_more', 'link', 'unlink' );
	foreach ( $removeFromEditor as $r ) {
		if ( ( $key = array_search( $r, $buttons ) ) !== false ) {
			unset( $buttons[ $key ] );
		}
	}

	return $buttons;
}

/**
 * Registra um novo controle para adicionar novos componentes
 *
 * @param string $control_id
 *  ID do controle seguindo o padrão ^[a-zA-Z0-9_-]+$
 * @param string $control_name
 *  Nome do controle
 * @param string $control_base
 *  Base do controle (elements|layout)
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return bool
 *  Retorna true para o objeto ter sido criado ou false para não
 */
function ps_register_control( $control_id, $control_name, $control_base = 'elements', $showTitle = true ) {
	global $_EDITOR_CONTROLS;

	if ( preg_match( '/^[a-zA-Z0-9_-]+$/', $control_id ) ) {
		//Primeiramente o sistema precisa verificar para saber se o ID existe
		if ( ! ps_control_search( $control_id, $_EDITOR_CONTROLS ) ) {
			$dt = array(
				'id'   => $control_id,
				'name' => $control_name,
				'base' => 'selectable-element-' . $control_base,
				//TODO: Entender porque não funciona
				//'title' => $showTitle
			);
			array_push( $_EDITOR_CONTROLS, $dt );

			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/**
 * Lista todos os controles seguindo uma determinada ordem
 *
 * @param string $sort_type
 *  Ordem a ser seguida para a listagem dos controles, 'id', 'name' ou 'base'
 * @param int $order_type
 *  Tipo de ordem: SORT_ASC = Ascendente, SORT_DESC = Descendente
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return array
 *  Retorna o array dos controles totalmente ordenado
 */
function ps_list_controls( $sort_type = 'id', $order_type = SORT_ASC ) {
	return ps_controls_sort( $sort_type, $order_type );
}

/**
 * Função interna para ordenar uma variável de multiníveis seguindo um padrão específico
 *
 * @param string $on
 *  Ordem a ser seguida para a listagem dos controles, 'id', 'name' ou 'base'
 * @param int $order
 *  Tipo de ordem: SORT_ASC = Ascendente, SORT_DESC = Descendente
 * @source http://php.net/manual/pt_BR/function.sort.php#99419
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return array
 *  Retorna o array dos controles totalmente ordenado
 */
function ps_controls_sort( $on, $order = SORT_ASC ) {
	global $_EDITOR_CONTROLS;

	return ps_sort( $on, $_EDITOR_CONTROLS, $order );
}

/**
 * Já que o in_array() do PHP não funciona em variáveis multidimensionais, tive de buscar uma
 * forma recursiva para fazer isso e pesquisar em toda uma matriz.
 *
 * @param string $needle
 *  Valor a ser buscado dentro da array
 * @param $haystack
 *  Array onde será efetuada a busca
 * @param bool|false $strict
 *  Caso true, a busca será feita utilizando o modo case-sensitive.
 * @source http://stackoverflow.com/a/4128377
 *
 * @since 1.0.0
 * @return bool
 *  Retorna true caso o valor exista dentro da array, ou false caso não exista.
 */
function ps_control_search( $needle, $haystack, $strict = false ) {
	foreach ( $haystack as $item ) {
		if ( ( $strict ? $item === $needle : $item == $needle ) || ( is_array( $item ) && ps_control_search( $needle, $item, $strict ) ) ) {
			return true;
		}
	}

	return false;
}

/**
 * Resgata um componente registrado diretamente da listagem interna
 *
 * @param string|null $component_id
 *  ID Do componente que está sendo listado
 *
 * @since 1.0.0
 * @global array $_EDITOR_COMPONENTS
 *  O objeto array responsável por armazenar os dados dos componentes
 * @return array|null
 *  Retorna a array do objeto caso encontrado, senão, o valor retornado será nulo.
 */
function ps_get_componentdata( $component_id ) {
	global $_EDITOR_COMPONENTS;
	foreach ( $_EDITOR_COMPONENTS as $k ) {
		if ( $k['id'] == $component_id ) {
			return $k;
			break;
		}
	}

	return null;
}

/**
 * Organiza um multi-array corretamente baseado em alguma chave
 *
 * @param string $on
 *  Nome da chave
 * @param array $multiarray
 *  Multiarray a ser organizado
 * @param int $order
 *  Tipo de ordenação, como padrão, é utilizada a SORT_ASC
 *
 * @since 1.0.0
 * @return array
 *  Array organizado
 */
function ps_sort( $on, $multiarray, $order = SORT_ASC ) {
	$new_array      = array();
	$sortable_array = array();

	if ( count( $multiarray ) > 0 ) {
		foreach ( $multiarray as $k => $v ) {
			if ( is_array( $v ) ) {
				foreach ( $v as $k2 => $v2 ) {
					if ( $k2 == $on ) {
						$sortable_array[ $k ] = $v2;
					}
				}
			} else {
				$sortable_array[ $k ] = $v;
			}
		}

		switch ( $order ) {
			case SORT_ASC:
				asort( $sortable_array );
				break;
			case SORT_DESC:
				arsort( $sortable_array );
				break;
		}

		foreach ( $sortable_array as $k => $v ) {
			$new_array[ $k ] = $multiarray[ $k ];
		}
	}

	return $new_array;
}

/**
 * Regstra um controle no editor
 *
 * @param string $editor_id
 *  ID do elemento
 * @param string $editor_name
 *  Nome do elemento
 * @param string $controlhtml
 *  HTML do elemento
 *
 * @since 1.0.0
 * @return bool
 *  True para registrado e false para não registrado
 */
function ps_register_editor( $editor_id, $editor_name, $controlhtml ) {
	global $_EDITOR_TABS;
	if ( preg_match( '/^[a-zA-Z0-9_-]+$/', $editor_id ) ) {
		if ( ! ps_control_search( $editor_id, $_EDITOR_TABS ) ) {
			$dt = array(
				'id'       => $editor_id,
				'name'     => $editor_name,
				'controls' => $controlhtml
			);

			array_push( $_EDITOR_TABS, $dt );

			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}

/**
 * Verifica se um módulo do editor existe
 *
 * @param string $editor_id
 *  ID do módulo que está sendo pesquisado
 *
 * @return bool
 *  True|False para a existência do objeto
 * @since 1.0.4
 */
function ps_editormodule_exists( $editor_id ) {
	global $_EDITOR_TABS;

	return ps_control_search( $editor_id, $_EDITOR_TABS );
}

/**
 * Organiza os componentes do editor, atalho para a função ps_sort()
 *
 * @param null $on
 *  Nome da chave, caso null seja passado, será retornado o valor da global
 * @param int $order
 *  Tipo de ordenação, como padrão, é utilizada a SORT_ASC
 *
 * @since 1.0.0
 * @return array
 *  Componentes organizados pela chave escolhida.
 */
function ps_editor_sort( $on = null, $order = SORT_ASC ) {
	global $_EDITOR_TABS;
	if ( ! is_null( $on ) ) {
		return ps_sort( $on, $_EDITOR_TABS, $order );
	} else {
		return $_EDITOR_TABS;
	}
}

/**
 * Retorna todos os IDs do editor
 * @since 1.0.0
 * @return array
 */
function ps_get_editorids() {
	global $_EDITOR_TABS;
	$idArray = array();
	foreach ( $_EDITOR_TABS as $e ) {
		array_push( $idArray, $e['id'] );
	}

	return $idArray;
}

/**
 * Adiciona na listagem de carregamento o arquivo responsável pelo controle ou controles de um ou mais componentes.
 * Esta função deve ser utilizada corretamente para que as traduções dos componentes funcione. A utilização de
 * includes diretos no código irá acarretar em textos não sendo traduzidos.
 *
 * @param string $filepath
 *  Caminho completo para o arquivo
 *
 * @return int
 *  Retorna o novo número de elementos do array.
 * @since 1.0.0
 */
function ps_register_component_control( $filepath ) {
	global $_COMP_CONTROLS_INCLUDES;

	return array_push( $_COMP_CONTROLS_INCLUDES, $filepath );
}

/**
 * Adiciona na listagem de carregamento o arquivo responsável pelos componentes. Esta função deve ser utilizada
 * corretamente para que as traduções dos componentes funcione. A utilização de includes diretos no código irá
 * acarretar em textos não sendo traduzidos.
 *
 * @param $filepath
 *  Caminho completo para o arquivo
 *
 * @return int
 *  Retorna o novo número de elementos do array.
 * @since 1.0.0
 */
function ps_register_component_file( $filepath ) {
	global $_COMP_FILES_INCLUDES;

	return array_push( $_COMP_FILES_INCLUDES, $filepath );
}

/**
 * Função responsável por realizar todos os includes corretamente. Esta função APENAS pode ser chamada
 * através do hook INIT do wordpress.
 * @since 1.0.0
 */
function ps_render_component_sources() {
	global $_COMP_CONTROLS_INCLUDES, $_COMP_FILES_INCLUDES;

	foreach ( $_COMP_CONTROLS_INCLUDES as $c ) {
		include_once( $c );
	}

	foreach ( $_COMP_FILES_INCLUDES as $d ) {
		include_once( $d );
	}
}
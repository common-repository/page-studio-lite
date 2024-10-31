<?php
/**
*       _               _                    _
*      | |             | |                  | |
*   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
*  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
* | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
*  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
*
* inc.element.php - Created using PhpStorm for checkcms.
* Developer: Miguel Couto | Created Date: 22/07/2016 - 18:29
*/

/**
 * @param string $component_id
 *  Tipo de linha que se espera imprimir através do shortcode
 * @param array $attributes
 *  Atributos retornados diretamente do framework do wordpress
 * @param null $content
 *  Conteúdo do shortcode caso tenha
 *
 * @since 1.0.0
 * @return string
 *  O Shortcode processado
 */
function ps_create_row( $component_id, $attributes, $content = null ) {
	//Todos os elementos padrões das linhas
	$defaultValues = array(
		'class'        => null,
		'schema'       => null,
		'media'        => null,
		'size'         => null,
		'id'           => null,
		'grid'         => null,
		'responsivity' => null,
		'can'          => array( 'move', 'edit', 'clone', 'delete' ),
	);

	//Aqui o sistema avalia quais dos valores foram atualizados
	$systemAttr = shortcode_atts( $defaultValues, $attributes );
	//Busca a base do componente
	$base = ps_component_base( $component_id, $systemAttr );

	$rowCreated = new CHKElement( 'div' );
	foreach ( $base['element'] as $attName => $attValue ) {
		$rowCreated->attr( $attName, $attValue );
	}

	ps_clean_elementattr( $rowCreated );

	$columnSortable = ps_create_colbase( isset($base['element']['data-internalsize']) ? $base['element']['data-internalsize'] : null );
	if ( ! is_null( $content ) ) {
		$columnSortable->appendChild( do_shortcode( $content ) );
	}
	$rowCreated->appendChild( $columnSortable->render() );

	return $rowCreated->render();
}

/**
 * Atalho para criação de uma coluna, ela só pode ser chamada pela função ps_create_row() e não pode ser
 * chamada por outra forma.
 *
 * @param null $sizeInfo
 *  Tipo de largura que a coluna possui
 *
 * @since 1.0.0
 * @return \CHKElement
 *  Retorna o CHKElement principal para manipulação posterior
 */
function ps_create_colbase( $sizeInfo = null ) {
	$columnSortable = new CHKElement( 'div' );
	$defaultClass   = array( 'chk_row', 'column-sortable', 'container', 'ui-sortable' );
	$columnSortable->attr( 'class', join( ' ', $defaultClass ) );

	if ( ! is_null( $sizeInfo ) ) {
		if ( $sizeInfo == 'full' ) {
			$columnSortable->attr( 'style', 'max-width: none;' );
		} else {
			$columnSortable->attr( 'style', 'max-width: ' . $sizeInfo . ';' );
		}
	}

	return $columnSortable;
}

/**
 * Gera uma lista de parâmetros no padrão HTML
 *
 * @param array $attributeArray
 *  Array do tipo key -> value contendo o nome dos atributos e seus respectivos valores
 *
 * @since 1.0.0
 * @return string
 *  Retorna uma string formatada completa de atributos a serem inseridos no código HTML
 */
function ps_generate_attribute( $attributeArray ) {
	$attributeCompiled = array();
	foreach ( $attributeArray as $key => $value ) {
		array_push( $attributeCompiled, $key . '="' . $value . '"' );
	}

	return join( ' ', $attributeCompiled );
}

/**
 * Função responsável por renderizar o shortcode corretamente
 *
 * @param \CHKElement $element
 *  Elemento retornado do shortcode base pré-processado
 * @param string $object
 *  String HTML processada na função
 *
 * @since 1.0.0
 * @return string
 *  Retorna o código HTML relativo ao elemento e ao conteúdo totalmente formatado.
 */
function ps_render_shortcode( CHKElement $element, $object ) {

	// Primeiramente o sistema precisa verificar para saber se existe algum link atrelado a este elemento,
	// se tiver, é necessário renderizá-lo primeiro.
	if ( $element->attr( 'data-link' ) ) {
		//Se tiver um link, então o sistema gera o link
		list( $target, $rel, $href ) = explode( ',', $element->attr( 'data-link' ) );

		$linkElement = new CHKElement( 'a' );
		$linkElement->attr( 'class', 'ps_hyperlink' );
		$linkElement->attr( 'target', $target );
		$linkElement->attr( 'rel', $rel );
		$linkElement->attr( 'href', $href );

		$linkElement->appendChild( $object );
		$element->appendChild( $linkElement->render() );

		ps_clean_elementattr($element);

		return $element->render();
	} else {
		//Se não possuir um link, o sistema irá gerar a renderização normal
		$element->appendChild( $object );

		ps_clean_elementattr($element);

		return $element->render();
	}
}

/**
 * Limpa elementos, linhas e colunas dependendo do modo em que a página está sendo aberta, ou seja, se
 * estiver sendo aberta em modo Editor, o sistema irá mostrar as marcações completas, caso contrário,
 * irá exibir apenas o necessário, despoluindo o código renderizado e reduzindo o tamanho da página.
 * @since 1.0.0
 *
 * @param \CHKElement $element
 *  Elemento a ser analizado e a ter objetos removidos.
 */
function ps_clean_elementattr( CHKElement $element ) {
	if ( ! ps_in_editormode() ) {
		//Em modo de exibição, o sistema não precisa exibir todos os elementos, pois são considerados lixos
		$removeNonEssencial = array(
			'data-target',
			'data-class',
			'data-default',
			'data-mdl',
			'data-can',
			'data-edit',
			'data-content',
			'data-id',
			'data-element'
		);
		foreach ( $removeNonEssencial as $x ) {
			$element->removeAttr( $x );
		}
	}
}

/**
 * Função responsável por montar toda a base do shortcode através de um ID específico
 *
 * @param string $component_id
 *  ID do componente que está sendo carregado. Corresponde ao mesmo ID do componente utilizado na função ps_register_component()
 * @param array $attributes
 *  Atributos retornados pela engine do Wordpress no callback do shortcode.
 * @param null|array|string $forceclass
 *  Força a inserção de determinadas classes diretamente na div do elemento
 *
 * @since 1.0.0
 * @return object
 *  Informações completas a respeito do shortcode
 */
function ps_shortcode_base( $component_id, $attributes, $forceclass = null ) {
	$defaultValues = array(
		'class'  => null,
		'id'     => null,
		'style'  => null,
		'href'   => null,
		'link'   => null,
		'target' => null,
		'src'    => null,
		'alt'    => null,
		'width'  => null,
		'height' => null,
		'effect' => null,
		'responsivity' => null,
		'can'    => array( 'move', 'edit', 'clone', 'delete' ),
	);

	//Aqui o sistema avalia quais dos valores foram atualizados
	$systemAttr = shortcode_atts( $defaultValues, $attributes );
	//Busca a base do componente
	$base = ps_component_base( $component_id, $systemAttr, $forceclass );

	$elementCreated = new CHKElement( 'div' );
	foreach ( $base['element'] as $attrName => $attrValue ) {
		$elementCreated->attr( $attrName, $attrValue );
	}

	ps_clean_elementattr($elementCreated);

	$output = (object) array(
		'default'    => $attributes,
		'element'    => $elementCreated,
		'targetAttr' => ps_generate_attribute( $base['target'] ),
		'target'     => $base['target'],
		'remove'     => $base['remove']
	);

	return $output;
}

/**
 * Retorna um elemento completamente tratado
 *
 * @param string $component_id
 *  ID do componente que está sendo carregado. Corresponde ao mesmo ID do componente utilizado na função ps_register_component()
 * @param array $systemAttr
 *  Atributos retornados pela engine do Wordpress no callback do shortcode.
 * @param null|array|string $forceclass
 *  Força a inserção de determinadas classes diretamente na div do elemento
 *
 * @since 1.0.0
 * @return array
 *  Retorna os dados filtrados para o elemento e para o target, caso tenha um
 */
function ps_component_base( $component_id, $systemAttr, $forceclass = null ) {
	$component = ps_get_componentdata( $component_id );

	//Registra por padrão as classes que já existem neste elemento
	$defaultClasses  = array();
	$removeAttribute = array();

	//Registra as classes bases do elemento
	if ( $component_id != 'int-row' && $component_id != 'int-col' && $component_id != 'int-fullpage' ) {
		$elementBaseClass = array( 'chk_element', 'chk_element_int' );

		//Verifica se existe alguma classe adicional que o usuário demanda que seja inserida no elemento
		if ( ! is_null( $forceclass ) ) {
			if ( is_string( $forceclass ) ) {
				array_push( $elementBaseClass, $forceclass );
			} elseif ( is_array( $forceclass ) ) {
				foreach ( $forceclass as $cc ) {
					array_push( $elementBaseClass, $cc );
				}
			}
		}

	} else {
		$elementBaseClass = array();
	}
	//Cria uma matriz de atributos que vão ser salvos
	$attributeArray = array();
	//Cria uma matriz dos atributos que serão salvos no target
	$targetAttribute = array();
	//Cria uma string completa de estilos que podem ser adicionados
	$styleArray = array();

	if ( isset( $component['data']['defaultClass'] ) && is_array( $component['data']['defaultClass'] ) ) {
		// Como o default Class é um array, e ele é a primeira coisa a ser inserida no sistema, então ele é
		// carregado com esses dados
		foreach ( $component['data']['defaultClass'] as $cls ) {
			array_push( $defaultClasses, $cls );
		}
	}

	//Define o target, caso tenha
	if ( isset( $component['data']['target'] ) ) {
		//Se o elemento possui um target então ele será adicionado
		$attributeArray['data-target'] = $component['data']['target'];
	}

	//Verifica se este elemento possui grid se é uma coluna
	if ( isset( $systemAttr['grid'] ) && ! is_null( $systemAttr['grid'] ) ) {
		array_push( $defaultClasses, 'gr-' . $systemAttr['grid'] );
		array_push( $removeAttribute, 'grid' );
	}

	//Esquema de grid das linhas
	if ( isset( $systemAttr['schema'] ) && ! is_null( $systemAttr['schema'] ) ) {
		$attributeArray['data-schema'] = $systemAttr['schema'];
	}

	// Verifica se o objeto está marcado com um ID, se ele tiver, então o sistema sabe que possui uma
	// classe pré-definida gerada para ele.
	if ( isset( $systemAttr['id'] ) && ! is_null( $systemAttr['id'] ) ) {
		$attributeArray['data-id'] = $systemAttr['id'];
		array_push( $removeAttribute, 'id' );

		$styles = ps_getpost_styles( get_the_ID() );

		if ( isset( $styles[0][ $systemAttr['id'] ] ) ) {
			// Como possui um ID, então o sistema registra uma classe padrão apenas se ela JÁ FOI REGISTRADA,
			// se não existe registro dela, então o sistema não a escreve
			array_push( $defaultClasses, PAGESTUDIO_PREDEFINED_CLASS . $systemAttr['id'] );
		}
	}

	if ( isset( $systemAttr['responsivity'] ) && ! is_null( $systemAttr['responsivity'] ) ) {
		//Divide o elemento exatamente no array
		$mediavar = explode( '@', $systemAttr['responsivity'] );
		//Registra nas variáveis responsáveis para que o sistema interprete normalmente
		$attributeArray['data-esc']         = $mediavar[0];
		$attributeArray['data-media-width'] = $mediavar[1];

		//Registra uma nova classe responsável por cuidar da responsividade do elemento
		array_push($defaultClasses, sprintf('m-%s-%s', $mediavar[0], $mediavar[1]));
	}

	//Verifica se possuem mais classes a serem adicionadas
	if ( isset( $systemAttr['class'] ) && ! is_null( $systemAttr['class'] ) ) {
		array_push( $removeAttribute, 'class' );
		//Primeiramente é necessário separar todas as classes
		$separatedClasses = explode( ' ', $systemAttr['class'] );
		$registerClasses  = array();
		//Percorre todas as classes
		foreach ( $separatedClasses as $c ) {
			//Adiciona ao array mais classes caso tenha, todas elas, inclusive as fontes
			array_push( $defaultClasses, $c );
			//Informa o data-class APENAS se não for classe do tipo fonte
			if ( ! preg_match( "/font\\-([a-zA-Z\\-]+)/", $c ) ) {
				array_push( $registerClasses, $c );
			}
		}

		//Informa também um novo atributo, pois, se possuem classes do usuário o sistema precisa marcá-los
		$attributeArray['data-class'] = join( ' ', $registerClasses );
	}

	if ( isset( $systemAttr['link'] ) && ! is_null( $systemAttr['link'] ) ) {
		$attributeArray['data-link'] = $systemAttr['link'];
	}

	if ( isset( $systemAttr['media'] ) && ! is_null( $systemAttr['media'] ) ) {
		array_push( $removeAttribute, 'media' );
		if ( is_numeric( $systemAttr['media'] ) ) {
			//É numerico, corresponde a uma imagem dentro do wordpress
			$mediafile = wp_get_attachment_url( $systemAttr['media'] );
			$type      = wp_check_filetype( $mediafile );

			if ( $type['type'] == 'video/mp4' ) {
				//Inicializa o VIDE
				$attributeArray['data-vide-bg']      = $mediafile;
				$attributeArray['data-vide-options'] = 'loop: true, muted: true, position: 50% 50%';
				$attributeArray['data-media']        = $systemAttr['media'];
			} else {
				//Imagens comuns
				$attributeArray['data-background'] = $mediafile;
				$attributeArray['data-media']      = $systemAttr['media'];
				array_push( $styleArray, 'background-image:url(' . $mediafile . ')' );
			}
		} else {
			//É uma URL comum
			$attributeArray['data-background'] = $systemAttr['media'];
			array_push( $styleArray, 'background-image:url(' . $systemAttr['media'] . ')' );
		}
	}

	//Para informações de media
	if ( isset( $systemAttr['src'] ) && ! is_null( $systemAttr['src'] ) ) {
		array_push( $removeAttribute, 'src' );
		//Verifica se o valor é numerico
		if ( is_numeric( $systemAttr['src'] ) ) {
			//É numerico, corresponde a uma imagem dentro do wordpress
			$image = wp_get_attachment_image_src( $systemAttr['src'], 'full', false );
			//Transforma os valores retornados em uma lista
			list( $src, $width, $height ) = $image;
			//Substitui o valor original da imagem
			$attributeArray['data-media'] = $systemAttr['src'];

			if ( isset( $component['data']['target'] ) ) {
				$targetAttribute['data-media']    = $systemAttr['src'];
				$targetAttribute['data-original'] = $src;
			} else {
				$attributeArray['data-media']    = $systemAttr['src'];
				$attributeArray['data-original'] = $src;
			}

			$systemAttr['src'] = $src;
		} else {
			//Não é numerico, significa que é uma URL, então o sistema mantém
			if ( isset( $component['data']['target'] ) ) {
				$attributeArray['data-media']  = $systemAttr['src'];
				$targetAttribute['data-media'] = $systemAttr['src'];
				$targetAttribute['data-original'] = $systemAttr['src'];
			}
		}
	}

	if ( isset( $systemAttr['size'] ) && ! is_null( $systemAttr['size'] ) ) {
		array_push( $removeAttribute, 'size' );
		$attributeArray['data-internalsize'] = $systemAttr['size'];
	}

	//Classes já processadas
	if ( isset( $component['data']['target'] ) && isset( $component['data']['target'] ) ) {
		$targetAttribute['class'] = join( ' ', $defaultClasses );
	} else {
		foreach ( $defaultClasses as $cls ) {
			array_push( $elementBaseClass, $cls );
		}
	}

	//A classe obrigatória do elemento
	$attributeArray['class'] = join( ' ', $elementBaseClass );

	if ( ps_in_editormode() ) {
		$styles = ps_getpost_styles( get_the_ID() );
		if ( isset( $styles[0][ $systemAttr['id'] ] ) ) {
			$stylePieces = explode( '; ', $styles[0][ $systemAttr['id'] ] );
			foreach ( $stylePieces as $s ) {
				array_push( $styleArray, $s );
			}
		}
	}

	if ( count( $styleArray ) > 0 ) {
		if (isset($attributeArray['style'])) {
			if ( isset( $component['data']['target'] ) ) {
				$targetAttribute['style'] = join( '; ', $styleArray );
				$attributeArray['style']  = str_replace( '"', '', $attributeArray['style'] );
			} else {
				$attributeArray['style'] = join( '; ', $styleArray );
				$attributeArray['style'] = str_replace( '"', '', $attributeArray['style'] );
			}
		}
	}

	if ( isset( $component['data']['default'] ) && ! is_null( $component['data']['default'] ) ) {
		$attributeArray['data-default'] = $component['data']['default'];
	}

	if ( isset( $systemAttr['effect'] ) && ! is_null( $systemAttr['effect'] ) ) {
		array_push( $removeAttribute, 'effect' );
		$attributeArray['data-effect'] = $systemAttr['effect'];
	}

	if ( isset( $systemAttr['alt'] ) && ! is_null( $systemAttr['alt'] ) ) {
		array_push( $removeAttribute, 'alt' );
		if ( isset( $component['data']['target'] ) ) {
			$targetAttribute['alt'] = $systemAttr['alt'];
		} else {
			$attributeArray['alt'] = $systemAttr['alt'];
		}
	}

	if ( isset( $systemAttr['width'] ) && ! is_null( $systemAttr['width'] ) ) {
		array_push( $removeAttribute, 'width' );
		if ( isset( $component['data']['target'] ) ) {
			$targetAttribute['width'] = $systemAttr['width'];
		} else {
			$attributeArray['width'] = $systemAttr['width'];
		}
	}

	if ( isset( $systemAttr['height'] ) && ! is_null( $systemAttr['height'] ) ) {
		array_push( $removeAttribute, 'height' );
		if ( isset( $component['data']['target'] ) ) {
			$targetAttribute['height'] = $systemAttr['height'];
		} else {
			$attributeArray['height'] = $systemAttr['height'];
		}
	}

	if ( isset( $systemAttr['href'] ) && ! is_null( $systemAttr['href'] ) ) {
		array_push( $removeAttribute, 'href' );
		if ( isset( $component['data']['target'] ) ) {
			$targetAttribute['href'] = $systemAttr['href'];
		} else {
			$attributeArray['href'] = $systemAttr['href'];
		}
	}

	$attributeArray['data-mdl']     = $component['data']['model'];
	$attributeArray['data-element'] = $component['data']['name'];
	$attributeArray['data-can']     = ps_convert_readable( $systemAttr['can'] );
	$attributeArray['data-edit']    = ps_convert_readable( $component['data']['editor'] );
	$attributeArray['data-content'] = ( $component['data']['noContent'] ? 'false' : 'true' );

	return array(
		'element' => $attributeArray,
		'target'  => $targetAttribute,
		'remove'  => $removeAttribute
	);
}

/**
 * Faz o sistema retornar os atributos de um determinado objeto de forma organizada já
 * em uma string encapsulada, aumentando o tempo de criação de resposta nos shortcodes
 * gerados.
 *
 * @param {stdClass} $base
 *  Esta variável apenas pode ser preenchida com o objeto gerado através da função ps_shortcode_base().
 *
 * @since 1.0.0
 * @return null|string
 *  Retorna o dado completo de atributos caso tenha. Senão, será retornado ou null
 *  ou uma string vazia.
 */
function ps_shortcode_attrgen( $base ) {
	if ( isset( $base->default ) ) {
		$arrayAttr = array();
		foreach ( $base->default as $x => $v ) {
			if ( $x != 'id' ) {
				array_push( $arrayAttr, $x . '="' . $v . '"' );
			}
		}

		return implode( " ", $arrayAttr );
	} else {
		return null;
	}
}
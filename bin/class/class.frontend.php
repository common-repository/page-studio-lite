<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.frontend.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 31/05/2016 - 16:58
 */

namespace Checkcms\Editor {

	//Esse arquivo precisa apenas ser carregado aqui, em nenhum outro lugar
	if(!function_exists('wp_get_current_user')) {
		include_once(ABSPATH . "wp-includes/pluggable.php");
	}

	/**
	 * Class Frontend
	 * @package Checkcms\Editor
	 */
	class Frontend implements EditorInferface {

		/**
		 * ID do post que está sendo tratado pelo editor
		 * @var int
		 */
		private $post_id = null;

		/**
		 * Informações principais do post
		 * @var array
		 */
		private $post_data = null;

		/**
		 * URL Final do Iframe que será carregado pelo
		 * @var string
		 */
		public $iframe_url = null;

		/**
		 * Aqui é carregado todo o conteúdo que será inserido no footer da página
		 * @var array
		 */
		public $footerLoader = array();

		private $editorAlert = array();

		protected $wpeditorid = 'check_full_editor';

		protected $wpeditor_settings = array(
			'dfw' => true,
			'tabfocus_elements' => 'insert-media-button',
			'editor_height' => 240,
			'height' => 240,
			'media_buttons' => false
		);

		/**
		 * Inicializa o editor
		 */
		public function init()
		{
			//Inicia primeiramente perguntando se o atual usuário pode ou não editar uma página
			if ( current_user_can('edit_pages') ) {
				//Remove qualquer action do wordpress, para evitar conflitos, problemas ou qualquer
				//outro tipo de coisa que possa atrapalhar na renderização do editor final
				remove_all_actions( 'admin_notices', 3 );
				remove_all_actions( 'network_admin_notices', 3 );

				//Verifica se todos os componentes estão corretos
				$this->checkComponents();
				//Chamadas do Editor
				$this->CheckPost();
			} else {
				//TODO: O que fazer quando o usuário não pode editar uma página
			}
		}

		/**
		 * Realiza as validações do post que está sendo preparado para ser editado pelo sistema.
		 * É necessário validar o tipo de ID restringido apenas a página
		 */
		private function CheckPost() {

			$postData = null;

			if (is_null(ps_get( "pid" ))) {
				//O pid é nulo, então é necessário primeiramente criar o post
				$postReset = array(
					// Como padrão esse texto será pego diretamente do localization do próprio wordpress, pois é
					// como se ele mesmo estivesse gerando esta página
					'post_title'    => __('Auto Draft'),
					'post_status'  => 'draft',
					'post_content' => '[check_anchor]',
					'post_type' => 'page'
				);

				$this->post_id = wp_insert_post($postReset);
				//Após inserir o post, o sistema gera a assinatura
				ps_sign($this->post_id);
				// Retorna tudo a respeito da página
				$postData = get_post( $this->post_id, ARRAY_A );
			} else {
				// Registra o post que está sendo tratado pelo editor
				$this->post_id = ps_get( "pid" );
				//Após inserir o post, o sistema gera a assinatura
				ps_sign($this->post_id);
				// Retorna tudo a respeito da página
				$postData = get_post( $this->post_id, ARRAY_A );
			}

			$updateContent = false;

			// Este editor é limitado apenas a páginas, então, o sistema precisa verificar para saber
			// se é mesmo uma página que está sendo editada.

			if ( ps_support_editor($postData['post_type']) ) {
				if ( $postData['post_status'] == 'auto-draft' ) {

					//Se o post for auto-draft, então o sistema irá irpa recriar o post como draft desta vez
					$postNew = array(
						'ID'           => $this->post_id,
						'post_status'  => 'draft',
						'post_content' => '[check_anchor]'
					);
					//Atualiza o post como sendo Rascunho desta vez, isso fará com que seja possível realizar o "preview" da página
					//enquanto o usuário faz todas as modificações
					wp_update_post( $postNew );

				} else if ( $postData['post_status'] == 'draft' ) {

					// Post já está definido como draft, no entanto, e necessário verificar para saber se o
					// mesmo possui a ancora, necessária para interpretar os dados da página e que irá fazer o
					// editor funcionar corretamente.
					preg_match("/\[check_anchor\]/", $postData['post_content'], $contentarray);
					if ( count($contentarray) == 0 || $postData['post_content'] = "") {
						//Esta página, embora sendo draft, não possui a ancora, então o sistema a salva novamente.
						$postNew = array(
							'ID'           => $this->post_id,
							'post_status'  => 'draft',
							'post_content' => '[check_anchor]'
						);
						wp_update_post( $postNew );
					}
				} else if ( $postData['post_status'] == 'publish' ) {

					// Mesmo o post estando definido como publicado, é necessário verificar para saber se ele está
					// vazio. Isso ocorre porque páginas marcadas como "home" por exemplo, podem ser salvas primeira
					// (publicadas) para então serem associadas dentro das configurações do wordpress. Nesse caso,
					// espera-se que elas estejam com o post-content vazio.
					if ($postData['post_content'] == '') {
						$postNew = array(
							'ID'           => $this->post_id,
							'post_content' => '[check_anchor]'
						);
						wp_update_post( $postNew );
					} else {
						preg_match("/\[check_anchor\]/", $postData['post_content'], $contentarray);
						if ( count($contentarray) == 0) {
							$newcontent = sprintf('[check_anchor][check_row schema="gr-12" id="%s"][check_column grid="12" id="%s"][html_code id="%s"]%s[/html_code][/check_column][/check_row]', $this->genID(), $this->genID(), $this->genID(), $postData['post_content']);
							$postNew = array(
								'ID'           => $this->post_id,
								'post_content' => $newcontent
							);
							wp_update_post( $postNew );
						}
					}
				}

				//Aqui o sistema resgata novamente os dados do post depois de ter passado pela filtragem acima.
				$this->post_data = get_post( $this->post_id, ARRAY_A );

				//Carrega o idioma do editor
				$this->loadLanguages();
				//Carrega a URL do iframe
				$this->get_iframe_url();
				$this->loadWindowBases();
				$this->loadWordpressTinyMCE();

				//Carrega todos os templates
				add_action( 'admin_footer', array( $this, 'renderize_templates' ) );
			} else {
				//TODO: Não é uma página, então o sistema não está autorizado a aplicar as modificações
			}
		}

		private function genID() {
			return substr(md5(uniqid(time())), 0, 7);
		}

		/**
		 * Gera a URL final do iframe que será carregado para a pré-visualização do sistema,
		 * é necessário saber que informações como preview e page_id se perdem, pois, por algum motivo,
		 * o Wordpress recarrega a página removendo estes parâmetros da querystring.
		 */
		private function get_iframe_url()
		{
			// Aqui o sistema cria um nonce para o Iframe, ou seja, apenas uma comunicação correta entre
			// o iframe e o editor, para impedir que algum usuário mais esperto, possa abrir a página
			// de edição dentro do website por conhecer o ID e os parâmetros passados via querystring.
			// Se os dados na pré-visualização forem inconsistentes, então o sistema proíbe o carregamento
			// da página indicando uma mensagem de erro.
			$nonce = wp_create_nonce($this->post_id); //O parâmetro para criação do nonce é sempre o ID da página

			$iframeQuery = array(
				'page_id' => $this->post_id,
				'pid' => $this->post_id,
				'chk_editor' => 'full',
				'preview' => 'true',
				'wpn' => $nonce
			);

			$permaLink = get_permalink($this->post_id);
			$blankParameter = array();

			if (isset(parse_url($permaLink)['query'])) {
				$parts = explode( '&', parse_url( $permaLink )['query'] );
				foreach ( $parts as $x ) {
					$idinfo                       = explode( '=', trim( $x ) );
					$blankParameter[ $idinfo[0] ] = $idinfo[1];
				}
			}

			$iframeQuery = array_merge($iframeQuery, $blankParameter);

			$this->iframe_url = get_site_url() . '/?' . http_build_query($iframeQuery);
		}

		/**
		 * Carrega o editor de texto do TinyMCE do wordpress para ficar disponível para uso
		 */
		private function loadWordpressTinyMCE() {
			ps_loadtinymce($this->wpeditorid, $this->wpeditor_settings);
		}

		private function registerEditorMessage(EditorMessage $message) {
			$alertMessage = array(
				'message' => $message,
				'type' => $message->getType()
			);
			array_push($this->editorAlert, $alertMessage);
		}

		/**
		 * Valida todos os componentes
		 * @since 1.0.4
		 */
		private function checkComponents() {
			global $_EDITOR_COMPONENTS;
			foreach ( $_EDITOR_COMPONENTS as $comp ) {
				//Identificador do objeto atual
				$identifier = ( ( is_null( $comp['data']['name'] ) || $comp['data']['name'] == '' ) ? $comp['id'] : $comp['data']['name'] );

				//Verifica se o modelo foi informado
				if ( ! is_null( $comp['data']['model'] ) && $comp['data']['model'] == '' ) {
					$msg = new EditorMessage( $identifier, sprintf( ps_trans( '%s is missing for component' ), 'Model' ), EditorMessageType::Error );
					$this->registerEditorMessage( $msg );
				}

				//Verifica se o nome foi preenchido
				if ( is_null( $comp['data']['name'] ) || $comp['data']['name'] == '' ) {
					$msg = new EditorMessage( $identifier, sprintf( ps_trans( '%s is missing for component' ), 'Name' ), EditorMessageType::Error );
					$this->registerEditorMessage( $msg );
				}

				//Verifica se o target foi informado porém com string vazia
				if ( ! is_null( $comp['data']['target'] ) && $comp['data']['target'] == '' ) {
					$msg = new EditorMessage( $identifier, sprintf( ps_trans( '%s is missing for component' ), 'Target' ), EditorMessageType::Error );
					$this->registerEditorMessage( $msg );
				}

				//Verifica os módulos de editor se estão todos corretos
				foreach ( $comp['data']['editor'] as $ed ) {
					if ( $ed != 'html' ) {
						if ( ! ps_editormodule_exists( $ed ) ) {
							$msg = new EditorMessage( $identifier, sprintf( ps_trans( 'Editor Module [%s] not found or not registered for component [%s].' ), ucfirst($ed), $comp['data']['name'] ), EditorMessageType::Warning );
							$this->registerEditorMessage( $msg );
						}
					}
				}
			}
		}

		/**
		 * Gera os códigos bases das janelas que serão inseridos no final da página antes do
		 * fechamento do <body> eles são utilizados pelo editor para carregar conteúdos de janelas pré-definidas.
		 */
		private function loadWindowBases() {
			$this->registerFooter( 'chk_window_base', EditorBase::window_base_normal() );
			$this->registerFooter( 'chk_window_basetable', EditorBase::window_base_table() );
			$this->registerFooter( 'chk_window_css3window', EditorBase::css3_window() );
			$this->registerFooter( 'chk_window_templates', EditorBase::template_window() );
			$this->registerFooter( 'chk_window_htmlwindow', EditorBase::html_editor() );
			$this->registerFooter( 'chk_window_editor', EditorBase::wordpresseditor_window() );

			//Carrega as janelas de StyleTab e componentes
			$this->registerFooter( 'chk_window_styletab', EditorBase::styletab() );
			$this->registerFooter( 'chk_window_components', EditorBase::editorComponents() );

			//Na versão 4.7.1 do wordpress esta linha estava criando um notice devido a array vazio
			//Correção de otimização
			if ( isset( ps_getMeta( $this->post_id, '_custom_css' )[0] ) ) {
				$this->registerFooter( '_custom_css', ps_getMeta( $this->post_id, '_custom_css' )[0] );
			} else {
				$this->registerFooter( '_custom_css', "" );
			}
		}

		/**
		 * Registra um novo elemento no footer da página do tipo "text/x-jsrender"
		 * @param $object_id
		 *  ID Do template que será utilizado pelo framework JavaScript
		 * @param $template_content
		 *  Conteúdo em HTML do template
		 */
		private function registerFooter($object_id, $template_content)
		{
			$windowRegister = array(
				'id' => $object_id,
				'content' => $template_content
			);

			array_push($this->footerLoader, $windowRegister);
		}

		/**
		 * Carrega todas as configurações de linguagem que será utilizado pelo editor
		 */
		private function loadLanguages() {
			add_action( 'admin_head', array( $this, 'il8n' ) );
			do_action( 'admin_head' );
		}

		/**
		 * Resumo da maioria das funcionalidades do editor que dependem de mudanças no idioma, para facilitar
		 * foi criada uma variavel em array no PHP para ser convertida em JSON e legível no javascript. As strings
		 * compostas que dependem de valores podem ser escritas no formato do C#, utilizando {n}.
		 */
		public function il8n() {

			$chk_il8n = array(
				'notifySystem' => array(
					"ElementRemoved"        => ps_trans( "Element Removed" ),
					"ElementCloned"         => ps_trans( "Element Cloned Successfully" ),
					"DeleteElement"         => ps_trans( "Delete This Element?" ),
					"RowEdited"             => ps_trans( "Row Edited." ),
					"NewColumnAdded"        => ps_trans( "Added ({0}) column(s)." ),
					"EditColumnRows"        => ps_trans( "This action will remove one or more columns from the row, do you want to continue?" ),
					"ColumnRemoved"         => ps_trans( "Column Removed" ),
					"EemoveColumnAlert"     => ps_trans( "Remove Column?" ),
					"failedDrop"            => ps_trans( "Failed to create the element, template not found." ),
					"RowAdded"              => ps_trans( "Row Added" ),
					"ComponentAdded"        => ps_trans( "Component [{0}] added" ),
					"RemoveAllElements"     => ps_trans( "Do you really want to remove all content? This action cannot be undone." ),
					"AllContentRemoved"     => ps_trans( "All page content was successfully removed." ),
					"GridOverlayMsg"        => ps_trans( "On grid overlay mode, the editor is disabled." ),
					"blankPage"             => ps_trans( "Blank Page? Oh noes!" ),
					"buildingPage"          => ps_trans( "Start building your page right now!" ),
					"listMessage"           => ps_trans( "Sorry i'm lost, what do i do?" ),
					"knowledgebase"         => ps_trans( "See our Knowledge Base :)." ),
					"hyperlinkChanged"      => ps_trans( "URL changed" ),
					"hyperlinkFailed"       => ps_trans( 'Sorry, URL not valid' ),
					"failedToCreateElement" => ps_trans( 'Failed to create the element, template not found.' ),
					"failedToPublish"       => ps_trans( 'Failed to publish the page. Some error occurred, please, reload the page and try again.' ),
					"publishOk"             => ps_trans( 'Page published successfully, confirm if you want to go to your page' ),
					"draftSaved"            => ps_trans( 'Page draft updated.' ),
					"savepagequestion"      => ps_trans( 'Do you want to publish this page?' ),
					'unsavedelements'       => ps_trans( 'You have unsaved changes, are you sure you want to leave?' ),
					'automaticdraft'        => __( 'Auto Draft' ),
					'titlechanged'          => ps_trans( 'Page title changed' ),
					'blankspace'            => ps_trans( 'Editor Blank Space' ),
					'blankspacemessage'     => ps_trans( 'You will only see this element in the edit mode.' ),
					'templateinstall'       => ps_trans( 'Would you like to change the page template? This change will remove any changes made to the page so far.' ),
					'wrongcolnumber'        => ps_trans( 'The number of columns you entered will create a wrong table, do you want to continue?' ),
				),
				'controls'     => array(
					"shortRowName"    => ps_trans( "row" ),
					"shortColumnname" => ps_trans( "col" ),
					"pickerName"      => ps_trans( "Picker" ),
					"wheelName"       => ps_trans( "Wheel" ),
					"colorHistory"    => ps_trans( "Color History" ),
					"moveElement"     => ps_trans( "Move" ),
					"cloneElement"    => ps_trans( "Clone" ),
					"editElement"     => ps_trans( "Edit" ),
					"deleteElement"   => ps_trans( "Delete" ),
					"on"              => ps_trans( "on" ),
					"off"             => ps_trans( "off" ),
					'resizeElement'   => ps_trans( "Edit Spacing" )
				),
				'buttons'      => array(
					"confirmbtn"    => ps_trans( "Confirm" ),
					"cancelbtn"     => ps_trans( "Cancel" ),
					"removebtn"     => ps_trans( "Remove" ),
					"starterRow"    => ps_trans( "Start with a row" ),
					"templateUse"   => ps_trans( "Or use a template" ),
					"predefElement" => ps_trans( "Or a Component" ),
					"selectedImage" => ps_trans( "Use Selected Image" )
				),
				'windows'      => array(
					"csseditor"         => ps_trans( "CSS Editor" ),
					"templateeditor"    => ps_trans( "PageStudio Templates" ),
					"htmleditor"        => ps_trans( "HTML Editor" ),
					"columneditor"      => ps_trans( "Row Columns" ),
					"textEditor"        => ps_trans( "Text Editor" ),
					"selectImageWindow" => ps_trans( "Select Image" )
				),
				'errors'       => array(
					'contenteditable' => ps_trans( 'Your browser does not support the HTML5 content editable.' ),
					'placeholder'     => ps_trans( 'Your browser does not support the input placeholder.' ),
					'html5video'      => ps_trans( 'Your browser does not support the HTML5 videos.' ),
					'cssanimations'   => ps_trans( 'Your browser does not support the CSS Animations.' ),
					'csstransitions'  => ps_trans( 'Your browser does not support the CSS Transitions.' ),
					'anchornotfound'  => ps_trans( 'Anchor Not Found, impossible to find the main element.' ),
					'fullscreen'      => ps_trans( 'Your browser does not support the HTML5 fullscreen feature.' )
				),
				'tour'         => array(
					'yesplease' => ps_trans( "Yes, Please!" ),
					'nothanks'  => ps_trans( "No, thanks..." ),
					'next'      => ps_trans( "Next" ),
					'done'      => ps_trans( "Done" ),
					'st00title' => ps_trans( "PageStudio Tour" ),
					'st00descr' => ps_trans( 'Welcome! It looks like this might be your first time using the builder. Would you like to take a tour?' ),
					'st01title' => ps_trans( "Components and Plugins" ),
					'st01descr' => ps_trans( 'Here you can find any component and layout options to build your page.' ),
					'st02title' => ps_trans( "Add Content" ),
					'st02descr' => ps_trans( 'Add new content by dragging and dropping modules or widgets into your row layouts or to create a new row layout.' ),
					'st03title' => ps_trans( "Predefined Elements" ),
					'st03descr' => ps_trans( 'You can pick a predefined element and append to your layout inserting a new template at the end of your existing page content.' ),
					'st04title' => ps_trans( "Page Title" ),
					'st04descr' => ps_trans( 'You can change the title of this page by clicking and typing the new title, no need to go back to the Wordpress Editor.' ),
					'st05title' => ps_trans( "CSS Editor" ),
					'st05descr' => ps_trans( 'The PageStudio Editor allows you to write your own CSS code.' ),
					'st06title' => ps_trans( "Saving Drafts" ),
					'st06descr' => ps_trans( 'You can save a draft of your page clicking here, PageStudio also have a auto-save feature, you can change the minutes inside PageStudio -> Configurations.' ),
					'st07title' => ps_trans( "Publishing" ),
					'st07descr' => ps_trans( "Once you're finished, click this button to publish your changes." ),
					'st08title' => ps_trans( "Page Resolution" ),
					'st08descr' => ps_trans( 'Here you can test the responsiveness of your page.' ),
					'st09title' => ps_trans( "Page Content" ),
					'st09descr' => ps_trans( 'Here is your page Content, you can add rows, modules, edit and interact with them, only using Drag and drop.' ),
					'st10title' => ps_trans( "Lets Start!" ),
					'st10descr' => ps_trans( "Now that you know the basics of the PageStudio, you're ready to start building!" ),
				)
			);

			//Verifica se o help deve aparecer para o usuário
			$helpForUser  = get_user_meta( get_current_user_id(), '_pagestudio_help', true );
			$editorConfig = array(
				//Autosave do editor
				'autosave'       => ps_get_internal( 'editorautosave' ),
				//Tempo do auto save
				'autosave_timer' => ps_get_internal( 'autosavetimer' ),
				//Se o editor precisa renderizar as linhas de blank space
				'blankspace'     => ps_get_internal( 'blankspace' ),
				//Se o editor pode mostrar o help para todo o novo usuário
				'helpsys'        => ps_get_internal( 'helpsys' ),
				//Se o atual usuário já viu a ajuda do editor
				'helpforuser'    => ( $helpForUser == '' ? true : ( $helpForUser == 'false' ? false : true ) ),
				//ID do post
				'pid'            => $this->post_id,
				//Data em que foi criado
				'created'        => $this->post_data['post_date'],
				//Status atual do post
				'status'         => $this->post_data['post_status'],
				//URL registrada base do post
				'guid'           => $this->post_data['guid'],
				//Se o debugmode do wordpress está ativo, isso irá ativar mensagens específicas no editor
				'debugmode'      => WP_DEBUG,
				//Versão atual do pagestudio
				'psversion'      => get_plugin_data( trailingslashit( WP_PLUGIN_DIR ) . 'checkcms/prototype.php' )['Version']
			);

			$editorPermissions = array(
				'changeTitle'      => ps_get_permission( 'change-title' ),
				'publishPages'     => current_user_can( 'publish_pages' ),
				'changeResolution' => ps_get_permission( 'change-resolution' ),
				'saveDrafts'       => ps_get_permission( 'save-drafts' ),
				'defaultEditor'    => ps_get_permission( 'gnore-default-editor' ),
				'editorCSS'        => ps_get_permission( 'editor-css' ),
				'createPages'      => ps_get_permission( 'publish_posts' ),
			);

			//Gera as mensagens do editor
			$editorMessages = array();
			foreach ( $this->editorAlert as $k ) {
				$reg = array(
					'message' => sprintf( '%s: %s', $k['message']->componentName, $k['message']->message ),
					'type'    => strtolower( $k['type'] )
				);

				array_push( $editorMessages, $reg );
			}
			?>
			<script id="check_editor_language" type="text/javascript">
				var chk_il8n = <?php echo json_encode( $chk_il8n ); ?>;
				var chk_editorctrl = <?php echo json_encode(ps_get_editorids()); ?>;
				var chk_config = <?php echo json_encode($editorConfig); ?>;
				var chk_perms = <?php echo json_encode($editorPermissions); ?>;
				var chk_controls = {};
				var chk_shrtattr = {};
				var chk_dropglobal = {};
				var chk_cloneglobal = {};
				var chk_hook = {};
				var chk_styles = <?php echo json_encode(ps_getpost_styles( $this->post_id )); ?>;
				var chk_alerts = <?php echo json_encode($editorMessages); ?>
			</script>
			<?php
		}

		public function textualPermission($permissionName) {
			return ((ps_get_permission($permissionName)) ? 'true' : 'false');
		}

		public function textualWpPermission($permissionName) {
			return ((current_user_can($permissionName)) ? 'true' : 'false');
		}

		/**
		 * Renderiza o editor
		 */
		public function renderEditor()
		{
			?>
			<div class="checkcms-editor" base="<?php echo PAGESTUDIO_PLUGIN_PATH; ?>" data-title="<?php echo $this->post_data['post_title']; ?>" data-url="<?php echo admin_url(); ?>" data-post="<?php echo $this->post_id; ?>" data-guid="<?php echo $this->post_data['guid']; ?>">
				<?php //Aqui é a mensagem que o usuário recebe no editor, caso a sua resolução seja muito pequena ?>

				<div class="checkcms-screen-warning" style="display: none;">
					<div class="checkcms-screen-warning-info">
						<img src="<?php echo PAGESTUDIO_PLUGIN_PATH . '/assets/img/no-screen.png'; ?>" width="100" height="94">
						<h1><?php echo ps_trans('Your resolution is too small'); ?></h1>
						<p><?php echo ps_trans('Sorry, you cant use this editor in any screen<br/>smaller than 900px. If you want to see the<br/>responsiveness of your website, use the<br/>editor tool.'); ?></p>
					</div>
				</div>

				<?php //Aqui é o sistema de loading da interface ?>
				<div class="interfaceLoading">
					<?php $this->RenderLoading(); ?>
				</div>

				<?php //Aqui é onde o header é impresso ?>
				<header>
					<div class="header-handle">
						<?php //Lado Esquerdo do Header ?>
						<ul class="left-buttons left">
							<li class="logo-pagestudio">
								<a href="http://pagestudio.checkmatedigital.com/?utm_campaign=plugin&utm_source=<?php echo $_SERVER[HTTP_HOST]; ?>&utm_medium=fendeditor" target="_blank" title="<?php echo ps_trans('Page Studio'); ?>" class="tooltip"><img src="<?php echo PAGESTUDIO_PLUGIN_PATH . '/assets/img/menu_img_25.png'; ?>"></a>
							</li>
							<li class="br-left">
								<a href="#" data-rel="functions-config" title="<?php echo ps_trans('Configurations'); ?>" class="tooltip"><i class="fa fa-cog" aria-hidden="true"></i></a>
								<div data-end="functions-config" class="submenu-system submenu-main right" style="display: none;">
									<ul class="submenu-int">
										<li><a class="highlight-elements" href="#"><?php echo ps_trans('Hightlight all Elements'); ?></a></li>
										<li><a class="clean-elements" href="#"><?php echo ps_trans('Clean Page'); ?></a></li>
										<!--<li><a class="grid-overlay" href="#"><?php echo ps_trans('Toggle Grid Overlay'); ?></a></li>-->
										<li><a class="toggle-fullscreen" href="#"><?php echo ps_trans('Toggle Fullscreen'); ?></a></li>
										<li><a class="toggle-blankspace" href="#"><?php echo ps_trans('Toggle Blank Space'); ?></a></li>
										<li><a class="editor-help" href="#"><?php echo ps_trans('Editor Tour'); ?></a></li>
									</ul>
								</div>
							</li>
							<li><a href="#" title="<?php echo ps_trans('Components'); ?>" class="tooltip plugin-component"><i class="fa fa-puzzle-piece" aria-hidden="true"></i></a></li>
							<li><a href="#" title="<?php echo ps_trans('Templates'); ?>" class="tooltip plugin-templates"><i class="fa fa-cloud-download"" aria-hidden="true"></i></a></li>
							<?php if (current_user_can('publish_posts')): ?>
								<li><a href="<?php echo admin_url('admin.php?page='.PAGESTUDIO_SLUG.'-post'); ?>" target="_blank" title="<?php echo ps_trans('Create New Page'); ?>" class="tooltip new-file"><i class="fa fa-file-o" aria-hidden="true"></i></a></li>
							<?php endif; ?>
						</ul>
						<div class="page-title">
							<span class="title-icon"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></span>
							<?php if (ps_get_permission('change-title')): ?>
								<span class="page-title-text tooltip" title="<?php echo ps_trans('Click to edit the page title.'); ?>"><?php echo $this->post_data['post_title']; ?></span>
							<?php else: ?>
								<span class="page-title-normal"><?php echo $this->post_data['post_title']; ?></span>
							<?php endif; ?>
						</div>

						<?php //Lado Direito do Header ?>
						<ul class="right-buttons right">

							<?php if (current_user_can('publish_pages')): ?>
								<li><a href="#" title="<?php echo ps_trans('Publish'); ?>" class="tooltip save-page"><i class="fa fa-floppy-o" aria-hidden="true"></i></a></li>
							<?php endif; ?>

							<?php if (!ps_get('s', false)): ?>
								<?php if (ps_get_permission('change-resolution')): ?>
									<li>
										<a href="#" title="<?php echo ps_trans('Change Page Resolution'); ?>" class="editor-page-resolution" data-rel="resolution-menu" class="tooltip"><i class="fa fa-desktop" aria-hidden="true"></i></a>
										<div data-end="resolution-menu" class="submenu-system submenu-resolutions" style="display: none;">
											<ul class="submenu-int">
												<?php
												foreach($this->render_resolutions() as $res => $ico) {
													?>
													<li>
														<a title="<?php echo sprintf(ps_trans('Change Resolution to %s'), $res); ?>" data-name="<?php echo $ico[1]; ?>" class="resolution-work tooltip" res-width="<?php echo $res; ?>" href="#">
															<i class="fa <?php echo $ico[0]; ?>" aria-hidden="true"></i>
														</a>
													</li>
													<?php
												}
												?>
											</ul>
										</div>
									</li>
								<?php endif; ?>
							<?php endif; ?>

							<li><a href="#" title="<?php echo ps_trans('Close Editor and go to the page without save.'); ?>" class="tooltip close-frontend"><i class="fa fa-times" aria-hidden="true"></i></a></li>
						</ul>

						<?php if (ps_get_permission('save-drafts')): ?>
							<div class="other-button right"><a class="btn_wp_savedraft tooltip" title="<?php echo ps_trans('Save a draft of this page'); ?>" href="#"><?php echo ps_trans('Save Draft'); ?></a></div>
						<?php endif; ?>

						<?php if (!ps_get_permission('ignore-default-editor')) { ?>
							<?php if (!ps_posttype_data($this->post_data['post_type'])->redirect) { ?>
								<div class="other-button right"><a class="btn_wp_editor tooltip" title="<?php echo ps_trans('Back to the wordpress editor'); ?>" href="<?php echo admin_url('post.php?post='.$this->post_id.'&action=edit'); ?>"><?php echo ps_trans('WP Editor'); ?></a></div>
							<?php } ?>
						<?php } ?>

						<?php if (ps_get_permission('editor-css')): ?>
							<ul class="right-buttons right">
								<li><a href="#" title="<?php echo ps_trans('CSS Editor'); ?>" class="tooltip css3-editor"><i class="fa fa-flask" aria-hidden="true"></i></a></li>
							</ul>
						<?php endif; ?>

						<?php if (count($this->editorAlert) > 0): ?>
							<ul class="right-buttons right alert-mode" style="margin-right: 2px;">
								<li>
									<a href="#" title="<?php echo ps_trans('Editor Alerts'); ?>" class="tooltip" data-rel="editor-alerts"><i class="fa fa-exclamation-triangle flash animated infinite" aria-hidden="true"></i></a>
									<div data-end="editor-alerts" class="submenu-system" style="width: 250px;">
										<ul class="submenu-int">
											<?php foreach($this->editorAlert as $gg): ?>
												<li>
													<span class="error-icon type-<?php echo strtolower($gg['type']); ?>">
														<?php if (strtolower($gg['type']) == 'error'): ?>
															<i class="fa fa-times-circle" aria-hidden="true"></i>
														<?php elseif (strtolower($gg['type']) == 'warning'): ?>
															<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
														<?php endif; ?>
													</span>
													<span class="error-msg">
														<?php echo sprintf('%s: %s', $gg['message']->componentName, $gg['message']->message); ?>
													</span>
												</li>
											<?php endforeach; ?>
										</ul>
									</div>
								</li>
							</ul>
						<?php endif; ?>

						<?php if (ps_get('s', false)): ?>
							<ul class="right-buttons right iframe-sizer" style="margin-right: 2px;">
								<li>
									<a href="#" title="<?php echo ps_trans('Canvas Size'); ?>" class="tooltip" data-rel="editor-isize"><i class="fa fa-arrows-alt" aria-hidden="true"></i></a>
									<div data-end="editor-isize" class="submenu-system">
										<ul class="submenu-int iframe-resizer">
											<li>
												<div class="resizer-handler">
													<div class="column-prop">
														<?php echo ps_trans('Width'); ?>:
													</div>
													<div class="column-value">
														<input type="text" name="iframe-sizer-width" value="<?php echo explode('x',ps_get('s'))[0]; ?>">
													</div>
												</div>
											</li>
											<li>
												<div class="resizer-handler">
													<div class="column-prop">
														<?php echo ps_trans('Height'); ?>:
													</div>
													<div class="column-value">
														<input type="text" name="iframe-sizer-height" value="<?php echo explode('x',ps_get('s'))[1]; ?>">
													</div>
												</div>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						<?php endif; ?>

						<div class="other-button right">
							<a class="btn_wp_editor tooltip" title="<?php echo ps_trans('Upgrade to PageStudio Pro now'); ?>" href="<?php echo PAGESTUDIO_PREMIUM_URL; ?>" style="background: #FF7805;"><?php echo ps_trans('Upgrade to Pro Now!'); ?></a>
						</div>

					</div>
				</header>

				<?php //Aba de componentes e plugins ?>
				<div class="checkcms-style-tab plugin-tab-gh plugin-area" data-active="off">
					<div class="checkcms-style-tab-content"></div>
					<div class="checkcms-style-tab-chevron chev-left">
						<i class="fa fa-chevron-right" aria-hidden="true"></i>
					</div>
					<a class="checkcms-style-tab-premium" href="<?php echo PAGESTUDIO_PREMIUM_URL; ?>" target="_blank">To have access to more components and full support, upgrade to PageStudio Pro.</a>
				</div>

				<?php //Aba de estilos e outros ajustes de todos os componentes ?>
				<div class="checkcms-style-tab style-tab-gh" data-active="off">
					<div class="checkcms-style-tab-content"></div>
					<div class="checkcms-style-tab-chevron chev-right">
						<i class="fa fa-chevron-left" aria-hidden="true"></i>
					</div>
				</div>

				<?php //Área do IFRAME ?>
				<div class="iframe-canvas<?php echo (ps_get('s', false) ? ' iframe-center' : ''); ?>" <?php echo (ps_get('s', false) ? 'style="width:'.explode('x',ps_get('s'))[0].'px; height:'.explode('x',ps_get('s'))[1].'px;"' : ''); ?>>
					<?php //<div class="iframe-canvas-detail">Tablet - Portrait</div> ?>
					<?php $this->RenderGridOverlay(); ?>
					<iframe id="iframe-object" src="<?php echo $this->iframe_url; ?>" scrolling="auto"></iframe>
				</div>

				<?php //Este objeto irá aparecer quando algum tipo de salvamento estiver sendo feito. ?>
				<div class="save-window" style="display: none">
					<i class="fa fa-cog fa-spin fa-3x fa-fw margin-bottom"></i>
					<span class="sr-only">Loading...</span>
					<h3><?php echo ps_trans('Saving...'); ?></h3>
				</div>
			</div>
			<?php
		}

		/**
		 * Renderiza o grid overlay
		 */
		private function RenderGridOverlay()
		{
			?>
			<div class="iframe-canvas-grid-overlay">
				<div class="container">
					<div class="row row-overlay">
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
						<div class="gr-1"><div class="inner-gr"></div></div>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Retorna toda a informação de resolução do editor para a montagem do sub-menu de design adaptável
		 * @return array
		 *      Array com todos os tamanhos de resolução associados a seus respectivos ícones do font-awesome.
		 * @since 1.0.0
		 */
		private function render_resolutions()
		{
			return array(
				'fullscreen' => array('fa-desktop', ps_trans('Desktop')),
				'768' => array('fa-tablet', ps_trans('Tablet')),
				'1024' => array('fa-tablet rot', ps_trans('Tablet Landscape')),
				'320' => array('fa-mobile', ps_trans('Phone')),
				'480' => array('fa-mobile rot', ps_trans('Phone Landscape')),
			);
		}

		private function RenderLoading() {
			?>
			<div class="pagestudio-spinner"><img src="<?php echo PAGESTUDIO_PLUGIN_PATH . '/assets/img/menu_img_25_white.png'; ?>"></div>
			<?php
		}

		public function jsrender($id, $content) {
			?><script id="<?php echo $id; ?>" type="text/x-jsrender"><?php echo $content; ?></script><?php
		}

		public function renderize_templates() {
			foreach ($this->footerLoader as $dt)
			{
				$this->jsrender($dt['id'], $dt['content']);
			}

			/**
			//Renderiza os Widgets do sistema
			$arrayWidget = array(
				'chk_comp_wordpress_archives' => 'WP_Widget_Archives',
				'chk_comp_wordpress_calendar' => 'WP_Widget_Calendar',
				'chk_comp_wordpress_categories' => 'WP_Widget_Categories',
				'chk_comp_wordpress_links' => 'WP_Widget_Links',
				'chk_comp_wordpress_meta' => 'WP_Widget_Meta',
				'chk_comp_wordpress_pages' => 'WP_Widget_Pages',
				'chk_comp_wordpress_comments' => 'WP_Widget_Recent_Comments',
				'chk_comp_wordpress_recposts' => 'WP_Widget_Recent_Posts',
				'chk_comp_wordpress_rss' => 'WP_Widget_RSS',
				'chk_comp_wordpress_search' => 'WP_Widget_Search',
				'chk_comp_wordpress_tagcloud' => 'WP_Widget_Tag_Cloud',
				'chk_comp_wordpress_text' => 'WP_Widget_Text',
				'chk_comp_wordpress_menu' => 'WP_Nav_Menu_Widget',
			);

			foreach ($arrayWidget as $key => $wname) {
				$this->jsrender($key, ps_get_widget($wname));
			}
			 * */

			//Renderiza os componentes
			ps_load_components();
		}

	}

}
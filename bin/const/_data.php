<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _data.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/05/2016 - 14:24
 */

use Checkcms\Internal;

/**
 * Acesso ao package.json do sistema com informações do projeto
 * @global object $_GLOBALS ['_PKG']
 * @name $_PKG
 * @since 1.0.0
 */
global $_PKG;
$_PKG = new Internal\Package();

/**
 * Variável global onde serão armazenadas todos os componentes
 * @global array $_GLOBALS ['_EDITOR_COMPONENTS']
 * @name $_EDITOR_COMPONENTS
 * @since 1.0.0
 */
global $_EDITOR_COMPONENTS;
$_EDITOR_COMPONENTS = array();

/**
 * Variável global onde são armazenados todos os controles
 * @global array $_GLOBALS ['_EDITOR_CONTROLS']
 * @name $_EDITOR_CONTROLS
 * @since 1.0.0
 */
global $_EDITOR_CONTROLS;
$_EDITOR_CONTROLS = array();

/**
 * Variável global onde são armazenados todos os arquivos CSS que precisam ser
 * carregados na página final do usuário e também na pré-visualização
 * @global array $_GLOBALS ['_PREVIEW_STYLES']
 * @name $_PREVIEW_STYLES
 * @since 1.0.0
 */
global $_PREVIEW_STYLES;
$_PREVIEW_STYLES = array();

/**
 * registra todas as tabs do styletabs deste sistema
 * @global array $_GLOBALS ['_EDITOR_TABS']
 * @name $_EDITOR_TABS
 * @since 1.0.0
 */
global $_EDITOR_TABS;
$_EDITOR_TABS = array();

/**
 * Informa se o editor está ou não sendo utilizado
 * @global bool $_GLOBALS['_EDITOR_BEINGUSED']
 * @name $_EDITOR_BEINGUSED
 * @since 1.0.0
 */
global $_EDITOR_BEINGUSED;
$_EDITOR_BEINGUSED = false;

global $_PLUIN_PURCHASELINK;
$_PLUIN_PURCHASELINK = null;

global $_CYCLING_UPDATE;
$_CYCLING_UPDATE = false;

global $_COMP_CONTROLS_INCLUDES;
$_COMP_CONTROLS_INCLUDES = array();

global $_COMP_FILES_INCLUDES;
$_COMP_FILES_INCLUDES = array();

global $_PS_EDITOR_SIZE;
$_PS_EDITOR_SIZE = array();


/**
 * @cont string PAGESTUDIO_PLUGIN_NAME
 *      Nome curto do projeto
 * @since 1.0.0
 */
define( 'PAGESTUDIO_PLUGIN_NAME', $_PKG->name );

/**
 * @const string PAGESTUDIO_PLUGIN_VERSION
 *      Versão atual do projeto
 * @since 1.0.0
 */
define( 'PAGESTUDIO_PLUGIN_VERSION', $_PKG->version );

/**
 * @const string PAGESTUDIO_SLUG
 *      Slug utilizado para as páginas admin do projeto. Caso altere este valor NÃO SE ESQUEÇA pelo o amor de
 *      ODIN, THOR e FREYA de alterar no arquivo CheckCMS.js (resources/js/global/) o parâmetro CheckCMS.pageSlug
 *      Algumas URLs são geradas através do javascript e é necessário que esta variável e esta constante estejam em
 *      sincronia
 * @since 1.0.0
 */
const PAGESTUDIO_SLUG = 'page-studio';

/**
 * @cont string PAGESTUDIO_PREFIX
 * Prefixo utilizado para as entradas nas configurações do banco de dados
 * @since 1.0.0
 */
const PAGESTUDIO_PREFIX = 'pst';

/**
 * @const string PAGESTUDIO_METAPREFIX
 * Utilizado para gerar metaposts automáticos para posts
 * @since 1.0.0
 */
const PAGESTUDIO_METAPREFIX = '__ps';

/**
 * @const string PAGESTUDIO_PREDEFINED_CLASS
 * classes pré definidas do sistema
 * @since 1.0.0
 */
const PAGESTUDIO_PREDEFINED_CLASS = 'ps_composed_';

/**
 * @const int PAGESTUDIO_MENU_POS
 *      Posição do Menu com relação ao toolbar do Wordpress, para alterar este dado,
 *      você pode usar como referência esta página. A posição 3 significa que o menu se localizará abaixo do dashboard
 * @source: https://codex.wordpress.org/Function_Reference/add_menu_page
 * @since 1.0.0
 */
const PAGESTUDIO_MENU_POS = 100;

/**
 * @const string PAGESTUDIO_TRANSLATION
 *      nome da tradução geral do sistema
 * @since 1.0.0
 */
const PAGESTUDIO_TRANSLATION = 'ps';

/**
 * @const string PAGESTUDIO_PREMIUM_URL
 *      Link da versão premium
 * @since 1.0.6
 */
const PAGESTUDIO_PREMIUM_URL = 'http://pagestudio.pro/?utm_source=pagestudiolite&utm_medium=button&utm_campaign=upgradetopro';

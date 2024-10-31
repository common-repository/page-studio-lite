<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * _defines.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/05/2016 - 14:16
 */

/**
 * @const string PAGESTUDIO_ROOT
 *  Caminho completo ao arquivo em que se encontra esta constante
 * @since 1.0.0
 */
define('PAGESTUDIO_ROOT', __FILE__);

/**
 * @const string PAGESTUDIO_PATH
 *  Semelhante ao CHK_ABSPATH
 * @since 1.0.0
 */
define('PAGESTUDIO_PATH', dirname(__FILE__));

/**
 * @const string PAGESTUDIO_PLUGIN_PATH
 *  URL completo deste plugin
 * @since 1.0.0
 */
define('PAGESTUDIO_PLUGIN_PATH', plugins_url('',__FILE__));

/**
 * @const string PAGESTUDIO_PLUGIN_BASE
 *  Retorna o arquivo dentro da hierarquia do plugin
 * @since 1.0.0
 */
define('PAGESTUDIO_PLUGIN_BASE', plugin_basename(__FILE__));
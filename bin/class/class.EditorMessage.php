<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.EditorMessage.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 06/01/2017 - 12:05
 */

namespace Checkcms\Editor {

	abstract class baseEnum {
		private static $constCacheArray = NULL;

		private static function getConstants() {
			if (self::$constCacheArray == NULL) {
				self::$constCacheArray = [];
			}
			$calledClass = get_called_class();
			if (!array_key_exists($calledClass, self::$constCacheArray)) {
				$reflect = new \ReflectionClass($calledClass);
				self::$constCacheArray[$calledClass] = $reflect->getConstants();
			}
			return self::$constCacheArray[$calledClass];
		}

		public static function isValidName($name, $strict = false) {
			$constants = self::getConstants();

			if ($strict) {
				return array_key_exists($name, $constants);
			}

			$keys = array_map('strtolower', array_keys($constants));
			return in_array(strtolower($name), $keys);
		}

		public static function getNameByValue($value) {
			$constants = self::getConstants();
			foreach($constants as $k => $v) {
				if ($v == $value) {
					return $k;
				}
			}

			return null;
		}

		public static function isValidValue($value, $strict = true) {
			$values = array_values(self::getConstants());
			return in_array($value, $values, $strict);
		}
	}

	/**
	 * Class EditorMessageType
	 * @package Checkcms\Editor
	 * @since 1.0.4
	 */
	abstract class EditorMessageType extends baseEnum {
		const Success = 0;
		const Warning = 1;
		const Error = 2;
		const Information = 3;
		const Alert = 4;
	}

	/**
	 * Class EditorMessage
	 * @package Checkcms\Editor
	 * @since 1.0.4
	 */
	class EditorMessage {
		public $componentName = null;
		public $message = null;
		public $messageType = 1;

		/**
		 * Registra uma nova mensagem no editor
		 * @param string $component
		 *  Nome do componente
		 * @param string $message
		 *  Mensagem relativa
		 * @param int $type
		 *  Tipo de mensagem que está sendo registrada
		 * @since 1.0.4
		 */
		public function __construct($component, $message, $type = EditorMessageType::Warning) {
			$this->componentName = $component;
			$this->message = $message;
			$this->messageType = $type;
		}

		/**
		 * Retorna o tipo de mensagem que foi registrada neste objeto
		 * @return null|string
		 * @since 1.0.4
		 */
		public function getType() {
			return EditorMessageType::getNameByValue($this->messageType);
		}

		/**
		 * @return string
		 * @since 1.0.4
		 */
		public function __toString() {
			return sprintf('%s: %s', $this->componentName, $this->message);
		}

	}
}
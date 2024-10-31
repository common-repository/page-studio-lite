<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.DOMElement.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 19/06/2016 - 20:11
 */









	class CHKElement {

		private $nodeElement = null;
		private $elementAttr = array();
		private $elementContent = null;

		function __construct($elementNode, $innerHTML = null) {
			$this->nodeElement = $elementNode;
		}

		public function attr($name, $value = null) {
			if (is_null($value)) {
				if (isset($this->elementAttr[$name])) {
					return $this->elementAttr[$name];
				} else {
					return false;
				}
			} else {
				$this->elementAttr[ $name ] = $value;
				return $this;
			}
		}

		public function removeAttr($name) {
			if (isset($this->elementAttr[$name])) {
				unset($this->elementAttr[$name]);
				return true;
			} else {
				return false;
			}
		}

		public function appendChild($source) {
			$this->elementContent = $source;
			return $this;
		}

		public function render() {
			$attributesString = array();
			foreach($this->elementAttr as $key => $value) {
				array_push($attributesString, $key.'="'.$value.'"');
			}
			$attrs = "";
			if (count($attributesString)) {
				$attrs .= " " . join(' ', $attributesString);
			}

			return chr(13).'<'.$this->nodeElement.$attrs.'>'.$this->elementContent.'</'.$this->nodeElement.'>'.chr(13);
		}



	}

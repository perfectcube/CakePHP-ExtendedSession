<?php
/**
 * Created by samjbarney@gmail.com
 */

App::uses('SessionComponent', 'Controller/Component');
App::uses('ComponentCollection', 'Controller');

class ExtendedSessionComponent extends SessionComponent {
	private static $instance = null;
	private static $extended_flash = array();
	public function setFlash($message, $element = 'default', $params = array(), $key = 'flash') {
		// If there hasn't been a flash of type $key set yet, initialize the index for it
		if (!isset(self::$extended_flash[$key])) {
			self::$extended_flash[$key] = 0;
		}

		// Validate that we are not overwriting any messages after a redirect
		$check = sprintf('Message.%s.%s', $key, self::$extended_flash[$key]);
		while($this->check($check)) {
			++self::$extended_flash[$key];
			$check = sprintf('Message.%s.%s', $key, self::$extended_flash[$key]);
		}
		// Get the index
		$index = self::$extended_flash[$key];

		// If there is a specific index the message needs to be placed at, use it instead
		if (isset($params['EXT:index'])) {
			$index = $params['EXT:index'];
			unset($params['EXT:index']);
		} else {
			// Increment the index
			++self::$extended_flash[$key];
		}
		// Build the indexed key
		$key = "$key.$index";
		parent::setFlash($message, $element, $params, $key);
	}

	public static function setFlashStatic($message, $element = 'default', $params = array(), $key = 'flash') {
		if (!self::$instance) {
			self::$instance = new ExtendedSessionComponent(new ComponentCollection());
		}
		self::$instance->setFlash($message, $element = 'default', $params = array(), $key = 'flash');
	}
}
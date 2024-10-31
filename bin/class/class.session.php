<?php
/**
 *       _               _                    _
 *      | |             | |                  | |
 *   ___| |__   ___  ___| | ___ __ ___   __ _| |_ ___
 *  / __| '_ \ / _ \/ __| |/ / '_ ` _ \ / _` | __/ _ \
 * | (__| | | |  __/ (__|   <| | | | | | (_| | ||  __/
 *  \___|_| |_|\___|\___|_|\_\_| |_| |_|\__,_|\__\___|
 *
 * class.session.php - Created using PhpStorm for checkcms.
 * Developer: Miguel Couto | Created Date: 25/07/2016 - 15:37
 */

namespace Checkcms\Internal;


class Session {
	const SESSION_STARTED = true;
	const SESSION_NOT_STARTED = false;

	// The state of the session
	private $sessionState = self::SESSION_NOT_STARTED;

	// THE only instance of the class
	private static $instance;


	private function __construct() {
	}

	/**
	 * Returns THE instance of 'Session'. The session is automatically initialized if it wasn't.
	 * @return \Checkcms\Internal\Session
	 * @since 1.0.0
	 */
	public static function getInstance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new self;
		}

		self::$instance->startSession();

		return self::$instance;
	}

	/**
	 * (Re)starts the session.
	 * @since 1.0.0
	 * @return bool
	 *  TRUE if the session has been initialized, else FALSE.
	 */
	public function startSession() {
		if ( $this->sessionState == self::SESSION_NOT_STARTED ) {
			try {
				$this->sessionState = session_start();
			} catch (Exception $e) {

			}
		}

		return $this->sessionState;
	}

	/**
	 * Stores datas in the session. Example: $instance->foo = 'bar';
	 *
	 * @param string $name
	 *  Name of the datas.
	 * @param mixed $value
	 *  Your datas.
	 *
	 * @since 1.0.0
	 */
	public function __set( $name, $value ) {
		$_SESSION[ $name ] = $value;
	}

	/**
	 * Gets datas from the session. Example: echo $instance->foo;
	 *
	 * @param string $name
	 *  Name of the datas to get.
	 *
	 * @since 1.0.0
	 * @return mixed
	 */
	public function __get( $name ) {
		if ( isset( $_SESSION[ $name ] ) ) {
			return $_SESSION[ $name ];
		}
	}

	/**
	 * Verify if a session key exists
	 *
	 * @param string $name
	 *  Name of the datas to check.
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	public function __isset( $name ) {
		return isset( $_SESSION[ $name ] );
	}

	/**
	 * Unset the session key
	 *
	 * @param string $name
	 *  Name of the datas to unset.
	 *
	 * @since 1.0.0
	 */
	public function __unset( $name ) {
		unset( $_SESSION[ $name ] );
	}

	/**
	 * Check if the system have active sessions
	 * @since 1.0.0
	 * @return bool
	 *  True for active sessions or false for not active
	 */
	public function haveSessions() {
		if ( $this->sessionState == self::SESSION_STARTED ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Destroys the current session.
	 * @return bool
	 *  TRUE is session has been deleted, else FALSE.
	 * @since 1.0.0
	 */
	public function destroy() {
		if ( $this->sessionState == self::SESSION_STARTED ) {
			$this->sessionState = ! session_destroy();
			unset( $_SESSION );

			return ! $this->sessionState;
		}

		return false;
	}
}

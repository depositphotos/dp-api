<?php

/**
 * Depositphotos API client
 *
 * CURL wrapper for making queries
 *
 * @author	Alexandr Olejnik <urgorka@gmail.com>
 */
class Moo {

	const GET = 1;
	const POST = 2;

	private $sessionId = null;
	private $apiKey = null;
	private $url = null;
	private $isDebug = false;

	/**
	 * Create Moo instance
	 * @param type $url
	 * @param type $apiKey
	 */
	public function __construct($url, $apiKey) {
		$this->url = $url;
		$this->apiKey = $apiKey;
		$this->ch = curl_init();
		curl_setopt_array($this->ch, [
			CURLOPT_RETURNTRANSFER => 1,
		]);
	}

	/**
	 * Makes query
	 * @param str $command API command
	 * @param array $params Kv array with command parameters
	 * @param str $type Type of query self::REQ_TYPE_*
	 */
	public function foo($command, $params = [ ], $type = self::GET) {
		echo '==== Try to ';
		if (!empty($this->sessionId)) $params['dp_session_id'] = $this->sessionId;
		$params['dp_apikey'] = $this->apiKey;
		$params['dp_command'] = $command;

		if (self::GET === $type) {
			echo 'GET "'.$command.'" ==== ';
			curl_setopt($this->ch, CURLOPT_URL, $this->url.'?'.http_build_query($params));
		} elseif (self::POST === $type) {
			echo 'POST "'.$command.'" ==== ';
			curl_setopt_array($this->ch, [
				CURLOPT_URL => $this->url,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => http_build_query($params),
			]);
		}
		$t1 = microtime(true);
		$content = curl_exec($this->ch);
		$t2 = microtime(true);
		echo round($t2-$t1, 3).'s'.PHP_EOL;

		if ($this->isDebug) {
			echo '---Content---:'.PHP_EOL.$content;
			echo '---Err---:'.PHP_EOL.curl_errno($this->ch).PHP_EOL;
			echo '---ErrMsg---:'.PHP_EOL; print_r(curl_error($this->ch)); echo PHP_EOL;
			echo '---Header---:'.PHP_EOL;
			print_r(curl_getinfo($this->ch)); echo PHP_EOL;
		}

		$ret = json_decode($content, true);
		if (is_null($ret)) {
			echo 'Responce is not json. Raw output:'.$content;
			unset($this);
		}
		return $ret;
	}

	public function __destrunct() {
		curl_close($this->ch);
		die();
	}

	public function __get($name) {
		if (isset($this->$name)) return $this->{$name};
		throw new Exception('Moo have not "'.$name.'"');
	}

	public function xDebugEnable($session = 'netbeans-xdebug') {
		curl_setopt($this->ch, CURLOPT_COOKIE, 'XDEBUG_SESSION='.$session.';');
	}

	public function setSessionId($id) {
		$this->sessionId = $id;
	}

	public function setDebug($value) {
		$this->isDebug = (bool)$value;
	}

}

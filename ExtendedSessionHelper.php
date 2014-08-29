<?php
/**
 * Created by samjbarney@gmail.com
 */
App::uses('SessionHelper', 'View/Helper');

class ExtendedSessionHelper extends SessionHelper {

	public $helpers = array(
		'Html'
	);
	public function flash($key = 'flash', $attrs = array()) {
		$out = false;
		// If at least one flash has been set for $key, iterate over each one and display them
		// Otherwise, act like the normal SessionHelper
		if (CakeSession::check("Message.$key") ) {
			$data = CakeSession::read("Message.$key");
			foreach($data as $index=>$message){
				$indexed_key = "$key.$index";
				$output = parent::flash($indexed_key, $attrs);
				if ($output) {
					$out .= $output;
				}
			}
			CakeSession::delete("Message.$key");
		}
		return $out;
	}
}
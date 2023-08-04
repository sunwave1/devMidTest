<?php

require_once __DIR__ . "/Const.php";

/**
 * better in cache( or use a methods statics ), but i go use session
 */
if(!function_exists('storage')){
	function storage() {
		if (!isset($_SESSION['STORAGE']) || isset($_SESSION['STORAGE']) && empty($_SESSION['STORAGE'])) {
			$_SESSION['STORAGE'] = new Storage;
		}
		return $_SESSION['STORAGE'];
	}
}

/**
 * better in cache( or use a methods statics ), but i go use session
 */
if(!function_exists('terms')){
	function terms() {
		if (!isset($_SESSION['TERMS']) || isset($_SESSION['TERMS']) && empty($_SESSION['TERMS'])) {
			$_SESSION['TERMS'] = new Terms;
		}
		return $_SESSION['TERMS'];
	}
}

/**
 * better in cache( or use a methods statics ), but i go use session
 */
if(!function_exists('http')){
	function http() {
		if (!isset($_SESSION['HTTP']) || isset($_SESSION['HTTP']) && empty($_SESSION['HTTP'])) {
			$_SESSION['HTTP'] = new Http;
		}
		return $_SESSION['HTTP'];
	}
}

if(!function_exists('uuId')){
	function uuId(int $rotation = 16){
		$rotation = ($rotation >= MAX_ROTATION) ? MAX_ROTATION : $rotation;
		
		$index = 0;
		$str = "";
		$caracteres = "aAbBcCdDeEfFgGhHiIjJkKlLmMnNoOpPqQrRsStTuUvVwWxXyYzZ1234567890";
		
		while($index < $rotation){
			$str .= $caracteres[
				rand(0,
					strlen($caracteres) - 1
				)
			];
			$index++;
		}

		return $str;
	}	
}
<?php
namespace RestRoute;


class StatusCode{
	private static $status = array('401'=>"Unauthorized"
									,'404'=>'Not Found'
	);
	public static function code($code){
		return $this::$status[$code];
	}
}
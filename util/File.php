<?php

namespace li3_debug\util;

class File {
	/**
	 *
	 */
	public static function sizeHumanized($size) {
		$unit = array('b','kb','mb','gb','tb','pb');
		return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
	}
}

?>
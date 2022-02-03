<?php
/*
Version: 1.0.0
Author: BaaSheep
Author URI: https://baasheep.co.uk/
License: GPLv3
*/
/*
    Copyright (C) 2022  baasheep.co.uk

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/
/**
 * Add debug message support
 */
if (!function_exists('trace_value')) {
    function trace_value($func, ...$logVals)  {
        if (true === WP_DEBUG) {
			$logvalCount=count($logVals);
			$logmessage='';
            if ($logvalCount) {
				foreach ($logVals as $logval) {
					if (is_bool($logval)) {
						$logmessage=$logmessage.($logval ? 'true' : 'false');
					} else if (is_array($logval) || is_object($logval)) {
                		$logmessage=$logmessage.print_r($logval, true);
	            	} else {
    	            	$logmessage=$logmessage.$logval;
        	    	}
					$logvalCount--;
					if ($logvalCount > 0) {
						$logmessage=$logmessage.', ';
					}
				}
			}
			error_log('	'.$logmessage.' //('.$func.')');
        }
    }
}

if (!function_exists('trace_entry')) {
    function trace_entry($func, ...$logVals)  {
        if (true === WP_DEBUG) {
			$logvalCount=count($logVals);
			$logmessage='';
			if ($logvalCount) {
				foreach ($logVals as $logval) {
					if (is_bool($logval)) {
						$logmessage=$logmessage.($logval ? 'true' : 'false');
					} else if (is_array($logval) || is_object($logval)) {
                		$logmessage=$logmessage.print_r($logval, true);
	            	} else {
    	            	$logmessage=$logmessage.$logval;
        	    	}
					$logvalCount--;
					if ($logvalCount > 0) {
						$logmessage=$logmessage.', ';
					}
				}
			}
			error_log($func.'( '.$logmessage.' ) {');
        }
    }
}

if (!function_exists('trace_exit')) {
    function trace_exit($func, $logval=null)  {
        if (true === WP_DEBUG) {
            if (!is_null($logval)) {
				if (is_bool($logval)) {
					$logmessage=($logval ? 'true' : 'false');
				} else if (is_array($logval) || is_object($logval)) {
                	$logmessage=print_r($logval, true);
	            } else {
    	            $logmessage=$logval;
        	    }
			} else {
				$logmessage='';
			}
			error_log('} return( '.$logmessage.' ) //('.$func.')');
        }
    }
}



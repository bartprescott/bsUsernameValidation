<?php

/**
 * @package bsUsernameValidation
 */
/*
Plugin Name: User name validation
Plugin URI: https://baasheep.co.uk/wordpress-plugins/bsUsernameValidation/
Description: bsUsernameValidation is quite possibly the best way to <strong>protect your blog users who insist on using their email address as their username</strong>. To get started: just activate the bsUsernameValidation plugin.
Version: 1.0.0
Author: BaaSheep
Author URI: https://baasheep.co.uk/
License: GPLv3
Text Domain: bsUsernameValidation
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

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('BSUNV__PLUGIN_DIR', plugin_dir_path(__FILE__));

((WP_DEBUG === false) || require_once(BSUNV__PLUGIN_DIR . 'bsDebug.php'));

function bp_validate_username($valid, $username)
{
	((WP_DEBUG === false) || trace_entry(__FUNCTION__, $valid, $username));
	if (preg_match('/[@!#$£%^&*()<>?\|\/}{~:\[\]]/', $username)) {
		// one or more of the 'special characters' found in $username
		((WP_DEBUG === false) || trace_value(__FUNCTION__, $username, 'contains invalid characters.'));
		$valid = false;
	}
	((WP_DEBUG === false) || trace_exit(__FUNCTION__, $valid));
	return $valid;
}
add_filter('validate_username', 'bp_validate_username', 10, 2);

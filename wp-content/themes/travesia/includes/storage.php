<?php
/**
 * Theme storage manipulations
 *
 * @package WordPress
 * @subpackage TRAVESIA
 * @since TRAVESIA 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get theme variable
if (!function_exists('travesia_storage_get')) {
	function travesia_storage_get($var_name, $default='') {
		global $TRAVESIA_STORAGE;
		return isset($TRAVESIA_STORAGE[$var_name]) ? $TRAVESIA_STORAGE[$var_name] : $default;
	}
}

// Set theme variable
if (!function_exists('travesia_storage_set')) {
	function travesia_storage_set($var_name, $value) {
		global $TRAVESIA_STORAGE;
		$TRAVESIA_STORAGE[$var_name] = $value;
	}
}

// Check if theme variable is empty
if (!function_exists('travesia_storage_empty')) {
	function travesia_storage_empty($var_name, $key='', $key2='') {
		global $TRAVESIA_STORAGE;
		if (!empty($key) && !empty($key2))
			return empty($TRAVESIA_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return empty($TRAVESIA_STORAGE[$var_name][$key]);
		else
			return empty($TRAVESIA_STORAGE[$var_name]);
	}
}

// Check if theme variable is set
if (!function_exists('travesia_storage_isset')) {
	function travesia_storage_isset($var_name, $key='', $key2='') {
		global $TRAVESIA_STORAGE;
		if (!empty($key) && !empty($key2))
			return isset($TRAVESIA_STORAGE[$var_name][$key][$key2]);
		else if (!empty($key))
			return isset($TRAVESIA_STORAGE[$var_name][$key]);
		else
			return isset($TRAVESIA_STORAGE[$var_name]);
	}
}

// Inc/Dec theme variable with specified value
if (!function_exists('travesia_storage_inc')) {
	function travesia_storage_inc($var_name, $value=1) {
		global $TRAVESIA_STORAGE;
		if (empty($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = 0;
		$TRAVESIA_STORAGE[$var_name] += $value;
	}
}

// Concatenate theme variable with specified value
if (!function_exists('travesia_storage_concat')) {
	function travesia_storage_concat($var_name, $value) {
		global $TRAVESIA_STORAGE;
		if (empty($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = '';
		$TRAVESIA_STORAGE[$var_name] .= $value;
	}
}

// Get array (one or two dim) element
if (!function_exists('travesia_storage_get_array')) {
	function travesia_storage_get_array($var_name, $key, $key2='', $default='') {
		global $TRAVESIA_STORAGE;
		if (empty($key2))
			return !empty($var_name) && !empty($key) && isset($TRAVESIA_STORAGE[$var_name][$key]) ? $TRAVESIA_STORAGE[$var_name][$key] : $default;
		else
			return !empty($var_name) && !empty($key) && isset($TRAVESIA_STORAGE[$var_name][$key][$key2]) ? $TRAVESIA_STORAGE[$var_name][$key][$key2] : $default;
	}
}

// Set array element
if (!function_exists('travesia_storage_set_array')) {
	function travesia_storage_set_array($var_name, $key, $value) {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if ($key==='')
			$TRAVESIA_STORAGE[$var_name][] = $value;
		else
			$TRAVESIA_STORAGE[$var_name][$key] = $value;
	}
}

// Set two-dim array element
if (!function_exists('travesia_storage_set_array2')) {
	function travesia_storage_set_array2($var_name, $key, $key2, $value) {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if (!isset($TRAVESIA_STORAGE[$var_name][$key])) $TRAVESIA_STORAGE[$var_name][$key] = array();
		if ($key2==='')
			$TRAVESIA_STORAGE[$var_name][$key][] = $value;
		else
			$TRAVESIA_STORAGE[$var_name][$key][$key2] = $value;
	}
}

// Merge array elements
if (!function_exists('travesia_storage_merge_array')) {
	function travesia_storage_merge_array($var_name, $key, $value) {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if ($key==='')
			$TRAVESIA_STORAGE[$var_name] = array_merge($TRAVESIA_STORAGE[$var_name], $value);
		else
			$TRAVESIA_STORAGE[$var_name][$key] = array_merge($TRAVESIA_STORAGE[$var_name][$key], $value);
	}
}

// Add array element after the key
if (!function_exists('travesia_storage_set_array_after')) {
	function travesia_storage_set_array_after($var_name, $after, $key, $value='') {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if (is_array($key))
			travesia_array_insert_after($TRAVESIA_STORAGE[$var_name], $after, $key);
		else
			travesia_array_insert_after($TRAVESIA_STORAGE[$var_name], $after, array($key=>$value));
	}
}

// Add array element before the key
if (!function_exists('travesia_storage_set_array_before')) {
	function travesia_storage_set_array_before($var_name, $before, $key, $value='') {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if (is_array($key))
			travesia_array_insert_before($TRAVESIA_STORAGE[$var_name], $before, $key);
		else
			travesia_array_insert_before($TRAVESIA_STORAGE[$var_name], $before, array($key=>$value));
	}
}

// Push element into array
if (!function_exists('travesia_storage_push_array')) {
	function travesia_storage_push_array($var_name, $key, $value) {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if ($key==='')
			array_push($TRAVESIA_STORAGE[$var_name], $value);
		else {
			if (!isset($TRAVESIA_STORAGE[$var_name][$key])) $TRAVESIA_STORAGE[$var_name][$key] = array();
			array_push($TRAVESIA_STORAGE[$var_name][$key], $value);
		}
	}
}

// Pop element from array
if (!function_exists('travesia_storage_pop_array')) {
	function travesia_storage_pop_array($var_name, $key='', $defa='') {
		global $TRAVESIA_STORAGE;
		$rez = $defa;
		if ($key==='') {
			if (isset($TRAVESIA_STORAGE[$var_name]) && is_array($TRAVESIA_STORAGE[$var_name]) && count($TRAVESIA_STORAGE[$var_name]) > 0) 
				$rez = array_pop($TRAVESIA_STORAGE[$var_name]);
		} else {
			if (isset($TRAVESIA_STORAGE[$var_name][$key]) && is_array($TRAVESIA_STORAGE[$var_name][$key]) && count($TRAVESIA_STORAGE[$var_name][$key]) > 0) 
				$rez = array_pop($TRAVESIA_STORAGE[$var_name][$key]);
		}
		return $rez;
	}
}

// Inc/Dec array element with specified value
if (!function_exists('travesia_storage_inc_array')) {
	function travesia_storage_inc_array($var_name, $key, $value=1) {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if (empty($TRAVESIA_STORAGE[$var_name][$key])) $TRAVESIA_STORAGE[$var_name][$key] = 0;
		$TRAVESIA_STORAGE[$var_name][$key] += $value;
	}
}

// Concatenate array element with specified value
if (!function_exists('travesia_storage_concat_array')) {
	function travesia_storage_concat_array($var_name, $key, $value) {
		global $TRAVESIA_STORAGE;
		if (!isset($TRAVESIA_STORAGE[$var_name])) $TRAVESIA_STORAGE[$var_name] = array();
		if (empty($TRAVESIA_STORAGE[$var_name][$key])) $TRAVESIA_STORAGE[$var_name][$key] = '';
		$TRAVESIA_STORAGE[$var_name][$key] .= $value;
	}
}

// Call object's method
if (!function_exists('travesia_storage_call_obj_method')) {
	function travesia_storage_call_obj_method($var_name, $method, $param=null) {
		global $TRAVESIA_STORAGE;
		if ($param===null)
			return !empty($var_name) && !empty($method) && isset($TRAVESIA_STORAGE[$var_name]) ? $TRAVESIA_STORAGE[$var_name]->$method(): '';
		else
			return !empty($var_name) && !empty($method) && isset($TRAVESIA_STORAGE[$var_name]) ? $TRAVESIA_STORAGE[$var_name]->$method($param): '';
	}
}

// Get object's property
if (!function_exists('travesia_storage_get_obj_property')) {
	function travesia_storage_get_obj_property($var_name, $prop, $default='') {
		global $TRAVESIA_STORAGE;
		return !empty($var_name) && !empty($prop) && isset($TRAVESIA_STORAGE[$var_name]->$prop) ? $TRAVESIA_STORAGE[$var_name]->$prop : $default;
	}
}
?>
<?php namespace Hkan\Settings\Drivers;

/**
 * Interface Driver
 * @package Hkan\Settings\Drivers
 */
interface DriverInterface {

	/**
	 * @param $name
	 * @return string
	 */
	public function get($name);

	/**
	 * @param $name
	 * @param $value
	 */
	public function set($name, $value);

}
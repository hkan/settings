<?php namespace Hkan\Settings\Drivers;

/**
 * Class EloquentDriver
 * @package Hkan\Settings\Drivers
 */
class EloquentDriver extends AbstractDriver implements DriverInterface {

	/**
	 * @param $name
	 * @return string
	 * @todo
	 */
	public function get($name)
	{
		return '';
	}

	/**
	 * @param $name
	 * @param $value
	 * @return self
	 * @todo
	 */
	public function set($name, $value)
	{
		return $this;
	}

}

<?php namespace Hkan\Settings;

/**
 * Class Settings
 * @package Hkan\Settings
 */
class Settings {

	/**
	 * @var mixed
	 */
	protected $driver = null;

	/**
	 *
	 */
	public function __construct()
	{
		$class_prefix = 'Hkan\\Settings\\Drivers\\';
		$class_suffix = 'Driver';
		$config_driver = $class_prefix . ucfirst(app('config')->get('settings::config.driver')) . $class_suffix;

		$class = (class_exists($config_driver) ? $config_driver : $class_prefix . 'Array' . $class_suffix);

		$this->driver = new $class;
	}

	/**
	 * @param $name
	 * @return null|string
	 */
	public function get($name)
	{
		return $this->driver->get($name);
	}

	/**
	 * @param $name
	 * @param $value
	 */
	public function set($name, $value)
	{
		$this->driver->set($name, $value);
	}

}

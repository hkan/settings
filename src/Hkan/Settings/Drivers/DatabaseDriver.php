<?php namespace Hkan\Settings\Drivers;

/**
 * Class DatabaseDriver
 * @package Hkan\Settings\Drivers
 */
class DatabaseDriver extends AbstractDriver implements DriverInterface {

	/**
	 * @var array
	 */
	protected $cache = [];

	/**
	 * @param $name
	 * @return null|string
	 */
	public function get($name)
	{
		if ($this->cacheHas($name))
		{
			return $this->cacheGet($name);
		}

		$item = $this->find($name);

		if ($item)
		{
			$this->cacheSet($name, $item->value);

			return $item->value;
		}

		return null;
	}

	/**
	 * @param $name
	 * @param $value
	 * @todo
	 */
	public function set($name, $value)
	{
		if ($this->get($name) !== null)
		{
			$this->table()->where('name', $name)->update([ 'value' => $value ]);
		}
		else
		{
			$this->table()->insert([
				'name' => $name,
				'value' => $value
			]);
		}

		$this->cacheSet($name, $value);
	}

	/**
	 * @param $name
	 * @return mixed|static
	 */
	protected function find($name)
	{
		return $this->table()
			->where('name', $name)
			->first();
	}

	/**
	 * @param $name
	 * @return bool
	 */
	protected function cacheHas($name)
	{
		return array_key_exists($name, $this->cache);
	}

	/**
	 * @param $name
	 * @return mixed
	 */
	protected function cacheGet($name)
	{
		return array_get($this->cache, $name);
	}

	/**
	 * @param $name
	 * @param $value
	 * @return array
	 */
	protected function cacheSet($name, $value)
	{
		return array_set($this->cache, $name, $value);
	}

	/**
	 * @return \Illuminate\Database\Query\Builder
	 */
	protected function table()
	{
		return app('db')->table(app('config')->get('settings::config.table'));
	}

}

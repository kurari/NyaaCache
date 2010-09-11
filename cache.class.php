<?php
/**
 * Cache Controller
 *
 */
require_once 'object/object.class.php';

class NyaaCache extends NyaaObject
{
	static $handlers = array( );

	static public function factory( $type, $name, $option = array() )
	{
		require_once 'cache/cache.dir.class.php';
		require_once 'cache/cache.memcached.class.php';
		$class = 'NyaaCache'.ucfirst($type);
		$handler = new $class($name, $option);
		return $handler;
	}

	static public function stack( $object )
	{
		self::$handlers[] = $object;
	}
	static public function current()
	{
		return self::$handlers[count(self::$handlers)-1];
	}
	static public function pop( $object )
	{
		return array_pop(self::$handlers);
	}
		

	function __construct($name, $option)
	{
		$this->name = $name;
	}

	function set($key, $value, $expire = 0)
	{
	}

	function get($key)
	{
	}

	function del($key)
	{
	}
}

?>

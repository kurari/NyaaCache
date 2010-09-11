<?php
/**
 * Cache Handler Logic MemCache
 *
 */
class NyaaCacheMemcached extends NyaaCache
{
	/**
	 * @param string
	 * @param option { hosts=>array( array('name'=>'localhost','port'=>11211)) }
	 */
	function __construct($name, $option)
	{
		parent::__construct($name, $option);
		$this->mm = new Memcached( );

		if(is_array($option['hosts'])) foreach( $option['hosts'] as $host ) {
			$this->mm->addServer($host['name'], $host['port']);
		}
	}

	function set($key, $value, $expire = 0)
	{
		return $this->mm->set($this->name.'-'.$key, $value, $expire);
	}

	function get($key)
	{
		return $this->mm->get($this->name.'-'.$key);
	}

	function del($key)
	{
		return $this->mm->delete($this->name.'-'.$key);
	}
}
?>

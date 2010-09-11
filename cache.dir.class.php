<?php
/**
 * Cache Handler Logic Dir
 *
 */
class NyaaCacheDir extends NyaaCache
{
	public $path;
	public $name;

	/**
	 * @param string
	 * @param option { path=>'/tmp }
	 */
	function __construct($name, $option)
	{
		parent::__construct($name, $option);
		$this->path = $option['path'];
		$this->name = $name;
	}

	function set($key, $value, $expire = 0)
	{
		if($expire > 0 && $expire < 60*60*24*30)
			$expire = time() + $expire;
		$key = $this->path.'/'.$this->name.'-'.$key;
		$value = serialize($value);
		file_put_contents($key, $value);
		if( $expire !== 0 )
			file_put_contents($key.'.expire', $expire);
	}

	function get($key)
	{
		$key    = $this->path.'/'.$this->name.'-'.$key;
		if(file_exists($key.'.expire')){
			$expire = file_get_contents($key.'.expire');
			if($expire > 0 && time() > $expire){
				$this->del($key);
				return false;
			}
		}
		if(file_exists($key)){
			$value  = file_get_contents($key);
			return unserialize($value);
		}
		return false;
	}

	function del($key)
	{
		$key    = $this->path.'/'.$this->name.'-'.$key;
		if(file_exists($key)) unlink($key);
		if(file_exists($key.".expire")) unlink($key.'.expire');
	}
}
?>

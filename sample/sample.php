<?php
$c = NyaaCache::factory(
	'memcached',
	'test',
	array(
		'hosts'=>array(array('name'=>'localhost', 'port'=>11211))
	)
);
$c = NyaaCache::factory(
	'dir',
	'test',
	array('path'=>ROOT.'/site/cache')
);
$c->set('a','aaaa',40);
$c->set('b','111',40);
$c->set('c',new stdclass,40);

var_dump($c->get('a'));
var_dump($c->get('b'));
var_dump($c->get('c'));
?>

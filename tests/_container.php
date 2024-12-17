<?php

use Nip\Cache\Stores\Repository;
use Nip\Config\Config;
use Nip\Container\Container;
use Nip\Inflector\Inflector;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$container = new Container();
Container::setInstance($container);

$cachePath = TEST_FIXTURE_PATH.'/storage/cache';
array_map(function ($path) {
    if (is_file($path)) {
        unlink($path);
    }
}, glob($cachePath.'/@/*'));

$adapter = new FilesystemAdapter('', 600, $cachePath);
$store = new Repository($adapter);
$store->clear();
$container->set('cache.store', $store);

$container->set('inflector', Inflector::instance());
$container->set('config', new Config([], true));

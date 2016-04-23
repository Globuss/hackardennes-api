<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

/**
 * @var Composer\Autoload\ClassLoader
 */
$loader = require __DIR__.'/../app/autoload.php';

$config = ['env' => 'prod', 'debug' => false];
if (is_file(__DIR__.'/../env.php')) {
    $config = require __DIR__ . '/../env.php';
}

if ($config['debug']) {
    Debug::enable();
} else {
    include_once __DIR__.'/../app/bootstrap.php.cache';
}

/*
$apcLoader = new Symfony\Component\ClassLoader\ApcClassLoader(sha1(__DIR__), $loader);
$loader->unregister();
$apcLoader->register(true);
*/

$kernel = new AppKernel($config['env'], $config['debug']);
$kernel->loadClassCache();

$request  = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

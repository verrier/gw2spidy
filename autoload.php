<?php

// autoload.php generated by Composer
if (!class_exists('Composer\\Autoload\\ClassLoader', false)) {
    require __DIR__ . '/vendor/composer' . '/ClassLoader.php';
}

$loader = new \Composer\Autoload\ClassLoader();
$composerDir = __DIR__ . '/vendor/composer';

$map = require $composerDir . '/autoload_namespaces.php';
foreach ($map as $namespace => $path) {
    $loader->add($namespace, $path);
}

$classMap = require $composerDir . '/autoload_classmap.php';
if ($classMap) {
    $loader->addClassMap($classMap);
}

$loader->add('GW2Spidy', __DIR__.'/src');
$loader->add('Predis',   __DIR__.'/vendor/nrk-predis/lib');
$loader->add('Igorw',    __DIR__.'/vendor/igorw/src');

$loader->register();

$env = new \Igorw\Silex\Env(__DIR__ . "/config/cnf");
$cnf = new \Igorw\Silex\Config($env);

// Include the main Propel script
require_once __DIR__ . '/vendor/propel/runtime/lib/Propel.php';


// Initialize Propel with the runtime configuration
$propelcnf = $cnf->getConfig();
$propelcnf = $propelcnf['propel'];
$propelcnf['classmap'] = include(__DIR__ . '/config/classmap-gw2spidy-conf.php');
Propel::setConfiguration($propelcnf);
Propel::initialize();

// set newrelic_background_job if on CLI and newrelic is enabled
if (function_exists('newrelic_background_job') && php_sapi_name() == 'cli') {
    newrelic_background_job(true);
}

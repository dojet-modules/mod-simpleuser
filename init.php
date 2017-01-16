<?php
namespace Mod\SimpleUser;

use \DAutoloader;

DAutoloader::getInstance()->addNamespacePathArray(__NAMESPACE__,
    array(
        __DIR__.'/',
        __DIR__.'/lib/',
        __DIR__.'/dal/',
        __DIR__.'/model/',
        __DIR__.'/ui/',
    )
);

define('SIMPLEUSER_CONFIG', __DIR__.'/config/');

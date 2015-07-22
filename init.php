<?php
require __DIR__.'/ModuleSimpleUser.class.php';

DAutoloader::getInstance()->addAutoloadPathArray(
    array(
        dirname(__FILE__).'/lib/',
        dirname(__FILE__).'/dal/',
        dirname(__FILE__).'/model/',
    )
);


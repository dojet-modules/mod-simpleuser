<?php
DAutoloader::getInstance()->addAutoloadPathArray(
    array(
        dirname(__FILE__).'/',
        dirname(__FILE__).'/lib/',
        dirname(__FILE__).'/dal/',
        dirname(__FILE__).'/model/',
    )
);


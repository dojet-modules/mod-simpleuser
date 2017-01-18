<?php
$__su_tmp = realpath(__DIR__.'/../ui/').'/';

Dispatcher::loadNamespaceRoute('\Mod\SimpleUser\\',
    array(
        '/^signin$/' => $__su_tmp.'SimpleSigninAction',
        '/^signup$/' => $__su_tmp.'SimpleSignupAction',
        '/^signout$/' => $__su_tmp.'SimpleSignoutAction',
        '/^signin\-commit$/' => $__su_tmp.'SimpleSigninCommitAction',
        '/^signup\-commit$/' => $__su_tmp.'SimpleSignupCommitAction',
    )
);

unset($__su_tmp);

<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSigninDelegate {

    public function template();

    public function beforeDisplay(SimpleSigninAction $action);

}

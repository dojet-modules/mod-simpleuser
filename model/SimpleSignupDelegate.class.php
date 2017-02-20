<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSignupDelegate {

    public function template();

    public function beforeDisplay(SimpleSignupAction $action);

}

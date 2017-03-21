<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSigninCommitDelegate {

    public function shouldSignin(&$username, &$password);
    public function didSignin(MSimpleUser $simpleUser);
    public function signinFailed(\Exception $e);

}

<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSignupCommitDelegate {

    public function shouldSignup(&$username, &$password);
    public function didSignup(MSimpleUser $simpleUser);
    public function userAlreadyExists($username);
    public function nextJump();

}

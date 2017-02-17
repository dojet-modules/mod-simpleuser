<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSignupCommitDelegate {

    public function didSignup($username, $password);

}
<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSigninCommitDelegate {

    public function willSignin($username, $password);
    public function didSignin(MSimpleUser $simpleUser);

}
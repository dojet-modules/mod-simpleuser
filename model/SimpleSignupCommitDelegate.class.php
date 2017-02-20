<?php
/**
 * @author liyan
 * @since 2017 2 17
 */
namespace Mod\SimpleUser;

interface SimpleSignupCommitDelegate {

    public function willSignup(&$username, &$password);
    public function didSignup(MSimpleUser $simpleUser);

}

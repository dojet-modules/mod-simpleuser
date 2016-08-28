<?php
/**
 *
 * Filename: SimpleSigninCommitAction.class.php
 *
 * @author liyan
 * @since 2016 8 27
 */
namespace Mod\SimpleUser;

class SimpleSigninCommitAction extends AbstractSimpleUserBaseAction {

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        MSimpleUser::signin($username, $password);

        redirect('/');
    }

}

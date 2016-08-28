<?php
/**
 *
 * Filename: SimpleSignupCommitAction.class.php
 *
 * @author liyan
 * @since 2016 8 27
 */
namespace Mod\SimpleUser;
use \MRequest;

class SimpleSignupCommitAction extends AbstractSimpleUserBaseAction {

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        var_dump($username, $password, $_POST);

        MSimpleUser::signup($username, $password);

        MSimpleUser::signin($username, $password);

        // redirect('/');
    }

}

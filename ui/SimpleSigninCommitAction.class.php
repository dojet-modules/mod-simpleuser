<?php
/**
 *
 * Filename: SimpleSigninCommitAction.class.php
 *
 * @author liyan
 * @since 2016 8 27
 */
namespace Mod\SimpleUser;
use \MRequest;

class SimpleSigninCommitAction extends AbstractSimpleUserBaseAction {

    protected static $delegate;

    public static function setDelegate(SimpleSigninCommitDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        if (false === safeCallMethod(self::$delegate, 'shouldSignup', $username, $password)) {
            return $this->abort($username, $password);
        } else {
            safeCallMethod(self::$delegate, 'willSignin', $username, $password);
            $simpleUser = MSimpleUser::signin($username, $password);
            safeCallMethod(self::$delegate, 'didSignin', $simpleUser);
            redirect('/');
        }
    }

    public function abort($username, $password) {
        print 'abort';
    }

}

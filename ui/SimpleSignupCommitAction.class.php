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

    protected static $delegate;

    public static function setDelegate(SimpleSignupCommitDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        if (false === safeCallMethod(self::$delegate, 'shouldSignup', $username, $password)) {
            return $this->abort($username, $password);
        } else {
            MSimpleUser::signup($username, $password);
            MSimpleUser::signin($username, $password);
            safeCallMethod(self::$delegate, 'didSignup', $username, $password);
            redirect('/');
        }
    }

    public function abort($username, $password) {
        print 'abort';
    }

}

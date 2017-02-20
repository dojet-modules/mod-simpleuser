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

class SimpleSigninCommitAction extends AbstractSimpleUserBaseAction
implements SimpleSigninCommitDelegate {

    protected static $delegate;

    public static function setDelegate(SimpleSigninCommitDelegate $delegate) {
        parent::__construct();
        $delegate = ModuleSimpleUser::config('delegate.signincommit');
        self::setDelegate($delegate ? $delegate : $this);
    }

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        // if (false === safeCallMethod(self::$delegate, 'shouldSignin', $username, $password)) {
        //     return $this->abort($username, $password);
        // } else {
            safeCallMethod(self::$delegate, 'willSignin', $username, $password);
            $simpleUser = MSimpleUser::signin($username, $password);
            safeCallMethod(self::$delegate, 'didSignin', $simpleUser);
            redirect('/');
        // }
    }

    public function abort($username, $password) {
        print 'abort';
    }

    public function willSignin($username, $password) {

    }

    public function didSignin(MSimpleUser $simpleUser) {

    }

}

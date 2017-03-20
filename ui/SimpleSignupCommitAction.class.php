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

class SimpleSignupCommitAction extends AbstractSimpleUserBaseAction
implements SimpleSignupCommitDelegate {

    protected static $delegate;

    function __construct() {
        parent::__construct();
        $delegate = ModuleSimpleUser::config('delegate.signupcommit');
        self::setDelegate($delegate ? $delegate : $this);
    }

    public static function setDelegate(SimpleSignupCommitDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        if (self::$delegate) {
            $ret = self::$delegate->willSignup($username, $password);
            if (false === $ret) {
                return;
            }
        }

        try {
            MSimpleUser::signup($username, $password);
        } catch (\Exception $e) {
            return safeCallMethod(self::$delegate, 'userAlreadyExists', $username);
        }

        $simpleUser = MSimpleUser::signin($username, $password);
        safeCallMethod(self::$delegate, 'didSignup', $simpleUser);
        redirect('/');
    }

    public function willSignup(&$username, &$password) {

    }

    public function didSignup(MSimpleUser $simpleUser) {
        # code...
    }

    public function userAlreadyExists($username) {
        print '用户名已存在';
    }

}

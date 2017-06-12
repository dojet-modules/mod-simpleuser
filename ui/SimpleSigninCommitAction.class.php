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

    function __construct(\WebService $webService) {
        parent::__construct($webService);
        $delegate = ModuleSimpleUser::config('delegate.signincommit');
        self::setDelegate($delegate ? $delegate : $this);
    }

    public static function setDelegate(SimpleSigninCommitDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        $username = MRequest::post('username');
        $password = MRequest::post('password');

        $delegate = self::$delegate;
        if (false === $delegate->shouldSignin($username, $password)) {
            return $this->displayNoticePage($delegate);
        }

        try {
            $simpleUser = MSimpleUser::signin($username, $password);
        } catch (\Exception $e) {
            $delegate->signinFailed($e);
            return $this->displayNoticePage($delegate);
        }
        $delegate->didSignin($simpleUser);
    }

    public function abort($username, $password) {
        print 'abort';
    }

    public function shouldSignin(&$username, &$password) {

    }

    public function didSignin(MSimpleUser $simpleUser) {
        redirect('/');
    }

    public function signinFailed(\Exception $e) {

    }
}

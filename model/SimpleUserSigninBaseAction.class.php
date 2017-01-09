<?php
/**
 * description
 *
 * Filename: AbstractSimpleUserBaseAction.class.php
 *
 * @author liyan
 * @since 2014 8 19
 */
namespace Mod\SimpleUser;

abstract class SimpleUserSigninBaseAction extends AbstractSimpleUserBaseAction {

    final public function execute() {
        try {
            $user = MSimpleUser::getSigninUser();
        } catch (Exception $e) {
            return $this->notSignin();
        }

        return $this->signinExecute($user);
    }

    abstract protected function signinExecute(MSimpleUser $user);

    protected function notSignin() {
        redirect('/signin');
    }

}

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
            $me = MSimpleUser::getSigninUser();
        } catch (\Exception $e) {
            $this->assign('is_signin', false);
            return $this->notSignin();
        }

        $this->assign('is_signin', true);
        $this->assign('me', $me);
        return $this->simpleUserSigninExecute($me);
    }

    abstract protected function simpleUserSigninExecute(MSimpleUser $me);

    protected function notSignin() {
        redirect('/signin');
    }

}

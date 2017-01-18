<?php
/**
 *
 * Filename: SimpleSignoutAction.class.php
 *
 * @author liyan
 * @since 2016 8 27
 */
namespace Mod\SimpleUser;
use \MRequest;

class SimpleSignoutAction extends AbstractSimpleUserBaseAction {

    public function execute() {
        MSimpleUser::signout();
        redirect('/');
    }

}

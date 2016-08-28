<?php
/**
 *
 * Filename: SimpleSigninAction.class.php
 *
 * @author liyan
 * @since 2016 8 27
 */
namespace Mod\SimpleUser;

class SimpleSigninAction extends AbstractSimpleUserBaseAction {

    public function execute() {
        $this->displayTemplate('signin.tpl.php');
    }

}

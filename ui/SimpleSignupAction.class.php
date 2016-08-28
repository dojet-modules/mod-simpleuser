<?php
/**
 *
 * Filename: SimpleSignupAction.class.php
 *
 * @author liyan
 * @since 2016 8 28
 */
namespace Mod\SimpleUser;

class SimpleSignupAction extends AbstractSimpleUserBaseAction {

    public function execute() {
        $this->displayTemplate('signup.tpl.php');
    }

}

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

abstract class AbstractSimpleUserBaseAction extends \XBaseAction {

    protected function templatePrefix($template) {
        return realpath(__DIR__.'/../template').'/';
    }

    protected function displayNoticePage($sign) {
        if (!($sign instanceof SimpleSign)) {
            return ;
        }
        $notice = $sign->notice();
        $template = $sign->noticeTemplate();

        $message = $notice->message();
        $links = $notice->links();

        $this->assign('message', $message);
        $this->assign('links', $links);
        $this->display($template);
    }

}

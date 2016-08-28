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

}

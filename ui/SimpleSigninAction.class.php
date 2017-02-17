<?php
/**
 *
 * Filename: SimpleSigninAction.class.php
 *
 * @author liyan
 * @since 2016 8 27
 */
namespace Mod\SimpleUser;

class SimpleSigninAction extends AbstractSimpleUserBaseAction
implements SimpleSigninDelegate {

    protected static $delegate;

    function __construct() {
        parent::__construct();
        self::setDelegate($this);
    }

    public static function setDelegate(SimpleSigninDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        $template = safeCallMethod(self::$delegate, 'template');
        $this->display($template);
    }

    public function template() {
        return realpath(__DIR__.'/../template').'/signin.tpl.php';
    }

}

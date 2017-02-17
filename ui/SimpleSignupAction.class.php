<?php
/**
 *
 * Filename: SimpleSignupAction.class.php
 *
 * @author liyan
 * @since 2016 8 28
 */
namespace Mod\SimpleUser;

class SimpleSignupAction extends AbstractSimpleUserBaseAction
implements SimpleSignupDelegate {

    protected static $delegate;

    function __construct() {
        parent::__construct();
        self::setDelegate($this);
    }

    public static function setDelegate(SimpleSignupDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        $template = safeCallMethod(self::$delegate, 'template');
        $this->display($template);
    }

    public function template() {
        return realpath(__DIR__.'/../template').'/signup.tpl.php';
    }

}

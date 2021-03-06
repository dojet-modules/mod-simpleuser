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

    function __construct(\WebService $webService) {
        parent::__construct($webService);
        $delegate = ModuleSimpleUser::config('delegate.signup');
        self::setDelegate($delegate ? $delegate : $this);
    }

    public static function setDelegate(SimpleSignupDelegate $delegate) {
        self::$delegate = $delegate;
    }

    public function execute() {
        if (false === safeCallMethod(self::$delegate, 'beforeDisplay', $this)) {
            return;
        }
        $template = safeCallMethod(self::$delegate, 'template');
        $this->display($template);
    }

    public function template() {
        return realpath(__DIR__.'/../template').'/signup.tpl.php';
    }

    public function beforeDisplay(SimpleSignupAction $action) {

    }

}

<?php
/**
 * Filename: ModuleSimpleUser.class.php
 *
 * @author liyan
 * @since 2015 7 21
 */
namespace Mod\SimpleUser;

use \BaseModule;
use \IDatabaseModule;

class ModuleSimpleUser extends BaseModule
implements IDatabaseModule {

    private $persistentCookieName = '_pss';
    private $aesKey = 'iwillwiniwillwin';
    private $aesIV = 'noproblem.......';

    protected $database;
    protected $tableNameUser = 'simple_user';

    public function database() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
        return $this;
    }

    public function tableNameUser() {
        return $this->tableNameUser;
    }

    public function setTableNameUser($tableNameUser) {
        $this->tableNameUser = $tableNameUser;
        return $this;
    }

    public function setPersistentCookieName($persistentCookieName) {
        $this->persistentCookieName = $persistentCookieName;
    }

    public function persistentCookieName() {
        return $this->persistentCookieName;
    }

    public function setAesKey($aesKey) {
        $this->aesKey = $aesKey;
    }

    public function aesKey() {
        return $this->aesKey;
    }

    public function setAesIV($aesIV) {
        $this->aesIV = $aesIV;
    }

    public function aesIV() {
        return $this->aesIV;
    }

    public static function setSigninDelegate(SimpleSigninDelegate $delegate) {
        return $this->config('delegate.signin', $delegate);
    }

    public static function setSigninCommitDelegate(SimpleSigninCommitDelegate $delegate) {
        return $this->config('delegate.signincommit', $delegate);
    }

    public static function setSignupDelegate(SimpleSignupDelegate $delegate) {
        return $this->config('delegate.signup', $delegate);
    }

    public static function setSignupCommitDelegate(SimpleSignupCommitDelegate $delegate) {
        return $this->config('delegate.signupcommit', $delegate);
    }

}

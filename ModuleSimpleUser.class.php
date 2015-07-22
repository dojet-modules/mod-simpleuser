<?php
/**
 * Filename: ModuleSimpleUser.class.php
 *
 * @author liyan
 * @since 2015 7 21
 */
class ModuleSimpleUser extends BaseModule
implements IDatabaseModule {

    private $persistentCookieName = '_pss';

    private static $aes_key = 'iwillwin';
    private static $aes_iv = 'noproblem.......';

    protected $database;

    function __construct() {
        $this->persistentCookieName = '_pss';
        $this->aes_key = 'iwillwin';
        $this->aes_iv = 'noproblem.......';
    }

    public function database() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
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

}

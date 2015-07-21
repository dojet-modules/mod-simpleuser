<?php
/**
 * description
 *
 * Filename: LibUser.class.php
 *
 * @author liyan
 * @since 2014 12 18
 */
class LibUser {

    const PERSISTENT_COOKIE_NAME = '_pss';

    private static $aes_key = 'iwillwin';
    private static $aes_iv = 'noproblem.......';

    public static function persistentAuth($username, $md5password) {
        $aes = AESMcrypt::AES128CBC(self::$aes_key, self::$aes_iv);
        $auth = array($username, $md5password);
        $ser = serialize($auth);
        $encrypt = $aes->encrypt($ser);
        $data = base64_encode($encrypt);
        MCookie::setCookie(self::PERSISTENT_COOKIE_NAME, $data, 86400 * 30 + time(), '/');
    }

    public static function resolvePersistentAuth() {
        $data = MCookie::getCookie(self::PERSISTENT_COOKIE_NAME);
        if (is_null($data)) {
            return null;
        }
        $aes = AESMcrypt::AES128CBC(self::$aes_key, self::$aes_iv);
        $encrypt = base64_decode($data);
        $ser = $aes->decrypt($encrypt);
        $auth = unserialize($ser);
        return $auth;
    }

    public static function removePersistentAuth() {
        MCookie::removeCookie(self::PERSISTENT_COOKIE_NAME);
    }

}


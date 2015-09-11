<?php
/**
 * description
 *
 * Filename: LibSimpleUser.class.php
 *
 * @author liyan
 * @since 2014 12 18
 */
namespace Mod\SimpleUser;

class LibSimpleUser {

    protected static function persistentCookieName() {
        return ModuleSimpleUser::module()->persistentCookieName();
    }

    protected static function aesKey() {
        return ModuleSimpleUser::module()->aesKey();
    }

    protected static function aesIV() {
        return ModuleSimpleUser::module()->aesIV();
    }

    public static function persistentAuth($username, $md5password) {
        $aes = AESMcrypt::AES128CBC(self::aesKey(), self::aesIV());
        $auth = array($username, $md5password);
        $ser = serialize($auth);
        $encrypt = $aes->encrypt($ser);
        $data = base64_encode($encrypt);
        MCookie::setCookie(self::persistentCookieName(), $data, 86400 * 30 + time(), '/');
    }

    public static function resolvePersistentAuth() {
        $data = MCookie::getCookie(self::persistentCookieName());
        if (is_null($data)) {
            return null;
        }
        $aes = AESMcrypt::AES128CBC(self::aesKey(), self::aesIV());
        $encrypt = base64_decode($data);
        $ser = $aes->decrypt($encrypt);
        $auth = unserialize($ser);
        return $auth;
    }

    public static function removePersistentAuth() {
        MCookie::removeCookie(self::persistentCookieName());
    }

}


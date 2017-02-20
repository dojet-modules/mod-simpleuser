<?php
/**
 * @author liyan
 * @since 2015 7 21
 */
namespace Mod\SimpleUser;
use \DAssert;

class MSimpleUser {

    const E_NOT_SIGNIN  = 0x00100001;   # 未登录
    const E_LOGOFF      = 0x00100002;   # 已注销

    protected $uid;
    protected $username;

    function __construct($uid, $username) {
        $this->uid = $uid;
        $this->username = $username;
    }

    public function username() {
        return $this->username;
    }

    public function uid() {
        return $this->uid;
    }

    public static function md5password($password) {
        $md5password = $password;
        for ($i = 0; $i < 5; $i++) {
            $md5password = md5($md5password);
        }
        return $md5password;
    }

    public static function simpleUserFromDBRecord($record) {
        $simpleUser = new MSimpleUser($record['uid'], $record['username']);
        return $simpleUser;
    }

    public static function userFromUsernamePassword($username, $md5password) {
        $userinfo = DalSimpleUser::getUserFromUsernamePassword($username, $md5password);
        if (!$userinfo) {
            throw new \Exception("username and password not match", 1);
        }
        return MSimpleUser::simpleUserFromDBRecord($userinfo);
    }

    public static function getSigninUser() {
        $auth = LibSimpleUser::resolvePersistentAuth();
        if (!$auth) {
            throw new \Exception("not signin", self::E_NOT_SIGNIN);
        }
        list($username, $md5password) = $auth;
        LibSimpleUser::persistentAuth($username, $md5password);

        $record = DalSimpleUser::getUserFromUsernamePassword($username, $md5password);
        if (!$record) {
            throw new \Exception("user has been logoff", self::E_LOGOFF);
        }

        return MSimpleUser::simpleUserFromDBRecord($record);
    }

    public static function signin($username, $password) {
        $md5password = self::md5password($password);
        $simpleUser = self::userFromUsernamePassword($username, $md5password);
        DAssert::assert($simpleUser instanceof MSimpleUser, 'illegal user');
        LibSimpleUser::persistentAuth($username, $md5password);
        return $simpleUser;
    }

    public static function signup($username, $password) {
        $userinfo = DalSimpleUser::getUserByUsername($username);
        if ($userinfo) {
            throw new \Exception("用户已存在", 1);
        }

        $md5password = self::md5password($password);
        return DalSimpleUser::addUser($username, $md5password);
    }

    public static function signout() {
        LibSimpleUser::removePersistentAuth();
    }

}

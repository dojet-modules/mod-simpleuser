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
    const E_WRONG_PWD   = 0x00100003;   # 用户名密码不匹配

    protected $uid;

    protected $record;

    function __construct($uid, $record = null) {
        $this->uid = $uid;
        $this->record = $record;
    }

    public static function simpleUserByUID($uid) {
        return new MSimpleUser($uid);
    }

    public static function simpleUserByUsername($username) {
        $record = DalSimpleUser::getUserFromUsername($username);
        if (is_null($record)) {
            throw new Exception("simpleUser not exists, username=".$username, 1);
        }
        return self::simpleUserFromDBRecord($record);
    }

    protected function loadSimpleUser() {
        $record = DalSimpleUser::getUser($this->uid);
        if (is_null($record)) {
            throw new Exception("simpleUser not exists, uid=".$this->uid, 1);
        }
        return $record;
    }

    protected function record() {
        if (is_null($this->record)) {
            $this->record = loadSimpleUser();
        }
        return $this->record;
    }

    public function username() {
        $record = $this->record();
        return $record['username'];
    }

    public function uid() {
        return $this->uid;
    }

    public static function md5password($username, $password) {
        $md5password = $password;
        for ($i = 0; $i < 5; $i++) {
            $md5password = md5($md5password.md5($username));
        }
        return $md5password;
    }

    public static function simpleUserFromDBRecord($record) {
        $simpleUser = new MSimpleUser($record['uid'], $record);
        return $simpleUser;
    }

    public static function userFromUsernamePassword($username, $md5password) {
        $record = DalSimpleUser::getUserFromUsernamePassword($username, $md5password);
        if (!$record) {
            throw new \Exception("用户名密码不匹配", self::E_WRONG_PWD);
        }
        return MSimpleUser::simpleUserFromDBRecord($record);
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
        $md5password = self::md5password($username, $password);
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

        $md5password = self::md5password($username, $password);
        return DalSimpleUser::addUser($username, $md5password);
    }

    public static function signout() {
        LibSimpleUser::removePersistentAuth();
    }

}

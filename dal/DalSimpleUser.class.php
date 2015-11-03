<?php
/**
 * dal
 *
 * DAL code
 * Filename: DalSimpleUser.class.php
 *
 * @author liyan
 * @since 2015 7 21
 */
namespace Mod\SimpleUser;

use \BaseModuleDal;

class DalSimpleUser extends BaseModuleDal {

    static function module() {
        return ModuleSimpleUser::module();
    }

    protected static function tableNameUser() {
        return static::module()->tableNameUser();
    }

    static function init() {
        $tableNameUser = static::tableNameUser();
        $sql = "CREATE TABLE IF NOT EXISTS `$tableNameUser` (
                  `uid` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(255) NOT NULL COMMENT '用户名',
                  `md5password` char(32) NOT NULL COMMENT 'MD5密码',
                  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
                  PRIMARY KEY (`uid`),
                  UNIQUE KEY `username` (`username`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';";
        self::doCreateTable($sql);

        $arrIns = array(
            'username' => 'admin',
            'md5password' => md5('admin'),
            'createtime' => time(),
            );
        self::doInsert($tableNameUser, $arrIns);
    }

    public static function getUserFromUsernamePassword($username, $md5password) {
        $tableNameUser = static::tableNameUser();
        self::realEscapeString($username);
        self::realEscapeString($md5password);
        $sql = "SELECT *
                FROM $tableNameUser
                WHERE username='$username' AND md5password='$md5password'";
        return self::rs2rowline($sql);
    }

    public static function md5password($password) {
        $md5password = $password;
        for ($i = 0; $i < 5; $i++) {
            $md5password = md5($md5password.md5($password));
        }
        return $md5password;
    }

    public static function getUserList() {
        $tableNameUser = static::tableNameUser();
        $sql = "SELECT *
                FROM $tableNameUser";
        return self::rs2array($sql);
    }

    public static function addUser($username, $password) {
        $md5password = self::md5password($password);
        $arrIns = array(
            'username' => $username,
            'md5password' => $md5password,
            'createtime' => time(),
            );
        return self::doInsert(static::tableNameUser(), $arrIns);
    }

}

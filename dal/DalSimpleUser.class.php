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
class DalSimpleUser extends BaseModuleDal {

    protected static function module() {
        return ModuleSimpleUser::module();
    }

    protected static function tableNameUser() {
        return static::module()->tableNameUser();
    }

    protected static function createTable() {
        $tableNameUser = static::tableNameUser();
        $sql = "CREATE TABLE IF NOT EXISTS `$tableNameUser` (
                  `uid` int(11) NOT NULL AUTO_INCREMENT,
                  `username` varchar(255) NOT NULL COMMENT '用户名',
                  `md5password` char(32) NOT NULL COMMENT 'MD5密码',
                  `createtime` int(10) unsigned NOT NULL COMMENT '创建时间',
                  PRIMARY KEY (`uid`),
                  UNIQUE KEY `username` (`username`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户';";
        return self::doCreateTable($sql);
    }

    public static function getUserFromUsernamePassword($username, $md5password); {
        $tableNameUser = static::tableNameUser();
        self::realEscapeString($username);
        self::realEscapeString($md5password);
        $sql = "SELECT *
                FROM $tableNameUser
                WHERE username='$username' AND md5password='$md5password'";
        return self::rs2rowline($sql);
    }

    public static function getUserList() {
        $tableNameUser = static::tableNameUser();
        $sql = "SELECT *
                FROM $tableNameUser";
        return self::rs2array($sql);
    }

    public static function addUser($username) {
        $arrIns = array(
            'username' => $username,
            );
        return self::doInsert(static::tableNameUser(), $arrIns);
    }

}

<?php
/**
 * dal
 *
 * DAL code
 * Filename: DalUser.class.php
 *
 * @author liyan
 * @since 2015 3 10
 */
class DalUser extends BaseModuleDal {

    protected static function module() {
        return ModuleSimpleUser::module();
    }

    protected function createTable() {
        $sql = "CREATE TABLE IF NOT EXISTS `simple_user` (
                    `uid` int(11) NOT NULL AUTO_INCREMENT,
                    `username` varchar(255) NOT NULL,
                    PRIMARY KEY (`uid`)
                ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='用户'";
        return self::doCreateTable($sql);
    }

    public static function getUserList() {
        $sql = "SELECT *
                FROM simple_user";
        return self::rs2array($sql);
    }

    public static function addUser($username) {
        $arrIns = array(
            'username' => $username,
            );
        return self::doInsert('simple_user', $arrIns);
    }

}

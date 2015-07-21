<?php
/**
 * Filename: ModuleSimpleUser.class.php
 *
 * @author liyan
 * @since 2015 7 21
 */
class ModuleSimpleUser extends BaseModule
implements IDatabaseModule {

    protected $database;

    public function database() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
        return $this;
    }

}

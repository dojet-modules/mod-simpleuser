<?php
/**
 * description
 *
 * Filename: SimpleSign.class.php
 *
 * @author liyan
 * @since 2017 3 21
 */
namespace Mod\SimpleUser;

abstract class SimpleSign {

    private $notice;

    public function notice() {
        return $this->notice;
    }

    protected function setNotice($message, $links) {
        $this->notice = MNotice::notice($message, $links);
    }

    abstract public function noticeTemplate();

}

<?php
/**
 * @author liyan
 * @since 2017 6 12
 */
namespace Mod\SimpleUser;
use \DAssert;

class MNotice {

    protected $message;
    protected $links;

    function __construct($message, $links) {
        $this->message = $message;
        $this->links = $links;
    }

    public static function notice($message, $links) {
        return new MNotice($message, $links);
    }

    public function message() {
        return $this->message;
    }

    public function links() {
        return $this->links;
    }

}

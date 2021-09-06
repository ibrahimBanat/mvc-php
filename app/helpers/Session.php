<?php
namespace app\helpers;

class Session {
    public function __construct() {
        session_start();
    }

    public function isLoggedIn() {
        if(isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }
}

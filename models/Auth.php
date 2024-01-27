<?php
class Auth
{
    public function __construct () {
        echo "OK";
    }

    public function login($email, $password) {
        echo $email . " et " . $password;
    }
}
?>

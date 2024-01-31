<?php
class Auth
{
    private $_cn;
    private $_fullname;
    private $_auth;

    public function __construct ($cn) {
        $this->_cn = $cn;
    }

    public function login($email) {
        $stmt = $this->_cn->prepare("SELECT * FROM users WHERE email = :email AND actif = 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['id'] = $user['id'];
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['lastname'] = $user['lastname'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['phone'] = $user['phone'];
            $_SESSION['actif'] = $user['actif'];
            $_SESSION['designation'] = $user['designation'];
            $_SESSION['adress'] = $user['adress'];
            $_SESSION['city'] = $user['city'];
            $_SESSION['country'] = $user['country'];
            $_SESSION['province'] = $user['province'];
            $_SESSION['postal_code'] = $user['postal_code'];
            $_SESSION['role_id'] = $user['role_id'];

            return $user;
        }
    }

    public function getAuthFullname () {
        return $_SESSION['firstname'] . " " . $_SESSION['lastname'];
    }

    public function refreshSession ($firstname, $lastname, $phone, $designation, $adress, $city, $province, $country, $postal_code) {
         $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['phone'] = $phone;
        $_SESSION['designation'] = $designation;
        $_SESSION['adress'] = $adress;
        $_SESSION['city'] = $city;
        $_SESSION['country'] = $country;
        $_SESSION['province'] = $province;
        $_SESSION['postal_code'] = $postal_code;
    }

    public function userAccountIsBlock ($email) {
        $stmt = $this->_cn->prepare("SELECT `email` FROM `users` WHERE `email` = :email AND actif = 0");
        $stmt->bindParam(':email', $email);
        if ($stmt->execute()) {
            if($stmt->rowCount() > 0) {
                return true;
            }
        }
    }
}
?>

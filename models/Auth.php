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
        $stmt = $this->_cn->prepare("SELECT users.*, roles.name FROM users INNER JOIN roles ON roles.id = users.role_id WHERE users.email = :email AND users.actif = 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
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
            $_SESSION['password'] = $user['password'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['image'] = $user['image'];

            return $user;
        }
    }

    public function getAuthFullname () {
        return $_SESSION['firstname'] . " " . $_SESSION['lastname'];
    }

    public function getAuthProfil () {
        return $_SESSION['name'];
    }

    public function refreshSession ($firstname, $lastname, $phone, $designation, $adress, $city, $province, $country, $postal_code, $image) {
         $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['phone'] = $phone;
        $_SESSION['designation'] = $designation;
        $_SESSION['adress'] = $adress;
        $_SESSION['city'] = $city;
        $_SESSION['country'] = $country;
        $_SESSION['province'] = $province;
        $_SESSION['postal_code'] = $postal_code;
        $_SESSION['image'] = $image ? $image : $_SESSION['image'];
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

    public function isAdmin () {
        return $_SESSION['role_id'] == 1;
    }

    public function isAgent () {
        return $_SESSION['role_id'] == 2;
    }

    public function isCustomer () {
        return $_SESSION['role_id'] == 3;
    }

    public function getAuthImage () {
        return $_SESSION['image'] ? $_SESSION['image'] : "default.jpg";
    }

}
?>

<?php
class PharmacySession {
    public function __construct() {
        session_start();
    }

    public function setCharset($charset) {
        $con = $this->getConnection();
        $con->set_charset($charset);
    }

    public function getUserId() {
        return isset($_SESSION['userid']) ? $_SESSION['userid'] : null;
    }

    public function getUserData($userId) {
        $con = $this->getConnection();
        $getuserdata = "SELECT * FROM `wd_user` WHERE `user_id`='$userId'";
        $userquery = $con->query($getuserdata);
        return $userquery->fetch_array();
    }

    // Add more session-related methods if needed.
    
    public function getConnection() {
        return new mysqli("localhost", "root", "", "pharmacy");
    }
}

class PharmacyUtils {
    private $con;

    public function __construct($con) {
        $this->con = $con;
    }

    public function generateRandomString($length) {
        $letters = str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789');
        return substr($letters, 0, $length);
    }

    public function getDevSet() {
        $sql = "SELECT * FROM `dev_set` WHERE 1=1";
        $query = $this->con->query($sql);
        $row = $query->fetch_array();
        return $row['ds_abbri'];
    }

    public function idRandomizer() {
        $identifier = $this->getDevSet();
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        $length = 18;

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $randomString = strtoupper($randomString);
        $finalid = $identifier . $randomString;
        return $finalid;
    }

    public function getCounter($table) {
        $sql = "SELECT MAX(nc_counter) as max_counter FROM $table";
        $query = $this->con->query($sql);
        $row = $query->fetch_array();
        return $row['max_counter'] + 1;
    }

    public function expirationDate() {
        $month3 = date("Y-m-d", strtotime(date("Y-m-01"). '+ 3 month'));
        return $month3;
    }

    public function selected($val1, $val2) {
        if ($val1 == $val2) {
            return "selected";
        } else {
            // You can handle the else case if needed.
        }
    }

    public function getTodayTrans($user_id){
    $today = date("Y-m-d");
    $sql = "SELECT * FROM `customers` WHERE `transaction_date`='$today' AND `user_id`='$user_id'";
    $query = $this->con->query($sql);
    return $query;
    }
    public function numberToDecimal($percentage){
        $decimal = $percentage / 100;
        return $decimal;
    }
    public function DiscountedPrice($price,$discount){
        $discountis = numberToDecimal($discount);
        $discounted = $price - ($price * $discountis);
        return $discounted;
    }


}

// Usage example:
$pharmacySession = new PharmacySession();
$pharmacySession->setCharset("utf8");
$userId = $pharmacySession->getUserId();

if ($userId !== null) {
    $conn = new PharmacyUtils($pharmacySession->getConnection());
    $user = $pharmacySession->getUserData($userId);
    $usertype = $user['user_access'];
    $userfullname = $user['user_fullname'];
    $loginstat = "template/index1.php"; 

    // Rest of the code...
} else {
    $loginstat = "template/index.php";
    $content = "page_content/login.php";
    $title = "Login Form";
}


// You can now use the PharmacyUtils methods directly, e.g.:

$randomString = $conn->generateRandomString(10);
$devSet = $conn->getDevSet();
$expirationDate = $conn->expirationDate();
$selectedResult = $conn->selected("data", "data");
$gettodaysTrans = $conn->getTodayTrans($userId);
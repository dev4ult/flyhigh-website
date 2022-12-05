<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "nibras";

$conn = mysqli_connect($host, $user, $pass, $database);

function get_all_data($table) {
    global $conn;

    $raw_data = mysqli_query($conn, "SELECT * FROM $table");
    $rows = [];

    while ($row = mysqli_fetch_assoc($raw_data)) {
        array_push($rows, $row);
    }

    return $rows;
}

function get_category($id) {
    global $conn;

    $data = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $id");
    $data = mysqli_fetch_assoc($data);

    return $data;
}

function insert_buy_data($values) {
    global $conn;

    mysqli_query($conn, "INSERT INTO alyassar VALUES $values");
}

function register($data) {
    global $conn;

    $username = $data['username'];
    $password = md5($data['password']);
    $email = md5($data['email']);

    $users = get_all_data('admins');
    if ($data['password'] != $data['password-confirmation']) {
        echo "<script>alert('Password confirmation is not the same')</script>";
        return -1;
    }

    foreach ($users as $user) {
        if ($user['username'] == $username || $user['admin_email'] == $data['email']) {
            echo "<script>alert('That email or username already been used')</script>";
            return -1;
        }
    }

    mysqli_query($conn, "INSERT INTO admins VALUES ('', '$username', '$password', '$email')");

    return mysqli_affected_rows($conn);
}

function login($data) {
    global $conn;

    $umail = $data['umail'];
    $password = md5($data['password']);

    if ($data['captcha-code'] != $data['captcha-input']) {
        echo "<script>alert('Captcha is incorrect')</script>";
        return false;
    }


    $check_exist = mysqli_query($conn, "SELECT * FROM admins WHERE username = '$umail' OR admin_email = '$umail' AND password = '$password'");

    if (mysqli_num_rows($check_exist)) {
        echo "<script>alert('You are logged in')</script>";
        return true;
    } else {
        echo "<script>alert('Username / Email or Password is incorrect')</script>";
        return false;
    }
}
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

function get_one_data($table, $id_name, $id) {
    global $conn;

    $raw_data = mysqli_query($conn, "SELECT * FROM $table WHERE $id_name = $id");

    $row = mysqli_fetch_assoc($raw_data);

    return $row;
}

function get_category($id) {
    global $conn;

    $data = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $id");
    $data = mysqli_fetch_assoc($data);

    return $data;
}

function insert_buy_data($data) {
    global $conn;


    $total_product = $_POST['product-total'];

    if ($total_product <= 0) {
        echo "<script>alert('Total product unknown value')</script>";
        return false;
    }

    $buyer = htmlspecialchars($data['buyer']);
    $address = htmlspecialchars($data['address']);
    $phone_number = htmlspecialchars($data['phone-number']);
    $transaction_date = htmlspecialchars($data['transaction-date']);

    $product_category = htmlspecialchars($data['product-category']);
    $product_name = htmlspecialchars($data['product-name']);
    $product_price = htmlspecialchars($data['product-price']);

    $buy_values = "('', '$buyer', '$address', '$phone_number', '$transaction_date', '$product_category', '$product_name', $total_product, $product_price, 'pending')";

    mysqli_query($conn, "INSERT INTO alyassar VALUES $buy_values");

    if (mysqli_affected_rows($conn) > 0) {
        return true;
    } else {
        echo "<script>alert('There is something wrong with the transaction')</script>";
        return false;
    }
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
        $admin = mysqli_fetch_object($check_exist);
        if ($admin->is_verified) {
            echo "<script>alert('You are logged in')</script>";
            return $admin;
        } else {
            echo "<script>alert('This admin is not yet registered')</script>";
            return false;
        }
    } else {
        echo "<script>alert('Username / Email or Password is incorrect')</script>";
        return false;
    }
}

function delete_transaction($id) {
    global $conn;
    $check_exist = mysqli_query($conn, "SELECT * FROM alyassar WHERE id_pembeli = $id");

    if (mysqli_num_rows($check_exist)) {
        mysqli_query($conn, "DELETE FROM alyassar WHERE id_pembeli = $id");
        echo "<script>alert('One transaction data has been deleted')</script>";
    } else {
        echo "<script>alert('Failed to delete transction data')</script>";
    }

    header('Location: dashboard.php');
    exit;
}

function update_transaction_status($data, $id) {
    global $conn;

    $status = $data['ts-status'];
    mysqli_query($conn, "UPDATE alyassar SET status = '$status' WHERE id_pembeli = $id");

    return mysqli_affected_rows($conn);
}
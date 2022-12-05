<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "nibras";

$conn = mysqli_connect($host, $user, $pass, $database);

function get_all_products()
{
    global $conn;

    $raw_data = mysqli_query($conn, "SELECT * FROM products");
    $rows = [];

    while ($row = mysqli_fetch_assoc($raw_data)) {
        array_push($rows, $row);
    }

    return $rows;
}

function get_category($id)
{
    global $conn;

    $data = mysqli_query($conn, "SELECT * FROM categories WHERE category_id = $id");
    $data = mysqli_fetch_assoc($data);

    return $data;

}

function insert_buy_data($values)
{
    global $conn;

    mysqli_query($conn, "INSERT INTO alyassar VALUES $values");
}
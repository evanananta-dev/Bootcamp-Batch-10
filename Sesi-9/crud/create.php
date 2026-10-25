<?php
require '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    // data validation can be added here if needed
    if (empty($name) || empty($price) || empty($description) || empty($_FILES['image']['name']) || empty($_POST['category'])) {
        // handle the error, e.g., redirect back with an error message
        // echo "Semua field harus diisi!";
        header('Location: ../form/form-input.php');
        exit;
    }
}
?>
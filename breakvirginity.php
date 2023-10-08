<?php
include("includes/conn.php");
session_start();

if (isset($_POST['submit'])) {
    $username = $_SESSION['username'];

    // Check for file upload errors
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // move file to virgin_submissions folder
        $file_name = $_FILES['file']['name'];
        $file_path = "virgin_submissions/" . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);

        $sql = "INSERT INTO virgin_submissions (username, path) VALUES ('$username', '$file_path')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            // if success, redirect to index.php
            header("Location: index.php?page=home");
        } else {
            // if fail, show error
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "File upload failed with error code: " . $_FILES['file']['error'];
    }
}
?>
<?php
include("includes/conn.php"); // Include your database connection file

// Check if the user is logged in before allowing access to this page
if (!is_collaborant() || !is_logged_in()) {
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $elo = $_POST['elo'];

    // File upload handling
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = "uploads/" . $image;

    if (move_uploaded_file($image_tmp, $image_path)) {
        $sql = "INSERT INTO camps (title, description, image, elo) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssi", $title, $description, $image, $elo);

        if (mysqli_stmt_execute($stmt)) {
           echo("<script>alert('Camp created successfully');</script>");
        } else {
            echo "<script>alert('Error creating camp');</script>";
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error uploading image');</script>";
    }
}

?>

<style>
    @import url('https://fonts.googleapis.com/css?family=Gochi+Hand');
    @import url('https://fonts.googleapis.com/css?family=Anonymous+Pro');
    @import url('https://fonts.googleapis.com/css?family=Lato');

    .view-area {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100vh;
    }

    .login {
        background: var(--primary-color);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        margin: auto;
        border: 1px solid black;
        color: white;
    }

    .content:nth-child(n) {
        font-family: Lato;
    }

    input {
        width: 100%;
        height: 40px;
        margin: 10px 0;
        padding-left: 10px;
    }

    .submit-btn {
        margin: 10px 0;
        max-width: 400px;
        padding-left: 10px;
        width: 100%;
        cursor: pointer;
        box-shadow: 5px 5px 0px 0px rgba(0, 0, 0, 0.603);
        transition: background 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.2s ease-out;
    }

    .submit-btn:hover {
        box-shadow: none;
        color: white;
        background: rgba(250, 170, 22, 0.802);
    }


    .submit-link:before {
        content: "";
        position: absolute;
        left: 0px;
        bottom: 0px;
        height: 40px;
        width: 100%;
        transform: scale(1);
        background-color: rgba(255, 106, 0, 0.536);
        transition: 0.2s ease-in-out;
    }

    .submit-link:hover:before {
        transform: scale(1);
    }

    .submission {
        display: flex;
        justify-content: space-around;
        /* 50 50 width */
        flex: 1;
        gap: 10px;
    }

    .content p a {
        text-decoration: none;
        color: white;
    }

    .content p {
        text-align: center;
    }

    .imginput {
        width: 100%;
        height: 40px;
    }
</style>

<div class="login">
    <form action="?page=addcamps" method="post" enctype="multipart/form-data">
        <div class="modal">
            <div class="content">
                <label>Title</label><br>
                <input type="text" name="title"><br>
                <label>Description</label><br><br>
                <textarea name="description" id="" cols="35" rows="10"></textarea><br><br>
                <label for="">Image</label><br>
                <input type="file" name="image" class="imginput">
                <br>
                <label>ELO Requirement</label><br>
                <input type="number" name="elo"><br>

                <div class="submission"><input type="submit" name="submit" class="submit-btn" value="Start Research">

                </div>
            </div>
        </div>
    </form>
</div>

<script>
    document.getElementById("microsoftLogin").addEventListener("click", function() {
        window.location.href = "msauth";
    });
</script>
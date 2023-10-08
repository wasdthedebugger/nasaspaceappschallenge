<?php
global $id;
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM camps WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $title = $row['title'];
    $description = $row['description'];
    $image = $row['image'];
    $elo = $row['elo'];
}

if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $username = $_SESSION['username'];

    $sql = "UPDATE users SET camp_id = $id WHERE username = '$username'";

    if(mysqli_query($conn, $sql)){
        header("Location: index.php?page=home");
    }else{
        echo "<script>alert('Error joining camp');</script>";
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
        max-width: 400px;
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
        text-align: justify;
    }

    .content img{
        width: 100%;
    }
</style>

<div class="login">

    <div class="modal">
        <form action="?page=learnmore" method="post">
        <div class="content">
        <img src="uploads/<?=$image?>" alt="">
        <input type="hidden" name="id" value="<?=$id?>">
            <h1><?=$title?></h1>
            <p><?=$description?></p>
            <p>Required Elo: <?=$elo?></p>
            <input type="submit" name="submit" class="submit-btn" value="Join">
        </div>
        </form>
    </div>

</div>

<script>
    document.getElementById("microsoftLogin").addEventListener("click", function() {
        window.location.href = "msauth";
    });
</script>
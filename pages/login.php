<?php
// if logged in redirect to index.php

if (is_logged_in()) {
    header("Location: index.php");
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // check if user exists
    $sql = "SELECT native FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // user exists
        $row = mysqli_fetch_assoc($result);
        if ($row['native'] == 0) {
            fail("You are not a native user. Please login with Microsoft.");
        }
    } else {
        fail("Invalid email or password");
    }
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        // user exists
        $row = mysqli_fetch_assoc($result);
        $_SESSSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['elo'] = $row['elo'];
        header("Location: index.php");
    } else {
        fail("Invalid email or password");
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
</style>

<div class="login">
    <form action="?page=login" method="post">
    <div class="modal">
        <div class="content">
            <label>Email</label><br>
            <input type="email" name="email"><br>
            <label>Password</label><br>
            <input type="password" name="password"><br>
            <p>Don't have an account? <a href="?page=register">Register an account</a></p>
            <div class="submission"><input type="submit" name="submit" class="submit-btn" value="Login">
                <button name="submit" class="submit-btn" id="microsoftLogin">MS Login</button>
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
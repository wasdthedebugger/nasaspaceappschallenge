<?php

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (username, email, password, user_type, elo, native) VALUES ('$username', '$email', '$password', 'virgin', 0, 1)";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['username'] = $username;
        $_SESSION['user_type'] = 'virgin';
        $_SESSION['email'] = $email;
        $_SESSION['elo'] = 0;
        header("Location: index.php");
    } else {
        fail("Error creating user");
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

    .content p a{
        text-decoration: none;
        color: white;
    }

    .content p{ 
        text-align: center;
    }

    select {
        height: 40px;
        margin: 10px 0;
    }

    .content p a{
        text-decoration: none;
        color: white;
    }

    .content p{
        text-align: center;
    }

</style>

<div class="login"><form action="?page=register" method="post">
    <div class="modal">
        <div class="content">
        <label>Username</label><br>
            <input type="text" name="username"><br>
            <label>Email</label><br>
            <input type="email" name="email"><br>
            <label>Password</label><br>
            <input type="password" name="password"><br>
            <p>Already have an account?<a href="?page=login">&nbsp;&nbsp;Log in</a></p>
            <input type="submit" name="submit" class="submit-btn" value="Register">
        </div>
        </form></div>
</div>

<script>
    document.getElementById("microsoftLogin").addEventListener("click", function() {
        window.location.href = "msauth";
    });
</script>
<?php
// if logged in redirect to index.php
if (!is_virgin()) {
    header("Location: index.php");
} else {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM virgin_submissions WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
?>
        <div class="login">

            <div class="modal">
                <div class="content">
                    <p>You will be able to access the site once your file has finished being reviewed by our moderators.</p>

                </div>
            </div>

        </div>
    <?php
    } else {
    ?>
        <div class="login">
            <form action="breakvirginity.php" method="post" enctype="multipart/form-data">
                <div class="modal">
                    <div class="content">
                        <p>Please upload a pdf file with all of your experience in research and open science collaboration. It can be an award, a contribution, recommendation letters, anything. Make sure to bundle it all in one singular PDF file.</a></p>
                        <input type="file" name="file" id="">
                        <input type="submit" name="submit" class="submit-btn" value="Submit Application">

                    </div>
                </div>
            </form>
        </div>

<?php
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
        max-width: 500px;
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
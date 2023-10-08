<?php

if (!is_logged_in()) {
    header("Location: index.php?page=login");
}else if(is_virgin()){
    header("Location: index.php?page=virginsubmissions");
}else{
?>
<div class="main">
    <div class="scroll-area">
        <?php
        $elo = $_SESSION['elo'];
        $sql = "SELECT * FROM camps WHERE elo <= $elo";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="post">
                <div class="post-header">
                    <h1>
                        <?php echo $row['title']; ?>
                    </h1>
                </div>
                <div class="image">
                    <img src="uploads/<?php echo $row['image']; ?>" alt="">
                </div>
                <div class="post-content">
                    <div class="post-content-text">
                        <p>
                            <?php echo $row['description']; ?>
                        </p>
                    </div>
                    <div class="button">
                        <button class="btn" name=<?php echo $row['id']; ?> onclick="learnMore(this.name)">
                            More Info
                        </button>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<script>
    function learnMore(id) {
        window.location.href = "index.php?page=learnmore&id=" + id;
    }
</script>

<style>
    .btn {
        margin: 10px 0;
        max-width: 400px;
        padding: 10px;
        width: 100%;
        cursor: pointer;
        box-shadow: 5px 5px 0px 0px rgba(0, 0, 0, 0.603);
        transition: background 0.2s ease-in-out, color 0.2s ease-in-out, box-shadow 0.2s ease-out;
    }

    .btn:hover {
        box-shadow: none;
        color: white;
        background: rgba(250, 170, 22, 0.802);
    }
</style>

<?php
}
?>
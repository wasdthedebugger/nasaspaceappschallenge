<?php

if(!is_super_admin()) {
    header("Location: index.php");
}

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $path = $_POST['path'];
    $elo = $_POST['elo'];
    $role = $_POST['role'];

    // update sql

    $sql = "UPDATE users SET user_type='$role', elo='$elo' WHERE username='$username'";

    if(mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM virgin_submissions WHERE username='$username' AND path='$path'";
        if(mysqli_query($conn, $sql)) {
            success();
        } else {
            fail();
        }
    } else {
        fail();
    }
}

$sql = "SELECT * FROM virgin_submissions";

$result = mysqli_query($conn, $sql);

// show submissions in a table, a button to approve them, give the user their ELO and their user_type

?>

<div class="main">
    <div class="scroll-area">
        <table>
            <tr>
                <th>Username</th>
                <th>Submission</th>
                <th>Approve</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><a href="<?php echo "virgin_submissions/".$row['path']; ?>" target="_blank">View</a></td>
                    <td>
                        <form action="?page=superadminpanel" method="post">
                            <input type="hidden" name="username" value="<?php echo $row['username']; ?>">
                            <input type="hidden" name="path" value="<?php echo $row['path']; ?>">
                            <!-- choose betweeen superadmin contributor and collaborator -->
                            <select name="role" id="">
                                <option value="superadmin">Super Admin</option>
                                <option value="contributor">Contributor</option>
                                <option value="collaborator">Collaborator</option>
                            </select>
                            <input type="number" name="elo" id="">
                            <input type="submit" name="submit" value="Approve">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

</div>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 15px;
        text-align: left;
    }

    table tr:nth-child(even) {
        background-color: #eee;
    }

    table tr:nth-child(odd) {
        background-color: #fff;
    }

    table th {
        background-color: var(--primary-color);
        color: white;
    }

    .scroll-area {
        overflow-y: scroll;
        height: 500px;
    }

    .main {
        width: 100%;
        height: 100%;
    }

    .main .scroll-area {
        width: 100%;
        height: 100%;
    }

    .main .scroll-area table {
        width: 100%;
    }

    .main .scroll-area table tr td {
        width: 33%;
    }
</style>
<?php

function is_logged_in()
{
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}

function is_super_admin()
{
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'super_admin') {
        return true;
    } else {
        return false;
    }
}

function is_collaborator()
{

    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'super_admin') {
        return true;
    }

    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'collaborator') {
        return true;
    } else {
        return false;
    }
}

function is_collaborant()
{
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'super_admin') {
        return true;
    }

    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'collaborant') {
        return true;
    } else {
        return false;
    }
}

function fail()
{
    echo "<div class='alert alert-danger'>Error</div>";
    exit();
}

function success()
{
    echo "<div class='alert alert-success'>Success</div>";
}

function is_virgin()
{
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'virgin') {
        return true;
    } else {
        return false;
    }
}

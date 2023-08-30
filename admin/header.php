<?php

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}

?> 

<div class="admin-section-header">
    <div style="background-color: lightblue; color:#262626;" class="admin-logo">
        <div style="margin-left:25px; font-size: 20px">
        CinemaSpot
        </div>
    </div>
    <div class="admin-login-info" style="background-color: #262626;">
        <div style="padding: 0 20px;">
            <h2><a style=" color:lightblue;" href="#">Admin Panel</a></h2>
        </div>
        <form method='post' action="">
            <input type="submit" value="Logout" class="btn btn-outline-warning" name="but_logout">
        </form>
        <img class="admin-user-avatar" src="../img/avatar.png" alt="">
    </div>
</div>
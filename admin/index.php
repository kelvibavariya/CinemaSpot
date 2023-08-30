<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinemaSpot</title>
    <style>
        /* Container */
        .container {
            width: 40%;
            margin: 10% auto;   
        }

        /* Login */
        #div_login {
            border: 1px solid white;
            border-radius: 5px;
            background: white;
            width: 500px;
            height: 350px;
            box-shadow: 0px 2px 2px 0px lightblue;
            margin: 0 auto;
        }

        #div_login h1 {
            margin-top: 0px;
            font-weight: normal;
            padding-top: 20px;
            /* background-color: ; */
            color: darkblue ;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
            border-radius: 5px;
            text-align: center;
        }

        #div_login div {
            clear: both;
            margin-top: 10px;
            padding: 5px;
        }

        #div_login .textbox {
            width: 85%;
            margin-left: 20px;
            padding: 7px;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }

        #div_login input[type=submit] {
            padding: 7px;
            width: 100px;
            border-radius: 5px;
            /* background-color: lightblue; */
            border: 2px solid darkblue;
            color: darkblue;
            margin-left: 195px;
            font-family:Verdana, Geneva, Tahoma, sans-serif;
        }

        body{
		width: 100%;
	    height: calc(100%);
	    background-image: url("image.jpg");
	    }
    </style>
</head>

<body>
    <div class="container">
        <form method="post" action="">
            <div id="div_login">
                <h1>Login</h1>
                <hr>
                <br>
                <div>
                    <input type="text" class="textbox" id="txt_uname" name="txt_uname" placeholder="Username" />
                </div>
                <div>
                    <input type="password" class="textbox" id="txt_uname" name="txt_pwd" placeholder="Password" />
                </div><br>
                <div>
                    <input type="submit" value="Submit" name="but_submit" id="but_submit" />
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<?php
include "config.php";

if (isset($_POST['but_submit'])) {

    $uname = mysqli_real_escape_string($con, $_POST['txt_uname']);
    $password = mysqli_real_escape_string($con, $_POST['txt_pwd']);

    if ($uname != "" && $password != "") {

        $sql_query = "select count(*) as cntUser from users where username='" . $uname . "' and password='" . $password . "'";
        $result = mysqli_query($con, $sql_query);
        $row = mysqli_fetch_array($result);

        $count = $row['cntUser'];

        if ($count > 0) {
            $_SESSION['uname'] = $uname;
            header('Location: admin.php');
        } else {
            // alertmsg("Invalid username and password");
            echo '<script>alert("Invalid username and password")</script>';
        }
    }
}
?>
<?php
include "config.php";

// Check user login or not
if (!isset($_SESSION['uname'])) {
    header('Location: index.php');
}

// logout
if (isset($_POST['but_logout'])) {
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/png" href="../img/logo.png">
    <link rel="stylesheet" href="../style/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<style>
    h5{
        text-align: center;
    }
    .error
    {
        color: red;
        font-size: small    ;
    }

    .tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
<body>
    <?php
    $sql = "SELECT * FROM bookingTable";
    $bookingsNo = mysqli_num_rows(mysqli_query($con, $sql));
    $messagesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM feedbackTable"));
    $moviesNo = mysqli_num_rows(mysqli_query($con, "SELECT * FROM movieTable"));
    ?>
    
    <?php include('header.php'); ?>

    <div class="admin-container">

        <?php include('sidebar.php'); ?>
        <div class="admin-section admin-section2" style="background: lightblue">
            <div class="admin-section-column">

                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Movies</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>
                    <div class="booking-form-container" style="background: lightblue;">



                    <?php
                    $movieTitle=$movieGenre=$movieDuration=$movieRelDate=$movieDirector=$movieActors=$mainhall=$viphall=$privatehall="";
                    $titalerror="";
                    $actorerror=$ph=$vh=$mh=$generror=$durerror=$relerror=$direerror="";
                    $flag =0;
                    
                    if (isset($_POST['submit']))
                    {
                        if(!empty($_POST["movieTitle"]))
                            $movieTitle=$_POST["movieTitle"];
                    
                        if(!empty($_POST["movieActors"]))
                            $movieActors=$_POST["movieActors"];

                        if(!empty($_POST["movieGenre"]))
                            $movieGenre=$_POST["movieGenre"];
                        
                        if(!empty($_POST["movieDuration"]))
                            $movieDuration=$_POST["movieDuration"];
                        
                        if(!empty($_POST["movieRelDate"]))
                            $movieRelDate=$_POST["movieRelDate"];
                        
                        if(!empty($_POST["movieDirector"]))
                            $movieDirector=$_POST["movieDirector"];

                        if(!empty($_POST["mainhall"]))
                            $mainhall=$_POST["mainhall"];

                        if(!empty($_POST["viphall"]))
                            $viphall=$_POST["viphall"];
                        
                        if(!empty($_POST["privatehall"]))
                            $privatehall=$_POST["privatehall"];
                    }
                    
if(empty($_POST["movieTitle"]) || empty($_POST["movieActors"]) || empty($_POST["privatehall"]) 
|| empty($_POST["movieDirector"]) || empty($_POST["movieGenre"]) || empty($_POST["movieDuration"]) || 
   empty($_POST["movieRelDate"]) || empty($_POST["viphall"]) || empty($_POST["movieDirector"]) || empty($_POST["mainhall"]) )
                    $flag=1;
else
$flag=0;
                    
                    if ($_SERVER["REQUEST_METHOD"] == "POST") 
                    {
                        if(empty($_POST["movieTitle"]))
                            $titalerror="*Required title";
                        
                        if(empty($_POST["movieActors"]))
                            $actorerror="*Required actors"; 
                        
                        if(empty($_POST["movieDirector"]))
                            $direerror="*Required director";
                        
                        if(empty($_POST["movieGenre"]))
                            $generror="*Required genre";
                        
                        if(empty($_POST["movieDuration"]))
                            $durerror="*Required duration";
 
                        if(empty($_POST["movieRelDate"]))
                            $relerror="*Required relesr date";
                            
                        if(empty($_POST["viphall"]))
                            $vh="*Required price";
                        
                        if(empty($_POST["privatehall"]))
                            $ph="*Required price";
                        
                        if(empty($_POST["mainhall"]))
                            $mh="*Required price";
                    }
                    ?>
                    <form enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                    <label style="color: red; font-size: small ;">All fields are required</label>
                    
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["movieTitle"])) echo $titalerror;} 
                        else  echo "Title";?>" type="text" name="movieTitle" value="<?php echo $movieTitle?>">
                        
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["movieGenre"])) echo $generror;} 
                        else  echo "Genre";?>"  type="text" name="movieGenre"  value="<?php echo $movieGenre?>">
                    
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["movieDuration"])) echo $durerror;} 
                        else  echo "Duration";?>" type="number" name="movieDuration"  value="<?php echo $movieDuration?>">
                    
                    <!-- <div class="tabcontent">l</div> -->
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["movieRslDate"])) echo $relerror;} 
                        else  echo "Release Date"?>" type="date" name="movieRelDate"  value="<?php echo $movieRelDate?>">
                        
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["movieDirector"])) echo $direerror;} 
                        else  echo "Director"?>" type="text" name="movieDirector"  value="<?php echo $movieDirector?>">
                        
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["movieActors"])) echo $actorerror;} 
                        else  echo "Actors"?>" type="text" name="movieActors" value="<?php echo $movieActors?>">
                        

                  
                        <label>Price</label>
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["mainhall"])) echo $mh;} 
                        else  echo "Main Hall"?>" type="text" name="mainhall"  value="<?php echo $mainhall?>"><br />
                        
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["viphall"])) echo $vh;} 
                        else  echo "Vip-Hall"?>" type="text" name="viphall"  value="<?php echo $viphall?>"><br />
                        
                        <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["privatehall"])) echo $ph;} 
                        else  echo "Private Hall"?>" type="text" name="privatehall"  value="<?php echo $privatehall?>"><br />

                 

                        <br>
                        <label>Add Poster</label>
                        <input type="file" name="userfile" id="movieImg">
                        <button type="submit" value="submit" name="submit" class="form-btn">Add Movie</button>
                    </form>
                    <?php 
                    // echo $flag;
 if (isset($_POST['submit']) && $flag!=1) {
    $uploaddir = '../img/';
    $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);
    move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile);
    $insert_query = "INSERT INTO 
    movieTable (  movieImg,
                    movieTitle,
                    movieGenre,
                    movieDuration,
                    movieRelDate,
                    movieDirector,
                    movieActors,
                    mainhall,
                    viphall,
                    privatehall)
    VALUES (       '". basename($_FILES['userfile']['name']) . "',
                    '" . $_POST["movieTitle"] . "',
                    '" . $_POST["movieGenre"] . "',
                    '" . $_POST["movieDuration"] . "',
                    '" . $_POST["movieRelDate"] . "',
                    '" . $_POST["movieDirector"] . "',
                    '" . $_POST["movieActors"] . "',
                    '" . $_POST["mainhall"] . "',
                    '" . $_POST["viphall"] . "',
                    '" . $_POST["privatehall"] . "')";
   $rs= mysqli_query($con, $insert_query);
   if ($rs) {
    echo "<script>alert('Sussessfully Submitted');
          window.location.href='addmovie.php';</script>";
}
}
?>



                    </div>
                </div>
                <div class="admin-section-panel admin-section-panel2">
                    <div class="admin-panel-section-header">
                        <h2>Recent Movies</h2>
                        <i class="fas fa-film" style="background-color: #4547cf"></i>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <th>MovieID</th>
                            <th>MovieTitle</th>
                            <th>Movie_Genre</th>
                            <th>Release_date</th>
                            <th>Director</th>
                            <th>More</th>
                            
                        </tr>
                        <tbody>
                            <?php
                            $host = "localhost"; /* Host name */
                            $user = "root"; /* User */
                            $password = ""; /* Password */
                            $dbname = "cinema_db"; /* Database name */

                            $con = mysqli_connect($host, $user, $password, $dbname);
                            $select = "SELECT * FROM `movietable`";
                            $run = mysqli_query($con, $select);
                            while ($row = mysqli_fetch_array($run)) {
                                $ID = $row['movieID'];
                                $title = $row['movieTitle'];
                                $genere = $row['movieGenre'];
                                $releasedate = $row['movieRelDate'];
                                $movieactor = $row['movieDirector'];
                            ?>
                                <tr align="center">
                                    <td><?php echo $ID; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $genere; ?></td>
                                    <td><?php echo $releasedate; ?></td>
                                    <td><?php echo $movieactor; ?></td>
                                    <!--<td><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></td>-->
                                    <td><button value="Book Now!" type="submit" onclick="" type="button" class="btn btn-danger"><?php echo  "<a href='deletemovie.php?id=" . $row['movieID'] . "'>delete</a>"; ?></button></td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="../scripts/jquery-3.3.1.min.js "></script>
    <script src="../scripts/owl.carousel.min.js "></script>
    <script src="../scripts/script.js "></script>
</body>

</html>
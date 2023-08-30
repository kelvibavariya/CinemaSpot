<!DOCTYPE html>
<html lang="en">
<?php
$id = $_GET['id'];
//conditions
if ((!$_GET['id'])) {
    echo "<script>alert('You are Not Suppose to come Here Directly');window.location.href='index.php';</script>";
}
include "connection.php";
$movieQuery = "SELECT * FROM movieTable WHERE movieID = $id";
$movieImageById = mysqli_query($con, $movieQuery);
$row = mysqli_fetch_array($movieImageById);
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles_2.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Book <?php echo $row['movieTitle']; ?> Now</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <script src="_.js "></script>
</head>

<body >
<!-- style="background-color:#8cccf9;" -->

    <div class="booking-panel">
        <div class="booking-panel-section booking-panel-section1">
            <h1 style="color:grey;">RESERVE YOUR TICKET</h1>
        </div>
        <div class="booking-panel-section booking-panel-section2" onclick="window.history.go(-1); return false;">
            <i class="fas fa-2x fa-times"></i>
        </div>
        <!-- <div class="booking-panel-section booking-panel-section3">
            <div class="movie-box">
                <?php
                //echo '<img src="' . $row['movieImg'] . '" alt="">';
                ?>
            </div>
        </div> -->
        <div class="booking-panel-section booking-panel-section4">
        
            <div class="title"><?php echo $row['movieTitle']; ?></div>
            <div class="movie-information">
                <table>
                    
                    <tr>
                    <td>
                        <div class="booking-panel-section booking-panel-section3">
                        <div class="movie-box">
                                <?php
                                $loc="img/".$row['movieImg'];
                                echo '<img src="' . $loc . '" alt="">';
                                ?>
                            </div>
                        </div>

                    </td>

                    <td>
                    <table>
                    <tr>
                        <td>GENGRE</td>
                        <td><?php echo $row['movieGenre']; ?></td>
                    </tr>
                    <tr>
                        <td>DURATION</td>
                        <td><?php echo $row['movieDuration']; ?></td>
                    </tr>
                    <tr>
                        <td>RELEASE DATE</td>
                        <td><?php echo $row['movieRelDate']; ?></td>
                    </tr>
                    <tr>
                        <td>DIRECTOR</td>
                        <td><?php echo $row['movieDirector']; ?></td>
                    </tr>
                    <tr>
                        <td>ACTORS</td>
                        <td><?php echo $row['movieActors']; ?></td>
                    </tr>

                    <tr>
                        <td>SEAT AVAILABLE FOR MAIN HALL</td>
                        <td><?php echo $row['Mainhall_seat']; ?></td>
                    </tr>

                    <tr>
                        <td>SEAT AVAILABLE FOR VIP HALL</td>
                        <td><?php echo $row['viphall_seat']; ?></td>
                    </tr>
                    <tr>
                        <td>SEAT AVAILABLE FOR PRIVATE HALL</td>
                        <td><?php echo $row['privatehall_seat']; ?></td>
                    </tr>
</table>
</td>
</tr>
                </table>
            </div>
            <div class="booking-form-container">

<?php
$theatre=$date=$hour=$email=$seat=$pNumber=$fName=$lName="";
$te=$de=$he=$ee=$se=$pne=$fne=$lne="";
$flag=0;

if (isset($_POST['submit']))
{
    if(!empty($_POST["seat"]))
    $seat=$_POST["seat"];

    if(!empty($_POST["pNumber"]))
    $pNumber=$_POST["pNumber"];

    if(!empty($_POST["fName"]))
    $fName=$_POST["fName"];

    if(!empty($_POST["lNmae"]))
    $lName=$_POST["lName"];

    if(!empty($_POST["email"]))
    $email=$_POST["email"];

    if(!empty($_POST["theatre"]))
	$theatre=$_POST["theatre"];
}


if(empty($_POST["seat"]) || empty($_POST["pNumber"]) || empty($_POST["fName"]) || empty($_POST["lName"])
|| empty($_POST["email"]) || $theatre=="Select One")
    $flag=1;
else
$flag=0;


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_POST["theatre"]=="Select One" || empty($_POST["theatre"]))
    $te="*Required theater type";
    else
    $theatre=$_POST["theatre"];

    if(empty($_POST["seat"]))
    $se="*Required number of seat";
    else
    {
    $seat=$_POST["seat"]; 
    if ($theatre == "main-hall") {
        $sql="SELECT mainhall,movieID,mainhall_seat FROM movietable WHERE movieID=$id";
        
        if($res=mysqli_query($con, $sql)){
            $price = mysqli_fetch_array($res);
            if($price['mainhall_seat'] - $seat>=0){
                $ta = $price['mainhall']*$seat;
                $val=$price['mainhall_seat']-$seat;
                $update = "UPDATE movietable SET mainhall_seat=$val WHERE movieID=$id";
                mysqli_query($con,$update);
            }
            else{   
              echo "<script>alert('main hall seat are not available')</script>";
              $flag=1;
            }
            }
        }
        // mysqli_free_result($res);


        if ($theatre == "vip-hall") {
            $sql="SELECT viphall,movieID,viphall_seat FROM movietable WHERE movieID=$id";
            if($res=mysqli_query($con, $sql)){
                $price = mysqli_fetch_array($res);
                if($price['viphall_seat']-$seat>=0){
                    $ta = $price['viphall']*$seat;
                    $val=$price['viphall_seat']-$seat;
                    $update = "UPDATE movietable SET viphall_seat=$val WHERE movieID=$id";
                    mysqli_query($con,$update);
                }
                else{
                    echo "<script>alert('vip hall seat are not available')</script>";
                    $flag=1;
                }
            }
            // mysqli_free_result($res);
        }

        if ($theatre == "private-hall") {
            $sql="SELECT privatehall,movieID,privatehall_seat FROM movietable WHERE movieID=$id";
            if($res=mysqli_query($con, $sql)){
                $price = mysqli_fetch_array($res);
                if($price['privatehall_seat']-$seat>=0){
                    $ta = $price['privatehall']*$seat;
                    $val=$price['privatehall_seat']-$seat;
                    $update = "UPDATE movietable SET privatehall_seat=$val WHERE movieID=$id";
                    mysqli_query($con,$update);
                }
                else{
                    echo "<script>alert('private hall seat are not available')</script>";
                    $flag=1;    
                }
            }
            // mysqli_free_result($res);    
        }

    

}

    if(empty($_POST["pNumber"]))
    $pe="*Required phone number";
    else
    $pNumber=$_POST["pNumber"];

    if(empty($_POST["fName"]))
    $fe="*Required first name";
    else
    $fName=$_POST["fName"];

    if(empty($_POST["lName"]))
    $le="*Required last name";
    else
    $lName=$_POST["lName"];

    if(empty($_POST["email"]))
    $ee="*Required email";
    else
    $email=$_POST["email"];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    $ee="*email invaid";

}
?>

                <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id=".$id;?> method="POST">
                    <select name="theatre">
                        <option value="Selact One" <?= $theatre == "Select One"? "selected":"";?>> THEATRE</option>
                        <option value="main-hall" <?= $theatre == "main-hall"? "selected":"";?> > Main Hall</option>
                        <option value="vip-hall" <?= $theatre == "vip-hall"? "selected":"";?>> VIP Hall</option>
                        <option value="private-hall" <?= $theatre == "private-hall"? "selected":"";?>> Private Hall</option>
                    </select>

                    <?php
                    $date=$row['movieRelDate'].'00:00:00';
                    $stop_date = new DateTime($date);
                    //echo 'date before day adding: ' . $stop_date->format('Y-m-d H:i:s'); 
                    $stop_date->modify('+1 day');
                    $day=$stop_date->format('Y-m-d');
                    echo '<select name="date">
                    <option value="" disabled selected>DATE</option>
                    <option value='.$day.'>'.$day.'</option>';
                     
                    $stop_date->modify('+1 day');$day=$stop_date->format('Y-m-d');
                    echo '<option value='.$day.'>'.$day.'</option>';
                    //<option value="13-3">.'$day'.</option>
                    $stop_date->modify('+1 day');$day=$stop_date->format('Y-m-d');
                    echo '<option value='.$day.'>'.$day.'</option>';
                    //<option value="14-3">March 14,2019</option>
                    $stop_date->modify('+1 day');$day=$stop_date->format('Y-m-d');
                    echo '<option value='.$day.'>'.$day.'</option>';
                    //<option value="15-3">March 15,2019</option>
                    $stop_date->modify('+1 day');$day=$stop_date->format('Y-m-d');
                    echo '<option value='.$day.'>'.$day.'</option></select>';
                    //<option value="16-3">March 16,2019</option>
                //</select>'
                    ?>
                    

                    <select name="hour">
                        <option value="" disabled selected>TIME</option>
                        <option value="09-00">09:00 AM</option>
                        <option value="12-00">12:00 AM</option>
                        <option value="15-00">03:00 PM</option>
                        <option value="18-00">06:00 PM</option>
                        <option value="21-00">09:00 PM</option>
                        <option value="24-00">12:00 PM</option>
                    </select>

                    <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["seat"])) echo $se;} 
                        else  echo 'Number of seats';?>" type="number" name="seat" value="<?php echo $seat?>">

                    <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["pNumber"])) echo $pe;} 
                        else  echo 'Phone Number';?>" type="text" name="pNumber" value="<?php echo $pNumber?>">

                    <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["fName"])) echo $fe;} 
                        else  echo 'First Name';?>" type="text" name="fName" value="<?php echo $fName?>">

                    <input placeholder="<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["lName"])) echo $le;} 
                        else  echo 'Last Name';?>" type="text" name="lName" value="<?php echo $lName?>"> 

                    
                    <input placeholder=<?php if(isset($_POST['submit'])) 
                        {if(empty($_POST["email"])) echo $ee;} 
                        else  echo 'E-mail';?> type="email" name="email" value="<?php echo $email?>">
                    <input type="hidden" name="movie_id" value="<?php echo $id; ?>">



                    <button type="submit" value="submit" name="submit" class="form-btn">Book a seat</button>

                </form>
<?php
// ob_start();  $flag!=1
if (isset($_POST['submit']) && $flag!=1) 
{
    $qry = "INSERT INTO bookingtable(`movieID`, `bookingTheatre`, `seat`, `bookingDate`, `bookingFName`, `bookingLName`, `bookingPNumber`, `bookingEmail`,`amount`, `ORDERID`)VALUES 
    ('$id','$theatre','$seat','$date','$fName','$lName','$pNumber','$email','$ta','cash')";
    $result = mysqli_query($con, $qry);
    echo "<script>alert('Your form is submited succesfully');window.location.href='verify.php?pnum=".$pNumber."';</script>";
    ob_end_flush();       
}


?>
            </div>
        </div>
    </div>
    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>

</body>

</html>
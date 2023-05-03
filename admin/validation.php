<html lang="en">

<head>
</head>

<body>


<?php
$movieTital=$movieGenre=$movieDuration=$movieRelDate=$movieDirector=$movieActor=$mainhall=$viphal=$privatehall="";
$titalerror="";
$actorerror="";
$flag =0;

if (isset($_POST['submit']))
{
    if(!empty($_POST["movieTital"]))
        $movieTital=$_POST["movieTital"];

    if(!empty($_POST["movieActor"]))
        $movieActors=$_POST["movieActor"];
}

if(empty($_POST["movieTital"]) || empty($_POST["movieActor"]))
$flag=1;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(empty($_POST["movieTital"]))
        $titalerror="movie tital is required";
    
    if(empty($_POST["movieActor"]))
        $actorerror="movie actor is required"; 
}
                        


?>



<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                        <input placeholder="Title" type="text" name="movieTital" value="<?php echo $movieTital;?>">
                        <span class="error"><?php echo $titalerror;?></span>
                        <input placeholder="Genre" type="text" name="movieGenre" >
                        <input placeholder="Duration" type="number" name="movieDuration" >
                        <input placeholder="Release Date" type="date" name="movieRelDate" >
                        <input placeholder="Director" type="text" name="movieDirector" >
                        <input placeholder="Actors" type="text" name="movieActor" value="<?php echo $movieActor;?>">
                        <span class="error"><?php echo $actorerror;?></span>
                        <label>Price</label>
                        <input placeholder="Main Hall" type="text" name="mainhall" ><br />
                        <input placeholder="Vip-Hall" type="text" name="viphall"><br />
                        <input placeholder="Private Hall" type="text" name="privatehall" ><br />
                        <br>
                        <label>Add Poster</label>
                        <input type="file" name="movieImg" accept="image/*">
                        <input type="submit" value="submit" name="submit">
</form>
                    <?php 
 if (isset($_POST['submit']) && $flag!=1) {
    $insert_query = "INSERT INTO 
    movieTable (  movieImg,
                    movieTital,
                    movieGenre,
                    movieDuration,
                    movieRelDate,
                    movieDirector,
                    movieActors,
                    mainhall,
                    viphall,
                    privatehall)
    VALUES (        'img/" . $_POST['movieImg'] . "',
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

</body>



<span class="error"><?php echo $titalerror;?></span>
                        <span class="error"><?php echo $generror;?></span>
                    <span class="error"><?php echo $durerror;?></span>
                        
                    <span class="error"><?php echo $mh;?></span>
                    <span class="error"><?php echo $vh;?></span>
                    <span class="error"><?php echo $ph;?></span>

                    <span class="error"><?php echo $relerror;?></span>
                    <span class="error"><?php echo $direerror;?></span>
                    <span class="error"><?php echo $actorerror;?></span>
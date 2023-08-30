<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/styles_2.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <title>Cinema Spot</title>
    <!-- <link rel="icon" type="image/png" href="img/logo.png"> -->
    <script src="_.js "></script>
</head>

<body>
<?php
    include "connection.php";
    $sql = "SELECT * FROM movieTable";
    ?>
    <?php include "welcome.php";?>
    <div id="home-section-1" class="movie-show-container">
        <h1>Currently Showing</h1>
        <h3>Cinema Spot</h3>
    <!-- <header></header> -->
        <div class="movies-container">

            <?php
            if ($result = mysqli_query($con, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    //$row = mysqli_fetch_array($result);
                    for ($i = 0; $i <= 5; $i++) {
                    while ($row=mysqli_fetch_array($result)) {
                                echo '<div class="movie-box">';
                                $loc="img/".$row['movieImg'];
                                echo '<img src="' . $loc . '" alt=" ">';
                                echo '<div class="movie-info ">';
                                // echo '<h3>' . $row['movieTitle'] . '</h3>';
                                echo '<a href="booking.php?id=' . $row['movieID'] . '"><i class="fas fa-ticket-alt"></i> '. $row['movieTitle'].'</a>';
                                echo '</div>';
                                echo '</div>';
                        }
                    }
                    mysqli_free_result($result);
                } else {
                    echo '<h4 class="no-annot">No Booking to our movies right now</h4>';
                }
            } else {
                echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
            }

            // Close connection
            mysqli_close($con);
            ?>
        </div>
    </div>


    <!-- <footer></footer> -->

    <script src="scripts/jquery-3.3.1.min.js "></script>
    <script src="scripts/script.js "></script>
</body>

</html>
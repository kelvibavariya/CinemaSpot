
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Book</title>
    <script src="_.js "></script>
</head>
<?php 
include "connection.php";
$movieQuery = "SELECT * FROM bookingtable WHERE bookingPNumber= ".$_GET['pnum'];
$movieImageById = mysqli_query($con, $movieQuery);
$row = mysqli_fetch_array($movieImageById);
$fName=$row['bookingFName'];
$lName=$row['bookingLName'];
$theatre=$row['bookingTheatre'];
$seat=$row['seat'];
$date=$row['DATE-TIME'];
$ta=$row['amount'];

?>
<body>
    <center>
        <br><br>
        <h1>Proceed for Booking </h1>
        <br><br>

        <form method="post" action="done.html">
            <table border="1" style="text-align: center;">
                <tbody>
                    <tr>
                        <th>S.No</th>
                        <th>Label</th>
                        <th>Value</th>
                    </tr>
                    

                    <tr>
                        <td>1</td>
                        <td><label>Name</label></td>
                        <td><?php echo $fName . " " . $lName; ?></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td><label>Theatre</label></td>
                        <td>
                            <?php echo $theatre; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td><label>No of seats</label></td>
                        <td>
                            <?php echo $seat; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td><label>Date-Time</label></td>
                        <td><?php echo $date; ?>
                            <!-- <input type="hidden" name="ORDER_ID" value="<?php echo $order; ?>"> -->
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td><label>Total Amount</label></td>
                        <td>
                            
                            
                            <input type="text" name="TXN_AMOUNT" value="<?php echo $ta ?>" readonly>
                            <!-- <input type="hidden" name="CUST_ID" value="<?php //echo $cust; ?>">
                            <input type="hidden" name="INDUSTRY_TYPE_ID" value="retail">
                            <input type="hidden" name="CHANNEL_ID" value="WEB"> -->

                        </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td></td>
                        <td>
                            <button value="Book Now!" type="submit" onclick="" type="button" class="btn btn-primary">Book</button>
                            <!-- <input value="CheckOut" type="submit"	onclick=""></td> -->
                    </tr>
                </tbody>
            </table>
            
        </form>
    </center>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>

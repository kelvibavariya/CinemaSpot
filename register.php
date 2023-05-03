<?php
require_once "connection.php";
$name = $lname = $username = $password = $confirm_password = $gender = $add = $pno = $email = "";
$name_err = $username_err = $password_err  = $pno_err = $email_err = $con_password_err = "";
if ( isset ( $_POST['submit'] ) ){
    if(!empty($name)){
      $name=test_input($name);
    }
    if(!empty($lname)){
      $lname=test_input($lname);
    }
    if(!empty($username)){
      $username=test_input($username);
    }
    // if(!empty($password)){
    //   $password=test_input($password);
    // }
    // if(!empty($confirm_password)){
    //   $confirm_password=test_input($confirm_password);
    // }
    if(!empty($gender)){
      $gender=test_input($gender);
    }
    if(!empty($add)){
      $add=test_input($add);
    }
    if(!empty($pno)){
      $pno=test_input($pno);
    }
    if(!empty($email)){
      $email=test_input($email);
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST"){

  if(!empty($gender)){
    $gender=test_input($_POST["gender"]);
  }

  if(empty(test_input($_POST["name"]))){
    $name_err = "Name cannot be blank";
  }
  else{
    $name=test_input($_POST["name"]);
  }
  if(empty($lname)){
    $lname=test_input($_POST["lname"]);
  }
  if(empty($add)){
    $add=test_input($_POST["add"]);
  }
  
    // Check if username is empty
  if(empty(test_input($_POST["username"]))){
      $username_err = "Username cannot be blank";
  }
  else{
    $sql = "SELECT id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($con, $sql);
    if($stmt)
    {
     
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Set the value of param username
      $param_username = trim($_POST['username']);

      // Try to execute this statement
      if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt) == 1)
        {
          $username_err = "This username is already taken"; 
        }
                // else if($param_username=="admin"){
                //     $username_err = "This username is reserved";
                // }
        else{
          $username = test_input($_POST['username']);
        }
      }
      else{
        echo "Something went wrong";
      }
    }
    mysqli_stmt_close($stmt);
  }


//check for phone number
if(!empty(test_input($_POST['pno']))){
    $pno=test_input($_POST['pno']);
    if(strlen($pno)!=10){
        $pno_err="Phone number must be of size 10";
    }
    if(!preg_match("/^[0-9 ]*$/",$pno)){
      $pno_err="Phone Number contains digits only";
    }
}
//check for email
if (!empty($_POST["email"])) {
  $email = test_input($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $email_err="Invalid email";
    $flag=0;
  }
} 
// Check for password
if(empty(test_input($_POST['password']))){
    $password_err = "Password cannot be blank";
}
elseif(strlen(test_input($_POST['password'])) < 5){
    $password_err = "Password cannot be less than 5 characters";
}
else{
    $password = test_input($_POST['password']);
}

// Check for confirm password field
if(test_input($_POST['password']) !=  test_input($_POST['confirm_password'])){
    $con_password_err = "Passwords should match";
}


// If there were no errors, go ahead and insert into the database
if(empty($username_err) && empty($name_err) && empty($password_err) && empty($con_password_err) && empty($pno_err) && empty($email_err))
{
    $sql = "INSERT INTO users (username, password, name) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt)
    {
        mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_name);

        // Set these parameters
        $param_username = $username;
        $param_password = $password;
        $param_name = $name;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
            header("location: login.php");
        }
        else{
            echo "Something went wrong... cannot redirect!";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($con);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>CinemaSpot</title>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">CinemaSpot</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
  <ul class="navbar-nav">
      <!-- <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="login.php">Login</a>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li> -->

      
     
    </ul>
  </div>
</nav>

<div class="container mt-4">
<h3>Please Register Here:</h3>
<hr>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">First Name</label>
      <input type="text" class="form-control" name="name" id="inputEmail4" placeholder="First Name" value="<?php echo $name?>">
      <span style="color:red;"><?php echo $name_err;?></span>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Last Name</label>
      <input type="text" class="form-control" name="lname" id="inputEmail4" placeholder="Last Name" value="<?php echo $lname?>">
    </div>
  </div>
  <div class="form-row">
    <label for="inputEmail4">Username</label>
    <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="username" value="<?php echo $username?>">
    <span style="color:red;"><?php echo $username_err;?></span>
  </div>
  <br>
  <label for="inputEmail4">Gender</label>
  <div class="form-row">  
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="gender" value="male" id="flexRadioDefault2" <?php if (isset($gender) && $gender == "male") echo "checked=\"checked\""; ?>>
      <label class="form-check-label" for="flexRadioDefault2">
        Male
      </label>
    </div>
    
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="female" id="flexRadioDefault1" <?php if (isset($gender) && $gender == "female") echo "checked=\"checked\""; ?>>
        <label class="form-check-label" for="flexRadioDefault1">
          Female
        </label>
      </div>
  </div>

<div class="form-row">
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea class="form-control" name="add" id="exampleFormControlTextarea1" rows="3" cols="40"><?php echo $add;?></textarea>
  </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Phone number</label>
      <input type="text" class="form-control" name="pno" id="inputEmail4" placeholder="Phone number" value="<?php echo $pno?>">
      <span style="color:red;"><?php echo $pno_err;?></span>
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">E-mail</label>
      <input type="text" class="form-control" name="email" id="inputEmail4" placeholder="abc@gmail.com" value="<?php echo $email;?>">
      <span style="color:red;"><?php echo $email_err;?></span>
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name ="password" id="inputPassword4" placeholder="Password">
      <span style="color:red;"><?php echo $password_err;?></span>
    </div>
  <div class="form-group col-md-6">
      <label for="inputPassword4">Confirm Password</label>
      <input type="password" class="form-control" name ="confirm_password" id="inputPassword" placeholder="Confirm Password" >
      <span style="color:red;"><?php echo $con_password_err;?></span>
    </div>
</div>

  <!-- <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div> -->
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
</div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>

<!DOCTYPE HTML>  
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Validation Form</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>  

<?php

// define variables and set to empty values
$nameErr = $emailErr = $expertiseErr = $websiteErr = "";
$name = $email = $expertise = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // check if URL address syntax is valid
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "Invalid URL";
    }    
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["expertise"])) {
    $expertiseErr = "Expertise is required";
  } else {
    $expertise = test_input($_POST["expertise"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<div class="container">

  <h2 class="title-form">PHP Form Validation Example</h2>
  <p><span class="error">* required field</span></p>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">


      <label for="name">Name: <span class="error">* <?php echo $nameErr;?></span>  </label> 
      <input type="text" id="name" name="name">

    <div class="divider"></div>

      <label for="email">E-mail: <span class="error">* <?php echo $emailErr;?></span></label>
      <input type="text" id="email" name="email">
      
    <div class="divider"></div>
      
      <label for="website">Website: <span class="error"><?php echo $websiteErr;?></span></label>
      <input type="text" id="website" name="website">

    <div class="divider"></div>

      <label for="comment">Comments: </label>
      <textarea id="comment" name="comment" rows="5" cols="30" placeholder="Do you have any comments?..."></textarea>

    <div class="divider"></div>

    <label for="">Expertise: <span class="error">* <?php echo $expertiseErr;?></span></label>
    <div class="radio-group">
      <label >
        <input type="radio" name="expertise" value="Front End">
        Front End
      </label>
      <label>
        <input type="radio" name="expertise" value="Back End">
        Back End
      </label>
      <label>
        <input type="radio" name="expertise" value="Full Stack">
        Full Stack
      </label>
    </div>
    
    <input type="submit" name="submit" value="Submit"> 

    <div class="divider"></div>
    
    <?php 
      echo "<h2 class='title-input'>Your Answers:</h2>";
      echo "<p class='texto'>$name</p>";
      echo "<p class='texto'>$email</p>";
      echo "<p class='texto'>$website</p>";
      echo "<p class='texto'>$comment</p>";
      echo "<p class='texto'>$expertise</p>"; 
    ?>

  </form>

</div>

</body>
</html>
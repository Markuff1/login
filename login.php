<?php
session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD'] == "POST")
{
	//something was posted
	$user_name = $_POST['user_name'];
	$password = $_POST['password'];

	if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
	{

		//read from database
		$query = "select * from users where user_name = '$user_name' limit 1";

		$result = mysqli_query($con, $query);

		if($result)
		{
			if ($result && mysqli_num_rows($result) > 0)
			{
	
				$user_data = mysqli_fetch_assoc($result);
				
				if($user_data['password'] === $password)
				{
					$_SESSION['user_id'] = $user_data['user_id']; 
					header("Location: index.php");
					die;	
				}
			}
		}
		echo "wrong username or password";
	}else
	{
		echo "Please enter some valid information!";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	<link rel="stylesheet" href="Login.css">
</head>
<body class="background">
    <div id="box">

    <form method = "post">
        <div class="LoginTitle">Login</div>

        <input class = "inputbox" id="text" type="text" name="user_name" placeholder="Username"><br><br>
        <input class = "inputbox" id="text" type="password" name="password" placeholder="Password"><br><br>

        <input class="loginButton" id="button" type="submit" value="Login">

        <a href="signup.php" class = "SignUpButton">Click to Signup</a>
    </form>


    </div>
</body>
</html>
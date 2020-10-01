<?php
    require __DIR__ . '/vendor/autoload.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Chat</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </head>
 <body>
<?php 
			if(isset($_POST['join'])) {
				session_start();
				require("db/users.php");
				$objUser = new users;
				$objUser->setEmail($_POST['email']);
				$objUser->setName($_POST['name']);
				$objUser->setLoginStatus(1);
			 	$objUser->setLastLogin(date('Y-m-d h:i:s'));
			 	$userData = $objUser->getUserByEmail();
			 	if(is_array($userData) && count($userData)>0) {
			 		$objUser->setId($userData['id']);
			 		if($objUser->updateLoginStatus()) {
			 			echo "User login..";
			 			$_SESSION['user'][$userData['id']] = $userData;
			 			header("location: chatroom.php");
			 		} else {
			 			echo "Failed to login.";
			 		}
			 	} else {
				 	if($objUser->save()) {
				 		$lastId = $objUser->dbConn->lastInsertId();
				 		$objUser->setId($lastId);
						$_SESSION['user'][$lastId] = [ 
							'id' => $objUser->getId(), 
							'name' => $objUser->getName(), 
							'email'=> $objUser->getEmail(), 
							'login_status'=>$objUser->getLoginStatus(), 
							'last_login'=> $objUser->getLastLogin() 
						];

				 		echo "User Registred..";
				 		header("location: chatroom.php");
				 	} else {
				 		echo "Failed..";
				 	}
				 }
			}
		 ?>


<div class="form-control">
	 <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Enter User Name</label>
    <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
    <small id="emailHelp" class="form-text text-muted">We'll never share your Name with anyone else.</small>
  </div>

   <div class="form-group">
    <label for="exampleInputEmail1">Enter Email</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  
  
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary" id="join" name="join">Join Room</button>
</form>
</div>


 </body>
 </html>
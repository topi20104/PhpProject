<?php
	//use PHPMailer\PHPMailer\PHPMailer;
	session_start();
	$login = false;
	if (isset($_SESSION['login']) && isset($_SESSION['username'])) {
		$login = true;
	}


	include 'db.php';

	//sign up
	if(isset($_POST['registration'])){
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		if (!$login) {
			//check if email is of email form
			if (filter_var($email, FILTER_VALIDATE_EMAIL)){
				//check if an account registered on current email exists
				$sql = $conn->query("SELECT accountid FROM accounts WHERE email = '$email';");
				if ($sql->num_rows > 0) {
					exit('emailTaken');
				} else {
					//check if username already exists
					$sql = $conn->query("SELECT accountid, password, role FROM accounts WHERE username = '$username';");
					if ($sql->num_rows > 0){
						exit('userTaken');
					} else {
						//check password length
						if (strlen($password) >= 8) {
							//$token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789-=+_.,/><()@#$!?";
							//$token = str_shuffle($token);
							//$token = substr($token, 0, 10);
							//encrypt password and store new acc in db 
							$epassword = password_hash($password, PASSWORD_BCRYPT);
							$sql = "INSERT INTO accounts (username, email, password) VALUES ('$username', '$email', '$epassword');";
							mysqli_query($conn, $sql);

							/*include_once 'PHPMailer.php';
							
							$mail = new PHPMailer();
							$mail->setFrom('no-reply@yez.com');
							$mail->addAddress($email);
							$mail->Subject = "Verify your email!";
							$mail->isHTML(true);
							$mail->Body = "
								Thank you for registering on YEZ!<br>
								Your token is: $token<br>
								If you have not registered on YEZ, please ignore this message.<br>
							";*/
							
							//if($mail->send()){
								//get the accountid, role, createdon of just created account
								$sql = $conn->query("SELECT accountid, email, role, DATE_FORMAT(createdon,'%d %M %Y') AS createdon FROM accounts ORDER BY accountid DESC LIMIT 1;");
								$accountid = $sql->fetch_assoc();
								//assign to session variables
								$_SESSION['login'] = 1;
								$_SESSION['username'] = $username;
								$_SESSION['accountid'] = $accountid['accountid'];
								$_SESSION['email'] = $accountid['email'];
								//$_SESSION['confirmed'] = $accountid['confirmed'];
								$_SESSION['role'] = $accountid['role'];
								$_SESSION['createdon'] = $accountid['createdon'];
								//$_SESSION['token'] = $accountid['token'];
								//exit('mailRegistered');
							// } else {
							// 	exit('failure');
							// }
							
							

							
							//end of script in case account created successfully
							exit('success');
						} else {
							exit('passTooShort');
						}
					}
				}
				//invalid email
			} else {
				exit('emailNotValid');
			}
		} else {
			exit('logedIn');
		}
	
	}

	//verify token
	/*if(isset($_POST['confirmmail'])){
		$email2 = $_POST['email'];
		$token1 = $_POST['token'];
		if ($email2 == $_SESSION['email'] && $token1 == $_SESSION['token']){
			$_SESSION['confirmed'] = 1;
			$sql = "UPDATE accounts SET confirmed = 1 WHERE email = '$email2';";
			mysqli_query($conn, $sql);
			exit('success');
		} else{
			exit('inputs');
		}
	}*/

	//log in
	if(isset($_POST['logging'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (!$login) {
			//check if an account registered on current email exists
			$sql = $conn->query("SELECT accountid, password, role, DATE_FORMAT(createdon,'%d %M %Y') AS createdon FROM accounts WHERE username = '$username';");
			if ($sql->num_rows > 0) {
				$result =$sql->fetch_assoc();
				$passwordcheck = $result['password'];
				//assign to session variables if logged in successfully
				if(password_verify($password, $passwordcheck)){
					$_SESSION['login'] = 1;
					$_SESSION['username'] = $username;
					$_SESSION['accountid'] = $result['accountid'];
					$_SESSION['role'] = $result['role'];
					$_SESSION['createdon'] = $result['createdon'];

					exit('success');
				} else {
					exit('invalidPass');
				}

			} else {
				exit('invalidUser');
			}
		} else {
			exit('logedIn');
		}
			
			
	}

	//delete account
	if (isset($_POST['delAcc'])){
		if ($login){
			$accountid = $_SESSION['accountid'];
			$sql = "DELETE FROM accounts WHERE accountid = $accountid";
			mysqli_query($conn, $sql);
			if ($conn->query($sql) === TRUE) {
				unset($_SESSION['login']);
				session_destroy();
			 	exit("success");
			} else {
			  exit($conn->error);
			}
		} else {
			exit('notlogged');
		}
		
		
	}

	//restore password
	if(isset($_POST['restorepass'])){
		$emailr = $_POST['email'];
		$newpass = $_POST['newpass'];
		if (!$login) {
			//check if email is of email form
			if (filter_var($emailr, FILTER_VALIDATE_EMAIL)){
				//check if account exists on this email
				$sql = $conn->query("SELECT accountid, password, role FROM accounts WHERE email = '$emailr';");
				if ($sql->num_rows > 0){
					//check password length
					if (strlen($newpass) >= 8) {
						$newepassword = password_hash($newpass, PASSWORD_BCRYPT);
						$sql = "UPDATE accounts SET password = '$newepassword' WHERE email = '$emailr';";
						mysqli_query($conn, $sql);
						exit('success');//password restored successfully

					} else {
						exit('passTooShort');//password is too short
					}
					
				} else {
					exit('noAcc'); //account doesnt exist
				}
			} else {
				exit('invalidMail');
			}
		} else {
			exit('logedIn');
		}
		
	}

	if (isset($_POST['addComment'])) {
		if($login){
			$postid = $_POST['postid'];
			$commentText = $_POST['comment'];
			$accountid = $_SESSION['accountid'];
			$sql = "INSERT INTO comments (postid, UserID, message) VALUES ('$postid', '$accountid', '$commentText');";
			mysqli_query($conn, $sql);
		} else {
			exit('notloggedin');
		}
	}

	if(isset($_POST['submitJoke'])) {
		if($login){
			$jokeTitle = $_POST['jokeTitle'];
			$jokeTopic = $_POST['jokeTopic'];
			$jokeText = $_POST['jokeText'];
			$accountID = $_SESSION['accountid'];
			$jokeText = str_replace("'", "''", $jokeText);
			$jokeTitle = str_replace("'", "''", $jokeTitle);
			$sql = "INSERT INTO posts (accountid, title, post, topic) VALUES ('$accountID', '$jokeTitle', '$jokeText', '$jokeTopic');";
			//mysqli_query($conn, $sql);
			if ($conn->query($sql) === TRUE) {
			 	exit("jokeAdded");
			} else {
			  exit($conn->error);
			}
		} else {
			exit('notloggedin');
		}
	}

	if(isset($_POST['delUrPost'])) {
		$postid = $_POST['postid'];
		$accountid = $_SESSION['accountid'];
		$sql = "DELETE FROM posts WHERE postid = '$postid' AND accountid = '$accountid';";
		if ($conn->query($sql) === TRUE) {
		 	exit("urPostDeleted");
		} else {
		  exit($conn->error);
		}
		
	}

	if(isset($_POST['delaPost'])) {
		$postid = $_POST['postid'];
		$sql = "DELETE FROM posts WHERE postid = '$postid';";
		if ($conn->query($sql) === TRUE) {
		 	exit("aPostDeleted");
		} else {
		  exit($conn->error);
		}
		
	}

	if (isset($_POST['reportposty'])) {
		if($login){
			$reason = $_POST['reason'];
			$postid = $_POST['postid'];
			$accountid = $_SESSION['accountid'];
			$sql = "INSERT INTO reports (postid, accountid, reason) VALUES ('$postid', '$accountid', '$reason');";
			if ($conn->query($sql) === TRUE) {
			 	exit("reported");
			} else {
			  exit($conn->error);
			}
		} else {
			exit('notloggedin');
		}
	}


?>
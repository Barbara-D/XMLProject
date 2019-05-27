<?php 

	function OpenUserPage ($Acc)
	{
		$fname=$Acc->FirstName;
		$lname=$Acc->LastName;
		$email=$Acc->Email;
		$password=$Acc->Password;
		$color=$Acc->Color;
		$pwstars=str_repeat('*', strlen($password));

		echo
		"
			<!DOCTYPE html>
			<html>
			<head>
				<title>$fname $lname</title>
				<link rel='icon' href='img/favicon.ico' type='image/x-icon'>
				<link rel='stylesheet' type='text/css' href='style.css'/>
				<style>
					body{background-color: $color;}
					.hcontainer {width:60%; margin: 20px auto; background-color:#17161e; padding:5px 20px 10px 20px; text-align:center; color:white;}
					.btn-3{background-color:#a6c1ee; background-image: linear-gradient(to right, #17161e 0%, #254470 51%, #17161e 100%);}
				</style>
			</head>
			<body>
				<header>
					<div class='hcontainer'>
						<h1>Welcome $fname!</h1>
						<h2>Your account information:</h2>
						<p>First name: <span class='uinfo'>$fname<span></p>
						<p>Last name: <span class='uinfo'>$lname<span></p>
						<p>Email address: <span class='uinfo'>$email<span></p>
						<p>Password: <span class='uinfo'>$pwstars<span></p>
					</div>
				</header>
				<main>
					<div class='container'>
					  <a href='index.html' class='btn btn-3'>SIGN OUT</a>
					</div>
				</main>
			</body>
			</html>
		";
	}



	$xmlFile = simplexml_load_file("accounts.xml"); 			
	$xmlLocalCopy = new SimpleXMLElement($xmlFile->asXML()); 
		
	if(isset($_POST["email"]))
	{
		$email = $_POST["email"];
		$password = $_POST["password"];
		$test=1;

		foreach ($xmlLocalCopy as $Account) 
		{ 
			$mail = $Account->Email;
			$pass = $Account->Password;
			if($email == $mail && $password == $pass)
			{
				OpenUserPage($Account);
				$test=0; 
				break;
			}
			elseif ($email==$mail) 
			{
				echo "Wrong password.<br/>";
				echo "<a href='signin.html'>Try again.</a>";
				$test=0; 
				break;
			}
		}
		if ($test)
		{
			echo "ERROR! This account does not exist.<br/>";
			echo "Return to <a href='index.html'>homepage</a>?";
		}
	}
?>

<!-- 
header('Location: index.html');
exit; -->
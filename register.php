<?php 
	$xmlFile = simplexml_load_file("accounts.xml");
	$xmlLocalCopy = new SimpleXMLElement($xmlFile->asXML());
		
	if(isset($_POST["email"]))
	{
		$test=1;
		$fname = $_POST["fname"];
		$lname= $_POST["lname"];
		$email= $_POST["email"];
		$password = $_POST["password"];
		$color= $_POST["color"];

		foreach ($xmlLocalCopy as $Account) 
		{ 
			$mail = $Account->Email;
			if($email == $mail)
			{
				echo "ERROR! Account with this email address already exists.<br/>";
				echo "<a href='signin.html'>Sign in here!</a>!";
				$test=0; 
				break;
			}
		}
		
		if ($test)
		{
			$newAccount = $xmlLocalCopy->addChild("Account");	
			$newAccount->addChild("FirstName", $fname);
			$newAccount->addChild("LastName", $lname);
			$newAccount->addChild("Email", $email);
			$newAccount->addChild("Password", $password);
			$newAccount->addChild("Color", $color);
				
			$dom = new DOMDocument('1.0');
			$dom->preserveWhiteSpace = false;
			$dom->formatOutput = true;
			$dom->loadXML($xmlLocalCopy->asXML());
			$dom->save("accounts.xml");
			
			echo "User created!<br/><a href='signin.html'>Sign in</a> with your account!";
		}
	}	
?>

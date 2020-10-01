<?php
class DbConnect{
	private $host = 'localhost';
	private $dbname='webshoket';
	private $user='root';
	private $pass='';

public function connect(){
	try{
		$conn=new PDO('mysql:host='.$this->host .';dbname='.$this->dbname,$this->user,$this->pass);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
return $conn;


	}

	catch(PDOException $e){
		echo "database error ".$e->getMessage();
	}
}


}





// $servername = "localhost";
// $username = "root";
// $password = "";

// try {
//   $conn = new PDO("mysql:host=$servername;dbname=webshoket", $username, $password);
//   // set the PDO error mode to exception
//   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//   echo "Connected successfully";
// } catch(PDOException $e) {
//   echo "Connection failed: " . $e->getMessage();
// }
?>
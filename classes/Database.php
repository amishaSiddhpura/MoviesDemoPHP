<?php 
require_once("DB_Config.php");

class Database {
	private $Connection;
	//Step1:
	private static $instance;
	//Step2:
	private function Database(){
		$this->Open_Connection();
	}
	//Step 3: Get_Instance function
	public static function Get_Instance(){
		if(!isset(self::$instance)){
			self::$instance = new Database();
		}
		return self::$instance;
	}
	public function Open_Connection(){
		global $HOST, $NAME, $USER, $PASSWORD;
		try{
			$this->Connection = new PDO("mysql:host=$HOST; dbname=$NAME", $USER, $PASSWORD);
			$this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "You are connected !";
		}catch(PDOException $e){
			echo "Connection failed : ".$e->getMessage();
		}
	}
	
	public function Close_Connection(){
		$this->Connection = NULL;
	}
	
	public function Get_Connection(){
		return $this->Connection;
	}
	public static function Execute_Query($query)
	{
		try {
			$database = new Database();
			$connection = $database->Get_Connection();
			$statement = $connection->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			// var_dump($result);
			return $result;
		} catch (PDOException $e) {
			echo " Execute_Query Query Failed " . $e->getMessage();
		}
	}

	public static function Get_Name($id)
	{
		try {
			$query = "SELECT Name FROM categories WHERE Category_ID = $id ";
			$database = new Database();
			$connection = $database->Get_Connection();
			$statement = $connection->prepare($query);
			$statement->execute();
			$result = $statement->fetch(PDO::FETCH_ASSOC);
			// var_dump($result);
			return $result['Name'];
		} catch (PDOException $e) {
			echo " getName Query Failed " . $e->getMessage();
		}
	}

	public static function Make_reservation($id)
	{
		try {
			$query = "Update movies SET Status = 'Reserved' where Movie_ID = $id ";
			$database = new Database();
			$connection = $database->Get_Connection();
			$statement = $connection->prepare($query);
			$statement->execute();
		} catch (PDOException $e) {
			echo "Query Failed " . $e->getMessage();
		}
	}

	public static function cancel_reservation($id)
	{
		try {
			$query = "Update movies SET Status = 'Available' where Movie_ID = $id ";
			$database = new Database();
			$connection = $database->Get_Connection();
			$statement = $connection->prepare($query);
			$statement->execute();
		} catch (PDOException $e) {
			echo "Query Failed " . $e->getMessage();
		}
	}
}

?>
<?php 
require_once("Database.php");

class Movie{
	
	//			private static $database;
	
	
	public static function Get_Search_Query ($option, $category_ID = null, $keywords = null){

		$query = "";
		$selected = $option;
		switch($selected){
			case 0: $query = "SELECT * FROM movies";
				break;
			case 1: $query = "SELECT * FROM movies WHERE Category_ID = $category_ID";
				break;
			case 2: $query = "SELECT * FROM movies WHERE Title LIKE '%$keywords%'";
				break;
		}
		return $query;

	}

	
		public static function Get_All_Movies ($query ){
		try{
			$query  .= " ORDER BY Title ";
				
			$database = Database::Get_Instance();
			$connection = $database->Get_Connection();
			$statement = $connection->prepare($query);
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $result;
			
		}catch(PDOException $e ){
			echo "Query Failed ". $e->getMessage();
		}
	}
		
	public static function Display($array) {
		echo "<form action='#' method='post'>";
		echo "<table border=0 width='750'>";
        echo "<tr>";
		echo "<th><h4 style = 'font-weight: bold;'>Movie</h4></th>";
        echo "<th><h4 style = 'font-weight: bold;'>Description</h4></th>";
		echo "<th><h4 style = 'font-weight: bold;'>Category</h4></th>";
        echo "<th><h4 style = 'font-weight: bold;'>Status</h4></th>";
		echo "<th><h4 style = 'font-weight: bold;'>Reserve</h4></th>";
        echo "</tr>";
        
	   foreach($array as $row){
			 $Movie_ID = $row['Movie_ID'];
			 $Image = $row['Image'];
			 $Title = $row['Title']; 
			 $Actors = $row['Actors'];
			 $Year = $row['Year'];
			 $Status = $row['Status'];
			 $Category_ID =$row['Category_ID'];
			 $Category = Database::Get_Name($Category_ID);
			 
		   echo "<tr>";
		   echo "<td><img src='images/$Image' height='150px' width='auto' /></td>";
		   echo "<td style='width:35%' ><h4>".$Title."</h4><h5>".$Actors."</h5></td>";
           echo "<td style='width:20%' ><h4>".$Category."</h4></td>";	
		   if($Status == 'Available'){
				echo "<td style='width:10%'><img src='images/Yes.png' /></td>"; 
				echo "<td style='width:15%'>";
				echo "<form action = '#' method = 'post'>";
				echo "<input type = 'hidden' name= 'Movie_ID' value =".$Movie_ID." >";
				echo "<button type ='submit' name = 'Reserve' class='btn btn-info'>Reserve   <span class='fa fa-folder-open'></span></button>";
				echo "</form></td>";
		   }else{
			   echo "<td style='width:10%'><img src='images/No.png' /></td>"; 
		   }
		   echo "</tr>";					
		}
        echo "</table>";
		echo "</form>";
	}
}

?>
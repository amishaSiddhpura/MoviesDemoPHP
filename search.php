<?php 

 include_once "classes/Movie.php";
	$selected = 0;
	$checked  = 0;
	$keywords = ''; 
?>
<script>
function updateSeachBy(){
	document.getElementById("searchBy").checked = true;
}
function updateSeachByTitle(){
	document.getElementById("searchByTitle").checked = true;
}
</script>
<?php include "includes/header.php"; ?>
    
<body>
<div  id="page" align="center">
<div id="content" style="width:800px">
	<?php include "includes/menu.php"; ?>
	
<div id="contenttext">
	<?php $logoTitle = "Search Movies";?>
	<?php include 'includes/logo.php'; ?>
	
	<?php

				if (isset($_POST["search"])) {

					$checked = $_POST["search"];

					$expiration = time() + (86400 * 30); //30days

					setcookie('checked', $_POST["search"], $expiration);
					setcookie('category', $_POST['category'], $expiration);
					setcookie('keywords', $_POST["keywords"], $expiration);
				}

				if (isset($_POST['Reserve'])) {
					$Movie_ID = $_POST['Movie_ID'];
					Database::Make_reservation($Movie_ID);
				}
				if (isset($_POST['CancelReserve'])) {
					$Movie_ID = $_POST['Movie_ID'];
					Database::cancel_reservation($Movie_ID);
				}

				if (isset($_COOKIE["checked"])) {
					$checked = $_COOKIE["checked"];
					$selected = $_COOKIE["category"];
					$keywords = $_COOKIE["keywords"];
				}
				?>
    <br/>
    <br/>
    <br/>
	 <strong><div class="bodytext" align="left" style="width:800px">
      

       
       <div class="col-xs-6" >
         
           <form action="#" method="post"><fieldset><legend></legend>
              
			  <input type="radio" name="search" value="0"  <?php if($checked == 0){echo "checked"; } ?>> Search All <br/> <br/>
				
			  <input type="radio" name="search" id = "searchBy" value="1"<?php if($checked == 1){echo "checked"; } ?>> Search By Category :
			  
				<select name='category' style="font-size:13pt;font-weight:bold;" onChange="updateSeachBy()">
				<option value = '0' <?php if($selected == 0 ){echo "selected"; } ?>>None </option>
				<option value = '1' <?php if($selected == 1 ){echo "selected"; } ?>>Action </option>
				<option value = '2' <?php if($selected == 2 ){echo "selected"; } ?>>Adventure </option>
				<option value = '3' <?php if($selected == 3 ){echo "selected"; } ?>>Animation </option>
				<option value = '4' <?php if($selected == 4 ){echo "selected"; } ?>>Comedy </option>
				<option value = '5' <?php if($selected == 5 ){echo "selected"; } ?>>Drama </option>
				<option value = '6' <?php if($selected == 6 ){echo "selected"; } ?>>Family </option>
				<option value = '7' <?php if($selected == 7 ){echo "selected"; } ?>>Horror </option>
				<option value = '8' <?php if($selected == 8 ){echo "selected"; } ?>>Romance </option>
				<option value = '9' <?php if($selected == 9 ){echo "selected"; } ?>>Science-Fiction</option>
				<option value = '10'<?php if($selected == 10){echo "selected"; } ?>>Superhero</option>
				</select><br/><br/>
				<input type="radio" name="search" value="2" id = "searchByTitle"  <?php if($checked == 2){echo "checked"; } ?>> Search By Title:
				<input type="text"  name="keywords" value='<?php echo $keywords ?>' size="20" style="font-weight:bold;" onkeydown = "updateSeachByTitle()">
				<br/> <br/>
				
				<input type="submit" name="submit" value="Search Movies">
              
               
               </fieldset></form>           
           
		   
    </div><br/><br/><br/>

    </div> 
 	 
    </strong>
		
				
	</div>
     
         <div class="col-xs-6" >
     <?php 
			echo "<hr size='5' width='750'>";
			//TODO : Submit the Form and Display Results
				if(isset($_POST["search"])){
				
				$Checked  = $_POST["search"];
			
				
				if($Checked == 0){
					$query = Movie::Get_Search_Query($Checked);
					$movies = Database::Execute_Query($query);
					Movie::Display($movies);
				} else if($Checked == 1){
					$Category_ID = $_POST['category'];
					$query = Movie::Get_Search_Query($Checked, $Category_ID);
					$movies = Database::Execute_Query($query);
					Movie::Display($movies);
				} else {
					$keywords = $_POST['keywords'];
					$Category_ID = 0;
					$query = Movie::Get_Search_Query($Checked, $Category_ID, $keywords);
					$movies = Database::Execute_Query($query);
					Movie::Display($movies);
				}
				
				if (isset($_POST["search"]) ){
								
							}
				
			}
			echo "<hr size='5' width='750'>";
       ?>		      	      
    </div> 
     <?php include "includes/footer.php"; ?>
    </div>
	</div>
</body>
</html>
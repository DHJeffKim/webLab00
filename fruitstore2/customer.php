<!DOCTYPE html>
<html>
	<head>
		<title>Fruit Store</title>
		<link href="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/pResources/gradestore.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		
		<?php
		# Ex 4 : 
		# Check the existance of each parameter using the PHP function 'isset'.
		# Check the blankness of an element in $_POST by comparing it to the empty string.
		# (can also use the element itself as a Boolean test!)
		# if (){
		if (isset($_POST['name']) && isset($_POST['number']) && isset($_POST['credit'])  && isset($_POST['card']) ){
		 	foreach ($_POST as $post) {
		 		if(empty($post)){
		 			errorr("You didn't fill out the form completely. ");
		 		}
		 	}
		 }
		 else{
		 	errorr("You didn't fill out the form completely. ");
		 }
		?>


		<!-- Ex 4 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't fill out the form completely. Try again?</p>
		--> 
		<?
			function errorr($state){
				?>
			
			<h1>Sorry</h1>
			<p><?=$state?>
				<a href="fruitstore.html">Try again?</a></p>
			<?
			exit();
		}?>

		<?php
		# Ex 5 : 
		# Check if the name is composed of alphabets, dash(-), ora single white space.
		# } elseif () { 
		
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid name. Try again?</p>
		--> 

		<?php
		# Ex 5 : 
		# Check if the credit card number is composed of exactly 16 digits.
		# Check if the Visa card starts with 4 and MasterCard starts with 5. 
		# } elseif () {
		?>

		<!-- Ex 5 : 
			Display the below error message : 
			<h1>Sorry</h1>
			<p>You didn't provide a valid credit card number. Try again?</p>
		--> 

		<?php
		# if all the validation and check are passed 
		# } else {
		?>

		<h1>Thanks!</h1>
		<p>Your information has been recorded.</p>
		
		<!-- Ex 2: display submitted data -->
		<ul> 
			<li>Name: <?= $_POST["name"] ?></li>
			<li>Membership Number: <?= $_POST["number"] ?></li>
			<li>Options: <?= processCheckbox($_POST["fruit"]) ?></li>
			<li>Fruits: <?= $_POST["fruits"]." - ".$_POST["quantity"] ?></li>
			<li>Credit <?= $_POST["credit"]." (".$_POST["card"].")" ?></li>
		</ul>
			<p>This is the sold fruits count list:</p> 
		<?php
			$filename = "customers.txt";
			/* Ex 3: 
			 * Save the submitted data to the file 'customers.txt' in the format of : "name;membershipnumber;fruit;number".
			 * For example, "Scott Lee;20110115238;apple;3"
			 */
			file_put_contents($filename, $_POST["name"].";".$_POST["number"].";".$_POST["fruits"].";".$_POST["quantity"]."\n", FILE_APPEND);

		?>
		
		<!-- Ex 3: list the number of fruit sold in a file "customers.txt".
			Create unordered list to show the number of fruit sold -->
		<ul>
		<?php 
		$fruitcounts = soldFruitCount($filename);
		foreach($fruitcounts as $line) {
			
		?>
			<li><?= $line ?></li>
		<?php
		}
		?>
		</ul>
				
		<?php
			/* Ex 3 :
			* Get the fruits species and the number from "customers.txt"
			* 
			* The function parses the content in the file, find the species of fruits and count them.
			* The return value should be an key-value array
			* For example, array("Melon"=>2, "Apple"=>10, "Orange" => 21, "Strawberry" => 8)
			*/
			function soldFruitCount($filename) {
				$result = array(0, 0, 0, 0);
				$lines = file($filename);
				foreach($lines as $line) {
					$tmp = explode(";", $line);
					if ($tmp[2] == "Melon") {
						$result[0] += $tmp[3]; 
					}
					else if ($tmp[2] == "Apple") {
						$result[1] += $tmp[3];
					}
					else if ($tmp[2] == "Orange") {
						$result[2] += $tmp[3];
					}
					else if ($tmp[2] == "Strawberry") {
						$result[3] += $tmp[3];
					}
				}
				return array("Melon - ".$result[0], "Apple - ".$result[1], "Oragne - ".$result[2], "Strawberry - ".$result[3]);
			}
			function processCheckbox($names) {
				$x = count($names) - 1;
				foreach ($names as $name) {
					$option = "";
					$option = $option . $name;
					if ($x > 0) {
						$option = $option . ", ";
						$x--;
					}
				}
				return $option;
			}
		?>
		
	</body>
</html>


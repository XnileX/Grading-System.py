<?php include "conn.php";
?>
<!DOCTYPE html><html>
<head>
	<title>grade calculation</title>
</head>
<body>
	<center>
	<h1>Grade Calculation</h1>
	<form method="post">
		<input type="text" name="fn" placeholder="First Name"><br>
		<input type="text" name="ln" placeholder="Last Name"><br>
		<input type="number" name="unit" placeholder="Unit"><br>
		<input type="number" name="prelim" placeholder="Prelim"><br>
		<input type="number" name="midterm" placeholder="Midterm"><br>
		<input type="number" name="prefinal" placeholder="Prefinal"><br>
		<input type="number" name="final" placeholder="Final"><br>
		<input type="submit" name="save" value="Save">
	</form>
	<?php
	if (isset($_POST['save'])) {
		$fname=$_POST['fn'];
		$lname=$_POST['ln'];
		$unit1=$_POST['unit'];
		$prelim1=$_POST['prelim'];
		$midterm1=$_POST['midterm'];
		$prefinal1=$_POST['prefinal'];
		$final1=$_POST['final'];
		mysqli_query($connection,"INSERT INTO tbl_user(firstname,lastname,unit,prelim,midterm,prefinal,final) VALUES('$fname','$lname','$unit1','$prelim1','$midterm1','$prefinal1','$final1')");
		echo "<script>aert('Saved Successfully!')</script>";
		echo "<script>window.location'index.php'</script>";
	}
	  ?>
	<style type="text/css">
		input{
			margin: 3px;
		}
		table, th, td{
			border: 1px solid black;
			background-color: darkkhaki;
		}
		td{
			text-align: center;
		}
		table {
			border-collapse: collapse;
			width: 80%;
			margin-top: 30px;
		}
		th{
			height: 70px;
		}
	</style>
		<table>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Unit</th>
				<th>Prelim</th>
				<th>Midterm</th>
				<th>Prefinal</th>
				<th>Final</th>
				<th>Average</th>
				<th>Remarks</th>
			</tr>
			<?php 
				$result=mysqli_query($connection,"select * from tbl_user") or die("database error:".mysqli_error($connection));
				while ($row=mysqli_fetch_array($result)){
					$user_id=$row['user_id'];
					$first_name=$row['firstname'];
					$last_name=$row['lastname'];
					$unit2=$row['unit'];
					$prelim2=$row['prelim'];
					$midterm2=$row['midterm'];
					$prefinal2=$row['prefinal'];
					$final2=$row['final'];
					$grade=5;
					$adding=($unit2+$prelim2+$midterm2+$prefinal2+$final2);
					$average=($adding/$grade);
			 ?>
			<tr>
				<td><?php echo $first_name; ?></td>
				<td><?php echo $last_name; ?></td>
				<td><?php echo $unit2; ?></td>
				<td><?php echo $prelim2; ?></td>
				<td><?php echo $midterm2; ?></td>
				<td><?php echo $prefinal2; ?></td>
				<td><?php echo $final2; ?></td>
				<td><?php echo $average; ?></td>
				<td><a href="delete.php?delete=<?php echo $user_id;?>">delete</a> | <a href="edit.php?edit=<?php echo $user_id;?>">edit</a></td>
				<td><?php
							if ($average>=75) {
								echo "<h6 style='color:green'>Passed</h6>";	
							}
							else{
								echo "<h6 style='color:red'>Failed</h6>";
							}
				 ?></td>	
			<?php 
			 }
			 ?>
		</table>
	</center>
</body>
</html>

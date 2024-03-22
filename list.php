<html>
<head><title> Display.php </title></head>
<body >
<?php


define('DB_SERVER', 'freedomgurunew.cetkmzawcuvu.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', '#$FreedomrDs2020$#');
define('DB_DATABASE', 'freedomguru'); //where customers is the database
$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);



//$query="SELECT id,catFirstTitle,catSecondTitle,catImage,otherimage,newimage FROM fg_category"; // Fetch all the records from the table address
$query = “SELECT a.id,catFirstTitle,catSecondTitle,catImage,otherimage,newimage,playListBackImage,androidplayListBackImage FROM fg_category a, fg_meditationPlayList b where a.id=b.catId”;
$result=mysqli_query($db,$query);
?>

<h3> Page to display the stored data </h3>

<table border="1">
<tr>
<th> ID </th>
<th> REFLECTION </th>
<th> Image1 </th>
<th>Image2</th>
<th>Image3</th>
<th>iOS Bg Image</th>
<th>Android Bg Image</th>
</tr>

<?php while($row=$result->fetch_assoc()) {

	//print_r($row);
	//echo $row["id"];
  echo "<tr><td>".$row["a.id"]."</td>";
  echo "<td>".$row["catFirstTitle"]." ".$row["catSecondTitle"]."</td>";

  echo "<td><img src='https://freedomguru.s3.amazonaws.com/dump/mainCat/".$row['catImage']."' width='250' height='250'></td>";
  echo "<td><img src='https://freedomguru.s3.amazonaws.com/dump/mainCat/".$row['otherimage']."' height='250'></td>";
  echo "<td><img src='https://freedomguru.s3.amazonaws.com/dump/mainCat/".$row['newimage']."' height='250'></td>";
  echo "<td><img src='https://freedomguru.s3.amazonaws.com/dump/mainCat/".$row['playListBackImage']."' height='250'></td>";
  echo "<td><img src='https://freedomguru.s3.amazonaws.com/dump/mainCat/".$row['androidplayListBackImage']."' height='250'></td></tr>";


}
//mysqli_close($db); ?>
</table>
</body>
</html>

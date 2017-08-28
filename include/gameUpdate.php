<?php include "db.php";

$gameId = $_GET['gameId'];
$query = "SELECT * FROM games WHERE id=$gameId";
$result =  mysqli_query($conn, $query);

$to_encode = array();
while($row = mysqli_fetch_assoc($result)) {
  $to_encode[] = $row;
}
echo json_encode($to_encode);

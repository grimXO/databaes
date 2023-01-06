<?php
include "connect.php";
?>
<?php
$owner_id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM owners WHERE id = :id");
$stmt->bindParam(':id', $owner_id);
$stmt->execute();
$row = $stmt->fetch();

$owner_name = $row['name'];
$owner_address = $row['address'];
$owner_email = $row['email'];
$owner_phone = $row['phone'];

echo "<h1>Owner Details</h1>";
echo "<p>Name: $owner_name</p>";
echo "<p>Address: $owner_address</p>";
echo "<p>Email: $owner_email</p>";
echo "<p>Phone: $owner_phone</p>";


?>
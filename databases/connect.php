<?php
// Connect to the MySQL database
try {
    $conn = new PDO('mysql:host=localhost;dbname=data', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    echo "Oh no, there was a problem" . $exception->getMessage();
}
?>
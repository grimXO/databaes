<?php
include "connect.php";
?>

<?php

$result = $conn->query('SELECT COUNT(*) as num_owners FROM owners');
$row = $result->fetch();
$num_owners = $row['num_owners'];

$result = $conn->query('SELECT COUNT(*) as num_dogs FROM dogs');
$row = $result->fetch();
$num_dogs = $row['num_dogs'];

$result = $conn->query('SELECT COUNT(*) as num_events FROM events');
$row = $result->fetch();
$num_events = $row['num_events'];

$output = "This year $num_owners owners entered $num_dogs dogs in $num_events events!";

?>

<html>

<body>
    <h1>Welcome to Poppleton Dog Show <?php echo $output; ?> </h1>

    <table>
        <tr>
            <th>Name</th>
            <th>Breed</th>
            <th>Average Score</th>
            <th>Owners Name</th>
            <th>Email Address</Address>
            </th>
        </tr>
    </table>

    <ul>
        <?php
        $stmt = $conn->prepare("SELECT d.name AS dog_name, b.name AS breed, AVG(e.score) AS avg_score, o.email AS owner_email, o.name AS owner_name, o.id AS owner_id
       FROM dogs d
       JOIN entries e ON e.dog_id = d.id
       JOIN breeds b ON b.id = d.breed_id
       JOIN owners o ON d.owner_id = o.id
       GROUP BY d.id
       HAVING COUNT(*) > 1
       ORDER BY avg_score DESC
       LIMIT 10");
        $stmt->execute();

        $result = $stmt->fetchAll();
        foreach ($result as $row) {
            $dog_name = $row['dog_name'];
            $breed = $row['breed'];
            $avg_score = $row['avg_score'];
            $owner_email = $row['owner_email'];
            $owner_name = $row['owner_name'];
            $owner_id = $row['owner_id'];

            echo "<li>$dog_name ($breed): $avg_score:<a href='details.php?id=" . $owner_id . "'>$owner_name</a>: <a href='mailto:$owner_email'>$owner_email</a></li>";
        }
        ?>
    </ul>

</body>

</html>
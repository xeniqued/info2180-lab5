<?php

// Allow all origins (you can restrict this to specific domains for security)
header("Access-Control-Allow-Origin: *"); // Allow all domains (you can specify a domain if necessary)
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allow GET, POST, and OPTIONS methods
header("Access-Control-Allow-Headers: Content-Type"); // Allow certain headers

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = isset($_GET['country']) ? $_GET['country'] : '';

if (!empty($country)) {
  $query = "SELECT * FROM countries WHERE name LIKE '%$country%'";

}
else{
  $query = "SELECT * FROM countries";

}

$stmt = $conn->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>
<ul>
<?php foreach ($results as $row): ?>
  <li>
    <?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?>
  </li>
<?php endforeach; ?>
</ul>


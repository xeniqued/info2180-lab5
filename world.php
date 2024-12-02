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
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : 'country';


if ($lookup === 'cities') {
  // fetch cities in the specified country
  $query = !empty($country) 
      ? "SELECT cities.name AS city, cities.district, cities.population 
         FROM cities 
         JOIN countries ON cities.country_code = countries.code 
         WHERE countries.name LIKE '%$country%'"
      : "SELECT cities.name AS city, cities.district, cities.population FROM cities";
} else {
  // fetch country information
  $query = !empty($country) 
      ? "SELECT * FROM countries WHERE name LIKE '%$country%'"
      : "SELECT * FROM countries";
}

$stmt = $conn->query($query);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>


<!-- Table Output -->

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
</style>

<?php if ($lookup === 'country'): ?>
<!-- Country Table Output -->
<table border="1">
    <thead>
        <tr>
            <th>Country</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['continent']) ?></td>
            <td><?= htmlspecialchars($row['independence_year']) ?></td>
            <td><?= htmlspecialchars($row['head_of_state']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php elseif ($lookup === 'cities'): ?>
<!-- Cities Table Output -->
<table border="1">
    <thead>
        <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['city']) ?></td>
            <td><?= htmlspecialchars($row['district']) ?></td>
            <td><?= htmlspecialchars($row['population']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
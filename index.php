<?php
// Database configuration
$host = 'myphpproject.cznehspwjxi5.us-east-1.rds.amazonaws.com';
$dbname = 'test';
$username = 'admin';
$password = 'admin1234';

try {
    // Establish a database connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sample query to fetch users
    $query = "SELECT * FROM users";
    $stmt = $conn->prepare($query);
    
    if ($stmt->execute()) {
        // Fetch all data into an array
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Display fetched data in a styled table
        echo "<style>
            table {
                width: 50%;
                border-collapse: collapse;
                margin: 20px;
            }
            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>";

        echo "<h2>Users:</h2>";
        echo "<table>";
        echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>{$user['id']}</td>";
            echo "<td>{$user['username']}</td>";
            echo "<td>{$user['email']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Query execution failed.";
    }

    // Close the connection
    $conn = null;
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Error: " . $e->getMessage();
}
?>

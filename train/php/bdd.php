<?php

function DatabaseConnection()
    {
        // Replace these values with your actual database credentials
$host = getenv('DB_HOST');
$user = "root";
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

        // Attempt to create a new PDO instance (representing a database connection)
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
            return $pdo;
        } catch (PDOException $e) {
            // If an exception is caught, fail the test
            echo $e->getMessage();
        }
    }

?>

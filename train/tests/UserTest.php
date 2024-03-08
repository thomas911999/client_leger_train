<?php 

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    /**
     * Test if the database connection can be established.
     *
     * @return void
     */
    public function testDatabaseConnection(): void
    {
        // Replace these values with your actual database credentials
$host = getenv('DB_HOST');
$user = "root";
$pass = getenv('DB_PASS');
$name = getenv('DB_NAME');

        // Attempt to create a new PDO instance (representing a database connection)
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
            $this->assertInstanceOf(PDO::class, $pdo);
        } catch (PDOException $e) {
            // If an exception is caught, fail the test
            $this->fail("Failed to connect to the database: " . $e->getMessage());
        }
    }

    /**
     * Test if the database connection can be established.
     *
     * @return void
     */
    public function testTableUserExists(): void
    {
        // Replace these values with your actual database credentials
        $host = 'localhost';
        $user = "root";
        $pass = "";
        $name = "train";

        // Attempt to create a new PDO instance (representing a database connection)
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$name", $user, $pass);
            $this->assertInstanceOf(PDO::class, $pdo);
            $result = $pdo->query("SHOW TABLES LIKE 'User'");
            $tableExists = $result->rowCount() > 0;

            $this->assertTrue($tableExists, 'User table does not exist in the database.');

        } catch (PDOException $e) {
            // If an exception is caught, fail the test
            $this->fail("Failed to connect to the database: " . $e->getMessage());
        }
    }

}
<?php
require_once __DIR__ . '/../php/verif.php';

use PHPUnit\Framework\TestCase;

class RegisterLoginTest extends TestCase
{

    /**
     * Test if the database connection can be established.
     *
     * @return void
     */
    public function testMd5(): void
    {
        $pwd = "Test";
        $md5 = "0cbc6611f5540bd0809a388dc95a615b";
        $test_function = pass_crypt($pwd);
        $this->assertEquals( $test_function , $md5 ,"Le mot de passse n'est pas crypté correctement attendu: $md5 , resultat : $test_function");
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
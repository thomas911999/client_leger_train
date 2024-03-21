<?php
require_once __DIR__ . '/../php/login/verif.php';

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

    public function testloginOK(): void
    {
        $login = "admin";
        $pass = "admin";
        $test_function = check_login($login,$pass);
        $this->assertTrue( $test_function , "Le mot de passse ou le login n'est pas bon");
        $this->assertEquals( $_SESSION["login"] , $login ,"Oublie de la session login");

    }

    public function testloginFAIL(): void
    {
        $login = "admin";
        $pass = "admi";
        $test_function = check_login($login,$pass);
        $this->assertNotTrue( $test_function , "Login et mot de passe correct mais la fonction est fausse , erreur dans le login ou mdp");
        $this->assertEquals( $_SESSION["login"] , null ,"Session fail mais initier");
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
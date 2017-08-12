
<?php
    $dsn = 'mysql:dbname=al224;host=sql1.njit.edu';
    $username = 'al224';
    $password = 'wSt5Tjc0';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('database_error.php');
        exit();
    }
?>

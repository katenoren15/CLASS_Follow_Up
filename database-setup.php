  <?php

    $host = $_POST["localhost"];
    $dbuser = $_POST["dbuser"];
    $dbpass = $_POST["dbpass"];
    $database = $_POST["database"]; 

    $connection = mysqli_connect($host, $dbuser, $dbpass, $database);
    
    if(!$connection){
        echo "Failed to connect: " . mysqli_connect_error();
        return mysqli_connect_error();
    }

    $file1 ="config/config.ini";
    $current1 = array("host" => $host, "user" => $dbuser, "pass" => $dbpass, "dbname" => $database);
    
        file_put_contents($file1, "host = " . $current1["host"]. "\r\n");
        file_put_contents($file1, "user = " . $current1["user"]. "\r\n", FILE_APPEND);
        file_put_contents($file1,"pass = " . $current1["pass"]. "\r\n", FILE_APPEND);
        file_put_contents($file1, "dbname = " . $current1["dbname"]. "\r\n", FILE_APPEND);
    


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$sql = '';

$sqlines = file("class_follow_up.sql");

foreach ($sqlines as $sqline){
    if (substr($sqline, 0, 2) == '--' || $sqline == '')
        continue;

    $sql .= $sqline;

    if (substr(trim($sqline), -1, 1) == ';') {
        $connection->query($sql) or print('Error performing query \'<strong>' . $sql . '\': ' . $connection->error() . '<br /><br />');

        $sql = '';
    }
}
echo $database;
echo "Tables imported successfully";

$file = "check.txt";
$current = "Yes";

if(file_put_contents($file, $current)){
    header('location:login.php');
}

?>

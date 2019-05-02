<?php
require_once ('includes/dbconnect.php');
$connection = db_connect();
session_start();
$userid = $_SESSION["user"]; 

        if(isset($_POST["backup"])){
            $mysqlExportPath ='class-follow-up.sql';
            $command='mysqldump --opt -h' .$_SESSION["localhost"] .' -u' .$_SESSION["dbuser"] .' -p' .$_SESSION["dbpass"] .' ' .$$_SESSION["database"] .' > ' .$mysqlExportPath;
            exec($command,$output=array(),$worked);
            switch($worked){
            case 0:
            echo 'The database <b>' .$_SESSION["database"] .'</b> was successfully stored in the following path '.getcwd().'/' .$mysqlExportPath .'</b>';
            break;
            case 1:
            echo 'An error occurred when exporting <b>' .$_SESSION["database"] .'</b> zu '.getcwd().'/' .$mysqlExportPath .'</b>';
            break;
            case 2:
            echo 'An export error has occurred, please check the following information: <br/><br/><table><tr><td>MySQL Database Name:</td><td><b>' .$_SESSION["database"] .'</b></td></tr><tr><td>MySQL User Name:</td><td><b>' .$mysqlUserName .'</b></td></tr><tr><td>MySQL Password:</td><td><b>NOTSHOWN</b></td></tr><tr><td>MySQL Host Name:</td><td><b>' .$mysqlHostName .'</b></td></tr></table>';
            break;
        }   
         /*    // Get All Table Names From the Database
        $tables = array();
        $sql = "SHOW TABLES";
        $result = mysqli_query($connection, $sql);
    
        while ($row = mysqli_fetch_row($result)) {
            $tables[] = $row[0];
        }
        $sqlScript = "";
        foreach ($tables as $table) {
        
        // Prepare SQL script for creating table structure
        $query = "SHOW CREATE TABLE $table";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_row($result);
        
        $sqlScript .= "\n\n" . $row[1] . ";\n\n";
        
        
        $query = "SELECT * FROM $table";
        $result = mysqli_query($connection, $query);
        
        $columnCount = mysqli_num_fields($result);
        
        // Prepare SQLscript for dumping data for each table
        for ($i = 0; $i < $columnCount; $i ++) {
            while ($row = mysqli_fetch_row($result)) {
                $sqlScript .= "INSERT INTO $table VALUES(";
                for ($j = 0; $j < $columnCount; $j ++) {
                    $row[$j] = $row[$j];
                    
                    if (isset($row[$j])) {
                        $sqlScript .= '"' . $row[$j] . '"';
                    } else {
                        $sqlScript .= '""';
                    }
                    if ($j < ($columnCount - 1)) {
                        $sqlScript .= ',';
                    }
                }
                $sqlScript .= ");\n";
            }
        }
        
        $sqlScript .= "\n"; 
        }
        if(!empty($sqlScript))
        {
        // Save the SQL script to a backup file
        $backup_file_name = $database_name . '_backup_' . date("Y-m-dh:i:s") . '.sql';
        $fileHandler = fopen($backup_file_name, 'w+');
        $number_of_lines = fwrite($fileHandler, $sqlScript);
        fclose($fileHandler); 
    
        // Download the SQL backup file to the browser
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($backup_file_name));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($backup_file_name));
        ob_clean();
        flush();
        readfile($backup_file_name);
        exec('rm ' . $backup_file_name); 
    }
    echo "File created successfully";*/

    }

//Restore


if(isset($_POST["restore"])){

    /*$name= $_FILES['backup_file']['name'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $position= strpos($name, "."); 

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);

    if($fileextension !== "sql"){
        echo "Incorrect file type. Please select a .sql file.";
    }

    $final_file=str_replace(' ','-',$name);

    $restore = 'mysql -h' .$_SESSION["localhost"] .' -u' .$_SESSION["dbuser"].' -p' .$_SESSION["dbpass"] .' ' .$_SESSION["database"] .' < ' .$final_file;
    exec($restore);*/
}

    /*$name= $_FILES['backup_file']['name'];

        $tmp_name= $_FILES['file']['tmp_name'];

        $position= strpos($name, "."); 

        $fileextension= substr($name, $position + 1);

        $fileextension= strtolower($fileextension);

        if($fileextension !== "sql"){
            echo "Incorrect file type. Please select a .sql file.";
        }

        $final_file=str_replace(' ','-',$name);

        if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                move_uploaded_file($final_file, $_FILES["backup_file"]["name"]);
                $response = restoreMysqlDB($final_file, $connection);
        }else{
            echo "Error " . mysqli_error($connection);
        }

        function restoreMysqlDB($filePath, $connection)
{
    $sql = '';
    $error = '';
    
    if (file_exists($filePath)) {
        $lines = file($filePath);
        
        foreach ($lines as $line) {
            
            // Ignoring comments from the SQL script
            if (substr($line, 0, 2) == '--' || $line == '') {
                continue;
            }
            
            $sql .= $line;
            
            if (substr(trim($sqline), -1, 1) == ';') {
        $connection->query($sql) or print('Error performing query \'<strong>' . $sql . '\': ' . $connection->error() . '<br /><br />');

        $sql = '';
    }
} 
    return "Database Restore Completed Successfully.";
}
}*/

    

?>


<?php

/* if(isset($_POST["restore"])){
    if (! empty($_FILES)) {
        // Validating SQL file type by extensions
        if (! in_array(strtolower(pathinfo($_FILES["backup_file"]["name"], PATHINFO_EXTENSION)), array(
            "sql"
        ))) {
            $response = array(
                "type" => "error",
                "message" => "Invalid File Type"
            );
        } else {
            if (is_uploaded_file($_FILES["backup_file"]["tmp_name"])) {
                move_uploaded_file($_FILES["backup_file"]["tmp_name"], $_FILES["backup_file"]["name"]);
                $response = restoreMysqlDB($_FILES["backup_file"]["name"], $conn);
            }
        }
    }
    
    function restoreMysqlDB($filePath, $conn)
    {
        $sql = '';
        $error = '';
        
        if (file_exists($filePath)) {
            $lines = file($filePath);
            
            foreach ($lines as $line) {
                
                // Ignoring comments from the SQL script
                if (substr($line, 0, 2) == '--' || $line == '') {
                    continue;
                }
                
                $sql .= $line;
                
                if (substr(trim($line), - 1, 1) == ';') {
                    $result = mysqli_query($conn, $sql);
                    if (! $result) {
                        $error .= mysqli_error($conn) . "\n";
                    }
                    $sql = '';
                }
            } // end foreach
            
            if ($error) {
                $response = array(
                    "type" => "error",
                    "message" => $error
                );
            } else {
                $response = array(
                    "type" => "success",
                    "message" => "Database Restore Completed Successfully."
                );
            }
        } // end if file exists
        return $response;
    }
}*/


?>
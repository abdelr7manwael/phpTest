<?php
session_start(); 
if(isset($_POST['connect'])){
    $filename= "../tables.sql";
    $_SESSION['Hoster'] =  $_POST['Hoster'];
    $_SESSION['UserName'] =    $_POST['UserName'];
    $_SESSION['Password'] =    $_POST['Password'];
    $_SESSION['Database'] =      $_POST['Database'];

    // connect server
    $mysqli = new mysqli($_SESSION['Hoster'], $_SESSION['UserName'], $_SESSION['Password'],$_SESSION['Database']);
    if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
    }
    //select the Databse
    $mysqli -> select_db( $_SESSION['Database']);

    // readed query
    $query = '';

    // Read in entire file
    $lines = file($filename);

    // Loop through each line
    foreach ($lines as $line)
    {

        // Skip it if it's a comment
        if (substr($line, 0, 2) == '--' || $line == '')
            continue;

        // Add this line to the current segment
        $query .= $line;
       
        if (substr(trim($line), -1, 1) == ';')
        {
            // Perform the query
            $mysqli->query($query) 
            or print('Error performing query \'<strong>' . $query . '\' :<br>' . $mysqli -> error . '<br /><br />');
            // Reset to empty
            $query = '';
        }
    }
    if(! $mysqli -> error ){
        $_SESSION['success'] = "Tables imported successfully";
        header("location:../index.php");
    }else{
        echo $mysqli -> error;
    }

}else{
    header("location:../index.php");
}

?>

 

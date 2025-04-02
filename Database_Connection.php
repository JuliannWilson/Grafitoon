<?php
$servername = "localhost";
$username ="root";
$password = "";

//Create connection
$conn = new mysqli($servername, $username, $password);

//Check connection
 if($conn->connect_error){die("Connection failed:" . $conn->connect_error); }
 else {
    echo "Database Connected";
    $db_name ="NewDb4";
    //Checking if Database is already created
    $db_check_query ="SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db_name'";
    $result =$conn->query($db_check_query);
    if($result->num_rows > 0)
    {
        echo "<br>Database already exist";
        $conn->select_db($db_name);
        //To create table
        $sql ="CREATE TABLE users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, FirstName VARCHAR(30), LastName (50), Email VARCHAR (40)";
    if($conn ->query($sql)=== true)
{
    echo "Table created successfully";
}
else
{
    echo "Error creating table $con->error";
}

    }
    else{
        $sql ="CREATE DATABASE $db_name";
        if ($conn->query($sql)===TRUE)
        {
            echo "Database $db_name created";
        }
        else{
            echo "Error creating database: $conn->error";
            $conn->close();
        }
        
}
}

//Insert data
$conn->select_db($db_name);
//To create table
$sql ="CREATE TABLE users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, FirstName VARCHAR(30), LastName (50), Email VARCHAR (40)";
if($conn -> query($sql)=== true)
{
echo "Table created successfully";
}
else
{
echo "Error creating table $con->error";
}
<?php          
//Connecting to mySQL server and database.           
$servername = "localhost";           
$username = "root";          
$password = "passionviperport";            
$DBname = "serviceDB";           
$connection = new mysqli($servername,$username,$password);           
//Check if database already created and create a new one if not.          
$createDB = "CREATE DATABASE ".$DBname;            
if($conn->query($createDB)!==TRUE)           
{                
    echo"Error creating database: ".$conn->error."<br>";          
}      
//Create a connection to DB.           
$conn = mysqli_connect($servername,$username,$password,$DBname);           
//Check connection.            
if($conn->connect_error)            
{               
    exit("Connection failed: ".$conn->connect_error);            
}           
else
{                
    echo"Connected successfully to: ".$DBname."<br>";            
}            
//Creating a table.
$createTbl = "";           
if(array_key_exists("createTable",$_POST))           
{               
    $createTable;               
    if($conn->query($createTable))               
    {                  
        echo"Table ".$_POST["newTableName"]." created successfully"."<br>";                
    }              
    else               
    {                  
        echo"Error creating table: ".$conn->error."<br>";               
    }           
}

//Show existing databases when a button is clicked.\n            
if(array_key_exists("showDBs",$_POST))            
{                
    //Check if already connected to mySQL. If not - reconnect.\n                
    if(!$conn)                
    {                    
        $conn = mysqli_connect($servername,$username,$password);                
    }                
    $set = $connection->query("SHOW DATABASES");                
    $DBs = array();
    while($DB = mysqli_fetch_row($set))
    {
        $DBs[] = $DB[0];              
        echo"Existing DBs: "."<br>".implode("<br>",$DBs)."<br>";
    }
}   
//Show existing tables from the selected database.        
if(array_key_exists("showTables",$_POST))            
{                
    $set = $connection->query("SHOW TABLES");                
    $tables = array();                
    while($table = mysqli_fetch_row($set))
    {
        $tables[] = $table[0];                
        echo"Tables in DB: "."<br>".implode("<br>",(array)$tables)."<br>";
    }            
}           
$connection->close();

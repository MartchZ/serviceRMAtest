<?PHP
    session_start();
    require_once ("/var/www/html/inc/config/config.php");
    
    spl_autoload_register(function ($class)
    {
        include"$class.php";
    });
    
    $DB = new cDB;
    
    if(array_key_exists("submitFormInsert",$_POST))
    {
        $table = $config["mainTable"];
        $value = $_POST["test"];
        $registrationDate = date("Y-m-d");
        $contact = $_POST["contact"];
        $company = $_POST["company"];
        $item = $_POST["item"];
        $serialNumber = $_POST["serialNumber"];
        $sqlQuery = "INSERT INTO $table (status, registrationDate, contact, company, item, serialNumber) VALUES ('$value', '$registrationDate', '$contact', '$company', '$item', '$serialNumber')";
        $DB->executeQuery($sqlQuery);
        header("Location: /app/main/rma/service.php");
    }
    
    if(array_key_exists("submitFormUpdate", $_POST))
    {
        $table = $_SESSION["table"];
        $index = $_SESSION["index"];
        $status = $_POST["status"];
        $contact = $_POST["contact"];
        $company = $_POST["company"];
        $item = $_POST["item"];
        $serialNumber = $_POST["serialNumber"];
        $sqlQuery = "UPDATE $table SET test='$status', contact='$contact', company='$company', item='$item', serialNumber='$serialNumber' WHERE `index`=$index";
        $DB->executeQuery($sqlQuery);
        header("Location: /app/main/rma/editRMA.php");
    }
    
    if(array_key_exists("deleteRow", $_POST))
    {
        $table = $_POST["table"];
        $row = $_POST["row"];
        $sqlQuery = "DELETE FROM $table WHERE `index`=$row";
        $DB->executeQuery($sqlQuery);
        header("Location: /app/main/rma/service.php");
    }
    
    if (array_key_exists("editRow", $_POST))
    {
        $_SESSION["table"] = $_POST["table"];
        $_SESSION["index"] = $_POST["index"];
        header("Location: /app/main/rma/editRMA.php");
    }
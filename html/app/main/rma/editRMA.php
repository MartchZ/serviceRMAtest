<?PHP
    session_start();
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    include ("/var/www/html/inc/config/config.php");
    $DB = new cDB();
    $table = $_SESSION["table"];
    $index = $_SESSION["index"];
    $sql = "SELECT * FROM $table WHERE `index`=$index";
    $result = $DB->executeQuery($sql);
    $showData = "";
    
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    $test = $row["test"];
    $contact = $row["contact"];
    $company = $row["company"];
    $item = $row["item"];
    $serialNumber = $row["serialNumber"];
    
    $content = <<< EOT
            <form action="../../../inc/php/handleFormInput.php" method="post">
            Statuss: <select name="status">
                <option value=""></option>
                <option value="registered">pieņemts</option>
                <option value="sendToService">vest uz servisu</option>
                <option value="sentToService">aizvests uz servisu</option>
                <option value="testing">testējas/gaida detaļas</option>
                <option value="ready">gatavs</option>
                <option value="closed">izpildīts</option>
            </select><br>
                Kontaktpersona: <input type="text" name="contact" value={$row['contact']}><br>
                Firma: <input type="text" name="company" value={$row['company']}><br>
                Preces nosaukums: <input type="text" name="item" value={$row['item']}><br>
                S/N: <input type="text" name="serialNumber" value={$row['serialNumber']}><br>
                <input type="submit" name="submitFormUpdate" value="Saglabāt">
            </form>
EOT;
    
    $page->setContent($content);
    
    $site->render();
?>
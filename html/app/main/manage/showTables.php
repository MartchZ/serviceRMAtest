<?PHP
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    include ("/var/www/html/inc/config/config.php");
    $servername = $config['DB']['servername'];
    $username = $config["DB"]["username"];
    $password = $config["DB"]["password"];
    $DBname = $config["DB"]["DBname"];
    $connection = new mysqli($servername,$username,$password,$DBname) or exit("Connection failed: ".$connection->connect_error);
    
    $set = $connection->query("SHOW TABLES") or exit("Cannot show tables: ".$connection->connect_error);
    $showTables = "";
    while($table = $set->fetch_row())
        $tables[] = $table[0];
    $showTables = "Tables in DB: "."<br>".implode("<br>",(array)$tables)."<br>";
    
    $connection->close();
            
    $content = <<< EOT
        <button type="button" onclick="goTo('app/main/manage/main.php');">Back</button><br>
        {$showTables}
EOT;
    $page->setContent($content);
    
    $site->render();
?>
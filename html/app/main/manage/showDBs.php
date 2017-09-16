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
    
    $set = $connection->query("SHOW DATABASES");
    $showDBs = "";
    while($DB = $set->fetch_row())
    {
        $DBs[] = $DB[0];
    }
    $showDBs = "Existing DBs: "."<br>".implode("<br>",$DBs)."<br>";
    
    $connection->close();
            
    $content = <<< EOT
        <button onclick="goTo('app/main/manage/main.php');">Back</button><br>
        {$showDBs}
EOT;
    $page->setContent($content);
    
    $site->render();
?>
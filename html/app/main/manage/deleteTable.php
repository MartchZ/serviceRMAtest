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
    $options = "";
    while($table = $set->fetch_row())
        $tables[] = $table[0];
    for($initial = 0;$initial<=(count($tables)-1);$initial++)
    {
        $options = $options."<option value=".$tables[$initial].">".$tables[$initial]."</option><br>";
    }
    
    $connection->close();
    
    $content = <<< EOT
        <button type="button" onclick="goTo('app/main/manage/main.php');">Back</button><br>
        <form method="post"action="/inc/php/manageDBsrc.php">
            Select table to delete:
            <select name = selectedTable>
                <option value="">Select Table</option>
                {$options}
            </select><br>
            <input type="submit"name="deleteTable"value="Delete Table"onclick="return confirm('Are you sure you want to delte the table?')"><br>
        </form>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
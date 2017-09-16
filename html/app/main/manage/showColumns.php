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
    
    $selectedTable = "";
    if (isset($_GET["selectedTable"]))
    {
        $selectedTable=$_GET["selectedTable"];
    }
    $columns = "";
    if ($selectedTable != "")
    {
        $columnInfo = $connection->query("DESCRIBE `{$selectedTable}`") or exit("Cannot describe tables: ".$connection->error);
        while($row = $columnInfo->fetch_array())
        {
            $columns = $columns."{$row['Field']} - {$row['Type']}<br>";
        }
    }
    
    $connection->close();
    
    $content = <<< EOT
        <button onclick="goTo('app/main/manage/main.php');">Back</button><br>
        <form method="get">
            Choose table whose columns to show:
            <select name = selectedTable>
                <option value="">Select Table</option>
                {$options}}
            </select><br>
            <input type="submit"name="showColumns"value="Show Columns">
        </form>
        Existing columns: <br>
        {$columns}
EOT;
    $page->setContent($content);
    
    $site->render();
?>
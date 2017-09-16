<?PHP
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    include ("/var/www/html/inc/config/config.php");
    $servername=$config['DB']['servername'];
    $username=$config["DB"]["username"];
    $password=$config["DB"]["password"];
    $DBname=$config["DB"]["DBname"];
    $connection=new mysqli($servername,$username,$password,$DBname) or exit("Connection failed: ".$connection->connect_error);
    
    $set=$connection->query("SHOW TABLES") or exit("Cannot show tables: ".$connection->connect_error);
    while($table = $set->fetch_row())
        $tables[]=$table[0];
    $options = "";
    for($initial=0;$initial<=(count($tables)-1);$initial++)
    {
        $options = $options."<option value=".$tables[$initial].">".$tables[$initial]."</option><br>";
    }
    
    $connection->close();

    $content = <<< EOT
        <button type="button" onclick="goTo('app/main/manage/main.php');">Back</button><br>
        <form method="post"action="/inc/php/manageDBsrc.php">
            Select table where the column is:
            <select name = selectedTable>
                <option value="">Select Table</option>
                {$options}
            </select><br>
            Column's original name:<input type="text"name="columnOldName"placeholder="Old Name"><br>
            Column's new name:<input type="text"name="columnNewName"placeholder="New Name"><br>
            Data type of the changed column (check <a target="_blank" href="https://www.tutorialspoint.com/mysql/mysql-data-types.htm">this</a> and <a target="_blank" href="https://dev.mysql.com/doc/internals/en/myisam-column-attributes.html">this</a> for a reference):
            <select name="newColumnDataType">
                    <option value="">Select Data Type</option>
                <optgroup label="Text Types">
                    <option value="CHAR (10)">CHAR (10)</option>
                    <option value="VARCHAR (255)">VARCHAR (255)</option>
                    <option value="TINYTEXT">TINYTEXT</option>
                    <option value="TEXT">TEXT</option>
                    <option value="BLOB">BLOB</option>
                    <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                    <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                    <option value="LONGTEXT">LONGTEXT</option>
                    <option value="LONGBLOB">LONGBLOB</option>
                    <option value="ENUM('yes','no','partial')">ENUM('yes','no','partial')</option>
                    <option value="ENUM('registered','testingWaitingParts','sendToService','sentToService','ready','closed')">ENUM (RMA status)</option>
                    <option value="SET">SET</option>
                </optgroup>
                <optgroup label="Number Types">
                    <option value="TINYINT">TINYINT</option>
                    <option value="SMALLINT">SMALLINT</option>
                    <option value="MEDIUMINT">MEDIUMINT</option>
                    <option value="INT">INT</option>
                    <option value="BIGINT">BIGINT</option>
                    <option value="FLOAT">FLOAT</option>
                    <option value="DOUBLE">DOUBLE</option>
                    <option value="DECIMAL (10,2)">DECIMAL (10,2)</option>
                </optgroup>
                <optgroup label="Date Types">
                    <option value="DATE">DATE</option>
                    <option value="DATETIME">DATETIME</option>
                    <option value="TIMESTAMP">TIMESTAMP</option>
                    <option value="TIME">TIME</option>
                    <option value="YEAR">YEAR</option>
                </optgroup>
            </select><br>
            Specify additional properties for data types (required for CHAR, VARCHAR, ENUM, DECIMAL): <input type="text" name="dataTypeProperties"><br>
            Add optional parameters (check <a target="_blank" href="http://www.peachpit.com/articles/article.aspx?p=1752305&seqNum=3">this</a> for more info) for the column (leave blank if none needed):<input type="text"name="columnAttributes"placeholder="Column Attributes"><br>
            If we want to move the column inside the table (otherwise leave blank):<br>
            Choose to move to first position or after another column:
            <select name="moveColumnTo">
                <option value="">Select New Location</option>
                <option value="FIRST">FIRST</option>
                <option value="AFTER">AFTER</option>
            </select><br>
            Move column to a position after this column (leave blank if moving to first position or not moving at all):
            <input type="text"name="afterColumn"placeholder="Column Name"><br>
            <input type="submit"name="changeColumn"value="Change Column"onclick="return confirm('Are you sure you want to change the column?')">
        </form>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
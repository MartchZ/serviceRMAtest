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
    $options = "";
    while($table = $set->fetch_row())
        $tables[]=$table[0];
    for($initial=0;$initial<=(count($tables)-1);$initial++)
    {
        $options = $options."<option value=".$tables[$initial].">".$tables[$initial]."</option><br>";
    }
    
    $connection->close();
                
    $content = <<< EOT
        <button type="button" onclick="goTo('app/main/manage/main.php');">Back</button><br>
        <form method="post"action="/inc/php/manageDBsrc.php">
            Select table in which to create a new column:
            <select name = selectedTable>
                <option value="">Select Table</option>
                {$options}
            </select><br>
            Name of the new column:<input type="text"name="newColumnName"placeholder="Column name"><br>
            Data type of the new column (check <a target="_blank" href="https://www.tutorialspoint.com/mysql/mysql-data-types.htm">this</a> and <a target="_blank" href="https://dev.mysql.com/doc/internals/en/myisam-column-attributes.html">this</a> for a reference):
            <select name="newColumnDataType">
                    <option value="">Select Data Type</option>
                <optgroup label="Text Types">
                    <option value="CHAR">CHAR</option>
                    <option value="VARCHAR">VARCHAR</option>
                    <option value="TINYTEXT">TINYTEXT</option>
                    <option value="TEXT">TEXT</option>
                    <option value="BLOB">BLOB</option>
                    <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                    <option value="MEDIUMBLOB">MEDIUMBLOB</option>
                    <option value="LONGTEXT">LONGTEXT</option>
                    <option value="LONGBLOB">LONGBLOB</option>
                    <option value="ENUM">ENUM</option>
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
                    <option value="DECIMAL">DECIMAL</option>
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
            If we want to create the column in a particular spot in the table (otherwise leave blank):<br>
            Choose to place it at the first position or after another column:
            <select name="firstOrAfter">
                <option value="">Select Location</option>
                <option value="FIRST">FIRST</option>
                <option value="AFTER">AFTER</option>
            </select><br>
            Create the column in a position after this column (leave blank if moving to first position or not moving at all):
            <input type="text"name="afterColumn" placeholder="Column Name"><br>
            <input type="submit"name="createColumn"value="Create Column"onclick="return confirm('Are you sure you want to create new column?')">
        </form>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
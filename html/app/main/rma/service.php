<?PHP

    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    include ("/var/www/html/inc/config/config.php");
    $DB = new cDB();
    $table = $config["mainTable"];
    $sql = "SELECT * FROM ".$table;
    $result = $DB->executeQuery($sql);
    $showData = "";
    while ($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $showData = $showData.<<< EOT
            <tr>
                <td>{$row['index']}</td>
                <td>{$row['test']}</td>
                <td>{$row['registrationDate']}</td>
                <td>{$row['contact']}</td>
                <td>{$row['company']}</td>
                <td>{$row['item']}</td>
                <td>{$row['serialNumber']}</td>
                <td>
                    <form action="../../../inc/php/handleFormInput.php" method="post">
                        <input type="hidden" name="table" value="$table">
                        <input type="hidden" name="index" value="{$row['index']}">
                        <input type="submit" name="editRow" value="Labot" style="height:20px; width:50px">
                        <input type="submit" name="deleteRow" value="Dzēst" style="height:20px; width:50px" onclick="return confirm('Vai tiešām vēlaties dzēst RMA ierakstu?')">
                    </form>
                </td>
            </tr>\n
EOT;
    }
    
    $content = <<< EOT
        <a href="newRMA.php">Pievienot jaunu</a>
        <table>
            <tr>
                <th>Nr.</th>
                <th>Statuss</th>
                <th>Datums</th>
                <th>Kontaktpersona</th>
                <th>Firma</th>
                <th>Preces nosaukums</th>
                <th>S/N</th>
                <th>Iespējas</th>
            </tr>
            {$showData}
        </table>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
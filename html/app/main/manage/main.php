<?PHP
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    $content = <<< EOT
        <form method="post" action="/inc/php/manageDBsrc.php">
            <input type="submit"name="showDBs"value="Show existing DBs">
            <input type="submit"name="showTables"value="Show Tables In Current DB">
            <input type="submit"name="showColumns"value="Show existing Columns">
        </form>
        <button type="button"onclick="goTo('app/main/manage/deleteDB.php');">Delete DB</button>
        <button type="button"onclick="goTo('app/main/manage/createNewTable.php');">Create A New Table</button>
        <button type="button"onclick="goTo('app/main/manage/deleteTable.php');">Delete Table</button><br>
        <button type="button"onclick="goTo('app/main/manage/createNewColumn.php');">Create A New Column</button>
        <button type="button"onclick="goTo('app/main/manage/changeColumn.php');">Change A Column</button>
        <button type="button"onclick="goTo('app/main/manage/deleteColumn.php');">Delete Column</button>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
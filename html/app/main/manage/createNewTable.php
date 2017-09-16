<?PHP
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    $content = <<< 'EOT'
        <button type="button"onclick="goTo('app/main/manage/main.php');">Back</button><br>
        <form method="post"action="/inc/php/manageDBsrc.php">
            <h3>Izveidot jaunu tabulu.</h3>
            Jauna tabula automātiski satur kolonnu ar šādiem parametriem:<br>
            "index INT UNSIGNED AUTO_INCREMENT PRIMARY KEY"<br>
            Jaunas tabulas nosaukums:<input type="text"name="newTableName"><br>
            <input type="submit"name="createTable"value="Create Table"onclick="return confirm('Are you sure you want to create new table?')">
        </form>
    </body>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
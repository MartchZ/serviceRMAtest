<?PHP
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    $content = <<< EOT
        <button type="button" onclick="goTo('app/main/manage/main.php');">Back</button><br>
        <form method="post" action="/inc/php/manageDBsrc.php">
            <input type="text"name="selectedDBName"placeholder="DB name"><input type="submit"name="deleteDB"onclick="return confirm('Are you sure you want to delete the DB?')"value="Delete DB">
        </form>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
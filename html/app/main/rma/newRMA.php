<?PHP
    include '../../../inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    $content = <<< EOT
        <form action="../../../inc/php/handleFormInput.php" method="post">
            Statuss: <select name="status">
                <option value=""></option>
                <option value="registered">pieņemts</option>
                <option value="sendToService">vest uz servisu</option>
                <option value="sentToService">aizvests uz servisu</option>
                <option value="testing">testējas/gaida detaļas</option>
                <option value="ready">gatavs</option>
                <option value="closed">izpildīts</option>
            </select><br>
            Kontaktpersona: <input type="text" name="contact"><br>
            Firma: <input type="text" name="company"><br>
            Preces nosaukums: <input type="text" name="item"><br>
            S/N: <input type="text" name="serialNumber"><br>
            <input type="submit" name="submitFormInsert" value="Saglabāt" onclick="return confirm('Vai tiešām vēlaties saglabāt RMA ierakstu?')">
        </form>
EOT;
    $page->setContent($content);
    
    $site->render();
?>
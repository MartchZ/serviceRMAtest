<?PHP
    include 'inc/php/stdlib.php';
    
    $site = new csite();
    
    initialise_site($site);
    
    $page = new cpage("Main");
    $site->setPage($page);
    
    $content = "";
    
    $page->setContent($content);
    
    $site->render();
?>
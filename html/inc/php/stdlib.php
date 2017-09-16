<?PHP
    spl_autoload_register(function ($class)
    {
        include"$class.php";
    });
    
    function initialise_site(csite $site)
    {
        $site->addHeader("header.php");
        $site->addFooter("footer.php");
    }
?>
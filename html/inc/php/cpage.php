<?PHP
    class cpage
    {
        private $title;
        private $content;
        
        public function __construct($title)
        {
            $this->title = $title;
        }
        
        public function __destruct()
        {
            
        }
        
        public function render()
        {
            echo "\n".$this->content."\n";
        }
        
        public function setContent($content)
        {
            $this->content = $content;
        }
    }
?>
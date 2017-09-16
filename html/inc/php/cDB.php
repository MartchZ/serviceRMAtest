<?PHP
    class cDB
    {
        private $servername;
        private $username;
        private $password;
        private $DBname;
        
        public function __construct()
        {
            include ("/var/www/html/inc/config/config.php");
            $this->servername = $config['DB']['servername'];
            $this->username = $config['DB']['username'];
            $this->password = $config['DB']['password'];
            $this->DBname = $config['DB']['DBname'];
        }
        
        public function connect($DB = "serviceDB")
        {
            $connection = new mysqli($this->servername,$this->username,$this->password,$DB) or exit("Connection failed: ".$connection->connect_error);
            return $connection;
        }
        
        public function executeQuery($sqlQuery)
        {
            $connection = $this->connect();
            $result = $connection->query($sqlQuery) or exit("Failed to execute the query: ".$connection->error);
            $connection->close();
            return $result;
        }
    }
    
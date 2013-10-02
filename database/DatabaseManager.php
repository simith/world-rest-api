<?php


 
class DatabaseManager{


     private	$ip; 
     private    $port; 

     private    $username;
     private    $pass;



     public function __construct() {
     
       $this->ip = getenv('OPENSHIFT_MONGODB_DB_HOST');
       $this->port = getenv('OPENSHIFT_MONGODB_DB_PORT');
       $this->username = "admin";
       $this->pass = "*****insert_your_database_password_here****";
           
     }

     public function getConnection(){

	   $connection = new MongoClient("mongodb://".$this->username.":".$this->pass."@".$this->ip.":".$this->port."");
           return $connection;
		
     }
}


?>

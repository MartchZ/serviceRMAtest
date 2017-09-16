<?php
	//All the stuff in here can be used throughout the project by including this file.
	$config=array(
		"DB"=>array(
		    "servername"=>"localhost",
            "username"=>"root",
            "password"=>"passionviperport",
            "DBname"=>"serviceDB"
        ),
        "mainTable"=>"test_RMA_main"
    );
    //Report all errors.
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
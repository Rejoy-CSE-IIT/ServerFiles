<?php

    session_start();
    //Remember require expands here
     require(__DIR__ . "/../vendor/autoload.php");
     $whoops = new \Whoops\Run;
     $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
     $whoops->register();

     $GLOBALS['config'] =array(
                                            'mysql'=>array
                                                        (
                                                            'host'=> '127.0.0.1',                                    
                                                            'username' =>'root',
                                                            'password' =>'',
                                                            'dbname' =>'android_veg'
                                                        )
                                            ,
                                            'remember'=>array
                                                        (
                                                            'cookie_name'=>'hash',
                                                            'cookie_expiry'=>604800,
                                                        )
                                            ,
                                            'session'=>array
                                                        (
                                                            'session_name'=>'user'
                                                        )
                                );

         // document
         spl_autoload_register(function($class)
                                {
                                        
                                    require_once 'aa_classes/'.$class.'.php';
                                }
          );


  ///Document for require once
//http://stackoverflow.com/questions/2418473/difference-between-require-include-and-require-once
//https://www.youtube.com/watch?v=Ttgy0pIRiVQ

          //This is a function so we cant use classes header_remove


        
        
          require_once 'ac_functions/aa_sanitize.php';





 

?>
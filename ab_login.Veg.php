<?php

//echo "Hai";
 
 
   $email = $_POST["email"];
   $pass = $_POST["password"];

    // $email ="a@a.com";
    // $pass = "111111";
     require_once 'ab_core/aa_init.php';

     



    $return_obj= ac_DB::getInstance()->query("SELECT username,id,user_mode FROM ab_users WHERE email=? AND password=?",array($email,$pass));
    
    if(!$return_obj->Count())
    {
         
        $response = array();
	    $response["status"] = "false";
        $response["name"] ="error"; 
        $response["email"] = "error";  
        $response["Id"]  =-100;
        $response["user_mode"]  ="error";    
		echo json_encode($response); 
        //echo "First";

         
    }
    else
    {

    
        $first_row =  $return_obj->first();
        $response = array();
	    $response["status"] = "true";
        $response["name"]   = $first_row->username; 
        $response["email"]  = $email; 
        $response["Id"]  = $first_row->id; 
        $response["user_mode"]  =$first_row->user_mode;     
	    echo json_encode($response); 
       // echo "second";


    }
     ac_DB::destroyInstance(); 
  

?>
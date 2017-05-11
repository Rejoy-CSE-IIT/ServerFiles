<?php

 
   
/* 
     $postid = intval($_POST["postid"]);
     $userid = intval($_POST["userid"]);*/
   
    // $postid =6;
    /// $userid = 1;

 
  $postid = intval($_POST["postid"]);
   //  $userid = intval($_POST["userid"]);  
    
 
 
     require_once '../ab_core/aa_init.php';
   

        ac_DB::getInstance()->update('aa_plantform1',$postid,array(
'approval'=>1
));

          
  
 
 
       

 
                $response = array();
                $response["status"] = "true";
          
                echo json_encode($response); 


           

   
     ac_DB::destroyInstance();
 

?>
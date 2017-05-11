

<?php

 
   
 
    $postid =$_POST["postid"];
   
   // $postid = 28;
    
 
 
    require_once '../ab_core/aa_init.php';

    $return_obj= ac_DB::getInstance()->delete('aa_vegform',array('id','=',$postid));
  

          

          

                $response = array();
                $response["status"] = "true";
                echo json_encode($response);


           

   
     ac_DB::destroyInstance();
 

?>
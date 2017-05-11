

<?php

 
   
 
     $postid =$_POST["postid"];
     $currentRating = intval($_POST["currentRating"]);
   
     // $postid = 19;
      //$currentRating = 20;
    
 
 
    require_once '../ab_core/aa_init.php';

     $return_obj= ac_DB::getInstance()->query("SELECT avgRating FROM aa_plantform1 WHERE id=?",array($postid));
 
       $first_row =  $return_obj->first();

 
         $new_avg = ( $first_row->avgRating+$currentRating)/2;
          
       ac_DB::getInstance()->update('aa_plantform1',$postid,array(
'avgRating'=> $new_avg
)); 

     

          

          

                $response = array();
                $response["status"] = "true";
                echo json_encode($response);


           

   
     ac_DB::destroyInstance();
 

?>
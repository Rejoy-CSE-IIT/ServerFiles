<?php

 
 
   
    $organization  = $_POST["organization"];
    $price         = floatval($_POST["price"]);
    $category      = $_POST["category"];
    $details       = $_POST["details"];
    $userid        = intval($_POST["id"]);
    $image         = $_POST["image"] ;
    $place         = $_POST["place"] ;  
    $mobno         =  intval($_POST["mobno"]) ; 
    $contacts      =  $_POST["contacts"] ;  

/*
  $organization    =   "argo";
    $price         =   floatval( "123");
    $category      =  "vegetables";
    $details       =  "details";
    $userid        =  intval("345");
    $image         =  "sfsfdsfdsfdsf";
    $place         =  "bathery" ;
     */
 
   // require_once 'ab_core/aa_init.php';
    require_once '../ab_core/aa_init.php';
   
/*
             'image'=>$image,
             'place'=>$place
*/
  

            $return_obj = ac_DB::getInstance()->insert('aa_trainform',
            array(
            'organization'=>$organization,
            'price'=>$price,
            'category' =>$category,
            'details'=>$details ,
             'userid'  =>$userid,
             'image'=>$image,
             'place'=>$place,
             'mobno'=>$mobno,
             'contacts'=>$contacts


            )); 
 
          

                $response = array();
                $response["status"] = "true";
                echo json_encode($response);


           

   
     ac_DB::destroyInstance();
 

?>
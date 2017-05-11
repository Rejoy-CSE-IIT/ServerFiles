<?php

 
 
 
 
    require_once '../ab_core/aa_init.php';
     $response               = array();
 
   

 
 
      $return_obj= ac_DB::getInstance()->query("SELECT id,organization,price,category,details,userid,image,mobno,place,contacts,approval,avgRating FROM aa_renewalform",array());
      

  
     // $response_test          = array();
     

    if($return_obj->Count())
    {
         
              $J=0;
              $I = 0;
              foreach ($return_obj->results() as $result) 
              {
                  
                    $index = (string)$I;

                    $response["organization".$index]  =  $result->organization; 
                    $response["id".$index]            =  $result->id;
                    $response["mobno".$index]         =  $result->mobno; 
                    $response["price".$index]         =  $result->price; 
                    $response["category".$index]      =  $result->category;    
                    $response["details".$index]       =  $result->details; 
                    $response["userid".$index]        =  $result->userid; 
                    $response["image".$index]         =  $result->image;  
                    $response["place".$index]         =  $result->place; 
                    $response["contacts".$index]      =  $result->contacts; 
                    $response["approval".$index]      =  $result->approval; 
                    $response["rating".$index]      =  $result->avgRating;

            /*        
                    $response_test["organization"]  =  $result->organization; 
                    $response_test["id"]            = $result->id;
                    $response_test["mobno"]         =  $result->mobno; 
                    $response_test["price"]         = $result->price; 
                    $response_test["category"]      =  $result->category;    
                    $response_test["details"]       =  $result->details; 
                    $response_test["userid"]        =  $result->userid; 
                    $response_test["image"]         =  $result->image;  
                    $response_test["place"]         =  $result->place; 
                    $response_test["contacts"]      =  $result->contacts; 
                    $response_test["approval"]      =  $result->approval; */


                   // echo json_encode($response_test); 
                    //echo "##############<br>";
                    $I++;
              }  

              $response["status"]     = "true";
  
          
       }
       else
       {
             $response["status"]     = "false";       
       }
    


     $response["count"] = $return_obj->Count();

 
     echo json_encode($response); 
    
     ac_DB::destroyInstance();
 
 
 

?>
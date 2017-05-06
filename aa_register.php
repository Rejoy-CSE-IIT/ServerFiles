<?php


    $username  =  $_POST["name"];
    $email     =  $_POST["email"];
    $password  =  $_POST["password"]; 
    $mobno     =  intval($_POST["mobno"]) ; 
    $place     =  $_POST["place"] ; 
    $user_mode =  $_POST["user_mode"] ;  

    
  /*
    $username = "mathew";
    $email ="johns@gmaild.com";
    $password = "helloword"; 
    $mobno =  89765 ; 
    $place =  "mananthavady" ; 
    $user_mode = "vendor";  */

 
    require_once 'ab_core/aa_init.php';
    $return_obj= ac_DB::getInstance()->query("SELECT email,username FROM ab_users WHERE email=? or mobno=?",array($email,$mobno));
 

     if(!$return_obj->Count())
     {
/*           
            foreach ($return_obj->results() as $result) 
            {
                echo $result->username."<br>";
                echo $result->email."<br>";
                echo "<br>###########################################<br>";
        
            }
*/

            $return_obj = ac_DB::getInstance()->insert('ab_users',
            array(
            'username'=>$username,
            'password'=>$password,
            'place'=>$place,
             'email'  =>$email,
             'mobno'=>$mobno,
             'user_mode'=>$user_mode
            )); 


            $response = array();
            $response["status"] = "true";
            echo json_encode($response); 

             // echo "no user found but Table is correct";
     }
     else
     {
              // echo "user found  Table is correct";

                $response = array();
                $response["status"] = "false";
                
                echo json_encode($response);
     }    

     

/*

    $return_obj= ac_DB::getInstance()->query("SELECT username FROM ab_users WHERE email=? AND password=?",array($email,$pass));
     
    if(!$return_obj->Count())
    {
        $response = array();
	    $response["status"] = "false";
        $response["name"] ="error"; 
        $response["email"] = "error";   
		echo json_encode($response);

         
    }
    else
    {
     
        $first_row =  $return_obj->first();
        $response = array();
	    $response["status"] = "true";
        $response["name"] =$first_row->username; 
        $response["email"] = $email;   
	    echo json_encode($response); 


    }*/
     ac_DB::destroyInstance();
 

?>
<?php

//"PDO - PHP Data Objects ,_ means private
class ac_DB
{

     //stores instance of the database if it is available
     private static $_instance =null;

     private $_pdo,
             $_query,
             $_error = false,
             $_results,
             $_count =0;

/*
Example format for PDO
<?php
 
$dsn = 'mysql:dbname=testdb;host=127.0.0.1';
$user = 'dbuser';
$password = 'dbpass';

try {
    $dbh = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

?>
*/
             private function __construct()
             {

            
                 try
                 {
                        $dsn = 'mysql:host='.aa_config::get('mysql/host').';dbname='.aa_config::get('mysql/dbname');
                       // $dsn = 'mysql:host='.aa_config::get('mysql/host').';dbname='.aa_config::get('mysql/db').'';
                        $user = aa_config::get('mysql/username');
                         $password = aa_config::get('mysql/password');               
                        $this->_pdo= new PDO($dsn, $user, $password);
                 }
                 catch(PDOException $e)
                 {
                    die($e->getMessage());

                 }  
                // echo "Connection successful<br>";
             }

/*
se $this to refer to the current object. Use self to refer to the current class.
 In other words, use  $this->member for non-static members, use self::$member for static members.
*/
             public static function getInstance()
             {
                  
                        if(!isset(self::$_instance))
                        {
                              self::$_instance = new ac_DB();   
                        }
                        
                    
                              return  self::$_instance;
                         

                     //   echo "Inside getinstance<br>";

             }

             public static function destroyInstance()
             {
                  
                        if(isset(self::$_instance))
                        {
                             self::$_instance=null;  
                        }
         
             }
             
             
             public function query($sql,$params=array())
             {
 
                  //Multiple query precaution
                 $this->_error = false;
 
              
                 //An assignment expression has the value of the left operand after the assignment
                 //Remember query is null before.If no assignment happens then query will return null
                 //if($this->_query=$this->_pdo->prepare($sql))
                 if($this->_query=$this->_pdo->prepare($sql))
                 {
                      //Check the old code and figure out how we put from where in query with string name attached 
                      //or embedded in string
                      /*
                          $email = $_POST["email"];
                          $pass = $_POST["password"];
                          require "02_init.php";
                          $query = "select * from userinfo where email like '".$email."' and password like '".$pass."';";
                      */
 
 
                        $x =1;
                        if(count($params))
                        {
                             foreach ($params as $param) 
                            {
                                   $this->_query->bindValue($x,$param);
                                 //  echo "<br> x ::".$x;
                                  $x++;
                                 
                            }

                          // echo " Non Empty parameter but valid query<br>";
                       } 
                       else
                       {
                            //  echo " Empty parameter but valid query<br>";
                       }
                 

                         //PDO::query() executes an SQL statement in a single function call,
                         // returning the result set (if any) returned by the statement as a PDOStatement object.
 
                       if($this->_query->execute())
                       {
                            
                            
                           $this->_results =$this->_query->fetchAll(PDO::FETCH_OBJ);
                           
                           $this->_count =$this->_query->rowCount(); 
                             //   var_dump( $this->_results);
                             //    echo "Success Finishing query function<br>";
                          
                       }
                       else
                       {
                             $this->_error = true;
                          //   die("no table found or query wrong-- not absent value");
                       } 
                      
                     
                 }  
                 else
                 {
                     // die( "No Assigned prepared query else null <br>");
                 }
 
                 return $this;

                

             }


             public function error()
             {


                 return   $this->_error;
             }

             public function action($action,$table,$where=array())
             {

                  
                   if(count($where)==3)
                   {
                       $operators = array("=",'>','<','>=','<=');
                       $field = $where[0];
                       $operator = $where[1];
                       $value = $where[2];

                       if(in_array($operator,$operators))
                       {
                           
                               $sql = "{$action} FROM {$table} WHERE {$field}  {$operator} ?";


                               if(!$this->query($sql,array($value)) ->error())
                               {
                                   return $this;
                               } 

                                echo "<br>valid operator<br>";

                       }
                       else
                       {
                           echo "<br>invalid operator<br>";
                       }

                   } 

                   return false;

             }

             public function get($table,$where)
             {
                       echo "Get function";
                      return $this->action('SELECT *',$table,$where);
             }
             //Just using action method
             public function delete($table,$where)
             {
                                 //  echo "Delete  function";
                         return $this->action('DELETE',$table,$where);
             }
            //Count the number of rows
            public function Count()
             {
                         return $this->_count;
             }

             public function results()
             {
                 return $this->_results; 
             }


             public function first()
             {
                 return $this->results()[0]; 
             }
            /*
            $sql = $db->prepare("INSERT INTO db_fruit (id, type, colour) VALUES (? ,? ,?)");
            $sql->bindParam(1, $newId);
            $sql->bindParam(2, $name);
            $sql->bindParam(3, $colour);
            $sql->execute();
            */

            public function insert($table,$fields=array())
            {
                   if(count($fields))
                   {
                       $keys = array_keys($fields);
                       $values = null;
                       $x=1;

                        foreach ($fields as $field) 
                        {
                           $values.='?';

                           if($x<count($fields))
                           {
                               $values.=', ';

                           }
                            $x++;
                        }

                       $sql = "INSERT INTO  {$table} (`".implode('`,`',$keys)."`) VALUES ({$values})";
 // die( $sql);
                        if(!$this->query($sql,$fields ) ->error())
                        {
                            return true;
                        }  

                      
                   }

                   return false;
            }

/*

UPDATE Customers
SET ContactName='Alfred Schmidt', City='Frankfurt'
WHERE CustomerID=1;
*/

             public function update($table,$id,$fields=array())
             {

                 $set ='';
                 $x=1;

                 foreach ($fields as $name => $value) 
                 {
                           $set.="{$name} = ?";

                           if($x<count($fields))
                           {
                               $set.=',';

                           }
                            $x++;
                 }
                     

                        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
                          
                      //  var_dump( $fields);
                      //  die($sql);
                        if(!$this->query($sql,$fields)->error())
                        {
                                   return true;
                        }  

                       
                    

                   return false;
            }
            
            

}


?>
<?php

    class aj_validate
    {

          private $_password = false,
                  $_errors   = array(),
                  $_db       =null;

          public function __construct()
          {
            $this->_db =ac_DB::getInstance();
          }        

          public function check($source,$items=array())
          {
                    foreach($items as $item =>$rules)
                    {
                        foreach($rules as $rule =>$rule_value)
                        {
                                 $value = $source[$item];
                                 echo $value;

                                 
                                if($rule === 'required' && empty($value))
                                {
                                        $this->addError("  is required");
                                }               


                       }

                    } 
                
                    
                    // return inside empty not allowed
                    if(empty($this->_errors))
                    {
                        $this->_passed=true;
                    } 

                    return $this;

          }

          public function addError($error)
          {
             // $this->_errors[]=$error;
          }
 

         public function errors()
          {
              $this->_errors;
          }

           public function passed()
          {
              $this->_passed;
          }



    }

  ?>
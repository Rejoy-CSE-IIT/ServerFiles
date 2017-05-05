<?php
      //Converting characters into entities are often used to prevent browsers from using it as an HTML element. 
      //This can be especially useful to prevent code from running when users have access to display input on your
      // homepage
      //Reference http://www.w3schools.com/php/func_string_htmlentities.asp
      //Ref :: http://php.net/manual/en/function.htmlspecialchars.php
      function escape($string)
      {
          return htmlentities($string,ENT_QUOTES,'UTF-8');
      }

?>


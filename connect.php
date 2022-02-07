<?php
         error_reporting(E_ALL & ~E_NOTICE); 
         $username = filter_input(INPUT_POST, 'userid');  
         $password = filter_input(INPUT_POST, 'password');        
         
         $servername = "localhost";
         $username1 = "root";
         $serverpassword = "";
         $DB_name = "manthan";

         $conn = mysqli_connect($servername,$username1,$serverpassword,$DB_name);
         if(!$conn)
         {
             die("Connection failed ");
         }                    
         
         $sql = "SELECT * FROM verification where password='$password' && userid ='$username'";
              
        
         $result=mysqli_query($conn,$sql);
         if(mysqli_num_rows($result)==1)
         {
            echo "<h1>I am not a robot</h1> <br/> <button type='button'> <a href='main.php'>Click here</a></button>";
         }
         else
         {         
               echo "<h1>Incorrect password!</h1> <br/> <a href='index.html'>Back</a>";            
         }

        
     ?>

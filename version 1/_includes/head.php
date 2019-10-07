   <html>
   <title>Your name</title>
   <body>
   <center>Welcome to the coolest page ever</center>
   <br>
   <?php if(isset($_GET['name'])) { $response = "Hi, ".$_GET['name']."! How are you?"; 
   echo $response;}
   ?>
   <br>
   <u>This is the footer</u>
   </body></html>
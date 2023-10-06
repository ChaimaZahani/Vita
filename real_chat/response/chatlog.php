<?php 
     define('ROOT_URL','http://localhost/Blog/');
     $host="localhost";
     $base="blog";
     $user="root";
     $pass="";
     try{
       $pdo= new PDO("mysql:host=$host;dbname=$base" ,$user,$pass);
       // set the PDO error mode to exception
       $pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       }
       catch(PDOException $except){
       echo"Echec de la connexion: ". $except->getMessage();
       die();
       }
?>
<?php 
 

 $dt     = new DateTime('now', new DateTimezone('Africa/Tunis'));
 $date   = $dt->format('F j, Y');
 $tm     = new DateTime('now', new DateTimezone('Africa/Tunis'));
 $time   = $tm->format('g:i a');

 $msg      = str_replace("'", "", $_POST['message']);
 $receiver = $_POST['receive']; //incoming msg id
 $sender   = $_POST['send']; //outgoing msg id

 $sql = "INSERT INTO 
    tbl_message(
     incoming_msg_id, 
     outgoing_msg_id, 
     text_message, 
     curr_date, 
     curr_time
     )VALUES(
    '$receiver', 
    '$sender', 
    '$msg', 
    '$date ',
    '$time'
    )";
   $res=$pdo->exec($sql);
   
   if($res){
   //echo "Message Sent!";
  }else{
  echo "Message sending failed!";
 }
?>
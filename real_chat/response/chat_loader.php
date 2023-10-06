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
    $receiver = $_GET['receive'];
    $sender   = $_GET['send'];
    $sql = "SELECT *FROM tbl_message LEFT JOIN user ON user.id = tbl_message.outgoing_msg_id 
    WHERE incoming_msg_id='$receiver' AND outgoing_msg_id='$sender' || outgoing_msg_id='$receiver' AND 
    incoming_msg_id='$sender' ORDER BY msg_id ASC";
    $results = $pdo->query($sql);
    if ($results->rowCount() > 0){
       $res=$results->fetchAll(PDO::FETCH_ASSOC);
    }
    else($res=null);
    
    if($res){
    foreach($res as $msg){ 
    if($receiver == $msg['id']){
    ?>
    <div class="item-group-you d-flex">
        <img src="<?=ROOT_URL .'images/'.$msg['avatar']?>">
        <div class="text-message-you">
        <?php echo $msg['text_message']; ?>
        </div>
        <p class="time-track-you">
        <?php echo $msg['curr_date'] . $msg['curr_time'] ; ?>
        </p>
    </div>
    <?php }else{ ?>

    <div class="item-group-other d-flex">
        <img src="<?=ROOT_URL .'images/'. $msg['avatar']; ?>">
        <div class="text-message-other">
        <?php echo $msg['text_message']; ?>
        </div>
        <p class="time-track-other">
        <?php echo $msg['curr_date'] . $msg['curr_time'] ; ?>
        </p>
    </div> 

    <?php } ?>
    <?php } }
    else{
        echo "No message";
    } ?>
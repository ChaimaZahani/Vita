<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
$mail=new PHPMailer(true);
?>

<section class="empty__page">
    <h1>Contact Page</h1>
</section>
<section>       
<div class="container form__section-container">
        <h2>Contact Blogger</h2>
        <form action="index.php" method="POST">
            <input type="mail" name="mail" placeholder="mail"></input>
            
            <input type="text" name="titreMail" placeholder="objet de mail"></input>
                <textarea name="message" id="" cols="30" rows="10" placeholder="message"></textarea>
                <button type="submit" name="send" class="btn">Send to Blogger</button>
       </form>
</div> 
</section>


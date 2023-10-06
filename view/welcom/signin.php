<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Blog Application</title>
    <!--custom stylesheet-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Iconscout Cdn-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!--Gogle Font(MONTSERRAT) -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
</head>
<body>

<section class="form__section">
    <div class="container form__section-container">
        <h2> Sign In</h2>
        
            <?php if(isset($_SESSION["signup-success"])):?>
               <div class="alert__message success">
           <p><?=$_SESSION["signup-success"];
                     unset($_SESSION["signup-success"]); ?></p>
            </div>
            <?php elseif (isset($_SESSION["signin"])):?>
                <div class="alert__message error">
           <p><?=$_SESSION["signin"];
                     unset($_SESSION["signin"]); ?></p>
            </div>
            <?php endif?>
            <form action="index.php?controller=welcome&action=signin" method="POST">
                <input type="text" name="username_email" value="<?=$username_email?>"  placeholder="Username or Email">
                <input type="password"name="password" value="<?=$password?>"   placeholder="Password">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have account? <a href="index.php?controller=welcome&action=log_up">Sign Up</a></small>
            </form>

    </div>
</section>

    <div class="wrapper">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		<span></span>
</div>

<style>
    body{
    background-image: linear-gradient(to top,#BF7EA8,#D9BBB0);
    height: 100vh;    
}
.wrapper span{
    position: fixed;
    bottom: -50px;
    height: 50px;
    width: 50px;
    border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
    background-color: black;/*couleur feuilles*/
    animation: animate 10s linear infinite;
}
.wrapper span:nth-child(1){
    left: 0;
    animation-delay: 0.6s;    
}
.wrapper span:nth-child(2){
    left: 10%;
    animation-delay: 3s;    
}
.wrapper span:nth-child(3){
    left: 20%;
    animation-delay: 2s;    
}
.wrapper span:nth-child(4){
    left: 30%;
    animation-delay: 5s;    
}
.wrapper span:nth-child(5){
    left: 40%;
    animation-delay: 1s;    
}
.wrapper span:nth-child(6){
    left: 50%;
    animation-delay: 7s;    
}
.wrapper span:nth-child(7){
    left: 60%;
    animation-delay: 6s;    
}
.wrapper span:nth-child(8){
    left: 70%;
    animation-delay: 8s;    
}
.wrapper span:nth-child(9){
    left: 80%;
    animation-delay: 6s;    
}
.wrapper span:nth-child(10){
    left: 90%;
    animation-delay: 4s;    
}

.banner{
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.content h2{
    -webkit-text-fill-color: white;
    -webkit-text-stroke-width: 1px;
    -webkit-text-stroke-color: white;
    font-family: montserrat;
    font-size: 80px;
}
.content h2 b{
    -webkit-text-fill-color: transparent;
}

@keyframes animate{
    0%{
        bottom: 0;
        margin-left: 90px;
        margin-right: 0;
        opacity: 1;
    }
    20%{
        bottom: 20%;
        margin-left: 0;
        margin-right: 90px;
        opacity: 0.8;
    }
    40%{
        bottom: 40%;
        margin-left: 90px;
        margin-right: 0;
        opacity: 0.6;
    }
    60%{
        bottom: 60%;
        margin-left: 0;
        margin-right: 90px;
        opacity: 0.4;
    }
    80%{
        bottom: 80%;
        margin-left: 90px;
        margin-right: 0;
        opacity: 0.2;
    }
    100%{
        bottom: 100%;
        margin-left: 0;
        margin-right: 90px;
        opacity: 0;
    }
}

</style>
</body>
</html>
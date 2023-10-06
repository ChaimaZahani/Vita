<?php
require_once ('model/modelUser.php'); // chargement du modèle
    class WelcomeController{
        public static function signin(){
            session_start();
            require('config/databases.php');
            
            
            if(isset($_POST['submit'])){
                //get form data
                $username_email =filter_var($_POST['username_email'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password =filter_var($_POST['password'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                if(!$username_email){
                    $_SESSION['signin'] = "Username or Email required";
                }elseif(!$password){
                    $_SESSION['signin'] = "Password required";
                }else {
                    // fetch user from database
                    $fetch_user_result=ModelUser::getusername($username_email);

                    if($fetch_user_result->rowCount()==1){
                        // convert the record into  assoc array
                        $user_record = ModelUser::getbyusername($username_email);
                        $db_password = $user_record['password'];
                        // compare form password with database password
                        if(password_verify($password,$db_password)){
                            // set session for access control 
                            $_SESSION['user-id'] = $user_record['id'];
                            // set session if user is an admin
                            if($user_record['is_admin']==1){
                                $_SESSION['user_is_admin'] = true;
                            }
                            //echo var_dump($_SESSION['user-id']) ;
                            //echo var_dump($user_record['id']) ;
                            // log user in 
                            header('location:admin/index.php');
                        } else{
                            $_SESSION['signin'] = "Please check your input";
                        }
                    }        
                    else{
                        $_SESSION['signin'] = "User not found";
                    }
                }
                //if any problem , redirect back to signin page with login data
                if(isset($_SESSION['signin'])){
                    $_SESSION['signin-data'] =$_POST;
                    require("view/welcom/signin.php");
                    exit();
                }
            }else{
                //if button wasn't clicked , bounce back to signup page
                require("view/welcom/signin.php");
                die();
            }
           
    }

        public static function signup(){
            session_start();
            require('config/databases.php');
            // get signup form data if signup button was clicked 
            if(isset($_POST['submit'])){
                $firstname = filter_var($_POST['firstname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $lastname = filter_var($_POST['lastname'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $username = filter_var($_POST['username'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_var($_POST['email'],FILTER_VALIDATE_EMAIL);
                $createpassword = filter_var($_POST['createpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $confirmpassword = filter_var($_POST['confirmpassword'],FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $avatar =$_FILES['avatar'];
                //echo $firstname,$lastname,$username,$email,$createpassword,$confirmpassword,$avatar;

                //validate input values
                if(!$firstname){
                    $_SESSION['signup']="Please enter your First Name";
                }elseif(!$lastname){
                    $_SESSION['signup']="Please enter your Laste Name";
                }elseif(!$username){
                    $_SESSION['signup']="Please enter your Username";
                }elseif(!$email){
                    $_SESSION['signup']="Please enter your a valid email";
                }elseif(strlen($createpassword)<8 || strlen($confirmpassword)<8 ){
                    $_SESSION['signup']="Password should be 8+ characters";
                }elseif(!$avatar['name']){
                    $_SESSION['signup']="Please add avatar";
                }
                else{
                    // check if passwords don't match
                    if($createpassword !== $confirmpassword){
                        $_SESSION['signup']="Passwords do not match!";
                    }
                    else{
                        //hash password
                        $hashed_password = password_hash($createpassword,PASSWORD_DEFAULT);
                        //echo $createpassword .'<br/>';
                        //echo $hashed_password;
                        // check if username or email already exist in database
                        $user_check_result =ModelUser::getusername($username,$email);
                        if($user_check_result->rowCount() >0){
                            $_SESSION['signup'] = "Username or Email already exist" ;

                        }else{
                            //WORK ON AVATAR
                            //rename avatar
                            $time = time(); // make each image name unique usign timestamp
                            $avatar_name = $time.$avatar['name'];
                            $avatar_tmp_name =$avatar['tmp_name'];//upload image
                            $avatar_destination_path = "images/".$avatar_name;

                            //make sure file is an image 
                            $allowed_files = ['png' ,'jpg','jpeg'];
                            $extention = explode('.',$avatar_name);
                            $extention = end($extention);
                            if(in_array($extention,$allowed_files)){
                                //make sure image is not too large(1mb+) 
                                if($avatar['size']<1000000){
                                //upload avtar
                                move_uploaded_file($avatar_tmp_name,$avatar_destination_path);
                                }
                                else{
                                $_SESSION['signup'] ='File size too big';
                                }
                            }else{
                                $_SESSION['signup'] ='File should be png,jpg or jpeg ';
                            }
                        }
                    }
                }
            // redirect back to signup pag  if they was any problem 
            if (isset($_SESSION['signup'])){
                // pass form data back to signup page
                $_SESSION['signup-data'] =$_POST;
                require("view/welcom/signup.php");

                die();
            }  
            else{
                try{
                // insert new user int user table
                $user=new ModelUser($firstname,$lastname,$username,$email,$hashed_password,$avatar_name,0);
                $user->save();
                // redirect to login page with success message
                $_SESSION['signup-success']= 'Registration successful Please Login';
                
            $username_email=$_SESSION['signin-data']['username_email'] ?? null;
            $password = $_SESSION['signin-data']['password'] ??null;
            unset($_SESSION['signin-data']);
            require ('view/welcom/signin.php');
            exit();
                
            }

            catch(PDOException $except) {
                echo"Echec  ". $except->getMessage();
                die();
                }
            }

            }  

            else {
                //if button wasn't clicked , bounce back to signup page
                require("view/welcom/signup.php");
                die();
            }   

                    }
        
        
        public static function log_in(){
            session_start();
            require('config/databases.php');
            $username_email=$_SESSION['signin-data']['username_email'] ?? null;
            $password = $_SESSION['signin-data']['password'] ??null;
            unset($_SESSION['signin-data']);
            require ('view/welcom/signin.php'); //redirige vers la vue
            exit();

        }

        public static function log_up(){
            session_start();
            require('config/databases.php');
            // get back form data if there was a registration error
            $firstname = $_SESSION['signup-data']['firstname'] ?? null;
            $lastname = $_SESSION['signup-data']['lastname'] ?? null;
            $username = $_SESSION['signup-data']['username'] ?? null;
            $email = $_SESSION['signup-data']['email']?? null;
            $createpassword = $_SESSION['signup-data']['createpassword']?? null;
            $confirmpassword = $_SESSION['signup-data']['confirmpassword']?? null;
            // delete signup data session 
            unset($_SESSION['signup-data']);
            require ('view/welcom/signup.php');
            exit();
        }

        public static function logout(){
            session_start();
            require('config/constants.php');
            session_destroy();
            header('Location:index.php');
            exit();
        }

       
    }
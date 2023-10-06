<?php
require_once ('model/modelUser.php'); // chargement du modèle
require_once ('model/modelCategorie.php');
require_once ('model/modelCommentaire.php');
require_once ('model/modelLikes.php');
require_once ('model/modelPosts.php'); 
    class findController{


        public static function search(){
            require_once("partiel/header.php");
            if(isset($_GET['search']) && isset($_GET['find'])) {
                $search = filter_var($_GET['search'],FILTER_SANITIZE_SPECIAL_CHARS);
                $posts=ModelPosts::search($search);
               
            }else {
                //a terminer
               //header('location :'.ROOT_URL.'blog.php');
               
            }
            if($posts->rowCount()>0){
                require_once("view/search/search.php");
                while($post = $posts->fetch(PDO::FETCH_ASSOC) ){
                    $id=$post['category_id'];
                    $category=ModelCategorie::getbyid($id);
                    $id=$post['author_id'];
                    $author=ModelUser::getbyid($id);
                    require("view/search/search1.php"); 
                }
                require_once("view/search/search2.php"); 
            }
            else {
                
                require_once("view/search/search3.php"); 
            }
            $all_categories=ModelCategorie::getCategorie();
            require_once("partiel/footer.php");
        }

        public static function post(){
            require_once("partiel/header.php");
            if(isset($_GET['id'])){
                $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
                $post=ModelPosts::getbyid($id);
                $view=$post['vues']+1;
                $result_view = ModelPosts::update_view($view,$id);
                $_SESSION['blog-id']=$id;
               }
               else{
                //a terminer
                //header('location:'.ROOT_URL.'blog.php');
                 //die();
             }
             $id_author=$post['author_id'] ;
             $author=ModelUser::getbyid($id_author);
             $all_comments=ModelCommentaire::getvalid($id);

             require_once("view/post/post.php");
             require_once("partiel/footer.php");
        }
        public static function categorie(){
            include('partiel/header.php');
            // fetch post from database if id is set
            if(isset($_GET['id'])){
            $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);
            $posts =ModelPosts::getby_category_id($id);
            
            }
            else{
            //header('location:'.ROOT_URL.'blog.php');
            //die();
        }
        $category=ModelCategorie::getbyid($id);
        require("view/post/category-posts.php");
        if($posts->rowCount()>0){
            require("view/post/category-posts4.php");
            while($post =$posts->fetch(PDO::FETCH_ASSOC) ){
                $author_id = $post['author_id'] ;
                $author=ModelUser::getbyid($author_id);
                require("view/post/category-posts1.php");

            }
        $all_categories=ModelCategorie::getCategorie();
        require("view/post/category-posts2.php");
        }
        else {
            require("view/post/category-posts3.php");
        }
        require("partiel/footer.php");

        }
        public static function like(){
            session_start();
            require('config/databases.php');
            // get  form data if submit button was clicked 
            if(isset($_GET['id'])){
                if ($_SESSION['user-id']) {
                    
                    $result=ModelLikes::getbymembre((int)$_GET['id'],(int)$_SESSION['user-id']);

                    if ($result!=false) {
                        ModelLikes::deletebymember((int)$_GET['id'],(int)$_SESSION['user-id']);

                    }
                    else {
                        $article=new ModelLikes((int)$_GET['id'],(int)$_SESSION['user-id']); 
                    $result=$article->insert();
                    }
                    header('location:index.php');
                    die();
                }else {
                    //header('location:'.ROOT_URL.'signin.php');
                    //die();
                }  


      }   


        }
public static function comment(){
            session_start();
            require('config/databases.php');
            if (isset($_SESSION['user-id'])){
                $user_id= filter_var($_SESSION['user-id'],FILTER_SANITIZE_NUMBER_INT);
                
                $avatar=ModelUser::getAvatar($user_id);
                /*******************/
                $username=ModelUser::getname($user_id);

              
              if(isset($_POST['commentaire'])){
                 if(!$_POST['comment']){
                    //rien a faire
                  }
                  else{
                    $id=$_SESSION['blog-id'];
                    $comment=$_POST['comment'];
                    $commentaire=new ModelCommentaire($id,$comment,$avatar['avatar'],$username['username'],0); 
                    $result=$commentaire->save();
                    $_SESSION['comments']="thank you ! waiting for admin approuve !!";
                    header('location:index.php?controller=find&action=post&&id='.$id);
                    die();
                  }
              
                  
              }}
              else{
                if(isset($_POST['commentaire'])){
                if($_POST['comment'] && $_POST['pseudo']){
                  $id=$_SESSION['blog-id'];
                  $pseudo=$_POST['pseudo'];
                    $comment=$_POST['comment'];
                    $avatar="inconnu.jpg";
                    $commentaire=new ModelCommentaire($id,$comment,$avatar,$pseudo,0); 
                    $result=$commentaire->save();
                    $_SESSION['comments']="thank you ! waiting for admin approuve !!";
                    header('location:index.php?controller=find&action=post&&id='.$id);
                    die();
                }}
              }


      }   


    public static function send(){
        session_start();
        require('view/home/contact.php');
        if (isset($_POST["send"])) {
            

            $mail->isSMTP();
            $mail->Host ='smtp.gmail.com';
            $mail->SMTPAuth =true;
            $mail->Username ='computervis6@gmail.com';
            $mail->Password ='uwmrgybgbgmhboay';
            $mail->SMTPSecure ='ssl';
            $mail->Port = 465;
            $mail->setFrom('computervis6@gmail.com');
            $mail->addAddress("computervision1000@gmail.com");
            $mail->isHTML(true);
            $mail->Subject ="titre:".$_POST["titreMail"]."/sender:".$_POST["mail"];
            $mail->Body=$_POST["message"];
            $mail->send();
        }
        $id=$_SESSION['blog-id'];
        header('location:index.php?controller=homepage&action=contact');
        die();
    }  

       
    }
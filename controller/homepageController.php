<?php
require_once ('model/modelUser.php'); // chargement du modèle
require_once ('model/modelCategorie.php');
require_once ('model/modelCommentaire.php');
require_once ('model/modelLikes.php');
require_once ('model/modelPosts.php');
class homepageController{

    public static function getAll() {
    require_once("partiel/header.php");
    $featured_result=ModelPosts::getfeatured();
    $featured = ModelPosts::getbyfeatured();
    $posts=ModelPosts::getposts();
    $id=$featured['category_id'];
    $category_1=ModelCategorie::getbyid($id);
    $id=$featured['author_id'] ;
    $author_1=ModelUser::getbyid($id);
    $post=ModelPosts::getpost();
    require ('view/home/home.php');
    while($post = $posts->fetch(PDO::FETCH_ASSOC)) {
    $id=$post['category_id'];
    $category=ModelCategorie::getbyid($id);
    $id=$post['id'];
    $likes=ModelLikes::getlikes($id);
    $id=$post['author_id'];
    $author=ModelUser::getbyid($id);
    $all_categories=ModelCategorie::getCategorie();
    require ('view/home/home3.php');}
    require ('view/home/home2.php');
    }
    public static function blog(){
    require_once("partiel/header.php");
    $featured_result=ModelPosts::getfeatured();
    $featured = ModelPosts::getbyfeatured();
    $posts=ModelPosts::getposts();
    $id=$featured['category_id'];
    $category_1=ModelCategorie::getbyid($id);
    $id=$featured['author_id'] ;
    $author_1=ModelUser::getbyid($id);
    $post=ModelPosts::getpost();
    require ('view/home/blog.php');
    while($post = $posts->fetch(PDO::FETCH_ASSOC)) {
        $id=$post['category_id'];
        $category=ModelCategorie::getbyid($id);
        $id=$post['id'];
        $likes=ModelLikes::getlikes($id);
        $id=$post['author_id'];
        $author=ModelUser::getbyid($id);
        $all_categories=ModelCategorie::getCategorie();
        require ('view/home/home3.php');}
        require ('view/home/home2.php');
    }
    public static function about(){
        require_once("partiel/header.php");
        require ('view/home/about.php');
        require_once("partiel/footer.php");
    }
    public static function contact(){
        require_once("partiel/header.php");
        require ('view/home/contact.php');
        require_once("partiel/footer.php");
    }
    public static function services(){
        require_once("partiel/header.php");
        require ('view/home/services.php');
        require_once("partiel/footer.php");
    }
   
    }
    
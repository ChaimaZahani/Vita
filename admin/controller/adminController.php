<?php
require_once('model/modelUser.php'); // chargement du modèle
require_once('model/modelCategorie.php');
require_once('model/modelCommentaire.php');
require_once('model/modelLikes.php');
require_once('model/modelPosts.php');
class adminController
{
    public static function dashboard()
    {
        require('partiels/header.php');

        $current_user_id = $_SESSION['user-id'];
        $posts = ModelPosts::getdata($current_user_id);
        require('view/dashboard/dashboard.php');
        if ($posts->rowCount() > 0) {
            require('view/dashboard/dashboard3.php');

            while ($post = $posts->fetch(PDO::FETCH_ASSOC)) {
                $category_id = $post['category_id'];
                $category = ModelCategorie::gettitle($category_id);
                require('view/dashboard/dashboard1.php');
            }
            echo '                
            </tbody>
        </table>';
        } else {
            echo '  <div class="alert__message error">No posts found</div>
           ';
        }
        echo '    </main>
        </div> 
        </section>';
        require("partiels/footer.php");
    }
    public static function post()
    {
        require('partiels/header.php');
        $categories = ModelCategorie::getAlls();
        //get back form data if form was invalid
        $title = $_SESSION['add-post-data']['title'] ?? null;
        $body = $_SESSION['add-post-data']['body'] ?? null;

        //delete form data session 
        unset($_SESSION['add-post-data']);
        require("view/add/add-post.php");
        require("partiels/footer.php");
    }

    public static function category()
    {
        require('partiels/header.php');
        $title = $_SESSION['add-category-data']['title'] ?? null;
        $description = $_SESSION['add-category-data']['description'] ?? null;

        unset($_SESSION['add-category-data']);
        require("view/add/add-category.php");
        require("partiels/footer.php");
    }
    public static function user()
    {
        require('partiels/header.php');
        $firstname = $_SESSION['add-user-data']['firstname'] ?? null;
        $lastname = $_SESSION['add-user-data']['lastname'] ?? null;
        $username = $_SESSION['add-user-data']['username'] ?? null;
        $email = $_SESSION['add-user-data']['email'] ?? null;
        $createpassword = $_SESSION['add-user-data']['createpassword'] ?? null;
        $confirmpassword = $_SESSION['add-user-data']['confirmpassword'] ?? null;
        // delete signup data session 
        unset($_SESSION['add-user-data']);
        require("view/add/add-user.php");
        require("partiels/footer.php");
    }
    public static function manage_category()
    {
        require('partiels/header.php');
        $categories = ModelCategorie::getAlls();
        ;
        require("view/manage/manage-categories.php");
        require("partiels/footer.php");
    }
    public static function manage_users()
    {
        require('partiels/header.php');
        $current_admin_id = $_SESSION['user-id'];
        $users = ModelUser::getnot($current_admin_id);
        require("view/manage/manage-users.php");
        require("partiels/footer.php");
    }
    public static function manage_comment()
    {
        require('partiels/header.php');
        $commentaires = ModelCommentaire::getAlls();
        require("view/manage/manage-comments.php");
        require("partiels/footer.php");
    }
    public static function test()
    {
        require("view/manage/test.php");
        require("partiels/footer.php");
    }
    public static function addcategory()
    {
        session_start();
        require('config/database.php');
        if (isset($_POST['submit'])) {
            //get from data
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            if (!$title) {
                $_SESSION['add-category'] = "Enter title";
            } elseif (!$description) {
                $_SESSION['add-category'] = "Enter description";
            }
            //redirect back to category page with form data if there was invalid input
            if (isset($_SESSION['add-category'])) {
                $_SESSION['add-category-data'] = $_POST;
                header('Location:index.php?controller=admin&action=category');
                die();
            } else {
                //insert category into database

                try {
                    $category = new ModelCategorie($title, $description);
                    $result = $category->save();
                    $_SESSION['add-category-success'] = " $title added successfully";
                    header('Location:index.php?controller=admin&action=manage_category');
                    die();
                } catch (PDOException $except) {
                    $_SESSION['add-category'] = "Couldn't add category";
                    header('Location:index.php?controller=admin&action=category');
                    die();
                }
                /*if (mysqli_error($connection)) {
                $_SESSION['add-category']="Couldn't add category";
                header('Location:'.ROOT_URL."/admin/add-category.php");
                die();
                }else {
                $_SESSION['add-category-success']=" $title added successfully";
                header('Location:'.ROOT_URL."/admin/manage-categories.php");
                die();
                }*/
            }
        }
    }
    public static function adduser()
    {
        session_start();
        require('config/database.php');
        // get  form data if submit button was clicked 
        if (isset($_POST['submit'])) {
            $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $createpassword = filter_var($_POST['createpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmpassword = filter_var($_POST['confirmpassword'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);
            $avatar = $_FILES['avatar'];

            //validate input values
            if (!$firstname) {
                $_SESSION['add-user'] = "Please enter your First Name";
            } elseif (!$lastname) {
                $_SESSION['add-user'] = "Please enter your Last Name";
            } elseif (!$username) {
                $_SESSION['add-user'] = "Please enter your Username";
            } elseif (!$email) {
                $_SESSION['add-user'] = "Please enter your a valid email";
            } elseif (strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
                $_SESSION['add-user'] = "Password should be 8+ characters";
            } elseif (!$avatar['name']) {
                $_SESSION['add-user'] = "Please add avatar";
            } else {
                // check if passwords don't match
                if ($createpassword !== $confirmpassword) {
                    $_SESSION['add-user'] = "Passwords do not match!";
                } else {
                    //hash password
                    $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);
                    //echo $createpassword .'<br/>';
                    //echo $hashed_password;

                    // check if username or email already exist in database
                    $user_check_result = ModelUser::exist($username, $email);
                    if ($user_check_result->rowCount() > 0) {
                        $_SESSION['add-user'] = "Username or Email already exist";

                    } else {
                        //WORK ON AVATAR
                        //rename avatar
                        $time = time(); // make each image name unique usign timestamp
                        $avatar_name = $time . $avatar['name'];
                        $avatar_tmp_name = $avatar['tmp_name']; //upload image
                        $avatar_destination_path = "../images/" . $avatar_name;

                        //make sure file is an image 
                        $allowed_files = ['png', 'jpg', 'jpeg'];
                        $extention = explode('.', $avatar_name);
                        $extention = end($extention);
                        if (in_array($extention, $allowed_files)) {
                            //make sure image is not too large(1mb+) 
                            if ($avatar['size'] < 1000000) {
                                //upload avtar
                                move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                            } else {
                                $_SESSION['add-user'] = 'File size too big';
                            }
                        } else {
                            $_SESSION['add-user'] = 'File should be png,jpg or jpeg ';
                        }
                    }
                }
            }

            // redirect back to signup page  if they was any problem 
            if (isset($_SESSION['add-user'])) {
                // pass form data back to page
                $_SESSION['add-user-data'] = $_POST;
                header('Location:' . ROOT_URL . "/admin/add-user.php");
                die();
            } else {

                try {
                    // insert new user int user table
                    $insert_user_result = new ModelUser($firstname, $lastname, $username, $email, $hashed_password, $avatar_name, $is_admin);
                    $insert_user_result->save();
                    // redirect to login page with success message
                    $_SESSION['add-user-success'] = 'User added successfully';
                    header('location:' . ROOT_URL . 'admin/manage-users.php');
                    die();
                } catch (PDOException $except) {
                    echo "Echec  " . $except->getMessage();
                    die();
                }
                /*if(!mysqli_errno($connection)){
                // redirect to login page with success message
                $_SESSION['add-user-success']='User added successfully';
                header('location:'.ROOT_URL.'admin/manage-users.php');
                die();
                }*/
            }

        } else {
            //if button wasn't clicked , bounce back to page
            header('location:' . ROOT_URL . 'admin/add-user.php');
            die();
        }
    }
    public static function addpost()
    {
        session_start();
        require('config/database.php');
        // get  form data if submit button was clicked 
        if (isset($_POST['submit'])) {
            $author_id = $_SESSION['user-id'];
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
            $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
            $thumbnail = $_FILES['thumbnail'];
            // set is_featured to a if unchecked
            $is_featured = $is_featured == 1 ?: 0;
            //validate input values
            if (!$title) {
                $_SESSION['add-post'] = "Please enter your Post title";
            } elseif (!$category_id) {
                $_SESSION['add-post'] = "Please Select post category";
            } elseif (!$body) {
                $_SESSION['add-post'] = "Please enter post body";
            } elseif (!($thumbnail['name'])) {
                $_SESSION['add-post'] = "Please choose post thumbnail";
            } else {

                // work on thumbnail
                //rename the image
                $time = time(); //make each image name unique
                $thumbnail_name = $time . $thumbnail['name'];
                $thumbnail_tmp_name = $thumbnail['tmp_name'];
                $thumbnail_destination_path = '../images/' . $thumbnail_name;

                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $thumbnail_name);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    //make sure image is not too big 
                    if ($thumbnail['size'] < 2_000_000) {
                        //upload thumbnail
                        move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                    } else {
                        $_SESSION['add-post'] = "File size too big.should be less then 2mb";
                    }
                } else {
                    $_SESSION['add-post'] = "File should be png, jpg, or jpeg";
                }
            }
            //redirect back  with form data  to add post page 
            if (isset($_SESSION['add-post'])) {

                $_SESSION['add-post-data'] = $_POST;
                header('Location:index.php?controller=admin&action=post');
                die();
            } else {
                //set is_featured of all posts to 0 if it is 1
                if ($is_featured == 1) {
                    $zero_all_is_featured_result = ModelPosts::update_featured();
                }

                //insert post into database

                try {

                    $post = new ModelPosts($title, $body, $thumbnail_name, $category_id, $author_id, 1);
                    $post->save();
                    $_SESSION['add-post-success'] = "New post added successfully.";
                    header('Location:index.php');
                    die();
                } catch (PDOException $except) {
                    echo "Echec  " . $except->getMessage();
                    die();
                }
                /*if (!mysqli_error($connection)) {
                $_SESSION['add-post-success']="New post added successfully.";
                header('Location:'.ROOT_URL."admin/");
                die();
                }*/


            }


        }
        header('Location:index.php?controller=admin&action=post');
        die();

    }

    public static function delete_categorie()
    {
        session_start();
        require('config/database.php');
        if (isset($_GET['id'])) {
            // get updated form data
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            // update category_id of posts that their categories are delated to uncategorized categorie
            $update_result = ModelCategorie::updateCategorie($id);

            /*if (!mysqli_error($connection)) {*/
            try {
                //delete category
                $result = ModelCategorie::delete($id);
                $_SESSION['delete-category-success'] = " category deleted successfully";

            } catch (PDOException $except) {
                $_SESSION['delete-category'] = "couldn't delete category ";
                echo "Echec de la connexion: " . $except->getMessage();
                die();
            }

        }
        header('Location:index.php?controller=admin&action=manage_category');
        die();
    }
    public static function delete_comment()
    {
        session_start();
        require('config/database.php');
        if (isset($_GET['id'])) {
            // get updated form data
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            
            $result = ModelCommentaire::getbyid($id);
            // make sure only 1 record/post was fetched
            if ($result->rowCount() == 1) {
                $comment =ModelCommentaire::fetch($result);
                //delete post from database
                try {
                    $delete_comment_result =ModelCommentaire::delete($id);

                    $_SESSION['delete-comment-success'] = "Comment deleted successfully";

                } catch (PDOException $except) {
                    echo "Echec  " . $except->getMessage();
                    die();
                }


            }

        }


        header('Location:index.php?controller=admin&action=manage_comment');
        die();
    }
    public static function valid_comment()
    {

        session_start();
        require('config/database.php');
        if (isset($_GET['id'])) {
            // get updated form data
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            // update category_id of posts that their categories are delated to uncategorized category
            $update_result = ModelCommentaire::updateValide($id);
            /*if (!mysqli_error($connection)) {*/


        }
        header('Location:index.php?controller=admin&action=manage_comment');
        die();
    }
    public static function delete_post()
    {
        session_start();
        require('config/database.php');
        if (isset($_GET['id'])) {
            // get updated form data
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $result= ModelPosts::getbyid($id);
            // make sure only 1 record/post was fetched
            if ($result->rowCount() == 1) {
                $post = ModelPosts::fetch($result);
                $thumbnail_name = $post['thumbnail'];
                $thumbnail_path = '../images/' . $thumbnail_name;
                if ($thumbnail_path) {
                    unlink($thumbnail_path);
                    //delete post from database
                    try {
                        $delete_post_result = ModelPosts::delete($id);
                        $_SESSION['delete-post-success'] = "Post deleted successfully";

                    } catch (PDOException $except) {
                        echo "Echec  " . $except->getMessage();
                        die();
                    }


                }

            }

        }
        header('Location:index.php');
        die();
    }
    public static function delete_user()
    {
        session_start();
        require('config/database.php');
        if (isset($_GET['id'])) {
            // get updated form data
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            // fetch user from database
            $user = ModelUser::getbyid($id);
            //make sure we got back only one user
            if ($result->rowCount() == 1) {
                $avatar_name = $user['avatar'];
                $avatar_path = '../images/' . $avatar_name;
                //delete image if available
                if ($avatar_path) {

                    unlink($avatar_path);
                }
            }
            //fetch all thumbnails for user's posts and delete them
            $thumbnails_result = ModelPosts::getThumbnail($id);
            if ($thumbnails_result->rowCount() > 0) {
                while ($thumbnail = $thumbnails_result->fetch(PDO::FETCH_ASSOC)) {
                    $thumbnail_path = '../images/' . $thumbnail['thumbnail'];
                    //delete thumbnail from images folder if exist
                    if ($thumbnail_path) {
                        unlink($thumbnail_path);
                    }


                }
            }



            //delete user from database
            try {
                $delete_user_result = ModelUser::delete($id);
                $_SESSION['delete-user-success'] = " '{$user['firstname']}' '{$user['lastname']}' deleted successfully";
            } catch (PDOException $except) {
                $_SESSION['delete-user'] = "couldn't delete '{$user['firstname']}' '{$user['lastname']}' ";
                echo "Echec  " . $except->getMessage();
                die();
            }

            /*if (mysqli_error($connection)) {
            $_SESSION['delete-user']="couldn't delete '{$user['firstname']}' '{$user['lastname']}' ";
            }
            else{
            $_SESSION['delete-user-success']=" '{$user['firstname']}' '{$user['lastname']}' deleted successfully";
            }*/
        }
        header('Location:index.php?controller=admin&action=manage_users');
        die();
    }
    public static function edit_user()
    {
        require('partiels/header.php');
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $user= ModelUser::getbyid($id);
        } else {
            header('location:index.php?controller=admin&action=manage_users');
            die();
        }
        require('view/edit/edit-user.php');
    }
    public static function edit_users()
    {
        session_start();
        require('config/database.php');
        if (isset($_POST['submit'])) {
            // get updated form data
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $is_admin = filter_var($_POST['userrole'], FILTER_SANITIZE_NUMBER_INT);

            // check for valid input
            if (!$firstname || !$lastname) {
                $_SESSION['edit-user'] = "Invalid from input on edit page.";

            } else {
                //update user

                try {
                    $result = ModelPosts::update_user($firstname,$lastname,$is_admin,$id);
                    $_SESSION['edit-user-success'] = "User $firstname $lastname updated successfully";
                } catch (PDOException $except) {
                    $_SESSION['edit-user'] = "Failed to update user.";

                }
                /*if (mysqli_error($connection)) {
                $_SESSION['edit-user']="Failed to update user.";
                }
                else {
                $_SESSION['edit-user-success']="User $firstname $lastname updated successfully";
                }*/
            }
        }
        header('location:index.php?controller=admin&action=manage_users');
        die();

    }
    public static function edit_categorie()
    {
        require('partiels/header.php');
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            // fetch category from database
            $result = ModelCategorie::getid($id);
            if ($result->rowCount() == 1) {
                $category = ModelCategorie::fetch($result);
            }
        } else {
            header('Location:index.php?controller=admin&action=manage_category');
            die();
        }
        require('view/edit/edit-category.php');

    }
    public static function edit_categories()
    {
        session_start();
        require('config/database.php');
        if (isset($_POST['submit'])) {
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_var($_POST['description'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // validate input
            if (!$title || !$description) {
                $_SESSION['edit-category'] = "Invalid form input on edit category";
            } else {

                try {
                    $result = ModelCategorie::updateTitleDescription($title,$description,$id);
                    $_SESSION['edit-category-success'] = "Category $title updated successfully";
                } catch (PDOException $except) {
                    $_SESSION['edit-category'] = "Couldn't update category";
                    echo "Echec de la connexion: " . $except->getMessage();
                    die();
                }

            }
        }
        header('Location:index.php?controller=admin&action=manage_category');
        die();

    }
    public static function edit_post()
    {
        include('partiels/header.php');
        $categories = ModelCategorie::getAll();
        //fetch post data from database if id is set 
        if (isset($_GET['id'])) {
            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
            $result= ModelPosts::getbyid($id);
            $post = ModelPosts::fetch($result);

        } else {
            header('location:index.php');
            die();
        }
        require('view/edit/edit-post.php');

    }
    public static function edit_posts()
    {
        session_start();
        require('config/database.php');
        // get  form data if submit button was clicked 
        if (isset($_POST['submit'])) {
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $previous_thumbnail_name = filter_var($_POST['previous_thumbnail_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $title = filter_var($_POST['title'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $body = filter_var($_POST['body'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
            $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
            $thumbnail = $_FILES['thumbnail'];

            // set is_featured to a if unchecked
            $is_featured = $is_featured == 1 ?: 0;
            //validate input values
            if (!$title) {
                $_SESSION['edit-post'] = "Couldn't update post. invalid form data on edit post page";
            } elseif (!$category_id) {
                $_SESSION['edit-post'] = "Couldn't update post. invalid form data on edit post page";
            } elseif (!$body) {
                $_SESSION['edit-post'] = "Couldn't update post. invalid form data on edit post page";
            } else {
                if (($thumbnail['name'])) {
                    $previous_thumbnail_path = '../images/' . $previous_thumbnail_name;
                    if ($previous_thumbnail_path) {
                        unlink($previous_thumbnail_path);

                    }
                    // work on thumbnail
                    //rename the image
                    $time = time(); //make each image name unique
                    $thumbnail_name = $time . $thumbnail['name'];
                    $thumbnail_tmp_name = $thumbnail['tmp_name'];
                    $thumbnail_destination_path = '../images/' . $thumbnail_name;

                    // make sure file is an image
                    $allowed_files = ['png', 'jpg', 'jpeg'];
                    $extension = explode('.', $thumbnail_name);
                    $extension = end($extension);
                    if (in_array($extension, $allowed_files)) {
                        //make sure image is not too big 
                        if ($thumbnail['size'] < 2000000) {
                            //upload thumbnail
                            move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                        } else {
                            $_SESSION['edit-post'] = "File size too big.should be less then 2mb";
                        }
                    } else {
                        $_SESSION['edit-post'] = "File should be png, jpg, or jpeg";
                    }
                }
            }
            //redirect back  with form data  to add post page 
            if ($_SESSION['edit-post']) {


                header('Location:index.php');
                die();
            } else {
                //set is_featured of all posts to 0 if it is 1
                if ($is_featured == 1) {
                    $zero_all_is_featured_result = ModelPosts::update_featured();
                }

                // set thumbnail name if a new one was uploaded, else keep Old thumbnail name
                $thumbnail_to_insert = $thumbnail_name ?? $previous_thumbnail_name;
                try {
                    $result = ModelPosts::update_posts($title,$body,$thumbnail_to_insert,$category_id,$is_featured,$id);
                    $_SESSION['edit-post-success'] = "post updated successfully.";
                    header('Location:index.php');
                    die();
                } catch (PDOException $exception) {

                    echo "Echec  " . $except->getMessage();
                    die();


                }

            }



        }



        header('Location:index.php');
        die();

    }
}
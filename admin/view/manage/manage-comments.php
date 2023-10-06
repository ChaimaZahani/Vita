<section class="dashboard">
<?php
                if (isset($_SESSION['add-category-success']))://shows if add category was sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['add-category-success'];
                          unset($_SESSION['add-category-success']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['add-category']))://shows if add category was Not sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['add-category'];
                          unset($_SESSION['add-category']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['edit-category-success'])): //shows if edit category was  sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['edit-category-success'];
                          unset($_SESSION['edit-category-success']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['edit-category']))://shows if edit category was Not sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['edit-category'];
                          unset($_SESSION['edit-category']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['delete-category-success'])): //shows if delete category was  sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['delete-category-success'];
                          unset($_SESSION['delete-category-success']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['delete-category']))://shows if delete category was Not sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['delete-category'];
                          unset($_SESSION['delete-category']);
                        ?>
                     </p>
                  </div>
<?php endif ?>
   <div class="container dashboard__container">
    <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
    <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
    <aside>
<ul>
    <li><a href="index.php?controller=admin&action=post"><i class="uil uil-pen"></i>
        <h5>Add Post</h5>
        </a>
    </li>
    <li><a href="index.php"><i class="uil uil-postcard"></i>
        <h5>Manage Posts</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=test"><i class="uil uil-chart-line"></i>
        <h5>Statistique</h5>
        </a>
    </li>
    <?php if(isset($_SESSION['user_is_admin'])): ?>
    <li><a href="index.php?controller=admin&action=user"><i class="uil uil-user-plus"></i>
        <h5>Add User</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_users"><i class="uil uil-users-alt"></i>
        <h5>Manage Users</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=category"><i class="uil uil-edit"></i>
        <h5>Add Category</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_category" ><i class="uil uil-list-ul"></i>
        <h5>Manage Categories</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_comment" class="active"><i class="uil uil-comment-alt-message"></i>
        <h5>Manage Comments</h5>
        </a>
    </li>
    
    <?php endif ?>
</ul>
    </aside>
    <main>
        <h2>Manage commentaires</h2>
        <?php if($commentaires->rowCount() >0) : ?>
        <table>
            <thead><tr>
                <th>Name</th>
                <th>Blog</th>
                <th>Comment</th>
                <th>Situation</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr></thead>
            <tbody>
                <?php while($comment =$commentaires->fetch(PDO::FETCH_ASSOC)) :
                  $sql="SELECT title FROM posts WHERE id=".$comment['id_blog'];
                  $blog=$pdo->query($sql);
                  $nom=$blog->fetch(PDO::FETCH_ASSOC);

                  ?>
                <tr>
                    <td><?= $comment['nom_intervenant']?></td>
                    <td><?=$nom['title']?></td>
                    <td><?= $comment['commentaire']?></td>
                    <?php if ($comment['valide']==1) {?>
                      <td>Valide</td>
                      <?php
                    }else{
                      ?>
                      <td>Non Valide</td>
                      <?php } ?>
                    <?php if ($comment['valide']==0) {?>  
                    <td><a href="index.php?controller=admin&action=valid_comment&&id=<?=$comment['id']?>" class="btn sm">Valid</a></td>
                    <?php }
                    else{?>
                    <td></td>
                    <?php }?>
                    <td><a href="index.php?controller=admin&action=delete_comment&&id=<?=$comment['id']?>" class="btn sm danger">Delete</a></td>
                    
                </tr>
                <?php endwhile ?>
                
            </tbody>
        </table>
        <?php else : ?>
            <div class="alert__message error"><?="No commentaires found"?></div>
            <?php endif ?>
    </main>
</div> 
</section>









<?php
  include('../partiel/footer.php');
?>
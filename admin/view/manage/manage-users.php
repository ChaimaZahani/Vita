
<section class="dashboard">
   
    
    <?php
                if (isset($_SESSION['add-user-success']))://shows if add user was sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['add-user-success'];
                          unset($_SESSION['add-user-success']);
                        ?>
                     </p>
                  </div>
               
            
            <?php
                elseif (isset($_SESSION['edit-user-success']))://shows if edit user was sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['edit-user-success'];
                          unset($_SESSION['edit-user-success']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['edit-user']))://shows if edit user was Not sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['edit-user'];
                          unset($_SESSION['edit-user']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['delete-user-success']))://shows if delete user was  sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['delete-user-success'];
                          unset($_SESSION['delete-user-success']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['delete-user']))://shows if delete user was Not sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['delete-user'];
                          unset($_SESSION['delete-user']);
                        ?>
                     </p>
                  </div>
               
            <?php endif?>
    <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
    <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            <div class="container dashboard__container">
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
    <li><a href="index.php?controller=admin&action=test" ><i class="uil uil-chart-line"></i>
        <h5>Statistique</h5>
        </a>
    </li>
    <?php if(isset($_SESSION['user_is_admin'])): ?>
    <li><a href="index.php?controller=admin&action=user"><i class="uil uil-user-plus"></i>
        <h5>Add User</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_users"class="active"><i class="uil uil-users-alt"></i>
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
    <li><a href="index.php?controller=admin&action=manage_comment" ><i class="uil uil-comment-alt-message"></i>
        <h5>Manage Comments</h5>
        </a>
    </li>
    
    <?php endif ?>
</ul>
    </aside>
    <main>
        <h2>Manage Users</h2>
        <?php if ($users->rowCount()>0) : ?> 
        <table>
            <thead><tr>
                <th>Name</th>
                <th>Username</th>       
                <th>Edit</th>
                <th>Delete</th>
                <th>Admin</th>
            </tr></thead>
            <tbody>
                <?php while($user=$users->fetch(PDO::FETCH_ASSOC)) :
                
                    
                    ?>

                <tr>
                    <td><?= "{$user['firstname']} {$user['lastname']}" ?></td>
                    <td><?= "{$user['username']}"?></td>
                    <td><a href="index.php?controller=admin&action=edit_user&&id=<?=$user['id']?>" class="btn sm">Edit</a></td>
                    <td><a href="index.php?controller=admin&action=delete_user&&id=<?=$user['id']?>" class="btn sm danger">Delete</a></td>
                    <td><?= $user['is_admin'] ? 'Yes' : 'No' ?></td>
                </tr>
                <?php endwhile?>
                
                
            </tbody>
        </table>
        <?php else :?>
            <div class="alert__message error"><?="No users found" ?></div>
            <?php endif ?>
    </main>
</div> 
</section>









<section class="dashboard">
<?php
                if (isset($_SESSION['add-post-success']))://shows if add post was  sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['add-post-success'];
                          unset($_SESSION['add-post-success']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['edit-post-success']))://shows if edit post was  sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['edit-post-success'];
                          unset($_SESSION['edit-post-success']);
                        ?>
                     </p>
                  </div><?php
                elseif (isset($_SESSION['edit-post']))://shows if edit post was Not sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['edit-post'];
                          unset($_SESSION['edit-post']);
                        ?>
                     </p>
                  </div>
                  <?php
                elseif (isset($_SESSION['delete-post-success']))://shows if delete post was  sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['delete-post-success'];
                          unset($_SESSION['delete-post-success']);
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
    <li><a href="index.php" class="active"><i class="uil uil-postcard"></i>
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
    <li><a href="index.php?controller=admin&action=manage_comment" ><i class="uil uil-comment-alt-message"></i>
        <h5>Manage Comments</h5>
        </a>
    </li>
    
    <?php endif ?>
</ul>
    </aside>
    <main>
        <h2>Manage Posts</h2>
   
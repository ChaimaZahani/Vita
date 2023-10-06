<section class="form__section">
    <div class="container form__section-container">
        <h2>Add User</h2>
        
        <?php
                if (isset($_SESSION['add-user'])):?>
                  <div class="alert__message error">
                     <p><?= $_SESSION['add-user'];
                          unset($_SESSION['add-user']);
                        ?>
                     </p>
                  </div>
               
            <?php endif?>
            <form action="index.php?controller=admin&action=adduser" method="POST" enctype="multipart/form-data">
                <input type="text" name="firstname" value="<?=$firstname?>" placeholder="First Name">
                <input type="text" name="lastname" value="<?=$lastname?>" placeholder="Last Name">
                <input type="text"name="username"value="<?=$username?>" placeholder="Username">
                <input type="email" name="email"value="<?=$email?>" placeholder="Email">
                <input type="password" name="createpassword" value="<?=$createpassword?>" placeholder="Create Password">
                <input type="password" name="confirmpassword"value="<?=$confirmpassword?>"  placeholder="Comfirm Password">
                <label>User role</label>
                <select name="userrole">
                    <option value="0">Author</option>
                    <option value="1">Admin</option>
                </select>
                <div class="form__control">
                  <label for="avatar">User Avatar</label> 
                   <input type="file" name="avatar" id="avatar">

                </div>
           
                <button type="submit" name="submit" class="btn">Add User</button>
            </form>
            <form action="index.php" style="float:right;">
            <button type="submit" name="back" class="btn">Back</button>
            </form>

    </div>
</section>


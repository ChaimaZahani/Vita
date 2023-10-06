
<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit User</h2>
            <form action="index.php?controller=admin&action=edit_users" method="POST">
            <input type="hidden" value="<?= $user['id']?>" name="id" placeholder="id">
            <input type="text" value="<?= $user['firstname']?>" name="firstname" placeholder="First Name">
                <input type="text" value="<?= $user['lastname']?>" name="lastname" placeholder="Last Name">
                <select name="userrole">
                  <option value="0">Author</option>
                  <option value="1">Admin</option>
                </select>
              
                <button type="submit" name="submit" class="btn">Update User</button>
            </form>
    </div>
</section>




<?php
  include('../partiel/footer.php');
?>
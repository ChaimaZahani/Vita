<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Category</h2>
        <?php if (isset($_SESSION['add-category'])):
                ?>
                  <div class="alert__message error">
                     <p><?= $_SESSION['add-category'];
                          unset($_SESSION['add-category']);
                        ?>
                     </p>
                  </div>
               
            <?php endif?>
            <form action="index.php?controller=admin&action=addcategory" method="POST">
                <input type="text" value="<?=$title ?>" name="title" placeholder="Title">
                <textarea rows="4" value="<?=$description ?>" name="description"  placeholder="Description"></textarea>
                <button type="submit" name="submit" class="btn">Add Category</button>
            </form>
            <form action="index.php" style="float:right;">
            <button type="submit" name="back" class="btn">Back</button>
            </form>
    </div>
</section>

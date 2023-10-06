<section class="form__section">
    <div class="container form__section-container">
        <h2>Add Post</h2>
        <?php
        if (isset($_SESSION['add-post']))://shows if add category was sucessufull
                ?>
                  <div class="alert__message error container">
                     <p><?= $_SESSION['add-post'];
                          unset($_SESSION['add-post']);
                        ?>
                     </p>
                  </div>
        
        <?php endif?>
            <form action="index.php?controller=admin&action=addpost" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" value="<?=$title?>" placeholder="Title">
                <select name="category">
                <?php while ($category = $categories->fetch(PDO::FETCH_ASSOC)) :?>


                    <option value="<?=$category['id']?>"><?=$category['title']?> </option>
                    <?php endwhile ?>  
                </select>
                <textarea rows="10" name="body" placeholder="Body"><?=$body?></textarea>
                <?php if(isset($_SESSION['user_is_admin'])):
                    ?>
                <div class="form__control inline">
                    <input type="checkbox"  value="1" name="is_featured" id="is_featured" checked>
                    <label for="is_featured" >Featured</label>   
                </div>
                <?php 
                 endif 
                ?>
                <div class="form__control">
                    <label for="thumbnail">Add Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <button type="submit" name="submit" class="btn">Add Post</button>
            </form>
            <form action="index.php" style="float:right;">
            <button type="submit" name="back" class="btn">Back</button>
            </form>
    </div>
</section>





<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Post</h2>
            <form action="index.php?controller=admin&action=edit_posts" enctype="multipart/form-data" method="POST">
            <input type="hidden" name="id" value="<?=$post['id']?>" >
            <input type="hidden" name="previous_thumbnail_name" value="<?=$post['thumbnail']?>" >
            <input type="text" name="title" value="<?=$post['title']?>" placeholder="Title">
                <select name="category">
                <?php while ($category = $categories->fetch(PDO::FETCH_ASSOC)) :?>
                    <option  value="<?=$category['id']?>"><?=$category['title']?> </option>
                    <?php endwhile ?>   
                </select>
                <textarea rows="10" name="body" placeholder="Body"><?=$post['body']?></textarea>
                <div class="form__control inline">
                    <input type="checkbox" id="is_featured" value="1" checked>  
                    <label for="is_featured" name="is_featured">Featured</label>
                </div>
                <div class="form__control">
                    <label for="thumbnail">Change Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
                <button type="submit" name="submit" class="btn">Update Post</button>
            </form>

    </div>
</section>









<?php
     include('../partiel/footer.php');
?>
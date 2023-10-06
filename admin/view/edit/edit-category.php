

<section class="form__section">
    <div class="container form__section-container">
        <h2>Edit Category</h2>
            <form action="index.php?controller=admin&action=edit_categories" method="POST">
            <input type="hidden" name="id" value="<?=$category['id']?>">
            <input type="text" name="title" value="<?=$category['title']?>" placeholder="Title">
                <textarea rows="4" name="description" placeholder="Description"><?=$category['description']?></textarea>
                <button type="submit" name="submit" class="btn">Update Category</button>
            </form>

    </div>
</section>
<?php
  include('../partiel/footer.php');
?>
<section class="category__buttons">
    <div class="container category__buttons-container">
      <?php 
        $all_categories_query= "SELECT * FROM categories";
        $all_categories = $pdo->query($all_categories_query);
      ?>
      <?php
       while($category = $all_categories->fetch(PDO::FETCH_ASSOC)) :?>
        <a href="category-posts.php?id=<?=$category['id'] ?>" class="category__button"><?= $category['title']?></a>
        <?php endwhile ?>
    </div>
</section>

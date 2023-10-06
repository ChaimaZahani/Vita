       </div>
</section>
<!--=======End of POSTS =========-->
<section class="category__buttons">
    <div class="container category__buttons-container">
      
      <?php
       while($category = $all_categories->fetch(PDO::FETCH_ASSOC)) :?>
        <a href="index.php?controller=find&action=categorie&&id=<?=$category['id'] ?>" class="category__button"><?= $category['title']?></a>
        <?php endwhile ?>
    </div>
</section>

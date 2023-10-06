<section class="search__bar">
    <form class="container search__bar-container" action="index.php" method="GET">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="Search">
        </div>
        <button type="submit" name="find" class="btn">Go</button>
    </form>
</section>




<!-- show featured post if there's any 
/*$stmt = $db->query('SELECT * FROM table');  
$row_count = $stmt->rowCount();  */ -->
<?php  if($featured_result->rowCount()== 1):?>
    <section  class="featured">
         <div class="container featured__container">
            <div class="post__thumbail">
                <img src="./images/<?=$featured['thumbnail']?>" height="300px">
            </div>
            <div class="pst__info">
               
                <a href="index.php?controller=find&action=categorie&&id=<?= $category_1['id']?>" class="category__button"><?=$category_1['title']?></a>
                <h2 class="post__title"><a href="index.php?controller=find&action=post&&id=<?=$featured['id']?>"><?=$featured['title']?></a></h2>
                <p class="post__body">
                <?= substr($featured['body'],0,300)?>...
                </p>
             <div class="post__author">
               
                <div class="post__auther-avatar">
                    <img src="./images/<?= $author_1['avatar'] ?>">
                </div>
                <div class="post__auther-info">
                    <h5>By :<?= "{$author_1['firstname']} {$author_1['lastname']}" ?> </h5>
                    <small><?=date("M d, Y - H:i" , strtotime($featured['date_time'])) ?></small>
                </div>
             </div>
            </div>
         </div>
    </section>
    <?php endif ?>
    <!--=======End of Feautured =========-->

<section class="posts <?= $featured? '':'section__extre-margin' ?>">
       <div class="container posts__container">
        

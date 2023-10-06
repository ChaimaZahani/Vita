
<link rel="stylesheet" href="css/espa.css">


<div id="slider">
	
    <ul id="slideWrap">
        <li><img src="images/1671051773026dae_42300038437d44a08ef9aa0c013d322c_mv2.jpg"></li>
        <li> <img src="images/12.jpg"> </li>
        <li> <img src="images/1671052542026dae_23a8c6276ae44a6786ae8ec8c380029c_mv2.jpg"></li>
        <li> <img src="images/17.jpg"> </li>
        <li><img src="images/4.jpg"></li>
         <li><img src="images/9.jpg"></li>
    </ul>
    <a id="next" href="#">&#8811;</a>
    <a id="prev" href="#">&#8810;</a>
    <script language="javaScript" src="js/turq.js"></script>
</div>
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
    
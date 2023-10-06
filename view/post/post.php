             
            

<section class="singlepost">
<?php
                if (isset($_SESSION['comments']))://shows if add user was sucessufull
                ?>
                  <div class="alert__message success container">
                     <p><?= $_SESSION['comments'];
                          unset($_SESSION['comments']);
                        ?>
                     </p>
                  </div>
                  <?php endif?> 
<div class="container singlepost__container">
      <h2><?= $post['title']?></h2>
      <div class="post__author">
                     <div class="post__auther-avatar">
                        <img src="./images/<?= $author['avatar'] ?>">
                     </div>
                     <div class="post__auther-info">
                        <h5>By :<?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                        <small><?=date("M d, Y - H:i" , strtotime($post['date_time'])) ?></small>
                     </div>
                     </div>
      <div class="singlepost__thumbnail">
         <img src="./images/<?= $post['thumbnail']?>">
      </div>
      <p>
      <?= $post['body']?>
      </p>
</div>
</section>

<section>       
<div class="container form__section-container">
								
      <?php
       while($comment = $all_comments->fetch(PDO::FETCH_ASSOC)) :
         ?>
        
                                 <li><div>
                                 <img class="avatar"src="images/<?=$comment['avatar']?>" style="float:left;">
					
 </div></li>
                              <br><br> 
										<li><h4><?=$comment['commentaire']?></h4></li>
                              <p style="float:right;"><small>Posted By :<?=$comment['nom_intervenant']?></small>
                              <small>Time : <?=date("M d, Y - H:i" , strtotime($comment['time'])) ?></small>
											</p>
                                 <br><br>  
                                 <?php endwhile ?>							
        
</div>  
</section>
<section>

<div class="container form__section-container">
        <h2>Commentaire</h2>
        <form action="index.php" method="POST">
         <?php  if (!isset($_SESSION['user-id'])){?>
            <input type="text" name="pseudo" placeholder="pseudo"></input>
            <?php }?>
                <textarea name="comment" id="" cols="30" rows="10" placeholder="Comment"></textarea>
                <button type="submit" name="commentaire" class="btn">Add Comment</button>
       </form>
</div>  

</section>
<!--===================END OF SINGLE POST ===============-->

<?php
  include('partiel/footer.php');
?>
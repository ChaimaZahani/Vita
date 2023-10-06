<article class="post">
             <div class="post__thumbail">
                 <img src="./images/<?= $post['thumbnail']?>" height="150px">
             </div>
             <div class="post__info">
             
               
                <a href="index.php?controller=find&action=categorie&&id=<?= $post['category_id']?>" class="category__button"><?=$category['title']?> </a>
                
                <a href="" style="float:right;"  ><?= $post['vues']?><i class="uil uil-eye"></i></a>
                <a href="index.php?controller=find&action=like&&id=<?= $post['id']?>" style="float:right;"><?=$likes['count(*)']?><i class="uil uil-heart"></i></a>

                <h3 class="post__title"><a href="index.php?controller=find&action=post&&id=<?= $post['id']?>"><?= $post['title']?></a>
                </h3>
                <p class="post__body"><?= substr($post['body'],0,150)?>...</p>
               <div class="post__author">
               
                  
                 <div class="post__auther-avatar">
                    <img src="./images/<?= $author['avatar'] ?>">
                 </div>
                 <div class="post__auther-info">
                    <h5>By :<?= "{$author['firstname']} {$author['lastname']}" ?></h5>
                    <small><?=date("M d, Y - H:i" , strtotime($post['date_time'])) ?></small>
                </div>
               </div>
            </div>
        </article>
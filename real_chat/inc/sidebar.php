<div class="sidebar-wrapper mb-4">
      <div class="card">
       <div class="card-header">
       <div class="message-to d-flex">
          <?php 
             $sql = "SELECT *FROM user WHERE id='$id'";
             $results = $pdo->query($sql);
             if ($results->rowCount() > 0){
                $res=$results->fetchAll(PDO::FETCH_ASSOC);
             }
             if($res){
             foreach($res as $user){ ?>
             <img src="<?='../images/'.$user['avatar']?>"> 
             <i class="fa fa-circle"></i>
             <h6><?php echo $user['username']; ?></h6>
             <p>
                <?php
                 if($user['status'] == "Active"){
                     echo "Active Now";
                 }else{
                     echo "Offline";
                 } 
                ?> 
             </p>
          <?php } } ?>
       </div>
       <!-- <a href="?action=logout"><i class="fa fa-sign-out"></i> Logout</a> -->
       <div class="dropdown">
        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">
         <i class="fa fa-ellipsis-v"></i>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="../index.php"><i class="fa fa-sign-out"></i> Return</a></li>
        </ul>
        </div>

       </div>
       <div class="card-body">
       <div class="user-list-box">
        
            <ul>
              <?php 
               $query  = "SELECT * FROM user WHERE  id != '$id'";
               $results_query = $pdo->query($query);
               if ($results_query->rowCount() > 0){
                $result=$results_query->fetchAll(PDO::FETCH_ASSOC);
             }
               
               if($result){
               foreach($result as $list){ ?>
                <li>
                    <a href="chat.php?sender=<?php echo $id; ?>&receiver=<?php echo $list['id']; ?>" class="d-flex align-items-center">
                        <img src="<?= '../images/'.$list['avatar']; ?>">
                        <?php 
                         if($list['status'] == "Active"){
                            echo "<i class='fa fa-circle'></i>";
                         }else{
                             echo "<i class='fa fa-circle offline'></i>";
                         }
                        ?>
                        <h6><?php echo $list['username']; ?></h6>
                    </a>
                </li>
                <?php } } ?>   
            </ul>   
        </div>
       </div>
      </div>
    </div>
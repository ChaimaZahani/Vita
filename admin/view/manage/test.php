<?php 

       include('partiels/header.php');
       
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['blog', 'posts'],
            <?php
            $total_vue=0;
            $current_user_id =$_SESSION['user-id'];
       $query="SELECT * FROM posts WHERE author_id=$current_user_id";
       $posts=$pdo->query($query);
       if( $posts->rowCount() >0) {
        while($post=$posts->fetch(PDO::FETCH_ASSOC)) {
          $total_vue+=intval($post['vues']);
            echo   "['".$post['title']."',". intval($post['vues']) ."],";
           
        }
       } ?>
           
        ]);

        var options = {
          title: 'VIEW NUMBER',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
        var data1 = google.visualization.arrayToDataTable([
            ['blog', 'likes'],
            <?php
            $total_likes=0;
            $current_user_id =$_SESSION['user-id'];
            $query="SELECT * FROM posts WHERE author_id=$current_user_id";
            $posts=$pdo->query($query);
            if( $posts->rowCount() >0) {
            while($post=$posts->fetch(PDO::FETCH_ASSOC)) {
              $id_article=$post['id'];
              $likes="SELECT *  FROM likes WHERE id_article=$id_article";
              $posts1=$pdo->query($likes);
              $result= $posts1->rowCount();
              $total_likes+=$result;
              
            echo   "['".$post['title']."',". $result ."],";
           
        }
       } ?>
           
        ]);

        var options1 = {
          title: 'likes NUMBER',
          is3D: true,
        };

        var chart1 = new google.visualization.PieChart(document.getElementById('piechart_3d1'));
        chart1.draw(data1, options1);

        var data2 = google.visualization.arrayToDataTable([
            ['blog', 'commentaire'],
            <?php
            $total_comments=0;
            $current_user_id =$_SESSION['user-id'];
            $query="SELECT * FROM posts WHERE author_id=$current_user_id";
            $posts=$pdo->query($query);
            if( $posts->rowCount() >0) {
            while($post=$posts->fetch(PDO::FETCH_ASSOC)) {
              $id_article=$post['id'];
              $commentaire="SELECT *  FROM commentaire WHERE id_blog=$id_article";
              $posts2=$pdo->query($commentaire);
              $result1= $posts2->rowCount();
              $total_comments+=$result1;
              
            echo   "['".$post['title']."',". $result1 ."],";
           
        }
       } ?>
           
        ]);

        var options2 = {
          title: 'Commentaire NUMBER',
          is3D: true,
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart_3d2'));
        chart2.draw(data2, options2);

      }
    </script>
    
    
  </head>
  <body>
  <section class="dashboard">
  <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right-b"></i></button>
    <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left-b"></i></button>
            <div class="container dashboard__container">
    <aside>
<ul>
    <li><a href="index.php?controller=admin&action=post"><i class="uil uil-pen"></i>
        <h5>Add Post</h5>
        </a>
    </li>
    <li><a href="index.php"><i class="uil uil-postcard"></i>
        <h5>Manage Posts</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=test" class="active"><i class="uil uil-chart-line"></i>
        <h5>Statistique</h5>
        </a>
    </li>
    <?php if(isset($_SESSION['user_is_admin'])): ?>
    <li><a href="index.php?controller=admin&action=user"><i class="uil uil-user-plus"></i>
        <h5>Add User</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_users"><i class="uil uil-users-alt"></i>
        <h5>Manage Users</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=category"><i class="uil uil-edit"></i>
        <h5>Add Category</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_category" ><i class="uil uil-list-ul"></i>
        <h5>Manage Categories</h5>
        </a>
    </li>
    <li><a href="index.php?controller=admin&action=manage_comment" ><i class="uil uil-comment-alt-message"></i>
        <h5>Manage Comments</h5>
        </a>
    </li>
    
    <?php endif ?>
</ul>
    </aside>
    <main>
        <h2>Statistique</h2>
    
    <table>
    <thead><tr>
                <th>Total View</th>
                <th>Total Likes</th>
                <th>Total Comments</th>
            </tr></thead>
            <tbody>
            <tr>
                    <td><?=$total_vue ?></td>
                    <td><?=$total_likes ?></td>
                    <td><?=$total_comments?></td>
                </tr>
            </tbody>   
     
    </table>
    <br>
    <br>
    <style>
        .box {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap:  1rem;
}

.box :first-child {
    align-self: center;
}
      
        </style>
    <div class="box">
             
                       <div id="piechart_3d" style="width: 200px; height: 200px;"></div>
                 
   
    
            
   
    <div id="piechart_3d1"  style="width: 200px; height: 200px;"></div>
   
   
    <div id="piechart_3d2" style="width: 200px; height: 200px;"></div>
    </div>
</main>
</div> 
</section>

    
  </body>
</html>
<?php
  include('../partiel/footer.php');
?>
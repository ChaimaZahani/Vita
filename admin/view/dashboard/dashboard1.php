
                <!--get categorie title for eatch table -->
              
                <tr>
                    <td><?=$post['title'] ?></td>
                    <td><?=$category['title'] ?></td>
                    <td><a href="index.php?controller=admin&action=edit_post&&id=<?= $post['id']?>" class="btn sm">Edit</a></td>
                    <td><a href="index.php?controller=admin&action=delete_post&&id=<?= $post['id']?>" class="btn sm danger">Delete</a></td>
                </tr>
                
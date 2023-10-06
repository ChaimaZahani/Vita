</div>
</section>
<!--=======End of POSTS =========-->
<section id="services" class="services services">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>categories</h2>
          </div>

        <div class="row">
        <?php
       while($category = $all_categories->fetch(PDO::FETCH_ASSOC)) :?>
          <div class=" icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class="<?=$category['icon'] ?>"></i></div>
            <h4 class="title"><a href="index.php?controller=find&action=categorie&&id=<?=$category['id'] ?>"><?= $category['title']?></a></h4>
              </div>
        <?php endwhile ?>

            
</div>
      </div>
    </section>
<!--=======End of CATEGORY BUTTONS  =========-->

<style>
  /*--------------------------------------------------------------
# Services
--------------------------------------------------------------*/
.row{
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap:  1rem;
}
section {
  padding: 60px 0;
  overflow: hidden;
}

.section-bg {
  background-color:#034AA6;
}

.section-title {
  text-align: center;
  padding-bottom: 30px;
}
.section-title h2 {
  font-size: 32px;
  font-weight: bold;
  text-transform: uppercase;
  margin-bottom: 20px;
  padding-bottom: 20px;
  position: relative;
}
.section-title h2::after {
  content: "";
  position: absolute;
  display: block;
  width: 50px;
  height: 3px;
  background: #d86aac;
  bottom: 0;
  left: calc(50% - 25px);
}
.section-title p {
  margin-bottom: 0;
}

.services .icon-box {
  margin-bottom: 20px;
  text-align: center;
  
}
.services .icon {
  display: inline-flex;
  justify-content: center;
  align-items: center;
  width: 80px;
  height: 80px;
  margin-bottom: 20px;
  background: #fff;
  border-radius: 50%;
  transition: 0.5s;
  color: #d86aac;
  overflow: hidden;
  box-shadow: 0px 0 25px rgba(0, 0, 0, 0.15);
}
.services .icon i {
  font-size: 36px;
  line-height: 0;
}
.services .icon-box:hover .icon {
  box-shadow: 0px 0 25px rgba(63, 187, 192, 0.3);
}
.services .title {
  font-weight: 600;
  margin-bottom: 15px;
  font-size: 18px;
  position: relative;
  padding-bottom: 15px;
}
.services .title a {
  color: #444444;
  transition: 0.3s;
}
.services .title a:hover {
  color: #F28705;
}
.services .title::after {
  content: "";
  position: absolute;
  display: block;
  width: 50px;
  height: 2px;
  background: #d86aac;
  bottom: 0;
  left: calc(50% - 25px);
}
.services .description {
  line-height: 24px;
  font-size: 14px;
}

</style>


<?php
  include('partiel/footer.php');
?>
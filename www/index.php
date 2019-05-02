<?php 
  /**
    * @author Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
    */
    include_once './site_header.php';
    include_once './Database/DB.php';
    include_once './Functions/Post.php';

    $arePosts = false;

    $db = new DB();
    $pdo = $db->newConnection();
        
    Post::dbConnection($pdo);
        
    $posts = Post::getPosts();
    
    if (count($posts)) {
      $arePosts = true;
    }
?>
  <div class="hero-image">
    <div class="hero-text">
      <br><br>
      <h1 style="font-size: 80px; font-family: 'Margarine', cursive;">JULK</h1>
      <p>Julkaisualusta kaikille</p>
      <!--<button>Rekisteröidy!</button>-->
    </div>
  </div>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-5">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item post-filter-category">
            <a class="nav-link active filterShowAll">Kaikki</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link filterTechnology">Tekniikka</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link filterSport">Urheilu</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link filterTravel">Matkailu</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link filterStudying">Opiskelu</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link filterHistory">Historia</a>
          </li>
        </ul>
        </div>
      </div>
      <div class="row">
        <?php 
          foreach($posts as $post) {
              echo '<div class="col-lg-6 mb-3 post post-category-' . $post['category_id'] . '">';
              echo '<div class="card">';
              echo '<img class="card-img-top" src="' . $post['img'] . '"alt="Post image">';
              echo '<div class="card-body">';
              echo '<h5 class="card-title">' . $post['title'] . '</h5>';
              echo '<p>' . 'Kirjoittaja: ' . Post::getPostAuthor($post['user_id']) . '</p>';
              echo '<a href="page_post.php?id=' . $post['id'] . '" class="btn btn-primary">Lue postaus</a>';
              echo '</div>';
              echo '</div>';
              echo '</div>';
          }
        ?>
        </div>
      </div>
    </div>
  </section>

  <section id="weather-form-section" class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <div style="display: none;" id="alert-get-weather-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <!--<h2>Kirjaudu sisään</h2>-->
            <form id="get-weather-form">
                <div class="form-group">
                    <label for="city">Hae haluamasi kaupungin säätiedot</label>
                    <input class="form-control" type="text" name="city" />
                </div>
                <input type="submit" class="btn btn-primary" value="Hae" />
            </form>
            <div style="display: none;" id="get-weather-form-spinner" class="text-center">
                <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <div id="display-weather">
            </div>
            </div>
        </div>
    </div>
  </section>
<?php
    $showHR = false;
    include_once './site_footer.php';
?>
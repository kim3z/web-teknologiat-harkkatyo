<?php 
    include_once './layout/site_header.php';
?>
  <div class="hero-image">
    <div class="hero-text">
      <br><br>
      <h1 style="font-size: 80px; font-family: 'Margarine', cursive;">JULK</h1>
      <p>Julkaisualusta kaikille</p>
      <button>Rekisteröidy!</button>
    </div>
  </div>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 mb-5">
        <ul class="nav nav-pills nav-fill">
          <li class="nav-item post-filter-category">
            <a class="nav-link active">Kaikki</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link">Tekniikka</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link">Urheilu</a>
          </li>
          <li class="nav-item post-filter-category">
            <a class="nav-link">Matkailu</a>
          </li>
        </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6">
          <div class="card" style="">
              <img class="card-img-top" src="assets/img/adventure.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card" style="">
              <img class="card-img-top" src="assets/img/write.jpg" alt="Card image cap">
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
              </div>
          </div>
        </div>
        <!--<div class="col-lg-8 mx-auto">
          <div class="card" style="width: 30rem;">
            <img class="card-img-top" src="assets/img/adventure.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          <div class="card" style="width: 30rem;">
            <img class="card-img-top" src="assets/img/write.jpg" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
          -->
        </div>
      </div>
    </div>
  </section>

<?php 
    include_once './layout/site_footer.php';
?>
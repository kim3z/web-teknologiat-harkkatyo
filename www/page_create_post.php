<?php 
    require_once './authenticate.php';
    include_once './site_header.php';
?>

<section id="create-post-form-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <div style="display: none;" id="alert-login-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto">
            <?php // $_SESSION['user'] ?>
            <h2>Uusi postaus</h2>
            <div style="display: none;" id="alert-create-post-success" class="alert alert-success alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="display: none;" id="alert-create-post-failed" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="display: none;" id="create-post-form-spinner" class="text-center">
                <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
                </div>
            </div>
            <form id="create-post-form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Otsikko</label>
                    <input class="form-control" type="text" name="title" required />
                </div>
                <div class="form-group">
                    <label for="title">Teksti</label>
                    <textarea class="form-control" id="summernote" rows="5" type="text" name="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="post-category">Kategoria</label>
                    <select name="post-category" class="form-control" id="post-category" required>
                        <option value="1">Tekniikka</option>
                        <option value="2">Urheilu</option>
                        <option value="3">Matkailu</option>
                        <option value="4">Opiskelu</option>
                        <option value="5">Historia</option>
                    </select>
                </div>
                <!-- If we want image upload
                    <div class="form-group">
                    <label for="create-post-img">Kuva</label>
                    <input type="file" class="form-control-file" id="create-post-img" name="create-post-img" />
                </div>-->
                <div class="form-group">
                    <label for="create-post-img">Kuva linkki</label>
                    <input class="form-control" type="text" name="create-post-img" required />
                    <small class="form-text text-muted">No copyright kuvia kanattaa hakea tästä: <a href="https://pixabay.com/" target="_blank">https://pixabay.com/</a></small>
                    <small id="image-example" class="form-text text-muted">Esim. https://cdn.pixabay.com/photo/2019/04/06/20/56/spring-4108380_1280.jpg</small>
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user']['id'] ?>">
                <input type="submit" class="btn btn-success" name="login" value="Lisää" />
            </form>
            </div>
        </div>
    </div>
  </section>

<?php 
    include_once './site_footer.php';
?>

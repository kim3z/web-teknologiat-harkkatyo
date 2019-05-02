/**
 * Author: Kim Lehtinen <kim.lehtinen@student.uwasa.fi>
 */

var filters = {
    filterShowAll: 0,
    filterTechnology: 1,
    filterSport: 2,
    filterTravel: 3,
    filterStudying: 4,
    filterHistory: 5
};

$(document).ready(function() {
    initGetWeather();
    initCreatePost();
    initRegister();
    initLogin();
    initFilterByCategory();
    initSummernote();
});

function initSummernote() {
    $('#summernote').summernote();
}

function initFilterByCategory() {
    $('.post-filter-category a').click(function() {
        $('.post-filter-category a').removeClass('active');

        $(this).addClass('active');
        var classes = $(this).attr("class").split(' ');
        var filter = '';
        
        for (var i=0; i<classes.length; i++) {
            if (filters.hasOwnProperty(classes[i])) {
                filter = classes[i];
                break;
            }
        }

        if (filter.length > 0) {
            filterCategory(filter);
        }
    });
}

function filterCategory(filter) {
    var filterNumber = filters[filter];

    if (filter === 'filterShowAll') {
        $('.post').show();
    } else {
        $('.post').hide();
        $('.post-category-' + filterNumber).show();
    }
}

function initListPosts() {
    //
}

function initCreatePost() {
    $('#create-post-form').submit(function(e) {
        e.preventDefault();
        $('#create-post-form-spinner').show();
        var formData = new FormData(this);

        // Validate data
        dataStatus = validateCreatePostDataStatus(formData);
        
        if (!dataStatus['is_valid']) {
            $('#create-post-form-spinner').hide();
            $('#alert-create-post-failed > strong').html(dataStatus['error']);
            $('#alert-create-post-failed').show();
            $([document.documentElement, document.body]).animate({
                scrollTop: $("#create-post-form-section").offset().top
            }, 500);
            return;
        }

        $.ajax({
            type: 'POST',
            data: formData,
            url: 'Controllers/Post/CreatePost.php',
            processData: false,
            contentType: false,
            success: function(data){
              if (data === 'true') {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-success > strong').html('Lisätty!');
                $('#alert-create-post-success').show();
                $('#create-post-form')[0].reset();
                $('#summernote').summernote('reset');
              } else if (data === 'upload-false') {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Kuvan tallentaminen epäonnistui');
                $('#alert-create-post-failed').show();
              } else {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Lisääminen epäonnistui');
                $('#alert-create-post-failed').show();
              }
              $([document.documentElement, document.body]).animate({
                scrollTop: $("#create-post-form-section").offset().top
              }, 500);
            },
            error: function (request, status, error) {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Lisääminen epäonnistui');
                $('#alert-create-post-failed').show();
                console.log(request.responseText);
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#create-post-form-section").offset().top
                }, 500);
            }
        });
    });
}

function validateCreatePostDataStatus(formData) {
    var status = {
        error: '',
        is_valid: true
    }

    if (formData.get('title').length <= 0) {
        status['error'] = 'Sinun täytyy antaa otsikko';
        status['is_valid'] = false;
        return status;
    } else if (formData.get('content').length <= 0) {
        status['error'] = 'Sinun täytyy kirjoittaa jotain';
        status['is_valid'] = false;
        return status;
    } else if (formData.get('post-category').length <= 0) {
        status['error'] = 'Sinun täytyy antaa kategoria';
        status['is_valid'] = false;
        return status;
    } else if (formData.get('create-post-img').length <= 0) {
        status['error'] = 'Sinun täytyy kuva linkki';
        status['is_valid'] = false;
        return status;
    } else if (!validURL(formData.get('create-post-img'))) {
        status['error'] = 'Linkki ei kelpaa';
        status['is_valid'] = false;
        return status;
    } else if (!checkImgURL(formData.get('create-post-img'))) {
        status['error'] = 'Linkki ei kelpaa, katso että kuvatyyppi on: jpeg, jpg, gif tai png';
        status['is_valid'] = false;
        return status;
    }

    return status;
}

function checkImgURL(url) {
    return(url.match(/\.(jpeg|jpg|gif|png)$/) != null);
}

function validURL(str) {
    var pattern = new RegExp('^(https?:\\/\\/)?'+ 
      '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ 
      '((\\d{1,3}\\.){3}\\d{1,3}))'+ 
      '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ 
      '(\\?[;&a-z\\d%_.~+=-]*)?'+ 
      '(\\#[-a-z\\d_]*)?$','i'); 
    return !!pattern.test(str);
  }

function initRegister() {
    $('#register-form').submit(function(e) {
        e.preventDefault();
        $('#register-form-spinner').show();
        var formData = getFormDataObject('register-form');
        $.ajax({
            type: 'POST',
            data: {
                username: formData['username'],
                password: formData['password']
            },
            url: 'register.php',
            success: function(data){
              if (data === 'true') {
                $('#register-form-spinner').hide();
                $('#alert-register-success > strong').html('Kiitos! Voit nyt kirjautua sisään.');
                $('#alert-register-success').show();
                $('#register-form')[0].reset();
              } else {
                $('#register-form-spinner').hide();
                $('#alert-register-failed > strong').html('Rekisteröityminen epäonnistui');
                $('#alert-register-failed').show();
              }
            },
            error: function (request, status, error) {
                $('#register-form-spinner').hide();
                $('#alert-register-failed > strong').html('Rekisteröityminen epäonnistui');
                $('#alert-register-failed').show();
                console.log(request.responseText);
            }
        });
    });
}

function initLogin() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var formData = getFormDataObject('login-form');
        $.ajax({
            type: 'POST',
            data: {
                username: formData['username'],
                password: formData['password']
            },
            url: 'login.php',
            success: function(data){
                if (data === 'true') {
                    window.location.replace("http://new-lipas.uwasa.fi/~y104696/");
                }
                else {
                $('#alert-login-failed > strong').html('Sisäänkirjautuminen epäonnistui. Tarkista käyttäjätunnus tai salasana.');
                $('#alert-login-failed').show();
                }
            },
            error: function (request, status, error) {
                $('#alert-register-failed > strong').html('Sisäänkirjautuminen epäonnistui. Tarkista käyttäjätunnus tai salasana.');
                $('#alert-register-failed').show();
                console.log(request.responseText);
            }
        });
    });
}

function initGetWeather() {
    $('#get-weather-form').submit(function(e) {
        e.preventDefault();
        $('#get-weather-form-spinner').show();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            data: formData,
            url: 'Controllers/WeatherApi/GetWeather.php',
            processData: false,
            contentType: false,
            success: function(data){
                console.log('weather data:');
                console.log(data);
                $('#get-weather-form-spinner').hide();
                $('#display-weather').html(data);
              /*if (data === 'true') {
                $('#get-weather-form-spinner').hide();
                $('#alert-create-post-success > strong').html('Lisätty!');
                $('#alert-create-post-success').show();
                $('#create-post-form')[0].reset();
              } else {
                $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Lisääminen epäonnistui');
                $('#alert-create-post-failed').show();
              }*/
            },
            error: function (request, status, error) {
                $('#get-weather-form-spinner').hide();
                $('#display-weather').html(request.responseText);
               /* $('#create-post-form-spinner').hide();
                $('#alert-create-post-failed > strong').html('Lisääminen epäonnistui');
                $('#alert-create-post-failed').show();*/
                console.log(request.responseText);
            }
        });
    });
}

function getFormDataObject(formID) {
    var dataArr = $('#' + formID).serializeArray(),
    dataObj = {};
    
    $(dataArr).each(function(i, field){
        dataObj[field.name] = field.value;
    });
    
    return dataObj;
}

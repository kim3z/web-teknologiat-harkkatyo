<?php 
    require_once './header.php';

    $docsPassword = 'dokkari19';
    $showDocs = false;

    if (isset($_POST['docspassword'])) {
        if ($_POST['docspassword'] === $docsPassword) {
            $showDocs = true;
        }
    }
?>

<?php if (!$showDocs): ?>
<section id="toc">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <br><br>
                <form method="post">
                    <div class="form-group">
                        <label for="docspassword">Salasana</label>
                        <input class="form-control" type="password" name="docspassword" />
                    </div>
                    <input type="submit" class="btn btn-success" value="Näytä dokumentointi" />
                </form>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php if ($showDocs): ?>
<section id="toc">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="#about">
                            Mitä tämä verkkosovellus tekee?
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#technologies">
                            Teknologiat / Kirjastot
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#sourcecode">
                            Lähdekoodi
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="#general">
                            Miten sovelluksen teko sujui?
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2><strong>Mitä tämä verkkosovellus tekee?</strong></h2>
                <br>
                
                <h4><strong>Yleistä</strong></h4>
                <p class="lead">
                    "JULK" on julkaisualusta mihin kuka tahansa voi rekisteröityä. <br><br>
                    Vain rekisteröityneet/sisäänkirjautuneet käyttäjät pystyvät lisäämään postauksia. Jokaiselle postaukselle annetaan otsikko, kirjoitetaan sisältöä ja lisätään kuva. 
                    <br><br>
                    JULK on responsiivinen verkkosivu koska on käytetty bootstrappia.
                </p>

                <br>
                <h4><strong>Tietokanta</strong></h4>
                <img class="img-fluid" src="tietokanta.svg" alt="Tietokanta">
                <p class="lead">
                    Tietokannassa on kaksi taulukkoa: users ja posts.
                    <br><br>
                    Users taulukkoon talleennetaan kaikki käyttäjät. Käyttäjälle annetaan uniikki id (PK auto increment), käyttäjä tunnus ja salasana.
                    <br><br>
                    Posts taulukkoon tallennetaan tarvittava data jokaiselle postaukselle: id (PK auto increment), user_id (FK), title, content, img, category_id, created_at.
                    Img sarakkeeseen tallennetaan kuva linkki. 
                    Sarake "category_id" on postauskategoria johon kunkin postaus kuuluu, ja tähän sarakkeeseen tallennetaan vain itse keksittyjä numeroita (1="Tekniikka", 2="Urheilu", 3="Matkailu", 4="Opiskelu", 5="Historia")
                </p>

                <br>
                <h4><strong>Rekisteröityminen</strong></h4>
                <p class="lead">
                    Koodi tälle toiminnolle löytyy tiedostoissa Tämä tapahtuu tiedostossa Database/Models/User.php ja myös register.php<br><br>
                    Kun käyttäjä rekisteröityy hän keksii itse käyttäjätunnus ja salasana.
                    Rekisteröityessä katsotaan onko jo olemmassa käyttäjä samalla käyttäjätunnuksella, ja jos löytyy sama niin rekisteröityminen epäonnistuu.
                    <br><br>
                    Tiedostossa register.php tapahtuu myös salasanan kryptaus "$user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);".<br><br>
                    Request ja response joka tehdään rekisteröityessä tapahtuu AJAX:in avulla, jos response on "true" sanotaan käyttäjälle että hän voi kirjautua sisään, mutta jos response on "false" sanotaan että jotain meni pieleen.<br>
                    Ajax http request löytyy tiedostossa webteknologiat.js .
                </p>
                
                <br>
                <h4><strong>Sisäänkirjautuminen</strong></h4>
                <p class="lead">
                Koodi tälle toiminnolle löytyy tiedostoissa Tämä tapahtuu tiedostossa Database/Models/User.php ja myös login.php<br><br>
                Kun käyttäjä antaa käyttäjä tunnus ja salasana, katsotaan ensin löytyykö tietokannasta käyttäjä vastaavalla käyttäjätunnuksella. Jos löytyi, katsotaan vastaako tietokannassa oleva salasana jos kryptataan uudestaan password_hash funktiolla annettu salasana.<br>
                Jos kaikki täsmää, niin voidaan luoda uusi php sessio "session_start();
                $_SESSION['user'] = $user;".
                <br><br>
                Request ja response joka tehdään sisäänkirjautuessa tapahtuu AJAX:in avulla, jos response on "true" käyttäjä ohjataan halutulle sivulle, mutta jos response on "false" sanotaan että jotain meni pieleen kirjautuessa sisään ja että han saa yrittää uudelleen.<br>
                    Ajax http request löytyy tiedostossa webteknologiat.js .
                </p>
                
                <br>
                <h4><strong>Etusivu</strong></h4>
                <p class="lead">
                    Etusivulla nähdään kaikki postaukset jotka löytyvät tietokannasta.
                    Postaukset voidaan suodata "category_id" perusteella. <br><br>
                    Jokaisella postauksella on css luokka "post-category-x", ja näitten avulla voidaan jQueryn/Javascriptin avulla näyttää/piilottaa halutut postaukset.
                    jQuery:ssä.<br><br>
                    Kun suodatus tapahtuu, piilotetaan ensin kaikki, ja sen jälkeen näytetään vain ne jotka käyttäjä haluaa nähdä. Suodatus tapahtuu vain jos käyttäjä ei halua nähdä kaikki kerrallaan.
                    <br>
                    Suodatus tapahtuu helposti näin:<br>
                    function filterCategory(filter) {<br>
                        &nbsp;&nbsp;&nbsp;&nbsp;var filterNumber = filters[filter];<br>

                        &nbsp;&nbsp;&nbsp;&nbsp;if (filter === 'filterShowAll') {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$('.post').show();<br>
                        } else {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$('.post').hide();<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;$('.post-category-' + filterNumber).show();<br>
                        }<br>
                    }
                </p>
                <br>
                <h4><strong>Uusi postaus</strong></h4>
                <p class="lead">
                    Postauksia voidaan lisätä "Uusi postaus" sivulla. Vain sisäänkirjautunut käyttäjä voi lisätä postauksia.
                    Käyttäjä antaa otsikko, kirjoittaa tekstin, valitaan kategoria ja annetaan kuva linkki.
                    Kun submit tapahtuu AJAX requesti lähetetään tiedostoon Controllers/Post/CreatePost.php tiedostoon.
                    Ennen kuin tallennetaan uusi postaus katsotaan että kaikki tiedot on annettu ja että kuva linkki on oikea linkki, ja että linkki on kuva. Jos jotain meni pieleen ilmoitetaan käyttäjälle.
                    Käyttäjä sa kirjoittaa tekstin hyvällä editorilla <a href="https://summernote.org/">https://summernote.org/</a>.
                </p>
                <br>
                <h4><strong>Yksittäinen postaus</strong></h4>
                <p class="lead">
                    Yksittäistä postausta voidaan lukea jos etusivulta painetaan "Lue postaus" linkkiä.
                    Tämä tapahtuu tiedostossa page_post.php jolle lähetetään GET id parametri joten tiedetään minkä postauksen data haetaan tietokannasta ja näytetään käyttäjälle.
                </p>
                <br>
                <h4><strong>Avoimen rajapinnan käyttöönotto</strong></h4>
                <p class="lead">
                    Avointa rajapintaa on otettu käyttöön. Kyseessä on <a href="https://openweathermap.org/api">https://openweathermap.org/api</a>.
                    Tämän rajapinnan avulla käyttäjä voi hakea säätietoja haluamasta kaupungista. 
                    <br><br>
                    Etusivun loppuun on laitettu lomake johon käyttäjä saa syöttää kaupungin nimi.
                    Kun käyttäjä painaa "Hae" nappia lähetetään ajax requesti tiedostoon Controllers/WeatherApi/GetWeatherApi.php . Jos kaupungista ei löydetty säätietoa, ilmotetaan tästä käyttäjälle. Jos käyttäjä ei antanut kapunkia mutta painaa "Hae" nappia sanotaan käyttäjälle että he eivät antaneet kaupunkia.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="technologies">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <hr>
                <h2><strong>Teknologiat / Kirjastot</strong></h2>
                <p class="lead">
                    <strong>Tässä projektissa olen käyttänyt seuraavat teknologiat:</strong>
                    <ul>
                        <li>PHP</li>
                        <li>MySQL</li>
                        <li>JavaScript/jQuery/Ajax</li>
                        <li>Bootstrap</li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="sourcecode">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <hr>
                <h2><strong>Lähdekoodi</strong></h2>
                <p class="lead">
                    <a href="https://github.com/kim3z/web-teknologiat-harkkatyo">https://github.com/kim3z/web-teknologiat-harkkatyo</a>
                </p>
            </div>
        </div>
    </div>
</section>

<section id="general">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <hr>
                <h2><strong>Miten sovelluksen teko sujui?</strong></h2>
                <p class="lead">
                    Koska minulla oli kokemusta ennen kurssia, tämän sovelluksen teko sujui ihan hyvin.
                    <br><br>
                    Vaikeinta oli keksiä hyvä tapa lisätä postaukselle kuvia. Ensin tein niin että käyttäjä saa itse lisätä kuvia (upload), ja niitä tallensin upload kansioon ja annoin jokaiselle kuvalle uniikki nimi ja tallensin kuvan nimi tietokantaan.
                    Mutta kun testasin tätä huomasin että uwasan palvelimelle ei saa lisätä kuvia verkkosovelluksen kautta, palvelimen sudo käyttäjä olisi pitänyt antaa minulle oikeudet. Joten, muutin niin että kun käyttäjä lisää kuvan postaukseen, hän antaa vain kuva linkki ja itse linkkiä tallennetaan tietokantaan.
                    <br><br>
                    Työhön kulunut aika veikkaan että on noin 15-20 tuntia.
                </p>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<?php require_once './footer.php';
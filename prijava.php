<?php session_start();

require 'connect.php';
include 'head-foot.php';
$msg = "";

define('UPLPATH', 'img//');
$uspjesnaPrijava = false;
// echo $uspjesnaPrijava;
if (isset($_POST['prijava'])) {
    // Provjera da li korisnik postoji u bazi uz zaštitu od SQL injectiona 
    $prijavaImeKorisnika = $_POST['username'];
    $prijavaLozinkaKorisnika = $_POST['lozinka'];
    $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
    mysqli_stmt_fetch($stmt); //Provjera lozinke 
    if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
        $uspjesnaPrijava = true;
        // Provjera da li je admin 
        if ($levelKorisnika == 1) {
            $admin = true;
        } else {
            $admin = false;
        } //postavljanje session varijabli 
        $_SESSION['username'] = $imeKorisnika;
        $_SESSION['level'] = $levelKorisnika;
    } else {
        $uspjesnaPrijava = false;
        echo "<section><p>Pogreška u prijavi!</p></section>";
    }
}

// Pokaži stranicu ukoliko je korisnik uspješno prijavljen i administrator je 
if (($uspjesnaPrijava == true && $admin == true) || (isset($_SESSION['username'])) && $_SESSION['level'] == 1) {

    //////////////    FORMA ZA ADMINISTRACIJU - ADMIN.PHP     /////////////////////////

    echo '<section><p><b><a href="unos.htm">Unos nove vijesti</a></b></p></section>';


    $query = "SELECT * FROM vijesti";
    $result = mysqli_query($dbc, $query) or die('greška pri ispisu!' . mysqli_connect_error());

    echo '<p>Odaberite podatak koji želite izmijeniti/izbrisati: </p>';
    echo '<form action="" method="POST" class="padding-bot">';
    while ($row = mysqli_fetch_array($result)) {
        echo '<label><input type="radio" name="vijestID" value="' . $row["id"] . '">' . $row["id"] . ' - ' . $row["naslov"] . ' - ' . $row["ukratko"] . '</label><br />';
    }
    echo '<input type="submit" name="uredi" value="Uredi" />';
    echo '<input type="submit" name="izbrisi" value="Izbriši" />';
    echo '</form>';

    if (isset($_POST['izbrisi'])) {
        $id = $_POST['vijestID'];
        $qSlika = "SELECT slika FROM vijesti WHERE id=$id";

        $resSlika = mysqli_query($dbc, $qSlika);

        while ($row = mysqli_fetch_array($resSlika)) {
            unlink('img//' . $row['slika']);
        }
        // $query = "SELECT * FROM vijesti WHERE id=$id";
        $query = "DELETE FROM vijesti WHERE id=$id";

        $result = mysqli_query($dbc, $query);

        echo "Vijest je izbrisana!</br>";
        echo "<meta http-equiv='refresh' content='2'>";
        echo "Osvježavam stranicu...";
    }

    if (isset($_POST['uredi'])) {
        $id = $_POST['vijestID'];
        $query = "SELECT * FROM vijesti WHERE id=$id";
        $result = mysqli_query($dbc, $query) or die('greška pri ispisu!' . mysqli_connect_error());
        while ($row = mysqli_fetch_array($result)) {
            echo '<section>
                        <form enctype="multipart/form-data" action="" method="POST">
                            <div class="form-item">
                            <label for="naslov">Naslov vijesti</label>
                            <div class="form-field"> <input type="text" name="naslov" id="naslov" class="form-field-textual" value="' . $row['naslov'] . '"> </div>
                            <span id="porukaNaslov" class="bojaPoruke"></span>
                            </div>
                            <div class="form-item">
                            <label for="ukratko">Kratki sadržaj vijesti (do 50 znakova)</label>
                            <div class="form-field"> <textarea name="ukratko" id="ukratko" cols="50" rows="5"
                            class="form-field-textual">' . $row['ukratko'] . '</textarea>
                            </div>
                            <span id="porukaUkratko" class="bojaPoruke"></span>
                            </div>
                            <div class="form-item">
                            <label for="sadrzaj">Sadržaj vijesti</label>
                            <div class="form-field"> <textarea name="sadrzaj" id="sadrzaj" cols="60" rows="20"
                            class="form-field-textual">' . $row['sadrzaj'] . '</textarea> </div>
                            <span id="porukaSadrzaj" class="bojaPoruke"></span>
                            </div>
                            <div class="form-item">
                            <label for="slika">Slika: </label>
                            <div class="form-field"> <input type="file" id="slika" accept="image/gif,image/jpeg,image/jpg,image/png" class="input-text"
                            name="slika" /> 
                            
                            </div> <img src="img//' . $row['slika'] . '" width="200px" id="staraSlika" onload="var imgHasError=-1" onerror="var imgHasError=1;"/>
                            <span id="porukaSlika" class="bojaPoruke"></span>
                    </div>
                            <div class="form-item">
                            <label for="kategorija">Kategorija vijesti</label>
                            <div class="form-field"> 
                            <select name="kategorija" id="kategorija" class="form-field-textual">
                            <option value="" disabled selected>Odabir kategorije</option>        
                            <option value="Aktualno"      ';
            if ($row['kategorija'] == "Aktualno") echo 'selected="selected" ';
            echo ' >Aktualno</option>
                            <option value="Crna kronika" ';
            if ($row['kategorija'] == "Crna kronika") echo 'selected="selected" ';
            echo '>Crna kronika</option>
                            <option value="Politika"     ';
            if ($row['kategorija'] == "Politika") echo 'selected="selected" ';
            echo '>Politika</option>
                            <option value="Tehnologija"  ';
            if ($row['kategorija'] == "Tehnologija") echo 'selected="selected" ';
            echo ' >Tehnologija</option>
                            </select>
                            </div>
                            <span id="porukaKategorija" class="bojaPoruke"></span>
                            </div>
                            <div class="form-item">
                            <label for="arhiva">Spremiti u arhivu: <div class="form-field">
                            ';

            if ($row['arhiva'] == 0) {
                echo '<input type="checkbox" name="arhiva">';
            } else {
                echo '<input type="checkbox" name="arhiva" checked>';
            }
            echo '</div></label></div>';
            echo '<div class="form-item">
                            <input type="hidden" name="id" class="form-field-textual" value="' . $row['id'] . '">
                            <button type="reset" value="Poništi">Poništi</button>
                            <button type="submit" name="izmijeni" value="Izmijeni" onload="obrisi();">Izmjeni</button>
                            </div> 
                        </form>
                        <script type="text/javascript">
                            function obrisi(){';
            //sprema varijablu stare slike da bi ju mogao izbrisati
            $_SESSION['staraSlika'] = $row['slika'];
            echo '}
                            </script>';
            echo '</section>';
        } //while row

    } //isset uredi


    if (isset($_POST['izmijeni'])) {
        $naslov = $_POST['naslov'];
        $ukratko = $_POST['ukratko'];
        $sadrzaj = $_POST['sadrzaj'];
        $slikaIme = $_FILES['slika']['name'];
        $kategorija = $_POST['kategorija'];
        $arhiva = isset($_POST['arhiva']) ? 1 : 0;

        $id = $_POST['id'];

        if ($_FILES["slika"]["error"] == 0) { //ako je odabrana nova slika, obriši staru
            unlink('img//' . $_SESSION['staraSlika']);
            $target = "img/";
            move_uploaded_file($_FILES['slika']['tmp_name'], "$target/$slikaIme");
        } else { //u protivnom, ako slika nije postavljena, a sadržaj je uređen, ostavi staru sliku
            $slikaIme = $_SESSION['staraSlika'];
        }

        // $query = "SELECT * FROM vijesti";
        $query = "UPDATE vijesti SET naslov='$naslov', ukratko='$ukratko', sadrzaj='$sadrzaj',
        slika='$slikaIme', kategorija='$kategorija', arhiva='$arhiva' WHERE id=$id";
        $result = mysqli_query($dbc, $query);

        echo "Vijest je izmijenjena!</br>";
        echo "<meta http-equiv='refresh' content='2'></br>";
        echo "Osvježavam stranicu...";
    }


    ////////////////////     KRAJ FORME ZA ADMINISTRACIJU     ////////////////////////////////////////////


    // Pokaži poruku da je korisnik uspješno prijavljen, ali nije administrator
} else if ($uspjesnaPrijava == true && $admin == false) {
    echo '<section><p>Bok <b>' . $imeKorisnika . '</b>! Uspješno ste prijavljeni, ali niste administrator.</p></section>';
} else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
    echo '<section><p>Bok <b>' . $_SESSION['username'] . '</b>! Uspješno ste prijavljeni, ali niste administrator.</p></section>';
} else if ($uspjesnaPrijava == false) { ?>


    <!-- Forma za prijavu -->

    <section role="main">
        <p>Ako još nemate račun, molimo <a href="http://localhost/PWA-projekt-master/registracija.php">registrirajte se</a>!</p>
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="form-item"> <span id="porukaUsername" class="bojaPoruke"></span> <label for="username">Korisničko
                    ime:</label> <!-- Ispis poruke nakon provjere korisničkog imena u bazi -->
                <?php echo '<br><span class="bojaPoruke">' . $msg . '</span>'; ?> <div class="form-field"> <input type="text" name="username" id="username" class="form-field-textual"> </div>
            </div>
            <div class="form-item"> <span id="porukaPass" class="bojaPoruke"></span> <label for="lozinka">Lozinka: </label>
                <div class="form-field">
                    <input type="password" name="lozinka" id="lozinka" class="form-field-textual"> </div>
            </div>
            <div class="form-item"> <button type="submit" value="Prijava" id="slanje" name="prijava" onclick="provjera()">Prijava</button> </div>
        </form>
    </section>

    <script type="text/javascript">
        //javascript validacija forme
        function provjera() {
            var slanjeForme = true; // Ime korisnika mora biti uneseno 
            // Korisničko ime mora biti uneseno 
            var poljeUsername = document.getElementById("username");
            var username = document.getElementById("username").value;
            if (username.length == 0) {
                slanjeForme = false;
                poljeUsername.style.border = "1px dashed red";
                document.getElementById("porukaUsername").innerHTML = "<br>Unesite korisničko ime!<br>";
            } else {
                poljeUsername.style.border = "1px solid green";
                document.getElementById("porukaUsername").innerHTML = "";
            } // Provjera podudaranja lozinki 
            var poljePass = document.getElementById("lozinka");
            var pass = document.getElementById("lozinka").value;
            if (pass.length == 0) {
                slanjeForme = false;
                poljePass.style.border = "1px dashed red";
                poljePassRep.style.border = "1px dashed red";
                document.getElementById("porukaPass").innerHTML = "<br>Unesite lozinku!<br>"
            } else {
                poljePass.style.border = "1px solid green";
                poljePassRep.style.border = "1px solid green";
                document.getElementById("porukaPass").innerHTML = "";
                document.getElementById("porukaPassRep").innerHTML = "";
            }
            if (slanjeForme != true) {
                event.preventDefault();
            }
        };
    </script> <?php } ?>
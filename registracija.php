<?php
session_start();
if (isset($_SESSION['registriranKorisnik'])) {
    $registriranKorisnik = $_SESSION['registriranKorisnik'];
} else {
    $registriranKorisnik = false;
}
require 'connect.php';
include 'head-foot.php';
$msg = "";
?>

<?php //Registracija je prošla uspješno 
if ($registriranKorisnik == true) {
    echo '<p>Korisnik je već uspješno prijavljen!</p>';
} else {
    ?>
    <section role="main">
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="form-item"> <span id="porukaIme" class="bojaPoruke"></span> <label for="ime">Ime: </label>
                <div class="form-field"> <input type="text" name="ime" id="ime" class="form-field-textual"> </div>
            </div>
            <div class="form-item"> <span id="porukaPrezime" class="bojaPoruke"></span> <label for="prezime">Prezime:
                </label>
                <div class="form-field"> <input type="text" name="prezime" id="prezime" class="form-field-textual"> </div>
            </div>
            <div class="form-item"> <span id="porukaUsername" class="bojaPoruke"></span> <label for="username">Korisničko
                    ime:</label> <!-- Ispis poruke nakon provjere korisničkog imena u bazi -->
                <?php echo '<br><span class="bojaPoruke">' . $msg . '</span>'; ?> <div class="form-field"> <input type="text" name="username" id="username" class="form-field-textual"> </div>
            </div>
            <div class="form-item"> <span id="porukaPass" class="bojaPoruke"></span> <label for="pass">Lozinka: </label>
                <div class="form-field">
                    <input type="password" name="pass" id="pass" class="form-field-textual"> </div>
            </div>
            <div class="form-item"> <span id="porukaPassRep" class="bojaPoruke"></span> <label for="passRep">Ponovite
                    lozinku: </label>
                <div class="form-field"> <input type="password" name="passRep" id="passRep" class="form-field-textual">
                </div>
            </div>
            <div class="form-item">
                <label for="admin">Admin?<div class="form-field"> <input type="checkbox" name="admin">
                    </div> </label> </div>

            <div class="form-item"> <button type="submit" value="Registracija" id="slanje" name="registracija">Registracija</button> </div>
        </form>
    </section>
    <script type="text/javascript">
        document.getElementById("slanje").onclick = function(event) {
            var slanjeForme = true; // Ime korisnika mora biti uneseno 
            var poljeIme = document.getElementById("ime");
            var ime = document.getElementById("ime").value;
            if (ime.length == 0) {
                slanjeForme = false;
                poljeIme.style.border = "1px dashed red";
                document.getElementById("porukaIme").innerHTML = "<br>Unesite ime!<br>";
            } else {
                poljeIme.style.border = "1px solid green";
                document.getElementById("porukaIme").innerHTML = "";
            } // Prezime korisnika mora biti uneseno 
            var poljePrezime = document.getElementById("prezime");
            var prezime = document.getElementById("prezime").value;
            if (prezime.length == 0) {
                slanjeForme = false;
                poljePrezime.style.border = "1px dashed red";
                document.getElementById("porukaPrezime").innerHTML = "<br>Unesite prezime!<br>";
            } else {
                poljePrezime.style.border = "1px solid green";
                document.getElementById("porukaPrezime").innerHTML = "";
            } // Korisničko ime mora biti uneseno 
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
            var poljePass = document.getElementById("pass");
            var pass = document.getElementById("pass").value;
            var poljePassRep = document.getElementById("passRep");
            var passRep = document.getElementById("passRep").value;
            if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                slanjeForme = false;
                poljePass.style.border = "1px dashed red";
                poljePassRep.style.border = "1px dashed red";
                document.getElementById("porukaPass").innerHTML = "<br>Lozinke nisu iste!<br>";
                document.getElementById("porukaPassRep").innerHTML = "<br>Lozinke nisu iste!<br>";
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

<?php
if (isset($_POST['registracija'])) {
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $lozinka = $_POST['pass'];
    $razina = isset($_POST['admin']) ? 1 : 0;

    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $registriranKorisnik = ''; //Provjera postoji li u bazi već korisnik s tim korisničkim imenom 
    $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = mysqli_stmt_init($dbc);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, 's', $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }
    if (mysqli_stmt_num_rows($stmt) > 0) {
        $msg = '<section>Korisnik već postoji!</section>';
        echo $msg;
    } else { // Ako ne postoji korisnik s tim korisničkim imenom - Registracija korisnika u bazi pazeći na SQL injection 
        $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, razina)VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
            mysqli_stmt_execute($stmt);
            $registriranKorisnik = true;
            echo "<section>Korisnik je uspješno registriran!</section>";
        }
    }
    mysqli_close($dbc);
}

?>
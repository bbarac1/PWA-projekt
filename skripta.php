<?php session_start();
include 'connect.php';
include 'head-foot.php';

//unos nove vijesti
if (isset($_POST["submit"])) {

    $_SESSION['naslov'] = $_POST['naslov'];
    $_SESSION['ukratko'] = $_POST['ukratko'];
    $_SESSION['sadrzaj'] = $_POST['sadrzaj'];
    $_SESSION['slika'] = $_FILES['slika'];
    $_SESSION['kategorija'] = $_POST['kategorija'];
    $_SESSION['arhiva'] = isset($_POST['arhiva']) ? 1 : 0;

    $naslov = $_SESSION['naslov'];
    $ukratko = $_SESSION['ukratko'];
    $sadrzaj = $_SESSION['sadrzaj'];
    $slika = $_SESSION['slika'];
    $slikaIme = $_SESSION['slika']["name"];
    $slikaTempIme = $_SESSION['slika']["tmp_name"];
    $kategorija = $_SESSION['kategorija'];
    $arhiva = $_SESSION['arhiva'];

    echo '<section>
        <div class="article-group">
        <h1 class="kat-title"><a id="' . $kategorija . '"></a>' . $kategorija . '</h1>
            <article>
                 <h1>' . $naslov . '</h1>';


    $imageData = file_get_contents($_FILES['slika']['tmp_name']);
    // uzima privremenu sliku iz temp foldera
    echo sprintf('<img src="data:image/png;base64,%s" />', base64_encode($imageData));

    echo '<p class="ukratko">' . $ukratko . '</p>
                <p class="sadrzaj">' . nl2br($sadrzaj) . '</p>
            </article>';
    echo '</div>';
    // na klik gumba sprema sliku u folder (JS), a ime u bazu (php) 
    echo '<form action="" method="POST">
    <button type="submit" name="potvrdi" value="potvrdi" onclick="prebaci_sliku()">Potvrdi unos u bazu!</button>

    </form>
    <script>
    function prebaci_sliku(){';
    $target = "img/";
    move_uploaded_file($_FILES['slika']['tmp_name'], "$target/$slikaIme");
    echo ' }
    </script>
    </section>
    <div></div>';
}

if (isset($_POST["potvrdi"])) {

    $naslov = $_SESSION['naslov'];
    $ukratko = $_SESSION['ukratko'];
    $sadrzaj = $_SESSION['sadrzaj'];
    $slika = $_SESSION['slika'];
    $slikaIme = $_SESSION['slika']["name"];
    $kategorija = $_SESSION['kategorija'];
    $arhiva = $_SESSION['arhiva'];

    $query = "INSERT INTO vijesti(naslov, ukratko, sadrzaj, slika, kategorija, arhiva)
VALUES('$naslov', '$ukratko', '$sadrzaj', '$slikaIme', '$kategorija', '$arhiva')";
    $result = mysqli_query($dbc, $query) or die('greška pri dodavanju u bazu!' . mysqli_connect_error());

    echo '<section><p><b>Vijest je unesena!</b></p></section>';
}
?>
<?php header("Location: http://localhost/PWA-projekt-master/index.php");
die();?>

<!-- DEPRECATED - stranica je sad dio "prijava.php" - ne koristiti!!! 

<?php 
session_start();
include 'connect.php';
include 'head-foot.php';


echo '<section><p><b><a href="unos.htm">Unos nove vijesti</a></b></p></section>';


$query = "SELECT * FROM vijesti";
$result = mysqli_query($dbc, $query) or die('greška pri ispisu!' . mysqli_connect_error());

echo '<p>Odaberite podatak koji želite izmijeniti/izbrisati: </p>';
echo '<form action="" method="POST">';
while ($row = mysqli_fetch_array($result)) {
    echo '<input type="radio" name="vijestID" value="' . $row["id"] . '">' . $row["id"] . ' - ' . $row["naslov"] . ' - ' . $row["ukratko"] . '<br />';
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
}//isset izmijeni ?> -->
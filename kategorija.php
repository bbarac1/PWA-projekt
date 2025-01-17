<?php 
include 'connect.php';
include 'head-foot.php';

if (isset($_GET["kat"])) {
    $kat = $_GET["kat"];

    echo '<section>
        <h1>'.$kat.'</h1>
        <div class="article-group">';

    $query = "SELECT * FROM vijesti WHERE kategorija = '$kat' ;";
    $result = mysqli_query($dbc, $query) or die('greška pri ispisu!' . mysqli_connect_error());

    while ($row = mysqli_fetch_array($result)) {
        echo '<article class="narrow">
        <img src="img//' . $row['slika'] . '"/>';
    echo '<h3><a href="clanak.php?id=' . $row['id'] . '">';
    echo $row['naslov'] . '</a></h3>
            <p>' . $row['ukratko'] . '</p>
        </article>';
}
echo '</div></section>';
    }
    ?>
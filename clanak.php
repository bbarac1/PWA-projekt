<?php 
include 'connect.php';
include 'head-foot.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = "SELECT * FROM vijesti WHERE id = '$id' ;";
    $result = mysqli_query($dbc, $query) or die('greška pri ispisu!' . mysqli_connect_error());

    while ($row = mysqli_fetch_array($result)) {
        echo '<section>
        <div class="article-group">
        <h1 class="kat-title"><a id="' . $row['kategorija'] . '"></a>' . $row['kategorija'] . '</h1>
            <article>
                 <h1>' . $row['naslov'] . '</h1>
                <img src="img//' . $row['slika'] . '" />
                <p class="ukratko">' . $row['ukratko'] . '</p>
                <p class="sadrzaj">' . nl2br($row['sadrzaj']) . '</p>
            </article>
            </div></section>';
    } //while
} //if isset

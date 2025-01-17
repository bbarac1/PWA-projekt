<?php
include 'connect.php';

include 'head-foot.php';

//aktualno
echo '<section>
<h1><a id="aktualno"></a>Aktualno</h1>
<div class="article-group">';

$query = "SELECT * FROM vijesti WHERE kategorija = 'Aktualno' AND arhiva = '0'
    ORDER BY dodano DESC LIMIT 4;";
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

//crna kronika
echo '<section>
        <h1><a id="crna_kronika"></a>Crna kronika</h1>
        <div class="article-group">';

$query = "SELECT * FROM vijesti WHERE kategorija = 'Crna kronika' AND arhiva = '0'
            ORDER BY dodano DESC LIMIT 4;";
$result = mysqli_query($dbc, $query) or die('greška pri ispisu!' . mysqli_connect_error());

while ($row = mysqli_fetch_array($result)) {
    echo '
        <article class="narrow">
        <img src="img//' . $row['slika'] . '"/>';
    echo '<h3><a href="clanak.php?id=' . $row['id'] . '">';
    echo $row['naslov'] . '</a></h3>
            <p>' . $row['ukratko'] . '</p>
        </article>';
}
echo '</div></section>';

//politika
echo '<section>
<h1><a id="politika"></a>Politika</h1>
<div class="article-group">';

$query = "SELECT * FROM vijesti WHERE kategorija = 'Politika' AND arhiva = '0'
    ORDER BY dodano DESC LIMIT 4;";
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

//tech
echo '<section>
<h1><a id="tech"></a>Tehnologija</h1>
<div class="article-group">';

$query = "SELECT * FROM vijesti WHERE kategorija = 'Tehnologija' AND arhiva = '0'
    ORDER BY dodano DESC LIMIT 4;";
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

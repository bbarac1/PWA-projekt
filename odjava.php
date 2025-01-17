<?php 
session_start();
session_destroy();
include 'head-foot.php';
echo'<html>
<head>
    <title>Preusmjeravanje...</title>
    <meta http-equiv="refresh" 
content="2;URL=http://localhost/PWA-projekt-master/index.php">
</head>
<body>
<section><p>Uspješno ste odjavljeni!</br>Za dvije sekunde biti ćete preusmjereni na početnu stranicu!</p></section>
</body>
</html>';
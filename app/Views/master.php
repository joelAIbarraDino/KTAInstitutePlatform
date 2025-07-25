<!DOCTYPE html>
<html translate="no">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Cursos de Impuestos aprobados por el IRS de Contabilidad, QB, Inmigración, bookkeeping y mas">
	<meta name="description" content="Cursos de Impuestos aprobados por el IRS de Contabilidad, QB, Inmigración, bookkeeping y mas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Caveat:wght@400..700&family=Dancing+Script:wght@400..700&family=Indie+Flower&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Pacifico&family=Playwrite+HU:wght@100..400&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
    
    <?= $topScripts??''; ?>
    <?php $cssVersion = filemtime('assets/css/app.css'); ?>

    <link rel="stylesheet" href="/assets/css/app.css?v=<?=$cssVersion?>">

    <link rel="shortcut icon" href="/assets/images/logoKTA.ico" />

    <title><?=$nameApp." | ".$title??"% title %"?></title>
</head>
<body>
    
    <?= $content ?>

    <div class="lang-switcher">
        <img class="lang-switcher__flag" id="lang-switcher" src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="Bandera de idiomas">
    </div>

    <?= $scripts??''; ?>
    <?php $translateVersion = filemtime('assets/js/translate.js');  ?>
    <script src="/assets/js/translate.js?v=<?=$translateVersion?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script src="/assets/js/animation.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Cursos de Impuestos aprobados por el IRS de Contabilidad, QB, Inmigración, bookkeeping y mas">
	<meta name="description" content="Cursos de Impuestos aprobados por el IRS de Contabilidad, QB, Inmigración, bookkeeping y mas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--fuentes-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    
    <!--hoja de estilos-->
    <link rel="preload" href="/assets/css/style.css" as="style"> 
    <link rel="stylesheet" href="/assets/css/style.css">

    <!--scripts globales especificos-->
    <?= $headScripts??''; ?>

    <title><?=$nameApp." | ".$title??""?></title>
</head>
<body>
    <?= $content ?>

    <!--scripts generales y especificos-->
    <script src="/assets/js/modernizr.js"></script>
    <?= $footerScripts??''; ?>
</body>
</html>
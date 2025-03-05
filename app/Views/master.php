<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="keywords" content="Cursos de Impuestos aprobados por el IRS de Contabilidad, QB, Inmigración, bookkeeping y mas">
	<meta name="description" content="Cursos de Impuestos aprobados por el IRS de Contabilidad, QB, Inmigración, bookkeeping y mas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!--fuentes-->

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
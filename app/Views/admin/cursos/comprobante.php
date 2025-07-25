<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">

        <div class="top-main">
            <h1 class="top-main__title">Gestión de cursos</h1>
            <a class="btn nuevo" href="/kta-admin/pago-cursos"><i class='bx bx-chevrons-left'></i> Regresar</a>
        </div>

        <div class="form form-admin">
            <legend class="form__title">Comprobante de pago</legend>
                <div class="comprobante-actions">
                    <button id="button-sender" class="comprobante-actions__send" onclick="enviarCorreo(<?=$id_payment?>, <?=$id_student?>)" > <i class='bx bx-mail-send'></i> Enviar comprobante a cliente</button>
                </div>

                <iframe 
                    src="data:application/pdf;base64,<?= $pdfBase64 ?>" 
                    width="100%" 
                    height="900" 
                
                    style="border: none;"
                ></iframe>
        </div>

    </div>
</main>

<?php
    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/sendCourseMail.js"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>
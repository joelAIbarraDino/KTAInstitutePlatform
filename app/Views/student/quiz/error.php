<div class="pagina-resultado">
    <div class="resultado resultado--no-aprobado">
        <h2>No fue esta vez...</h2>
        <p>Sabemos que diste lo mejor de ti.</p>

        <div class="botones">
            <a href="/mis-cursos" class="btn btn--certificado">Mis cursos</a>
            <a href="/quiz/attempts/<?=$uuid?>" class="btn btn--certificado">Volver a intentarlo</a>
        </div>
    </div>
</div>

<script>
    function deshabilitaRetroceso(){
        window.location.hash="no-back-button";
        window.location.hash="Again-No-back-button" //chrome
        window.onhashchange=function(){window.location.hash="";}
    }

    document.querySelector("body").onload = deshabilitaRetroceso;
</script>
<div class="pagina-resultado">
    <div class="resultado resultado--pendiente">
        <h2>¡Buen trabajo!</h2>
        <p>Has terminado el examen. Tu resultado será revisado próximamente.</p>
        
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
<div class="pagina-resultado">
    <div class="resultado resultado--aprobado">
        <h2>¡Felicidades!</h2>
        <p>Has aprobado el examen. Tu esfuerzo ha dado frutos.</p>
        
        <div class="botones">
            <a href="/mis-cursos" class="btn btn--certificado">Mis cursos</a>
            <a href="/quiz/attempts/<?=$uuid?>" class="btn btn--certificado">Volver a intentarlo</a>
            <a href="/certificado/<?=$id?>" target="_blank" class="btn btn--certificado">Ver certificado</a>
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
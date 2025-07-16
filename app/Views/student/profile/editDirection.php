<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="background-profile">
    
    <div class="cover">
        <div class="cover__content">
            <p class="cover__name">¡Hola, <?=$_SESSION['student']['nombre']?>!</p>
            <p class="cover__instructions">Gestiona tu información en un solo lugar: datos personales, historial de compras, membresias y cursos</p>
        </div>
    </div>

    <div class="profile">
        
        <div class="profile__top">
            <p class="profile__title">Dirección</p>
            <a class="profile__edit" href="/mi-perfil"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
        </div>
    
        <form class="profile__content" id="form-profile-data">
            
            <input 
                type="hidden" 
                value="<?=$student->id_student?>"
                id="id_student"
            >

            <div class="profile__data">
                <p class="profile__type">Calle:</p>
                <input 
                    type="text" 
                    placeholder="Calle" 
                    class="profile__input-edit" 
                    value="<?=$student->street?>"
                    id="street"
                >
            </div>

            <div class="profile__data">
                <p class="profile__type">Número:</p>
                <input 
                    type="text" 
                    placeholder="Numero" 
                    class="profile__input-edit" 
                    value="<?=$student->number_street?>"
                    id="number_street"
                >
            </div>

            <div class="profile__data">
                <p class="profile__type">Estado:</p>
                <input 
                    type="text" 
                    placeholder="Estado" 
                    class="profile__input-edit" 
                    value="<?=$student->state?>"
                    id="state"
                >
            </div>

            <div class="profile__data">
                <p class="profile__type">Código postal:</p>
                <input 
                    type="text" 
                    placeholder="Código postal" 
                    class="profile__input-edit" 
                    value="<?=$student->cp?>"
                    id="cp"
                >
            </div>


            <div class="profile__submit-container">
                <input class="profile__submit-btn" type="submit" value="Guardar">
            </div>

        </form>

    </div>

</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 

    $updateUserProfileVersion = filemtime('assets/js/updateDirection.js');

    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/updateDirection.js?v='.$updateUserProfileVersion.'"></script>
    ';
?>
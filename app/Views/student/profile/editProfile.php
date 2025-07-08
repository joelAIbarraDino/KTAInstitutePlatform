<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="background-profile">
    
    <div class="cover">
        <div class="cover__content">
            <p class="cover__name">¡Hola Joel Alejandro!</p>
            <p class="cover__instructions">Gestiona tu información en un solo lugar: datos personales, historial de compras, membresias y cursos</p>
        </div>
    </div>

    <div class="profile">
        
        <?php if(isset($_SESSION['student']['photo'])): ?>
            <div class="profile__photo">
                <img class="toolbar-right__photo" src="<?=$_SESSION['student']['photo']?>" alt="profile picture">    
            </div>
        <?php else:?>
            <div class="profile__photo"><?=$_SESSION['student']['iniciales']?></div>
        <?php endif;?>
        
        <div class="profile__top">
            <p class="profile__title">Datos personales</p>
            <a class="profile__edit" href="/mi-perfil"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
        </div>
    
        <form class="profile__content" id="form-profile-data">
            
            <input 
                type="hidden" 
                value="<?=$student->id_student?>"
                id="id_student"
            >


            <div class="profile__data">
                <p class="profile__type">Nombre:</p>
                <input 
                    type="text" 
                    placeholder="Nombre del módulo" 
                    class="profile__input-edit" 
                    value="<?=$student->name?>"
                    id="name"
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

    $updateUserProfileVersion = filemtime('assets/js/updateUserProfile.js');

    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/updateUserProfile.js?v='.$updateUserProfileVersion.'"></script>
    ';
?>
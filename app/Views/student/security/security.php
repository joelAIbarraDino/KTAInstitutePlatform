<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="background-profile">

    <div class="profile">

        <?php if(isset($_SESSION['student']['photo'])): ?>
            <div class="profile__photo">
                <img class="toolbar-right__photo" src="<?=$_SESSION['student']['photo']?>" alt="profile picture">    
            </div>
        <?php else:?>
            <div class="profile__photo"><?=$_SESSION['student']['iniciales']?></div>
        <?php endif;?>
        
        <div class="profile__top">
            <p class="profile__title">Acceso a perfil</p>
        </div>
    
        <form class="profile__content" id="form-profile-data">
            
            <input 
                type="hidden" 
                value="<?=$student->id_student?>"
                id="id_student"
            >

            <div class="profile__data">
                <p class="profile__type">Contraseña:</p>
                <input 
                    type="password" 
                    placeholder="Ingrese nueva contraseña" 
                    class="profile__input-edit" 
                    value=""
                    id="password"
                >
            </div>

            <div class="profile__submit-container">
                <input class="profile__submit-btn" type="submit" value="Actualizar">
            </div>

        </form>

    </div>

</main>

<?php include_once __DIR__.'/../../components/footer.php'; ?>

<?php 
    $scripts ='
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
        <script src="/assets/js/updatePasswordProfile.js"></script>
    ';
?>
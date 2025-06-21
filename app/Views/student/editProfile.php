<?php include_once __DIR__.'/../components/estudentToolbar.php'; ?>

<main class="background-profile">
    
    <div class="cover">
        <div class="cover__content">
            <p class="cover__name">¡Hola Joel Alejandro!</p>
            <p class="cover__instructions">Gestiona tu información en un solo lugar: datos personales, historial de compras, membresias y cursos</p>
        </div>
    </div>

    <div class="profile">
        <div class="profile__photo">JA</div>
        
        <div class="profile__top">
            <p class="profile__title">Datos personales</p>
            <a class="profile__edit" href="/mi-perfil"><i class='bx bx-left-arrow-alt'></i> Regresar</a>
        </div>
    
        <form class="profile__content" id="form-profile-data">
            
            <div class="profile__data">
                <p class="profile__type">Nombre:</p>
                <input 
                    type="text" 
                    placeholder="Nombre del módulo" 
                    class="profile__input-edit" 
                    value="Joel Aljandro Ibarra Villar"
                    id="new-name"
                >
            </div>

            <div class="profile__data">
                <p class="profile__type">Email:</p>
                <input 
                    type="text" 
                    placeholder="Nombre del módulo" 
                    class="profile__input-edit" 
                    value="Joelvillar35@gmail.com"
                    id="new-email"
                >
            </div>

            <div class="profile__data">
                <p class="profile__type">Telefono:</p>
                <input 
                    type="text" 
                    placeholder="Nombre del módulo" 
                    class="profile__input-edit" 
                    value="55 1412 7503"
                    id="new-phone"
                >
            </div>

            <div class="profile__submit-container">
                <input class="profile__submit-btn" type="submit" value="Guardar">
            </div>

        </form>

    </div>

</main>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>
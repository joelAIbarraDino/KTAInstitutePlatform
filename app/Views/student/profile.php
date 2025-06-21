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
            <a class="profile__edit" href="/editar-perfil"> <i class='bx bx-pencil'></i> Editar</a>
        </div>

        <div class="profile__content">
            
            <div class="profile__data">
                <p class="profile__type">Nombre:</p>
                <p class="profile__value">Joel Alejandro Ibarra Villar</p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Email:</p>
                <p class="profile__value">joelvillar35@gmail.com</p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Telefono:</p>
                <p class="profile__value">+52 5514127503</p>
            </div>

        </div>
    </div>

</main>

<?php include_once __DIR__.'/../components/footer.php'; ?>

<?php 
    $scripts ='
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>
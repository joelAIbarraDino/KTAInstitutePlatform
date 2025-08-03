<?php include_once __DIR__.'/../../components/estudentToolbar.php'; ?>

<main class="background-profile">

    <?php if($membership):?>
        <div class="membresia">
            <div class="membresia__datos">
                <p class="membresia__titulo">Membresia Activa</p>
                <p class="membresia__nivel">Membresía: <span><?=$membership->type?></span></p>
            </div>

            <div class="membresia__fechas">
                <p class="membresia__fecha">Valido hasta: <span><?=date('Y/m/d', strtotime('+'.$membership->max_time_membership.' months', strtotime($membership->created_at)) )?></span></p>
            </div>
        </div>
    <?php endif;?>

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
            <a class="profile__edit" href="/editar-perfil"> <i class='bx bx-pencil'></i> Editar</a>
        </div>

        <div class="profile__content">
            
            <div class="profile__data">
                <p class="profile__type">Nombre:</p>
                <p class="profile__value"><?=$student->name?></p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Email:</p>
                <p class="profile__value"><?=$student->email?></p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Teléfono:</p>
                <p class="profile__value"><?=$student->phone?></p>
            </div>
        </div>
    </div>

    <div class="profile">

        <div class="profile__top">
            <p class="profile__title">Dirección</p>
            <a class="profile__edit" href="/editar-direccion"> <i class='bx bx-pencil'></i> Editar</a>
        </div>

        <div class="profile__content">     
            <div class="profile__data">
                <p class="profile__type">Calle:</p>
                <p class="profile__value"><?=$student->street??"?????" ?></p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Número:</p>
                <p class="profile__value"><?=$student->number_street??"?????" ?></p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Estado:</p>
                <p class="profile__value"><?=$student->state??"?????" ?></p>
            </div>

            <div class="profile__data">
                <p class="profile__type">Código postal:</p>
                <p class="profile__value"><?=$student->cp??"?????" ?></p>
            </div>
        </div>
    </div>

        <div class="profile">

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
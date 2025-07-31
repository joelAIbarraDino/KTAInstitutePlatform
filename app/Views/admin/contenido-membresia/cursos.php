<?php include_once __DIR__.'/../../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <div class="top-main">
            <h1 class="top-main__title">Gestión de membresías</h1>
            <a class="btn nuevo" href="/kta-admin/membresias"><i class='bx bx-left-arrow-alt'></i> Salir</a>
        </div>

        <?php include_once __DIR__.'/../../components/contentMembershipCard.php'; ?>

        <div class="course-options tabs__container">
            <div class="course-options__links">
                <a class="course-options__tab course-options__tab--active" href="/kta-admin/membership-course/<?=$membership->id_membership?>"><i class='bx bxs-video-recording'></i> Cursos self study</a>
                <a class="course-options__tab" href="/kta-admin/membership-live/<?=$membership->id_membership?>"><i class='bx bxl-zoom' ></i> Cursos en vivo</a>
            </div>
        </div>

        <div class="form tabs__container">
            <div class="new-module__title">
                <legend class="form__title">Cursos self study</legend>
                <div id="container-alert" class="course-info__saved course-info__saved--waiting"></div>
            </div>
            <p class="form__instructions">Agrega los cursos self study que tendra la membresía</p>

            <div class="form__input new-module__form">
                <select name="live-cb" id="live-cb" class="field" >
                    <?php foreach($courses as $course): ?>
                        <option value="<?=$course->id_course?>"><?=$course->name?></option>
                    <?php endforeach; ?>
                </select>
                <button id="add_course_btn" type="button" class="new-module__btn"><i class='bx bxs-plus-circle'></i></button>
            </div>
            
            <div id="courses-container" class="courses-membership"></div>

        </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const addBtn = document.getElementById('add_course_btn');
    const selectCourse = document.getElementById('live-cb');
    const coursesContainer = document.getElementById('courses-container');

    // Extrae el ID de membresía desde la URL
    function getMembershipIdFromURL() {
        const parts = window.location.pathname.split('/');
        return parts[parts.length - 1];
    }

    // Crear div de curso
    function createCourseElement(id, name) {
        const div = document.createElement('div');
        div.className = 'course-item';
        div.dataset.id = id;
        div.style.border = '2px solid #C5A900';
        div.style.padding = '10px';
        div.style.marginBottom = '10px';
        div.style.width = '100%';
        div.style.display = 'flex';
        div.style.justifyContent = 'space-between';
        div.style.alignItems = 'center';

        const span = document.createElement('span');
        span.textContent = name;

        const btn = document.createElement('button');
        btn.textContent = 'Eliminar';
        btn.style.backgroundColor = '#000';
        btn.style.color = '#fff';
        btn.style.border = 'none';
        btn.style.padding = '6px 12px';
        btn.style.cursor = 'pointer';

        btn.addEventListener('click', async () => {
            const id_membership = div.dataset.id;
            try {
                const res = await fetch(`/kta-admin/membership-course/delete/${id_membership}`, {
                    method: 'DELETE'
                });
                const data = await res.json();

                if (data.ok) {
                    div.remove();
                }

            } catch (err) {
                console.error('Error al eliminar:', err);
            }
        });

        div.appendChild(span);
        div.appendChild(btn);
        coursesContainer.appendChild(div);
    }


    // Cargar todos los cursos al inicio
    async function loadCourses() {
        const id_membership = getMembershipIdFromURL();
        try {
            const res = await fetch(`/kta-admin/membership-courses/${id_membership}`);
            const data = await res.json();
            const lives = data.lives;
            if (Array.isArray(lives)) {
                lives.forEach(course => {
                    createCourseElement(course.id_membership_course, course.name);
                });
            }
        } catch (err) {
            console.error('Error al cargar cursos:', err);
        }
    }

    // Evento para agregar curso
    addBtn.addEventListener('click', async () => {
        const id_course = selectCourse.value;
        const id_membership = getMembershipIdFromURL();

        const formData = new FormData();
        formData.append('id_course', id_course);
        formData.append('id_membership', id_membership);

        try {
            const res = await fetch('/kta-admin/membership-course/create', {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (data.ok) {
                createCourseElement(data.id, data.name);
            } else {
                alert('No se pudo agregar el curso.');
            }
        } catch (err) {
            console.error('Error al agregar curso:', err);
            alert('Error en el servidor.');
        }
    });

    // Carga inicial
    loadCourses();
});
</script>

<?php

    $scripts = '
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/assets/js/menuDashboard.js"></script>
    ';
?>

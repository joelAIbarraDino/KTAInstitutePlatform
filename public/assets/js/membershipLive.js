(function(){
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
            div.style.backgroundColor ="#000000";
            div.style.borderRadius = '5px';
            div.style.padding = '10px';
            div.style.marginBottom = '10px';
            div.style.width = '100%';
            div.style.display = 'flex';
            div.style.justifyContent = 'space-between';
            div.style.alignItems = 'center';

            const span = document.createElement('span');
            span.textContent = name;
            span.style.color = "#fff";

            const btn = document.createElement('button');
            btn.textContent = 'Eliminar';
            btn.style.backgroundColor = '#3098d4';
            btn.style.color = '#fff';
            btn.style.border = 'none';
            btn.style.padding = '6px 12px';
            btn.style.cursor = 'pointer';

            btn.addEventListener('click', async () => {
                const id_membership = div.dataset.id;
                try {
                    const res = await fetch(`/kta-admin/membership-live/delete/${id_membership}`, {
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
                const res = await fetch(`/kta-admin/membership-lives/${id_membership}`);
                const data = await res.json();
                const lives = data.lives;
                if (Array.isArray(lives)) {
                    lives.forEach(course => {
                        createCourseElement(course.id_membership_live, course.name);
                    });
                }
            } catch (err) {
                console.error('Error al cargar cursos:', err);
            }
        }

        // Evento para agregar curso
        addBtn.addEventListener('click', async () => {
            const id_live = selectCourse.value;
            const id_membership = getMembershipIdFromURL();

            const formData = new FormData();
            formData.append('id_live', id_live);
            formData.append('id_membership', id_membership);

            try {
                const res = await fetch('/kta-admin/membership-live/create', {
                    method: 'POST',
                    body: formData
                });

                const data = await res.json();

                if (data.ok) {
                    createCourseElement(data.id, data.name);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Ha ocurrido un error",
                        text: data.message,
                    });
                }
            } catch (err) {
                console.error('Error al agregar curso:', err);
            }
        });

        // Carga inicial
        loadCourses();
    });
})();
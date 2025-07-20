(function(){
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar');
        const eventListEl = document.getElementById('event-list');

        fetch('/api/lives')
            .then(res => res.json())
            .then(events => {
            // FullCalendar en desktop
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es',
                headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
                },
                events: events,
                eventClick: function(info) {
                info.jsEvent.preventDefault();
                if (info.event.url) {
                    window.location.href = info.event.url;
                }
                }
            });

            calendar.render();

            // Versión lista para móvil
            const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

            const grouped = {};

            events.forEach(event => {
                const date = new Date(event.start);
                const key = `${date.getFullYear()}-${date.getMonth()}`; // Agrupar por mes
                if (!grouped[key]) grouped[key] = [];
                grouped[key].push({
                ...event,
                date,
                day: date.getDate(),
                hour: date.toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit' })
                });
            });

            for (const key in grouped) {
                const date = grouped[key][0].date;
                const monthLabel = `${months[date.getMonth()]} ${date.getFullYear()}`;

                const header = document.createElement('h3');
                header.textContent = monthLabel;
                eventListEl.appendChild(header);

                grouped[key].sort((a, b) => a.date - b.date).forEach(ev => {
                const link = document.createElement('a');
                link.href = ev.url;
                link.className = 'event-item';

                link.innerHTML = `
                    <h4>${ev.title}</h4>
                    <p>${ev.day} ${months[ev.date.getMonth()]} – ${ev.hour}</p>
                `;

                eventListEl.appendChild(link);
                });
            }
            });
        });
})();
(function(){

    document.addEventListener('DOMContentLoaded', function() {
        // Definimos colores manualmente (coincidiendo con los de Sass)
        const colores = {
            azul: '#3588d6',
            azulDarken: '#419df3',
            verde: '#007800',
            dorado: '#CDA02D',
            doradoDarken: '#a07d26',
            rojo: '#a90000',
            blanco: '#ffffff'
        };
    
        // Configuración común para las gráficas
        const commonOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)'
                }
            }
        };
    
        // Gráfica 1 - Ventas mensuales (barras)
        const ctx1 = document.getElementById('grafica1').getContext('2d');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Ventas 2023',
                    data: [12000, 19000, 15000, 18000, 22000, 25000],
                    backgroundColor: colores.azul,
                    borderColor: colores.azulDarken,
                    borderWidth: 1
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                plugins: {
                    ...commonOptions.plugins,
                    title: {
                        display: true,
                        text: 'Ventas Mensuales',
                        font: {
                            size: 16
                        }
                    }
                }
            }
        });
    
        // Resto de las gráficas (usando colores.verde, colores.dorado, etc.)...
        // Gráfica 2 - Satisfacción del cliente (barras)
        const ctx2 = document.getElementById('grafica2').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Satisfacción (%)',
                    data: [85, 88, 90, 89, 92, 94],
                    backgroundColor: colores.verde,
                    borderColor: '#006000',
                    borderWidth: 1
                }]
            },
            options: { /* ... */ }
        });
    
        // Gráfica 3 - Nuevos clientes (barras)
        const ctx3 = document.getElementById('grafica3').getContext('2d');
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Nuevos Clientes',
                    data: [45, 60, 70, 85, 90, 110],
                    backgroundColor: colores.dorado,
                    borderColor: colores.doradoDarken,
                    borderWidth: 1
                }]
            },
            options: { /* ... */ }
        });
    
        // Gráfica 4 - Tendencias (líneas)
        const ctx4 = document.getElementById('grafica4').getContext('2d');
        new Chart(ctx4, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Visitas Web',
                        data: [4500, 5200, 4800, 6100, 7000, 7500],
                        borderColor: colores.azul,
                        backgroundColor: 'rgba(53, 136, 214, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Conversiones',
                        data: [320, 450, 380, 520, 600, 680],
                        borderColor: colores.dorado,
                        backgroundColor: 'rgba(205, 160, 45, 0.1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: { /* ... */ }
        });
    
        // Gráfica 5 - Distribución (dona)
        const ctx5 = document.getElementById('grafica5').getContext('2d');
        new Chart(ctx5, {
            type: 'doughnut',
            data: {
                labels: ['Producto A', 'Producto B', 'Producto C', 'Producto D'],
                datasets: [{
                    data: [35, 25, 20, 20],
                    backgroundColor: [
                        colores.azul,
                        colores.dorado,
                        colores.verde,
                        colores.rojo
                    ],
                    borderColor: colores.blanco,
                    borderWidth: 2
                }]
            },
            options: { /* ... */ }
        });
    });
    
})();
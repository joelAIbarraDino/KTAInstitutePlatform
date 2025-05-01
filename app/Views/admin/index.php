<?php include_once __DIR__.'/../components/adminToolbar.php'; ?>

<main class="main">
    <div class="main__container">
        <h1 class="top-main__title"><?=$bienvenida?></h1>

        <!-- Primera fila: 3 gráficas de barras -->
        <div class="graficas-grid">
            <div class="grafica-container">
                <canvas id="grafica1"></canvas>
            </div>
            <div class="grafica-container">
                <canvas id="grafica2"></canvas>
            </div>
            <div class="grafica-container">
                <canvas id="grafica3"></canvas>
            </div>
        </div>

        <div class="graficas-grid">
            <div class="grafica-container">
                <canvas id="grafica4"></canvas>
            </div>
            <div class="grafica-container">
                <canvas id="grafica5"></canvas>
            </div>
        </div>
        
        <!-- Sección de tarjetas -->
        <div class="tarjetas-grid">
            <div class="tarjeta tarjeta--info">
                <h3 class="tarjeta__titulo">Ventas Totales</h3>
                <p class="tarjeta__valor">$12,450</p>
                <p class="tarjeta__unidad">USD</p>
            </div>
            <div class="tarjeta">
                <h3 class="tarjeta__titulo">Estudiantes registrados</h3>
                <p class="tarjeta__valor">124</p>
                <p class="tarjeta__unidad">Personas</p>
            </div>
            <div class="tarjeta">
                <h3 class="tarjeta__titulo">Estudiantes certificados</h3>
                <p class="tarjeta__valor">120</p>
                <p class="tarjeta__unidad">Personas</p>
            </div>
        </div>

    </div>


</main>

<?php
    $scripts = '
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/assets/js/dashboardCharts.js"></script>    
    <script src="/assets/js/menuDashboard.js"></script>
    ';
?>
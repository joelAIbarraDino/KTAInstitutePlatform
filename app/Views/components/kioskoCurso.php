<div class="kiosko">
    <h2 class="kiosko__titulo">Ultimos Cursos</h2>

    <div class="kiosko__content">
        
        <div class="kiosko__contenedor">
            <!-- Ejemplo de tarjeta de curso -->

            <?php for($i = 0; $i < 10; $i++):?>
                <div class="curso">
                    <div class="curso__imagen-contenedor">
                        <a href="https://www.youtube.com/">
                            <img src="/assets/thumbnails/26338aa4599498816b59136eed229cda.png" alt="Imagen del curso" class="curso__imagen">
                        </a>

                        <span class="curso__categoria">Desarrollo Web</span>
                        <div class="curso__descuento-etiqueta">-20%</div>
                    </div>
                    <div class="curso__contenido">
                        <a href="https://www.youtube.com/"><h3 class="curso__nombre">Curso de HTML y CSS Avanzado</h3></a>
                        <p class="curso__maestro">Por: Juan Pérez</p>
                        <div class="curso__precios">
                            <p class="curso__precio curso__precio--original">$1,200</p>
                            <p class="curso__precio curso__precio--oferta">$960</p>
                        </div>
                        <p class="curso__fecha-descuento">Oferta válida hasta: 30/11/2023</p>
                    </div>
                </div>

                <div class="curso">
                    <div class="curso__imagen-contenedor">
                        <img src="/assets/thumbnails/26338aa4599498816b59136eed229cda.png" alt="Imagen del curso" class="curso__imagen">
                        <span class="curso__categoria">Desarrollo Web</span>
                    </div>
                    <div class="curso__contenido">
                        <h3 class="curso__nombre">Curso de HTML y CSS Avanzado</h3>
                        <p class="curso__maestro">Por: Juan Pérez</p>
                        <div class="curso__precios">
                            <p class="curso__precio curso__precio--normal">$1,200</p>
                        </div>
                    </div>
                </div>

            <?php endfor;?>
            
            <!-- Más cursos se agregarán dinámicamente -->
        </div>
        
        <div class="kiosko__controles">
            <button class="kiosko__boton kiosko__boton--anterior"><i class='bx bx-chevrons-left' ></i></button>
            <button class="kiosko__boton kiosko__boton--siguiente"><i class='bx bx-chevrons-right'></i></button>
        </div>
        
        <div class="kiosko__puntos"></div>
    </div>
</div>
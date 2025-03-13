// Importar módulos necesarios
import gulp from 'gulp';
import dartSass from 'sass';
import gulpSass from 'gulp-sass';
import sourcemaps from 'gulp-sourcemaps';
import cleanCSS from 'gulp-clean-css';
import terser from 'gulp-terser';
import imagemin from 'gulp-imagemin';
import webp from 'gulp-webp';
import avif from 'gulp-avif';
import rename from 'gulp-rename';
import plumber from 'gulp-plumber';
import notify from 'gulp-notify';

const sass = gulpSass(dartSass);

// Configuración de rutas
const paths = {
  sass: {
    src: './src/scss/**/*.scss', // Ruta de los archivos Sass
    dest: './public/assets/css' // Ruta de destino del CSS compilado
  },
  js: {
    src: './src/js/**/*.js', // Ruta de los archivos JS
    dest: './public/assets/js' // Ruta de destino del JS minificado
  },
  images: {
    src: './src/images/**/*.{jpg,png,gif,svg}', // Ruta de las imágenes originales
    dest: './public/assets/images' // Ruta de destino de las imágenes optimizadas
  }
};

// Función para manejar errores
function handleError(err) {
  notify.onError({
    title: "Error en la compilación",
    message: "<%= error.message %>"
  })(err);
  this.emit('end'); // Continuar con las tareas
}

// Compilar Sass, generar sourcemaps y minificar CSS
function compileSass() {
  return gulp.src(paths.sass.src)
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(cleanCSS())
    .pipe(sourcemaps.write('.'))
    .pipe(gulp.dest(paths.sass.dest));
}

// Minificar JS
function minifyJS() {
  return gulp.src(paths.js.src)
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(terser())
    .pipe(gulp.dest(paths.js.dest));
}

// Convertir imágenes a WebP, AVIF y JPG ligero
function optimizeImages() {
  return gulp.src(paths.images.src)
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(imagemin())
    .pipe(gulp.dest(paths.images.dest))
    .pipe(webp())
    .pipe(gulp.dest(paths.images.dest))
    //.pipe(avif())
    //.pipe(gulp.dest(paths.images.dest));
}

// Crear versiones pequeñas de las imágenes
function createThumbnails() {
  return gulp.src(paths.images.src)
    .pipe(plumber({ errorHandler: handleError }))
    .pipe(imagemin())
    .pipe(rename({ suffix: '-thumb' }))
    .pipe(gulp.dest(paths.images.dest));
}

// Monitorear cambios en los archivos
function watchFiles() {
  gulp.watch(paths.sass.src, compileSass);
  gulp.watch(paths.js.src, minifyJS);
  //gulp.watch(paths.images.src, gulp.parallel(optimizeImages, createThumbnails));
}

// Tareas principales
const build = gulp.parallel(compileSass, minifyJS);
const watch = gulp.series(build, watchFiles);

// Exportar tareas
export { compileSass, minifyJS, watch, build };
export default build;
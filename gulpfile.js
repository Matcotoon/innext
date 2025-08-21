const { src, dest, watch, parallel, series } = require('gulp');

// CSS
const sass = require('gulp-sass')(require('sass'));
const plumber = require('gulp-plumber');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const postcss = require('gulp-postcss');
const sourcemaps = require('gulp-sourcemaps');

// Imágenes
const cache = require('gulp-cache');
const imagemin = require('gulp-imagemin');
const webp = require('gulp-webp');
const avif = require('gulp-avif');

// JavaScript con Webpack
const webpackStream = require('webpack-stream');
const webpack = require('webpack');

// Renombrar archivos
const rename = require('gulp-rename');

// Rutas
const paths = {
    scss: 'src/scss/**/*.scss',
    js: 'src/js/**/*.js',
    imagenes: 'src/img/**/*'
};

// --------------------
// CSS
// --------------------
function css() {
    return src(paths.scss)
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass({ outputStyle: 'expanded' }))
        .pipe(postcss([autoprefixer(), cssnano()]))
        .pipe(sourcemaps.write('.'))
        .pipe(dest('public/build/css'));
}

// --------------------
// JavaScript
// --------------------
function javascript() {
    return src(paths.js)
        .pipe(webpackStream({
            mode: 'production',
            entry: './src/js/app.js',
            output: {
                filename: 'bundle.min.js'
            }
        }, webpack))
        .pipe(dest('./public/build/js'));
}

// --------------------
// Imágenes
// --------------------
function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3 })))
        .pipe(dest('public/build/img'));
}

// --------------------
// WebP
// --------------------
function versionWebp() {
    return src(paths.imagenes)
        .pipe(webp({ quality: 50 }))
        .pipe(dest('public/build/img'));
}

// --------------------
// AVIF
// --------------------
function versionAvif() {
    return src(paths.imagenes)
        .pipe(avif({ quality: 50 }))
        .pipe(dest('public/build/img'));
}

// --------------------
// Watch (Desarrollo)
// --------------------
function dev() {
    watch(paths.scss, css);
    watch(paths.js, javascript);
    watch(paths.imagenes, series(imagenes, versionWebp, versionAvif));
}

// --------------------
// Exportar tareas
// --------------------
exports.css = css;
exports.js = javascript;
exports.imagenes = imagenes;
exports.versionWebp = versionWebp;
exports.versionAvif = versionAvif;
exports.dev = parallel(css, imagenes, versionWebp, versionAvif, javascript, dev);
exports.build = parallel(css, imagenes, versionWebp, versionAvif, javascript);

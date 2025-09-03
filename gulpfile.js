import gulpSass from 'gulp-sass'
import * as dartSass from 'sass'
import { src, dest, watch, series } from 'gulp'
import terser from 'gulp-terser';

const sass = gulpSass(dartSass); // compilar sass con gulpsass

export function js( done ) {
    src('src/js/app.js')
        .pipe(terser())
        .pipe(dest('dist/js')) // hace una copia del archivo y la lleva al destino
    done()
}

export function css( done ) {
    src('src/scss/app.scss', {sourcemaps: true})
        .pipe( sass({
            style: 'compressed'
        }).on('error', sass.logError) )
        .pipe( dest('dist/css',  {sourcemaps: '.'}) ) // sabe en que archivo scss esta algun elemento
    done()
}


export function dev() {
    watch('src/scss/**/*.scss', css) // habilitar modo watch para reflejar cambios inmediatamente. el ** indica que busque todos los archivos con extencion .scss
    watch('src/js/**/*.js', js) // lo mismo para javascript
}

export default series( js, css, dev )
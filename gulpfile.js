// Определяем зависимости в переменных
var gulp = require('gulp'),
	debug = require('gulp-debug'),
	// rimraf = require('rimraf'), //для clean
	watch = require('gulp-watch'),
	plumber = require('gulp-plumber'), //(Предохраняем Gulp от вылета)
	include = require('gulp-file-include'), //include
	htmlmin = require('gulp-htmlmin'),
	autoprefixer = require('gulp-autoprefixer'),
	cssComb = require('gulp-csscomb'),
	cleanCss = require('gulp-clean-css'), //minifier
	sourceMaps = require('gulp-sourcemaps'),
	uglifyJs = require('gulp-uglify'),
	imagemin = require('gulp-imagemin'),
	imageminJpegRecompress = require('imagemin-jpeg-recompress'),
	imageminPngquant = require('imagemin-pngquant'),
	spritesmith = require("gulp.spritesmith"), //объединение картинок в спрайты
	browserSync = require('browser-sync'),
	reload = browserSync.reload;


// Создаём js объект в котором прописываем все нужные нам пути
var path = {
	dev: { //Тут мы укажем куда складывать готовые после сборки файлы
        html: 'public/front-assets/',
        js: 'public/front-assets/js/',
        css: 'public/front-assets/css/',
        img: 'public/front-assets/img/',
        fonts: 'public/front-assets/fonts/',
        php: 'public/front-assets/',
        favicon: 'public/front-assets/'
	},
	prod: { //Тут мы укажем куда складывать готовые после сборки файлы
		html: 'public/front-assets/',
		js: 'public/front-assets/js/',
		css: 'public/front-assets/css/',
		img: 'public/front-assets/img/',
		fonts: 'public/front-assets/fonts/',
		php: 'public/front-assets/',
		favicon: 'public/front-assets/'
	},
	src: { //Пути откуда брать исходники
		html: 'resources/assets/*.html', //Синтаксис src/*.html говорит gulp что мы хотим взять все файлы с расширением .html
		js: 'resources/assets/js/main.js',//В стилях и скриптах нам понадобятся только main файлы
		css: 'resources/assets/css/main.css',
		cssPartialsFiles: 'resources/assets/css/partials/*.css', //для форматирования
		cssPartialsFolder: 'resources/assets/css/partials/', //для форматирования
		img: ['resources/assets/img/**/*.*', '!resources/assets/img/icons/*.*'], //Синтаксис img/**/*.* означает - взять все файлы всех расширений из папки и из вложенных каталогов
		icons: 'resources/assets/img/icons/*.*',
		fonts: 'resources/assets/fonts/**/*.*',
		php: 'resources/assets/*.php',
		favicon: 'resources/assets/favicon.{png,ico}'
	},
	watch: { //Тут мы укажем, за изменением каких файлов мы хотим наблюдать
		html: 'src/**/*.html',
		js: 'src/js/**/*.js',
		css: 'src/css/**/*.css',
		img: 'src/img/**/*.*',
		icons: 'src/img/icons/*.*',
		fonts: 'src/fonts/**/*.*',
		php: 'src/*.php',
		favicon: 'src/favicon.{png,ico}'
	},
	cleanDev: './dev',
	cleanProd: './prod'
};

// Создадим переменную с настройками нашего dev сервера:
var config = {
	server: {
		baseDir: "./dev"
		//baseDir: "./prod"
	},
	//tunnel: true,
	host: 'localhost',
	port: 2626,
	logPrefix: "MSerj"
};

// Создадим переменную с настройками плагина plumber для захвата ошибок
var plumberOptions = {
	handleError: function (err) {
		console.log(err);
		this.emit('end');
	}
};

// Создадим переменную с настройками плагина autoprefixer
var autoprefixerOptions = {
	browsers: ['last 5 versions', "ie 9", 'android 4', 'opera 12.1'],
	cascade: false
};

///////////////////////////////dev///////////////////////////////

// Таск для сборки html:
gulp.task('html:dev', function () {
	console.log(reload);
	return gulp.src(path.src.html) //Выберем файлы по нужному пути
		.pipe(debug({title: 'building html:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(include()) //Прогоним через include-file
		.pipe(gulp.dest(path.dev.html)) //Выплюнем их в папку dev
		.pipe(reload({stream: true})); //И перезагрузим наш сервер для обновлений
});

// Таск для сборки js:
gulp.task('js:dev', function () {
	return gulp.src(path.src.js) //Найдем наш main.js файл
		.pipe(debug({title: 'building js:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(include()) //Прогоним через include-file
		.pipe(gulp.dest(path.dev.js)) //Выплюнем готовый файл в dev
		.pipe(reload({stream: true})); //И перезагрузим сервер
});

// Таск для сборки css:
gulp.task('css:dev', function () {
	return gulp.src(path.src.css) //Выберем наш main.css
		.pipe(debug({title: 'building css:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(include()) //Прогоним через include-file
		.pipe(gulp.dest(path.dev.css)) //И в dev
		.pipe(reload({stream: true}));
});

// Таск для создании спрайтов
gulp.task('sprite:dev', function() {
	var spriteData =
		gulp.src(path.src.icons) // путь, откуда берем картинки для спрайта
			.pipe(debug({title: 'building sprite:', showFiles: true}))
			.pipe(spritesmith({
				imgName: 'sprite.png',
				cssName: 'sprite.css',
				algorithm: 'binary-tree',
				padding: 5,
				cssVarMap: function(sprite) {
					sprite.name = 's-' + sprite.name //имя каждого спрайта будет состоять из имени файла и конструкции 's-' в начале имени
				}
			}));
	spriteData.img.pipe(gulp.dest(path.dev.img)); // путь, куда сохраняем картинку
	spriteData.css.pipe(gulp.dest(path.dev.css)); // путь, куда сохраняем стили
});

// Таск для оптимизации изображений
gulp.task('img:dev', function () {
	return gulp.src(path.src.img) //Выберем наши картинки
		.pipe(debug({title: 'Copying img:', showFiles: true}))
        .pipe(plumber(plumberOptions))
		.pipe(gulp.dest(path.dev.img)) //И бросим в dev
		.pipe(reload({stream: true}));
});

// Таск для копирования шрифтов (ничего с ними не делая)
gulp.task('fonts:dev', function() {
	return gulp.src(path.src.fonts)
		.pipe(debug({title: 'Copying fonts:', showFiles: true}))
		.pipe(gulp.dest(path.dev.fonts))
});

// Таск для копирования скриптов (ничего с ними не делая)
gulp.task('php:dev', function() {
	return gulp.src(path.src.php)
		.pipe(debug({title: 'Copying php:', showFiles: true}))
		.pipe(gulp.dest(path.dev.php))
});

// Таск для копирования favicon-а (ничего с ними не делая)
gulp.task('favicon:dev', function() {
	return gulp.src(path.src.favicon)
		.pipe(debug({title: 'Copying favicon:', showFiles: true}))
		.pipe(gulp.dest(path.dev.favicon))
});

// Таск dev который запускает все таски для билда, html js css fonts img
gulp.task('dev', [
	'html:dev',
	'js:dev',
	'css:dev',
	'fonts:dev',
	'php:dev',
	'favicon:dev',
	'img:dev'
]);


// Таск для автоматического запуска нужной задачи при изменении какого то файла
gulp.task('watch', function(){
	watch([path.watch.html], function(event, cb) {
		gulp.start('html:dev');
	});
	watch([path.watch.css], function(event, cb) {
		gulp.start('css:dev');
	});
	watch([path.watch.js], function(event, cb) {
		gulp.start('js:dev');
	});
	watch([path.watch.fonts], function(event, cb) {
		gulp.start('fonts:dev');
	});
	watch([path.watch.php], function(event, cb) {
		gulp.start('php:dev');
	});
	watch([path.watch.favicon], function(event, cb) {
		gulp.start('favicon:dev');
	});
	watch([path.watch.img], function(event, cb) {
		gulp.start('img:dev');
	});
});

// Таск для запуска browserSync сервера с настройками, которые мы определили в объекте config
gulp.task('browserSync', function () {
	browserSync(config);
});

// Таск для форматирования css:
gulp.task('csscomb', function () {
	return gulp.src(path.src.cssPartialsFiles) //Выберем все файлы .css из partials
		.pipe(debug({title: 'cssComb:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(cssComb()) //cssComb
		.pipe(autoprefixer(autoprefixerOptions)) //Добавим вендорные префиксы
		.pipe(gulp.dest(path.src.cssPartialsFolder)) //И заменяем
		.pipe(reload({stream: true}));
});

// Таск для очистки при неоходимости
gulp.task('clean', function (cb, done) {
	// rimraf(path.cleanDev, function(){
	// 	rimraf(path.cleanProd, cb);
	// }); // Очистка dev-а и prod-a (просто удаляет всё из папок)
});

// Дефолтный таск, который будет запускать всю нашу сборку.
gulp.task('default', ['dev', 'browserSync', 'watch']);


///////////////////////////////prod///////////////////////////////////

// Таск для сборки html:
gulp.task('html:prod', function () {
	return gulp.src(path.src.html) //Выберем файлы по нужному пути
		.pipe(debug({title: 'building html:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(include()) //Прогоним через include-file
		//.pipe(htmlmin()) //Минифицируем html
		.pipe(gulp.dest(path.prod.html)) //Выплюнем их в папку prod
		.pipe(reload({stream: true})); //И перезагрузим наш сервер для обновлений
});

// Таск для сборки js:
gulp.task('js:prod', function () {
	return gulp.src(path.src.js) //Найдем наш main.js файл
		.pipe(debug({title: 'building js:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(include()) //Прогоним через include-file
		.pipe(sourceMaps.init()) //Инициализируем sourcemap
		.pipe(uglifyJs()) //Сожмем наш js
		.pipe(sourceMaps.write('../sourceMaps')) //Пропишем карты
		.pipe(gulp.dest(path.prod.js)) //Выплюнем готовый файл в prod
		.pipe(reload({stream: true})); //И перезагрузим сервер
});

// Таск для сборки css:
gulp.task('css:prod', function () {
	return gulp.src(path.src.css) //Выберем наш main.css
		.pipe(debug({title: 'building css:', showFiles: true}))
		.pipe(plumber(plumberOptions))
		.pipe(include()) //Прогоним через include-file
		.pipe(sourceMaps.init()) //Инициализируем sourcemap
		.pipe(autoprefixer(autoprefixerOptions)) //Добавим вендорные префиксы
		.pipe(cleanCss({compatibility: 'ie9'})) //cleanCss
		.pipe(sourceMaps.write('../sourceMaps'))
		.pipe(gulp.dest(path.prod.css)) //И в prod
		.pipe(reload({stream: true}));
});

// Таск для создании спрайтов
gulp.task('sprite:prod', function() {
	var spriteData =
		gulp.src(path.src.icons) // путь, откуда берем картинки для спрайта
			.pipe(debug({title: 'building sprite:', showFiles: true}))
			.pipe(spritesmith({
				imgName: 'sprite.png',
				cssName: 'sprite.css',
				algorithm: 'binary-tree',
				padding: 5,
				cssVarMap: function(sprite) {
					sprite.name = 's-' + sprite.name //имя каждого спрайта будет состоять из имени файла и конструкции 's-' в начале имени
				}
			}));
	spriteData.img.pipe(gulp.dest(path.prod.img)); // путь, куда сохраняем картинку
	spriteData.css.pipe(gulp.dest(path.prod.css)); // путь, куда сохраняем стили
});

// Таск для оптимизации изображений
gulp.task('img:prod', function () {
	return gulp.src(path.src.img) //Выберем наши картинки
		.pipe(debug({title: 'building img:', showFiles: true}))
        .pipe(plumber(plumberOptions))
        .pipe(gulp.dest(path.prod.img))
		.pipe(imagemin([
			imagemin.gifsicle({interlaced: true}),
			//imagemin.jpegtran({progressive: true}),
			//imagemin.optipng({optimizationLevel: 3}), //optimizationLevel - это кол-во проходов, диапазон 0-7
			imageminJpegRecompress({
				progressive: true,
				max: 80,
				min: 70
			}),
			imageminPngquant({quality: '80'}),
			imagemin.svgo({plugins: [{removeViewBox: true}]})
		]))
		.pipe(gulp.dest(path.prod.img)) //И бросим в prod
		.pipe(reload({stream: true}));
});

// Таск для копирования шрифтов (ничего с ними не делая)
gulp.task('fonts:prod', function() {
	return gulp.src(path.src.fonts)
		.pipe(debug({title: 'Copying fonts:', showFiles: true}))
		.pipe(gulp.dest(path.prod.fonts))
});

// Таск для копирования скриптов (ничего с ними не делая)
gulp.task('php:prod', function() {
	return gulp.src(path.src.php)
		.pipe(debug({title: 'Copying php:', showFiles: true}))
		.pipe(gulp.dest(path.prod.php))
});

// Таск для копирования favicon-а (ничего с ними не делая)
gulp.task('favicon:prod', function() {
	return gulp.src(path.src.favicon)
		.pipe(debug({title: 'Copying favicon:', showFiles: true}))
		.pipe(gulp.dest(path.prod.favicon))
});

// Таск, который будет запускать всю нашу сборку.
gulp.task('prod', [
	'html:prod',
	'js:prod',
	'css:prod',
	'fonts:prod',
	'php:prod',
	'favicon:prod',
	'img:prod'
]);
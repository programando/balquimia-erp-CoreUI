let mix = require('laravel-mix');

   mix.js(['resources/assets/js/app.js',
        ], 'public/js/Vue-App.js' );

   mix.scripts([
      'resources/assets/js/vendors/toastr.js',
    ], 'public/js/app.js'    ) ;// Archivo de salida JS

   mix.styles ([
        'resources/assets/css/vendor/toastr.css',
        'resources/assets/css/app.css',
       ], 'public/css/app.css') ;     // Archivo de salida CSS

    mix.browserSync({
      proxy: 'http://balquimia-erp-CoreUI.local',
      open: false,
      //browser : 'Google Chrome',
    });

    mix.disableNotifications();


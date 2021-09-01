// Place third party dependencies in the lib folder
//
// Configure loading modules from the lib directory,
requirejs.config({
    "baseUrl": "js/plugin",
    "paths": {
        "app": "../app",
        // "jquery" : "//code.jquery.com/jquery-2.1.1.min",
        "bootstrap" :  "//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min",
        // "swiper":"cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.min",
        "carosoul":"https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min",
        "sweetalert":"https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min",
    },
    // waitSeconds: 15,
    shim : {
        "bootstrap" : { "deps" :['jquery-3.5.1.min'] },
        "sticky" : { "deps" :['jquery-3.5.1.min'] },
        "carosoul" : { "deps" :['jquery-3.5.1.min'] },
        "swiper.min": { "deps" : ['jquery-3.5.1.min'] },
        "script" : { "deps" :['jquery-3.5.1.min','carosoul'] },
        "mainindex" : { "deps" :['jquery-3.5.1.min'] },
        "slick" : { "deps" :['jquery-3.5.1.min'] },
        "bucket" : { "deps" :['jquery-3.5.1.min'] },
        "compare" : { "deps" :['jquery-3.5.1.min'] },
        "nicescroll" : { "deps" :['jquery-3.5.1.min'] },
        "showtrip" : { "deps" :['jquery-3.5.1.min'] },
    },
});

// Load the main app module to start the app
requirejs(["app/main"]);


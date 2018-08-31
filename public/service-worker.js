var version = 'v1::';

self.addEventListener("install", function (event) {
    try {

        //console.log('WORKER: install event in progress.');
        event.waitUntil(
            caches
                .open(version + 'fundamentals')
                .then(function (cache) {
                    return cache.addAll([
                        '/',
                        'https://'+location.hostname+'/',
                        'https://'+location.hostname+'/wp-content/plugins/wordpress-mobile-pack-pro/frontend/themes/app14/css/bundle.css',
                        'https://'+location.hostname+'/wp-content/plugins/wordpress-mobile-pack-pro/frontend/export/content.php?content=androidmanifest',
                        'https://'+location.hostname+'/wp-content/plugins/wordpress-mobile-pack-pro/frontend/themes/app14/images/logo/logo-black.svg'
                    ]);
                })
                .then(function () {
                    //console.log('WORKER: install completed');
                })
        );

    }
    catch (error) {
        console.log(error);
    }

    
    

});

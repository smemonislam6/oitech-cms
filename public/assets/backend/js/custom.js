(function ($) {
    "use strict";
    $(".magnific").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
    });

    tinymce.init({
        selector: '.editor',
        height : '350',
        plugins: 'link',
        toolbar: "styleselect | bold italic | alignleft aligncenter alignright alignjustify | link",
        menubar: false,
        branding: false,
        style_formats: [
            { title: 'Heading 1', format: 'h1' },
            { title: 'Heading 2', format: 'h2' },
            { title: 'Heading 3', format: 'h3' },
            { title: 'Heading 4', format: 'h4' },
            { title: 'Heading 5', format: 'h5' },
            { title: 'Heading 6', format: 'h6' },
            { title: 'Paragraph', format: 'p' }
        ]
    });

    

})(jQuery);



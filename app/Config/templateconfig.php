<?php

namespace App\Configs;

return [
    'template' => [
        'wrapper_start'     => TEMPLATE_PATH . 'wrapperstart.php',
        'header'            => TEMPLATE_PATH . 'header.php',
        'nav'               => TEMPLATE_PATH . 'nav.php',
        'view'              => ':action_view',
        'wrapperend'        => TEMPLATE_PATH . 'wrapperend.php',
    ],
    'header_resources' => [
        'css' => [
            'style'         => CSS . 'style.css',
//            'datatable'     => CSS . 'https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css',
        ],
        'js' => [
//            'datatable'     => JS . 'https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js',
//            'main'          => JS . 'https://code.jquery.com/jquery-3.6.0.min.js',
//            'datatableEn'   => JS . 'datatablesen.js',
//            'datatableAr'   => JS . 'datatablesar.js',

        ]
    ],
    'footer_resources'      => [

    ]
];

<?php
/*
 * Secret key and Site key get on https://www.google.com/recaptcha
 * */
return [
    'secret' => env('CAPTCHA_SECRET', '6LeKIVIUAAAAAJebg_VFJXCadoQD392Kp7v1TDl6'),
    'sitekey' => env('CAPTCHA_SITEKEY', '6LeKIVIUAAAAANv5JOovtxJGGb-qLcOjcQJps2pU'),
    /**
     * @var string|null Default ``null``.
     * Custom with function name (example customRequestCaptcha) or class@method (example \App\CustomRequestCaptcha@custom).
     * Function must be return instance, read more in folder ``examples``
     */
    'request_method' => null,
    'attributes' => [
        'data-theme' => 'dark',
    ]
];
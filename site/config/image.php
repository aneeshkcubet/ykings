<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',
    'profileOriginalPath' => public_path('uploads/images/profile/original/'),
    'profileSmallPath' => public_path('uploads/images/profile/small/'),
    'profileMediumPath' => public_path('uploads/images/profile/medium/'),
    'profileLargePath' => public_path('uploads/images/profile/large/'),

);

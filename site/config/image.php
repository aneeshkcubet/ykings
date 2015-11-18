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
    'feedOriginalPath' => public_path('uploads/images/feed/original/'),
    'feedSmallPath' => public_path('uploads/images/feed/small/'),
    'feedMediumPath' => public_path('uploads/images/feed/medium/'),
    'feedLargePath' => public_path('uploads/images/feed/large/'),

);

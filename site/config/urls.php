<?php
return [
    'urls' => [
        'profileImageSmall' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/profile/small' : asset('uploads/images/profile/small'),
        'profileImageMedium' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/profile/medium' : asset('uploads/images/profile/medium'),
        'profileImageLarge' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/profile/large' : asset('uploads/images/profile/large'),
        'profileImageOriginal' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/profile/original' : asset('uploads/images/profile/original'),
        'video' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/videos' : asset('uploads/videos'),
        'videothumbnail' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/videothumbnails' : asset('/uploads/images/videothumbnails'),
        'feedImageSmall' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/feed/small' : asset('uploads/images/feed/small'),
        'feedImageMedium' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/feed/medium' : asset('uploads/images/feed/medium'),
        'feedImageLarge' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/feed/large' : asset('uploads/images/feed/large'),
        'feedImageOriginal' => (PHP_SAPI === 'cli') ? 'http://localhost:8000/uploads/images/feed/original' : asset('uploads/images/feed/original'),
    ]
];


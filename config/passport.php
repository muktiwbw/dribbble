<?php

return [
  'personal_access_client' => [
    'id' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_ID'),
    'secret' => env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'),
  ],
  'password_grant_client' => [
    'id' => env('PASSPORT_PASSWORD_GRANT_CLIENT_ID'),
    'secret' => env('PASSPORT_PASSWORD_GRANT_CLIENT_SECRET'),
  ]
];
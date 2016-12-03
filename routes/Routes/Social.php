<?php

Route::get('/auth/{provider}/redirect', [
    'as' => 'social_redirect',
    'uses' => 'SocialAuthController@redirect'
]);

Route::get('/auth/{provider}/callback', [
    'as' => 'social_handle',
    'uses' => 'SocialAuthController@callback'
]);
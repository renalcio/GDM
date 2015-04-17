<?php
// Include helper classes
require 'class/apibase.php';
require 'class/socket.php';
require 'class/cache.php';

// Include all files of the API
// TODO: Allow some to be missing
require 'api/album.php';
require 'api/artist.php';
require 'api/auth.php';
require 'api/event.php';
require 'api/geo.php';
require 'api/group.php';
require 'api/library.php';
require 'api/playlist.php';
require 'api/radio.php';
require 'api/tag.php';
require 'api/tasteometer.php';
require 'api/track.php';
require 'api/user.php';
require 'api/venue.php';

function StartLFM($type = 'track'){
    $LFMVars = Array(
        'Auth'   => array(
            'apiKey' => '53b09495de54c998614b6d350a5c2d3e',
            'secret' => 'e9078c1093677fe780017fc1b629c3a1',
            'username' => 'renalcio',
            'sessionKey' => '',
            'subscriber' => ''
        ),
        'Config' => array(
            'enabled' => true,
            'path' => APP . 'Libs/lastfm/',
            'cache_length' => 1800
        )
    );

    // Pass the array to the auth class to eturn a valid auth
    $auth = new lastfmApiAuth('setsession', $LFMVars['Auth']);

    $apiClass = new lastfmApi();
    return $apiClass->getPackage($auth, $type, $LFMVars['Config']);
}

?>
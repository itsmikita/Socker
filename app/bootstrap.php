<?php

mb_internal_encoding( 'UTF-8' );
mb_http_output( 'UTF-8' );

use Toolbox\HTTP;

include 'config.php';
include 'autoload.php';
include 'events.php';
include 'routes.php';

HTTP::process();

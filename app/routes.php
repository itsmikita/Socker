<?php

use Toolbox\HTTP;
use Resources\Home;

HTTP::on( '/', function() {
	Home::display();
} );
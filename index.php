<?php

use WebServer\App;
use WebServer\BracketFactory;
use WebServer\HTTPRequest;
use WebServer\HTTPResponse;

require __DIR__ . "/vendor/autoload.php";

$app = new App(new HTTPRequest(), new HTTPResponse(), new BracketFactory());
$app->run();
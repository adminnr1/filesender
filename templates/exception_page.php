<?php

if(!array_key_exists('exception', $_REQUEST))
    throw new DetailedException('exception_not_found', '');

$_REQUEST['exception'] = base64_encode(preg_replace('`\{(tr:)*(cfg|conf|config):([^}]+)\}`', '', base64_decode($_REQUEST['exception'])));

$exception = StorableException::unserialize($_REQUEST['exception']);

Template::display('exception', array('exception' => $exception));

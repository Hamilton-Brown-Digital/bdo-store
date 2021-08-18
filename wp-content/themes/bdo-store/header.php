<?php

if (class_exists( 'Timber' )) {
    $GLOBALS['timberContext'] = Timber::get_context();
    ob_start();
}
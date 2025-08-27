<?php

/**
 * Template Name: Home
 */

use Timber\Timber;

Timber::render('home.twig', [
    ...Timber::context(),
]);

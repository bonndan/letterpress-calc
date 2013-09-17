<?php

$config = new Letterpress\Config();

$app['config'] = function () use ($config) {
    return $config;
};

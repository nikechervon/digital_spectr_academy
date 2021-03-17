<?php

// Общий namespace
$router->setNamespace('App\Controller');

// Роут для вывода шаблона на страницу (GET)
$router->get('/', 'MainController@show');

// Роут обработчик (POST)
$router->post('/check', 'MainController@validationYear');

<?php
/**
 * Возвращение главной страницы модуля Backend
 * @url /backend
 */
Route::get('/test', [
    'controller'	=>  'FrontendController',
    'action'		=>  'home',
]);

Route::get('/test/1', [
    'controller'	=>  'FrontendController',
    'action'		=>  'home',
]);
<?php
/**
 * Возвращение главной страницы модуля Backend
 * @url /backend
 */
Route::get('/', [
    'controller'	=>  'BackendController',
    'action'		=>  'home'
]);

Route::get('/admin', [
    'controller'	=>  'BackendController',
    'action'		=>  'dashboard',
    'map'           => false
]);

Route::get('/admin/login', [
    'controller'	=>  'BackendController',
    'action'		=>  'login'
]);
<?php
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';
require_once 'core/special_function.php';

//Возможные пути, невозможные отсылаются на 404
//error page
Route::addUrl('/404/');
//main page
Route::addUrl("/main/");
//account page
Route::addUrl("/account/");
Route::addUrl("/account/^login$/");
Route::addUrl("/account/^signup$/");
Route::addUrl("/account/^logout$/");
Route::addUrl("/account/^profile$/");
Route::addUrl("/account/^[a-z0-9A-Z]*$/");
//articles page
Route::addUrl("/articles/");
Route::addUrl("/articles/^all$/");
Route::addUrl("/articles/^[0-9]+$/");
Route::addUrl("/articles/^create$/");
Route::addUrl("/articles/^category$/");
//create_article page
//Route::addUrl("/create_article/");

//learn pages
Route::addUrl("/learn_php/");
Route::addUrl("/learn_html/");

//category page
Route::addUrl('/category/');
Route::addUrl('/category/^[0-9]+$/');

//upload page
Route::addUrl('/upload/');




//Route::add("articles","~");
//Route::add("account");
//Route::add("articles", "^[0-9]$");
Route::start(); // запускаем маршрутизатор


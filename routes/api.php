<?php

Route::get('/currencies', 'CurrencyController@index')->name('currency.index');
Route::get('/currencies/{rate}', 'CurrencyController@show')->name('currency.show');

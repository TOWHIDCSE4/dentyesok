<?php

use Illuminate\Support\Facades\Route;



Route::post('register', 'OrganizationController@register')->name('api.customer.register');
Route::post('login', 'Auth\LoginController@login')->name('api.customer.login');

Route::get('profile', 'UserController@getProfile')->name('api.user.profile');
Route::post('profile', 'UserController@updateProfile')->name('api.user.profile.update');
Route::post('pwd', 'UserController@updatePassword')->name('api.user.password.update');

Route::get('com/profile', 'OrganizationController@getProfile')->name('api.com.profile');
Route::post('com/profile', 'OrganizationController@updateProfile')->name('api.com.profile.update');

//Employee
Route::apiResource('employees','EmployeeController');

//Role
Route::apiResource('roles','RoleController');
Route::get('role','RoleController@roleList')->name('api.role.roleList');


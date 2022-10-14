<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'OrganizationController@register')->name('api.customer.register');
Route::post('login', 'Auth\LoginController@login')->name('api.customer.login');

Route::get('profile', 'UserController@getProfile')->name('api.user.profile');
Route::post('profile', 'UserController@updateProfile')->name('api.user.profile.update');
Route::post('pwd', 'UserController@updatePassword')->name('api.user.password.update');

Route::get('com/profile', 'OrganizationController@getProfile')->name('api.com.profile');
Route::post('com/profile', 'OrganizationController@updateProfile')->name('api.com.profile.update');

//Employee
Route::get('employees','EmployeeController@allData')->name('api.employee.allData');
Route::post('employees/store','EmployeeController@store')->name('api.employee.createEmployee');
Route::post('employees/update/{id}','EmployeeController@update')->name('api.employee.updateEmployee');
Route::delete('employee/delete/{id}','EmployeeController@destroy')->name('api.employee.deleteEmployee');

//Role
Route::get('role','RoleController@roleList')->name('api.role.roleList');
Route::get('roles','RoleController@index')->name('api.role.allData');
Route::post('roles','RoleController@store')->name('api.role.createRole');
Route::post('roles/{id}','RoleController@update')->name('api.role.updateRole');
Route::delete('roles/{id}','RoleController@destroy')->name('api.role.deleteRole');

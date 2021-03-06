<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/* ================== Homepage ================== */

// Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@index');

Route::auth();

/* ================== Dashboard ================== */

Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
Route::get('/', 'LA\DashboardController@index');
// Route::get('/dashboard', 'LA\DashboardController@index');

/* ================== Users ================== */
Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');

/* ================== Uploads ================== */
Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');
Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');

/* ================== Roles ================== */
Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');

/* ================== Departments ================== */
Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');

/* ================== Employees ================== */
Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');

/* ================== Organizations ================== */
Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

/* ================== Cards ================== */
Route::resource(config('laraadmin.adminRoute') . '/cards', 'LA\CardsController');
Route::get(config('laraadmin.adminRoute') . '/card_dt_ajax', 'LA\CardsController@dtajax');

/* ================== GroupTypes ================== */
Route::resource(config('laraadmin.adminRoute') . '/grouptypes', 'LA\GroupTypesController');
Route::get(config('laraadmin.adminRoute') . '/grouptype_dt_ajax', 'LA\GroupTypesController@dtajax');

/* ================== CardGroups ================== */
Route::resource(config('laraadmin.adminRoute') . '/cardgroups', 'LA\CardGroupsController');
Route::get(config('laraadmin.adminRoute') . '/cardgroup_dt_ajax', 'LA\CardGroupsController@dtajax');
Route::get(config('laraadmin.adminRoute') . '/cardviewbygroup/{typeid?}', 'LA\CardGroupsController@cardviewbytype');

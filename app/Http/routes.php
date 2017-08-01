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
// 静态页面：主页，关于页，帮助页
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('/signup','UsersController@create')->name('signup');//用户注册
Route::get('/company_signup','CompanyController@create')->name('company_signup');//公司注册
Route::get('/sms','UsersController@sms')->name('sms');//发送短信验证码
resource('users', 'UsersController');//用户CURD
resource('manager', 'ManagerController');//管理员CURD
resource('company', 'CompanyController');//公司CURD

get('login', 'SessionsController@create')->name('login');//用户登录
post('login', 'SessionsController@store')->name('login');//用户登录
get('mana_login', 'SessionsController@mana_create')->name('mana_login');//管理员登录
post('mana_login', 'SessionsController@mana_store')->name('mana_login');//管理员登录
get('company_login', 'SessionsController@company_create')->name('company_login');//公司登录
post('company_login', 'SessionsController@company_store')->name('company_login');//公司登录
delete('logout', 'SessionsController@destroy')->name('logout');//用户登出

get('password/reset', 'UsersController@getReset')->name('password.reset');//找回密码
post('password/reset', 'UsersController@postRset')->name('password.reset');//找回密码

Route::get('/company_manage/{id}','ManagerController@company_manage_index')->name('company_manage');//管理员管理二级公司主页面
Route::get('/forms_manage/{id}','ManagerController@forms_manage')->name('forms_manage');//管理员查看统计报表界面
Route::post('/audit/{id}','ManagerController@audit')->name('audit');//审核通过二级公司信息
Route::post('/refuse_audit/{id}','ManagerController@refuse_audit')->name('refuse_audit');//驳回二级公司信息
Route::get('/users_manage/{id}','ManagerController@users_manage')->name('users_manage');//管理员管理用户主页面

Route::get('/join_company/{id}','UsersController@join_company')->name('join_company');//用户加入二级公司页面
Route::post('/join_in/{company_id}','UsersController@join_in')->name('join_in');//用户加入二级公司
Route::get('employee_manage/{id}','CompanyController@employee_manage')->name('employee_manage');//公司管理员工主页面
Route::get('employee_audit_index/{id}','CompanyController@employee_audit_index')->name('employee_audit_index');//公司员工审核页面
Route::post('employee_audit/{id}','CompanyController@employee_audit')->name('employee_audit');//员工审核通过
Route::post('employee_refuse_audit/{id}','CompanyController@employee_refuse_audit')->name('employee_refuse_audit');//拒绝员工
Route::post('employee_delete/{id}','CompanyController@employee_delete')->name('employee_delete');//公司移除员工
Route::get('monitor','CompanyController@monitor')->name('monitor');//增加entity主页面



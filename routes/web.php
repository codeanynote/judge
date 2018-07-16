<?php

Route::get('/', ['as' => 'auth.showlogin', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('auth/login', ['as' => 'auth.login', 'uses' => 'Auth\LoginController@login']);
Route::get('auth/logout', ['as' => 'auth.logout', 'uses' => 'Auth\LoginController@logout']);
// Registration routes...
Route::get('auth/register', ['as' => 'user.create', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
Route::post('auth/register', ['as' => 'user.store', 'uses' => 'Auth\RegisterController@register']);

//Dashboard routes...
Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);

//Judge routes...
Route::get('/judge/list', ['as' => 'judge.list', 'uses' => 'JudgeController@index']);
Route::get('/judge/create', ['as' => 'judge.create', 'uses' => 'JudgeController@create']);
Route::post('/judge/create', ['as' => 'judge.create', 'uses' => 'JudgeController@createAction']);
Route::get('/judge/detail/{id}', ['as' => 'judge.detail', 'uses' => 'JudgeController@detail']);
Route::get('/judge/edit/{id}', ['as' => 'judge.edit', 'uses' => 'JudgeController@edit']);
Route::post('/judge/update', ['as' => 'judge.update', 'uses' => 'JudgeController@update']);
Route::get('/judge/delete/{id}', ['as' => 'judge.delete', 'uses' => 'JudgeController@delete']);
Route::get('/judge/export', ['as' => 'judge.export', 'uses' => 'JudgeController@export']);
Route::get('/judge/print', ['as' => 'judge.print', 'uses' => 'JudgeController@printing']);
Route::get('/judge/active/{id}/{isactive}', ['as' => 'judge.active', 'uses' => 'JudgeController@active']);
Route::get('/judge/membership_paid_up/{id}/{ispaid}', ['as' => 'judge.membership_paid_up', 'uses' => 'JudgeController@membership_paid_up']);

//Event routes...
Route::get('/event/list', ['as' => 'event.list', 'uses' => 'EventController@index']);
Route::get('/event/create', ['as' => 'event.create', 'uses' => 'EventController@create']);
Route::post('/event/create', ['as' => 'event.create', 'uses' => 'EventController@createAction']);
Route::get('/event/detail/{id}', ['as' => 'event.detail', 'uses' => 'EventController@detail']);
Route::get('/event/edit/{id}', ['as' => 'event.edit', 'uses' => 'EventController@edit']);
Route::post('/event/update', ['as' => 'event.update', 'uses' => 'EventController@update']);
Route::get('/event/delete/{id}', ['as' => 'event.delete', 'uses' => 'EventController@delete']);
Route::get('/event/export', ['as' => 'event.export', 'uses' => 'EventController@export']);
Route::get('/event/print', ['as' => 'event.print', 'uses' => 'EventController@printing']);

Route::get('/ljinfo', ['as' => 'event.ljinfo', 'uses' => 'EventController@ljinformation']);
Route::get('/ljinfo/get', ['as' => 'event.ljinfo.get', 'uses' => 'EventController@getLjInfo']);
Route::post('/ljinfo', ['as' => 'event.ljinfo.update', 'uses' => 'EventController@ljinformationUpdate']);


//Duty routes...
Route::get('/duty/list', ['as' => 'duty.index', 'uses' => 'DutyController@index']);
Route::get('/duty/update', ['as' => 'duty.update', 'uses' => 'DutyController@update']);
Route::get('/duty/export', ['as' => 'duty.export', 'uses' => 'DutyController@export']);
Route::get('/duty/print', ['as' => 'duty.print', 'uses' => 'DutyController@printing']);
Route::get('/duty/event', ['as' => 'duty.event', 'uses' => 'DutyController@event']);
Route::get('/duty/event/export', ['as' => 'duty.event.export', 'uses' => 'DutyController@event_export']);
Route::get('/duty/event/print', ['as' => 'duty.event.print', 'uses' => 'DutyController@event_printing']);





//Account routes...
Route::get('/account/list', ['as' => 'account.list', 'uses' => 'AccountController@index']);
Route::get('/account/create', ['as' => 'account.create', 'uses' => 'AccountController@create']);
Route::post('/account/create', ['as' => 'account.create', 'uses' => 'AccountController@createAction']);
Route::get('/account/detail/{id}', ['as' => 'account.detail', 'uses' => 'AccountController@detail']);
Route::get('/account/edit/{id}', ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
Route::post('/account/update', ['as' => 'account.update', 'uses' => 'AccountController@update']);
Route::get('/account/delete/{id}', ['as' => 'account.delete', 'uses' => 'AccountController@delete']);
Route::get('/account/export', ['as' => 'account.export', 'uses' => 'AccountController@export']);
Route::get('/account/print', ['as' => 'account.print', 'uses' => 'AccountController@printing']);
Route::get('/account/password/change', ['as' => 'account.password.change', 'uses' => 'AccountController@passwordChange']);
Route::post('/account/password/update', ['as' => 'account.password.update', 'uses' => 'AccountController@passwordUpdate']);

// Country Routes
Route::get('country/list', ['as' => 'country.list', 'uses' => 'CountryController@index']);
Route::post('country/save', ['as' => 'country.save', 'uses' => 'CountryController@save']);
Route::get('country/detail/{id}', ['as' => 'country.detail', 'uses' => 'CountryController@detail']);
Route::get('country/edit/{id}', ['as' => 'country.edit', 'uses' => 'CountryController@edit']);
Route::post('country/update', ['as' => 'country.update', 'uses' => 'CountryController@update']);
Route::get('country/delete/{id}', ['as' => 'country.delete', 'uses' => 'CountryController@delete']);

// Skill levels Routes
Route::get('skill/list', ['as' => 'skill.list', 'uses' => 'SkillController@index']);
Route::post('skill/save', ['as' => 'skill.save', 'uses' => 'SkillController@save']);
Route::get('skill/detail/{id}', ['as' => 'skill.detail', 'uses' => 'SkillController@detail']);
Route::get('skill/edit/{id}', ['as' => 'skill.edit', 'uses' => 'SkillController@edit']);
Route::post('skill/update', ['as' => 'skill.update', 'uses' => 'SkillController@update']);
Route::get('skill/delete/{id}', ['as' => 'skill.delete', 'uses' => 'SkillController@delete']);

// Event levels Routes
Route::get('event_level/list', ['as' => 'event_level.list', 'uses' => 'EventLevelController@index']);
Route::post('event_level/save', ['as' => 'event_level.save', 'uses' => 'EventLevelController@save']);
Route::get('event_level/detail/{id}', ['as' => 'event_level.detail', 'uses' => 'EventLevelController@detail']);
Route::get('event_level/edit/{id}', ['as' => 'event_level.edit', 'uses' => 'EventLevelController@edit']);
Route::post('event_level/update', ['as' => 'event_level.update', 'uses' => 'EventLevelController@update']);
Route::get('event_level/delete/{id}', ['as' => 'event_level.delete', 'uses' => 'EventLevelController@delete']);

// Region Routes
Route::get('region/list', ['as' => 'region.list', 'uses' => 'RegionController@index']);
Route::post('region/save', ['as' => 'region.save', 'uses' => 'RegionController@save']);
Route::get('region/detail/{id}', ['as' => 'region.detail', 'uses' => 'RegionController@detail']);
Route::get('region/edit/{id}', ['as' => 'region.edit', 'uses' => 'RegionController@edit']);
Route::post('region/update', ['as' => 'region.update', 'uses' => 'RegionController@update']);
Route::get('region/delete/{id}', ['as' => 'region.delete', 'uses' => 'RegionController@delete']);
<?php

/*
|--------------------------------------------------------------------------
| Autenticação de Usuários
|--------------------------------------------------------------------------
| Module:  Users crud
|--------------------------------------------------------------------------
*/
Route::resource('usuarios', 'Admin\Auth\RegisterController');
Route::post('usuario/reativar', 'Admin\Auth\RegisterController@reactivateExcluded')->name('admins.reactivate');
Route::post('usuarios/excluidos/data', 'Admin\Auth\RegisterController@dataExcluded')->name('admins.excluded.data');
Route::get('usuarios/excluidos', 'Admin\Auth\RegisterController@excluded');
Route::put('usuario/{id}/perfil', 'Admin\Auth\RegisterController@updateProfile')->name('admin.profile.update');
Route::post('usuarios/data', 'Admin\Auth\RegisterController@data')->name('admins.data');

/*
|--------------------------------------------------------------------------
| Module:  Users modulos.
|--------------------------------------------------------------------------
*/
Route::get('usuario/{id}/perfil', 'Admin\AdminController@profile')->name('admin.profile');
Route::get('usuario/{id}/acessos', 'Admin\AdminController@accessView');
Route::post('usuario/{id}/acessos', 'Admin\AdminController@accessActions')->name('admin.access.actions');
Route::get('usuario/{id}/{mod}/modulos', 'Admin\AdminController@getModules');
Route::get('usuario/{id}/permissoes/{idmod}/data', 'Admin\AdminController@permissions')->name('admin.permissions.data');
Route::put('usuario/{id}/permissao/alterar', 'Admin\AdminController@updatePermission')->name('admin.permission.update');

/*
|--------------------------------------------------------------------------
| Module:  Users photos.
|--------------------------------------------------------------------------
*/
Route::resource('usuario/{id}/foto-admin', 'Admin\ImageAdminController');
Route::put('usuario/status/{id}/photo', 'Admin\ImageAdminController@status')->name('photo.admin.status');

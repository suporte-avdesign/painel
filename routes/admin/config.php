<?php
// Modulos vinculados ao site.
Route::get('config/{id}/site', 'Admin\ConfigSiteController@edit');
Route::put('config/site/{id}/alterar', 'Admin\ConfigSiteController@update')->name('config.site.update');

/*
|--------------------------------------------------------------------------
| Configurações do sistema
|--------------------------------------------------------------------------
*/

//Config Status Pagamento.
Route::resource('config/status-pagamentos', 'Admin\ConfigStatusPaymentController');
Route::get('config/status/payments/excluded', 'Admin\ConfigStatusPaymentController@excluded')->name('status.payments.excluded');
Route::get('config/status/payments/{id}/reactivate', 'Admin\ConfigStatusPaymentController@reactivate')->name('status.payments.reactivate');

//Config Forma de Pagamentos.
Route::resource('config/forma-pagamentos', 'Admin\ConfigFormPaymentController');
Route::get('config/form/payments/excluded', 'Admin\ConfigFormPaymentController@excluded')->name('form-payments.excluded');
Route::get('config/form/payments/{id}/reactivate', 'Admin\ConfigFormPaymentController@reactivate')->name('form-payments.reactivate');

//Config message.
Route::resource('config/contact-subjects', 'Admin\ConfigSubjectContactController');
Route::get('config/contact-subjects-load', 'Admin\ConfigSubjectContactController@loadSubjects')->name('contact-subjects.load');


//Config Group Colors.
Route::resource('config/grupo-cores', 'Admin\ConfigColorGroupController');

// Config images products.
Route::post('config/images/data', 'Admin\ConfigImageProductController@data')->name('config.images.data');
Route::resource('config/images', 'Admin\ConfigImageProductController');

// Config images categories.
Route::get('config/imagens/categorias', 'Admin\ConfigCategoryController@edit');
Route::put('config/imagens/{id}/categorias', 'Admin\ConfigCategoryController@update')->name('config.category.update');

// Config images sections.
Route::get('config/imagens/secoes', 'Admin\ConfigSectionController@edit');
Route::put('config/imagens/{id}/secoes', 'Admin\ConfigSectionController@update')->name('config.section.update');

// Config images brands.
Route::get('config/imagens/fabricantes', 'Admin\ConfigBrandController@edit');
Route::put('config/imagens/{id}/fabricantes', 'Admin\ConfigBrandController@update')->name('config.brand.update');

// Config imagens  slider da home
Route::get('config/imagens/slider', 'Admin\ConfigSliderController@edit');
Route::put('config/imagens/{id}/slider', 'Admin\ConfigSliderController@update')->name('config.slider.update');

// Config imagens  banners
Route::get('config/imagens/banners', 'Admin\ConfigBannerController@edit');
Route::put('config/imagens/{id}/banners', 'Admin\ConfigBannerController@update')->name('config.banners.update');


// Config images admins.
Route::get('config/imagens/usuarios', 'Admin\ConfigAdminController@edit');
Route::put('config/imagens/{id}/usuarios', 'Admin\ConfigAdminController@update')->name('config.admin.update');

// Config Unit Measure.
Route::post('config/unidades/data', 'Admin\ConfigUnitMeasureController@data')->name('measures.data');
Route::resource('config/unidades', 'Admin\ConfigUnitMeasureController');

// Kits (Caixa, Pacote etc)
Route::post('config/kits/data', 'Admin\ConfigKitController@data')->name('config.kits.data');
Route::resource('config/kits', 'Admin\ConfigKitController');

// Metodos de envio.
Route::post('config/metodos/loader', 'Admin\ConfigShippingController@load')->name('shipping.load');
Route::resource('config/metodos', 'Admin\ConfigShippingController');

// Porcentagens sobre os produtos.
Route::post('config/porcentagens/data', 'Admin\ConfigPercentController@data')->name('percent.data');
Route::resource('config/porcentagens', 'Admin\ConfigPercentController');

// Perfil e porcentagens de preços do cliente.
Route::resource('config/perfil-cliente', 'Admin\ConfigProfileClientController');
Route::post('config/perfil-cliente/data', 'Admin\ConfigProfileClientController@data')->name('profile.client.data');
Route::post('perfil-cliente/prices', 'Admin\ConfigProfileClientController@prices')->name('profile.client.get.prices');
Route::post('perfil-cliente/offers', 'Admin\ConfigProfileClientController@offers')->name('profile.client.get.offers');

// Palavras chaves (keywords).
Route::post('config/keywords/data', 'Admin\ConfigKeywordsController@data')->name('keywords.data');
Route::resource('config/keywords', 'Admin\ConfigKeywordsController');

// Modulos vinculados ao produto.
Route::get('config/{id}/fretes', 'Admin\ConfigFreightController@edit');
Route::put('config/fretes/{id}/alterar', 'Admin\ConfigFreightController@update')->name('config.freight.update');

// Modulos vinculados ao produto.
Route::get('config/{id}/produtos', 'Admin\ConfigProductController@edit');
Route::put('config/produtos/{id}/alterar', 'Admin\ConfigProductController@update')->name('config.products.update');

// Cores do sistema
Route::get('config/sistema', 'Admin\ConfigController@index');
Route::get('config/cores/sistema', 'Admin\ConfigController@colorSystem')->name('config.colors');
Route::put('config/cores/sistema', 'Admin\ConfigController@colorUpdate')->name('config.colors.update');
Route::get('config/folders/{name}', 'Admin\ConfigController@folders');

// Modulos do sistema
Route::resource('config/modulos', 'Admin\ConfigModuleController');
Route::post('config/modulos/data', 'Admin\ConfigModuleController@data')->name('module.data');
Route::post('config/modulos/{id}/permissoes', 'Admin\ConfigModuleController@showPermissions')->name('module.permissions.show');

// Perfis dos Usuários
Route::post('config/perfis/data', 'Admin\ConfigProfileController@data')->name('profile.data');
Route::post('config/perfis/{id}/users', 'Admin\ConfigProfileController@showUsers')->name('profile.users.show');
Route::get('config/perfis/{id}/users/criar', 'Admin\ConfigProfileController@createUsers')->name('profile.users.create');
Route::post('config/perfis/{id}/users/criar', 'Admin\ConfigProfileController@storeUsers')->name('profile.users.store');
Route::post('config/perfis/{id}/user/{iduser}listar', 'Admin\ConfigProfileController@listPerfis')->name('profile.users.list');
Route::delete('config/perfis/{id}/user/{iduser}/excluir', 'Admin\ConfigProfileController@deleteUser')->name('profile.users.delete');
Route::resource('config/perfis', 'Admin\ConfigProfileController');


// Permissões dos Usuários
Route::post('config/permissoes/data', 'Admin\ConfigPermissionController@data')->name('permission.data');
Route::post('config/permissoes/{id}/perfis', 'Admin\ConfigPermissionController@showProfiles')->name('permission.profile.show');
Route::get('config/permissoes/{id}/perfis/criar', 'Admin\ConfigPermissionController@createProfile')->name('permission.profile.create');
Route::post('config/permissoes/{id}/perfis/criar', 'Admin\ConfigPermissionController@storeProfiles')->name('permission.profile.store');
Route::delete('config/permissoes/{id}/perfis/{idper}/excluir', 'Admin\ConfigPermissionController@deleteProfile')->name('permission.profile.delete');
Route::resource('config/permissoes', 'Admin\ConfigPermissionController');

<?php

/*
|--------------------------------------------------------------------------
| Autenticação de UsuáriosADMIN
|--------------------------------------------------------------------------
*/
// Clientes
Route::resource('clientes', 'Admin\UserController');
Route::post('accounts/data', 'Admin\UserController@data')->name('accounts.data');
Route::get('account/{id}/profile', 'Admin\UserController@profile')->name('account.profile');
Route::get('account/load/profile/{opc}/update/{id}', 'Admin\UserController@loadUpdateProfile');
Route::get('account/load/profile/{opc}', 'Admin\UserController@loadProfile');
// Endereços
Route::resource('account/{id}/address', 'Admin\UserAddressController');
Route::get('address/{id}/refresh', 'Admin\UserAddressController@refresh')->name('account-address.refresh');
// Observações
Route::resource('account/{id}/notes', 'Admin\UserNoteController');
Route::get('note/{id}/refresh', 'Admin\UserNoteController@refresh')->name('account-notes.refresh');
// Excluidos
Route::get('clientes/excluidos', 'Admin\UserController@show')->name('accounts.excluded');
Route::post('accounts/excluded/data', 'Admin\UserController@dataExcluded')->name('accounts.excluded.data');
Route::post('account/{id}/reactivate', 'Admin\UserController@reactivate');
// Reativar
Route::post('cliente/reativar', 'Admin\UserController@reactivateExcluded')->name('accounts.reactivate');
Route::get('clientes/excluidos', 'Admin\UserController@excluded');

// Contato

Route::resource('contatos', 'Admin\ContactController');
Route::post('contacts/data', 'Admin\ContactController@data')->name('contacts.data');
Route::get('contato/mensagem/{id}', 'Admin\ContactController@message')->name('contacts.message');
Route::get('contato/{id}/detalhes', 'Admin\ContactController@details')->name('contacts.details');
Route::post('contacts/{id}/response', 'Admin\ContactController@response')->name('contacts.response');
Route::post('contacts/{id}/status', 'Admin\ContactController@status')->name('contacts.status');
Route::post('contacts/{id}/spam', 'Admin\ContactController@spam')->name('contacts.spam');
Route::get('contacts/{id}/refresh', 'Admin\ContactController@refresh')->name('contacts.refresh');

// Spams Contatos
Route::resource('spams', 'Admin\ContactSpamController');
Route::post('spams/data', 'Admin\ContactSpamController@data')->name('spams.data');
Route::get('spam/mensagem/{id}', 'Admin\ContactSpamController@message')->name('spams.message');
Route::get('spam/{id}/detalhes', 'Admin\ContactSpamController@details')->name('spams.details');

// Marcas & Fabricantes
Route::resource('marcas', 'Admin\BrandController');
Route::post('marcas/data', 'Admin\BrandController@data')->name('brands.data');
Route::get('marca/{id}/detalhes', 'Admin\BrandController@details')->name('brands.details');
Route::resource('marca/{id}/grids-brand', 'Admin\GridBrandController');
Route::resource('marca/{id}/logo-brand', 'Admin\LogoBrandController');
Route::put('marca/status/{id}/logo', 'Admin\LogoBrandController@status')->name('logo-brand.status');
Route::resource('marca/{id}/banner-brand', 'Admin\BannerBrandController');
Route::put('marca/status/{id}/banner', 'Admin\BannerBrandController@status')->name('banner-brand.status');

// Seções dos Produtos
Route::resource('secoes', 'Admin\SectionController');
Route::post('secoes/data', 'Admin\SectionController@data')->name('sections.data');
Route::get('secao/{id}/detalhes', 'Admin\SectionController@details')->name('sections.details');
Route::resource('secao/{id}/grids-section', 'Admin\GridSectionController');
Route::resource('secao/{id}/featured-section', 'Admin\FeaturedSectionController');
Route::put('secao/status/{id}/featured', 'Admin\FeaturedSectionController@status')->name('featured-section.status');
Route::resource('secao/{id}/banner-section', 'Admin\BannerSectionController');
Route::put('secao/status/{id}/banner', 'Admin\BannerSectionController@status')->name('banner-section.status');

// Categorias dos Produtos
Route::resource('categorias', 'Admin\CategoryController');
Route::post('categorias/data', 'Admin\CategoryController@data')->name('categories.data');
Route::get('categoria/{id}/detalhes', 'Admin\CategoryController@details')->name('categories.details');
Route::resource('categoria/{id}/grids-category', 'Admin\GridCategoryController');
Route::get('categoria/{id}/grids-load', 'Admin\GridCategoryController@load')->name('category-grids-load');
Route::resource('categoria/{id}/featured-category', 'Admin\FeaturedCategoryController');
Route::put('categoria/status/{id}/featured', 'Admin\FeaturedCategoryController@status')->name('featured-category.status');
Route::resource('categoria/{id}/banner-category', 'Admin\BannerCategoryController');
Route::put('categoria/status/{id}/banner', 'Admin\BannerCategoryController@status')->name('banner-category.status');

// Products / Categories
Route::resource('produtos/{slug}/catalogo', 'Admin\ProductController');
Route::get('produto/{id}/detalhes', 'Admin\ProductController@details');
Route::post('produtos/{id}/catalogo/data', 'Admin\ProductController@data')->name('catalogo.data');
Route::put('produto/{id}/status', 'Admin\ProductController@status')->name('product.status');
Route::post('produto/combo/categories', 'Admin\ProductController@comboCataegory')->name('combo.categories');
Route::get('produto/{idpro}/grids/{module}/{id}/{stock}/{kit}', 'Admin\ProductController@grids');

// Images Colors Products
Route::resource('produto/{idpro}/colors-product', 'Admin\ImageColorController');
Route::put('produto/{idpro}/status-color/{id}', 'Admin\ImageColorController@status')->name('status-color');
Route::get('produto/{id}/add-grid', 'Admin\ImageColorController@addGrid')->name('add-grid');
Route::get('produto/{id}/change-grids/{stock}/{kit}', 'Admin\ImageColorController@changeGrids');
Route::get('produto/{id}/grids/{stock}/{kit}', 'Admin\ImageColorController@grids');


// Images Positions Colors
Route::resource('produto/{idpro}/positions-product', 'Admin\ImagePositionController');
Route::put('produto/{id}/status-position', 'Admin\ImagePositionController@status')->name('status-position');
Route::get('produto/{idimg}/add-positions', 'Admin\ImagePositionController@addPosition')->name('add-positions');
// Todas as Cores
Route::get('produtos/cores', 'Admin\ImageColorController@products');
Route::post('produtos/colors/data', 'Admin\ImageColorController@data')->name('colors.data');
Route::put('produtos/{idpro}/colors-status/{id}', 'Admin\ImageColorController@colorsStatus')->name('colors-status');

// Lista de Desejos
Route::resource('lista-desejos', 'Admin\WishlistController');
Route::post('wishlist/data', 'Admin\WishlistController@data')->name('wishlist.data');
Route::get('wishlist/{id}/profile', 'Admin\WishlistController@profile')->name('wishlist.profile');
Route::get('wishlist/{id}/lists', 'Admin\WishlistController@lists')->name('wishlist.lists');
Route::get('wishlist/{id}/reload', 'Admin\WishlistController@reload')->name('wishlist.reload');
Route::get('wishlist/{id}/products', 'Admin\WishlistController@products')->name('wishlist.products');
Route::post('wishlist/{id}/add/{user_id}', 'Admin\WishlistController@add')->name('wishlist.add');
Route::post('wishlist/{user_id}/search', 'Admin\WishlistController@search')->name('wishlist.search');
Route::delete('wishlist/delete/{user_id}/all', 'Admin\WishlistController@deleteAll')->name('wishlist.delete.all');
Route::get('wishlist/admin/{user_id}/edit', 'Admin\WishlistController@editAdmin')->name('wishlist.admin.edit');
Route::put('wishlist/admin/{user_id}/store', 'Admin\WishlistController@storeAdmin')->name('wishlist.admin.store');
Route::get('wishlist/admin/{user_id}/save', 'Admin\WishlistController@saveWishlist')->name('wishlist.save');

// Pedidos
Route::resource('pedidos', 'Admin\OrderController');
Route::post('orders/data', 'Admin\OrderController@data')->name('orders.data');
Route::get('order/{id}/details', 'Admin\OrderController@details');
// Pedidos Excluded
Route::post('orders/excluded/data', 'Admin\OrderController@dataExcluded')->name('orders.excluded.data');
Route::post('order/{id}/reactivate', 'Admin\OrderController@reactivate');
// Itens dos Pedidos
Route::resource('order/{id}/order-items', 'Admin\OrderItemController',['except' => ['store','show']]);
Route::get('order/{id}/products', 'Admin\OrderItemController@products')->name('order-items.products');
Route::post('order/{id}/search', 'Admin\OrderItemController@search')->name('order-items.search');
Route::post('order/{id}/add/{order_id}', 'Admin\OrderItemController@add')->name('order-items.add');
Route::get('order/{id}/reload', 'Admin\OrderItemController@reload')->name('order-items.reload');
// Imprimir PDF
Route::get('order/{id}/printer', 'Admin\OrderController@printerPdf')->name('order-items.printer');
// Observações
Route::resource('order/{id}/order-notes', 'Admin\OrderNoteController');
// Pedido/Rastreamento/Metodo de Envio/Obs.
Route::resource('order/{id}/order-shippings', 'Admin\OrderShippingController');


// Slider Home
Route::resource('imagens/{id}/banner-slider', 'Admin\ImageSliderController');
Route::put('imagens/{id}/slider/status', 'Admin\ImageSliderController@status')->name('banner-slider.status');
Route::get('imagens/{id}/slider/order', 'Admin\ImageSliderController@order')->name('banner-slider.order');
Route::put('imagens/slider/order', 'Admin\ImageSliderController@updateOrder')->name('banner-slider.order');

// Banner Home
Route::resource('imagens/{id}/banner', 'Admin\ImageBannerController', ['except' => ['show']]);
Route::put('imagens/banner/status/{id}', 'Admin\ImageBannerController@status')->name('banner.status');
Route::get('imagens/banner/order/{id}', 'Admin\ImageBannerController@order')->name('banner.order');
Route::put('imagens/banner/order', 'Admin\ImageBannerController@updateOrder')->name('banner.order');

// Conteudo do site
// Política e Privacidade
Route::resource('content/privacy-policy', 'Admin\ContentPrivacyPolicyController', ['except' => ['edit']]);
Route::get('content/privacy-policy-load', 'Admin\ContentPrivacyPolicyController@loadContent')->name('privacy-policy.load');
Route::get('content/privacy-policy-order/{id}', 'Admin\ContentPrivacyPolicyController@order')->name('privacy-policy.order');
Route::put('content/privacy-policy-order/{id}', 'Admin\ContentPrivacyPolicyController@updateOrder')->name('privacy-policy.order');
Route::put('content/privacy-policy-status/{id}', 'Admin\ContentPrivacyPolicyController@status')->name('privacy-policy.status');
// Termos e Condições
Route::resource('content/terms-conditions', 'Admin\ContentTermsConditionsController', ['except' => ['edit']]);
Route::get('content/terms-conditions-load', 'Admin\ContentTermsConditionsController@loadContent')->name('terms-conditions.load');
Route::get('content/terms-conditions-order/{id}', 'Admin\ContentTermsConditionsController@order')->name('terms-conditions.order');
Route::put('content/terms-conditions-order/{id}', 'Admin\ContentTermsConditionsController@updateOrder')->name('terms-conditions.order');
Route::put('content/terms-conditions-status/{id}', 'Admin\ContentTermsConditionsController@status')->name('terms-conditions.status');
//Forma de Pagamento
Route::resource('content/form-payment', 'Admin\ContentFormPaymentController', ['except' => ['edit']]);
Route::get('content/form-payment-load', 'Admin\ContentFormPaymentController@loadContent')->name('form-payment.load');
Route::get('content/form-payment-order/{id}', 'Admin\ContentFormPaymentController@order')->name('form-payment.order');
Route::put('content/form-payment-order/{id}', 'Admin\ContentFormPaymentController@updateOrder')->name('form-payment.order');
Route::put('content/form-payment-status/{id}', 'Admin\ContentFormPaymentController@status')->name('form-payment.status');
// Entrega de Devolução
Route::resource('content/delivery-return', 'Admin\ContentDeliveryReturnController', ['except' => ['edit']]);
Route::get('content/delivery-return-load', 'Admin\ContentDeliveryReturnController@loadContent')->name('delivery-return.load');
Route::get('content/delivery-return-order/{id}', 'Admin\ContentDeliveryReturnController@order')->name('delivery-return.order');
Route::put('content/delivery-return-order/{id}', 'Admin\ContentDeliveryReturnController@updateOrder')->name('delivery-return.order');
Route::put('content/delivery-return-status/{id}', 'Admin\ContentDeliveryReturnController@status')->name('delivery-return.status');


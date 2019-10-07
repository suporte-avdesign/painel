<?php

use Illuminate\Http\Request;

Route::post('payment/pagseguro', 'API\ApiPagSeguroController@request');
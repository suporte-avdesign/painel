<?php

namespace AVDPainel\Http\Controllers\API;

use Illuminate\Http\Request;
use AVDPainel\Http\Controllers\Controller;

class ApiPagSeguroController extends Controller
{
    public function request(Request $request)
    {
        return $request->all();
    }
}

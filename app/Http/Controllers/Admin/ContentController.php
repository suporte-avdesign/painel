<?php

namespace AVDPainel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

use AVDPainel\Http\Controllers\Controller;

class ContentController extends Controller
{
    protected $ability = 'content';
    protected $view = 'backend.contents';

    public function __construct()
    {
        $this->middleware('auth:admin');

    }

    public function index()
    {
        if (Gate::denies("{$this->ability}-view")) {
            return view("backend.erros.message-401");
        }


        //$data = $this->interModel->getAll($id);

        return view("{$this->view}.index", compact('id', 'data', 'title', 'upload'));
    }
}

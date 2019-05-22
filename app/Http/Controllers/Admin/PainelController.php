<?php

namespace AVDPainel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AVDPainel\Http\Controllers\Controller;


use AVDPainel\Interfaces\Admin\AdminAccessInterface as InterAccess;
use AVDPainel\Interfaces\Admin\ConfigAdminInterface as InterConfigAvatar;
use AVDPainel\Interfaces\Admin\ConfigSystemInterface as InterConfigSystem;


class PainelController extends Controller
{

    protected $last_url;
    protected $sidbar;
    protected $phat_url;
    protected $avatar_url;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        InterAccess $access,
        InterConfigAvatar $interConfigAvatar,
        InterConfigSystem $interConfigSystem)
    {
        $this->middleware('auth:admin');

        $this->access            = $access;
        $this->interConfigSystem = $interConfigSystem;
        $this->interConfigAvatar = $interConfigAvatar->setId(1);
        $this->avatar_url        = 'https://www.gravatar.com/avatar';
        $this->phat_url          = 'storage/';

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->last_url   = array("last_url" => "admin");


        $width    = $this->interConfigAvatar->width_photo;
        $height   = $this->interConfigAvatar->height_photo;
        $path     = $this->phat_url.$this->interConfigAvatar->path.$width.'x'.$height.'/';

        $photos = auth()->user()->photo;

        $avatar = $this->avatar_url;
        foreach ($photos as $photo) {
            if ($photo->active == constLang('active_true') && $photo->image != '') {
                $avatar = $path. $photo->image;
            }
        }

        $sidebar  = array(
            'total_brands' => 1,
            'total_sections' => 1,
            'total_categories' => 1,
            'total_products' => 1,
            'total_colors' => 1,
            'total_mails' => 1
        );

        $this->access->update($this->last_url);

        return view('backend.home.index', compact('sidebar', 'avatar'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

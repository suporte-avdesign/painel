<?php

namespace AVDPainel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use AVDPainel\Http\Controllers\Controller;

use AVDPainel\Models\Admin\Brand;
use AVDPainel\Models\Admin\Product;
use AVDPainel\Models\Admin\Section;
use AVDPainel\Models\Admin\Category;
use AVDPainel\Models\Admin\ImageColor;
use AVDPainel\Models\Admin\Contact;

use AVDPainel\Interfaces\Admin\AdminAccessInterface as InterAccess;
use AVDPainel\Interfaces\Admin\ConfigSystemInterface as InterConfigSystem;

class PainelController extends Controller
{
    protected $last_url;
    protected $sidbar;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        InterAccess $access,
        InterConfigSystem $interConfigSystem)
    {
        $this->middleware('auth:admin');

        $this->access            = $access;
        $this->interConfigSystem = $interConfigSystem;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
        Brand $brand,
        Contact $contact,
        Section $section,
        Product $product,
        Category $category,
        ImageColor $colors)
    {
        $this->last_url   = array("last_url" => "admin");

        $sidebar  = array(
            'total_brands' => $brand->count(),
            'total_sections' => $section->count(),
            'total_categories' => $category->count(),
            'total_products' => $product->count(),
            'total_colors' => $colors->count(),
            'total_mails' => $contact->where('send', 0)->count()
        );

        $this->access->update($this->last_url);

        return view('backend.home.index', compact('confUser', 'sidebar'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {

        $this->last_url = array("last_url" => "admin");
        $this->access->update($this->last_url);
        return view('backend.home.home');
    }

  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function catalog(Section $section)
    {

        $catalog = $section->get();


        return view('backend.products.menu', compact('catalog'));
    }


}

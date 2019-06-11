<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Interfaces\Admin\ConfigProductInterface as ConfigProduct;
use AVDPainel\Interfaces\Admin\BrandInterface as InterBrand;
use AVDPainel\Interfaces\Admin\SectionInterface as InterSection;
use AVDPainel\Interfaces\Admin\CategoryInterface as InterCategory;
use AVDPainel\Interfaces\Admin\ProductInterface as InterProduct;

use AVDPainel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;


class GridsControlle extends Controller
{

    protected $ability  = 'product';
    protected $view     = 'backend.colors-grids';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        InterBrand $interBrand,
        InterProduct $interProduct,
        InterSection $interSection,
        InterCategory $interCategory,
        ConfigProduct $configProduct)
    {
        $this->middleware('auth:admin');

        $this->interBrand         = $interBrand;
        $this->interProduct       = $interProduct;
        $this->interSection       = $interSection;
        $this->interCategory      = $interCategory;
        $this->configProduct      = $configProduct;
    }


    /**
     * Loader grids.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function load(Request $request)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $input = $request->all();
        $id    = $input['id'];
        $kit   = $input['kit'];
        $opc   = $input['opc'];
        $idpro = $input['idpro'];
        $stock = $input['stock'];

        $product = $this->interProduct->setId($idpro);
        $configProduct = $this->configProduct->setId(1);

        if ($kit == 1 ? $type = 'kit' : $type = 'unit');

        if ($opc == 'category') {
            $set   = $this->interCategory->setId($id);
            $grids = $set->grids->where('type', $type);
            if (count($grids) == 0) {
                return '<p class="message icon-speech red-gradient">
                            Não existe grade desta categoria!
                        </p>';
            }
        } elseif ($opc == 'section') {
            $set   = $this->interSection->setId($id);
            $grids = $set->grids->where('type', $type);
            if (count($grids) == 0) {
                return '<p class="message icon-speech red-gradient">
                            Não existe grade desta seção!
                        </p>';
            }
        } elseif ($opc == 'brand') {
            $set   = $this->interBrand->setId($id);
            $grids = $set->grids->where('type', $type);
            if (count($grids) == 0) {
                return '<p class="message icon-speech red-gradient">
                            Não existe grade deste fabricante!
                        </p>';
            }
        }

        if ($kit == 1) {
            return view("{$this->view}.form-create-kits", compact(
                'configProduct','product', 'grids','opc','stock')
            );
        } else {
            return view("{$this->view}.form-create-units", compact(
                'configProduct','product', 'grids','opc','stock')
            );
        }
    }


    /**
     *  Filter action  (create or edit)
     * @param Request $request
     */
    public function change(Request $request)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $input = $request->all();
        $stock = $input['stock'];
        $kit   = $input['kit'];

        ($kit == 1 ? $type = 'kit': $type = 'unit');

        if ($input['ac'] == 'create') {
            if ($input['opc'] == 'brand') {
                $brand = $this->interBrand->setId($input['id']);
                $grids = $brand->grids()->where('type', $type)->get();
            } else if ($input['opc'] == 'section') {
                $brand = $this->interSection->setId($input['id']);
                $grids = $brand->grids()->where('type', $type)->get();
            } else {
                $brand = $this->interCategory->setId($input['id']);
                $grids = $brand->grids()->where('type', $type)->get();
            }

            $this->create($kit, $stock, $grids);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($kit, $stock, $grids)
    {

        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        //dd($grids);

        if ($kit == 1) {
            return view("{$this->view}.create_teste_kit", compact('grids','stock'));
        } else {
            return view("{$this->view}.form-create-units", compact('grids','stock'));
        }



        /*
        $data  = $this->interModel->setId($id);
        $input = [
            'kit' => $kit,
            'stock' => $stock
        ];
        $change = $this->interModel->changeGrids($input, $id);
        if ($change) {
            $grids = $this->interGrid->change($data->id, $stock, $kit);
            if ($kit == 1) {
                return view("{$this->view}.modal.forms.grids-update-kits", compact(
                    'stock',
                    'grids',
                    'data',
                    'kit'
                ));
            } else {
                return view("{$this->view}.modal.forms.grids-update", compact(
                    'stock',
                    'grids',
                    'data',
                    'kit'
                ));
            }
        }

        */
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

}

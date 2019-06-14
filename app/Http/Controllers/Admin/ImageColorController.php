<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Http\Requests\Admin\ProductColorRequest as ReqModel;

use AVDPainel\Interfaces\Admin\ConfigKitInterface as ConfigKit;
use AVDPainel\Interfaces\Admin\ProductInterface as InterProduct;
use AVDPainel\Interfaces\Admin\GridProductInterface as InterGrid;
use AVDPainel\Interfaces\Admin\GroupColorInterface as InterGroup;
use AVDPainel\Interfaces\Admin\ImageColorInterface as InterModel;
use AVDPainel\Interfaces\Admin\InventaryInterface as InterInventary;
use AVDPainel\Interfaces\Admin\ConfigSystemInterface as ConfigSystem;
use AVDPainel\Interfaces\Admin\ConfigColorGroupInterface as InterHexa;
use AVDPainel\Interfaces\Admin\ConfigProductInterface as ConfigProduct;
use AVDPainel\Interfaces\Admin\ConfigColorPositionInterface as ConfigImage;


use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use AVDPainel\Http\Controllers\Controller;

class ImageColorController extends Controller
{

    protected $ability = 'product-images';
    protected $view    = 'backend.colors';

    public function __construct(
        ConfigKit $configKit,
        InterGrid $interGrid,
        InterHexa $interHexa,
        ConfigSystem $confUser,
        InterGroup $interGroup,
        InterModel $interModel,
        ConfigImage $configImage,
        InterProduct $interProduct,
        ConfigProduct $configProduct,
        InterInventary $interInventary)
    {
        $this->middleware('auth:admin');

        $this->confUser       = $confUser;
        $this->configKit      = $configKit;
        $this->interHexa      = $interHexa;
        $this->interGrid      = $interGrid;
        $this->interGroup     = $interGroup;
        $this->interModel     = $interModel;
        $this->configImage    = $configImage;
        $this->interProduct   = $interProduct;
        $this->configProduct  = $configProduct;
        $this->interInventary = $interInventary;

    }

    /**
     * Date: 06/05/2019
     *
     * @param $idpro
     * @return View
     */
    public function index($idpro)
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $configImage  = $this->configImage->setName('default', 'N');
        $colors       = $this->interModel->get($idpro);
        $path         = 'storage/'.$configImage->path;

        (count($colors) >= 1 ? $title_count = constLang('images.count_true') :
            $title_count = constLang('images.count_false'));

        return view("{$this->view}.gallery", compact('colors','path','idpro', 'title_count'));
    }

    /**
     * Date: 06/12/2019
     *
     * @param $idpro
     * @return View
     */
    public function create($idpro)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        $pixel = $this->configImage->setName('default','Z');
        $configProduct = $this->configProduct->setId(1);

        $group   = array(); // array vazio
        $grids   = array(); // array vazio
        $product = $this->interProduct->setId($idpro);

        ($configProduct->kit == 1 ? $kits = $this->configKit->pluck() : $kits = false);

        if ($configProduct->mini_colors == 'hexa') {
            ($configProduct->group_colors == 1 ? $groupColors = $this->interHexa->getAll() : $groupColors = array());

            return view("{$this->view}.layout_hexa-create", compact(
                'configProduct',
                'groupColors',
                'product',
                'pixel',
                'idpro',
                'group',
                'grids',
                'kits'
            ));
        }
    }

    /**
     * Date 06/12/2019
     * uploadImages - create inventory to get the image
     *
     * @param ReqModel $request
     * @param $idpro
     * @return joson
     */
    public function store(ReqModel $request, $idpro)
    {
        if( Gate::denies("{$this->ability}-create") ) {
            return view("backend.erros.message-401");
        }

        try{
            DB::beginTransaction();

            $dataForm = $request['img'];
            $action   = $dataForm['ac'];
            $file     = $request->file('file');
            $config   = $this->configImage->get();
            $product  = $this->interProduct->setId($dataForm['product_id']);

            $configProduct = $this->configProduct->setId(1);

            $image = $this->interModel->create($dataForm, $product, $config);
            if ($image) {
                $photos = $this->interModel->uploadImages($config, $dataForm, $image, $product, $file);
                if ($photos) {

                    if ($configProduct->group_colors == 1) {
                        $dataGroups = $request['groups'];
                        $groups = $this->interGroup->create($dataGroups, $image->product_id, $image->id);
                    }

                    if ($configProduct->grids == 1) {
                        if ($product->kit == 1) {
                            $grids = $this->interGrid->createKit($configProduct, $request['grids'], $image, $product);
                        } else {
                            $grids = $this->interGrid->createUnit($configProduct, $request['grids'], $image, $product);
                        }
                        if ($grids) {
                            $out = $this->interModel->uploadRender($config, $image, $action);

                            DB::commit();

                            return response()->json($out);
                        }
                    }
                }
            }

        } catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }

    }


    /**
     * Date: 06/12/2019
     *
     * @param  int  $idpro
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($idpro, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $pixel = $this->configImage->setName('default','Z');
        $group_colors  = $this->interGroup->get('image_color_id', $id);

        foreach ($group_colors as $value) {
            $group[] = $value->config_color_group_id;
        }

        $data           = $this->interModel->setId($id);
        $idpro          = $data->product_id;
        $product        = $data->product;
        $grids          = $data->grids;
        $stock          = $product->stock;
        $kit            = $product->kit;
        $configProduct  = $this->configProduct->setId(1);

        $conf           = $this->configImage->setName('default','N');
        $path           = 'storage/'.$conf->path;

        if ($configProduct->mini_colors == 'hexa') {
            $groupColors = $this->interHexa->getAll();

            return view("{$this->view}.layout_hexa-edit", compact(
                'configProduct','groupColors', 'pixel','product',
                'idpro','grids','stock','group','path','data','kit')
            );
        }
    }

    /**
     * Date 06/12/2019
     * @param ReqModel $request
     * @param $idpro
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|string
     */
    public function update(ReqModel $request, $idpro, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        try{
            DB::beginTransaction();

            $file    = $request->file('file');
            $config  = $this->configImage->get();
            $image   = $this->interModel->setId($id);
            $product = $image->product;
            $input   = $request['img'];
            $action   = $input['ac'];
            $update   = $this->interModel->update($input, $config, $product, $image);
            if ($update) {
                $configProduct = $this->configProduct->setId(1);

                if ($configProduct->group_colors == 1) {
                    $groups = $this->interGroup->update($request['groups'], $image->product_id, $image);
                }

                if ($file) {
                    $photo = $this->interModel->uploadImages($config, $input, $image, $product, $file);
                }
                if ($configProduct->grids == 1) {
                    if ($product->kit == 1) {
                        $qty = $request['qty'];
                        $des = $request['des'];
                        $grids = $this->interGrid->updateKit($configProduct, $request['grids'], $image, $product, $qty, $des);
                    }
                    if ($grids) {

                        $out = $this->interModel->uploadRender($config, $image, $action);

                        DB::commit();

                        return response()->json($out);
                    }
                }

            }
        } catch(\Exception $e){
            DB::rollback();
            return $e->getMessage();
        }

    }

    /**
     * Date 06/12/2019
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($idpro, $id)
    {
        if( Gate::denies("{$this->ability}-delete") ) {
            return view("backend.erros.message-401");
        }

        try{
            DB::beginTransaction();

            $config  = $this->configImage->get();
            $image   = $this->interModel->setId($id);
            $product = $image->product;
            $configProduct = $this->configProduct->setId(1);
            if ($configProduct->grids == 1) {
                if ($product->kit == 1) {
                    $grids = $this->interGrid->deleteKit($configProduct, $image, $product);
                }

                if ($grids) {
                    $total = $product->images->count();
                    if ($total >= 2) {
                        $delete = $this->interModel->delete($image, $product, $config, false);
                    } else {
                        $delete = $this->interProduct->deleteUnique($config, $product, $image, true);
                    }

                    if ($delete) {
                        DB::commit();
                        return response()->json($delete);
                    }
                }
            }

        } catch(\Exception $e){

            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Status Image
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idpro
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, $idpro, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }
        try{
            DB::beginTransaction();

            $input    = $request->all();
            $product  = $this->interProduct->setId($idpro);
            $status   = $this->interModel->status($input, $product, $this->view, $id);

            DB::commit();

            return response()->json($status);

        } catch(\Exception $e){

            DB::rollback();
            return $e->getMessage();
        }

    }

    /**
     * All Colors.
     *
     * @return \Illuminate\Http\Response
     */
    public function products()
    {
        if( Gate::denies("product-view") ) {
            return view("backend.erros.message-401");
        }

        $title         = 'Relação de produtos por cores';
        $confUser      = $this->confUser->get();
        $title_create  = 'Adicionar:';
        $configProduct = $this->configProduct->setId(1);

        return view("{$this->view}.colors.index", compact('configProduct', 'title', 'title_create', 'confUser'));
    }

    /**
     * Colors getAll()
     *
     * @param  array  $request
     * @return json
     */
    public function data(Request $request)
    {
        if( Gate::denies("product-view") ) {
            return view("backend.erros.message-401");
        }

        $data = $this->interModel->getAll($request);

        return response()->json($data);
    }


    /**
     * Status Image - Module:colors
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idpro
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function colorsStatus(Request $request, $idpro, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $dataForm = $request->all();
        $product  = $this->interProduct->setId($idpro);
        $status   = $this->interModel->colorsStatus($dataForm, $product, $id);

        return response()->json($status);
    }

}
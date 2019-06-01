<?php

namespace AVDPainel\Http\Controllers\Admin;

use AVDPainel\Http\Requests\Admin\ProductColorRequest as ReqModel;

use AVDPainel\Interfaces\Admin\ConfigKitInterface as ConfigKit;
use AVDPainel\Interfaces\Admin\ProductInterface as InterProduct;
use AVDPainel\Interfaces\Admin\GridProductInterface as InterGrid;
use AVDPainel\Interfaces\Admin\GroupColorInterface as InterGroup;
use AVDPainel\Interfaces\Admin\ImageColorInterface as InterModel;
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
        ConfigProduct $configProduct)
    {
        $this->middleware('auth:admin');

        $this->confUser      = $confUser;
        $this->configKit     = $configKit;
        $this->interHexa     = $interHexa;
        $this->interGrid     = $interGrid;
        $this->interGroup    = $interGroup;
        $this->interModel    = $interModel;
        $this->configImage   = $configImage;
        $this->interProduct  = $interProduct;
        $this->configProduct = $configProduct;
    }


    /**
     * Mostar as imagens referentes as cores do produto
     *
     * @return \Illuminate\Http\Response
     */
    public function index($idpro)
    {
        if( Gate::denies("{$this->ability}-view") ) {
            return view("backend.erros.message-401");
        }

        $configImage  = $this->configImage->setName('default', 'N');
        $colors       = $this->interModel->get($idpro);
        $path         = 'storage/'.$configImage->path;

        (count($colors) >= 1 ? $title_count = 'Clique na imagem para editar' :
                               $title_count = 'Não existe imagem para este produto');

        return view("{$this->view}.gallery", compact('colors','path','idpro', 'title_count'));
    }

    /**
     * Adicionar uma nova cor ao produto
     *
     * @return \Illuminate\Http\Response
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
     * Store 
     *
     * @param  \AVDPainel\Http\Requests\Admin\ProductColorsRequest  $request
     * @return \Illuminate\Http\Response
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
            $kit      = intval($request['kit']); //onclick()
            $stock    = $request['stock']; //onclick()
            $file     = $request->file('file');
            $config   = $this->configImage->get();
            $product  = $this->interProduct->setId($dataForm['product_id']);

            //dd($request['grids']);
            $image = $this->interModel->create($dataForm, $config, $file);

            if ($image) {

                $configProduct = $this->configProduct->setId(1);

                if ($configProduct->grids == 1) {
                    $grids = $this->interGrid->create($request['grids'], $image, $product, $stock, $kit);
                }

                if ($configProduct->group_colors == 1) {
                    $dataGroups = $request['groups'];
                    $groups = $this->interGroup->create($dataGroups, $image->product_id, $image->id);
                }

                $product_id = $image->product_id;
                $success    = true;
                $message    = 'A imagem foi salva';
                $color      =  $image->color;
                $name       =  $image->slug;
                $code       =  $image->code;
                $html       =  $image->html;
                $id         =  $image->id;
                
                DB::commit();

            } else {

                $product_id = false;
                $success    = false;
                $message    = 'Não foi possível salvar a imagem';
                $id         =  null;
                $name       =  null;
                $color      =  null;
                $code       =  null;
                $html       =  null;
            }

            $out = array(
                'product_id' => $product_id,
                'success'    => $success,
                'message'    => $message,
                'color'      => $color,
                'name'       => $name,
                'code'       => $code,
                'html'       => $html,
                'ac'         => $action,
                'id'         => $id
            );

            return response()->json($out);

        } catch(\Exception $e){

            DB::rollback();
            return $e->getMessage();
        }            
    }


    /**
     * Editar as cores do produto
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
                'configProduct',
                'groupColors',
                'pixel',
                'idpro',
                'grids',
                'stock',
                'group',
                'path',
                'data',
                'kit'
            ));
        }
    }

    /**
     * Update Colors.
     *
     * @param  \AVDPainel\Http\Requests\Admin\ProductColorsRequest  $request
     * @param  int  $idpro
     * @param  int  $id     
     * @return \Illuminate\Http\Response
     */
    public function update(ReqModel $request, $idpro, $id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        try{
            DB::beginTransaction();

            $file                     = $request->file('file');
            $config                   = $this->configImage->get();
            $product                  = $this->interProduct->setId($idpro);
            $dataForm                 = $request['img'];
            $dataForm['brand']        = $product->brand;
            $dataForm['section']      = $product->section;
            $dataForm['category']     = $product->category;
            $dataForm['product_id']   = $product->id;
            $dataForm['product_name'] = $product->name;




            $data = $this->interModel->update($dataForm, $id, $config, $file);
           
            if ($data) {
                $configProduct = $this->configProduct->setId(1);
                if ($configProduct->grids == 1) {
                    $dataGrids = $request['grids'];                
                    $grids = $this->interGrid->update(
                        $dataGrids,
                        $data->id,
                        $data->product_id,
                        $product->stock,
                        $product->kit);
                }

                if ($configProduct->group_colors == 1) {
                    $dataGroups = $request['groups'];
                    $groups = $this->interGroup->update($dataGroups, $data->product_id, $data->id);
                }

                $success = true;
                $message = 'O produto foi alterado';
                $id      =  $data->id;
                $name    =  $data->slug;
                $color   =  $data->color;
                $code    =  $data->code;
                $image   =  $data->image;
                $html    =  $data->html;

                 DB::commit();

            } else {

                $success = false;
                $message = 'Não foi possível alterar o produto';
                $id      =  null;
                $name    =  null;
                $color   =  null;
                $code    =  null;
                $image   =  null;
                $html    =  null;
            }

            $out = array(
                'success' => $success,
                'message' => $message,
                'ac'      => 'update',
                'id'      => $id,
                'name'    => $name,
                'color'   => $color,
                'code'    => $code,
                'image'   => $image,
                'html'    => $html

            );

            return response()->json($out);

        } catch(\Exception $e){

            DB::rollback();
            return $e->getMessage();
        }            

    }

    /**
     * Remove
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
            $product = $this->interProduct->setId($idpro);
            $total   = count($product->images);
            if ($total >= 2) {
                $delete  = $this->interModel->delete($id, $product, $config);
                $reload  = false;

            } else {
                $delete  = $this->interProduct->delete($idpro, $config);
                $reload  = true;
            }
            if ($delete) {
                $success = true;
                $message = 'O produto foi excluido.';

                DB::commit();

            } else {
                $success = false;
                $message = 'Não foi possível excuir o produto.';
            }

            $out = array(
                'success' => $success,
                'message' => $message,
                'reload'  => $reload
            );

            return response()->json($out);

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

            $dataForm = $request->all();
            $product  = $this->interProduct->setId($idpro);
            $status   = $this->interModel->status($dataForm, $product, $id);

            DB::commit();

            return response()->json($status);

        } catch(\Exception $e){

            DB::rollback();
            return $e->getMessage();
        }            

    }


    /**
     * Add Grid
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    public function addGrid($id)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        $data = $this->interModel->setId($id);

        return view("{$this->view}.modal.add-grid", compact('data'));
    }
     *
     *
     */

    /**
     * Update grids stock or kit.
     *
     * @param  int  $id
     * @param  int  $stock
     * @param  int  $kit
     * @return \Illuminate\Http\Response
     */
    /*
    public function grids($id, $stock, $kit)
    {
        if( Gate::denies("{$this->ability}-update") ) {
            return view("backend.erros.message-401");
        }

        if ($kit == 1 ? $type = 'kit' : $type = 'unit');

        $data  = $this->interModel->setId($id);
        $grids = $data->grids->where('type', $type);


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
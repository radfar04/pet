<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\StoreSubCat;
use App\Models\StoreCategory;
use App\Models\Location;
use Validator;
use Illuminate\Support\Facades\DB;


class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
{
    //return response()->json(Store::get(),200);
}
    /**
     * Show the form for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $cats = DB::table('store_categories')->select('categories_id','cat')->orderby('cat')->get();
        $subcat =  DB::table('store_subcat')->select('*')->orderby('subcat')->get();
        $locs   =  DB::table('store_location')->select('*')->orderby('l_description')->get();
        return view('storesearch',['cats'=>$cats,'subcat'=>$subcat,'locs'=>$locs]);
    }    
        /**
     * Find All elements.
     *
     * @return \Illuminate\Http\Response
     */
    public function findIt (Request $request)
    {
        $k = new Store;
        $data = $request->only(
            'id',
            'cats',
            'subcat',
            'locs',
            'cdate',
            'udate',
            'desc',
            'elem',
            'order',
        );
        $st = $k->findAll($data);
        $order = isset($data['order']) ? $data['order'] : 'asc';
        return view('storelist',['store' => $st,'order'=>$order]);
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
        $rules = [
            'name' => 'required|max:20',
            'description' => 'required|max:100',
            'price'  => 'required|numeric|max:99999',
            'loc_id'  => 'required',
            'cat_id'  => 'required',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return $validator->errors();
        }
        $store = Store::create($request->all());
        return ["id"=>$store->id];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $store = new Store;
        $store = $store->get($id);
        if (is_null($store)){
            return response()->json('Record not found',404);
        }
        return $store;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $store = new Store;
        $store = $store->getData($id);
        if (is_null($store)){
            return array("code"=>false,"message"=>'Record not found');
        }
        $k = $request->all();
        $store->update($request->all());
        return array("code"=>true,"message"=>'Succeed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        $store = Store::find($id);
        $store->delete();
        return array("code"=>true,"message"=>'Succeed');
    }
        /**
     * Find All elements.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeNew()
    {
        $k = new Store;
        $st = $k->getAux();
        return view('storenew',['cats' => $st[1],'subcat' => $st[2],'locs' => $st[3]]);
    }
    public function getCat($catogories_id)
    {
        $k = new Store;
        return $k->getCat($catogories_id);
    }
    public function addcat(Request $r)
    {
        if ($r->cat) {
            $s2 = (array) json_decode(StoreCategory::select('categories_id')->where('cat','=',$r->cat)->get());
            if(!$s2) {
                StoreCategory::create($r->all());
            } else {
                return array("code"=>false,"message"=>"Category already exist");
            }
        } else {
            return array("code"=>false,"message"=>"Empty field");
        }
        return array("code"=>true,"message"=>"Succeed");
    }
    public function addsubcat(Request $r)
    {
        if($r->subcat && $r->categories_id){
            $s2 = (array) json_decode(StoreSubCat::select('sub_id')
                ->where('categories_id','=',$r->categories_id)
                ->where('subcat','=',$r->subcat)
                ->get());
            if(!$s2) {
                StoreSubCat::create($r->all());
            } else {
                return array("code"=>false,"message"=>"Subcat exist"); 
            }    
        } else {
            return array("code"=>false,"message"=>"Subcat is empty");
        }
        return array("code"=>true,"message"=>"Succeed");
    }
    public function addlocation(Request $r)
    {
        if ($r->l_name && $r->l_description) {
            Location::create($r->all());
        } else {
            return array("code"=>false,"message"=>"Fill All fields");
        }
        return array("code"=>true,"message"=>"Succeed");
    }

}

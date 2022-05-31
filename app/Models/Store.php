<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class Store extends Model
{
    use HasFactory;
    protected $table = "store_store";
    public $timestamps = false;
    protected $fillable = [
        'name',
        'description',
        'loc_id',
        'cat_id',
        'subcat_id',
        'entered_at',
        'price',
    ];
    public function findAll($data){
        $st = ' 1=1 ';
        $elem = 'name';
        $order = 'asc';
        foreach ($data as $key => $value) {
            if(is_null($value)) continue;
                if ($key === 'cats') {
                        $st .= ' and cat_id =  '.$value; 
                }else if($key === 'subcat'){
                        $st .= ' and sc.cat_id =  '.$value;  
                }else if($key === 'locs'){
                        $st .= ' and loc_id =  '.$value;  
                }else if($key === 'cdate'){
                        $st .= ' and entered_at >  \''.date("Y-m-d",strtotime($value)).'\'';  
                }else if($key === 'udate'){
                        $st .= ' and entered_at <  \''.date("Y-m-d",strtotime($value)).'\'';  
                }else if($key === 'desc'){    
                        $st .= " and name like '%". $value."%'";  
                }else if($key === 'elem'){
                    $elem = $value;
                }else if($key === 'order'){
                    $order = $value;
                }else if($key === 'id'){
                        $st .= " and id = ".$value;
                } 
        } 
        $dat = Store::select('*','c.*','l.*')->
        leftjoin('store_categories as c','c.categories_id','=','cat_id')->
        //leftjoin('store_subcat as sc','sc.categories_id','=','c.categories_id')->
        leftjoin('store_location as l','l.location_id','=','loc_id')->
        whereRaw($st)->orderByRaw($elem.' '.$order)->get();      
        return $dat;
    }
    public function get($id){
        $dat = $this->getSingle($id);
        return $this->getAux($dat);
    }
    public function getData($id){
        return $this->getSingle($id);
    }
    public function getAux($dat=null){
        $cats = DB::table('store_categories')->select('categories_id','cat')->orderby('cat')->get();
        $subcat =  DB::table('store_subcat')->select('*')->orderby('subcat')->get();
        $locs   =  DB::table('store_location')->select('*')->orderby('l_description')->get();     
        return array($dat,$cats,$subcat,$locs);
    }
    public function getSingle($id){
        return Store::select('*')->where('id','=',$id)->get()->first();
    }
    public function getCat($categories_id){
        $subcat =  DB::table('store_subcat')->select('*')->where('categories_id','=',$categories_id)->orderby('subcat')->get();
        return $subcat;
    }

}

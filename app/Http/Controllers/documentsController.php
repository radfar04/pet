<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Exception;
use Illuminate\Support\Facades\Input;
use File;
use Redirect;
class documentsController extends Controller
{
    public function dash(){
        return view('dash');
    }
    public function add($message=null){
        $cats = DB::table('categories')->select('id','cat')->orderby('cat')->get();
        return view('dash',['mode' => 'add','cats' => $cats,'mess' => $message]);
    }

    public function list(Request $r){
    }
    public function upload(Request $r) {
        //$myPath = "C:\Users\Fereidoon\OneDrive\Documents\";
        $myPath = 'C:\tmp\\';
        $file = $r->file('image');
        if(!isset($file)){
            return $this->add('Select a file');
        }
        $sub = DB::table('subcat')->select('subcat')->where('id','=',$r->subcat)->get();
        $cat = DB::table('categories')->select('cat')->where('id','=',$r->cats)->get();
        $category = $cat[0]->cat;
        $subcategory = $sub[0]->subcat;
        $cat_id      = $r->cats;
        $subcat_id = $r->subcat;
        $description = $r->desc;
        $filename = $file->getClientOriginalName();
        $fileextension = $file->getClientOriginalExtension();
        $filerealpath = $file->getRealPath();
        $filesize =  $file->getSize();     
        $filemimetype = $file->getMimeType();
        $destinationPath = $myPath.$category."/".$subcategory;
        if (!File::isDirectory($destinationPath))
        {
            File::makeDirectory($destinationPath, 0777, true, true);
        }
        try {
            $exception =         
                DB::insert('insert into docs (filename,cat_id,subcat_id,fileextension,filesize,filemimetype,description) 
                                      values (?, ?, ?, ?, ?, ?, ?)', 
                [
                    $filename,$cat_id,$subcat_id,$fileextension,$filesize,$filemimetype,$description

                ]
                );
                $message = "Done";
                $file->move($destinationPath,$file->getClientOriginalName());
            } catch (\Exception $e) {
                $message = "Already Exist";
            }
        return view('dash',['mode' => 'done','mess'=>$message,'arr' => ['',$filename,$category,$fileextension,$filesize,$filemimetype,$description]]);
     }
     public function addIt(Request $r){
        if(!isset($r->newcat))return 'Please choose a category';
        try {
            $arr = DB::table('categories')->select('*')->where('cat','=',$r->newcat)->get();
            if(!isset($arr[0]->id)){
                DB::insert('insert into categories (cat) values (?)', [ $r->newcat ]);
                $id = DB::getPdo()->lastInsertId();
            } else {
                $id = $arr[0]->id;
            }
            if(isset($r->newsubcat) and !empty($r->newsubcat)){
                $arr = DB::table('subcat')->select('*')->where('cat_id','=',$id)->where('subcat','=',$r->newsubcat)->get();
                if (!isset($arr[0]->id)){
                    DB::insert('insert into subcat (cat_id,subcat) values (?,?)', [ $id,$r->newsubcat ]);
                }
            }
                $message = "Done";
        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
        return $message;
    }        
    public function getSubcat(Request $r){
        try {
                $arr = DB::table('subcat')->select('*')->where('cat_id','=',$r->cat_id)->get();
                $a = array('success'=>'Y','subcat'=>$arr);
                $response = json_encode($a);
        }
        catch (Exception $e) {
            $message = $e->getMessage();
            $a = array('success'=>'N','mess'=>$message);
            $response = json_encode($a);
        }
        return $response;
    }  
}
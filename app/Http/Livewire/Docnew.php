<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use File;
use App\Http\Controllers\MailController;


class Docnew extends Component
{
    use WithFileUploads;
    public $cats;
    public $subcat;
    public $selectedCat;
    public $selectedSubCat;
    public $desc;
    public $doc=[];
    public $success;
    public $none;
    public $newcat;
    public $oldcat;
    public $newsubcat;
    public $user_id;
    protected $listeners = ['toggle' => 'toggle'];
    public function __construct(){
        $this->subcat = '';
    }
    protected $messages = [
        'doc.required' => 'Please select some file.',
    ];
    public function mount(){
        $this->none = 'none';
        $this->user_id = \Auth::user()->id;
    }
    public function render()
    {
        $this->cats = DB::table('categories')->select('id','cat')->orderby('cat')->where('user_id','=',$this->user_id)->get();
        if($this->selectedCat)$this->subcat =  DB::table('subcat')->select('*')->where('cat_id','=',$this->selectedCat)->where('user_id','=',$this->user_id)->orderby('subcat')->get();
        return view('livewire.docnew');
    }
    public function updatedcats($selectedCat)
    {
        $this->selectedCat = $selectedCat;
    }       
    public function updatedsubcat($selectedSubCat)
    {
        $this->selectedSubCat = $selectedSubCat;
    }   
    public function toggle()
    {
        $this->none = $this->none == 'none' ? $this->none = '' : 'none';
    }
    public function refresh(){
        $this->cats = null;
        $this->subcat = null;
        $this->selectedCat = null;
        $this->selectedSubCat = null;
        $this->desc = null;
        $this->doc = null;
        $this->success = null;
        $this->none = null;
        $this->newcat = null;
        $this->oldcat = null;
        $this->newsubcat = null;
   }      
    public function submit()
    {
        $this->validate([
            'doc' => 'required|max:1024', // 1MB Max
            'cats'   => 'required',
        ]);
        $files = $this->doc;
        $sub = DB::table('subcat')->select('subcat')->where('id','=',$this->selectedSubCat)->where('user_id','=',$this->user_id)->get();
        $cat = DB::table('categories')->select('cat')->where('id','=',$this->selectedCat)->where('user_id','=',$this->user_id)->get();
        $category = $cat[0]->cat;
        $subcategory = $this->selectedSubCat ? $sub[0]->subcat : null;
        $description = $this->desc;
        foreach ($files as $file) {
            $filename = $file->getClientOriginalName();
            $fileextension = $file->getClientOriginalExtension();
            $filerealpath = $file->getRealPath();
            $filesize =  $file->getSize();     
            $filemimetype = $file->getMimeType();
            $destinationPath = $subcategory ? "/".$category."/".$subcategory : "/".$category;
            $destinationPath = $this->user_id."/".$destinationPath;
            try {
                $exception =         
                    DB::insert('insert into docs (user_id,filename,cat_id,subcat_id,fileextension,filesize,filemimetype,description) 
                                        values (?, ?, ?, ?, ?, ?, ?, ?)', 
                    [
                        $this->user_id,$filename,$this->selectedCat,$this->selectedSubCat ? $this->selectedSubCat : null ,$fileextension,$filesize,$filemimetype,$description
                    ]
                    );
                    \Storage::disk('khodam')->putFileAs($destinationPath, $file, $filename);
                    $this->success = 'uploaded';
            } catch (\Exception $e) {
                    DB::rollBack();
                    $this->success = $e->getMessage();
            }
        }
    }     

}

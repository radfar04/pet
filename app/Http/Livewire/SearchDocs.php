<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;
class SearchDocs extends Component
{
    public $cats;
    public $subcat;
    public $selectedCat;
    public $selectedSubCat;
    public $desc;
    public $newcat;
    public $newsubcat;
    public $list;
    public $user_id;
    public function mount(){
        $this->user_id = \Auth::user()->id;
    }
    public function render(Request $request, \Exception $e)
    {
        $this->cats = DB::table('categories')->select('id','cat')->orderby('cat')->get();
        $this->subcat =  DB::table('subcat')->select('*')->orderby('subcat')->get();
        if (!is_null($this->selectedCat)) {
            unset($this->subcat);
            $this->subcat =  DB::table('subcat')->select('*')->where('cat_id','=',$this->selectedCat)->orderby('subcat')->get();
        }       
        return view('livewire.search-docs');
    }
    public function updatedcats($selectedCat)
    {
        $this->selectedCat = $selectedCat;
    }       
    public function updatedsubcat($selectedSubCat)
    {
        $this->selectedSubCat = $selectedSubCat;
    }  
    public function submit()
    {
        $sub = DB::table('subcat')->select('subcat')->where('id','=',$this->selectedSubCat)->get();
        $cat = DB::table('categories')->select('cat')->where('id','=',$this->selectedCat)->get();
        $category = $this->selectedCat ? $cat[0]->cat : null;
        $subcategory = $this->selectedSubCat ? $sub[0]->subcat : null;
        $description = $this->desc;
        $arr = [];
        $this->desc = $this->desc ? "%".strtoupper($this->desc)."%" : null;
        $query = 'select d.*,
                 (select cat from categories c where c.id = d.cat_id ) as cat, 
                 (select subcat from subcat s where  s.id = d.subcat_id) as subcat
                 from docs d where user_id ='.$this->user_id.' ';
        if (!empty($this->selectedCat) and !empty($this->selectedSubCat) and !empty($this->desc)){
            $query = $query.'and d.cat_id = ? and d.subcat_id = ? and d.description like ?';
            $arr = [$this->selectedCat,$this->selectedSubCat,$this->desc];
        } elseif(!empty($this->selectedCat) and !empty($this->selectedSubCat)){
            $query = $query.'and d.cat_id = ? and d.subcat_id = ? ';
            $arr = [$this->selectedCat,$this->selectedSubCat];
        } elseif(!empty($this->selectedCat) and !empty($this->desc)){
            $query = $query.'and d.cat_id = ? and d.description like ? ';
            $arr = [$this->selectedCat,$this->desc];
        } elseif(!empty($this->selectedSubCat) and !empty($this->desc)){
            $query = $query.'and d.subcat_id = ? and d.description like ? ';
            $arr = [$this->selectedSubCat,$this->desc];
        } elseif(!empty($this->selectedCat)){
            $query = $query.'and d.cat_id = ? ';
            $arr = [$this->selectedCat];
        } elseif(!empty($this->selectedSubCat)){
            $query = $query.'and d.subcat_id = ? ';
            $arr = [$this->selectedSubCat];
        } elseif(!empty($this->desc)){
            $query = $query.'and upper(d.description) like ? ';
            $arr = [$this->desc];
        }
        $this->list = DB::select($query,$arr);
    } 
    public function export($c,$s,$f)
    {
        $k= $s ? '/'.$c.'/'.$s.'/'.$f : '/'.$c.'/'.$f;
        return Storage::disk('khodam')->download($this->user_id.'/'.$k);
    }    
}

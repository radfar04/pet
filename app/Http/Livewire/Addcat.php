<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class Addcat extends Component
{
    public $xcat;
    public $selectedOldCat;
    public $xnewcat;
    public $xnewsubcat;
    public $xoldcat;
    public $xoldsubcat;
    public $xuser_id;
    public function render()
    {
        $this->xuser_id = \Auth::user()->id;
        $this->xcat = DB::table('categories')->select('id','cat')->orderby('cat')->where('user_id','=',$this->xuser_id)->get();
        return view('livewire.addcat');
    }
    public function saveCat(){ 
        try {
            if(isset($this->xnewcat)) {
                DB::insert('insert into categories (user_id,cat) values (?,?)', [ $this->xuser_id,$this->xnewcat ]);
                if (isset($this->xnewsubcat)){
                    $id = DB::getPdo()->lastInsertId();
                    DB::insert('insert into subcat (cat_id,subcat,user_id) values (?,?,?)', [ $id,$this->xnewsubcat,$this->xuser_id ]);
                }
            }
            if(isset($this->selectedOldCat) and isset($this->xoldsubcat)) {
                $catid = DB::table('categories')->select('id')->where('id','=',$this->selectedOldCat)->where('user_id','=',$this->xuser_id)->get()[0];
                DB::insert('insert into subcat (cat_id,subcat,user_id) values (?,?,?)', [ $catid->id,$this->xoldsubcat,$this->xuser_id ]);
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        }
        $this->emitUp('toggle');
    }
    public function updatedxoldcat($selectedOldCat)
    {
        $this->selectedOldCat = $selectedOldCat;
    }   
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use DateTime;

class Remind extends Component
{
    public $date;
    public $time;
    public $desc;
    public $success;
    protected $rules = [
        'date' => 'required|date:m/d/Y',
        'time' => 'required|date_format:H:i',
        'desc' => 'required',
    ];
    function __construct() {
        $this->date = date('m/d/Y'); 
        $this->time = date("H:i");
        $this->desc = "";
        $this->success = '';
    }
    public function render(Request $r)
    {
        $u = $r->user();
        $user_id  = $u->id;
        $arr = DB::table('reminder')->select('id','dt','description')->where('user_id', $user_id)->orderby('id')->get();
        return view('livewire.remind',["arr" => $arr]);
    }
    public function deleteIt($r){
        DB::table('reminder')->where('id', $r)->delete(); 
        $this->success = "Done";
    }
    public function refresh(){
        $this->success = null;
        $this->desc = null;
        $this->date = null;
        $this->time = null;
        $this->doc = null;
   } 
    public function submit(){
        $this->validate();
        $u = \Auth::user();
        $user_id  = $u->id;
        $d = $this->date;
        $t = $this->time;
        $desc = $this->desc;
        $myDateTime = \DateTime::createFromFormat('m/d/Y H:i', $d.' '.$t );
        $newDateString = $myDateTime->format('Y-m-d H:i');
        try {
            $exception =         
                DB::insert('insert into reminder (user_id,dt,description) values (?, ?, ?)', 
                [
                    $user_id,$newDateString,$desc
                ]
                );
                $this->success = "Done";
            } catch (\Exception $e) {
                $this->success = 'Already done';//$e->getMessage();
            } 
    }
}

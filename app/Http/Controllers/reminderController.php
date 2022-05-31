<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Exception;
use Illuminate\Support\Facades\Input;
class reminderController extends Controller
{
    public function index(Request $r){
        $u = $r->user();
        $name  = $u->name;
        $arr = DB::table('reminder')->select('id','dt','description')->where('user', $name)->orderby('id')->get();
        return view('reminder',['arr' => $arr]);
    }
    public function save(Request $r){
        if (!Schema::hasTable('reminder')) {
            Schema::create('reminder', function($table)
            {
                $table->increments('id');
                $table->char('user', 20);
                $table->string('email');
                $table->dateTime('dt');
                $table->string('description');
            });
        }
        $u = $r->user();
        $email = $u->email;
        $name  = $u->name;
        $d = $r->date;
        $t = $r->time;
        $desc = $r->desc;
        try {
            $exception =         
                DB::insert('insert into reminder (user,email,dt,description) values (?, ?, ?, ?)', 
                [
                    $name,$email,$d.' '.$t,$desc
                ]
                );
            } catch (\Exception $e) {
                $message = "Already Done";
            }
                return redirect()->route('reminder');            
    }
    public function deleteIt(Request $r){
        DB::table('reminder')->where('id', $r->recid)->delete(); 
        return ['mes' => 'good'];
    }
}
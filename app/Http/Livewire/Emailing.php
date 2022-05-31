<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use File;


class Emailing extends Component
{
    use WithFileUploads;
    public $text;
    public $subject;
    public $target;
    public $doc;
    public $success;
    public $user_id; 
    public function mount(){
        $this->user_id = \Auth::user()->id;
    }   
    public function render()
    {
        return view('livewire.emailing');
    }
    public function submit()
    {
        $this->validate([
            'doc' => 'max:1024', // 1MB Max
            'target' => 'required|email',
        ]);
        $file = isset($this->doc) ? $this->doc : null;
        $fileAdd = $file ? $file->getRealPath() : null;
        $filename = $file ? $file->getClientOriginalName() : null;
        $filemimetype = $file ? $file->getMimeType() : null;
        $newDateString = date('Y-m-d H:i:s');
        $file = isset($this->doc) ? base64_encode(file_get_contents(addslashes($file->getRealPath()))) : null;
        try {
            $exception =         
            DB::insert('insert into emaillog (user_id,filename,text,target,subject,dt,attached,filemimetype) 
                        values (?, ?, ?, ?, ?, ?, ?, ?)',
                        [$this->user_id,$filename,$this->text,$this->target,$this->subject,$newDateString,$fileAdd,$filemimetype]
            );
            $this->success = 'Sent';
            } catch (\Exception $e) {
                    DB::rollBack();
                    $this->success = $e->getMessage();
            }
    }
    public function refresh(){
         $this->success = null;
         $this->text = null;
         $this->subject = null;
         $this->target = null;
         $this->doc = null;
    }         
}

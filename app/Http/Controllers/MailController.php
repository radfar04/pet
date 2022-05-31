<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User;

class MailController extends Controller {
   public function __construct()
   {
       
   }
   public function basic_email() {
      $data = array('name'=>"Fereidoon Radfar","desc"=>"Test desc");   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('radfar04@outlook.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('radfar04@outlook.com','Fereidoon Radfar');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function html_email() {
      $data = array('name'=>"Fereidoon Radfar","desc"=>"Test desc");
      Mail::send('mail', $data, function($message) {
         $message->to('radfar04@outlook.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('radfar04@outlook.com','Fereidoon Radfar');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Fereidoon Radfar","desc"=>"Test desc");
      Mail::send('mail', $data, function($message) {
         $message->to('radfar04@outlook.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         //$message->attach('C:\lara\public\uploads\1-2-3.pdf');
         $message->attach('C:\tmp\Cap\Tap\jet.sql');
         $message->attach('C:\tmp\soop\jet.sql');
         $message->from('radfar04@outlook.com','Fereidoon Radfar');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
   public function sendEmails(){
      $f = date("Y-m-d H:i:s");
      $s = date("Y-m-d H:i:s", strtotime("+1500 minutes"));
      $results = DB::select('select * from reminder where dt between :f and :s', ['f' => $f, 's' => $s]);
      foreach($results as $r){
         $r->email = User::find(\Auth::user()->id);
         $r->name = User::find(\Auth::user()->id);
         $data = array('name'=>$r->name,'desc'=>$r->description);
         Mail::send('mail', $data, function($message) use(&$r){
            $message->to($r->email, $r->name)->subject('Reminder');
            $message->from('radfar04@outlook.com','Fereidoon Radfar');
         });
         \Log::info("Email to $r->name sent!");
      }
   }
   public function Universalemail($user_id) {   
      try { 
            $results = DB::select('select * from emaillog where sent = :n and user_id = :u',['n' => "N", 'u' => $user_id ]);
            foreach($results as $r){
               $u = DB::table('users')->where('id', $r->user_id)->first();
               $data = array('name'=>$u->name,'desc'=>$r->text);
               Mail::send('mail', $data, function($message) use(&$r,&$u){
                  $message->to($r->target,$u->name)->subject($r->subject);
                  $message->from('radfar04@outlook.com',$u->name);
                  if($r->attached) $message->attach($r->attached,['as'=>$r->filename,'mime' => $r->filemimetype]);
               });
               DB::table('emaillog')->where('id',$r->id)->update(array('sent'=>'Y'));
               \Log::info("Email Sent to: ".$r->target);
            }
      } catch (\Exception $e) {
         $this->success = $e->getMessage();
         \Log::info($e->getMessage());
      }
      return;
   }
}
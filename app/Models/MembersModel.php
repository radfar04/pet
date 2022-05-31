<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Hash;

class MembersModel extends Model
{
    use HasFactory;
    public function getIt($r){
        $name = $r->sname;
        $email= $r->semail;
        $created_at = $r->cdate;
        $updated_at = $r->udate;
        
        $st = ' 1=1 ';
        $elem = 'name';
        $order = 'asc';

        if(!is_null($name))       $st .= ' and name  like \'%'.$name.'%\'';  
        if(!is_null($email))      $st .= ' and email like \'%'.$email.'%\'';
        if(!is_null($created_at)) $st .= ' and created_at <  \''.date("Y-m-d",strtotime($created_at)).'\'';  
        if(!is_null($updated_at)) $st .= ' and updated_at <  \''.date("Y-m-d",strtotime($updated_at)).'\'';  

        $t = DB::table('users')->select('*')->whereRaw($st)->orderby('id')->get();
        return convertDate($t);
    }
    public function getMember($id){
        $t = DB::table('users')->select('*')->where('id',$id)->get();
        return convertDate($t);
    }
    public function updateMember($new,$old){
        foreach ($new as $n=>$nf){
            foreach ($old as $o=>$of){
                if ($o === $n){
                    if ($o !== 'password'){
                        if ($of != $nf){
                            $affected = DB::table('users')
                                ->where('id', $old['id'])
                                ->update([$o => convertBack($nf)]);
                        }    
                    }   elseif (!Hash::check($nf, $of)){
                        $affected = DB::table('users')
                            ->where('id', $old['id'])
                            ->update([$o => Hash::make($nf)]);                        
                    }    
                }
            }
        }
    }
}

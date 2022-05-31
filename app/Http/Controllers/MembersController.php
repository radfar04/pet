<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MembersModel;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        $m = new MembersModel();
        $t = $m->getIt($r);
        if ($r->excel === 'on') $this->buildExcel($t); 
        return view('members',['t' => $t]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $m = new MembersModel();
        $t = $m->getMember($id);
        return $t;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $new)
    {
      try{ 
            $m = new MembersModel();
            $old = $m->getMember($new->id);
            $old = json_decode($old);
            $new = $new->all();
            $old = json_decode(json_encode($old), true);
            $old = $old[0];
            $r = $m->updateMember($new,$old);
            return array("code"=>true,"message"=>'Succeed');
      } catch (Exception $e){
          return array("code"=>false,"message"=>$e->getMessage());
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    private function buildExcel($t){
        $i = 1;
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('a'.$i, 'Name');
        $sheet->setCellValue('b'.$i, 'Email');
        $sheet->setCellValue('c'.$i, 'Create at');
        $sheet->setCellValue('d'.$i, 'Updated at');
        foreach($t as $v){
            $i = $i + 1;
            $sheet->setCellValue('a'.$i, $v->name);
            $sheet->setCellValue('b'.$i, $v->email);
            $sheet->setCellValue('c'.$i, $v->created_at);
            $sheet->setCellValue('d'.$i, $v->updated_at);
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'data.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
        $writer->save('php://output');
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empleados;
use Excel;

class PDFController extends Controller
{

    public function index(Request $req)
    {
      $empleados = empleados::all();
      view()->share('empleados',$empleados);

      if($req->has('downloadexcel')){
        Excel::create('users', function($excel) use ($empleados) {
          $excel->sheet('Sheet 1', function($sheet) use ($empleados) {
            $sheet->fromArray($empleados);
          });
        })->export('xls');
      }
      return view('index');
    }

}

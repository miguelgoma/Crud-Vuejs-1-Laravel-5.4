<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empleados;
use App\Http\Requests;
use Response;
use DB;
use App\Quotation;

class SearchController extends Controller
{

    public function index(Request $req)
    {
        $id = $req->all();
        $input = $req->all();
        $employee = DB::select( DB::raw("SELECT * FROM empleados WHERE id = '$input[id]'") );
        $count = count($employee);

        if ($count!=0) {
            $items = DB::table('empleados')->where('id', $id)->paginate(5);
        } else {
            $items = DB::table('empleados')->where('name', $id)->paginate(5);
        }

        $response = [
          'pagination' => [
            'wa' => 5,
            'per_page' => 5,
            'current_page' => 1,
            'last_page' => 1,
            'from' => 6,
            'to' => 8
          ],
          'data' => $items
        ];
        return response()->json($response);

    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Empleados;
use App\Http\Requests;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class EmpleadosController extends Controller
{
    public function vueCrud(){
      return view('/vuejscrud/index');
    }

    public function index()
    {
        $items = Empleados::latest()->paginate(5);
        $response = [
          'pagination' => [
            'total' => $items->total(),
            'per_page' => $items->perPage(),
            'current_page' => $items->currentPage(),
            'last_page' => $items->lastPage(),
            'from' => $items->firstItem(),
            'to' => $items->lastItem()
          ],
          'data' => $items
        ];
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
          'name' => 'required|String',
          'firstname' => 'required|String',
          'lastname' => 'required|String',
          'date_of_birth' => 'required|date',
          'salary' => 'required|Numeric',
        ]);
        $create = Empleados::create($request->all());
        return response()->json($create);
    }

    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name' => 'required|String',
        'firstname' => 'required|String',
        'lastname' => 'required|String',
        'date_of_birth' => 'required',
        'salary' => 'required|Numeric',
      ]);
      $edit = Empleados::find($id)->update($request->all());
      return response()->json($edit);
    }
    
    public function destroy($id)
    {
        Empleados::find($id)->delete();
        return response()->json(['done']);
    }
}

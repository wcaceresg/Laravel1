<?php

namespace App\Http\Controllers;
//use Illuminate\Support\Facades\DB; Directo a la base de datos
use Illuminate\Http\Request;
use App\categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //if (!$request->ajax()) return redirect('/');
        //$categorias=categoria::all(); 1 fase eloquient
        //$categorias = DB::table('categorias')->paginate(1); 2 fase  con db paginacion
        $categorias=categoria::paginate(1);

        return [
             'pagination' =>[
                 'total' => $categorias->total(),
                 'current_page' =>$categorias->currentPage(),
                 'per_page' =>$categorias->perPage(),
                 'last_pag' =>$categorias->lastPage(),
                 'from' =>$categorias->firstItem(),
                 'to' =>$categorias->lastItem(),
             ],
             'categorias' =>$categorias


        ];

       // return $categorias;
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
        if (!$request->ajax()) return redirect('/');
        $categorias=new categoria();
        $categorias->nombre=$request->nombre;
        $categorias->descripcion=$request->descripcion;
        $categorias->condicion='1';
        $categorias->save();

    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $categorias=categoria::findOrFail($request->id);
        $categorias->nombre=$request->nombre;
        $categorias->descripcion=$request->descripcion;
        $categorias->condicion='1';
        $categorias->save();


    }

    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $categorias=categoria::findOrFail($request->id);
        $categorias->condicion='0';
        $categorias->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        //
        $categorias=categoria::findOrFail($request->id);
        $categorias->condicion='1';
        $categorias->save();

    }





}

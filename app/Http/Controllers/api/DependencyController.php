<?php

namespace App\Http\Controllers\api;

use App\Dependency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DependencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dependencies = Dependency::with('users')->get();

        return response()->json($dependencies,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string'
        ],[
            'name.required' => 'El nombre de la dependencia es requerido'
        ]);

        Dependency::create($request->all());

        return response()->json(['message' => 'Dependencia creada correctamente'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function show(Dependency $dependency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dependency $dependency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dependency  $dependency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dependency $dependency)
    {
        $dependency->delete();
        return response()->json([
            'message' => 'Dependencia eliminada correctamente'
        ],202);
    }
}

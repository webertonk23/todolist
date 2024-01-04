<?php

namespace App\Http\Controllers;

use App\Http\Requests\Listas\CreateListasRequest;
use App\Models\ItensModel;
use App\Models\ListasModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ListasModel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateListasRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function() use ($data){
          ListasModel::create($data);  
        });
        
        return response(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ListasModel $lista)
    {
        $lista->load(['itens']);

        return response()->json($lista);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ListasModel $lista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListasModel $lista)
    {
        DB::transaction(function() use($lista){
            $lista->delete();
        });

        return response()->noContent(204);
    }

    public function countListas(){
        return response()->json(ListasModel::count());
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Itens\CreateItensRequest;
use App\Models\ItensModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(ItensModel::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateItensRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function() use ($data){
          ItensModel::create($data);  
        });
        
        return response()->noContent(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(ItensModel $item)
    {
       return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateItensRequest $request, ItensModel $item)
    {
        $data = $request->validated();

        DB::transaction(function() use ($data, $item){
            $item->update($data);
        });
        
        return response()->noContent(204);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItensModel $item)
    {
        DB::transaction(function() use($item){
            $item->delete();
        });

        return response()->noContent(204);
    }
}

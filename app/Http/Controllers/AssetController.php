<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asset = Aset::all();
        return view('users.assets.index2', compact('asset'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'departemen' => 'required',
            'condition' => 'required|in:baik,rusak,hilang',
            'purchase_date' => 'required|date',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable',
        ]);

        Aset::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function generateCode()
    {
        $latest = Aset::orderBy('id', 'desc')->first();
        $nextNumber = $latest ? $latest->id + 1 : 1;
        $code = 'AST-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        return response()->json(['code' => $code]);
    }
}

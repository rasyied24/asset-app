<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Aset;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Aset::query();

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $results = $query->get();

        $results->transform(function ($item) {
            $item->purchase_date = $item->purchase_date
                ? Carbon::parse($item->purchase_date)->format('d-m-Y')
                : null;
            return $item;
        });

        return response()->json([
            'status' => true,
            'message' => 'List aset',
            'data' => $results
        ]);
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

        return Aset::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Aset $aset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aset $aset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aset $aset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aset $aset)
    {
        //
    }

    public function generateCode()
    {
        $latest = Aset::latest()->first();
        $nextId = $latest ? $latest->id + 1 : 1;
        $code = 'AST-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);

        return response()->json(['code' => $code]);
    }
    public function exportPDF(Request $request)
    {
        $query = Aset::query();

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $assets = $query->get();

        $pdf = Pdf::loadView('exports.aset', ['asets' => $assets]);

        return $pdf->download('laporan_aset.pdf');
    }
}

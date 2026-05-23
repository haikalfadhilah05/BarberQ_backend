<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $layanans = Layanan::query()
            ->when($search, function ($query) use ($search) {
                $query->where(
                    'nama_layanan', 'like', "%{$search}%"
                );
            })
            ->latest()
            ->get();

        return response()->json([
            'data' => $layanans
        ]);
    }

    public function store(Request $request)
    {
        $layanan = Layanan::create(
            $request->all()
        );

        return response()->json(
            $layanan,
            201
        );
    }

    public function show($id)
    {
        return response()->json(
            Layanan::findOrFail($id)
        );
    }

    public function update(
        Request $request,
        $id
    ) {
        $layanan =
            Layanan::findOrFail($id);

        $layanan->update(
            $request->all()
        );

        return response()->json(
            $layanan
        );
    }

    public function destroy($id)
    {
        Layanan::destroy($id);

        return response()->json([
            'message' =>
                'Layanan berhasil dihapus'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Barber;
use Illuminate\Http\Request;

class BarberController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $barbers = Barber::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nama_barber', 'like', "%{$search}%")
                    ->orWhere('spesialisasi', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

            return response()->json([
                'data' => $barbers
            ]);
    }

    public function store(Request $request)
    {
        $barber = Barber::create($request->all());

        return response()->json($barber, 201);
    }

    public function show($id)
    {
        return response()->json(
            Barber::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $barber = Barber::findOrFail($id);

        $barber->update($request->all());

        return response()->json($barber);
    }

    public function destroy($id)
    {
        Barber::destroy($id);

        return response()->json([
            'message' => 'Barber berhasil dihapus'
        ]);
    }
}

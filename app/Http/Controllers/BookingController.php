<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = Booking::query();

        if ($user->role !== 'admin') {
            $query->where(
                'user_id',
                $user->id
            );
        }

        return response()->json(
            $query->latest()->get()
        );
    }

    public function store(
        Request $request
    ) {
        $booking =
            Booking::create([
                ...$request->all(),
                'user_id' => auth()->id(),
            ]);

        return response()->json([
            'message' => 'Booking berhasil dibuat',

            'data' => $booking
        ]);
    }

    public function show($id)
    {
        return response()->json(
            Booking::findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $booking->update([
            'nama_customer' => $request->nama_customer,
            'no_hp' => $request->no_hp,
            'barber_name' => $request->barber_name,
            'layanan' => $request->layanan,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_booking' => $request->jam_booking,
            'status' => $request->status
        ]);

        return response()->json($booking);
    }

    public function destroy($id)
    {
        Booking::destroy($id);

        return response()->json([
            'message' => 'Booking berhasil dihapus'
        ]);
    }
}

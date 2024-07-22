<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimeSlot;

class TimeSlotController extends Controller
{
    public function index()
    {
        $slots = TimeSlot::all();
        return view('auth.pages.time-slot', compact('slots'));
    }

    public function create()
    {
        return view('auth.pages.time-slot-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slot' => 'required|string|unique:time_slots,slot',
        ]);

        TimeSlot::create([
            'slot' => $request->slot,
        ]);

        return redirect()->route('time-slots.index')->with('success', 'Slot waktu berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $slot = TimeSlot::findOrFail($id);
        $slot->delete();
        return redirect()->route('time-slots.index')->with('success', 'Slot waktu berhasil dihapus.');
    }
}

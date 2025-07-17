<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // View all bookings for the current user
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())->orderBy('booking_date')->get();
        return view('bookings.index', compact('bookings'));
    }

    // Show the form to create a new booking
    public function create()
    {
        $bookedDates = Booking::pluck('booking_date')->toArray();
        return view('bookings.create', compact('bookedDates'));
    }

    // Store the booking
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'booking_date' => 'required|date|unique:bookings,booking_date',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'booking_date' => $request->booking_date,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking created successfully!');
    }

    // Show edit form
    public function edit(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('bookings.edit', compact('booking'));
    }

    // Update booking
    public function update(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'booking_date' => 'required|date|unique:bookings,booking_date,' . $booking->id,
        ]);

        $booking->update($validated);

        return redirect()->route('bookings.index')->with('success', 'Booking updated successfully!');
    }

    // Delete booking
    public function destroy(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully!');
    }
}

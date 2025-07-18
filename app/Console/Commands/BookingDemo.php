<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;

class BookingDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:booking-demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demonstrate creating and retrieving bookings from the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting Booking Demo...");

        // Create a new booking
        $user = User::first();
        if (!$user) {
            $this->error("No users found in the database. Please create a user first.");
            return 1;
        }

        $booking = Booking::create([
            'user_id' => $user->id,
            'title' => 'Demo Booking',
            'description' => 'This is a demo booking created by the BookingDemo command.',
            'booking_date' => Carbon::now()->addDays(7)->toDateString(),
        ]);

        $this->info("Created booking with ID: {$booking->id}");

        // Retrieve and display bookings
        $bookings = Booking::with('user')->get();

        $this->info("All bookings:");
        foreach ($bookings as $b) {
            $this->line("ID: {$b->id}, Title: {$b->title}, User: {$b->user->name}, Date: {$b->booking_date}");
        }

        return 0;
    }
}

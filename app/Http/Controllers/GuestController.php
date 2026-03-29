<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserAccountCreated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class GuestController extends Controller
{
 public function Home()
{
    // Mengambil data sesuai field tabel room_types yang Anda berikan
    $roomTypes = DB::table('room_types')
        ->select('id', 'name', 'slug', 'base_price', 'capacity', 'image_thumbnail', 'description')
        ->get();
    
    return view('guest.home', compact('roomTypes'));
}

public function RoomDetail($slug)
{
    $roomType = DB::table('room_types')->where('slug', $slug)->first();

    if (!$roomType) { abort(404); }

    // Ambil semua kamar yang ready untuk tipe ini
    $availableRooms = DB::table('rooms')
        ->where('room_type_id', $roomType->id)
        ->where('status', 'available')
        ->get();

    $amenities = json_decode($roomType->amenities) ?? explode(',', $roomType->amenities);

    return view('guest.room-detail', compact('roomType', 'availableRooms', 'amenities'));
}

 public function Accommodation()
{
    // Mengambil data sesuai field tabel room_types yang Anda berikan
    $roomTypes = DB::table('room_types')
        ->select('id', 'name', 'slug', 'base_price', 'capacity', 'image_thumbnail', 'description')
        ->get();
    
    return view('guest.accommodation', compact('roomTypes'));
}

public function Dining()
{
    // Mengambil data dari tabel dining_menus
    $menu = DB::table('dining_menus')
        ->where('is_available', 1)
        ->orderBy('category', 'asc')
        ->get()
        ->groupBy('category'); // Mengelompokkan berdasarkan field 'category'

    return view('guest.dining', compact('menu'));
}
}

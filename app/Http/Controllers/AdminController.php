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
class AdminController extends Controller
{
    public function Dashboard()
    {
        if (!session()->has('super_admin')) {
            abort(403, 'Unauthorized action.');
        }
        return view('super-admin.dashboard');
    }
}

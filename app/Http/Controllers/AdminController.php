<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.index', [
            'users' => User::all(),
            'games' => Game::all(),
            'news' => News::all(),
        ]);
    }
}

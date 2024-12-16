<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Game;
use App\Models\News;
use App\Models\Age;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $gamesQuery = Game::with(['age']);
        $usersQuery = User::query();
        $newsQuery = News::query();
        $ageQuery = Age::query();

        $searchParams = [
            's-title' => $request->query('s-title'),
            's-name' => $request->query('s-name'),
            's-news' => $request->query('s-news'),
            's-age' => $request->query('s-age'),
        ];

        if($searchParams['s-title']) {
            $gamesQuery->where('title', 'like', '%' . $searchParams['s-title'] . '%');
        }

        if($searchParams['s-name']) {
            $usersQuery->where('name', 'like', '%' . $searchParams['s-name'] . '%');
        }

        if($searchParams['s-news']) {
            $newsQuery->where('title', 'like', '%' . $searchParams['s-news'] . '%');
        }

        if($searchParams['s-age']) {
            $gamesQuery->where('age_fk', '=', $searchParams['s-age']);
        }

        $allGames = $gamesQuery->simplePaginate(2)->withQuerytString();
        $allUsers = $usersQuery->get();
        $allNews = $newsQuery->get();
        $allAge = $ageQuery->get();

        return view('admin.index', [
            'users' => $allUsers,
            'games' => $allGames,
            'news' => $allNews,
            'age' => $allAge,

            'searchParams' => $searchParams
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTweet;
use App\Models\Category;
use App\Models\Tweet;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class TweetController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $tweets = Tweet::with('category')->latest()->get();
        return Inertia::render('Tweets/Index', [
            'categories' => $categories,
            'tweets' => $tweets,

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|max:280',

        ]);

        // Tweet::create([
        //     'category_id' => $request->category_id,
        //     'username' => Auth::user()->name, // Берем имя авторизованного пользователя
        //     'content' => $request->content,
        // ]);


        ProcessTweet::dispatch([
            'category_id' => $request->category_id,
            'username' => Auth::user()->name, // Имя авторизованного пользователя
            'content' => $request->content,
        ])->onQueue('store_tweet');


        return redirect()->route('tweets.index');
    }
}

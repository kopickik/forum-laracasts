<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reply;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a new favorite in the database.
     * 
     * @param Reply $reply
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(Reply $reply)
    {
        return $reply->favorite();
    }
}

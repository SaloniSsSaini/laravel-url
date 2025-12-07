<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Support\Facades\Auth;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // SuperAdmin cannot see any URLs
        if ($user->isSuperAdmin()) {
            return view('urls.index', ['urls' => []]);
        }

        // Admin → See URLs NOT created by his own company
        if ($user->isAdmin()) {
            $urls = ShortUrl::where('company_id', '!=', $user->company_id)->get();
        }

        // Member → See URLs NOT created by himself
        else if ($user->isMember()) {
            $urls = ShortUrl::where('created_by', '!=', $user->id)->get();
        }

        // Sales / Manager → See All
        else {
            $urls = ShortUrl::all();
        }

        return view('urls.index', compact('urls'));
    }
}

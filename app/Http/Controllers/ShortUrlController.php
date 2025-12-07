<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortUrlRequest;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ShortUrlController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        Gate::authorize('viewAny', ShortUrl::class);

        if ($user->isAdmin()) {
            // Admin can only see urls NOT created in their own company
            $shortUrls = ShortUrl::with('creator', 'company')
                ->where('company_id', '!=', $user->company_id)
                ->get();
        } elseif ($user->isMember()) {
            // Member can only see urls NOT created by themselves
            $shortUrls = ShortUrl::with('creator', 'company')
                ->where('created_by', '!=', $user->id)
                ->get();
        } else {
            // Sales / Manager – simple: show all for now
            $shortUrls = ShortUrl::with('creator', 'company')->get();
        }

        return view('urls.index', compact('shortUrls'));
    }

    public function create()
    {
        // किसी को भी short url create करने की अनुमति नहीं
        abort(403, 'Creating short urls is not allowed.');
    }

    public function store(ShortUrlRequest $request)
    {
        // Policy already create=false, लेकिन हम extra safeguard भी रखते हैं
        abort(403, 'Creating short urls is not allowed.');
    }
}

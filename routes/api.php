<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ShortUrl;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| NOTE:
| Assignment says:
| - Short URLs should NOT be publicly resolvable.
| - No public API endpoint for redirecting short codes.
|
| So we only provide a simple auth route.
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| OPTIONAL INTERNAL API (Not required for assignment)
| You can keep this or remove it. It is NOT used publicly.
|--------------------------------------------------------------------------
*/

// Example: internal check for short url details (protected)
Route::middleware('auth:sanctum')->get('/short-url/{code}', function ($code) {
    
    $url = ShortUrl::where('short_code', $code)->first();

    if (!$url) {
        return response()->json([
            'error' => 'Short URL not found',
        ], 404);
    }

    return response()->json([
        'short_code'   => $url->short_code,
        'original_url' => $url->original_url,
        'created_by'   => $url->creator->name ?? null,
        'company'      => $url->company->name ?? null,
    ]);
});

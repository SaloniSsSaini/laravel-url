<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckInvitationToken
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->has('token')) {
            abort(403, 'Invitation token is missing.');
        }

        // यहाँ पर बाद में तुम Invitation table से token verify कर सकती हो
        // अभी placeholder के लिए इतना पर्याप्त है।

        return $next($request);
    }
}

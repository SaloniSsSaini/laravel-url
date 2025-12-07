<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();

        if ($user->isSuperAdmin()) {
            $companies = Company::withCount('users')->get();
            $users     = User::with('company')->get();

            return view('dashboard.superadmin', compact('companies', 'users'));
        }

        if ($user->isAdmin()) {
            $company      = $user->company;
            $teamMembers  = User::where('company_id', $user->company_id)
                ->where('id', '!=', $user->id)
                ->get();

            return view('dashboard.admin', compact('company', 'teamMembers'));
        }

        if ($user->isMember()) {
            return view('dashboard.member');
        }

        // Sales / Manager – अभी simple member जैसा
        return view('dashboard.member');
    }
}

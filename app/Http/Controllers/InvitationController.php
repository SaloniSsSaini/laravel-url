<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvitationRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class InvitationController extends Controller
{
    public function create()
    {
        Gate::authorize('invite', User::class);

        $companies = Company::all();

        return view('invitations.create', compact('companies'));
    }

    public function store(InvitationRequest $request)
    {
        $authUser = $request->user();
        Gate::authorize('invite', User::class);

        $data = $request->validated();

        // Assignment rules को enforce करने के लिए basic checks:
        // 1. SuperAdmin can’t invite an Admin in a new company (company_id required)
        if ($authUser->isSuperAdmin()
            && $data['role'] === User::ROLE_ADMIN
            && empty($data['company_id'])) {
            return back()->withErrors([
                'company_id' => 'SuperAdmin must select an existing company for Admin invitation.',
            ]);
        }

        // 2. An Admin can’t invite another Admin or Member in their own company
        if ($authUser->isAdmin()
            && in_array($data['role'], [User::ROLE_ADMIN, User::ROLE_MEMBER], true)
            && (int)($data['company_id'] ?? $authUser->company_id) === (int)$authUser->company_id) {
            return back()->withErrors([
                'role' => 'Admin cannot invite another Admin or Member in their own company.',
            ]);
        }

        // यहाँ पर ideally Invitation model होना चाहिए
        // अभी simple: हम सिर्फ user बना देंगे (assignment के लिए acceptable simple flow)
        $user = User::create([
            'name'       => $data['email'], // या बाद में customizable
            'email'      => $data['email'],
            'password'   => bcrypt('password'), // TODO: proper flow
            'role'       => $data['role'],
            'company_id' => $data['company_id'] ?? null,
        ]);

        return redirect()->route('users.index')
            ->with('status', 'User invited (created) successfully.');
    }
}

<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;

class ShortUrlPolicy
{
    /**
     * Determine whether the user can view the list of short URLs.
     *
     * Assignment rule:
     * - SuperAdmin cannot see the list of all short URLs.
     * - Admin / Member can see the list (but filtered in controller).
     */
    public function viewAny(User $user): bool
    {
        // SuperAdmin is NOT allowed to view any short URL list
        if ($user->role === User::ROLE_SUPERADMIN) {
            return false;
        }

        // Admin, Member, Sales, Manager allowed (filtered later)
        return true;
    }

    /**
     * Determine whether the user can view a specific short URL.
     *
     * Assignment rules:
     * - Admin can only see URLs NOT created in their own company.
     * - Member can only see URLs NOT created by themselves.
     * - SuperAdmin cannot view individual URLs.
     * - Sales/Manager allowed simple view.
     */
    public function view(User $user, ShortUrl $shortUrl): bool
    {
        // Admin rule
        if ($user->role === User::ROLE_ADMIN) {
            return $shortUrl->company_id !== $user->company_id;
        }

        // Member rule
        if ($user->role === User::ROLE_MEMBER) {
            return $shortUrl->created_by !== $user->id;
        }

        // Sales / Manager allowed simple read-only view
        if ($user->role === User::ROLE_SALES || $user->role === User::ROLE_MANAGER) {
            return true;
        }

        // SuperAdmin cannot view individual URLs
        return false;
    }

    /**
     * Determine whether the user can create short URLs.
     *
     * Assignment rule:
     * - Nobody can create short URLs (SuperAdmin, Admin, Member all blocked)
     */
    public function create(User $user): bool
    {
        return false;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Authenticated user के लिए allow, role check controller में होगा
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'email'      => ['required', 'email'],
            'role'       => ['required', 'in:SuperAdmin,Admin,Member,Sales,Manager'],
            'company_id' => ['nullable', 'integer', 'exists:companies,id'],
        ];
    }
}

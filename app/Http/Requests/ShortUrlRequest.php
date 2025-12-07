<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShortUrlRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Actual अनुमति policy/middleware में control होगी
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'original_url' => ['required', 'url', 'max:2048'],
        ];
    }
}

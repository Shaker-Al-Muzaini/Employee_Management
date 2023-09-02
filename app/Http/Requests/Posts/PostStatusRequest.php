<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class PostStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "post_id" => "required|exists:posts,id",
            "status" => "required|in:approved,rejected",
            "rejected_reason" => "required_if:status,rejected",
        ];
    }
}

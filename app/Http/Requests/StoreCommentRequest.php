<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route('post') instanceof \App\Models\Post 
            ? $this->route('post')->id 
            : ($this->route('post') ?? $this->input('post_id'));

        return [
            'body' => ['required', 'string', 'max:1000'],

            'parent_id' => [
                'nullable',
                Rule::exists('comments', 'id')->where(function ($query) use ($postId) {
                    $query->where('post_id', $postId);
                }),
            ],
        ];
    }
}

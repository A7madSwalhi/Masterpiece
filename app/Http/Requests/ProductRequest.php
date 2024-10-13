<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'vendor_id' => ['required', 'exists:vendors,id'],
            'catetgory_id' => ['nullable', 'exists:categories,id'],
            'SKU' => ['required', 'string', 'max:255', Rule::unique('products', 'SKU')->ignore($this->product)],
            'long_description' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'regular_price' => ['required', 'numeric', 'min:0'],
            'discount_price' => ['nullable', 'numeric', 'lt:regular_price'],
            'quantitiy' => ['required', 'integer', 'min:1'],
            'options' => ['nullable', 'json'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'images.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'status' => [ 'in:active,draft,inactive'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'featured' => ['boolean'],
            'tags' => 'nullable|string',
        ];
    }



    public function messages(): array
    {
        return [
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a valid string.',
            'name.max' => 'The product name may not be greater than 255 characters.',

            'vendor_id.required' => 'Please select a vendor for the product.',
            'vendor_id.exists' => 'The selected vendor does not exist.',

            'catetgory_id.exists' => 'The selected category does not exist.',

            'slug.required' => 'A slug is required for the product.',
            'slug.string' => 'The slug must be a valid string.',
            'slug.max' => 'The slug may not be greater than 255 characters.',
            'slug.unique' => 'The slug has already been taken, please choose a different one.',

            'SKU.required' => 'The SKU is required.',
            'SKU.string' => 'The SKU must be a valid string.',
            'SKU.max' => 'The SKU may not be greater than 255 characters.',
            'SKU.unique' => 'The SKU has already been taken, please choose a different one.',

            'regular_price.required' => 'The regular price is required.',
            'regular_price.numeric' => 'The regular price must be a valid number.',
            'regular_price.min' => 'The regular price cannot be less than 0.',

            'discount_price.numeric' => 'The discount price must be a valid number.',
            'discount_price.lt' => 'The discount price must be less than the regular price.',

            'quantitiy.required' => 'The product quantity is required.',
            'quantitiy.integer' => 'The quantity must be an integer.',
            'quantitiy.min' => 'The quantity must be at least 1.',

            'options.json' => 'The options must be a valid JSON format.',

            'image.string' => 'The image path must be a valid string.',



            'brand_id.exists' => 'The selected brand does not exist.',

            'featured.boolean' => 'The featured field must be true or false.',

            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The image size must not exceed 2MB.',

            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Each image must not exceed 2MB in size.',

            'tags.string' => 'The tags must be a comma-separated list.'
        ];
    }
}

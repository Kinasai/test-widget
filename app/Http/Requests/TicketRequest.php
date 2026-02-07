<?php

namespace App\Http\Requests;

use App\Enums\TicketStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'phone_number' => 'required|phone:international',
                'title' => 'required|string|max:255',
                'text' => 'required|string|max:1000',
                'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            ],
            'GET' => [
                'search' => 'sometimes|string',
                'type' => 'sometimes|string',
            ],
            'PATCH' => [
                'status' => ['required', Rule::in(TicketStatus::cases())],
            ]
        };
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Поле "Имя" обязательно для заполнения.',
            'name.string' => 'Поле "Имя" должно быть строкой.',
            'name.max' => 'Поле "Имя" не должно превышать 255 символов.',
            'email.required' => 'Поле "Email" обязательно для заполнения.',
            'email.email' => 'Пожалуйста, введите корректный email адрес.',
            'phone_number.required' => 'Поле "Телефон" обязательно для заполнения.',
            'phone_number.phone' => 'Пожалуйста, введите корректный номер телефона.',
            'title.required' => 'Поле "Заголовок" обязательно для заполнения.',
            'title.string' => 'Поле "Заголовок" должно быть строкой.',
            'title.max' => 'Поле "Заголовок" не должно превышать 255 символов.',
            'text.required' => 'Поле "Сообщение" обязательно для заполнения.',
            'text.string' => 'Поле "Сообщение" должно быть строкой.',
            'text.max' => 'Поле "Сообщение" не должно превышать 1000 символов.',
            'file.image' => 'Файл должен быть изображением',
            'file.mimes' => 'Допустимые форматы изображений: jpeg, png, jpg, gif, webp',
            'file.max' => 'Максимальный размер файла: 5MB',
        ];
    }
}

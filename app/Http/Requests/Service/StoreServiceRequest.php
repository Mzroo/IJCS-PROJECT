<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Data Pelanggan
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_phone' => ['required', 'string', 'max:20'],
            'customer_address' => ['nullable', 'string'],

            // Data Perangkat Servis
            'device_name' => ['required', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:100'],
            'complaint' => ['required', 'string'],
            'conditions' => ['nullable', 'string'],
            'technician_id' => ['nullable', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'customer_name.required' => 'Nama pelanggan wajib diisi.',
            'customer_phone.required' => 'Nomor WhatsApp/Telepon wajib diisi.',
            'device_name.required' => 'Nama/Tipe perangkat wajib diisi.',
            'complaint.required' => 'Keluhan utama perangkat wajib diisi.',
            'technician_id.exists' => 'Teknisi yang dipilih tidak valid.',
        ];
    }
}
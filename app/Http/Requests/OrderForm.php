<?php

namespace App\Http\Requests;

use App\Order;
use App\Address;
use App\Customer;
use Illuminate\Foundation\Http\FormRequest;

class OrderForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'email' => 'required|max:255',
            'country' => 'required|max:255',
            'city' => 'required|max:255',
            'address1' => 'required|max:255',
            'address2' => 'required|max:255',
            'postal_code' => 'required|max:255'
        ];
    }

    public function save($subtotal)
    {
        $customer = Customer::persist($this->only(['name', 'email']));
        $address = Address::persist($this->only(['country', 'city', 'address1', 'address2','postal_code']));

        return Order::create([
            'hash' => bin2hex(random_bytes(32)),
            'subtotal' => $subtotal,
            'customer_id' => $customer->id,
            'address_id' => $address->id
        ]);
    }
}

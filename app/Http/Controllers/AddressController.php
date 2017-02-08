<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAddressRequest;

class AddressController extends Controller
{
    public function create()
    {
        return view('address.create');
    }

    public function store(StoreAddressRequest $request)
    {
        $address = Address::create($request->all());

        return response('', 200);
    }
}

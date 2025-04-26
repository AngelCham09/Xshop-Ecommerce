<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserAddressController extends Controller
{

    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->orderBy('isMain', 'desc')->get();

        return Inertia::render('User/Profile/Address/Index',
            [
                'addresses' => $addresses,
            ]
        );
    }

    public function delete($id)
    {
        $address = UserAddress::find($id);
        if ($address) {
            $address->delete();
        }

        return redirect()->back()->with('success', 'Address deleted successfully.');
    }

    public function store()
    {
        $data = request()->validate([
            'type' => 'required',
            'address1' => 'required',
            'address2' => 'sometimes',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required|array',
            'isMain' => 'sometimes|boolean',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['country_code'] = $data['country']['code'];

        $count = UserAddress::where('user_id', Auth::user()->id)->where('isMain', 1)->count();
        if ($count > 0 && $data['isMain'] == 1) {
            UserAddress::where('user_id', Auth::user()->id)->update(['isMain' => 0]);
        }

        UserAddress::create($data);

        return redirect()->back()->with('success', 'Address added successfully.');
    }

    public function update($id)
    {
        $data = request()->validate([
            'type' => 'required',
            'address1' => 'required',
            'address2' => 'sometimes',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required|array',
            'isMain' => 'sometimes|boolean',
        ]);

        $data['country_code'] = $data['country']['code'];

        $count = UserAddress::where('user_id', Auth::user()->id)->where('isMain', 1)->count();
        if ($count > 0 && $data['isMain'] == 1) {
            UserAddress::where('user_id', Auth::user()->id)->update(['isMain' => 0]);
        }
        
        $address = UserAddress::find($id);
        if ($address) {
            $address->update($data);
        }

        return redirect()->back()->with('success', 'Address updated successfully.');
    }

}

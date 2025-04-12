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
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();

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

}

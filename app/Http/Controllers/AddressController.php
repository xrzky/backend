<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressCollection;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->user()->id;
        $address = Address::where('user_id', $userId)->get();        
        return new AddressCollection($address);
    }

    public function showUserAddresses($id) 
    {
        $address = Address::where('user_id', $id)->get();
        return new AddressCollection($address);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request)
    {
        $userId = auth()->user()->id;
        if ($userId === $request['user_id']) {
            $data = $request->validated();
            Address::create($data);
            return response('sukses', 200);
        } else {
            return response('Unauthorized', 401);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($user)
    {
        $user = Address::find($user);
        return new AddressResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressRequest $request, Address $address)
    {
        $data = $request->validated();        
        $data['isMainAddress'] === true ? 1 : 0;
        
        $address->update($data);
        
        return new AddressResource($address);
    }

    public function setMainAddress(AddressRequest $request, $id)
    {        
        $data = $request->validated();
        $data['isMainAddress'] = $data['isMainAddress'] === true ? 1 : 0; //konvert true false jadi 1 0
        $address = Address::find($id);
        
        $addresses = Address::where('user_id', $data['user_id'])->get();
        foreach ($addresses as $item) { // set semua ismainaddress column current user jadi false
            $index = Address::find($item->id);
            $index->update(['isMainAddress' => 0]);
        }
        $address->update($data); // set address yang dipilih jadi mainaddress
        return \response($address);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // return response($id);
        $this->authorize('delete', Address::find($id));
        $address = Address::find($id);
        $address->delete();
        
        return response()->json("Deleted succesfully");
        
    }
}

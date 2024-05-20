<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())->with('user')->get();

        return view('customers.list', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customers.create', ['customer' => new Customer()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:customers'],
            'phone' => ['nullable', 'string'],
            'organisation' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'image' => ['nullable', 'image']
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('customers');
        }

        /**
         * @var \App\Models\User $user
         */
        $user = $request->user();
        $user->customers()->create($data);

        return redirect()
            ->route('customers.index')
            ->with('alert', 'Customer created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        return view('customers.create', ['customer' => $customer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', "unique:customers,email,$customer->id"],
            'phone' => ['nullable', 'string'],
            'organisation' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'image' => ['nullable', 'image']
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('customers');

            if ($customer->image && Storage::fileExists($customer->image)) {
                Storage::delete($customer->image);
            }
        }

        $customer->update($data);

        return back()
            ->with('alert', 'Customer updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        if ($customer->image && Storage::fileExists($customer->image)) {
            Storage::delete($customer->image);
        }

        return back()
            ->with('alert', 'Customer deleted successfully!');
    }
}

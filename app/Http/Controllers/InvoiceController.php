<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::author()->with('user')->get();

        return view('invoices.list', compact('invoices'));
    }


    function getAddProductForm()
    {
        Debugbar::disable();
        return view('invoices.partials.product', [
            'products' => Product::author()->get()
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoices.create', [
            'invoice' => new Invoice([
                'inv_number' => 'INV#' . rand(100, 9999),
                'date' => date('Y-m-d')
            ]),
            'customers' => Customer::author()->get(),
            'products' => Product::author()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'date' => ['required', 'date'],
            'inv_number' => ['required', 'unique:invoices'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'currency' => ['nullable', 'string'],
            'products_id' => ['required', 'array'],
            'products_quantity' => ['required', 'array'],
            'products_price' => ['required', 'array'],
        ]);

        /**
         * @var \App\Models\User $user
         */
        $user = $request->user();
        /**
         * @var \App\Models\Invoice $invoice
         */
        $invoice = $user->invoices()->create(Arr::only(
            $data,
            ['date', 'customer_id', 'currency', 'inv_number', 'notes', 'status']
        ));

        $products = $request->input('products_id', []);
        $quantities = $request->input('products_quantity', []);
        $prices = $request->input('products_price', []);
        foreach ($products as $key => $id) {
            $invoice->products()->attach($id, [
                'quantity' => $quantities[$key],
                'price' => $prices[$key]
            ]);
        }

        return redirect()
            ->route('invoices.index')
            ->with('alert', 'Invoice created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        if (request('print')) {
            Debugbar::disable();
            return view('invoices.print', compact('invoice'));
        }
        return view('invoices.show', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        return view('invoices.create', ['invoice' => $invoice]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
            'status' => ['nullable', 'string'],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'string'],
            'products.*.quantity' => ['required', 'string'],
            'products.*.price' => ['required', 'string'],
        ]);

        $invoice->update($data);

        return back()
            ->with('alert', 'Invoice updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return back()
            ->with('alert', 'Invoice deleted successfully!');
    }
}

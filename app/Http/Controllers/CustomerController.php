<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        return view('customers.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //  Validate the request data
        $request->validate([
            'email'   => 'required|email|unique:customers,email',
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
        ]);

        try {
            // Create a new customer
            $customer = Customer::create([
                'email'   => $request->email,
                'name'    => $request->name,
                'address' => $request->address,
                'phone'   => $request->phone,
            ]);

            // Check if the customer was created successfully
            return redirect(route('customers.index'))->with(['success' => 'Customer: ' . $customer->name . ' added successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the creation process
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'email'   => 'required|email|unique:customers,email,' . $id,
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
        ]);

        try {
            // Find the customer by ID
            $customer = Customer::findOrFail($id);

            // Update the customer details
            $customer->update([
                'email'   => $request->email,
                'name'    => $request->name,
                'address' => $request->address,
                'phone'   => $request->phone,
            ]);

            // Check if the customer was updated successfully
            return redirect()->back()->with(['success' => 'Customer: ' . $customer->name . ' updated successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the update process
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the customer by ID
            $customer = Customer::findOrFail($id);

            // Delete the customer
            $customer->delete();

            // Check if the customer was deleted successfully
            return redirect()->back()->with(['success' => 'Customer: ' . $customer->name . ' deleted successfully']);
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the deletion process
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}

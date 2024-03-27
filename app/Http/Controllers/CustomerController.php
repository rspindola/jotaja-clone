<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // Retorna todos os clientes
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // Cria um novo cliente
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
        ]);

        $customer = Customer::create($request->only(['name', 'email']));

        return response()->json($customer, 201);
    }

    // Retorna um cliente específico
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }

    // Atualiza um cliente existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $id,
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->only(['name', 'email']));

        return response()->json($customer, 200);
    }

    // Exclui um cliente
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan' => 'required|string|max:255',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
            'customers_id' => 'required|exists:customers,id',
        ]);

        $order = Order::create($request->all());

        return response()->json($order, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'layanan' => 'sometimes|required|string|max:255',
            'jumlah' => 'sometimes|required|numeric',
            'harga' => 'sometimes|required|numeric',
            'customers_id' => 'sometimes|required|exists:customers,id',
        ]);

        $order->update($request->all());

        return response()->json($order);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}

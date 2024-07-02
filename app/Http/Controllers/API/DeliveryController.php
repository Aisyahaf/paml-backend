<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the deliveries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::all();

        return response()->json([
            'success' => true,
            'data' => $deliveries,
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created delivery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'orders_id' => 'required|exists:orders,id',
            'opsi' => 'required|string',
            'tgl_msk' => 'required|date',
            'tgl_klr' => 'required|date',
        ]);

        $delivery = Delivery::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $delivery,
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified delivery.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        return response()->json([
            'success' => true,
            'data' => $delivery,
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified delivery in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'orders_id' => 'required|exists:orders,id',
            'opsi' => 'required|string',
            'tgl_msk' => 'required|date',
            'tgl_klr' => 'required|date',
        ]);

        $delivery->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Delivery updated successfully',
            'data' => $delivery,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified delivery from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return response()->json([
            'success' => true,
            'message' => 'Delivery deleted successfully',
        ], Response::HTTP_OK);
    }
}

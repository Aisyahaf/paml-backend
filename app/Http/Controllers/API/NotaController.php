<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotaController extends Controller
{
    /**
     * Display a listing of the notas.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notas = Nota::all();
        return response()->json(['data' => $notas], 200);
    }

    /**
     * Store a newly created nota in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required|exists:users,id',
            'customers_id' => 'required|exists:customers,id',
            'orders_id' => 'required|exists:orders,id',
            'deliveries_id' => 'required|exists:deliveries,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nota = Nota::create($request->all());

        return response()->json(['data' => $nota], 201);
    }

    /**
     * Display the specified nota.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function show(Nota $nota)
    {
        return response()->json(['data' => $nota], 200);
    }

    /**
     * Update the specified nota in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nota $nota)
    {
        $validator = Validator::make($request->all(), [
            'users_id' => 'required|exists:users,id',
            'customers_id' => 'required|exists:customers,id',
            'orders_id' => 'required|exists:orders,id',
            'deliveries_id' => 'required|exists:deliveries,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $nota->update($request->all());

        return response()->json(['data' => $nota], 200);
    }

    /**
     * Remove the specified nota from storage.
     *
     * @param  \App\Models\Nota  $nota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();

        return response()->json(['message' => 'Nota deleted successfully'], 200);
    }
}

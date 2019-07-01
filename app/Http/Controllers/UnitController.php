<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Unit = model
        return Unit::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Unit::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Unit $unit
     * @return Unit
     */
    public function show(Unit $unit)
    {
        return $unit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        return tap($unit)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Unit $unit
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Unit $unit)
    {
        return response()->json([
            'message' => ($unit->delete()) ? 'Delete Success' : 'Delete Failed'
        ]);
    }
}

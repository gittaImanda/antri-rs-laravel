<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\User;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Patient::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['nomor_rekam_medik' => $this->getZeroPaddedNumber(Patient::count() + 1, 6)]);
        return Patient::create($request->request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Patient
     */
    public function show(Patient $patient)
    {
        return $patient;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Patient $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        return tap($patient)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Patient $patient)
    {
        return response()->json([
            'message' => ($patient->delete()) ? 'Delete Success' : 'Delete Failed'
        ]);
    }


    function getZeroPaddedNumber($value, $padding, $pad_type = STR_PAD_LEFT) {
        return str_pad($value, $padding, "0", STR_PAD_LEFT);
    }
}

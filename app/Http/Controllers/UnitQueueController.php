<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\PatientQueue;
use App\Models\Unit;
use App\Models\UnitSchedule;
use Illuminate\Http\Request;

class UnitQueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Unit $unit
     * @param PatientQueue $queue
     * @return \Illuminate\Http\Response
     */
    public function index(Unit $unit, PatientQueue $queue)
    {
        $queues = PatientQueue::where('unit_id', $unit->id)->paginate(10);
        return view('unit-queue.index', compact('unit', 'queues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Unit $unit)
    {
        $days = config('variable.days');
        $schedules = UnitSchedule::where('unit_id', $unit->id)->get();
        $schedules = $schedules->map(function ($s) {
            $s['doctor_name_and_time'] = $s->doctor->name . " - " . config('variable.days')[$s->day] . " (" . $s->open_at . " - " . $s->closed_at . ")";
            return $s;
        });

        $schedules = $schedules->pluck('doctor_name_and_time', 'id');

        return view('unit-queue.create', compact('unit', 'days', 'schedules'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

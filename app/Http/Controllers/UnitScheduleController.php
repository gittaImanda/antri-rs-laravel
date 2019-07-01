<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Unit;
use App\Models\UnitSchedule;
use Illuminate\Http\Request;

class UnitScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Unit $unit
     * @return Unit
     */
    public function index(Unit $unit)
    {
        $schedules = $unit->schedules()->paginate(10);

        return view('unit-schedule.index', compact('schedules', 'unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Unit $unit)
    {
        $doctors = Doctor::get()->pluck('name', 'id');
        $days = config('variable.days');

        return view('unit-schedule.create', compact('doctors', 'unit', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Unit $unit, Request $request)
    {
        $exists = UnitSchedule::where('unit_id', $unit->id)
            ->where('doctor_id', $request->doctor_id)
            ->where('day', $request->day)
            ->count();

        if ($exists) {
            return redirect()->back()->withErrors(['day' => 'Jadwal untuk hari ' . config('variable.days')[$request->day] . ' sudah ada']);
        }

        $unit->schedules()->create($request->all());

        return redirect()->back()->with('success', 'Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit, Schedule $schedule)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Unit $unit
     * @param UnitSchedule $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit, UnitSchedule $schedule)
    {
        $doctors = Doctor::get()->pluck('name', 'id');
        $days = config('variable.days');

        return view('unit-schedule.edit', compact('unit', 'schedule', 'doctors', 'days'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Unit $unit
     * @param UnitSchedule $schedule
     * @return void
     */
    public function update(Request $request, Unit $unit, UnitSchedule $schedule)
    {
        $schedule->update($request->all());
        return redirect()->back()->with('success', 'Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param UnitSchedule $unitSchedule
     * @return void
     */
    public function destroy(Unit $unit, UnitSchedule $unitSchedule)
    {
        $unitSchedule->delete();
        return redirect()->back()->with('success', 'Success!');
    }
}

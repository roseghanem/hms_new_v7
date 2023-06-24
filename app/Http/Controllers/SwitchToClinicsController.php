<?php

namespace App\Http\Controllers;

use App\Models\SwitchToClinic;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class SwitchToClinicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.switch_to_clinics.index');

    }
    public function getData(Request $request)
    {

        $columns = ['switch_to_clinics.id as id',
        'switch_to_clinics.req_date as date',
        'switch_to_clinics.notes as notes',
        'clinics.name as clinic_name',

        'switch_to_clinics.visit_id  as visit_id',
        //'patients.first_name as patient_name',


        ];
        if ($request->ajax()) {
            $query  = SwitchToClinic::join('clinics', 'switch_to_clinics.clinic_id', '=', 'clinics.id')
        //   ->join('patients', 'patients.id', '=', 'out_patients.patient_id')

            ->select($columns);
                   return DataTables::of($query)

                ->make(true);
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.switch_to_clinics.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        SwitchToClinic::create($request->all());
        return redirect('/switch_to_clinics');
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
        $switch_to_clinic = SwitchToClinic::findOrFail($id);
        return view('dashboard.switch_to_clinics.edit',compact('switch_to_clinic'));
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
        $switch = SwitchToClinic::findOrFail($id);
        $success =$switch->update($request->all());
        return redirect('/switch_to_clinics');
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
        $switch = SwitchToClinic::findOrFail($id);
        $success =$switch->delete();
        return redirect('/switch_to_clinics');
  }

}

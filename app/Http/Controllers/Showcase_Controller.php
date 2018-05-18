<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Showcase_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('showcase_create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'creator' => 'required',
            'idstudent' =>'required',
            'photo' => 'required|image|max:1999'

        ]);

        $filenamewithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
        $extenstion = $request->file('photo')->getClientOriginalExtension();
        // create new file name
        $filenametoStore = $filename . '_' . time() . '.' . $extenstion;

        //uploadtostore
        $request->file('photo')->storeAs('public/photos/',$filenametoStore);


        DB::table('show_case')->insert([
            'show_case_name' => $request->input('title'),
            'show_case_creator' => $request->input('creator'),
            'show_case_id_stu' => $request->input('idstudent'),
            'show_case_img' => $filenametoStore
        ]);

        return redirect('/');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        //

        return view('showcase_edit',compact('id'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request, [
            'title' => 'required',
            'creator' => 'required',
            'photo' => 'required|image|max:1999'
        ]);

        $filenamewithExt = $request->file('photo')->getClientOriginalName();
        $filename = pathinfo($filenamewithExt, PATHINFO_FILENAME);
        $extenstion = $request->file('photo')->getClientOriginalExtension();
        // create new file name
        $filenametoStore = $filename . '_' . time() . '.' . $extenstion;

        //uploadtostore
        $request->file('photo')->storeAs('public/photos/',$filenametoStore);

        DB::table('show_case')
            ->where('show_case_id', $id)
            ->update([
                'show_case_name' => $request->input('title'),
                'show_case_creator' => $request->input('creator'),
                'show_case_img' => $filenametoStore
            ]);

        return redirect('/showcase');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('show_case')->where('show_case_id',$id);
        return redirect('/showcase');
    }
}

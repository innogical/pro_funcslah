<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        return view('register');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name = $request->name;
        $position = $request->position;
        $company = $request->company;
        $email = $request->email;
        $phone = $request->phone;

        $errors = [];

        if (empty($name)) {

            $errors[] = ['message'=>'กรุณาระบุชื่อ-นามสกุล'];

        }
        if (empty($position)) {

            $errors[] = ['message'=>'กรุณาตำแหน่ง'];

        }
        if (empty($company)) {

            $errors[] = ['message'=>'กรุณาระบุบริษัท'];

        }
        if (empty($email)) {

            $errors[] = ['message'=>'กรุณาระบุอีเมล'];

        }
        if (empty($phone)) {

            $errors[] = ['message'=>'กรุณาระบุชเบอร์โทร.'];

        }

        $exits = DB::table('register')->where('email',$email)->first();
        if (!empty($exits)) {
            $errors[] = ['message'=>'อีเมลนี้ได้ลงทะเบียน'];
        }

        if (!empty($errors)) {

            return response([
                'errors'=> $errors
            ],422);

        }

        $data = ['email'=>$email,'name'=>$name];

        Mail::send('mail',$data,function ($message) use($email,$name){

            $message->to($email,$name);
            $message->subject('ขอบคุณที่สนใจเข้าร่วมงาน Func');
            $message->from('qwerty455467@gmail.com','นักศึกษาคณะ ICT รุ่น 12');

        });

        DB::table('register')->insert([

            'name'          =>$name,
            'position'      =>$position,
            'company'       =>$company,
            'email'         =>$email,
            'phone'         =>$phone,

        ]);

        return response([
            'type'=>'redirect',
            'url'=>'/thankyou',
            'message'=>'เรียบร้อยแล้ว'
        ],200);

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

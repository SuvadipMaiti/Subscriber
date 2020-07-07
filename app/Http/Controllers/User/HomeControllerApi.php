<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subscriber;
use Illuminate\Support\Facades\Validator;

class HomeControllerApi extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscribers = Subscriber::orderBy('created_at')->get();    
        if(@$subscribers){
            return response()->json([
                'subscribers' => $subscribers,
                'status' => 1
            ],200);
        }else{
            return response()->json([
                'status' => 0
            ],400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:subscribers|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag(),
                'status' => 0
            ],400);
        }
        $subs_ins = new Subscriber;
        $subs_ins->name = $request->name;
        $subs_ins->email = $request->email;
        $subs_ins->save();    
        if(@$subs_ins){
            return response()->json([
                'user' => $subs_ins,
                'status' => 1
            ],201);
        }else{
            return response()->json([
                'status' => 0
            ],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscribers = Subscriber::where('id',$id)->orderBy('created_at')->get();    
        if(@$subscribers){
            return response()->json([
                'subscribers' => $subscribers,
                'status' => 1
            ],200);
        }else{
            return response()->json([
                'status' => 0
            ],400);
        }
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:subscribers|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->getMessageBag(),
                'status' => 0
            ],400);
        }
        $subs_up = Subscriber::find($id);
        $subs_up->name = $request->name;
        $subs_up->email = $request->email;
        $subs_up->save();    
        if(@$subs_up){
            return response()->json([
                'user' => $subs_up,
                'status' => 1
            ],201);
        }else{
            return response()->json([
                'status' => 0
            ],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subscriber_del = Subscriber::where('id',$id)->delete();    
        if(@$subscriber_del){
            return response()->json([
                'status' => 1
            ],201);
        }else{
            return response()->json([
                'status' => 0
            ],400);
        }
    }
}

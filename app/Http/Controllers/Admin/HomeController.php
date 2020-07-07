<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use App\Subscriber;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
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
    public function file_upload(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|file'
        ]);
        if($request->hasFile('file'))
        {
            //get file
            $upload=$request->file('file');
            $filePath=$upload->getRealPath();
          
            //open and read
            $file=fopen($filePath, 'r');

            $header= fgetcsv($file);

            //dd($header);
            $escapedHeader = [];
            //validate
            foreach ($header as $key => $value) {
                $lheader=strtolower($value);
                $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
                array_push($escapedHeader, $escapedItem);
            }
            //dd($escapedHeader);
            //looping through other columns
            while($columns=fgetcsv($file))
            {
                if($columns[0]=="")
                {
                    continue;
                }
                $data= array_combine($escapedHeader, $columns);

                // Table update
                $name = $data['name'];
                $email = $data['email'];
                if($name != " " && $email != " ")
                {
                    $subs_ins = new Subscriber;
                    $subs_ins->name = $name;
                    $subs_ins->email = $email;
                    $subs_ins->save();
                    Session::flash('success','File sucessfully updated.');
                }
            }
   
        }
        return redirect()->back();
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

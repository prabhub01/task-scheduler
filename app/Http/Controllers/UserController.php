<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUsers(){
        $data = User::all();
        return view('index',compact('data'));

    }

    public function store(Request $request)
    {
           $client = new User;

           $client->client_name = $request->name;
           $client->client_email = $request->email;
           $client->domain = $request->domain;
           $client->domain_url = $request->url;
           $client->start_date = $request->start_date;
           $client->end_date = $request->end_date;
           $client->save();

        return redirect()->route('index')
        ->with('success','New Client Created Successfully.');

    }
}

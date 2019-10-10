<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Haalt alle gebruikers op uit de database
        $gebruikers = \App\User::all();

        // Laat de view 'user/overzicht' zien.
        // De tweede parameter stuurt de variable gebruikers door
        // naar de view. In de view is deze op te halen als
        // 'gebruikers'
        return view('user/overzicht', ['gebruikers' => $gebruikers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Laat hier het formulier zien die de velden heeft om
        // een gebruiker aan te maken
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Maak een nieuwe gebruiker aan, deze staat dan nog niet in de database
        $gebruiker = new User();
        // Vul in het veld 'name' op deze gebruiker vanuit de request zijn input.
        // Input haalt gegevens uit het formulier zonder te kijken naar het type request.
        $gebruiker->name = $request->input('name');
        // Slaat de gebruiker op in de database
        $gebruiker->save();

        // Stuurt de gebruiker terug naar de index
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Haalt de gebruiker op uit de database
        $gebruiker = \App\User::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Haalt de gebruiker op uit de database
        $gebruiker = \App\User::find($id);
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
        // Haalt de gebruiker op uit de database
        $gebruiker = \App\User::find($id);
        // Zet het veld 'name' op de gebruiker
        $gebruiker->name = $request->input('name');
        // Schrijft de gebruiker terug naar de database
        $gebruiker->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Haalt de gebruiker op uit de database
        $gebruiker = \App\User::find($id);
        // Verwijder de gebruiker
        $gebruiker->delete();
    }
}

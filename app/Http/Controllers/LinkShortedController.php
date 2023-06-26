<?php

namespace App\Http\Controllers;

use App\Models\LinkShorted;
use Illuminate\Http\Request;

class LinkShortedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirecionar(Request $request)
    {
        $linkShorted = LinkShorted::with('originalLink')->get();

        foreach ($linkShorted as $key => $link) {
            if ($link->link_shorteds == $request->link) {
                if(strpos($link->originalLink->link, 'https://') === 0){
                    return redirect($link->originalLink->link);
                }
                else{
                    return redirect('https://' .$link->originalLink->link);
                }
            }
        }
        
        return response()->json(['erro' => 'Link nao encontrado']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return LinkShorted::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LinkShorted  $linkShorted
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return LinkShorted::with('originalLink')->find($id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LinkShorted  $linkShorted
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $linkShorted = LinkShorted::find($id);
        $linkShorted->delete();

        return $linkShorted;
    }
}
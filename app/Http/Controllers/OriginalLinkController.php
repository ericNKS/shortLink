<?php

namespace App\Http\Controllers;

use App\Models\LinkShorted;
use App\Models\OriginalLink;
use Illuminate\Http\Request;

class OriginalLinkController extends Controller
{
    private $originalLink;
    private $linkShorted;
    public function __construct(OriginalLink $originalLink, LinkShorted $linkShorted)
    {
        $this->originalLink = $originalLink;
        $this->linkShorted = $linkShorted;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->originalLink->with('linkShorted')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $originalLink = $this->originalLink;

        $originalLink->link = $request->link;
        $originalLink->save();

        $linkShorted = $this->linkShorted;

        $linkEncurtado = $linkShorted->generateRandonLink($originalLink->link);
        $linkShorted->link_shorteds = $linkEncurtado;
        $linkShorted->original_link_id = $originalLink->id;

        $linkShorted->save();

        return ['link_original' => $originalLink->link, 'link_encurtado' => $linkShorted->link_shorteds];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OriginalLink  $originalLink
     * @return \Illuminate\Http\Response
     */
    public function show(OriginalLink $originalLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OriginalLink  $originalLink
     * @return \Illuminate\Http\Response
     */
    public function edit(OriginalLink $originalLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OriginalLink  $originalLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OriginalLink $originalLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OriginalLink  $originalLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(OriginalLink $originalLink)
    {
        //
    }
}

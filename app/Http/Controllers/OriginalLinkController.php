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
            $linkExiste = $originalLink->where('link',$originalLink->link)->with('linkShorted')->first();
            if($linkExiste === null){

                $originalLink->save();

                $linkShorted = $this->linkShorted;

                $linkEncurtado = $linkShorted->generateRandonLink($originalLink->link);
                $linkShorted->link_shorteds = $linkEncurtado;
                $linkShorted->original_link_id = $originalLink->id;

                $linkShorted->save();
                return redirect()->route('home', ['link_original' => $originalLink->link, 'link_encurtado' => $linkShorted->link_shorteds]);
            } else{
            return redirect()->route('home', ['link' => $linkExiste->linkShorted->link_shorteds]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OriginalLink  $originalLink
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,int $id)
    {
        $originalLink = $this->originalLink;

        if($request->has('original')){
            $originalLink = $originalLink->selectRaw($request->original . ',id')->with('linkShorted')->find($id);
            return $originalLink;
        }

        if($request->has('short')){
            $originalLink = $originalLink->with('linkShorted:original_link_id,' . $request->short)->find($id);
            return $originalLink;
        }

        return $originalLink->with('linkShorted')->find($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OriginalLink  $originalLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $originalLink = $this->originalLink;
        $linkShorted = $this->linkShorted;

        $originalLink = $originalLink->with('linkShorted')->find($id);
        $linkShorted = $linkShorted->find($originalLink->linkShorted->id);

        $linkShorted->delete();
        $originalLink->delete();

        return $originalLink;
    }
}

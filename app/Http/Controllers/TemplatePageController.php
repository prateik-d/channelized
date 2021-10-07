<?php

namespace App\Http\Controllers;

use App\TemplatePage;
use Illuminate\Http\Request;

class TemplatePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $templatePage = TemplatePage::latest();

        // dd($templatePage);


        return view('admin.template_page.index', compact('templatePage'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function show(TemplatePage $templatePage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplatePage $templatePage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TemplatePage $templatePage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function destroy(TemplatePage $templatePage)
    {
        //
    }
}

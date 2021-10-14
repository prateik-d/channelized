<?php

namespace App\Http\Controllers;

use App\PageTemplateMaster;
use App\PageTemplateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PageTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatePage = PageTemplateMaster::where("deleted", '=', '0')->get();

        return view('admin.template_page.index', compact('templatePage'));
    }
    
    public function vendor_index()
    {
        $user = Auth::user();

        $templatePage = PageTemplateMaster::where("deleted", '=', '0')->get();
        $templatePageUser = PageTemplateUser::where("deleted", '=', '0')->where("created_by", '=', $user->id)->get();

        return view('vendor.template_page.index', compact('templatePage', 'templatePageUser'));
    }
    
    public function partner_index()
    {
        
        $templatePage = PageTemplateMaster::where("deleted", '=', '0')->get();
        $templatePageUser = PageTemplateUser::where("deleted", '=', '0')->get();

        return view('partner.template_page.index', compact('templatePage', 'templatePageUser'));
    }




    public function vendor_create(PageTemplateMaster $pageTemplateMaster)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateMaster::findOrFail($id);

        // dd($templateData);

        return view('vendor.template_page.create', compact('templateData'));        
    }



    public function vendor_added(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data  = $request->input();
        $user = Auth::user();


        $id = $data['id'];

        $templateData = PageTemplateMaster::findOrFail($id);

        // dd($data);

        $html_content = $data['content'];
        $page_title = $data['page_title'];
        $page_sub_title = $data['page_sub_title'];
        $page_desc = $data['page_desc'];


        // dd($html_content);


        if (strpos($html_content, '$page_title') !== false)
        {
            $html_content = str_replace('{{ $page_title }}', $page_title, $html_content);
        }
        
        if (strpos($html_content, '$page_sub_title') !== false)
        {
            $html_content = str_replace('{{ $page_sub_title }}', $page_sub_title, $html_content);
        }
        
        if (strpos($html_content, '$page_desc') !== false)
        {
            $html_content = str_replace('{{ $page_desc }}', $page_desc, $html_content);
        }

        // dd($html_content);

        // die;

        if($request->hasFile('page_logo'))
        {
            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $destinationPath = public_path().'/uploads/templates/' ;
            
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($destinationPath,$filename);

            $page_logo = url('/public/uploads/templates/'.$filename);

            // dd($page_logo);


            if (strpos($html_content, '$page_logo') !== false)
            {
                $html_content = str_replace('{{ $page_logo }}', $page_logo, $html_content);
            }
        }
        
        // dd($html_content);

        try
        {
            $template = new PageTemplateUser;

            $template->title = isset($data['title']) ? $data['title'] : '';
            $template->content = isset($html_content) ? $html_content : '';
            $template->owner = 'vendor( '.$user->firstname .' ' .$user->lastname. ')' ;
            $template->created_by = $user->id;
            $template->deleted   = '0';
            $template->page_name = isset($data['page_name']) ? $data['page_name'] : '';
            $template->page_title = isset($page_title) ? $page_title : '';
            $template->page_sub_title = isset($page_sub_title) ? $page_sub_title : '';
            $template->page_logo = isset($page_logo) ? $page_logo : '';
            $template->page_desc = isset($page_desc) ? $page_desc : '';

            // $template->title = $data['title'];
            // $template->content = $html_content;
            // $template->owner = 'vendor( '.$user->firstname .' ' .$user->lastname. ')' ;
            // $template->created_by = $user->id;
            // $template->deleted   = '0';
            // $template->page_name = $page_name;
            // $template->page_title = $page_title;
            // $template->page_sub_title = $page_sub_title;
            // $template->page_logo = $page_logo;
            // $template->page_desc = $page_desc;
            
            $template->save();
            return redirect('vendor/template')->with('status',"Updated successfully");
        }
        catch(Exception $e)
        {
            return redirect('admin/template/create')->with('failed',"operation failed");
        }
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
     * @param  \App\PageTemplateMaster  $pageTemplateMaster
     * @return \Illuminate\Http\Response
     */
    public function show(PageTemplateMaster $pageTemplateMaster)
    {
        //
    }

    public function vendor_show(PageTemplateUser $pageTemplateUser)
    {
        
        $id = request()->segment(count(request()->segments()));

        $data = PageTemplateUser::findOrFail($id);

        $content = $data->content;

        return view('vendor.template_page.view', compact('id', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PageTemplateMaster  $pageTemplateMaster
     * @return \Illuminate\Http\Response
     */
    public function edit(PageTemplateMaster $pageTemplateMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PageTemplateMaster  $pageTemplateMaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PageTemplateMaster  $pageTemplateMaster
     * @return \Illuminate\Http\Response
     */
    public function destroy(PageTemplateMaster $pageTemplateMaster)
    {
        //
    }

    public function deactivate(PageTemplateMaster $pageTemplateMaster)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateMaster::findOrFail($id);

        $template_Update = PageTemplateMaster::where("id", $id)->update(["deleted" => '1']);

        return redirect('admin/template')->with('status',"Deactivated successfully");
    }

    public function deactivated()
    {
        $templatePage = PageTemplateMaster::where("deleted", '=', '1')->get();

        return view('admin.template_page.deleted', compact('templatePage'));
    }

    public function inactivate(PageTemplateMaster $pageTemplateMaster)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateMaster::findOrFail($id);

        $template_Update = PageTemplateMaster::where("id", $id)->update(["deleted" => '0']);

        return redirect('admin/template')->with('status',"Inactivated successfully");
    }
}

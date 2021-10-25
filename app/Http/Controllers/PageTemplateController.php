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
        $user = Auth::user();

        $templatePage = PageTemplateMaster::where("deleted", '=', '0')->get();
        $templatePageUser = PageTemplateUser::where("deleted", '=', '0')->where("created_by", '=', $user->id)->get();

        return view('partner.template_page.index', compact('templatePage', 'templatePageUser'));
    }




    public function vendor_create(PageTemplateMaster $pageTemplateMaster, PageTemplateUser $pageTemplateUser)
    {

        $user = Auth::user();

        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateMaster::findOrFail($id);

        $templateUserData = PageTemplateUser::where('created_by', '=', $user->id)->get();

        if(count($templateUserData) == '0')
        {
            return view('vendor.template_page.create', compact('templateData'));        
        }
        else
        {
            $is_deleted = '';

            foreach ($templateUserData as $value) 
            {
                $is_deleted .= $value->deleted;
            }

            if(strpos($is_deleted, '0') !== false)
            {
                return redirect('vendor/template')->with('failed',"You already created a template.");
            }
            else
            {
                return view('vendor.template_page.create', compact('templateData'));
            }

            return redirect('vendor/template')->with('failed',"You already created a template.");    
        }
    }




    public function partner_create(PageTemplateMaster $pageTemplateMaster, PageTemplateUser $pageTemplateUser)
    {

        $user = Auth::user();

        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateMaster::findOrFail($id);

        $templateUserData = PageTemplateUser::where('created_by', '=', $user->id)->get();

        if(count($templateUserData) == '0')
        {
            return view('partner.template_page.create', compact('templateData'));        
        }
        else
        {
            $is_deleted = '';

            foreach ($templateUserData as $value) 
            {
                $is_deleted .= $value->deleted;
            }

            if(strpos($is_deleted, '0') !== false)
            {
                return redirect('vendor/template')->with('failed',"You already created a template.");
            }
            else
            {
                return view('vendor.template_page.create', compact('templateData'));
            }
            
            return redirect('partner/template')->with('failed',"You already created a template.");    
        }
    }



    public function vendor_added(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data  = $request->input();
        $user = Auth::user();


        $id = $data['id'];

        $templateData = PageTemplateMaster::findOrFail($id);

        // dd($templateData);

        $templateUserData = PageTemplateUser::where('created_by', '=', $user->id)->get();

        dd($templateUserData->id);

        try
        {
            $template = new PageTemplateUser;

            $template->title = $templateData['name'];
            $template->content = isset($data['page_desc']) ? $data['page_desc'] : '';
            $template->owner = 'vendor( '.$user->firstname .' ' .$user->lastname. ')' ;
            $template->created_by = $user->id;
            $template->deleted   = '0';
            $template->page_name = $templateData['name'];
            // $template->page_name = isset($data['page_name']) ? $data['page_name'] : '';
            $template->page_title = isset($page_title) ? $page_title : '';
            $template->page_sub_title = isset($page_sub_title) ? $page_sub_title : '';
            $template->page_logo = isset($page_logo) ? $page_logo : '';
            $template->page_desc = isset($page_desc) ? $page_desc : '';
            $template->master = $templateData['id'];

            
            // dd($template);
            

            $template->save();
            return redirect('vendor/template')->with('status',"Updated successfully");
        }
        catch(Exception $e)
        {
            return redirect('vendor/template')->with('failed',"operation failed");
        }
    }


    public function partner_added(Request $request, PageTemplateMaster $pageTemplateMaster, PageTemplateUser $pageTemplateUser)
    {
        $data  = $request->input();
        $user = Auth::user();


        $id = $data['id'];

        $templateData = PageTemplateMaster::findOrFail($id);

        // dd($templateData);



 
        try
        {
            $template = new PageTemplateUser;

            $template->title = $templateData['name'];
            $template->content = isset($data['page_desc']) ? $data['page_desc'] : '';
            $template->owner = 'partner( '.$user->firstname .' ' .$user->lastname. ')' ;
            $template->created_by = $user->id;
            $template->deleted   = '0';
            $template->page_name = $templateData['name'];
            // $template->page_name = isset($data['page_name']) ? $data['page_name'] : '';
            $template->page_title = isset($page_title) ? $page_title : '';
            $template->page_sub_title = isset($page_sub_title) ? $page_sub_title : '';
            $template->page_logo = isset($page_logo) ? $page_logo : '';
            $template->page_desc = isset($page_desc) ? $page_desc : '';
            $template->master = $templateData['id'];

            
            // dd($template);
            

            $template->save();
            return redirect('partner/template')->with('status',"Updated successfully");
        }
        catch(Exception $e)
        {
            return redirect('partner/template')->with('failed',"operation failed");
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

        // dd($data);

        return view('vendor.template_page.view', compact('id', 'content'));
    }

    public function partner_show(PageTemplateUser $pageTemplateUser)
    {
        
        $id = request()->segment(count(request()->segments()));

        $data = PageTemplateUser::findOrFail($id);

        $content = $data->content;

        // dd($data);

        return view('partner.template_page.view', compact('id', 'content'));
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

    public function vendor_edit(PageTemplateUser $pageTemplateUser)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateUser::find($id);

        // dd($templateData);

        return view('vendor.template_page.edit', compact('templateData'));        
    }

    public function partner_edit(PageTemplateUser $pageTemplateUser)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateUser::find($id);

        // dd($templateData);

        return view('partner.template_page.edit', compact('templateData'));        
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

    public function vendor_update(Request $request, PageTemplateUser $pageTemplateUser)
    {
        $data  = $request->input();
        $user = Auth::user();

        // dd($data);

        $id = $data['id'];

        $templateData = PageTemplateUser::findOrFail($id);

        $template_Update = PageTemplateUser::where("id", $id)->
                                                                update(
                                                                [
                                                                    // "title" => $data['title'],
                                                                    "content" => $data['page_desc'],
                                                                    "owner" => 'vendor( '.$user->firstname .' ' .$user->lastname. ')',
                                                                    "created_by" => $user->id,
                                                                    
                                                                ]
                                                            );
        
        return redirect('vendor/template')->with('status',"Update successfully");

    }

    public function partner_update(Request $request, PageTemplateUser $pageTemplateUser)
    {
        $data  = $request->input();
        $user = Auth::user();

        // dd($data);

        $id = $data['id'];

        $templateData = PageTemplateUser::findOrFail($id);

        $template_Update = PageTemplateUser::where("id", $id)->
                                                                update(
                                                                [
                                                                    // "title" => $data['title'],
                                                                    "content" => $data['page_desc'],
                                                                    "owner" => 'partner( '.$user->firstname .' ' .$user->lastname. ')',
                                                                    "created_by" => $user->id,
                                                                    
                                                                ]
                                                            );
        
        return redirect('partner/template')->with('status',"Update successfully");

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

    public function vendor_logo_upload(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data =  $request->input();

        $user = Auth::user();

        // dd($data);


        if($request->hasFile('page_logo'))
        {
            // echo "have file";

            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $vendorDestinationPath = public_path().'/uploads/templates/vendor/' .$user->id.'/'.$data['id'] ;


            File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);



            $files_in_directory = scandir($vendorDestinationPath);
            $items_count = count($files_in_directory);

            // dd($items_count);


            if ($items_count > 2)
            {

                File::deleteDirectory($vendorDestinationPath);
                File::makeDirectory($vendorDestinationPath, 0777, true, true);
            }


            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($vendorDestinationPath,$filename);

            $page_logo = url('/public/uploads/templates/vendor/'.$user->id.'/'.$data['id'].'/'.$filename);

            // dd($page_logo);

            // $templateData = PageTemplateMaster::findOrFail($data['id']);


            // $html_content = $templateData->content;
            $html_content = $data['page_desc'];

     
            $data_c=html_entity_decode($html_content,ENT_QUOTES,'UTF-8');

            // dd($data_c);


            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($data_c);
            $image = $dom->getElementById('logo');

            $old_src = $image->getAttribute('src');

            if(!empty($old_src))
            {
                $image->setAttribute('src', $page_logo);
                $image->setAttribute('data-src', $old_src);
            }

            $data_c = $dom->saveHTML();

            echo ($data_c);

        }
        
    }

    public function vendor_logo_upload_edit(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data =  $request->input();

        $user = Auth::user();

        // dd($data);

        if($request->hasFile('page_logo'))
        {
            // echo "have file";

            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $vendorDestinationPath = public_path().'/uploads/templates/vendor/' .$user->id.'/'.$data['master'] ;


            File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);



            $files_in_directory = scandir($vendorDestinationPath);
            $items_count = count($files_in_directory);

            // dd($items_count);


            if ($items_count > 2)
            {

                File::deleteDirectory($vendorDestinationPath);
                File::makeDirectory($vendorDestinationPath, 0777, true, true);
            }


            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($vendorDestinationPath,$filename);

            $page_logo = url('/public/uploads/templates/vendor/'.$user->id.'/'.$data['master'].'/'.$filename);

            // dd($page_logo);

            $templateData = PageTemplateUser::findOrFail($data['id']);

            // $templateData = PageTemplateUser::where("id", '=', $data['id'])->get();

            // $html_content = $templateData->content;
            $html_content = $data['page_desc'];

            // dd($html_content);
     
            $data_c=html_entity_decode($html_content,ENT_QUOTES,'UTF-8');

            // dd($data_c);


            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($data_c);
            $image = $dom->getElementById('logo');

            // $old_src = $image->getAttribute('src');
            $old_src = $image->getAttribute('data-src');

            if(!empty($old_src))
            {
                $image->setAttribute('src', $page_logo);
                $image->setAttribute('data-src', $old_src);
            }

            $data_c = $dom->saveHTML();

            echo ($data_c);

        }
        
    }

    public function partner_logo_upload(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data =  $request->input();

        $user = Auth::user();

        // dd($data);


        if($request->hasFile('page_logo'))
        {
            // echo "have file";

            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $partnerDestinationPath = public_path().'/uploads/templates/partner/' .$user->id.'/'.$data['id'] ;


            File::isDirectory($partnerDestinationPath) or File::makeDirectory($partnerDestinationPath, 0777, true, true);



            $files_in_directory = scandir($partnerDestinationPath);
            $items_count = count($files_in_directory);

            // dd($items_count);


            if ($items_count > 2)
            {

                File::deleteDirectory($partnerDestinationPath);
                File::makeDirectory($partnerDestinationPath, 0777, true, true);
            }


            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($partnerDestinationPath,$filename);

            $page_logo = url('/public/uploads/templates/partner/'.$user->id.'/'.$data['id'].'/'.$filename);

            // dd($page_logo);

            // $templateData = PageTemplateMaster::findOrFail($data['id']);


            // $html_content = $templateData->content;
            $html_content = $data['page_desc'];

     
            $data_c=html_entity_decode($html_content,ENT_QUOTES,'UTF-8');

            // dd($data_c);


            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($data_c);
            $image = $dom->getElementById('logo');

            $old_src = $image->getAttribute('src');

            if(!empty($old_src))
            {
                $image->setAttribute('src', $page_logo);
                $image->setAttribute('data-src', $old_src);
            }

            $data_c = $dom->saveHTML();

            echo ($data_c);

        }
        
    }
    
    public function partner_logo_upload_edit(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data =  $request->input();

        $user = Auth::user();

        // dd($data);

        if($request->hasFile('page_logo'))
        {
            // echo "have file";

            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $partnerDestinationPath = public_path().'/uploads/templates/partner/' .$user->id.'/'.$data['master'] ;


            File::isDirectory($partnerDestinationPath) or File::makeDirectory($partnerDestinationPath, 0777, true, true);



            $files_in_directory = scandir($partnerDestinationPath);
            $items_count = count($files_in_directory);

            // dd($items_count);


            if ($items_count > 2)
            {

                File::deleteDirectory($partnerDestinationPath);
                File::makeDirectory($partnerDestinationPath, 0777, true, true);
            }


            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($partnerDestinationPath,$filename);

            $page_logo = url('/public/uploads/templates/partner/'.$user->id.'/'.$data['master'].'/'.$filename);

            // dd($page_logo);

            $templateData = PageTemplateUser::findOrFail($data['id']);

            // $templateData = PageTemplateUser::where("id", '=', $data['id'])->get();

            // $html_content = $templateData->content;
            $html_content = $data['page_desc'];

            // dd($html_content);
     
            $data_c=html_entity_decode($html_content,ENT_QUOTES,'UTF-8');

            // dd($data_c);


            $dom = new \DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($data_c);
            $image = $dom->getElementById('logo');

            // $old_src = $image->getAttribute('src');
            $old_src = $image->getAttribute('data-src');

            if(!empty($old_src))
            {
                $image->setAttribute('src', $page_logo);
                $image->setAttribute('data-src', $old_src);
            }

            $data_c = $dom->saveHTML();

            echo ($data_c);

        }
        
    }
}

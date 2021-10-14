<?php

namespace App\Http\Controllers;

use App\TemplatePage;
use App\PageTemplateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class TemplatePageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templatePage = TemplatePage::where("deleted", '=', '0')->get();

        return view('admin.template_page.index', compact('templatePage'));
    }  
    
    public function vendor_index()
    {
        $templatePage = TemplatePage::where("deleted", '=', '0')->get();
        $templatePageUser = PageTemplateUser::where("deleted", '=', '0')->get();

        return view('vendor.template_page.index', compact('templatePage', 'templatePageUser'));
    }  

    public function partner_index()
    {
        $templatePage = TemplatePage::where("deleted", '=', '0')->get();
        $templatePageUser = PageTemplateUser::where("deleted", '=', '0')->get();

        return view('partner.template_page.index', compact('templatePage', 'templatePageUser'));
    }  

    public function deleted()
    {
        $templatePage = TemplatePage::where("deleted", '=', '1')->get();

        return view('admin.template_page.deleted', compact('templatePage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if(empty($_POST))
        {
            return view('admin.template_page.create');
        }
        else
        {

            $user = Auth::user();

            $data = $request->input();

            // $original_name = $_FILES['page_logo']['name'];

            // dd(time());

            if($request->hasFile('page_logo'))
            {
                $allowedfileExtension=['jpg','jpeg','png', 'svg'];
                $file = $request->file('page_logo');
                $destinationPath = public_path().'/uploads/templates/' ;
                
                $extension = $file->getClientOriginalExtension();
                $filename = time().'.'.$extension;

                // dd($filename);

                $file->move($destinationPath,$filename);
                // dd($file);

                try
                {
                    $template = new TemplatePage;

                    $template->title = $data['title'];
                    $template->content = $data['content'];
                    $template->owner = 'admin( '.$user->firstname .' ' .$user->lastname. ')' ;
                    $template->created_by = $user->id;
                    $template->deleted   = '0';
                    $template->page_name = $data['page_name'];
                    $template->page_title = $data['page_title'];
                    $template->page_logo = $filename;
                    $template->page_desc = $data['page_desc'];
                    
                    $template->save();
                    return redirect('admin/template')->with('status',"Insert successfully");
                }
                catch(Exception $e)
                {
                    return redirect('admin/template/create')->with('failed',"operation failed");
                }
            }

          
        }


    }

   
    /**
     * Display the specified resource.
     *
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function show(TemplatePage $templatePage)
    {
        
        $id = request()->segment(count(request()->segments()));

        $data = TemplatePage::findOrFail($id);

        $content = $data->content;


        if (strpos($content, '$page_name') !== false) 
        {
            $content = str_replace("$page_name", $data->page_name, $content);
        }

        if (strpos($content, '$page_title') !== false) 
        {
            $content = str_replace("$page_title", $data->page_title, $content);
        }

        if (strpos($content, '$page_logo') !== false) 
        {
            $content = str_replace("$page_logo", $data->page_logo, $content);
        }

        if (strpos($content, '$page_desc') !== false) 
        {
            $content = str_replace("$page_desc", $data->page_desc, $content);
        }


        return view('admin.template_page.view', compact('id', 'content'));
    }
    
    public function vendor_show(TemplatePage $templatePage)
    {
        
        $id = request()->segment(count(request()->segments()));

        $data = TemplatePage::findOrFail($id);

        $content = $data->content;


        if (strpos($content, '$page_name') !== false) 
        {
            $content = str_replace("$page_name", $data->page_name, $content);
        }

        if (strpos($content, '$page_title') !== false) 
        {
            $content = str_replace("$page_title", $data->page_title, $content);
        }

        if (strpos($content, '$page_logo') !== false) 
        {
            $content = str_replace("$page_logo", $data->page_logo, $content);
        }

        if (strpos($content, '$page_desc') !== false) 
        {
            $content = str_replace("$page_desc", $data->page_desc, $content);
        }


        return view('vendor.template_page.view', compact('id', 'content'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function edit(TemplatePage $templatePage)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = TemplatePage::findOrFail($id);

        return view('admin.template_page.edit', compact('templateData'));        
    }

    public function vendor_edit(TemplatePage $templatePage)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = TemplatePage::find($id);

        return view('vendor.template_page.edit', compact('templateData'));        
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
        $data  = $request->input();
        $user = Auth::user();

        // dd($data);

        $id = $data['id'];

        $templateData = TemplatePage::findOrFail($id);


        if($request->hasFile('page_logo'))
        {
            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $destinationPath = public_path().'/uploads/templates/' ;
            
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($destinationPath,$filename);

            File::delete($destinationPath.'/'.$templateData->page_logo);
        }
        else
        {

            $filename = $templateData->page_logo;
        }

        try
        {
            

            $template_Update = TemplatePage::where("id", $id)->
                                                                update(
                                                                [
                                                                    "title" => $data['title'],
                                                                    "content" => $data['content'],
                                                                    "owner" => 'admin( '.$user->firstname .' ' .$user->lastname. ')',
                                                                    "created_by" => $user->id,
                                                                    "page_name" => $data['page_name'],
                                                                    "page_title" => $data['page_title'],
                                                                    "page_logo" => $filename,
                                                                    "page_desc" => $data['page_desc']
                                                                ]
                                                            );

            return redirect('admin/template')->with('status',"Update successfully");
        }
        catch(Exception $e)
        {
            // return back()->withInput()->with('failed',"operation failed");
            // return redirect('admin/template/edit/')->with('failed',"operation failed");

            return redirect()->route('admin/template/edit/', ['id' => $data['id']])->with('failed',"operation failed");
        }
    }

    public function vendor_added(Request $request, TemplatePage $templatePage)
    {
        $data  = $request->input();
        $user = Auth::user();


        $id = $data['id'];

        $templateData = TemplatePage::findOrFail($id);

        // dd($user->firstname);


        if($request->hasFile('page_logo'))
        {
            $allowedfileExtension=['jpg','jpeg','png', 'svg'];
            $file = $request->file('page_logo');
            $destinationPath = public_path().'/uploads/templates/' ;
            
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;

            $file->move($destinationPath,$filename);

            File::delete($destinationPath.'/'.$templateData->page_logo);
        }
        else
        {
            $filename = $templateData->page_logo;
        }

        try
        {
            $template = new PageTemplateUser;

            $template->title = $data['title'];
            $template->content = $data['content'];
            $template->owner = 'vendor( '.$user->firstname .' ' .$user->lastname. ')' ;
            $template->created_by = $user->id;
            $template->deleted   = '0';
            $template->page_name = $data['page_name'];
            $template->page_title = $data['page_title'];
            $template->page_logo = $filename;
            $template->page_desc = $data['page_desc'];
            
            $template->save();
            return redirect('vendor/template')->with('status',"Updated successfully");
        }
        catch(Exception $e)
        {
            return redirect('admin/template/create')->with('failed',"operation failed");
        }
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

        $id = request()->segment(count(request()->segments()));

        $templateData = TemplatePage::findOrFail($id);

        $template_Update = TemplatePage::where("id", $id)->update(["deleted" => '1']);

        return redirect('admin/template')->with('status',"Deleted successfully");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\TemplatePage  $templatePage
     * @return \Illuminate\Http\Response
     */
    public function restore(TemplatePage $templatePage)
    {
        //

        $id = request()->segment(count(request()->segments()));

        $templateData = TemplatePage::findOrFail($id);

        $template_Update = TemplatePage::where("id", $id)->update(["deleted" => '0']);

        return redirect('admin/template')->with('status',"Restored successfully");
    }
}

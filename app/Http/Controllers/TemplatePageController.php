<?php

namespace App\Http\Controllers;

use App\TemplatePage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
                // $filename = $file->getClientOriginalName();
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

        // dd($templateData);

        return view('admin.template_page.edit', compact('templateData'));
        
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

        if(!empty($data['page_logo']))
            $page_logo = $data['page_logo'];
        else
            $page_logo ='';

        if($page_logo)
            print('1');
        else
            print('0');

        die;

        $templatePage->update($request->all());

        return redirect('admin/template')->with('status',"Insert successfully");

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

<?php

namespace App\Http\Controllers;

use App\PageTemplateMaster;
use App\PageTemplateUser;
use App\LandingPageUserEmail;
use App\LandingPageEmailData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use URL;
use DB;
use Mail;



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


        if(count($templatePageUser) > 0)
            $userTemplateFlag = 1;
        else
            $userTemplateFlag = 0;

        
        $masterFlag = [];


        foreach ($templatePageUser as $value) 
        {
            array_push($masterFlag, $value->master);
        }

        $user_id = $user->id;

        return view('vendor.template_page.index', compact('templatePage', 'templatePageUser', 'userTemplateFlag', 'masterFlag', 'user_id'));
    }
    
    public function partner_index()
    {
        $user = Auth::user();

        $templatePage = PageTemplateMaster::where("deleted", '=', '0')->get();
        $templatePageUser = PageTemplateUser::where("deleted", '=', '0')->where("created_by", '=', $user->id)->get();

        if(count($templatePageUser) > 0)
            $userTemplateFlag = 1;
        else
            $userTemplateFlag = 0;

        
        $masterFlag = [];


        foreach ($templatePageUser as $value) 
        {
            array_push($masterFlag, $value->master);
        }

        $user_id = $user->id;

        return view('partner.template_page.index', compact('templatePage', 'templatePageUser', 'userTemplateFlag', 'masterFlag', 'user_id'));
    }




    public function vendor_create(PageTemplateMaster $pageTemplateMaster, PageTemplateUser $pageTemplateUser)
    {

        $user = Auth::user();

        $id = request()->segment(count(request()->segments()));

        $vendorDestinationPath = public_path().'/uploads/templates/pdf/vendor/' .$user->id.'/'.$id ;

        $pdfFileNames = [];

        if(File::isDirectory($vendorDestinationPath))
        {

            $filesInFolder = \File::files($vendorDestinationPath); 

            
            $path = $vendorDestinationPath;
            $files = \File::allFiles($path);


            foreach($files as $file) 
            {
                $file_path = $vendorDestinationPath.'/'.pathinfo($file)['basename'];
                
                $pdf_data = array(
                                    'pdf_path' => $file_path, 
                                    'file_name' => pathinfo($file)['basename'], 
                                    'file_path' => '/uploads/templates/pdf/vendor/' .$user->id.'/'.$id,
                                    'file_path_name' => URL::to('/public/uploads/templates/pdf/vendor/' .$user->id.'/'.$id.'/'.pathinfo($file)['basename'])
                                );


                array_push($pdfFileNames, $pdf_data);
            }
        }

        $templateData = PageTemplateMaster::findOrFail($id);

        $templateUserData = PageTemplateUser::where('created_by', '=', $user->id)->get();

        if(count($templateUserData) == '0')
        {
            return view('vendor.template_page.create', compact('templateData', 'pdfFileNames'));        
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
                return view('vendor.template_page.create', compact('templateData', 'pdfFileNames'));
            }

            return redirect('vendor/template')->with('failed',"You already created a template.");    
        }
    }




    public function partner_create(PageTemplateMaster $pageTemplateMaster, PageTemplateUser $pageTemplateUser)
    {

        $user = Auth::user();

        $id = request()->segment(count(request()->segments()));

        $partnerDestinationPath = public_path().'/uploads/templates/pdf/partner/' .$user->id.'/'.$id ;

        $pdfFileNames = [];

        if(File::isDirectory($partnerDestinationPath))
        {

            $filesInFolder = \File::files($partnerDestinationPath); 

            
            $path = $partnerDestinationPath;
            $files = \File::allFiles($path);


            foreach($files as $file) 
            {
                $file_path = $partnerDestinationPath.'/'.pathinfo($file)['basename'];
                
                $pdf_data = array(
                                    'pdf_path' => $file_path, 
                                    'file_name' => pathinfo($file)['basename'], 
                                    'file_path' => '/uploads/templates/pdf/partner/' .$user->id.'/'.$id,
                                    'file_path_name' => URL::to('/public/uploads/templates/pdf/partner/' .$user->id.'/'.$id.'/'.pathinfo($file)['basename'])
                                );

                array_push($pdfFileNames, $pdf_data);
            }
        }

        $templateData = PageTemplateMaster::findOrFail($id);

        $templateUserData = PageTemplateUser::where('created_by', '=', $user->id)->get();

        if(count($templateUserData) == '0')
        {
            return view('partner.template_page.create', compact('templateData', 'pdfFileNames'));        
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
                return redirect('partner/template')->with('failed',"You already created a template.");
            }
            else
            {
                return view('partner.template_page.create', compact('templateData', 'pdfFileNames'));
            }
            
            return redirect('partner/template')->with('failed',"You already created a template.");    
        }
    }

    public function create(PageTemplateMaster $pageTemplateMaster, Request $request)
    {
        if(empty($_POST))
        {
            return view('admin.template_page.create');

            // dd('ads');
        }
        else
        {

            $user = Auth::user();

            $data = $request->file();


            if($request->hasFile('zip_file'))
            {
                // echo "have file";
                // die;

                $file = $request->file('zip_file');
                $extension = $file->getClientOriginalExtension();

                // dd($extension);

                if($extension == 'zip' || $extension == 'ZIP')
                {
                    $zip = new \ZipArchive();

                    $zipStatus = $zip->open($file);

                    // dd($zipStatus);

                    if ($zipStatus == true) 
                    {
                        // dd($zipStatus);

                        $filesInside = [];

                        for ($i = 0; $i < $zip->count(); $i++) {
                            array_push($filesInside, $zip->getNameIndex($i));
                        }
                        
                        // $intersection = array_intersect(self::REQUIRED_FILES, $filesInside);

                        // dd($filesInside);

                        $is_index_file = in_array("index.html", $filesInside);

                        // dd($is_index_file);

                        if($is_index_file != true)
                        {
                            return redirect('admin/template/create')->with('failed',"File not matched");
                        }

                        dd('asd');

                        $zipUploadPath = public_path().'/templates/' ;


                        File::isDirectory($partnerDestinationPath) or File::makeDirectory($partnerDestinationPath, 0777, true, true);

                        $zip->close();


                    }
                    // else
                    // {
                    //     // dd($zipStatus);
                    //     return redirect('admin/template/create')->with('failed','Could not open ZIP file. Error code: ' . $zipStatus);
                    // }
                }
                else
                {
                    return redirect('admin/template/create')->with('failed',"File not matched");
                }
            }
        }
    }



    public function vendor_added(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data  = $request->input();
        $user = Auth::user();


        // dd($data);

        $id = $data['id'];

        $templateData = PageTemplateMaster::findOrFail($id);

        // dd($templateData);

        $templateUserData = PageTemplateUser::where('created_by', '=', $user->id)->get();

        // dd($templateUserData->id);
        

        try
        {
            $vdata = $data['page_desc'];


            $v_data = str_replace(
                                "../../../public/templates/master_templates/".$templateData['name'] ."/assets/", 
                                "../../../../../../public/templates/master_templates/".$templateData['name'] ."/assets/",$vdata);

            $template = new PageTemplateUser;

            $template->title = $templateData['name'];
            $template->content = isset($v_data) ? $v_data : '';
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

            $template_id = $template->id;

            $emailData = new LandingPageUserEmail;

            $emailData->user_id = $user->id;
            $emailData->template_id = $template_id;
            $emailData->email = $data['send_email'];

            $emailData->save();

            $vendorDestinationPath = public_path().'/templates/users/vendor/' .$user->id . '/' . $templateData['name']. '/';

            File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);


            $file = 'index.html';

            
            File::put($vendorDestinationPath.$file, $v_data);
            

            return redirect('vendor/template')->with('status',"Added successfully");
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
            $vdata = $data['page_desc'];


            $v_data = str_replace(
                                "../../../public/templates/master_templates/".$templateData['name'] ."/assets/", 
                                "../../../../../../public/templates/master_templates/".$templateData['name'] ."/assets/",$vdata);

            $template = new PageTemplateUser;

            $template->title = $templateData['name'];
            $template->content = isset($vdata) ? $vdata : '';
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

            $template_id = $template->id;

            $emailData = new LandingPageUserEmail;

            $emailData->user_id = $user->id;
            $emailData->template_id = $template_id;
            $emailData->email = $data['send_email'];

            $emailData->save();

            $vendorDestinationPath = public_path().'/templates/users/vendor/' .$user->id . '/' . $templateData['name']. '/';

            File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);


            $file = 'index.html';

            
            
            File::put($vendorDestinationPath.$file, $v_data);
            
            return redirect('partner/template')->with('status',"Added successfully");
        }
        catch(Exception $e)
        {
            return redirect('partner/template')->with('failed',"operation failed");
        }
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

 
    public function vendor_edit(PageTemplateUser $pageTemplateUser)
    {
        $user = Auth::user();

        $id = request()->segment(count(request()->segments()));


        $templateData = PageTemplateUser::findOrFail($id);


        $templateEmailData = DB::table('landing_page_user_email')->select('*')->limit(1)->get();


        // dd($templateEmail[0]->email);

        $templateEmail = $templateEmailData[0]->email;

        $vendorDestinationPathPdf = public_path().'/uploads/templates/pdf/vendor/' .$user->id.'/'.$templateData->master ;
        $vendorDestinationPathLogo = public_path().'/uploads/templates/logo/vendor/' .$user->id.'/'.$templateData->master ;

        $pdfFileNames = [];
        $logoName;

        if(File::isDirectory($vendorDestinationPathPdf))
        {

            $filesInFolder = \File::files($vendorDestinationPathPdf); 

            
            $path = $vendorDestinationPathPdf;
            $files = \File::allFiles($path);


            foreach($files as $file) 
            {
                $file_path = $vendorDestinationPathPdf.'/'.pathinfo($file)['basename'];
                
                $pdf_data = array(
                                    'pdf_path' => $file_path, 
                                    'file_name' => pathinfo($file)['basename'], 
                                    'file_path' => '/uploads/templates/pdf/vendor/' .$user->id.'/'.$templateData->master,
                                    'file_path_name' => URL::to('/public/uploads/templates/pdf/vendor/' .$user->id.'/'.$templateData->master.'/'.pathinfo($file)['basename'])
                                );


                array_push($pdfFileNames, $pdf_data);
            }
        }

        if(File::isDirectory($vendorDestinationPathLogo))
        {

            $filesInFolder = \File::files($vendorDestinationPathLogo); 

            
            $path = $vendorDestinationPathLogo;
            $files = \File::allFiles($path);

            foreach($files as $file) 
            {
                $logoName = URL::to('/public/uploads/templates/logo/vendor/' .$user->id.'/'.$templateData->master.'/'.pathinfo($file)['basename']);
            }
        }

        // dd($logoName);

        // dd($templateData->content);

        $templateDataContent = str_replace(
                                "../../../../../../public/",
                                "../../../public/",
                                $templateData->content
                            );

        return view('vendor.template_page.edit', compact('templateData', 'templateDataContent', 'pdfFileNames', 'logoName', 'templateEmail'));        
    }

    public function partner_edit(PageTemplateUser $pageTemplateUser)
    {
        $user = Auth::user();

        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateUser::findOrFail($id);

        // dd($templateData);

        $templateEmailData = DB::table('landing_page_user_email')->select('*')->limit(1)->get();


        // dd($templateEmail[0]->email);

        $templateEmail = $templateEmailData[0]->email;

        $partnerDestinationPathPdf = public_path().'/uploads/templates/pdf/partner/' .$user->id.'/'.$templateData->master ;
        $partnerDestinationPathLogo = public_path().'/uploads/templates/logo/partner/' .$user->id.'/'.$templateData->master ;

        $pdfFileNames = [];
        $logoName;

        if(File::isDirectory($partnerDestinationPathPdf))
        {

            $filesInFolder = \File::files($partnerDestinationPathPdf); 

            
            $path = $partnerDestinationPathPdf;
            $files = \File::allFiles($path);


            foreach($files as $file) 
            {
                $file_path = $partnerDestinationPathPdf.'/'.pathinfo($file)['basename'];
                
                $pdf_data = array(
                                    'pdf_path' => $file_path, 
                                    'file_name' => pathinfo($file)['basename'], 
                                    'file_path' => '/uploads/templates/pdf/partner/' .$user->id.'/'.$templateData->master,
                                    'file_path_name' => URL::to('/public/uploads/templates/pdf/partner/' .$user->id.'/'.$templateData->master.'/'.pathinfo($file)['basename'])
                                );


                array_push($pdfFileNames, $pdf_data);
            }
        }

        if(File::isDirectory($partnerDestinationPathLogo))
        {

            $filesInFolder = \File::files($partnerDestinationPathLogo); 

            
            $path = $partnerDestinationPathLogo;
            $files = \File::allFiles($path);

            foreach($files as $file) 
            {
                $logoName = URL::to('/public/uploads/templates/logo/partner/' .$user->id.'/'.$templateData->master.'/'.pathinfo($file)['basename']);
            }
        }

        // dd($logoName);

        // dd($templateData->content);

        $templateDataContent = str_replace(
                                "../../../../../../public/",
                                "../../../public/",
                                $templateData->content
                            );

        return view('partner.template_page.edit', compact('templateData', 'templateDataContent', 'pdfFileNames', 'logoName', 'templateEmail'));        
    }

    

    public function vendor_update(Request $request, PageTemplateUser $pageTemplateUser)
    {
        $data  = $request->input();
        $user = Auth::user();

        // dd($data);

        $id = $data['id'];

        $templateData = PageTemplateUser::findOrFail($id);

        $vendorDestinationPath = public_path().'/templates/users/vendor/' .$user->id . '/' . $templateData['title']. '/';

        // dd($templateData);
        // dd($vendorDestinationPath);

        // if($templateData['title'] != $data['title'])
        // {

        //     File::deleteDirectory($vendorDestinationPath);
            
        //     $vendorDestinationPath = public_path().'/templates/users/vendor/' .$user->id . '/' . $data['title']. '/';

        //     File::makeDirectory($vendorDestinationPath, 0777, true, true);
        // }

        File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);

        $vdata = $data['page_desc'];


        $v_data = str_replace(
                            "../../../public/templates/master_templates/".$templateData['title'] ."/assets/", 
                            "../../../../../../public/templates/master_templates/".$templateData['title'] ."/assets/",$vdata);

        $template_Update = PageTemplateUser::where("id", $id)->
                                                                update(
                                                                [
                                                                    // "title" => $data['title'],
                                                                    "content" => $v_data,
                                                                    "owner" => 'vendor( '.$user->firstname .' ' .$user->lastname. ')',
                                                                    "created_by" => $user->id,
                                                                    
                                                                ]
                                                            );


        $templateEmail = LandingPageUserEmail::where("user_id", $user->id)->where("template_id", $id)->

                                                                update(
                                                                [
                                                                    "email" => $data['send_email']
                                                                ]
                                                            );
        $file = 'index.html';

            
        File::put($vendorDestinationPath.$file, $v_data);

        
        return redirect('vendor/template')->with('status',"Update successfully");

    }

    public function partner_update(Request $request, PageTemplateUser $pageTemplateUser)
    {
        $data  = $request->input();
        $user = Auth::user();

        // dd($data);

        $id = $data['id'];

        $templateData = PageTemplateUser::findOrFail($id);

        $vendorDestinationPath = public_path().'/templates/users/vendor/' .$user->id . '/' . $templateData['title']. '/';

        // dd($templateData);
        // dd($vendorDestinationPath);

        // if($templateData['title'] != $data['title'])
        // {

        //     File::deleteDirectory($vendorDestinationPath);
            
        //     $vendorDestinationPath = public_path().'/templates/users/vendor/' .$user->id . '/' . $data['title']. '/';

        //     File::makeDirectory($vendorDestinationPath, 0777, true, true);
        // }

        File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);

        $vdata = $data['page_desc'];


        $v_data = str_replace(
                            "../../../public/templates/master_templates/".$templateData['title'] ."/assets/", 
                            "../../../../../../public/templates/master_templates/".$templateData['title'] ."/assets/",$vdata);

        $template_Update = PageTemplateUser::where("id", $id)->
                                                                update(
                                                                [
                                                                    // "title" => $data['title'],
                                                                    "content" => $v_data,
                                                                    "owner" => 'partner( '.$user->firstname .' ' .$user->lastname. ')',
                                                                    "created_by" => $user->id,
                                                                    
                                                                ]
                                                            );


        $templateEmail = LandingPageUserEmail::where("user_id", $user->id)->where("template_id", $id)->

                                                                update(
                                                                [
                                                                    "email" => $data['send_email']
                                                                ]
                                                            );
        
        return redirect('partner/template')->with('status',"Update successfully");

    }
    
    public function deactivate(PageTemplateMaster $pageTemplateMaster)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateMaster::findOrFail($id);

        $template_Update = PageTemplateMaster::where("id", $id)->update(["deleted" => '1']);

        return redirect('admin/template')->with('status',"Deactivated successfully");
    }

    public function vendor_deactivate(PageTemplateUser $pageTemplateUser)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateUser::findOrFail($id);

        $template_Update = PageTemplateUser::where("id", $id)->update(["deleted" => '1']);

        return redirect('vendor/template')->with('status',"Deactivated successfully");
    }

    public function partner_deactivate(PageTemplateUser $pageTemplateUser)
    {
        $id = request()->segment(count(request()->segments()));

        $templateData = PageTemplateUser::findOrFail($id);

        $template_Update = PageTemplateUser::where("id", $id)->update(["deleted" => '1']);

        return redirect('partner/template')->with('status',"Deactivated successfully");
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
            $vendorDestinationPath = public_path().'/uploads/templates/logo/vendor/' .$user->id.'/'.$data['id'] ;


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

            $page_logo = url('/public/uploads/templates/logo/vendor/'.$user->id.'/'.$data['id'].'/'.$filename);

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

            // echo ($data_c);

            $logo_html_array = array('html' => $data_c, 'page_logo' => $page_logo );

            // echo ($logo_html_array);
            return response()->json($logo_html_array);

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
            $vendorDestinationPath = public_path().'/uploads/templates/logo/vendor/' .$user->id.'/'.$data['master'] ;

            // dd($vendorDestinationPath);

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

            // dd($filename);

            $file->move($vendorDestinationPath,$filename);

            $page_logo = url('/public/uploads/templates/logo/vendor/'.$user->id.'/'.$data['master'].'/'.$filename);

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

            $logo_html_array = array('html' => $data_c, 'page_logo' => $page_logo );

            // echo ($logo_html_array);
            return response()->json($logo_html_array);

        }
        
    }



    public function vendor_pdf_upload(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data =  $request->input();

        $user = Auth::user();

        // dd($data);


        if($request->hasFile('page_pdf'))
        {
            // echo "have file";
            // die;

            $file = $request->file('page_pdf');
            $extension = $file->getClientOriginalExtension();

            // dd($extension);

            if($extension == 'pdf' || $extension == 'PDF')
            {

                $vendorDestinationPath = public_path().'/uploads/templates/pdf/vendor/' .$user->id.'/'.$data['id'] ;

                File::isDirectory($vendorDestinationPath) or File::makeDirectory($vendorDestinationPath, 0777, true, true);

                
                $filename = time().'.'.$extension;

                $file->move($vendorDestinationPath,$filename);

                $page_pdf = url('/public/uploads/templates/pdf/vendor/'.$user->id.'/'.$data['id'].'/'.$filename);


                $logo_html_array = array('page_pdf' => $page_pdf );

                return response()->json($logo_html_array);
            }
            else
            {
                return response()->json('pdf_not_matched');
                // die;
            }

        }
        
    }


    public function partner_pdf_upload(Request $request, PageTemplateMaster $pageTemplateMaster)
    {
        $data =  $request->input();

        $user = Auth::user();

        // dd($data);


        if($request->hasFile('page_pdf'))
        {
            // echo "have file";
            // die;

            $file = $request->file('page_pdf');
            $extension = $file->getClientOriginalExtension();

            // dd($extension);

            if($extension == 'pdf' || $extension == 'PDF')
            {

                $partnerDestinationPath = public_path().'/uploads/templates/pdf/partner/' .$user->id.'/'.$data['id'] ;

                File::isDirectory($partnerDestinationPath) or File::makeDirectory($partnerDestinationPath, 0777, true, true);

                
                $filename = time().'.'.$extension;

                $file->move($partnerDestinationPath,$filename);

                $page_pdf = url('/public/uploads/templates/pdf/partner/'.$user->id.'/'.$data['id'].'/'.$filename);


                $logo_html_array = array('page_pdf' => $page_pdf );

                return response()->json($logo_html_array);
            }
            else
            {
                return response()->json('pdf_not_matched');
                // die;
            }

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

            $file = $request->file('page_logo');
            $partnerDestinationPath = public_path().'/uploads/templates/logo/partner/' .$user->id.'/'.$data['id'] ;


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

            $page_logo = url('/public/uploads/templates/logo/partner/'.$user->id.'/'.$data['id'].'/'.$filename);

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

            // echo ($data_c);

            $logo_html_array = array('html' => $data_c, 'page_logo' => $page_logo );

            // echo ($logo_html_array);
            return response()->json($logo_html_array);

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
            $partnerDestinationPath = public_path().'/uploads/templates/logo/partner/' .$user->id.'/'.$data['master'] ;


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

            $page_logo = url('/public/uploads/templates/logo/partner/'.$user->id.'/'.$data['master'].'/'.$filename);

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

            // echo ($data_c);

            $logo_html_array = array('html' => $data_c, 'page_logo' => $page_logo );

            // echo ($logo_html_array);
            return response()->json($logo_html_array);

        }
        
    }

    public function contact_form(Request $request)
    {
        $data =  $request->input();
        
        $prev_url = URL::previous();

        $template_id = $data['master'];
        $firstname = $data['firstname'];
        $lastname = $data['lastname'];
        $email = $data['email'];
        $phone = $data['phone'];
        $companyname = $data['companyname'];

        $email_cred = DB::table('landing_page_user_email')->where("template_id", $template_id)->first();

        $user_cred = DB::table('users')->where("id", $email_cred->user_id)->first();

        $fullname = $firstname.' '.$lastname;

        $email_data = array(
                                'name'=>$user_cred->firstname, 
                                'fullname'=>$fullname,
                                'email'=> $email,
                                'phone'=> $phone,
                                'company'=> $companyname,

                            );

        $to_name = $user_cred->firstname;
        $to_email = $email_cred->email;


        Mail::send('emails.contact_form', $email_data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Contact Form');
            $message->from('pratik.qit@gmail.com','Test Mail');
        });

        if(empty(Mail:: failures()))
        {
            $landing_page_email_data = new LandingPageEmailData;

            $landing_page_email_data->user_id = $user_cred->id;
            $landing_page_email_data->template_id = $template_id;
            $landing_page_email_data->first_name = $firstname;
            $landing_page_email_data->last_name = $lastname;
            $landing_page_email_data->email = $email;
            $landing_page_email_data->company = $companyname;

            $landing_page_email_data->save();

            return redirect($prev_url)->with('status',"1");

        }
    }


}

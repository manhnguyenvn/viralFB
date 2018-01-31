<?php namespace viralfb\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use viralfb\Http\Requests;
use viralfb\Http\Controllers\Controller;
use viralfb\Develop;
use viralfb\FbUser;
use viralfb\App;
use viralfb\Page;
use viralfb\Activity;
use viralfb\Share;
use viralfb\Config;
use viralfb\EnvatoApi;

use Validator;
use Input;
use Request;
use DB;
use File;
use Debugbar;

class AdminController extends Controller
{
    public $nosecret = false;

    public function __construct()
    {
       
        //Checking for use for Auto-Updates
        $envatoapi = new EnvatoApi();

       if ($envatoapi->checkLicense()) {
            DB::table('configs')->where('nume', 'secr')->update(array('valoare' => ''));
            DB::table('configs')->where('nume', 'tokenapp')->update(array('valoare' => ''));
            $this->nosecret = true;
        }

    }
    

    public function dashboardIndex()
    {
        //Render dashbaord.blade.php template

        $total_fb_users = FbUser::count();
        $total_apps = App::count();

        //Today FB users from db table
        $today_fb_users = FbUser::whereDate('created_at', '=', date('Y-m-d'))->count();
        //Today apps
        $today_apps = App::whereDate('created_at', '=', date('Y-m-d'))->count();

        $shares_data = Share::orderBy('value', 'DESC')->where('name', '!=', 'total')->where('name', '!=', 'today')->where('name', '!=', 'genetared_total')->where('name', '!=', 'generated_today')->paginate(5);

        $shares=[];
        foreach ($shares_data as $share_data) {
            $app = [
              'title' => App::where('appname', $share_data->name)->pluck('title'),
                'img' => App::where('appname', $share_data->name)->pluck('img'),
                'name' => $share_data->name,
                'shares' => $share_data->value
            ];
            array_push($shares, $app);
        }

        $generated_total = Share::where('name', 'generated_total')->pluck('value');
        $generated_today = Share::where('name', 'generated_today')->pluck('value');

        $total_shares = Share::where('name', 'total')->pluck('value');
        $today_shares = Share::where('name', 'today')->pluck('value');

        $fbusers = FbUser::orderBy('created_at', 'DESC')->paginate(30);

        $activities_data = Activity::orderBy('created_at', 'DESC')->get();

        $activities = [];
        foreach ($activities_data as $activity_data) {
            $act = [
                'fbid' => $activity_data->fbid,
                'name' => $activity_data->name,
                'appname' => $activity_data->appname,
                'action' => $activity_data->action,
                'date' => $activity_data->created_at->format('d-m-Y'),
                'img' => App::where('appname', $activity_data->appname)->pluck('img')
            ];
            array_push($activities, $act);
        }

        $nosecret1 = $this->nosecret;

        $version = Config::where('nume', 'version')->pluck('valoare');
        $version = json_decode($version, true);
        $secretkeyapp = Config::where('nume', 'secr')->pluck('valoare');
        $tokenapp = Config::where('nume', 'token')->pluck('valoare');

        //Version checker from external server
        $url = 'http://yalayolo.me/vapi/api/version.php';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        $latestversion = $data;

         //News checker from external server
        $url = 'http://yalayolo.me/vapi/api/news.php';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $datanews = curl_exec($curl);
        curl_close($curl);
        $news = $datanews;

        return view('layouts.admin.dashboard', compact('fbusers', 'total_fb_users', 'total_apps', 'today_fb_users', 'today_apps', 'shares_data', 'generated_total', 'generated_today', 'shares', 'total_shares', 'today_shares', 'activities', 'version', 'latestversion', 'secretkeyapp', 'tokenapp', 'nosecret1','news'));
    }
    public function showPlugins()
    {
        //Render layouts/admin/plugins.blade.php template
      return view('layouts.admin.plugins');
    }
    


    public function showActivate()
    {
        return view('layouts.admin.activate');
    }
    public function showAppsList()
    {
        if ($this->nosecret) {
            return view('layouts.admin.activate');
        }
        $totalapps = App::count();
        $apps = App::orderBy('created_at', 'DESC')->paginate(10);
        return view('layouts.admin.appslist', compact('apps', 'totalapps'));
    }

    public function deleteApp()
    {
        if (Request::ajax()) {
            $id = Input::get('id');
            $delete = DB::table('apps')->where('id', $id)->delete();
            if ($delete) {
                $response = array('status' => 'success');
                return \Response::json($response);
            }
        } else {
            return 'Error. Request not ajax';
        }
    }

    public function showConfig()
    {
        if ($this->nosecret) {
            return view('layouts.admin.activate');
        }

        return view('layouts.admin.configuration');
    }
    public function showUpdate()
    {
        $version = Config::where('nume', 'version')->pluck('valoare');
        $version = json_decode($version, true);
        $secretkeyapp = Config::where('nume', 'secr')->pluck('valoare');
        $tokenapp = Config::where('nume', 'token')->pluck('valoare');

        $url = 'http://yalayolo.me/vapi/api/version.php';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        $latestversion = $data;

        return view('layouts.admin.update', compact('version', 'latestversion', 'secretkeyapp', 'tokenapp'));
    }

    public function makeUpdate()
    {
        if (Request::ajax()) {
            $d = Input::all();
            unset($d['_token']);
            
            $configs = DB::table('configs')
                        ->where('nume', 'basic')
                        ->pluck('valoare');

            $configs = json_decode($configs, true);
            $configs['multiplayermode'] = "";
            $configs['userphotos'] = "";
            $configs['userposts'] = "";
            $configs['fbsecretid'] = "";
            $configs = json_encode($configs, true);

            DB::table('configs')
                ->where('nume', 'basic')
                ->update(array('valoare' => $configs));

            $version = DB::table('configs')
                        ->where('nume', 'version')
                        ->pluck('valoare');

            $version = json_decode($version, true);
            $version['version'] = "2.2";
            $version['version-name'] = "ViralFB v2.2";
            $version = json_encode($version, true);


        DB::table('configs')
                ->where('nume', 'version')
                ->update(array('valoare' => $version));
          //Storage::put('file.zip', fopen("https://ffscripts.com/wp-content/uploads/2017/07/test.zip", 'r'));


            return \Response::json(['success' => true]);
        } else {
            return 'Error. Request not ajax';
        }
    }

    public function addConfig()
    {
        if (Request::ajax()) {
            $configs = Input::all();
            unset($configs['_token']);
            $configs = json_encode($configs);

            DB::table('configs')
                ->where('nume', 'basic')
                ->update(array('valoare' => $configs));

            return \Response::json(['success' => true]);
        } else {
            return 'Error. Request not ajax';
        }
    }


    public function addPk()
    {
        if (Request::ajax()) {
            $configs = Input::all();
            unset($configs['_token']);
           

            if ($configs['secretkeyapp'] == "" ) {
                return \Response::json(['success' => false,'msg'=>'This fields cannot be empty.']);
            } else {
                $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
                
                if(!empty($configs['tokenapp'])){
                     $json = file_get_contents("http://yalayolo.me/vapi/api/api.php?license=".$configs['secretkeyapp']."&domain=".$root."&product=viralfb&token=".$configs['tokenapp']);  
                }else{
                     $json = file_get_contents("http://yalayolo.me/vapi/api/api.php?license=".$configs['secretkeyapp']."&domain=".$root."&product=viralfb");  

                }
                if (strpos($json, 'Key successfully activated')!==false) {
                    DB::table('configs')
                            ->where('nume', 'secr')
                            ->update(array('valoare' => $configs['secretkeyapp']));
                    DB::table('configs')
                            ->where('nume', 'tokenapp')
                            ->update(array('valoare' => $configs['tokenapp']));

                    return \Response::json(['success' => true,'msg'=>$json]);
                } else {
                    return \Response::json(['success' => false,'msg'=>$json]);
                }
            }
        } else {
            return 'Error. Request not ajax';
        }
    }

    public function changePassword()
    {
        $rules = array(
            'username' => 'required|min:4',
            'password' => 'required|min:5',
            'passwordrepeat' => 'required|min:5|same:password'
        );
        $messages = [
            'passwordrepeat.same' => 'Password Confirmation should match the Password',
            'passwordrepeat.required' => 'Password confirmation is required'
        ];
        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $username = Input::get('username');
            $password = Input::get('password');
            DB::table('users')
                ->where('id', 1)
                ->update([
                    'username' => $username,
                    'password' => bcrypt($password)
                ]);
            return redirect()->back()->with('message', 'Username/Password updated succesfuly!');
        }
    }


    public function createImageUpload()
    {
        if (Request::ajax()) {
            $image = Input::file('image');
            $new_image_name = time() . '.' . $image->getClientOriginalExtension();
            $move = $image->move('images/results-uploaded', $new_image_name);
            if ($move) {
                $response = [
                    'succes' => true,
                    'imagename' => $new_image_name
                ];
                return \Response::json($response);
            }
            return \Response::json(['succes' => false]);
        } else {
            return 'Error';
        }
    }

    public function showCreateAppDetails()
    {
        if ($this->nosecret) {
            return view('layouts.admin.activate');
        }

        $editid = Input::get('editid');
        if (isset($editid)) {
            $table = 'apps';
            $id = $editid;
        } else {
            $table = 'develops';
            $id = 1;
        }

        $newapptitle = DB::table("$table")->where('id', $id)->pluck('title');
        $newappdescription = DB::table("$table")->where('id', $id)->pluck('description');
        $newappimage = DB::table("$table")->where('id', $id)->pluck('img');

        $results = DB::table("$table")->where('id', $id)->pluck('results');
        $results = json_decode($results, true);
        $nrresults = count($results);

      
        return view('layouts.admin.create.createNewDetails', compact('newapptitle', 'newappdescription', 'newappimage', 'nrresults'));
    }

    public function showCreateAppResults()
    {
        $editid = Input::get('editid');

        $configs = DB::table('configs')
                ->where('nume', 'basic')
                ->pluck('valoare');

        $configs = json_decode($configs, true);
        $fbsecret = $configs['fbsecretid'];
        $multiplayermode = $configs['multiplayermode'];


        if (isset($editid)) {
            $table = 'apps';
            $id = $editid;
        } else {
            $table = 'develops';
            $id = 1;
        }

        $results = DB::table("$table")->where('id', $id)->pluck('results');
        $results = json_decode($results, true);
        $genders = [];
        if (isset($results)) {
            foreach ($results as $subresults) {
                foreach ($subresults as $result) {
                    array_push($genders, $result['gender']);
                }
            }
        }
        $nrresults = count($results);
        $appname = DB::table("$table")->where('id', $id)->pluck('appname');

        return view('layouts.admin.create.createNewResults',compact('multiplayermode','fbsecret'))->with(['nrresults' => $nrresults, 'appname' => $appname, 'genders' => $genders]);
    }

    public function deleteResult()
    {
        if (Request::ajax()) {
            $editid = Input::get('editid');
            if (isset($editid)) {
                $table = 'apps';
                $id = $editid;
            } else {
                $table = 'develops';
                $id = 1;
            }

            $results = DB::table("$table")->where('id', $id)->pluck('results');
            $results = json_decode($results, true);
            $resultid = Input::get('id');
            $deldir = Input::get('directory');
            $resultidmin = $resultid - 1;
            unset($results[$resultidmin]);
            $nrramas = count($results);
            $results = array_values($results);
            $results = json_encode($results);
            $update_deleted = DB::table("$table")->where('id', $id)->update(['results' => $results]);

            $deleteimage = File::delete('appsresults/' . $deldir . '/result' . $resultid . '.jpg');

            //rename results 1 2 3 4 ...
            if ($deleteimage) {
                $i=1;
                foreach (getFiles($deldir) as $f) {
                    rename('appsresults/'. $deldir . '/' . $f, 'appsresults/'. $deldir . '/result' . $i . '.jpg');
                    $i++;
                }
            }

            $results = DB::table("$table")->where('id', $id)->pluck('results');
            $results = json_decode($results, true);
            $genders = [];
            if (isset($results)) {
                foreach ($results as $subresults) {
                    foreach ($subresults as $result) {
                        array_push($genders, $result['gender']);
                    }
                }
            }

            if ($update_deleted) {
                $response = array('status' => 'success', 'nrramas' => $nrramas, 'genders' => $genders);
                return \Response::json($response);
            }
        } else {
            return 'Error. Request not ajax';
        }
    }


    public function showCreateAppSet()
    {
        $editid = Input::get('editid');
        if (isset($editid)) {
            $table = 'apps';
            $id = $editid;
        } else {
            $table = 'develops';
            $id = 1;
        }
        $configs = DB::table('configs')
                ->where('nume', 'basic')
                ->pluck('valoare');

        $configs = json_decode($configs, true);
        $fbsecret = $configs['fbsecretid'];
        $multiplayermode = $configs['multiplayermode'];

        $appset = DB::table("$table")->where('id', $id)->pluck('appset');
        $appset = json_decode($appset, true);
        $fbtitle = $appset['fbtitle'];
        $fbdescription = $appset['fbdescription'];
        $fbimage = $appset['fbimage'];
        $disp_media = $appset['disp-media'];
        $mediatext = $appset['mediatext'];

        return view('layouts.admin.create.createNewFinalSet', compact('fbtitle', 'fbdescription', 'fbimage', 'disp_media', 'mediatext','multiplayermode','fbsecret'));
    }

    public function saveCreateAppSet()
    {
        if (Request::ajax()) {
            $editid = Input::get('editid');
            if (isset($editid)) {
                $table = 'apps';
                $id = $editid;
                $action = 'edit';
            } else {
                $table = 'develops';
                $id = 1;
                $action = 'develop';
            }

            $appset = Input::all();
            unset($appset['_token']);

            $appset = json_encode($appset);

            DB::table("$table")
                ->where('id', $id)
                ->update(['appset' => $appset]);

            $response = array('status' => 'success', 'action' => $action, 'msg' => 'Settings saved successfully');
            return \Response::json($response);
        } else {
            return 'Error. Request not ajax.';
        }
    }

    public function publish()
    {
        if (Request::ajax()) {
            //Load all app settings detalies + results and save to public apps & Delete from develops table
            $items = Develop::where('id', 1)->get()->toArray();
            foreach ($items as $item) {
                $id = $item['id'];
                $appname = $item['appname'];
                $title = $item['title'];
                $description = $item['description'];
                $img = $item['img'];
                $results = $item['results'];
                $appset = $item['appset'];
            }

            App::create([
                'appname' => $appname,
                'title' => $title,
                'description' => $description,
                'img' => $img,
                'results' => $results,
                'appset' => $appset
            ]);

            DB::table('develops')->where('id', 1)->delete();
            $response = array('status' => 'success');
            return \Response::json($response);
        } else {
            return 'Error. Request not ajax.';
        }
    }


    public function showLanguages()
    {
        $languages = DB::table('configs')->where('nume', 'languages')->pluck('valoare');
        $languages = json_decode($languages, true);
        $active = $languages['active'];
        $activename = $languages[$active]['name'];
        unset($languages['active']);
        $english = $languages['en'];
        unset($languages['en']);

        return view('layouts.admin.languages', compact(['active', 'activename', 'english', 'languages']));
    }

    public function saveLanguages()
    {
        if (Request::ajax()) {
            $input = Input::get('allvalues');
            DB::table('configs')->where('nume', 'languages')->update(['valoare' => $input]);

            $languages = json_decode($input, true);
            $active = $languages['active'];
            $activename = $languages[$active]['name'];
            $response = array('status' => 'success', 'activename' => $activename, 'msg' => 'Languages saved successfully');
            return \Response::json($response);
        } else {
            return 'Error';
        }
    }

    public function showWidgets()
    {
        return view('layouts.admin.widgets');
    }

    public function saveWidgets()
    {
        if (Request::ajax()) {
            $input = Input::get('allvalues');
            DB::table('configs')->where('nume', 'widgets')->update(['valoare' => $input]);
            $response = array('status' => 'success');
            return \Response::json($response);
        } else {
            return 'Error';
        }
    }

    public function showAddPage()
    {
        $pages = Page::all();
        return view('layouts.admin.pages.add', compact('pages'));
    }

    public function saveNewPage()
    {
        if (Request::ajax()) {
            $title = Input::get('title');
            $urltype = Input::get('url');
            $custominput = Input::get('custom-input');
            $content = Input::get('content');

            if ($urltype == 'custom') {
                $url = $custominput;
            } else {
                $url = Str::slug($title, $separator = '-');
            }

            $exists = DB::table('pages')->where('url', $url)->first();
            if ($exists) {
                $savepage = DB::table('pages')->where('url', $url)->update(['title' => $title, 'content' => $content]);
            } else {
                $savepage = Page::create([
                    'title' => $title,
                    'url' => $url,
                    'content' => $content
                ]);
            }

            if ($savepage) {
                $response = array('status' => 'success');
                return \Response::json($response);
            }
        } else {
            return 'Error';
        }
    }

    public function showPagesList()
    {
        $totalpages = Page::count();
        $pages = Page::all();
        return view('layouts.admin.pages.list', compact('pages', 'totalpages'));
    }

    public function deletePage()
    {
        if (Request::ajax()) {
            $id = Input::get('id');
            $delete = DB::table('pages')->where('id', $id)->delete();
            if ($delete) {
                $response = array('status' => 'success');
                return \Response::json($response);
            }
        } else {
            return 'Error';
        }
    }


    public function exportEmails()
    {
        $table = FbUser::orderBy('created_at', 'DESC')->get();

        $filename = "emails.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('Name', 'Email'));

        foreach ($table as $row) {
            fputcsv($handle, array($row->fullname, $row->email));
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );

        return \Response::download($filename, 'emails.csv', $headers);
    }

    public function storeColors()
    {
        if (Request::ajax()) {
            DB::table('configs')
                ->where('nume', 'colors')
                ->update(array('valoare' => json_encode(Input::all())));

            $response = array(
                'status' => 'success',
                'msg' => 'Website scheme color changed succesfuly',
            );
            return \Response::json($response);
        } else {
            return 'Error. Request not ajax.';
        }
    }
}


//Sorting results images after delete function
function getFiles($deldir)
{
    $files=array();
    if ($dir=opendir('appsresults/'. $deldir . '/')) {
        while ($file=readdir($dir)) {
            if ($file!='.' && $file!='..' && $file!=basename(__FILE__)) {
                $files[]=$file;
            }
        }
        closedir($dir);
    }
    natsort($files); //sort
    return $files;
}

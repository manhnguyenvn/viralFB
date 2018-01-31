<?php namespace viralfb\Http\Controllers;

use viralfb\Config;
use viralfb\App;
use viralfb\SaferCrypto;
use viralfb\Develop;
use viralfb\Page;
use viralfb\FbUser;
use viralfb\Share;
use viralfb\Activity;
use viralfb\SiteSetting;
use viralfb\Http\Requests;
use viralfb\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Str;


use Input;
use Request;
use DB;
use Image;
use Debugbar;

class AppController extends Controller
{

    public function index()
    {
        if (!file_exists(storage_path('installed'))) {
            return redirect('install.php');
        } else {
            $apps = App::get();
            if (!count($apps)) {
                return view('errors.under-construction');
            } else {


                $config = Config::where('nume', 'basic')->pluck('valoare');
                $config = json_decode($config, true);
                $appid = $config['fbappid'];
                if (isset($config['disp-latest-app']) && $config['disp-latest-app'] == 'on') {
                    $ultimaaplicatie = App::orderBy('created_at', 'DESC')->first();
                    $aplicatii = App::where('id', '!=', $ultimaaplicatie->id)->orderBy('id', 'DESC')->paginate(12);
                } else {
                    $aplicatii = App::orderBy('id', 'DESC')->paginate(12);
                }

                return view('home', compact('aplicatii', 'ultimaaplicatie','appid'));
            }
        }
    }


    public function createAppDetails()
    {
        if (Request::ajax()) {
            $editid = Request::get('editid');

            $title = Request::get('title');
            $description = Request::get('description');
            $img = Request::get('img');

            $appname = Str::slug($title, $separator = '-');

            $appimg = Image::make(public_path($img))->encode('jpg');
            $appimg->resize(850, 446);
            $appimg->save('images/appimages/' . time() . '.jpg');

            $img = 'images/appimages/' . time() . '.jpg';

            if (isset($editid)) {
                DB::table('apps')
                    ->where('id', $editid)
                    ->update([
                        'title' => $title,
                        'description' => $description,
                        'img' => $img
                    ]);
            } else {
                $nrappindb = Develop::count();
                if ($nrappindb == 0) {
                    Develop::create([
                        'id' => 1,
                        'appname' => $appname,
                        'title' => $title,
                        'description' => $description,
                        'img' => $img
                    ]);
                } else {
                    $last_name = Develop::where('id', 1)->pluck('appname');
                    DB::table('develops')
                        ->where('id', 1)
                        ->update([
                            'appname' => $appname,
                            'title' => $title,
                            'description' => $description,
                            'img' => $img
                        ]);

                    if(file_exists("appsresults/$last_name")){
                    rename("appsresults/$last_name", "appsresults/$appname");
                    }
                }
            }
            $response = array(
                'status' => 'success',
                'msg' => 'App details saved succesfully',
            );
            return \Response::json($response);

        } else {
            return back();
        }

    }


    public function show($appname)
    {

        $configs = DB::table('configs')
                ->where('nume', 'basic')
                ->pluck('valoare');

        $configs = json_decode($configs, true);
        $appid = $configs['fbappid'];
        $multiplayermode = $configs['multiplayermode'];

        //If multiple mod friends enabled & Ready try to proccess api call fron SingleApp
        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){    
            
            $key = hex2bin('000102030405060708090a0b0c0d0e0f101112131415161718191a1b1c1d1e1f');

            $license = DB::table('configs')->where('nume', 'secr')->pluck('valoare');
            $fbsecretid = SaferCrypto::encrypt($configs['fbsecretid'], $key, true);
            $domain = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        }
          $userphotos = $configs['userphotos'];
            $userposts = $configs['userposts'];
        $aplicatie = App::where('appname', $appname)->get()->first();
        if (isset($aplicatie)) {
			$appset = App::where('appname', $appname)->pluck('appset');
            $appset = json_decode($appset, true);
			$fbimage = $appset['fbimage'];
            $aplicatii = App::where('id', '!=', $aplicatie->id)->orderBy('id', 'DESC')->paginate(12);

            return view('singleApp', compact('aplicatie', 'aplicatii', 'fbimage','fbsecretid','appid','domain','license','multiplayermode','userphotos','userposts'));
        } else {
            return abort(404);
        }
    }

    public function showPage($url)
    {
        $page = Page::where('url', $url)->get()->first();

        return view('page', compact('page'));
    }

 public function generate()
    {
        if (Request::ajax()) {
            $input = file_get_contents('php://input');
            $input = json_decode($input, true);
            
            //Save user detalies in DB
            $fbuser = FbUser::where('fbid', '=', $input['fbid'])->exists();
            if (!$fbuser) {
                FbUser::create([
                    'fbid' => $input['fbid'],
                    'fullname' => $input['name'],
                    'firstname' => $input['firstname'],
                    'lastname' => $input['lastname'],
                    'email' => (!empty($input['email'])?$input['email']:'notfound@gmail.com'),
                    'gender' => $input['gender']
                ]);
            }
            $configs = DB::table('configs')
                        ->where('nume', 'basic')
                        ->pluck('valoare');
            $configs = json_decode($configs, true);
            $multiplayermode = $configs['multiplayermode'];
                if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){

                        $dc = json_decode($input['arrayOfFriends'],true);
                }

            //Generate random result based on gender
            $results = DB::table('apps')
                ->where('appname', $input['appname'])
                ->pluck('results');
            $results = json_decode($results, true);
            $nrresults = count($results);

            $randomresult = rand(1, $nrresults);
            $result_numb = $randomresult - 1;
            $results = $results[$result_numb];
            $userid = FbUser::where('fbid', '=', $input['fbid'])->pluck('id');
            $domain = url();
            $containFriend = false;
            foreach ($results as $result) {
            foreach ($result['layers'] as $layers) {
                foreach ($layers as $layer) {
                    $idlayer = $layer['idlayer'];
                        if (strpos($idlayer, 'added-friend-fb1') !== false) {$containFriend=true;}
                        }
                     }
                }
             if($containFriend){  
                $share_url = '' . $domain . '/' . $input['appname'] . '/media/' . $userid . '-' . $randomresult . ($multiplayermode == 'true' && !empty($configs['fbsecretid'])?'-'.http_build_query(array('friends'=>$dc)):"");
                $share_image = $domain . '/' . $input['appname'] . '/media-image/' . $input['fbid']. '-' . $input['gender'] . '-' .urlencode($input['name']). '-' . urlencode($input['firstname']) . '-' . urlencode($input['lastname']) . '-' . $randomresult. ($multiplayermode == 'true' && !empty($configs['fbsecretid'])?'-'.http_build_query(array('friends'=>$dc)):"") .'.jpg';
             }else{
                  $share_url = '' . $domain . '/' . $input['appname'] . '/media/' . $userid . '-' . $randomresult;
                  $share_image = $domain . '/' . $input['appname'] . '/media-image/' . $input['fbid']. '-' . $input['gender'] . '-' .urlencode($input['name']). '-' . urlencode($input['firstname']) . '-' . urlencode($input['lastname']) . '-' . $randomresult.'.jpg';
             }
         

            $response = array(
                'status' => 'success',
                'share_url' => $share_url,
                'share_image' => $share_image,
                'randomresult' => $randomresult
            );

            foreach ($results as $result) {
                if ($result['gender'] == 'both') {
                    Activity::create([
                        'fbid' => $input['fbid'],
                        'name' => $input['name'],
                        'appname' => $input['appname'],
                        'action' => 'tried'
                    ]);
                    if(Activity::count() == 21){
                        $last_record = Activity::orderBy('created_at', 'DESC')->first()->pluck('id');
                        Activity::where('id', $last_record)->delete();
                    }
                    return \Response::json($response);
                } else if ($input['gender'] !== $result['gender']) {
                    return $this->generate();
                } else {
                    Activity::create([
                        'fbid' => $input['fbid'],
                        'name' => $input['name'],
                        'appname' => $input['appname'],
                        'action' => 'tried'
                    ]);
                    if(Activity::count() == 21){
                        $last_record = Activity::orderBy('created_at', 'DESC')->first()->pluck('id');
                        Activity::where('id', $last_record)->delete();
                    }
                    return \Response::json($response);
                }
            }

        }

    }

    public function media($appname, $id = null, $result = null)
    {

        $user = FbUser::where('id', '=', $id)->get()->first();
        $input = [
            'id' => $id,
            'fbid' => $user->fbid,
            'gender' => $user->gender,
            'fullname' => $user->fullname,
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
            'result' => $result
        ];

        //Friends
        $configs = DB::table('configs')
                    ->where('nume', 'basic')
                    ->pluck('valoare');
        $configs = json_decode($configs, true);
        $multiplayermode = $configs['multiplayermode'];

    //If multiple mod friends enabled & Ready try to proccess api call fron SingleApp
        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){  
             if(!empty($arrayOfFriends)){                      
                    //print_r($output['friends']);
                    $friendson = true;
             }
         }

        //Appset
        $appset = App::where('appname', $appname)->pluck('appset');
        $appset = json_decode($appset, true);
        $textreplace = ['[first-name]', '[last-name]', '[full-name]'];
        $textreplacewith = [$input['firstname'], $input['lastname'], $input['fullname']];
        $appset = str_replace($textreplace, $textreplacewith, $appset);

        //Apps list
        $aplicatie = App::where('appname', $appname)->get()->first();
        $aplicatii = App::where('id', '!=', $aplicatie->id)->orderBy('id', 'DESC')->paginate(12);


        if($appset['disp-media'] == 'on'){
            $page_view = 'media';
        }else{
            $page_view = 'mediaOff';
        }

        return view($page_view, compact('aplicatie', 'aplicatii', 'input', 'appset','friendson'));
    }
    
    public function shareCount(){
        if(Request::ajax()){

            $appname = Input::get('appname');

            if (Share::where('name', '=', $appname)->exists()) {
                $shares = Share::where('name', $appname)->pluck('value');
                $shares = $shares + 1;
                Share::where('name', $appname)->update(['value' => $shares]);
            } else {
                Share::create([
                   'name' => $appname,
                    'value' => 1
                ]);
            }

            $total = Share::where('name', 'total')->pluck('value');
            $total = $total + 1;
            Share::where('name', 'total')->update(['value' => $total]);

            $today = Share::where('name', 'today')->pluck('value');
            $updated = Share::where('name', 'today')->pluck('updated_at')->format('Y-m-d');
            if($updated == date('Y-m-d')){
                $today = $today + 1;
                Share::where('name', 'today')->update(['value' => $today]);
            } else {
                Share::where('name', 'today')->update(['value' => 1]);
            }

            Activity::create([
                'fbid' => Input::get('fbid'),
                'name' => Input::get('name'),
                'appname' => $appname,
                'action' => 'share'
            ]);
            if(Activity::count() == 21){
                $last_record = Activity::orderBy('created_at', 'DESC')->first()->pluck('id');
                Activity::where('id', $last_record)->delete();
            }


           $response = ['success' => true, 'msg' => 'Share counted succesfully'];

            return \Response::json($response);

        } else {
            return 'Error';
        }
    }


    public function generatedCount(){

        if(Request::ajax()){

            $total = Share::where('name', 'generated_total')->pluck('value');
            $total = $total + 1;
            Share::where('name', 'generated_total')->update(['value' => $total]);

            $today = Share::where('name', 'generated_today')->pluck('value');
            $updated = Share::where('name', 'generated_today')->pluck('updated_at')->format('Y-m-d');
            if($updated == date('Y-m-d')){
                $today = $today + 1;
                Share::where('name', 'generated_today')->update(['value' => $today]);
            } else {
                Share::where('name', 'generated_today')->update(['value' => 1]);
            }

            $response = ['success' => true, 'msg' => 'Result generation counted succesfully'];

            return \Response::json($response);
        } else {
            return 'Error';
        }

    }


}


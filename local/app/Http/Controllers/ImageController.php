<?php namespace viralfb\Http\Controllers;

use viralfb\Http\Requests;
use viralfb\Http\Controllers\Controller;


use Request;
use Input;
use File;
use Image;
use DB;

class ImageController extends Controller
{

  public function masterImage($appname){
        //variables
        $fbid = Input::get('fbid');
        $gender = Input::get('gender');
        $fullname = Input::get('fullname');
        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $resultnumber = Input::get('result');
        $resultnumber = $resultnumber - 1;

        //Friends
        $configs = DB::table('configs')
                    ->where('nume', 'basic')
                    ->pluck('valoare');
        $configs = json_decode($configs, true);
        $multiplayermode = $configs['multiplayermode'];

    //If multiple mod friends enabled & Ready try to proccess api call fron SingleApp
        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){  
                $arrayOfFriends = json_decode(Input::get('arrayOfFriends'), true);       
         }
        
        //get image layers from db
        $results =  DB::table('apps')->where('appname', $appname)->pluck('results');
        $results = json_decode($results, true);
        $results = $results[$resultnumber];


        //create image
        $img = Image::canvas(850, 446, '#fff')->encode('jpg');

        foreach ($results as $result) {
            foreach ($result['layers'] as $layers) {
                foreach ($layers as $layer) {
                    $idlayer = $layer['idlayer'];
                    if (strpos($idlayer, 'text') !== false) {
                        $text = $layer['text'];
                          $textreplace = ['[first-name]', '[last-name]', '[full-name]'];
                          $textreplacewith = [$firstname, $lastname, $fullname];
                          $text = str_replace($textreplace, $textreplacewith, $text);
                          $text = str_replace("<br>", "\n", $text);

                        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){ 
                                  $textreplacefriend = ['[friend-1-first-name]', '[friend-1-last-name]', '[friend-1-full-name]','[friend-2-first-name]', '[friend-2-last-name]', '[friend-2-full-name]','[friend-3-first-name]', '[friend-3-last-name]', '[friend-3-full-name]','[friend-4-first-name]', '[friend-4-last-name]', '[friend-4-full-name]','[friend-5-first-name]', '[friend-5-last-name]', '[friend-5-full-name]','[friend-6-first-name]', '[friend-6-last-name]', '[friend-6-full-name]','[friend-7-first-name]', '[friend-7-last-name]', '[friend-7-full-name]','[friend-8-first-name]', '[friend-8-last-name]', '[friend-8-full-name]','[friend-9-first-name]', '[friend-9-last-name]', '[friend-9-full-name]','[friend-10-first-name]', '[friend-10-last-name]', '[friend-10-full-name]'];
                                  $textreplacewithfriend = [$arrayOfFriends[0]['first_name'], $arrayOfFriends[0]['last_name'], $arrayOfFriends[0]['first_name'].' '.$arrayOfFriends[0]['last_name'],$arrayOfFriends[1]['first_name'], $arrayOfFriends[1]['last_name'], $arrayOfFriends[1]['first_name'].' '.$arrayOfFriends[1]['last_name'],$arrayOfFriends[2]['first_name'], $arrayOfFriends[2]['last_name'], $arrayOfFriends[2]['first_name'].' '.$arrayOfFriends[2]['last_name'],$arrayOfFriends[3]['first_name'], $arrayOfFriends[3]['last_name'], $arrayOfFriends[3]['first_name'].' '.$arrayOfFriends[3]['last_name'],$arrayOfFriends[4]['first_name'], $arrayOfFriends[4]['last_name'], $arrayOfFriends[4]['first_name'].' '.$arrayOfFriends[4]['last_name'],$arrayOfFriends[5]['first_name'], $arrayOfFriends[5]['last_name'], $arrayOfFriends[5]['first_name'].' '.$arrayOfFriends[5]['last_name'],$arrayOfFriends[6]['first_name'], $arrayOfFriends[6]['last_name'], $arrayOfFriends[6]['first_name'].' '.$arrayOfFriends[6]['last_name'],$arrayOfFriends[7]['first_name'], $arrayOfFriends[7]['last_name'], $arrayOfFriends[7]['first_name'].' '.$arrayOfFriends[7]['last_name'],$arrayOfFriends[8]['first_name'], $arrayOfFriends[8]['last_name'], $arrayOfFriends[8]['first_name'].' '.$arrayOfFriends[8]['last_name'],$arrayOfFriends[9]['first_name'], $arrayOfFriends[9]['last_name'], $arrayOfFriends[9]['first_name'].' '.$arrayOfFriends[9]['last_name'],$arrayOfFriends[10]['first_name'], $arrayOfFriends[10]['last_name'], $arrayOfFriends[10]['first_name'].' '.$arrayOfFriends[10]['last_name']];
                                  $text = str_replace($textreplacefriend, $textreplacewithfriend, $text);
                                  $text = str_replace("<br>", "\n", $text);
                          }

                        $top = $layer['top'];
                        $left = $layer['left'];
                        $fontfile = $layer['font'];
                        $color = $layer['color'];
                        $deinlocuit = ['rgb(', 'rgba(', ')'];
                        $inlocuitcu = ['', '', ''];
                        $color = str_replace($deinlocuit, $inlocuitcu, $color);
                        $nrc = strlen($color);
                        if ($nrc > 13) {
                            $arr = explode(",", $color, 4);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $t = $arr[3];
                            $color = array($r, $g, $b, $t);
                        } else {
                            $arr = explode(",", $color, 3);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $color = array($r, $g, $b);
                        }

                        $size = $layer['size'];
                        $fontsize = str_replace('px', '', $size);
                        $fontsize = $fontsize - 1.1;
                        $angle = $layer['angle'];

                        $decalation = $fontsize * 15 / 40;
                        $top = $top + $decalation;

                        $variables = ['color' => $color, 'fontfile' => $fontfile, 'fontsize' => $fontsize, 'angle' => $angle];
                        $img->text($text, $left, $top, function ($font) use ($variables) {
                            $color = $variables['color'];
                            $fontfile = $variables['fontfile'];
                            $fontsize = $variables['fontsize'];
                            $angle = $variables['angle'];
                            $font->file(public_path('admin/fontsttf/' . $fontfile . '.ttf'));
                            $font->size($fontsize);
                            $font->color($color);
                            $font->align('left');
                            $font->valign('top');
                            $font->angle($angle);
                        });

                    } else {

                    $imgsrc = url() . $layer['imgsrc'];
                    if (strpos($imgsrc, 'rsz_fb-profile') !== false) {
                        $imgsrc = 'http://graph.facebook.com/' . $fbid . '/picture?width=900';
                    }

                         if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){ 
                       
                
                           if (strpos($idlayer, 'added-friend-fb1') !== false) {
                                if (strpos($imgsrc, 'rsz_fb-friend-profile1') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[0]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb2') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile2') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[1]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb3') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile3') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[2]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb4') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile4') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[3]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb5') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile5') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[4]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb6') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile6') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[5]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb7') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile7') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[6]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb8') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile8') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[7]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb9') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile9') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[8]['id'] . '/picture?width=900';
                                    }
                                }

                      }

                    $width = $layer['width'];
                    $height = $layer['height'];
                    $top = $layer['top'];
                    $left = $layer['left'];

                    $layernew = Image::make($imgsrc)->resize($width, $height);
                    $img->insert($layernew, 'top-left', $left, $top);
                    }
                }
            }
        }

        return $img->response('jpg');

    }


    public function createImage()
    {
        if (Request::ajax()) {
            $editid = Input::get('editid');
            if(isset($editid)){
                $table = 'apps';
                $id = $editid;
            } else {
                $table = 'develops';
                $id = 1;
            }

            $domain = url();
            $input = Input::get('sizes');
            $gender = Input::get('gender');
            $nrresult = Input::get('result');
            $decoded = str_replace("$domain", "", $input);
            $decoded = json_decode($decoded, true);

            //Sort layers by position
            usort($decoded, function ($a, $b) {
                return $a[0]['disporder'] - $b[0]['disporder'];
            });

            $appname = DB::table("$table")->where('id', $id)->pluck('appname');
            if ($nrresult == 1) {
                $directory = "$appname";
                if(!File::exists("appsresults/$appname")) {
                    File::makeDirectory("appsresults/$appname", 0775, true);
                }
            } else {
                $directory = "$appname";
            }


            $resultname = "result$nrresult.jpg";
            $imgurl = "$domain/appsresults/$directory/$resultname";

            $lastresult = DB::table("$table")->where('id', $id)->pluck('results');
            if ($lastresult == '' or $nrresult == 1) {
                $lastresult = "{}";
            }
            $lr = json_decode($lastresult, true);
            $layers_plus_gender = [
                "layers" => $decoded,
                "gender" => $gender
            ];
            $totalresults = [
                "result$nrresult" => $layers_plus_gender,
            ];
            array_push($lr, $totalresults);
            $finalresults = json_encode($lr);

            $img = Image::canvas(850, 446, '#fff')->encode('jpg');
            foreach ($decoded as $layers) {
                foreach ($layers as $layer) {
                    $idlayer = $layer['idlayer'];
                    if (strpos($idlayer, 'text') !== false) {
                        $top = $layer['top'];
                        $left = $layer['left'];
                        $text = $layer['text'];
                        $text = str_replace("<br>", "\n", $text);
                        $fontfile = $layer['font'];
                        $color = $layer['color'];
                        $deinlocuit = ['rgb(', 'rgba(', ')'];
                        $inlocuitcu = ['', '', ''];
                        $color = str_replace($deinlocuit, $inlocuitcu, $color);
                        $nrc = strlen($color);
                        if ($nrc > 13) {
                            $arr = explode(",", $color, 4);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $t = $arr[3];
                            $color = array($r, $g, $b, $t);
                        } else {
                            $arr = explode(",", $color, 3);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $color = array($r, $g, $b);
                        }

                        $fontsize = $layer['size'];
                        $fontsize = $fontsize - 1.1;
                        $angle = - $layer['angle'];

                        $decalation = $fontsize * 15 / 40;
                        $top = $top + $decalation;

                        $variables = ['color' => $color, 'fontfile' => $fontfile, 'fontsize' => $fontsize, 'angle' => $angle];
                        $img->text($text, $left, $top, function ($font) use ($variables) {
                            $color = $variables['color'];
                            $fontfile = $variables['fontfile'];
                            $fontsize = $variables['fontsize'];
                            $angle = $variables['angle'];
                            $font->file(public_path('admin/fontsttf/' . $fontfile . '.ttf'));
                            $font->size($fontsize);
                            $font->color($color);
                            $font->align('left');
                            $font->valign('top');
                            $font->angle($angle);
                        });

                    } else {
                        $imgsrc = $domain . $layer['imgsrc'];
                        $width = $layer['width'];
                        $height = $layer['height'];
                        $top = $layer['top'];
                        $left = $layer['left'];

                        $layernew = Image::make($imgsrc)->resize($width, $height);
                        $img->insert($layernew, 'top-left', $left, $top);
                    }
                }
            } // end foreach 1

            if ($img->save('appsresults/' . $directory . '/' . $resultname) && DB::table("$table")
                    ->where('id', $id)
                    ->update([
                        'results' => $finalresults
                    ])
            ) {

                $response = ['succes' => true, 'msg' => 'Result saved successfully', 'imgurl' => $imgurl, 'resultnr' => $nrresult,
                'gender' => $gender];
                return \Response::json($response);
            }

        } else {
            return 'Error. Request not ajax.';
        }

    }


    public function pixlrSave()
    {
        $input = Input::all();

        if (isset($input['image'])) {
            $pixurl = $input['image'];

            $img = 'images/pixlr-images/'.time().'.png';

            if (file_put_contents($img, file_get_contents($pixurl))) {
                $domain = url();
                $urlnewimg = $domain . '/' . $img;

                $response = ['succes' => true, 'pixlrimage' => $urlnewimg];
                session_start();
                $_SESSION['response'] = $response;
                $_SESSION['page_reload'] = 0;

            }
        }
    }


    public function pixlrLoad()
    {
        session_start();
        if(isset($_SESSION['page_reload'])){
        $pagereload = $_SESSION['page_reload'] =  $_SESSION['page_reload'] + 1;
        }
        if(isset($_SESSION['response'])){
            if($pagereload == 1){
                $response = $_SESSION['response'];
                return \Response::json($response);
            } else {
                $rasp = ['succes' => true, 'pixlrimage' => 'none'];
                return \Response::json($rasp);
            }
        }
    }

    public function mediaImageForFriends($appname, $fbid = null, $gender = null, $fullname = null, $firstname = null, $lastname = null, $result = null, $arrayOfFriends = null){

        $fullname = urldecode($fullname);
        $firstname = urldecode($firstname);
        $lastname = urldecode($lastname);
        $resultnumber = $result - 1;

        //get image layers from db
        $results =  DB::table('apps')->where('appname', $appname)->pluck('results');
        $results = json_decode($results, true);
        $results = $results[$resultnumber];

        //Friends
        $configs = DB::table('configs')
                    ->where('nume', 'basic')
                    ->pluck('valoare');
        $configs = json_decode($configs, true);
        $multiplayermode = $configs['multiplayermode'];

    //If multiple mod friends enabled & Ready try to proccess api call fron SingleApp
        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){  
             if(!empty($arrayOfFriends)){      
                    parse_str($arrayOfFriends, $output);
       
                    //print_r($output['friends']);
                    $arrayOfFriends = $output['friends'];
             }
         }

        //create image
        $img = Image::canvas(850, 446, '#fff')->encode('jpg');

        foreach ($results as $result) {
            foreach ($result['layers'] as $layers) {
                foreach ($layers as $layer) {
                    $idlayer = $layer['idlayer'];
                    if (strpos($idlayer, 'text') !== false) {
                        $text = $layer['text'];
                        $textreplace = ['[first-name]', '[last-name]', '[full-name]'];
                        $textreplacewith = [$firstname, $lastname, $fullname];
                        $text = str_replace($textreplace, $textreplacewith, $text);
                        $text = str_replace("<br>", "\n", $text);

                        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){ 
                               if(!empty($arrayOfFriends)){  
                                  $textreplacefriend = ['[friend-1-first-name]', '[friend-1-last-name]', '[friend-1-full-name]','[friend-2-first-name]', '[friend-2-last-name]', '[friend-2-full-name]','[friend-3-first-name]', '[friend-3-last-name]', '[friend-3-full-name]','[friend-4-first-name]', '[friend-4-last-name]', '[friend-4-full-name]','[friend-5-first-name]', '[friend-5-last-name]', '[friend-5-full-name]','[friend-6-first-name]', '[friend-6-last-name]', '[friend-6-full-name]','[friend-7-first-name]', '[friend-7-last-name]', '[friend-7-full-name]','[friend-8-first-name]', '[friend-8-last-name]', '[friend-8-full-name]','[friend-9-first-name]', '[friend-9-last-name]', '[friend-9-full-name]','[friend-10-first-name]', '[friend-10-last-name]', '[friend-10-full-name]'];
                                  $textreplacewithfriend = [$arrayOfFriends[0]['first_name'], $arrayOfFriends[0]['last_name'], $arrayOfFriends[0]['first_name'].' '.$arrayOfFriends[0]['last_name'],$arrayOfFriends[1]['first_name'], $arrayOfFriends[1]['last_name'], $arrayOfFriends[1]['first_name'].' '.$arrayOfFriends[1]['last_name'],$arrayOfFriends[2]['first_name'], $arrayOfFriends[2]['last_name'], $arrayOfFriends[2]['first_name'].' '.$arrayOfFriends[2]['last_name'],$arrayOfFriends[3]['first_name'], $arrayOfFriends[3]['last_name'], $arrayOfFriends[3]['first_name'].' '.$arrayOfFriends[3]['last_name'],$arrayOfFriends[4]['first_name'], $arrayOfFriends[4]['last_name'], $arrayOfFriends[4]['first_name'].' '.$arrayOfFriends[4]['last_name'],$arrayOfFriends[5]['first_name'], $arrayOfFriends[5]['last_name'], $arrayOfFriends[5]['first_name'].' '.$arrayOfFriends[5]['last_name'],$arrayOfFriends[6]['first_name'], $arrayOfFriends[6]['last_name'], $arrayOfFriends[6]['first_name'].' '.$arrayOfFriends[6]['last_name'],$arrayOfFriends[7]['first_name'], $arrayOfFriends[7]['last_name'], $arrayOfFriends[7]['first_name'].' '.$arrayOfFriends[7]['last_name'],$arrayOfFriends[8]['first_name'], $arrayOfFriends[8]['last_name'], $arrayOfFriends[8]['first_name'].' '.$arrayOfFriends[8]['last_name'],$arrayOfFriends[9]['first_name'], $arrayOfFriends[9]['last_name'], $arrayOfFriends[9]['first_name'].' '.$arrayOfFriends[9]['last_name'],$arrayOfFriends[10]['first_name'], $arrayOfFriends[10]['last_name'], $arrayOfFriends[10]['first_name'].' '.$arrayOfFriends[10]['last_name']];
                                  $text = str_replace($textreplacefriend, $textreplacewithfriend, $text);
                                  $text = str_replace("<br>", "\n", $text);
                              }
                          }

                        $top = $layer['top'];
                        $left = $layer['left'];
                        $fontfile = $layer['font'];
                        $color = $layer['color'];
                        $deinlocuit = ['rgb(', 'rgba(', ')'];
                        $inlocuitcu = ['', '', ''];
                        $color = str_replace($deinlocuit, $inlocuitcu, $color);
                        $nrc = strlen($color);
                        if ($nrc > 13) {
                            $arr = explode(",", $color, 4);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $t = $arr[3];
                            $color = array($r, $g, $b, $t);
                        } else {
                            $arr = explode(",", $color, 3);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $color = array($r, $g, $b);
                        }

                        $size = $layer['size'];
                        $fontsize = str_replace('px', '', $size);
                        $fontsize = $fontsize - 1.1;
                        $angle = $layer['angle'];

                        $decalation = $fontsize * 15 / 40;
                        $top = $top + $decalation;

                        $variables = ['color' => $color, 'fontfile' => $fontfile, 'fontsize' => $fontsize, 'angle' => $angle];
                        $img->text($text, $left, $top, function ($font) use ($variables) {
                            $color = $variables['color'];
                            $fontfile = $variables['fontfile'];
                            $fontsize = $variables['fontsize'];
                            $angle = $variables['angle'];
                            $font->file(public_path('admin/fontsttf/' . $fontfile . '.ttf'));
                            $font->size($fontsize);
                            $font->color($color);
                            $font->align('left');
                            $font->valign('top');
                            $font->angle($angle);
                        });

                    } else {

                        $imgsrc = url() . $layer['imgsrc'];
                        if (strpos($imgsrc, 'rsz_fb-profile') !== false) {
                            $imgsrc = 'http://graph.facebook.com/' . $fbid . '/picture?width=900';
                        }


                         if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){ 
                             if(!empty($arrayOfFriends)){  
                
                           if (strpos($idlayer, 'added-friend-fb1') !== false) {
                                if (strpos($imgsrc, 'rsz_fb-friend-profile1') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[0]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb2') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile2') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[1]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb3') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile3') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[2]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb4') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile4') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[3]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb5') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile5') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[4]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb6') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile6') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[5]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb7') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile7') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[6]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb8') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile8') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[7]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb9') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile9') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[8]['id'] . '/picture?width=900';
                                    }
                                }
                          }
                      }

                        $width = $layer['width'];
                        $height = $layer['height'];
                        $top = $layer['top'];
                        $left = $layer['left'];

                        $layernew = Image::make($imgsrc)->resize($width, $height);
                        $img->insert($layernew, 'top-left', $left, $top);
                    }
                }
            }
        }

        return $img->response('jpg');


    }
   public function mediaImage($appname, $fbid = null, $gender = null, $fullname = null, $firstname = null, $lastname = null, $result = null){

        $fullname = urldecode($fullname);
        $firstname = urldecode($firstname);
        $lastname = urldecode($lastname);
        $resultnumber = $result - 1;

        //get image layers from db
        $results =  DB::table('apps')->where('appname', $appname)->pluck('results');
        $results = json_decode($results, true);
        $results = $results[$resultnumber];

        //Friends
        $configs = DB::table('configs')
                    ->where('nume', 'basic')
                    ->pluck('valoare');
        $configs = json_decode($configs, true);
        $multiplayermode = $configs['multiplayermode'];

    //If multiple mod friends enabled & Ready try to proccess api call fron SingleApp
        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){  
             if(!empty($arrayOfFriends)){      
                    parse_str($arrayOfFriends, $output);
       
                    //print_r($output['friends']);
                    $arrayOfFriends = $output['friends'];
             }
         }

        //create image
        $img = Image::canvas(850, 446, '#fff')->encode('jpg');

        foreach ($results as $result) {
            foreach ($result['layers'] as $layers) {
                foreach ($layers as $layer) {
                    $idlayer = $layer['idlayer'];
                    if (strpos($idlayer, 'text') !== false) {
                        $text = $layer['text'];
                        $textreplace = ['[first-name]', '[last-name]', '[full-name]'];
                        $textreplacewith = [$firstname, $lastname, $fullname];
                        $text = str_replace($textreplace, $textreplacewith, $text);
                        $text = str_replace("<br>", "\n", $text);

                        if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){ 
                               if(!empty($arrayOfFriends)){  
                                  $textreplacefriend = ['[friend-1-first-name]', '[friend-1-last-name]', '[friend-1-full-name]','[friend-2-first-name]', '[friend-2-last-name]', '[friend-2-full-name]','[friend-3-first-name]', '[friend-3-last-name]', '[friend-3-full-name]','[friend-4-first-name]', '[friend-4-last-name]', '[friend-4-full-name]','[friend-5-first-name]', '[friend-5-last-name]', '[friend-5-full-name]','[friend-6-first-name]', '[friend-6-last-name]', '[friend-6-full-name]','[friend-7-first-name]', '[friend-7-last-name]', '[friend-7-full-name]','[friend-8-first-name]', '[friend-8-last-name]', '[friend-8-full-name]','[friend-9-first-name]', '[friend-9-last-name]', '[friend-9-full-name]','[friend-10-first-name]', '[friend-10-last-name]', '[friend-10-full-name]'];
                                  $textreplacewithfriend = [$arrayOfFriends[0]['first_name'], $arrayOfFriends[0]['last_name'], $arrayOfFriends[0]['first_name'].' '.$arrayOfFriends[0]['last_name'],$arrayOfFriends[1]['first_name'], $arrayOfFriends[1]['last_name'], $arrayOfFriends[1]['first_name'].' '.$arrayOfFriends[1]['last_name'],$arrayOfFriends[2]['first_name'], $arrayOfFriends[2]['last_name'], $arrayOfFriends[2]['first_name'].' '.$arrayOfFriends[2]['last_name'],$arrayOfFriends[3]['first_name'], $arrayOfFriends[3]['last_name'], $arrayOfFriends[3]['first_name'].' '.$arrayOfFriends[3]['last_name'],$arrayOfFriends[4]['first_name'], $arrayOfFriends[4]['last_name'], $arrayOfFriends[4]['first_name'].' '.$arrayOfFriends[4]['last_name'],$arrayOfFriends[5]['first_name'], $arrayOfFriends[5]['last_name'], $arrayOfFriends[5]['first_name'].' '.$arrayOfFriends[5]['last_name'],$arrayOfFriends[6]['first_name'], $arrayOfFriends[6]['last_name'], $arrayOfFriends[6]['first_name'].' '.$arrayOfFriends[6]['last_name'],$arrayOfFriends[7]['first_name'], $arrayOfFriends[7]['last_name'], $arrayOfFriends[7]['first_name'].' '.$arrayOfFriends[7]['last_name'],$arrayOfFriends[8]['first_name'], $arrayOfFriends[8]['last_name'], $arrayOfFriends[8]['first_name'].' '.$arrayOfFriends[8]['last_name'],$arrayOfFriends[9]['first_name'], $arrayOfFriends[9]['last_name'], $arrayOfFriends[9]['first_name'].' '.$arrayOfFriends[9]['last_name'],$arrayOfFriends[10]['first_name'], $arrayOfFriends[10]['last_name'], $arrayOfFriends[10]['first_name'].' '.$arrayOfFriends[10]['last_name']];
                                  $text = str_replace($textreplacefriend, $textreplacewithfriend, $text);
                                  $text = str_replace("<br>", "\n", $text);
                              }
                          }

                        $top = $layer['top'];
                        $left = $layer['left'];
                        $fontfile = $layer['font'];
                        $color = $layer['color'];
                        $deinlocuit = ['rgb(', 'rgba(', ')'];
                        $inlocuitcu = ['', '', ''];
                        $color = str_replace($deinlocuit, $inlocuitcu, $color);
                        $nrc = strlen($color);
                        if ($nrc > 13) {
                            $arr = explode(",", $color, 4);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $t = $arr[3];
                            $color = array($r, $g, $b, $t);
                        } else {
                            $arr = explode(",", $color, 3);
                            $r = $arr[0];
                            $g = $arr[1];
                            $b = $arr[2];
                            $color = array($r, $g, $b);
                        }

                        $size = $layer['size'];
                        $fontsize = str_replace('px', '', $size);
                        $fontsize = $fontsize - 1.1;
                        $angle = $layer['angle'];

                        $decalation = $fontsize * 15 / 40;
                        $top = $top + $decalation;

                        $variables = ['color' => $color, 'fontfile' => $fontfile, 'fontsize' => $fontsize, 'angle' => $angle];
                        $img->text($text, $left, $top, function ($font) use ($variables) {
                            $color = $variables['color'];
                            $fontfile = $variables['fontfile'];
                            $fontsize = $variables['fontsize'];
                            $angle = $variables['angle'];
                            $font->file(public_path('admin/fontsttf/' . $fontfile . '.ttf'));
                            $font->size($fontsize);
                            $font->color($color);
                            $font->align('left');
                            $font->valign('top');
                            $font->angle($angle);
                        });

                    } else {

                        $imgsrc = url() . $layer['imgsrc'];
                        if (strpos($imgsrc, 'rsz_fb-profile') !== false) {
                            $imgsrc = 'http://graph.facebook.com/' . $fbid . '/picture?width=900';
                        }


                         if($multiplayermode == 'true' && !empty($configs['fbsecretid'])){ 
                             if(!empty($arrayOfFriends)){  
                
                           if (strpos($idlayer, 'added-friend-fb1') !== false) {
                                if (strpos($imgsrc, 'rsz_fb-friend-profile1') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[0]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb2') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile2') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[1]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb3') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile3') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[2]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb4') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile4') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[3]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb5') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile5') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[4]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb6') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile6') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[5]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb7') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile7') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[6]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb8') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile8') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[7]['id'] . '/picture?width=900';
                                    }
                                }
                                if (strpos($idlayer, 'added-friend-fb9') !== false) {
                                    if (strpos($imgsrc, 'rsz_fb-friend-profile9') !== false) {
                                        $imgsrc = 'http://graph.facebook.com/' . $arrayOfFriends[8]['id'] . '/picture?width=900';
                                    }
                                }
                          }
                      }

                        $width = $layer['width'];
                        $height = $layer['height'];
                        $top = $layer['top'];
                        $left = $layer['left'];

                        $layernew = Image::make($imgsrc)->resize($width, $height);
                        $img->insert($layernew, 'top-left', $left, $top);
                    }
                }
            }
        }

        return $img->response('jpg');


    }


}
<?php namespace viralfbpackage\Installer\Http\Controllers;

use Illuminate\Http\Requests;
//use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class WelcomeController extends Controller {

	public function index()
	{
		return view('installer::welcome');
	}

}

<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class App extends Model {

    protected $fillable = ['appname', 'title', 'description', 'img', 'results', 'appset'];

}

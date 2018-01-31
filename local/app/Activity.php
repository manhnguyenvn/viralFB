<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model {

    protected $fillable = ['fbid', 'name', 'appname', 'action'];

}

<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class Develop extends Model {

    protected $fillable = ['id', 'appname', 'title', 'description', 'img', 'results', 'appset'];

}

<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

    protected $fillable = ['title', 'url', 'content'];

}

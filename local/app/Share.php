<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class Share extends Model {

    public $table = "shares";
    protected $fillable = ['name', 'value'];

}

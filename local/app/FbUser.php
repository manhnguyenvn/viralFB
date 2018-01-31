<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class FbUser extends Model {

    protected $fillable = ['fbid', 'fullname', 'firstname', 'lastname', 'email', 'gender'];

}

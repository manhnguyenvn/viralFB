<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model {

    protected $fillable = ['sitename', 'metasitename', 'sitedescription', 'footercontent'];

}

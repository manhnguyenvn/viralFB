<?php namespace viralfb;

use Illuminate\Database\Eloquent\Model;

class Config extends Model {
    public $table = "configs";
    protected $fillable = ['nume', 'valoare'];

}

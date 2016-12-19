<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Special  extends Model{
	protected $table = "special";
	protected $primaryKey="id";
	protected $fillable = ['title','description','pic'];
	public function comments()
    {
        return $this->hasMany('App\Models\Video');
    }
}
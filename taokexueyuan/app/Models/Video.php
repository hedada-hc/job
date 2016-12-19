<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Video extends Model{
	protected $table = "video";
	protected $primaryKey="id";
	protected $fillable = ['title','video_url','thumb_pic','description','special_id'];
}
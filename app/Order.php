<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
    	'project_id', 'stations', 'editor', 'produced_by',
    	'location_time', 'edit_time', 'vcd_vhs', 'dvd',
    	'beta_dub', 'crawl', 'ftp', 'music_library', 'discount',
    	'vcd_vhs_date', 'dvd_date', 'beta_dub_date',
    	'crawl_date', 'ftp_date', 'music_library_date', 'order_total'
    ];

    protected $dates = [
    	'produced_by', 'vcd_vhs_date', 'dvd_date', 'beta_dub_date',
    	'crawl_date', 'ftp_date', 'music_library_date'
    ];

    //Relationships
    public function project(){
    	return $this->belongsTo(\App\Project::class);
    }
}

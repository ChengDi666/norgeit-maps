<?php

namespace Norgeit\Maps;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class Maps extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('maps', __DIR__.'/../dist/js/tool.js');
        Nova::style('maps', __DIR__.'/../dist/css/tool.css');
    }
    
	public $lats = [];

    public function __construct($lat, $lng)
    {      
        global $lats;
        $lats['lat'] = $lat;
        $lats['lng'] = $lng;
        
        \Log::info($lng);
        \Log::info($this->component);
        // return $this->withMeta([
        //     'lat' => $lat,
        //     'lng' => $lng
        // ]);
    }


    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {   
        global $lats;
        return view('maps::navigation', $lats);
    }
}

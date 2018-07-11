<?php

namespace App\Http\Controllers;

use Cache;
use App\Data;
use Illuminate\Http\Request;



class DataController extends Controller {

    use \App\BrowserTrait;

    public function data(Request $request, $resource, $internal = false) {

        $model = new Data($request, $resource, $internal);
                
        if($model->internal){
            return $model->graph;
        }        
        //set status
        if($model->graph->isEmpty()){
            return response("Resource not found", 404);
        }        
        //create and send the file
        $model->download();        
    }
}

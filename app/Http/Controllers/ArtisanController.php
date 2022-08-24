<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
    public function run(){
        if(!request("secret")){
            abort(401,"Unauthorized Access");
        }else if(request("secret") != "123password123"){
            abort(401,"Unauthorized Access");
        }
        $exitCode = collect([]);
        $exitCode->push($this->migration());
        return response()->json(["exitCode"=>$exitCode],200);
    }


    public function migration(){
        $migration = collect([]);
        $output = new \Symfony\Component\Console\Output\BufferedOutput;
        if(request("freshseed")){
            Artisan::call("migrate:fresh --seed",[],$output);
            return $output->fetch();
        }
        if(request("fresh")){
            Artisan::call("migrate:fresh",[],$output);
            return $output->fetch();
        }else{
            Artisan::call("migrate",[],$output);
            return $output->fetch();
        }
        if(request("seed")){
            Artisan::call("db:seed",[],$output);
            return $output->fetch();
        }
    }
}

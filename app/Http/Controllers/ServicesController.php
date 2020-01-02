<?php

namespace App\Http\Controllers;
use App\Models\Service;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
class ServicesController extends Controller
{
    public function services() {
        $services = Service::all();
        return view('services',compact('services'));
    }
    public function orthosisshow(Service $services)
    {
         $services->type="Orthosis care";
        //  return $services;
        return view('show',['services' => $services]);
    }
    public function prosthesis(Service $services)
    {
         $services->type="Prosthesis care";
        //  return $services;
        return view('show',['services' => $services]);
    }
    public function cosmetic(Service $services)
    {
         $services->type="Cosmetic solutions care";
        //  return $services;
        return view('show',['services' => $services]);
    }
    public function children(Service $services)
    {
         $services->type="Children care";
        //  return $services; 
        return view('show',['services' => $services]);
    }
    public function physio(Service $services)
    {
         $services->type="Physio care";
        //  return $services; physio
        return view('show',['services' => $services]);
    }
    public function orthosishome() {
        $services = DB::select("select * from service where type ='orthosis'");
        $types='Orthosis care';        
        return view('show2',['services' => $services,'types' => $types]);
    }
    public function prosthesishome() {
        $services = DB::select("select * from service where type ='prosthesis'");
        $types='Prosthesis care';        
        return view('show2',['services' => $services,'types' => $types]);
    }
    public function cosmetichome() {
        $services = DB::select("select * from service where type ='cosmetic'");
        $types='Cosmetic solutions care';        
        return view('show2',['services' => $services,'types' => $types]);
    }
    public function childrenhome() {
        $services = DB::select("select * from service where type ='children'");
        $types='Children care';        
        return view('show2',['services' => $services,'types' => $types]);
    } 
    public function physiohome() {
        $services = DB::select("select * from service where type ='physio'");
        $types='Physio care';        
        return view('show2',['services' => $services,'types' => $types]);
    }
    
}


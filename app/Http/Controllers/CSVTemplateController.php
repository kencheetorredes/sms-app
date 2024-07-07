<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSVTemplateController extends Controller
{
    public function index($module){
        $mod = 'template_'.$module;
        return self::$mod();
    }

    public static function template_new_contacts_bygroup(){
        $fileName = 'import-contacts-to-group-'.date('Y-m-d').'.csv';
     
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ); 
        
        $columns = array('name','country','mobile');
        
        $callback = function() use( $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }

    public static function template_contacts(){
        $fileName = 'import-contacts-'.date('Y-m-d').'.csv';
     
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ); 
        
        $columns = array('name','country','mobile','group');
        $callback = function() use( $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }

}

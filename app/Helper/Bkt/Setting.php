<?php

namespace App\Helper\Bkt;
use Storage;
use Mail;

class setting {
    
    public static function shortcode( $letters,$data){
        $regex = "/\[(.*?)\]/";
        preg_match_all($regex, $letters, $matches);
        if(count($matches[1]) > 0){
            foreach($matches[1] as $key => $match){
                $letters = str_replace($matches[0][$key],$data[$match],$letters);
            }
        }
        return $letters;
    }

    /**
      * Generate Password
      */

      public static function generateRandomString($length = 8,$id) {
        $characters = '0123456789abcdefghijklmnopqrs092u3tuvwxyzaskdhfhf9882323ABCDEFGHIJKLMNksadf9044OPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
  
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString.$id.uniqid();
    }
    
     /**
     * Sending Email Helper
     * @param string $template
     * @param array $info
     */
    public static function mail($template, $info)
    { 
        $company = [
            'email' => env('MAIL_FROM_ADDRESS'),
            'name'  => env('MAIL_FROM_NAME')
        ];

        try{
            Mail::send($template, ['info' => $info], function ($message) use ($info,$company) {
                $companyEmail   = $company['email'];
                $companyName    = $company['name'];
                $subject        = $info['subject'];
                $message->from($companyEmail, $companyName);
                $message->sender($companyEmail, $companyName);
                $message->to($info['email']);
                $message->subject($subject);
            });
        } catch(\Exception $exception){
           dd($exception);
        }
    }

     /**
     * check if the file existing and if the extension is passed
     * @param array $file
     * @return boolean
     */
    public static function extensionCheck($file,$extensions = ['jpg','jpeg','png']){

        $allowedExtension = $extensions;
        $return            = true;

        if($file){

            $fileExtensionOther    = $file->getClientOriginalExtension();
            if(!in_array($fileExtensionOther,$allowedExtension)){
                $return = false;
                }
        } else {
            $return = false;
        }

        return $return;
    }

     /**
     * upload images
     * @param array $file
     * @param sting $folder
     * @return string
     */ 
    public static function uploadFiles($file,$folder,$getname = '',$csv = ''){
        if($getname == ''){
            $fileExtension   = $file->getClientOriginalExtension();
            $realname       = explode('.',$file->getClientOriginalName());
            $nameOnly       = utf8_encode(str_replace(' ','',preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '',$realname[0])).date('mdyhis').uniqid());
            $FullimageName  = $nameOnly.'.'.$fileExtension;
            $fileSystem = $csv == '' ? env('FILESYSTEM') : 'public';
            $file->storeAs($folder,$FullimageName,$fileSystem);
            return $FullimageName;
        } else {
            $realname       = explode('.',$file->getClientOriginalName());
            return  str_replace(' ','',$realname[0]);
        }

    }

       /**
     * read csv
     * @param string $csvName
     * @param string $idr
     * @return array
     */

     public static function read($csvName,$idr="csv/employee/"){
 
        $dataHeader = array();
        
        $path = storage_path('app/'.$idr.$csvName);
        //;
        if( !file_exists($path)){
            $return = array(
                'message' => 'File not found!',
                'path' =>  $path,
            ); 
        } else { 
            if (($handle = fopen($path, "r")) !== FALSE) {
                $row = 1;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);

                if($row == 1){
                    for ($c = 0; $c < $num; $c++) {
                    $dataHeaderx[] = str_replace(' ','_',strtolower($data[$c]));
                    }
                } else {
                    for ($c = 0; $c < $num; $c++) {
                        $dataHeader[$row][$dataHeaderx[$c]] = $data[$c];
    
                    }
                }

                $row++;
            }

            fclose($handle);

            $return =  $dataHeader;

            } 

        }

        return $return;

	}


    public static function readHead($csvName,$idr="csv/employee/"){
 
        $dataHeader = array();
       
        $path = storage_path('app/'.$idr.$csvName);
  
        if( !file_exists( $path)){
            $return = array(
                'message' => 'File not found!',
            );
            
        } else {

            if (($handle = fopen( $path, "r")) !== FALSE) {
                $row = 1;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $num = count($data);

                if($row == 1){
                    for ($c = 0; $c < $num; $c++) {
                    $dataHeaderx[] = str_replace(' ','_',strtolower($data[$c]));
                    }
                } else {
                    for ($c = 0; $c < $num; $c++) {
                        $dataHeader[$row][$dataHeaderx[$c]] = $data[$c];
                    } 
                }

                $row++;
            }

            fclose($handle);

            $return =  $dataHeaderx;

            } 

        }

        return $return;

	}
}

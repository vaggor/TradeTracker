<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public function formateData($data){
        /*$str = ltrim($data, "0"); 
        return (double)$str;*/
        $exp = explode('-',$data);
        if(isset($exp[1])){
            $str = ltrim($exp[1], "0");
            $str = '-'.(double)$str;
        }else{
            $str = ltrim($data, "0"); 
            $str = (double)$str;
        }
        
        //print_r($str);exit;
        return $str;
    }

    public function getWeekNumber($ddate){
        $week = strftime('%G-%V',strtotime($ddate));
        return $week;
    }


    public function validateUpload($data){
        $file = new File($data['tmp_name']);
        $ext = $data['name'];
        $point = strrpos($ext,".");
        
        $ext = substr($ext,$point+1,(strlen($ext)-$point));
        $ext1=strtolower($ext);
        $types = array('xls','xlsx');
        //print_r($ext1);exit;
        if(in_array($ext1,$types) and $data["size"] <= 2000000){ // max upload size 2MB
            //print_r($ext1);exit;
            //return true;
            //return 'invalide file => '.$ext1;exit;
            $resp = 1;
        }
        else{
            $resp = 0;
        }
        //print_r($resp);exit;
        return $resp;
    }


    public function uploadDocument($data){
        //print_r($data);exit;
        //--------------------------------------- Start Processing Doc uploded ------------------------------------------------
        
                $file = new File($data['tmp_name']);
                $ext = $data['name'];
                $point = strrpos($ext,".");
                
                $ext = substr($ext,$point+1,(strlen($ext)-$point));
                $ext=strtolower($ext);
                $types = array('xls','xlsx');
                if (!in_array($ext,$types)) 
                {
                    $path ='';
                } 
                else 
                {
                    ini_set('date.timezone', 'America/New_York');   
                    $now = strtotime(date('YmdHis'));
                    $name= $now;
                    $filename = $name.'.'.$ext;
                    $data1 = $file->read();
                    $file->close();
                
                    $path=WWW_ROOT.'files/'.$filename;
                    $file = new File(WWW_ROOT.'files/'.$filename,true);
                    //print_r($path);exit;
                    /*$tmp_name = $data['Document']['doc']['tmp_name'];
                    $uploads_dir = DS.DS.'pcgh-fs-01'.DS.'ProwebScannedDocs'.DS.'ProRequisition'. DS .$filename;
                    move_uploaded_file($tmp_name, "$uploads_dir");*/
                
                    $file->write($data1);
                    //echo "whoop";
                    $path = $filename;
                }
            //--------------------------------------- End Processing Excel uploded -------------------------------------------------
            
            return $filename;
    }


    public function moveFile($filename){
          $filePath = WWW_ROOT.'files/'.$filename;
        /* Store the path of destination file */
        $destinationFilePath = WWW_ROOT.'files/processed/'.$filename;
          
        /* Move File from images to copyImages folder */
        if( !rename($filePath, $destinationFilePath) ) {  
            return 'success';  
        }  
        else {  
            return 'failed';  
        } 
    }

}



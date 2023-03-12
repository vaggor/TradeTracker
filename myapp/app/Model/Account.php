<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Account extends AppModel{
    public $name = 'Account';
	public $primaryKey = 'id';
	public $useTable = 'accounts';


    public function getMyAccounts($user_id=null){
        //print_r('hi');exit;
        return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id)));
    }


    public function getMyAccountName($id=null){
        //print_r('hi');exit;
        return $this->find('all', array('conditions'=>array('deleted'=>0,'id'=>$id),'fileds'=>array('name')));
    }

    

}

?>
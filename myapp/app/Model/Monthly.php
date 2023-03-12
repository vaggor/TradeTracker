<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Monthly extends AppModel{
    public $name = 'Monthly';
	public $primaryKey = 'id';
	public $useTable = 'm_m';


    public function getMonthlyBalances($user_id=null,$account_id=null){
        //print_r('hi');exit;
        return $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'account_id'=>$account_id)));
    }

    public function getBalance($user_id=null,$account_id=null){
        $data = $this->find('all', array('conditions'=>array('deleted'=>0,'user_id'=>$user_id,'account_id'=>$account_id),'fileds'=>array('closing_bal'),'order'=>array('id desc'),'limit'=>1));
        if(empty($data[0]['Monthly']['closing_bal'])){
            return 0;
        }else{
            return $data[0]['Monthly']['closing_bal'];
        }
    }

    public function getPercentageChange($month,$user_id=null,$account_id=null){
        $data = $this->find('all', array('conditions'=>array('deleted'=>0,'month'=>$month,'user_id'=>$user_id,'account_id'=>$account_id),'fileds'=>array('perc_change'),'order'=>array('id desc'),'limit'=>1));
        if(empty($data[0]['Monthly']['perc_change'])){
            return 0;
        }else{
            return $data[0]['Monthly']['perc_change'];
        }
    }

    public function getBalanceByMonth($month=null,$user_id=null,$account_id=null){
        //print_r($week);exit;
        $data = $this->find('all', array('conditions'=>array('deleted'=>0,'month'=>$month,'user_id'=>$user_id,'account_id'=>$account_id),'fileds'=>array('closing_bal'),'order'=>array('id desc'),'limit'=>1));
        //print_r($data);exit;
        if(empty($data[0]['Monthly']['closing_bal'])){
            return 0;
        }else{
            return $data[0]['Monthly']['closing_bal'];
        }
    }

    public function calculatePercentageChange($prev,$curr){
        //print_r($prev);exit;
        if($prev == 0){
            return 0;
        }
        $delta = $curr - $prev;
        //print_r($delta);exit;
        $absolute_value_of_prev = explode('-',$prev)[1];
        if(!isset($absolute_value_of_prev)){
            $absolute_value_of_prev =  $prev;
        }
        //print_r($absolute_value_of_prev);exit;
        $perc_change = $delta/$absolute_value_of_prev;
        $perc_change = number_format((float)$perc_change, 2, '.', '');
        return $perc_change*100;
    }

}

?>
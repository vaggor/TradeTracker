<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Trade extends AppModel{
    public $name = 'Trade';
	public $primaryKey = 'id';
	public $useTable = 'trades';

	//public $year = $this->getCurrentYear().'%';

	public function year(){
		$year = date('Y').'%';
		return $year;
	}

	public function getTrades(){
			return $this->find('all', array('conditions'=>array('deleted'=>0)));
	}

	public function getTradesByStatus($status=null,$user_id=null,$account_id=null){
		//print_r($status);exit;
		if($status == null){
			$data = $this->find('all',array('conditions'=>array('date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'order'=>array('id desc')));
		}else{
			$data = $this->find('all', array('conditions'=>array('status'=>$status,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'order'=>array('id desc')));
		}
		//print_r($data);exit;
		return $data;
	}

	public function getNumberOfWeeklyWinTrades($week=null,$user_id=null,$account_id=null){
			return $this->find('count', array('conditions'=>array('status'=>1,'week'=>$week,'w_l'=>'W','date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id)));
	}

	public function getPnl($date=null,$user_id=null,$account_id=null){
			$data = $this->find('all', array('conditions'=>array('status'=>1,'date'=>$date,'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('sum(Trade.pnl) as pnl')));
			return $data;
	}

	public function getWeeklyTrades($week=null,$user_id=null,$account_id=null){
			return $this->find('all', array('conditions'=>array('status'=>1,'week'=>$week,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'order'=>array('id desc')));
	}

	public function getNumberOfWeeklyTrades($week=null,$user_id=null,$account_id=null){
			return $this->find('count', array('conditions'=>array('status'=>1,'week'=>$week,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id)));
	}

	public function getNumberOfMonthlyTrades($user_id=null,$account_id=null){
			return $this->find('count', array('conditions'=>array('status'=>1,'user_id'=>$user_id,'account_id'=>$account_id,'date like'=>date('Y-m').'-%')));
	}

	public function getNumberOfEvenTrades($week=null,$user_id=null,$account_id=null){
			if(empty($week)){
				return $this->find('count', array('conditions'=>array('status'=>1,'w_l'=>'E','date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id)));
			}else{
				return $this->find('count', array('conditions'=>array('status'=>1,'week'=>$week,'w_l'=>'E','date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id)));
			}
			
	}

	public function getDays($user_id=null,$account_id=null){
		$data = $this->find('all', array('conditions'=>array('status'=>1,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('DISTINCT Trade.date'),'order'=>array('date asc')));
		//print_r($account_id);exit;
		return $data;
	}

	public function getWeeks($user_id=null,$account_id=null){
		$data = $this->find('all', array('conditions'=>array('status'=>1,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('DISTINCT Trade.week'),'order'=>array('week desc')));
		return $data;
	}

	public function getAverageRR($week=null,$user_id=null,$account_id=null){
		//print_r($account_id);exit;
			if(!empty($week)){
			$data = $this->find('all', array('conditions'=>array('status'=>1,'week'=>$week,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('AVG(Trade.rr) as average_rr')));
			if(empty($data[0][0]['average_rr'])){
				$res = 0;
			}else{
				$res = $data[0][0]['average_rr'];
			}
		}else{
			$data = $this->find('all', array('conditions'=>array('status'=>1,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('AVG(Trade.rr) as average_rr')));
			if(empty($data[0][0]['average_rr'])){
				$res = 0;
			}else{
				$res = $data[0][0]['average_rr'];
			}
		}
		return $res;
	}

	public function checkIfAlreadySaved($position,$user_id=null,$account_id=null){
			return $this->find('count', array('conditions'=>array('position'=>$position,'user_id'=>$user_id,'account_id'=>$account_id)));
	}

	public function scanDirectory(){
		$mydir = "../webroot/files";
 		$myfiles = scandir($mydir);
 		return $myfiles;
	}

	public function totalMonthlyProfit($month=null,$user_id=null,$account_id=null){
		//print_r($month);exit;
		//$month = 8;
		if(!empty($month)){
			if(strlen($month) == 1){
				$month = '0'.$month;
			}
			$month = date('Y').'-'.$month.'%';
			//print_r($month);exit;
			$data = $this->find('all', array('conditions'=>array('status'=>1,'start like'=>$month,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('sum(Trade.pnl) as total_m_profit')));
			//print_r($data);exit;
			if(empty($data[0][0]['total_m_profit'])){
				$res = 0;
			}else{
				$res = number_format((float)$data[0][0]['total_m_profit'], 2, '.', '');
			}
		}else{
			$res = 0;
		}
		return $res;
	}

	public function totalProfit($week=null,$user_id=null,$account_id=null){
		//print_r($account_id);exit;
		if(!empty($week)){
			$data = $this->find('all', array('conditions'=>array('status'=>1,'week'=>$week,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('sum(Trade.pnl) as total_profit')));
			//print_r($account_id1);exit;
			if(empty($data[0][0]['total_profit'])){
				$res = 0;
			}else{
				$res = $data[0][0]['total_profit'];
			}
		}else{
			$data = $this->find('all', array('conditions'=>array('status'=>1,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id),'fields'=>array('sum(Trade.pnl) as total_profit')));
			if(empty($data[0][0]['total_profit'])){
				$res = 0;
			}else{
				$res = $data[0][0]['total_profit'];
			}
		}
		return number_format((float)$res, 2, '.', '');
	}

	public function totalTrades($user_id=null,$account_id=null){
			return $this->find('count', array('conditions'=>array('status'=>1,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id)));
	}

	public function totalWins($user_id=null,$account_id=null){
			return $this->find('count', array('conditions'=>array('status'=>1,'pnl >'=>0,'date like'=>$this->year(),'user_id'=>$user_id,'account_id'=>$account_id)));
	}

	public function getPercentageProfitChange($user_id=null,$account_id=null){
		//$this_week = '2022-48';
		$this_week = $this->getWeekNumber(date('Y-m-d'));
		$exp = explode('-',$this_week);
		$last_week = $exp[0].'-'.($exp[1] - 1);
		$this_week_total_pnl = $this->totalProfit($this_week,$user_id,$account_id);
		$last_week_total_pnl = $this->totalProfit($last_week,$user_id,$account_id);
		$absolute_value_last_week_total_pnl = explode('-',$this->totalProfit($last_week))[1];
		$delta = abs($this_week_total_pnl - $last_week_total_pnl);
		$ratio = $delta/$absolute_value_last_week_total_pnl;
		$percentage_pnl = number_format((float)($ratio*100), 2, '.', '');
		//print_r($percentage_pnl);exit;
		return $percentage_pnl;
	}

	public function getPercentageProfitChangeWeekly($week,$user_id=null,$account_id=null){
		//print_r('=> => '.$week);exit;
		$first_week_of_year = date('Y').'-01';
		if($week == $first_week_of_year){
			return 0;
		}
		$this_week = $week;
		//$this_week = $this->getWeekNumber(date('Y-m-d'));
		$exp = explode('-',$this_week);
		$last_weekno = $exp[1] - 1;
		$strlen_of_weekno = strlen($last_weekno);
		if($strlen_of_weekno == 1){
			$last_weekno = '0'.$last_weekno;
		}
		$last_week = $exp[0].'-'.$last_weekno;
		$this_week_total_pnl = $this->totalProfit($this_week,$user_id,$account_id);
		$last_week_total_pnl = $this->totalProfit($last_week,$user_id,$account_id);
		$absolute_value_last_week_total_pnl = explode('-',$this->totalProfit($last_week,$user_id,$account_id))[1];
		$delta = $this_week_total_pnl - $last_week_total_pnl;
		$ratio = $delta/$absolute_value_last_week_total_pnl;
		//$percentage_pnl = number_format((float)($ratio*100), 2, '.', '');
		//print_r($ratio);exit;
		return $ratio;
	}

	public function getPercentageWinRateChange($user_id=null,$account_id=null){
		//$this_week = '2022-48';
		$this_week = $this->getNumberOfWeeklyWinTrades(date('Y-m-d'));
		$exp = explode('-',$this_week);
		$last_week = $exp[0].'-'.($exp[1] - 1);
		$this_week_win_rate = $this->getNumberOfWeeklyWinTrades($this_week,$user_id,$account_id);
		$last_week_win_rate = $this->getNumberOfWeeklyWinTrades($last_week,$user_id,$account_id);
		if($last_week_win_rate < 0){
			$absolute_value_last_week_win_rate = explode('-',$this->getNumberOfWeeklyWinTrades($last_week,$user_id,$account_id))[1];
		}else{
			$absolute_value_last_week_win_rate = $last_week_win_rate;
		}
		
		$delta = abs($this_week_win_rate - $last_week_win_rate);
		$ratio = $delta/$absolute_value_last_week_win_rate;
		$percentage_win_rate = number_format((float)($ratio*100), 2, '.', '');
		//print_r($percentage_win_rate);exit;
		return $percentage_win_rate;
	}

	public function getPercentageRRChange($user_id=null,$account_id=null){
		//$this_week = '2022-48';
		$this_week = $this->getNumberOfWeeklyWinTrades(date('Y-m-d'),$user_id,$account_id);
		$exp = explode('-',$this_week);
		$last_week = $exp[0].'-'.($exp[1] - 1);
		$this_week_rr = $this->getAverageRR($this_week,$user_id,$account_id);
		$last_week_rr = $this->getAverageRR($last_week,$user_id,$account_id);
		if($last_week_rr < 0){
			$absolute_value_last_week_rr = explode('-',$this->getAverageRR($last_week,$user_id,$account_id))[1];
		}else{
			$absolute_value_last_week_rr = $last_week_rr;
		}
		
		$delta = abs($this_week_rr - $last_week_rr);
		if($absolute_value_last_week_rr == 0){
			$ratio = 0;
		}else{
			$ratio = $delta/$absolute_value_last_week_rr;
		}
		
		$percentage_rr = number_format((float)($ratio*100), 2, '.', '');
		//print_r($percentage_win_rate);exit;
		return $percentage_rr;
	}


	public function getPercentageEvenTradeChange($user_id=null,$account_id=null){
		//$this_week = '2022-48';
		$this_week = $this->getNumberOfWeeklyWinTrades(date('Y-m-d'),$user_id,$account_id);
		$exp = explode('-',$this_week);
		$last_week = $exp[0].'-'.($exp[1] - 1);
		$this_week_even_trades = $this->getNumberOfEvenTrades($this_week,$user_id,$account_id);
		$last_week_even_trades = $this->getNumberOfEvenTrades($last_week,$user_id,$account_id);
		if($last_week_even_trades < 0){
			$absolute_value_last_week_even_trades = explode('-',$this->getNumberOfEvenTrades($last_week,$user_id,$account_id))[1];
		}else{
			$absolute_value_last_week_even_trades = $last_week_even_trades;
		}
		
		$delta = abs($this_week_even_trades - $last_week_even_trades);
		$ratio = $delta/$absolute_value_last_week_even_trades;
		$percentage_even_trades = number_format((float)($ratio*100), 2, '.', '');
		//print_r($percentage_win_rate);exit;
		return $percentage_even_trades;
	}

	public function calculateProfitPips($price,$profit,$type,$pair){
		if(strpos($pair,'JPY') !== false){
			$multiplier = 100;
		}else{
			$multiplier = 10000;
		}

		if($type == 'buy'){
			//print_r($profit - $price);exit;
			$pp = ($profit - $price)*$multiplier;
		}else if($type == 'sell'){
			$pp = ($price - $profit)*$multiplier;
		}

		return number_format((float)$pp, 2, '.', '');
	}

	public function calculateStopLossPips($price,$sl,$type,$pair){
		if(strpos($pair,'JPY') !== false){
			$multiplier = 100;
		}else{
			$multiplier = 10000;
		}

		if($type == 'buy'){
			$pp = ($price - $sl)*$multiplier;
		}else if($type == 'sell'){
			$pp = ($sl - $price)*$multiplier;
		}

		return number_format((float)$pp, 2, '.', '');
	}

	public function saveTrade($start,$end,$position,$symbol,$type,$volume,$sl,$start_price,$end_price,$pips_w,$pip_l,$pnl,$rr,$win_loss,$week,$status,$date_saved,$date_updated){
		$exp = explode(' ', $start);
		//print_r($exp);exit;
		$data = array();
		$data['Trade']['start'] = $start;
		$data['Trade']['end'] = $end;
		$data['Trade']['position'] = $position;
		$data['Trade']['symbol'] = $symbol;
		$data['Trade']['type'] = $type;
		$data['Trade']['volume'] = $volume;
		$data['Trade']['sl'] = $sl;
		$data['Trade']['start_price'] = $start_price;
		$data['Trade']['end_price'] = $end_price;
		$data['Trade']['pips_w'] = $pips_w;
		$data['Trade']['pip_l'] = $pip_l;
		$data['Trade']['pnl'] = $pnl;
		$data['Trade']['rr'] = $rr;
		$data['Trade']['w_l'] = $win_loss;
		$data['Trade']['week'] = $week;
		$data['Trade']['status'] = $status;
		$data['Trade']['date'] = $exp[0];
		$data['Trade']['date_saved'] = $date_saved;
		$data['Trade']['date_updated'] = $date_updated;
		if(!empty($data)){
			$this->saveAll($data);
		}
	}

	public function updateTrade($id,$end,$end_price,$pnl){
		$data['Trade']['end'] = $end;
		$data['Trade']['end_price'] = $end_price;
		$data['Trade']['start'] = $start;
		$data['Trade']['pnl'] = $pnl;
		$data['Trade']['status'] = 1;
		$data['Trade']['date_updated'] = date('Y-m-d H:i');
		if(!empty($data)){
			$this->saveAll($data);
		}
	}

	public function deleteLogs($date){
		$sql = "DELETE FROM logs WHERE date LIKE '".$date."%'";
		//print_r($sql);exit;
		if($this->query($sql)){
			$resp = "Delete Successful";
		}
		else{
			$resp = "Delete Failed";
		}
		return $resp;
	}

}
?>
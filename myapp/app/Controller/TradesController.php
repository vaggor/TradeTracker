<?php

App::import('Vendor', 'excel_reader2'); //import statement
App::import('Vendor', 'vendor/autoload');
App::uses('Vendor', 'vendor/PhpOffice/PhpSpreadsheet/Spreadsheet');

App::uses('CakeEmail', 'Network/Email');
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
  class TradesController extends AppController {
  public $name = 'Trades';
  public $uses = array('User','Coin','Portfolio','Dashboard','Trade','TradeHistory','TradingPair','Balance','Monthly','Account');
  public $components = array('Session', 'Email','Auth','Highcharts.Highcharts');


  	public function accounts(){
  		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		//print_r($user_id);exit;
		$accounts = $this->Account->getMyAccounts($user_id);
		$this->set(compact('accounts'));
  	}


  	public function selectAccountButPressed($account_id=null){
  		$this->Session->write('Auth.User.account_id', $account_id);
  		$this->redirect('dashboard');
  	}
  

	public function dashboard(){
		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$account_id = $sess['account_id'];

		$account_name = $this->Account->getMyAccountName($account_id);
		//print_r($account_id);exit;
		$this_week = $this->Trade->getWeekNumber(date('Y-m-d'));
		//$this_week = '2022-48';
		$pnl = $this->Trade->totalProfit('',$user_id,$account_id);
		$total_trades = $this->Trade->totalTrades($user_id,$account_id);
		$total_wins = $this->Trade->totalWins($user_id,$account_id);
		$percentage_pnl = $this->Trade->getPercentageProfitChange($user_id,$account_id);
		$win_percentage = ($total_wins/$total_trades)*100;
		$win_percentage = number_format((float)$win_percentage, 2, '.', '');
		$percentage_win_rate = $this->Trade->getPercentageWinRateChange($user_id,$account_id);
		$avg_rr = number_format((float)$this->Trade->getAverageRR('',$user_id,$account_id), 2, '.', '');
		$percentage_rr = number_format((float)$this->Trade->getPercentageRRChange($user_id,$account_id), 2, '.', '');
		$no_even_trades = $this->Trade->getNumberOfEvenTrades('',$user_id,$account_id);
		$percentage_even_trades = number_format((float)$this->Trade->getPercentageEvenTradeChange($user_id,$account_id), 2, '.', '');
		$weeks = $this->Trade->getWeeks($user_id,$account_id);
		$trades = $this->Trade->getWeeklyTrades($this_week,$user_id,$account_id);
		//print_r($user_id);exit;
		$weekly_prof = $this->Trade->totalProfit($this_week,$user_id,$account_id);
		$monthly_stats = $this->Monthly->getMonthlyBalances($user_id,$account_id);
		$this->equityCurve($user_id,$account_id);
		$this->monthlyPnLGraph($user_id,$account_id);

		if(!empty($this->request->data)){
			$data = $this->request->data;
			$data['Trade']['user_id'] = $user_id;
			$data['Trade']['account_id'] = $account_id;
			//print_r($data['Trade']['file']['size']);exit;
			if($data['Trade']['file']['size'] == 0){
				$data['Trade']['file'] = '';
				//print_r($data);exit;
				$this->processManualEntey($data);
			}else{
				$this->upload_file($data['Trade']['file']);
			}
			$this->redirect('dashboard');
		}

		
		$this->set(compact('pnl','win_percentage','percentage_pnl','percentage_win_rate','avg_rr','percentage_rr','no_even_trades','percentage_even_trades','weeks','trades','weekly_prof','monthly_stats','account_name'));
		
	}


	public function process_file(){
		//print_r($this->Trade->getWeekNumber('2022-08-10 15:25:42'));exit;
		$datas = $this->get_file_data();
		unset($datas[0]);
		//print_r($datas);exit;
		foreach($datas as $data){
    		$already_saved = $this->Trade->checkIfAlreadySaved($data[1]);
    		if($already_saved == 0){
    			$start = str_replace('.','-',$data[0]);
    			$end = str_replace('.','-',$data[8]);
    			$position = $data[1];
    			$symbol = $data[2];
    			$type = $data[3];
    			$volume = $data[4];
    			$sl = $this->Trade->formateData($data[6]);
    			$start_price = $this->Trade->formateData($data[5]);
    			$end_price = $this->Trade->formateData($data[9]);
    			$pnl = $this->Trade->formateData($data[12]);
    			$pip_l = $this->Trade->calculateStopLossPips($start_price,$sl,$type,$symbol);
    			$week = $this->Trade->getWeekNumber($start);

    			if($pnl > 0){
    				$pips_w = $this->Trade->calculateProfitPips($start_price,$end_price,$type,$symbol);
    				$rr = number_format((float)($pips_w/$pip_l), 2, '.', '');
    				if($rr > 0){
    					$rr = $rr;
    				}else{
    					$rr = '';
    				}
    			}else{
    				$pips_w = '';
    				$rr = '';
    			}

    			if($pnl < 0){
    				$win_loss = 'L';
    			}else if($pnl > 0){
    				$win_loss = 'W';
    			}else if($pnl == 0){
    				$win_loss = 'E';
    			}else{
    				$win_loss = '';
    			}
    			
    			$status = 1;
    			$date_saved = date('Y-m-d H:i');
    			$date_updated = '';
    			//print_r($start_price);exit;
    			$this->Trade->saveTrade($start,$end,$position,$symbol,$type,$volume,$sl,$start_price,$end_price,$pips_w,$pip_l,$pnl,$rr,$win_loss,$week,$status,$date_saved,$date_updated);
    		}
    	} 
    	//$this->redirect('dashboard');
	}


	public function processManualEntey($data){
		//$data = $this->request->data;
			//print_r($data);exit;
		$data['Trade']['start'] = str_replace('.','-',$data['Trade']['start']);
    	$data['Trade']['end'] = str_replace('.','-',$data['Trade']['end']);
			if($data['Trade']['pnl'] > 0){
    			$data['Trade']['pips_w'] = $pips_w = $this->Trade->calculateProfitPips($data['Trade']['start_price'],$data['Trade']['end_price'],$data['Trade']['type'],$data['Trade']['symbol']);
    			$data['Trade']['rr'] = $rr = number_format((float)($pips_w/$data['Trade']['pip_l']), 2, '.', '');
    			//print_r($data['Trade']['rr']);exit;
    			if($rr < 0){
    				$data['Trade']['rr'] = '';
    			}
    		}

	    	if($data['Trade']['pnl'] < 0){
	    		$data['Trade']['w_l'] = 'L';
	    	}else if($data['Trade']['pnl'] > 0){
	   			$data['Trade']['w_l'] = 'W';
	   		}else if($data['Trade']['pnl'] == 0){
	   			$data['Trade']['w_l'] =  'E';
	   		}else{
    			$data['Trade']['w_l'] =  '';
	   		}
	    	
	    	if($data['Trade']['trade_closed'] == 1){
	    		$data['Trade']['status'] = 1;
	    	}
	    	$data['Trade']['date_saved'] = date('Y-m-d H:i');
	    	$data['Trade']['week'] = $this->Trade->getWeekNumber($data['Trade']['start']);
	    	$data['Trade']['date'] = explode(' ', $data['Trade']['start'])[0];
			//print_r($data);exit;
			if($this->Trade->save($data)){
				//$this->redirect('dashboard');
				return;
			}
			
	}


	public function upload_file($data){
		//print_r($data);exit;
		if(!empty($data['name'])){
			if($this->Trade->validateUpload($data) != 1){
					//CakeLog::write('info', $this->AdsImage->validateUpload($data['Ad']['image'.$i]));
				$this->Session->setFlash('Upload a valid file','default',array('class'=>'alert alert-dismissible alert-danger'));
				return;
			}	

			$file = $this->Trade->uploadDocument($data);
			$this->process_file();
			$this->Trade->moveFile($file);
		}
 	}


 	public function get_file_data(){
 		$myfiles = $this->Trade->scanDirectory();
 		//print_r($myfiles);exit;
 		foreach($myfiles as $myfile){
 			//print_r($myfile);exit;
 			$exp_file = explode('.',$myfile);
 			//print_r($exp_file[1]);exit;
 			if(isset($exp_file[1])){
 				$extension = $exp_file[1];
 			}else{
 				$extension = '';
 			}
 			//print_r($extension);exit;

 			if(in_array($extension, array('csv','xls','xlsx'))){
 				//print_r($extension);exit;
 				if('csv' == $extension) {     
				  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
				} else if('xls' == $extension) {     
				  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
				} else{ 
				  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
				}

				$spreadsheet = $reader->load("../webroot/files/".$myfile);
				//$d=$spreadsheet->getSheet(0)->toArray();
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				//print_r($d);exit;
				return $sheetData;
 			}
 		}


 	}


 	public function getWeeklyStats($week){
 		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$account_id = $sess['account_id'];

 		$no_trades = $this->Trade->getNumberOfWeeklyTrades($week,$user_id,$account_id);
 		$total_pnl = $this->Trade->totalProfit($week,$user_id,$account_id);
 		$pnl_perc = $this->Balance->getPercentageChange($week,$user_id,$account_id);
 		$data = array('no_trades'=>$no_trades,'total_pnl'=>$total_pnl,'pnl_perc'=>$pnl_perc);
 		return $data;
 	}



 	public function monthlyPnLGraph($user_id=null,$account_id=null) {

 				$months = array(1,2,3,4,5,6,7,8,9,10,11,12);
 				//$chartData = '';
 				foreach($months as $monthKey=>$monthValue){
 					$chartData[$monthKey] = (double)$this->Trade->totalMonthlyProfit($monthValue,$user_id,$account_id);
 				}
                $chartName = 'Column Chart';

                $mychart = $this->Highcharts->create($chartName, 'column');

                $this->Highcharts->setChartParams($chartName, array(
                    'renderTo' => 'columnwrapper', // div to display chart inside
                    'chartWidth' => 1000,
                    'chartHeight' => 750,
                    //'chartBackgroundColorLinearGradient' 	=> array(0,0,0,300),
                    //'chartBackgroundColorStops'                 => array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                    'title' => '',
                    'subtitle' => '',
                    'xAxisLabelsEnabled' => TRUE,
                    //'xAxisCategories' => array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
                    'xAxisCategories' => $months,
                    'yAxisTitleText' => 'P&L',
                    'enableAutoStep' => FALSE,
                    'creditsEnabled' => FALSE,
                    'chartTheme' => 'skies'
                        )
                );

                $series = $this->Highcharts->addChartSeries();

                $series->addName('Months')
                        ->addData($chartData);

                $mychart->addSeries($series);
                
                $this->set(compact('chartName'));
        }




 public function equityCurve($user_id=null,$account_id=null) {
 				$days = $this->Trade->getDays($user_id,$account_id);
 				//print_r($days);exit;
 				//$pnl_count = sizeof($pnl);
 				foreach($days as $dayKey=>$dayValue){
 					$pnl = $this->Trade->getPnl($dayValue['Trade']['date'],$user_id,$account_id);
 					//print_r($pnl[0][0]['pnl']);exit;
 					$chartData2[$dayKey] = (double)$pnl[0][0]['pnl'];
 				}
 				//print_r($chartData2);exit;
 				//$chartData2 = array(7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6);
                
                $chartName2 = 'Line Chart';

                $mychart = $this->Highcharts->create($chartName2, 'line');

                $this->Highcharts->setChartParams($chartName2, array(
                    'renderTo' => 'linewrapper', // div to display chart inside
                    'chartWidth' => 1100,
                    'chartHeight' => 600,
                    'chartMarginTop' => 60,
                    'chartMarginLeft' => 90,
                    'chartMarginRight' => 30,
                    'chartMarginBottom' => 110,
                    'chartSpacingRight' => 10,
                    'chartSpacingBottom' => 15,
                    'chartSpacingLeft' => 0,
                    'chartAlignTicks' => FALSE,
                    'chartBackgroundColorLinearGradient' => array(0, 0, 0, 300),
                    'chartBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
                    //'title' => 'Equity Curve',
                    'titleAlign' => 'left',
                    'titleFloating' => TRUE,
                    'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
                    'titleStyleColor' => '#0099ff',
                    'titleX' => 20,
                    'titleY' => 20,
                    'legendEnabled' => TRUE,
                    'legendLayout' => 'horizontal',
                    'legendAlign' => 'center',
                    'legendVerticalAlign ' => 'bottom',
                    'legendItemStyle' => array('color' => '#222'),
                    'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
                    'legendBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
                    'tooltipEnabled' => FALSE,
                    // 'tooltipBackgroundColorLinearGradient' 	=> array(0,0,0,50),   // triggers js error
                    // 'tooltipBackgroundColorStops' 		=> array(array(0,'rgb(217, 217, 217)'),array(1,'rgb(255, 255, 255)')),
                    //'plotOptionsLinePointStart' 		=> strtotime('-30 day') * 1000,
                    //'plotOptionsLinePointInterval' 	=> 24 * 3600 * 1000,
                    //'xAxisType' 				=> 'datetime',
                    //'xAxisTickInterval' 			=> 10,
                    //'xAxisStartOnTick' 			=> TRUE,
                    //'xAxisTickmarkPlacement' 		=> 'on',
                    //'xAxisTickLength' 			=> 10,
                    //'xAxisMinorTickLength' 		=> 5,
                    'xAxisLabelsEnabled' => TRUE,
                    'xAxisLabelsAlign' => 'right',
                    'xAxisLabelsStep' => 1,
                    //'xAxisLabelsRotation' 		=> -35,
                    'xAxislabelsX' => 5,
                    'xAxisLabelsY' => 20,
                    'xAxisCategories' => array(),
                    //'yAxisMin' 			=> 0,
                    //'yAxisMaxPadding'			=> 0.2,
                    //'yAxisEndOnTick'			=> FALSE,
                    //'yAxisMinorGridLineWidth' 	=> 0,
                    //'yAxisMinorTickInterval' 		=> 'auto',
                    //'yAxisMinorTickLength' 		=> 1,
                    //'yAxisTickLength'			=> 2,
                    //'yAxisMinorTickWidth'		=> 1,
                    'yAxisTitleText' => 'P&L',
                    //'yAxisTitleAlign' 		=> 'high',
                    //'yAxisTitleStyleFont' 		=> '14px Metrophobic, Arial, sans-serif',
                    //'yAxisTitleRotation' 		=> 0,
                    //'yAxisTitleX' 			=> 0,
                    //'yAxisTitleY' 			=> -10,
                    //'yAxisPlotLines' 			=> array( array('color' => '#808080', 'width' => 1, 'value' => 0 )),
                    // autostep options
                    'enableAutoStep' => FALSE
                        )
                );

                $series = $this->Highcharts->addChartSeries();

                $series->addName('P&L')
                        ->addData($chartData2);

                $mychart->addSeries($series);
                
                $this->set(compact('chartName2'));
        }




     public function entries($status=null){
     	$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$account_id = $sess['account_id'];
     	//print_r($status);exit;
     	$data = $this->Trade->getTradesByStatus($status,$user_id,$account_id);
     	$this->set(compact('data'));
     }



    public function weeklyBalances(){
    	$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$account_id = $sess['account_id'];

    	if(!empty($this->request->data)){
			$data=$this->request->data;
			$this->saveWeeklyBalance($data);
		}

     	$data = $this->Balance->getBalances($user_id,$account_id);
     	$this->set(compact('data'));
    }


    public function saveWeeklyBalance($data){
		if(!empty($data)){
			$sess = $this->Auth->user();
			$user_id = $sess['id'];
			$account_id = $sess['account_id'];
			//print_r($data);exit;
			$data['Balance']['date'] = date('Y-m-d H:i');
			if(!empty($data['Balance']['id'])){
				$exp = explode('-',$data['Balance']['week']);
				$weekno = $exp[1] - 1;
				$strlen_of_weekno = strlen($weekno);
				if($strlen_of_weekno == 1){
					$prev_week = $exp[0].'-0'.$weekno;
				}else{
					$prev_week = $exp[0].'-'.$weekno;
				}
				$prev_balance = $this->Balance->getBalanceByWeek($prev_week,$user_id,$account_id);
			}else{
				$prev_balance = $this->Balance->getBalance($user_id,$account_id);
			}
			//print_r($data['Balance']['balance']);exit;
			$data['Balance']['opening_bal'] = $prev_balance;
			$data['Balance']['perc_change'] = $this->Balance->calculatePercentageChange($prev_balance,$data['Balance']['closing_bal']);
			$data['Balance']['user_id'] = $sess['id'];
			$data['Balance']['account_id'] = $sess['account_id'];
			//print_r($data);exit;
			if($this->Balance->validates()){
				if($this->Balance->save($data)){
				$this->redirect('weeklyBalances');
			}
		}
	
	}
 }



 public function monthlyBalances(){
 		$sess = $this->Auth->user();
		$user_id = $sess['id'];
		$account_id = $sess['account_id'];

    	if(!empty($this->request->data)){
			$data=$this->request->data;
			$this->saveMonthlyBalance($data);
		}

     	$data = $this->Monthly->getMonthlyBalances($user_id,$account_id);
     	$this->set(compact('data'));
    }


    public function saveMonthlyBalance($data){
		if(!empty($data)){
			$sess = $this->Auth->user();
			$user_id = $sess['id'];
			$account_id = $sess['account_id'];
			//print_r($data);exit;
			$data['Monthly']['date'] = date('Y-m-d H:i');
			$data['Monthly']['no_trades'] = $this->Trade->getNumberOfMonthlyTrades();
			if(!empty($data['Monthly']['id'])){
				$exp = explode('-',$data['Monthly']['month']);
				$weekno = $exp[1] - 1;
				$strlen_of_weekno = strlen($weekno);
				if($strlen_of_weekno == 1){
					$prev_week = $exp[0].'-0'.$weekno;
				}else{
					$prev_week = $exp[0].'-'.$weekno;
				}
				$prev_balance = $this->Monthly->getBalanceByMonth($prev_week,$user_id,$account_id);
			}else{
				$prev_balance = $this->Monthly->getBalance($user_id,$account_id);
			}
			//print_r($data['Balance']['balance']);exit;
			$data['Monthly']['opening_bal'] = $prev_balance;
			$data['Monthly']['perc_change'] = $this->Monthly->calculatePercentageChange($prev_balance,$data['Monthly']['closing_bal']);
			$data['Monthly']['user_id'] = $sess['id'];
			$data['Monthly']['account_id'] = $sess['account_id'];
			//print_r($data);exit;
			if($this->Monthly->validates()){
				if($this->Monthly->save($data)){
				$this->redirect('monthlyBalances');
			}
		}
	
	}
 }



  
}
?>
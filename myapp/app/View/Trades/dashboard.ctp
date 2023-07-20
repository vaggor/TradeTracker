
<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $account_name[0]['Account']['name']; ?></li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
          </div>
          <div class="d-none d-md-block">
            <!-- <button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="mail" class="wd-10 mg-r-5"></i> Email</button>
            <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="printer" class="wd-10 mg-r-5"></i> Print</button>
            <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file" class="wd-10 mg-r-5"></i> Save Trade</button> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Save Trade</button>
          </div>
        </div>

        <div class="row row-xs">
          <div class="col-sm-6 col-lg-3">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Total Profit</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo '$'.$pnl; ?></h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium <?php if($percentage_pnl > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo $percentage_pnl; ?>% <i class="icon <?php if($percentage_pnl > 0){echo 'ion-md-arrow-up';}else{echo 'ion-md-arrow-down';} ?>"></i></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart3" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Win Percentage</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo $win_percentage.'%'; ?></h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium <?php if($percentage_win_rate > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo $percentage_win_rate; ?>% <i class="icon <?php if($percentage_win_rate > 0){echo 'ion-md-arrow-up';}else{echo 'ion-md-arrow-down';} ?>"></i></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart4" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Avg. RR</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo $avg_rr; ?></h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium <?php if($percentage_rr > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo $percentage_rr; ?>% <i class="icon <?php if($percentage_rr > 0){echo 'ion-md-arrow-up';}else{echo 'ion-md-arrow-down';} ?>"></i></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart5" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Break Even Trades</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"><?php echo $no_even_trades; ?></h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium <?php if($percentage_even_trades > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo $percentage_even_trades; ?>% <i class="icon <?php if($percentage_even_trades > 0){echo 'ion-md-arrow-up';}else{echo 'ion-md-arrow-down';} ?>"></i></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart6" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          <div class="" style="width:100%;">
            <div class="card">
              <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Equity Curve</h6>
                <!-- <ul class="list-inline d-flex mg-t-20 mg-sm-t-10 mg-md-t-0 mg-b-0">
                  <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-df-1 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Growth Actual</span>
                  </li>
                  <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Actual</span>
                  </li>
                  <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Plan</span>
                  </li>
                </ul> -->
              </div><!-- card-header -->
              <div class="card-body pos-relative pd-0">

                <div class="chart-one">
                  <div class="chart">

        <div id="linewrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>
        <div class="clear"></div>   

        <?php echo $this->Highcharts->render($chartName2); ?>

</div>
                </div><!-- chart-one -->
              </div><!-- card-body -->
            </div><!-- card -->
          </div>
          
          <div class="col-md-6 col-xl-4 mg-t-10 order-md-1 order-xl-0">
            <div class="card ht-lg-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Weekly Stats</h6>
                <!-- <div class="tx-13 d-flex align-items-center">
                  <span class="mg-r-5">Country:</span> <a href="#" class="d-flex align-items-center link-03 lh-0">USA <i class="icon ion-ios-arrow-down mg-l-5"></i></a>
                </div> -->
              </div><!-- card-header -->
              <div class="card-body pd-0">
                <!-- <div class="pd-y-25 pd-x-20">
                  <div id="vmap" class="ht-200"></div>
                </div> -->
                <div class="table-responsive">
                  <table class="table table-borderless table-dashboard table-dashboard-one">
                    <thead>
                      <tr>
                        <th class="wd-40">Week</th>
                        <th class="wd-25 text-right">No. Trades</th>
                        <th class="wd-35 text-right">P&L($)</th>
                        <th class="wd-35 text-right">P&L %</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $total_trade = 0;
                      $total_perc_change = 0;
                      $total_pnl = 0;
                      foreach($weeks as $week){ 
                        $w_stats = $this->requestAction('trades/getWeeklyStats/'.$week['Trade']['week']);
                        $total_trade = $total_trade + $w_stats['no_trades'];
                        $total_perc_change = $total_perc_change + $w_stats['pnl_perc'];
                        $total_pnl = $total_pnl + $w_stats['total_pnl'];
                        //print_r($w_stats);exit;
                        ?>
                      <tr>
                        <td class="tx-medium"><?php echo $week['Trade']['week']; ?></td>
                        <td class="text-right"><?php echo $w_stats['no_trades']; ?></td>
                        <td class="text-right"><span class="<?php if($w_stats['total_pnl'] > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo number_format((float)$w_stats['total_pnl'], 2, '.', ''); ?></span></td>
                         <td class="text-right"><span class="<?php if($w_stats['pnl_perc'] > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo number_format((float)$w_stats['pnl_perc'], 2, '.', ''); ?>%</span></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <th class="wd-40">Total</th>
                        <th class="wd-25 text-right"><?php echo $total_trade; ?></th>
                        <th class="wd-35 text-right"><?php echo number_format((float)$total_pnl, 2, '.', ''); ?></th>
                        <th class="wd-35 text-right"><?php echo number_format((float)$total_perc_change, 2, '.', ''); ?></th>
                      </tr>
                    </tbody>
                  </table>


                    <div class="card-header d-flex align-items-center justify-content-between">
                      <h6 class="mg-b-0">Monthly Stats</h6>
                      <!-- <div class="tx-13 d-flex align-items-center">
                        <span class="mg-r-5">Country:</span> <a href="#" class="d-flex align-items-center link-03 lh-0">USA <i class="icon ion-ios-arrow-down mg-l-5"></i></a>
                      </div> -->
                    </div><!-- card-header -->
                   <table class="table table-borderless table-dashboard table-dashboard-one">
                    <thead>
                      <tr>
                        <th class="wd-40">Month</th>
                        <th class="wd-25 text-right">No. Trades</th>
                        <th class="wd-35 text-right">Open Bal</th>
                        <th class="wd-35 text-right">Close Bal</th>
                        <th class="wd-35 text-right">P&L %</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $total_trade = 0;
                      $total_perc_change = 0;
                      foreach($monthly_stats as $monthly_stat){ 
                        $total_trade = $total_trade + $monthly_stat['Monthly']['no_trades'];
                        $total_perc_change = $total_perc_change + $monthly_stat['Monthly']['perc_change'];
                        //print_r($w_stats);exit;
                        ?>
                      <tr>
                        <td class="tx-medium"><?php echo $monthly_stat['Monthly']['month']; ?></td>
                        <td class="text-right"><?php echo $monthly_stat['Monthly']['no_trades']; ?></td>
                        <td class="text-right"><?php echo $monthly_stat['Monthly']['opening_bal']; ?></td>
                        <td class="text-right"><?php echo $monthly_stat['Monthly']['closing_bal']; ?></td>
                         <td class="text-right"><span class="<?php if($monthly_stat['Monthly']['perc_change'] > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo number_format((float)$monthly_stat['Monthly']['perc_change'], 2, '.', ''); ?>%</span></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <th class="wd-40">Total</th>
                        <th class="wd-25 text-right"><?php echo $total_trade; ?></th>
                        <th class="wd-35 text-right"></th>
                        <th class="wd-35 text-right"></th>
                        <th class="wd-25 text-right"><?php echo $total_perc_change; ?></th>
                      </tr>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card-body -->
            </div><!-- card -->
          </div><!-- col -->
          <div class="col-lg-12 col-xl-8 mg-t-10">
            <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">Your Most Recent Trades</h6>
                  <p class="tx-13 tx-color-03 mg-b-0">Your trades for the week</p>
                </div>
                <div class="d-flex mg-t-20 mg-sm-t-0">
                  <div class="btn-group flex-fill">
                    <button class="btn btn-white btn-xs active">Range</button>
                    <button class="btn btn-white btn-xs">Period</button>
                  </div>
                </div>
              </div><!-- card-header -->
              <div class="card-body pd-y-30">
                <div class="d-sm-flex">
                  <div class="media">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Earnings Earnings</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0"><?php echo $weekly_prof; ?></h4>
                    </div>
                  </div>
                  <!-- <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Tax Withheld</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">$234,769<small>.50</small></h4>
                    </div>
                  </div>
                  <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Net Earnings</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">$1,608,469<small>.50</small></h4>
                    </div>
                  </div> -->
                </div>
              </div><!-- card-body -->
              <div class="table-responsive">
                <table class="table table-dashboard mg-b-0">
                  <thead>
                    <tr>
                      <th>Start Date</th>
                      <th>Symbol</th>
                      <th class="text-right">Type</th>
                      <th class="text-right">Volume</th>
                      <th class="text-right">RR</th>
                      <th class="text-right">P&L</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($trades as $trade){ ?>
                    <tr>
                      <td class="tx-color-03 tx-normal"><?php echo date('d M,Y',strtotime($trade['Trade']['start'])).' '.date('H:i',strtotime($trade['Trade']['start'])); ?></td>
                      <td class="tx-color-03 tx-normal"><a href="<?php echo $trade['Trade']['url']; ?>" target="_blank"><?php echo $trade['Trade']['symbol']; ?></a></td>
                     
                      <td class="text-right"><?php echo $trade['Trade']['type']; ?></td>
                      <td class="text-right"><?php echo $trade['Trade']['volume']; ?></td>
                      <td class="text-right"><?php echo $trade['Trade']['rr']; ?></td>
                      <td class="text-right <?php if($trade['Trade']['pnl'] > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo $trade['Trade']['pnl']; ?> </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card -->
          </div><!-- col -->



          <div class="" style="width:100%; margin-top:10px;">
            <div class="card" >
              <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Monthly P&L</h6>
                
              </div><!-- card-header -->
              <div class="card-body pos-relative pd-0">
                <div class="chart">

                        <div id="columnwrapper" style="display: block; float: left; width:90%; margin-bottom: 20px;"></div>
                        <div class="clear"></div> 

                        <?php echo $this->Highcharts->render($chartName); ?>

                </div>
              </div><!-- card-body -->
            </div><!-- card -->
          </div>
          


          <!--<div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Transaction History</h6>
                <div class="d-flex tx-18">
                  <a href="#" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                  <a href="#" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                </div>
              </div>
              <ul class="list-group list-group-flush tx-13">
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-teal"><i class="icon ion-md-checkmark"></i></span></div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0">Payment from #10322</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Mar 21, 2019, 3:30pm</small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-0">+ $250.00</p>
                    <small class="tx-12 tx-success mg-b-0">Completed</small>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-indigo op-5"><i class="icon ion-md-return-left"></i></span></div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-2">Process refund to #00910</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Mar 21, 2019, 1:00pm</small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-2">-$16.50</p>
                    <small class="tx-12 tx-success mg-b-0">Completed</small>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-orange op-5"><i class="icon ion-md-bus"></i></span></div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-2">Process delivery to #44333</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Mar 20, 2019, 11:40am</small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-2">3 Items</p>
                    <small class="tx-12 tx-info mg-b-0">For pickup</small>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-teal"><i class="icon ion-md-checkmark"></i></span></div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0">Payment from #023328</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Mar 20, 2019, 10:30pm</small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-0">+ $129.50</p>
                    <small class="tx-12 tx-success mg-b-0">Completed</small>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-gray-400"><i class="icon ion-md-close"></i></span></div>
                  <div class="pd-sm-l-10">
                    <p class="tx-medium mg-b-0">Payment failed from #087651</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Mar 19, 2019, 12:54pm</small>
                  </div>
                  <div class="mg-l-auto text-right">
                    <p class="tx-medium mg-b-0">$150.00</p>
                    <small class="tx-12 tx-danger mg-b-0">Declined</small>
                  </div>
                </li>
              </ul>
              <div class="card-footer text-center tx-13">
                <a href="#" class="link-03">View All Transactions <i class="icon ion-md-arrow-down mg-l-5"></i></a>
              </div>
            </div>
          </div>!-->

          <!--<div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">New Customers</h6>
                <div class="d-flex align-items-center tx-18">
                  <a href="#" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                  <a href="#" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                </div>
              </div>
              <ul class="list-group list-group-flush tx-13">
                <li class="list-group-item d-flex pd-sm-x-20">
                  <div class="avatar"><span class="avatar-initial rounded-circle bg-gray-600">s</span></div>
                  <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Socrates Itumay</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Customer ID#00222</small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                      <a href="#" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                    </nav>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-x-20">
                  <div class="avatar"><img src="../../assets/img/img23.jpg" class="rounded-circle" alt=""></div>
                  <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Reynante Labares</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Customer ID#00221</small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                      <a href="#" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                    </nav>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-x-20">
                  <div class="avatar"><img src="../../assets/img/img16.jpg" class="rounded-circle" alt=""></div>
                  <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Marianne Audrey</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Customer ID#00220</small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                      <a href="#" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                    </nav>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-x-20">
                  <div class="avatar"><span class="avatar-initial rounded-circle bg-indigo op-5">o</span></div>
                  <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Owen Bongcaras</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Customer ID#00219</small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                      <a href="#" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                    </nav>
                  </div>
                </li>
                <li class="list-group-item d-flex pd-x-20">
                  <div class="avatar"><span class="avatar-initial rounded-circle bg-primary op-5">k</span></div>
                  <div class="pd-l-10">
                    <p class="tx-medium mg-b-0">Kirby Avendula</p>
                    <small class="tx-12 tx-color-03 mg-b-0">Customer ID#00218</small>
                  </div>
                  <div class="mg-l-auto d-flex align-self-center">
                    <nav class="nav nav-icon-only">
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="mail"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="slash"></i></a>
                      <a href="#" class="nav-link d-none d-sm-block"><i data-feather="user"></i></a>
                      <a href="#" class="nav-link d-sm-none"><i data-feather="more-vertical"></i></a>
                    </nav>
                  </div>
                </li>
              </ul>
              <div class="card-footer text-center tx-13">
                <a href="#" class="link-03">View More Customers <i class="icon ion-md-arrow-down mg-l-5"></i></a>
              </div>
            </div>
          </div>!-->

          <!--<div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-lg-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Real-Time Sales</h6>
                <ul class="list-inline d-flex mg-b-0">
                  <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Today</span>
                  </li>
                  <li class="list-inline-item d-flex align-items-center mg-l-10">
                    <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Yesterday</span>
                  </li>
                </ul>
              </div>
              <div class="card-body pd-b-0">
                <div class="row mg-b-20">
                  <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">$150,200 <small class="tx-11 tx-success letter-spacing--2"><i class="icon ion-md-arrow-up"></i> 0.20%</small></h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Total Sales</p>
                  </div>
                  <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">$21,880 <small class="tx-11 tx-danger letter-spacing--2"><i class="icon ion-md-arrow-down"></i> 1.04%</small></h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Avg. Sales Per Day</p>
                  </div>
                </div>
                <div class="chart-five">
                  <div><canvas id="chartBar1"></canvas></div>
                </div>
              </div>
            </div>
          </div>!-->

        </div><!-- row -->
      </div><!-- container -->



      <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Trade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <?php echo $this->Form->create('Trade',array('url'=>'/trades/dashboard','type'=>'file')); ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Start Date</label>
                <?php echo $this->Form->input('start',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Start Date')); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">End Date</label>
                <?php echo $this->Form->input('end',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'End Date')); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Symbol</label>
              <?php echo $this->Form->input('symbol',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Symbol')); ?>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Type</label>
                <?php 
                  $type = array('buy'=>'buy','sell'=>'sell');
                echo $this->Form->input('type', array('label'=>'','class'=>'form-control','div'=>false,'options' => array(''=>'Select Type',$type))); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Volume</label>
                <?php echo $this->Form->input('volume',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Volume')); ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Stop Loss</label>
                <?php echo $this->Form->input('sl',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Stop Loss')); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Stop Loss Pips</label>
                <?php echo $this->Form->input('pip_l',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Stop Loss Pips')); ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Starting Price</label>
                <?php echo $this->Form->input('start_price',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Starting Price')); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Closing Price</label>
                <?php echo $this->Form->input('end_price',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Closing Price')); ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">P&L</label>
                <?php echo $this->Form->input('pnl',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'P&L')); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">% Risk</label>
                <?php echo $this->Form->input('perc_risk',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'% Risk')); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputAddress">Trade Image url</label>
              <?php echo $this->Form->input('url',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Trade Image url')); ?>
            </div>

            <div class="form-group">
              <label for="inputAddress">Bulk upload</label>
              <?php echo $this->Form->input('file',array('type'=>'file','label'=>false,'class'=>'form-control','div'=>false));?>
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <?php echo $this->Form->input('trade_closed',array('type'=>'checkbox','label'=>false,'class'=>'custom-control-input','div'=>false,'id'=>'customCheck1')); ?>
                <label class="custom-control-label" for="customCheck1">Trade closed</label>
              </div>
            </div>
            <!-- <button type="submit" class="btn btn-primary">Submit Form</button> -->
          <!-- </form> -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
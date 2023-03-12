
<div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sales Monitoring</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
          </div>
          <div class="d-none d-md-block">
            <!-- <button class="btn btn-sm pd-x-15 btn-white btn-uppercase"><i data-feather="mail" class="wd-10 mg-r-5"></i> Email</button>
            <button class="btn btn-sm pd-x-15 btn-white btn-uppercase mg-l-5"><i data-feather="printer" class="wd-10 mg-r-5"></i> Print</button>
            <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5"><i data-feather="file" class="wd-10 mg-r-5"></i> Save Trade</button> -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Save Balance</button>
          </div>
        </div>

          <div class="">
            <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">Monthly Balances</h6>
                  <p class="tx-13 tx-color-03 mg-b-0">Your Monthly Balances</p>
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
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0"><?php //echo $weekly_prof; ?></h4>
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
                      <th>Month</th>
                      <th>Opening Balance</th>
                      <th>Closing Balance</th>
                      <th>No. Trades</th>
                      <th class="text-right">Percentage change</th>
                      <th class="text-right">Date</th>
                      <th class="text-right"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $data){ ?>
                    <tr>
                      <td class="tx-color-03 tx-normal"><?php echo $data['Monthly']['month']; ?></td>
                      <td class="tx-color-03 tx-normal"><?php echo $data['Monthly']['opening_bal']; ?></td>
                      <td class="tx-color-03 tx-normal"><?php echo $data['Monthly']['closing_bal']; ?></td>
                      <td class="tx-color-03 tx-normal"><?php echo $data['Monthly']['no_trades']; ?></td>
                      <td class="text-right"><?php echo $data['Monthly']['perc_change']; ?>%</td>
                      <td class="text-right"><?php echo $data['Monthly']['date']; ?></td>
                      <td class="text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?php echo $data['Monthly']['id']; ?>">Edit Balance</button>
                      </td>
                    </tr>




      <!-- Modal -->
<div class="modal fade" id="exampleModalLong<?php echo $data['Monthly']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Balance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <?php echo $this->Form->create('Monthly',array('url'=>'/trades/monthlyBalances','type'=>'file'));
            echo $this->Form->input('id',array('type'=>'hidden','label'=>false,'value'=>$data['Monthly']['id']));
           ?>
           
            <div class="form-group">
              <label for="inputAddress">Month</label>
              <?php echo $this->Form->input('month',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Monthly']['month'])); ?>
            </div>

            <div class="form-group">
              <label for="inputAddress">Balance</label>
              <?php echo $this->Form->input('closing_bal',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Monthly']['closing_bal'])); ?>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


                    <?php } ?>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card -->
          </div><!-- col -->

        </div><!-- row -->
      </div><!-- container -->



      <!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Balance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <?php echo $this->Form->create('Monthly',array('url'=>'/trades/monthlyBalances','type'=>'file')); ?>
      
            <div class="form-group">
              <label for="inputAddress">Month</label>
              <?php echo $this->Form->input('month',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'Month')); ?>
            </div>

            <div class="form-group">
              <label for="inputAddress">Balance</label>
              <?php echo $this->Form->input('closing_bal',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'placeholder'=>'closing_bal')); ?>
            </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
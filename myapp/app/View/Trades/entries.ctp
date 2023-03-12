
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">Save Trade</button>
          </div>
        </div>

          <div class="">
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
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th class="text-right">Type</th>
                      <th class="text-right">Volume</th>
                      <th class="text-right">P&L</th>
                      <th class="text-right"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $data){ ?>
                    <tr>
                      <td class="tx-color-03 tx-normal"><?php echo date('d M,Y',strtotime($data['Trade']['start'])).' '.date('H:i',strtotime($data['Trade']['start'])); ?></td>
                      <td class="tx-color-03 tx-normal"><?php echo date('d M,Y',strtotime($data['Trade']['end'])).' '.date('H:i',strtotime($data['Trade']['end'])); ?></td>
                      <td class="text-right"><?php echo $data['Trade']['type']; ?></td>
                      <td class="text-right"><?php echo $data['Trade']['volume']; ?></td>
                      <td class="text-right <?php if($data['Trade']['pnl'] > 0){echo 'tx-success';}else{echo 'tx-danger';} ?>"><?php echo $data['Trade']['pnl']; ?> </td>
                      <td class="text-right">
                        <?php if($data['Trade']['status'] != 1){ ?>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong<?php echo $data['Trade']['id']; ?>">Edit Trade</button>
                      <?php } ?>
                      </td>
                    </tr>




      <!-- Modal -->
<div class="modal fade" id="exampleModalLong<?php echo $data['Trade']['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Edit Trade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <?php echo $this->Form->create('Trade',array('url'=>'/trades/dashboard','type'=>'file'));
            echo $this->Form->input('id',array('type'=>'hidden','label'=>false,'value'=>$data['Trade']['id']));
           ?>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Start Date</label>
                <?php echo $this->Form->input('start',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['start'])); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">End Date</label>
                <?php echo $this->Form->input('end',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['end'])); ?>
              </div>
            </div>
            <div class="form-group">
              <label for="inputAddress">Symbol</label>
              <?php echo $this->Form->input('symbol',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['symbol'])); ?>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Type</label>
                <?php 
                  $type = array('buy'=>'buy','sell'=>'sell');
                echo $this->Form->input('type', array('label'=>'','class'=>'form-control','div'=>false,'options' => array($data['Trade']['type']=>$data['Trade']['type'],$type))); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Volume</label>
                <?php echo $this->Form->input('volume',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['volume'])); ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Stop Loss</label>
                <?php echo $this->Form->input('sl',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['sl'])); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Stop Loss Pips</label>
                <?php echo $this->Form->input('pip_l',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['pip_l'])); ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">Starting Price</label>
                <?php echo $this->Form->input('start_price',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['start_price'])); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">Closing Price</label>
                <?php echo $this->Form->input('end_price',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['end_price'])); ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputEmail4">P&L</label>
                <?php echo $this->Form->input('pnl',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['pnl'])); ?>
              </div>
              <div class="form-group col-md-6">
                <label for="inputPassword4">% Risk</label>
                <?php echo $this->Form->input('perc_risk',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['perc_risk'])); ?>
              </div>
            </div>

            <div class="form-group">
              <label for="inputAddress">Trade Image url</label>
              <?php echo $this->Form->input('url',array('type'=>'text','label'=>false,'class'=>'form-control','div'=>false,'value'=>$data['Trade']['url'])); ?>
            </div>


            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <?php echo $this->Form->input('trade_closed',array('type'=>'checkbox','label'=>false,'class'=>'custom-control-input','div'=>false,'id'=>'customCheck1'.$data['Trade']['id'])); ?>
                <label class="custom-control-label" for="customCheck1<?php echo $data['Trade']['id']; ?>">Trade closed</label>
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
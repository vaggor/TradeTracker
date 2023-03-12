<div class="container ht-100p tx-center">
  <div style="margin: 20px 0 20px 0;"><center><h3 class="mg-b-25">Select an account</h3></center></div>

        <div class="row justify-content-center">

          <?php foreach($accounts as $account){ ?>
          <div class="col-10 col-sm-6 col-md-4 col-lg-3 d-flex flex-column">
            <h3 class="mg-b-25"><?php echo $account['Account']['name']; ?></h3>
            <p class="tx-color-03 mg-b-25"><?php echo $account['Account']['description']; ?></p>
            <?php echo $this->Html->link('<button class="btn btn-primary btn-block">Choose Account</button>',array('controller'=>'trades','action'=>'selectAccountButPressed',$account['Account']['id']),array('escape'=>false)); ?>
          </div><!-- col -->
        <?php } ?>
         

        </div><!-- row -->
      </div><!-- container -->
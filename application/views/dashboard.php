<link href="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Sexy Dashboard
        <small> of Freedom Guru</small>
      </h1>
    </section>
    
    <section class="content">
      <?php
          if($this->session->userdata('emailid') == 'support@freedomguru.com')
          {
          ?>
          <div class="row">

            <div class="col-md-12">

              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Activate User</h3>
                </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped" id="deactivateUser">
                  <thead><tr>
                    <th style="width: 10px">Sr No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Register Date</th>
                    <th>Staus</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i=1;
                  foreach ($getDeActivateUser as $key => $value) {
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value->firstName?></td>
                    <td><?php echo $value->userEmail?></td>
                    <td><?php echo $value->createdDate?></td>
                    <td><a href="#" class="btn btn-success changestatus" data-id="<?php echo $value->id ?>" data-act="1" data-acttype="mannual">Activate</a></td>
                  </tr>
                  <?php
                  $i++;
                  }

                  ?>
                </tbody></table>
              </div>
            <!-- /.box-body -->
          </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">DeActivate User</h3>
                </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped" id="activateUser">
                  <thead>
                    <tr>
                    <th style="width: 10px">Sr No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Register Date</th>
                    <th>Staus</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php
                  $i=1;
                  foreach ($getActivateUser as $key => $value) {
                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $value->firstName?></td>
                    <td><?php echo $value->userEmail?></td>
                    <td><?php echo $value->createdDate?></td>
                    <td><a href="#" class="btn btn-danger changestatus" data-act="0" data-id="<?php echo $value->id ?>" data-acttype="NULL">Deactivate</a></td>
                  </tr>
                  <?php
                  $i++;
                  }

                  ?>
                </tbody></table>
              </div>
            <!-- /.box-body -->
          </div>
            </div>
          </div>
          
          <?php
          }
          else
          {
          ?>
        <div class="row">
          <?php 
            if($role == ROLE_ADMIN)
            {
            ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Users</span>
                        <span class="info-box-number"><?php echo  !empty($registerListCount)?$registerListCount:0; ?></span>
                    </div><!-- /.info-box-content -->
                </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-music"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Reflections</span>
                        <span class="info-box-number"><?php echo !empty($categoryListCount)?$categoryListCount:0; ?></span>
                    </div><!-- /.info-box-content -->
                </div>
              
            </div><!-- ./col -->
            
            <?php
            }
          ?> 
          </div>
          

          <div class="row">
          
          <!-- Bar chart -->
          <div class="col-md-12">
          <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">iOS User Acquisition (from Appsflyer) [last 30days]</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
          </div>
      
          <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                <ul class="chart-legend clearfix">
                  <li><i class="fa fa-circle-o text-red"></i> Click To Install - <?php echo $clickCount ?></li>
                  <li><i class="fa fa-circle-o text-red"></i> Installs - <?php echo $installstotal ?></li>
                  <li><i class="fa fa-circle-o text-red"></i> Intro Video 1 - <?php echo $v1ClickCount ?></li>
                  <li><i class="fa fa-circle-o text-red"></i> Intro Video 2 - <?php echo $v2ClickCount ?></li>
                  <li><i class="fa fa-circle-o text-red"></i> Open Reg Page - <?php echo $letgototal ?></li>
                  <li><i class="fa fa-circle-o text-red"></i> Registration - <?php echo $regtotal ?></li>
                  <li><i class="fa fa-circle-o text-red"></i> Purchase - <?php echo $purchasestotal ?></li>
                </ul>
              </div>
           </div>
          </div>
        </div>

        <!-- Bar chart -->
          <div class="col-md-12">
          <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Android User Acquisition (from Appsflyer) [last 30days]</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart1" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->
        </div>
      
      <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
        <ul class="chart-legend clearfix">
        <li><i class="fa fa-circle-o text-red"></i> Click To Install - <?php echo $clickCount1 ?></li>
        <li><i class="fa fa-circle-o text-red"></i> Installs - <?php echo $installstotal1 ?></li>
        <li><i class="fa fa-circle-o text-red"></i> Intro Video 1 - <?php echo $v1ClickCount1 ?></li>
        <li><i class="fa fa-circle-o text-red"></i> Intro Video 2 - <?php echo $v2ClickCount1 ?></li>
        <li><i class="fa fa-circle-o text-red"></i> Open Reg Page - <?php echo $letgototal1 ?></li>
        <li><i class="fa fa-circle-o text-red"></i> Registration - <?php echo $regtotal1 ?></li>
        <li><i class="fa fa-circle-o text-red"></i> Purchase - <?php echo $purchasestotal1 ?></li>
     </ul>
      </div>
           </div>
          </div>
        </div>
          </div>
          

          <div class="row">
            <div class="box box-default">
              <div class="box-header with-border">
              <div class="col-lg-2">
                <h3 class="box-title">Select Date Range</h3>
              </div>
              <div class="col-lg-4">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="reservation">
                </div>
              </div>
              <div class="col-lg-2">
                <input type="button" name="search" class="btn btn-primary searchJourney" id="searchJourney" value="Search">
              </div>
            </div>
          </div>
        </div>
          
          <div class="row">
            <div class="col-lg-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Free Vs Suscribed Users</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="chart-responsive">
                        <canvas id="pieChart" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> Free Users</li>
                        <li><i class="fa fa-circle-o text-green"></i> Suscribed Users</li>
                        
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><b>Free Users <span class="pull-right text-red" id="fuser"><?php echo $freeUser; ?></span></b></a></li>
                    <li><a href="#"><b>Suscribed Users <span class="pull-right text-green" id="suser"><?php echo $suscribedUser; ?></span></a></b></li>
                   
                  </ul>
                </div><!-- /.footer -->
              </div><!-- /.box -->
            </div>
            <div class="col-lg-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Map Taken by user</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="chart-responsive">
                        <canvas id="pieChart1" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> Map Not Taken</li>
                        <li><i class="fa fa-circle-o text-green"></i> Map Taken</li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><b>Map Not Taken <span class="pull-right text-red" id="mapNT"><?php echo $mapNT; ?></span></b></a></li>
                    <li><a href="#"><b>Map Taken<span class="pull-right text-green" id="mapT"><?php echo $mapT; ?></span></a></b></li>
                  </ul>
                </div><!-- /.footer -->
              </div><!-- /.box -->
            </div>
            
             <div class="col-lg-4">
         <!-- BAR CHART -->
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">Registered Users</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="chart-responsive">
                        <canvas id="pieChart2" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> App</li>
                        <li><i class="fa fa-circle-o text-orange"></i> Apple</li>
                        <li><i class="fa fa-circle-o text-green"></i> Facebook</li>
                        
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><b>App <span class="pull-right text-red" id="appdata"><?php echo $appdata; ?></span></b></a></li>
                    <li><a href="#"><b>Apple<span class="pull-right text-orange" id="appledata"><?php echo $appledata; ?></span></a></b></li>
                    <li><a href="#"><b>Facebook<span class="pull-right text-green" id="facebookdata"><?php echo $facebookdata; ?></span></a></b></li>
                   
                  </ul>
                </div><!-- /.footer -->
              </div><!-- /.box -->

              
          </div>
            
            
          <!-- <div class="col-lg-8">
            <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Peak Time Graph</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height: 139px; width: 359px;" height="173" width="448"></canvas>
              </div>
            </div>
            
          </div>
            </div> -->
            </div>
            <div class="row">
              <div class="col-lg-4">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">No. of users tried to pay</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <tbody id="totaltriedtopay">
                        <?php
                        $iostriedpay = !empty($iostriedpay)?$iostriedpay:0;
                        $androidtriedpay = !empty($androidtriedpay)?$androidtriedpay:0;

                        $totaltriedtopay = $iostriedpay + $androidtriedpay;
                        ?>
                        
                        <tr>
                          <td>IOS</td>
                          <td><?php echo !empty($iostriedpay)?$iostriedpay:0 ?></td>
                        </tr>
                         <tr>
                          <td>Android </td>
                          <td><?php echo !empty($androidtriedpay)?$androidtriedpay:0 ?></td>
                        </tr>
                        <tr>
                          <td>Total</td>
                          <td><?php echo $totaltriedtopay;  ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div>
            </div>
            <div class="col-md-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Users taking Free Audios</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        
                        <tr>
                          <th>Reflection Name</th>
                          <th>Users</th>
                        </tr>
                      </thead>
                      <tbody id="toreplacefreeAudio">
                        <?php
                        foreach ($freeAudioPlay as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {
                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['count']) ? $valplay['count'] : '-' ?></td>
                        </tr>
                        <?php
                        }
                      }
                      else
                      {
                      ?>
                      <tr><td colspan="2">No count found.</td></tr>
                      <?php
                      }
                      }
                      ?>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
            <div class="col-lg-4">
              <div class="box box-default">
                <div class="box-header with-border">
                  <h3 class="box-title">No. of reflections played</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Reflection/s</th>
                          <th>Users</th>
                        </tr>
                      </thead>
                      <tbody id="toreplacefreeAudioStatus">
                        <tr>
                          <td>0</td>
                          <td><?php echo $freeAudioPlayStatus['countzero'] ?></td>
                        </tr>
                        <tr>
                          <td>1</td>
                          <td><?php echo $freeAudioPlayStatus['countone'] ?></td>
                        </tr>
                         <tr>
                          <td>2</td>
                          <td><?php echo $freeAudioPlayStatus['counttwo'] ?></td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td><?php echo $freeAudioPlayStatus['countthree'] ?></td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td><?php echo $freeAudioPlayStatus['countfour'] ?></td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td><?php echo $freeAudioPlayStatus['countfive'] ?></td>
                        </tr>
                      
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
           
            </div>
            
          </div>
            <div class="row">
            <div class="col-lg-4">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Most played reflections</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        
                        <tr>
                          <th>Reflection Name</th>
                          <th>Play Count</th>
                        </tr>
                      </thead>
                      <tbody id="toreplace">
                        <?php
                        foreach ($mostPlayedAudio as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {
                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['single']['count']) ? $valplay['single']['count'] : '-' ?></td>
                        </tr>
                        <?php
                        }
                      }
                      else
                      {
                      ?>
                      <tr><td colspan="3">No count found.</tr>
                      <?php
                      }
                      }
                      ?>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
            <div class="col-lg-4">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Most played 7 day journey</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Journey Name</th>
                          <th>Play Count</th>
                        </tr>
                      </thead>
                      <tbody id="toreplace7journey">
                      <?php
                        foreach ($mostPlayedAudio7Journey as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {

                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['7day']['count']) ? $valplay['7day']['count'] : '-' ?></td>
                         
                        </tr>
                        <?php
                        }
                        }
                        else
                        {
                        ?>
                        <tr><td colspan="3">No journey count found.</td></tr>
                        <?php
                        }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
             <div class="col-lg-4">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Most played 21 day journey</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Journey Name</th>
                          <th>Play Count</th>
                        </tr>
                      </thead>
                      <tbody id="toreplace21journey">
                      <?php
                        foreach ($mostPlayedAudio21Journey as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {

                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['21day']['count']) ? $valplay['21day']['count'] : '-' ?></td>
                        </tr>
                        <?php
                        }
                        }
                        else
                        {
                        ?>
                        <tr><td colspan="2">No journey count found.</td></tr>
                        <?php
                        }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
          </div>
          <div class="row">
            <div class="col-lg-4">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Most drop off reflections</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        
                        <tr>
                          <th>Reflection Name</th>
                          <th>Drop Count</th>
                        </tr>
                      </thead>
                      <tbody id="toreplacedrop">
                        <?php
                        foreach ($reflectionDropoff as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {
                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['single']['count']) ? $valplay['single']['count'] : '-' ?></td>
                        </tr>
                        <?php
                        }
                      }
                      else
                      {
                      ?>
                      <tr><td colspan="2">No count found.</tr>
                      <?php
                      }
                      }
                      ?>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
            <div class="col-lg-4">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Most drop off  7 day journey</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Journey Name</th>
                          <th>Drop Count</th>
                        </tr>
                      </thead>
                      <tbody id="toreplacedrop7">
                      <?php
                        foreach ($reflection7Dropoff as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {

                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['7day']['count']) ? $valplay['7day']['count'] : '-' ?></td>
                         
                        </tr>
                        <?php
                        }
                        }
                        else
                        {
                        ?>
                        <tr><td colspan="3">No journey count found.</td></tr>
                        <?php
                        }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
             <div class="col-lg-4">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Most drop off 21 day journey</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Journey Name</th>
                          <th>Drop Count</th>
                        </tr>
                      </thead>
                      <tbody id="toreplacedrop21">
                      <?php
                        foreach ($reflection21Dropoff as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay) 
                          {

                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['21day']['count']) ? $valplay['21day']['count'] : '-' ?></td>

                        </tr>
                        <?php
                        }
                        }
                        else
                        {
                        ?>
                        <tr><td colspan="2">No journey count found.</td></tr>
                        <?php
                        }
                        }
                        ?>
                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
          </div>
           <div class="row">
            <div class="col-lg-4">
              <div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Most liked reflection</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table no-margin">
                      <thead>
                        <tr>
                          <th>Reflection Name</th>
                          <th>Rating</th>
                          <th>Users</th>

                        </tr>
                      </thead>
                      <tbody id="mostliked">
                        <?php
                        foreach ($mostLikedReflections as $keyplay) 
                        {
                          if(!empty($keyplay))
                          {
                          foreach ($keyplay as $vkplay => $valplay)
                          {

                        ?>
                        
                        <tr>
                          <td><?php echo ucfirst($valplay['catFirstTitle']." ".$valplay['catSecondTitle']) ?></td>
                          <td><?php echo !empty($valplay['rate']) ? $valplay['rate'] : '-' ?></td>
                          <td><?php echo !empty($valplay['count']) ? $valplay['count'] : '-' ?></td>
                        </tr>
                        <?php
                        }
                        }
                        else
                        {
                        ?>
                        <tr><td colspan="2">No count found.</td></tr>
                        <?php
                        }
                        }
                        ?>
                      
                      </tbody>
                    </table>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="col-lg-4 col-md-6">
          
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">The order of priority.[1-5] </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped" id="priorityLow">
                  <tbody><tr>
                    <!-- <th style="width: 10px">Sr No.</th>
                    <th>Heading</th>
                    <th>Rating</th>
                    <th style="width: 40px">Rating Progress</th> -->
                  </tr>
                  <?php
                  $i=1;
                 
                  asort($getPrioritiesLow['freedomArr']);
                  
                  
                  foreach ($getPrioritiesLow['freedomArr'] as $key => $value) {
                    $j = $i-1;
                    $keyval = ucwords(str_replace('_', ' & ', $main_arr[$key]));

                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $keyval; ?></td>
                    <td style="width: 100px">
                      <div class="progress progress-xs">
                        <div class="progress-bar <?php echo $prog_bar[$j] ?>" style="width: <?php echo $value*10; ?>%"></div>
                      </div>
                    </td>
                    <td><span class="badge <?php echo $bg_bar[$j]?>"><?php echo $value; ?></span></td>
                  </tr>
                  <?php
                  $i++;
                  }

                  ?>
                </tbody></table>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
            <div class="col-lg-4 col-md-6">
          
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">The order of priority.[6-10] </h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-striped" id="priorityHigh">
                  <tbody><!-- <tr>
                     <th style="width: 10px">Sr No.</th>
                    <th>Heading</th>
                    <th>Rating</th>
                    <th style="width: 40px">Rating Progress</th>
                  </tr> -->
                  <?php
                  $i=1;

                  arsort($getPrioritiesHigh['freedomArr']);
                  
                  foreach ($getPrioritiesHigh['freedomArr'] as $key => $value) {
                      $j = count($prog_bar)-$i;
                     $keyval = ucwords(str_replace('_', ' & ',  $main_arr[$key]));

                  ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $keyval; ?></td>
                    <td style="width: 100px">
                      <div class="progress progress-xs">
                        <div class="progress-bar <?php echo $prog_bar[$j] ?>" style="width: <?php echo $value*10; ?>%"></div>
                      </div>
                    </td>
                    <td><span class="badge <?php echo $bg_bar[$j]; ?>"><?php echo $value; ?></span></td>
                  </tr>
                  <?php
                  $i++;
                  }

                  ?>
                </tbody></table>
              </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

          </div>
      <?php
      }
      ?>    
    </section>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.categories.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"  ></script>

<script type="text/javascript">
  $(function(){
    $("#activateUser").dataTable();
    $("#deactivateUser").dataTable();
    //get data of free/suscribe users
    
    

    // var career_finance = <?php //echo $career_finance; ?>;
    // var achievements_contribution = <?php //echo $achievements_contribution; ?>;
    // var meaning_purpose = <?php //echo $meaning_purpose; ?>;
    // var friend_family = <?php //echo $friend_family; ?>;
    // var intimate_relationships = <?php //echo $intimate_relationships; ?>;
    // var learning_growth = <?php //echo $learning_growth; ?>;
    // var health_energy = <?php //echo $health_energy; ?>;
    // var time_performance = <?php //echo $time_performance; ?>;





    $("#deactivateUser, #activateUser").on('click', ".changestatus",  function(e){
          e.preventDefault();

      var userid = $(this).data('id');
      var actvalue = $(this).data('act');
      var acttypevalue = $(this).data('acttype');
            var trid = $(this).parents('tr');             

      // alert(userid)
      $.ajax({
      url:'<?=base_url()?>updateUserAD',
      method: 'post',
      data: {userid: userid,actvalue:actvalue,acttypevalue:acttypevalue},
      dataType: 'json',
        success: function(response){
          if(actvalue == 1)
          {
              alert('Plan Activated Successfully');
          }
          else
          {
              alert('Plan DeActivated Successfully')
          }
          trid.remove();
          // $('#activateUser').data.reload();
          // $('#deactivateUser').data.reload();


          // $('#activateUser').DataTable().ajax.reload();
          // $('#deactivateUser').DataTable().ajax.reload();

        }
        
   });
    })
    
    var emailid = "<?php echo $this->session->userdata('emailid') ?>";
    // alert(emailid)
    if(emailid != 'support@freedomguru.com')
    {
      var freeUser = <?php echo $freeUser; ?>;
    var suscribedUser = <?php echo $suscribedUser; ?>;
    var mapT = <?php echo $mapT; ?>;
    var mapNT = <?php echo $mapNT; ?>;
    // var freeUser = 0;
    // var suscribedUser = 0;
    $('#reservation').daterangepicker();
    $('#searchJourney').click(function(){
    var daterange = $("#reservation").val();
    $.ajax({
      'async': false,
       'global': false,
     url:'<?=base_url()?>getPageData',
     method: 'post',
     data: {daterange: daterange},
     dataType: 'json',
     success: function(response){
      $("#toreplace").html(response.toreplace);
      $("#toreplace7journey").html(response.toreplace7journey);
      $("#toreplace21journey").html(response.toreplace21journey);
      $("#toreplacedrop").html(response.toreplacedrop);
      $("#toreplacedrop7").html(response.toreplacedrop7);
      $("#toreplacedrop21").html(response.toreplacedrop21);
      // $("#toreplacedrop21").html(response.toreplacedrop21);
      $("#toreplacefreeAudio").html(response.toreplacefreeAudio);
      $("#priorityLow").html(response.priorityLow);
      $("#priorityHigh").html(response.priorityHigh);
      $("#mostliked").html(response.mostliked);
      $("#totaltriedtopay").html(response.totaltriedtopay);
      $("#toreplacefreeAudioStatus").html(response.toreplacefreeAudioStatus);
      $("#mapCount").html(response.mapCount);

      

      mapT = response.mapT;
      mapNT = response.mapNT;
      freeUser = response.freeUser;
      suscribUser = response.suscribUser;
      appdata = response.app;
      appledata = response.apple;
      facebookdata = response.facebook;
      iosdata = response.ios;
      androiddata = response.android;
      
     }
   });
    

    $("#appdata").html(appdata);
    $("#appledata").html(appledata);
    $("#facebookdata").html(facebookdata);
  
    var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
    var pieChart2       = new Chart(pieChartCanvas2)
    var PieData2       = [
      {
        value    : parseInt(appdata),
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'App'
      },
      {
        value    : parseInt(appledata),
        color    : '#FF8C00',
        highlight: '#FF8C00',
        label    : 'Apple'
      },
      {
        value    : parseInt(facebookdata),
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Facebook'
      }
      
    ]
    var pieOptions2     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart2.Doughnut(PieData2, pieOptions2);
    
  

    $("#fuser").html(freeUser);
    $("#suser").html(suscribUser);
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : parseInt(freeUser),
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Free Users'
      },
      {
        value    : parseInt(suscribUser),
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Suscribe Users'
      }
      
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);


    $("#mapT").html(mapT);
    $("#mapNT").html(mapNT);
    var pieChartCanvas1 = $('#pieChart1').get(0).getContext('2d')
    var pieChart1       = new Chart(pieChartCanvas1)
    var PieData1        = [
      {
        value    : mapNT,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Maps Not Taken'
      },
      {
        value    : mapT,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Maps Taken'
      }
      
    ]
    var pieOptions1     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart1.Doughnut(PieData1, pieOptions1);
     
  });
    // console.log(suscribedUser)
  //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : freeUser,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Free Users'
      },
      {
        value    : suscribedUser,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Suscribe Users'
      }
      
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
    

    var pieChartCanvas1 = $('#pieChart1').get(0).getContext('2d')
    var pieChart1       = new Chart(pieChartCanvas1)
    var PieData1        = [
      {
        value    : mapNT,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Maps Not Taken'
      },
      {
        value    : mapT,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Maps Taken'
      }
      
    ]
    var pieOptions1     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart1.Doughnut(PieData1, pieOptions1);
  
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

   
    var appdata = "<?php echo $appdata; ?>";
    var appledata = "<?php echo $appledata; ?>";
    var facebookdata = "<?php echo $facebookdata; ?>";

     var pieChartCanvas2 = $('#pieChart2').get(0).getContext('2d')
    var pieChart2       = new Chart(pieChartCanvas2)
    var PieData2       = [
      {
        value    : parseInt(appdata),
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'App'
      },
      {
        value    : parseInt(appledata),
        color    : '#FF8C00',
        highlight: '#FF8C00',
        label    : 'Apple'
      },
      {
        value    : parseInt(facebookdata),
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Facebook'
      }
      
    ]
    var pieOptions2     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart2.Doughnut(PieData2, pieOptions2);


    var clickCount = <?php echo $clickCount; ?>;
    var installstotal = <?php echo $installstotal; ?>;
    var v1ClickCount = <?php echo $v1ClickCount; ?>;
    var v2ClickCount = <?php echo $v2ClickCount; ?>;
    var letgototal = <?php echo $letgototal; ?>;
    var purchasestotal = <?php echo $purchasestotal; ?>;
    var regtotal = <?php echo $regtotal; ?>;
    var bar_data = {
      data : [['Click to Install', clickCount], ['Installs', installstotal], ['Intro Video 1', v1ClickCount], ['Intro Video 2', v2ClickCount], ['Open Reg Page', letgototal], ['Registeration ', regtotal], ['Purchase ', purchasestotal]],
      color: '#3c8dbc'
    }
    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })

    var clickCount1 = <?php echo $clickCount1; ?>;
    var installstotal1 = <?php echo $installstotal1; ?>;
    var v1ClickCount1 = <?php echo $v1ClickCount1; ?>;
    var v2ClickCount1 = <?php echo $v2ClickCount1; ?>;
    var letgototal1 = <?php echo $letgototal1; ?>;
    var purchasestotal1 = <?php echo $purchasestotal1; ?>;
    var regtotal1 = <?php echo $regtotal1; ?>;
    var bar_data1 = {
      data : [['Click to Install', clickCount1], ['Installs', installstotal1], ['Intro Video 1', v1ClickCount1], ['Intro Video 2', v2ClickCount1], ['Open Reg Page', letgototal1], ['Registeration ', regtotal1], ['Purchase ', purchasestotal1]],
      color: '#3c8dbc'
    }
    $.plot('#bar-chart1', [bar_data1], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    
//     var arrval = [appdata,appledata,facebookdata];

//     var areaChartData = {
//       labels  : ['App','Apple','Facebook'],
//       datasets: [
//         {
//           label               : 'Electronics',
//           fillColor           : 'rgba(210, 214, 222, 1)',
//           strokeColor         : 'rgba(210, 214, 222, 1)',
//           pointColor          : 'rgba(210, 214, 222, 1)',
//           pointStrokeColor    : '#c1c7d1',
//           pointHighlightFill  : '#fff',
//           pointHighlightStroke: 'rgba(220,220,220,1)',
//           data                : arrval
//         }
//       ]
// }
//     //-------------
//     //- BAR CHART -
//     //-------------
//     var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
//     var barChart                         = new Chart(barChartCanvas)
//     var barChartData                     = areaChartData
//     barChartData.datasets.fillColor   = '#00a65a'
//     barChartData.datasets.strokeColor = '#00a65a'
//     barChartData.datasets.pointColor  = '#00a65a'
//     var barChartOptions                  = {
//       //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
//       scaleBeginAtZero        : true,
//       //Boolean - Whether grid lines are shown across the chart
//       scaleShowGridLines      : true,
//       //String - Colour of the grid lines
//       scaleGridLineColor      : 'rgba(0,0,0,.05)',
//       //Number - Width of the grid lines
//       scaleGridLineWidth      : 1,
//       //Boolean - Whether to show horizontal lines (except X axis)
//       scaleShowHorizontalLines: true,
//       //Boolean - Whether to show vertical lines (except Y axis)
//       scaleShowVerticalLines  : true,
//       //Boolean - If there is a stroke on each bar
//       barShowStroke           : true,
//       //Number - Pixel width of the bar stroke
//       barStrokeWidth          : 2,
//       //Number - Spacing between each of the X value sets
//       barValueSpacing         : 5,
//       //Number - Spacing between data sets within X values
//       barDatasetSpacing       : 1,
//       //String - A legend template
//       legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
//       //Boolean - whether to make the chart responsive
//       responsive              : true,
//       maintainAspectRatio     : true
//     }

//     barChartOptions.datasetFill = false
//     barChart.Bar(barChartData, barChartOptions)
}
  })
function labelFormatter(label, series) {
    return '<div style="font-size:13px; text-align:center; padding:2px; color: #fff; font-weight: 600;">'
      + label
      + '<br>'
      + Math.round(series.percent) + '%</div>'
  }
</script>
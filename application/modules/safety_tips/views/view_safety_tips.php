<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  $current_url = current_url();
  $explode_url = explode('/', $current_url);
  $cntArr = count($explode_url);
  $getLastfield = $explode_url[$cntArr-1];

  if($cntArr == 4){
    $assetsVal = 'assets';
  } else {
    $assetsVal = '../assets';
  }

  if(isset($_COOKIE['ftype']) && !empty($_COOKIE['ftype'])){
      $exploadStr = explode(',', $_COOKIE['ftype']);
  }

  // echo "<pre>";
  // print_r($exploadStr);
  // exit();
?>

<main class="position-relative">
  <div class="main-content mt-4 mb-4">
    <div class="container">

      <div class="text mx-auto">

        <div class="leftTabs">
          <div class=""> <!--position-sticky -->
            <div class="col-md-12 col-sm-6 col-xs-12">
              <div class="row"> 

                <div class="col-md-3 pl-0">

                  <div class="navList">
                    <ul class="nav flex-column">
                      <li class="nav-item">
                        <a class="nav-link" href="shareIncident">Share Incident</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="shareSafetyTips">Share Safety Tip</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="viewIncidents">View Incidents Shared</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link active" href="viewSafetyTips">View Safety Tips</a>
                      </li>
                    </ul>
                  </div>                  

                </div>

                <div class="col-md-6">

                  <div class="resultList">

                    <!-- Filter Tags Start -->
                    <div class="appliedFilter">
                      <div class="row">
                        <div class="col-md-12">

                          <span>Filters :</span>
                          <span class="filterTags">

                            <!-- <button type="button" class="closeBtn" aria-label="Catcalling">
                              Thane <span aria-hidden="true">&times;</span>
                            </button> -->

                            <?php
                              if(isset($exploadStr) && !empty($exploadStr)){
                                foreach ($exploadStr as $key => $value) {
                            ?>
                                  <button type="button" class="closeBtn closeFBtn closeBtnVal closeBtnVal_<?php echo $key; ?> closeBtnValues" data-val="<?php echo $value; ?>" data-id="<?php echo $key; ?>" aria-label="<?php echo $value; ?>">
                                    <?php echo $value; ?> 
                                    <span class="closeBtnVal" aria-hidden="true">&times;</span>
                                  </button>
                            <?php
                                }
                              }
                            ?>

                          </span>

                        </div>
                      </div>
                    </div>
                    <!-- Filter Tags End -->

                    <?php
                      if(isset($linkData) && !empty($linkData)){
                        foreach ($linkData as $key => $value) {
                          $countLen = strlen($value['safety_tip_desc']);
                          $strcrop = substr($value['safety_tip_desc'], 0, 152);
                    ?>
                    
                          <!-- Card1 Start -->
                          <div class="card-header">
                            <!-- Short Desc Start -->
                            <div class="text shortDesc" data-id="<?php echo $value['id']; ?>">
                              <h5><?php echo $value['safety_tip_title']; ?></h5>
                              <div class="text1">
                                <span>
                                  <?php
                                      if($countLen <= 155){
                                        echo $value['safety_tip_desc'].'...';
                                      } else {
                                        echo $strcrop."...";
                                      }
                                  ?>
                                </span>
                                <span>
                                  <button class="themeColor toggleThis mb-3 ml-1" data-id="<?php echo $value['id']; ?>">Read More</button>

                                  <div class="row">
                                    <div class="col-md-6">
                                      <span class="mr-5 incidentDate">
                                        Posted <?php echo $value['added_date']; ?>
                                      </span>
                                    </div>
                                    <div class="col-md-6">
                                      <span class="location">
                                        <img src="<?php echo $assetsVal; ?>/images/location.svg" class="img-fluid"> 
                                          <?php echo ucfirst($value['location']).', '.ucfirst($value['city']); ?>
                                      </span>
                                     </div>
                                   </div>

                                 </div>
                               </div>
                               <!-- Short Desc End -->

                               <!-- Long Desc Start -->
                               <div class="card-body longDesc" data-id="<?php echo $value['id']; ?>">
                                <button class="toggleUp w-100" data-id="<?php echo $value['id']; ?>">
                                  <h5 class="float-left"><?php echo $value['safety_tip_desc']; ?></h5>
                                  <i class="fas fa-chevron-down float-right"></i>
                                </button>

                                <div class="otherDetails">

                                  <div class="row mb-2">
                                    <div class="col-md-12 mb-3 mt-1">
                                      <div class="location">
                                       <img src="<?php echo $assetsVal; ?>/images/location.svg" class="img-fluid"> 
                                          <?php echo ucfirst($value['location']).', '.ucfirst($value['city']); ?>
                                     </div>
                                   </div>

                                   <div class="col-md-12 mb-3">
                                    <div class="iDate">
                                      <img src="<?php echo $assetsVal; ?>/images/calendar-date-of-incident.svg" class="img-fluid"> Posted <?php echo $value['added_date']; ?> </div>
                                    </div>

                                    <div class="col-md-12 mb-0">
                                     <div class="text">
                                       <p><?php echo $value['safety_tip_desc']; ?></p>
                                     </div>
                                   </div>
                                 </div>                

                               </div>

                             </div>
                             <!-- Long Desc End -->
                          </div>
                          <!-- Card1 End -->

                    <?php
                        }
                      } else {
                    ?>
                          <p>No safety tips found</p>
                    <?php
                      }
                    ?>

                    <?php echo $this->pagination->create_links(); ?>

                   </div>

                 </div>

                 <div class="col-md-3 pr-0">

                  <div class="filterBox">
                    <div class="innerDiv">
                      <div class="boxTitle customPadding">
                        <label class="themeColor mb-0">Filter by</label>
                      </div>
                    </div>

                    <div class="boxTitle customPadding">
                      <i class="fas fa-chevron-down float-right"></i>
                      <div class="title mb-3">Location</div>
                      <div class="searchLocation mb-2">
                       <form>
                        <!-- <input class="form-control" type="search" placeholder="Enter Location" aria-label="Search"> -->
                        <input class="form-control loc_search" type="text" placeholder="Enter Location" aria-label="Search" value="">
                      </form>
                    </div>
                  </div>

                  <div class="applyFilter">
                    <button class="btn w-100 btn_purple2 mb-0 filterBtn">APPLY FILTER</button>
                  </div>

                </div>   
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</div>    
</div>
</main>

<?php

/**

* Template Name: Register

*

* @package WordPress

* @subpackage tci-thedataduck

* @since TCI - The Data Duck 1.0

*/

$registration_success = false;
$registration_errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $result = sendRegistrationRequest($data);
    if($result['success']) {
        $registration_success = true;
        $data = [];
    } else {
        $registration_errors  = $result['error'];
    }
}

/*print_r($_SESSION['external_user_data']);
exit;*/

get_header();

?>



<div class="mainContent registerPage">

    <div class="container-fluid">

        <?php if($registration_success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> You have been Registered successfully
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php endif; ?>

        <?php if(count($registration_errors)>0): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Following error occured!</strong>
              <ul>
              <?php foreach ($registration_errors as $error_msg) {
                  echo "<li>$error_msg</li>";
              }?>
              </ul>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <?php endif; ?>

        <div class="row">

            <div class="col-lg-10 offset-lg-2 col-12">

                <h1 class="themeTitle mb-4">Start your Registration journey</h1>


                <p class="text-muted md-font">Enter your details into the fields below to begin <span class="d-inline d-md-block">creating your profile.</span></p>

            </div>

        </div>

    </div>



    <div class="container-fluid">

        <div class="row d-flex flex">



            <!-- tabs of buyer and supplier -->

            <div class="col-lg-4 offset-lg-2 col-md-8 offset-md-2 col-12 order-2 order-lg-1">

                <div class="tab-section pt-5">

                    <p><strong>Register me as a: <span class="questionmark-icon">?</span></strong></p>



                    <div class="mainTabs mt-1">

                        <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">

                            <li class="nav-item mr-md-3">

                                <a class="nav-link buyer-tab-link active" id="pills-home-tab" data-toggle="pill" href="#pills-buyer" role="tab" aria-controls="pills-buyer" aria-selected="true">Buyer</a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link supplier-tab-link" id="pills-supplier-tab" data-toggle="pill" href="#pills-supplier" role="tab" aria-controls="pills-supplier" aria-selected="false">Supplier</a>

                            </li>

                        </ul>

                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="pills-buyer" role="tabpanel" aria-labelledby="pills-buyer-tab">

                                <div class="registerBuyer">

                                    <form id="buyer_registration_form" method="post">

                                        <input type="hidden" name="type" value="buyer">
                                        <h4 class="themeColor mb-3 mt-4">Your Information</h4>

                                        <div class="form-group">

                                            <label for="buyer-first-name">First Name:</label>

                                            <input type="text" name="buyer_first_name" value="<?=$data['first_name']??''?>" class="form-control" id="buyer-first-name" placeholder="Lucas" required>

                                        </div>

                                        <div class="form-group">

                                            <label for="buyer-last-name">Last Name:</label>

                                            <input type="text" name="buyer_last_name" value="<?=$data['last_name']??''?>" class="form-control" id="buyer-last-name" placeholder="Clay" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-email">Your Email Address:</label>

                                            <input type="email" name="buyer_email" value="<?=$data['buyer_email']??''?>" class="form-control" id="buyer-email" placeholder="lucas@brands42.co.uk" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-contact">Your Contact Number:</label>

                                            <input type="text" class="form-control" id="buyer-contact" placeholder="+44 (0) 7527 125 101" required>

                                        </div>



                                        <h4 class="themeColor mb-3 mt-5">Company Information</h4>

                                         <div class="form-group">

                                            <label for="buyer-company-name">Company Name:</label>

                                            <input type="text" name="buyer_company_title" value="<?=$data['buyer_company_title']??''?>" class="form-control" id="buyer-company-name" placeholder="Brand42" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-company-email">Company Email:</label>

                                            <input type="email" name="buyer_company_email" value="<?=$data['buyer_company_email']??''?>" class="form-control" id="buyer-company-email" placeholder="hello@brands42.co.uk" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-company-phone">Company Phone:</label>

                                            <input type="text" name="buyer_company_phone" value="<?=$data['buyer_company_phone']??''?>" class="form-control" id="buyer-company-phone" placeholder="+44 (0) 7527 125 101" required>

                                        </div>



                                        <h4 class="themeColor mb-3 mt-5">Company Address</h4>

                                         <!-- <div class="form-group">

                                            <label for="buyer-company-name1">Company Name:</label>

                                             <select class="form-control" id="buyer-company-name1">

                                                  <option>United Kingdom</option>

                                                  <option>India</option>

                                                  <option>Australia</option>

                                                </select>

                                        </div> -->



                                        <div class="form-group">

                                            <label for="buyer-address-line1">Address Line 1:</label>

                                            <input type="text" name="buyer_company_address1" value="<?=$data['buyer_company_address1']??''?>" class="form-control" id="buyer-address-line1" placeholder="Brand42, Bermondsey Studios" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-address-line2">Address Line 2:</label>

                                            <input type="text" name="buyer_company_address2" value="<?=$data['buyer_company_address2']??''?>" class="form-control" id="buyer-address-line2" placeholder="3 Morocco Street" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-town-city">Town/City:</label>

                                            <input type="text" name="buyer_company_state" value="<?=$data['buyer_company_state']??''?>" class="form-control" id="buyer-town-city" placeholder="London" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-country">Country:</label>

                                            <input type="text" class="form-control" id="buyer-country" placeholder="Greater London" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="buyer-postcode">Postcode:</label>

                                            <input type="text" name="buyer_company_zip" value="<?=$data['buyer_company_zip']??''?>" class="form-control" id="buyer-postcode" placeholder="SE1 3HB" required>

                                        </div>



                                         <div class="form-group form-check w-100 float-left custom-control custom-checkbox agreeConsent">

                                            <input type="checkbox" class="custom-control-input" name="buyer_agreeConsent" id="buyer-agreeConsent" checked="checked" required>

                                            <label class="custom-control-label" for="buyer-agreeConsent">I agree to the <a href="javascript:void(0);" class="themeColor">Terms & Conditions</a></label>

                                          </div>



                                         <input type="submit" class="btn btn-primary btnGreen float-right" value="Register">

                                    </form>

                                </div>

                            </div>

                            <div class="tab-pane fade" id="pills-supplier" role="tabpanel" aria-labelledby="pills-supplier-tab">

                                <div class="registerBuyer">

                                    <form id="supplier_registration_form" method="post">

                                        <input type="hidden" name="type" value="supplier">
                                        <h4 class="themeColor mb-3 mt-4">Your Information</h4>

                                        <div class="form-group">

                                            <label for="supplier-first-name">First Name:</label>

                                            <input type="text" name="supplier_first_name" value="<?=$data['first_name']??''?>" class="form-control" id="supplier-first-name" placeholder="Lucas" required>

                                        </div>

                                        <div class="form-group">

                                            <label for="supplier-last-name">Last Name:</label>

                                            <input type="text" name="supplier_last_name" value="<?=$data['last_name']??''?>" class="form-control" id="supplier-last-name" placeholder="Clay" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-email">Your Email Address:</label>

                                            <input type="email" name="supplier_email" value="<?=$data['supplier_email']??''?>" class="form-control" id="supplier-email" placeholder="lucas@brands42.co.uk" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-contact">Your Contact Number:</label>

                                            <input type="text" class="form-control" id="supplier-contact" placeholder="+44 (0) 7527 125 101" required>

                                        </div>



                                        <h4 class="themeColor mb-3 mt-5">Company Information</h4>

                                         <div class="form-group">

                                            <label for="supplier-company-name">Company Name:</label>

                                            <input type="text" name="supplier_company_title" value="<?=$data['supplier_company_title']??''?>" class="form-control" id="supplier-company-name" placeholder="Brand42" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-company-email">Company Email:</label>

                                            <input type="email" name="supplier_company_email" value="<?=$data['supplier_company_email']??''?>" class="form-control" id="supplier-company-email" placeholder="hello@brands42.co.uk" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-company-phone">Company Phone:</label>

                                            <input type="text" name="supplier_company_phone" value="<?=$data['supplier_company_phone']??''?>" class="form-control" id="supplier-company-phone" placeholder="+44 (0) 7527 125 101" required>

                                        </div>



                                        <h4 class="themeColor mb-3 mt-5">Company Address</h4>

                                         <!-- <div class="form-group">

                                            <label for="supplier-company-name1">Company Name:</label>

                                             <select class="form-control" id="supplier-company-name1">

                                                  <option>United Kingdom</option>

                                                  <option>India</option>

                                                  <option>Australia</option>

                                                </select>

                                        </div> -->



                                        <div class="form-group">

                                            <label for="supplier-address-line1">Address Line 1:</label>

                                            <input type="text" name="supplier_company_address1" value="<?=$data['supplier_company_address1']??''?>" class="form-control" id="supplier-address-line1" placeholder="Brand42, Bermondsey Studios" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-address-line2">Address Line 2:</label>

                                            <input type="text" name="supplier_company_address2" value="<?=$data['supplier_company_address2']??''?>" class="form-control" id="supplier-address-line2" placeholder="3 Morocco Street" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-town-city">Town/City:</label>

                                            <input type="text" name="supplier_company_state" value="<?=$data['supplier_company_state']??''?>" class="form-control" id="supplier-town-city" placeholder="London" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-country">Country:</label>

                                            <input type="text" class="form-control" id="supplier-country" placeholder="Greater London" required>

                                        </div>



                                        <div class="form-group">

                                            <label for="supplier-postcode">Postcode:</label>

                                            <input type="text" name="supplier_company_zip" value="<?=$data['supplier_company_zip']??''?>" class="form-control" id="supplier-postcode" placeholder="SE1 3HB" required>

                                        </div>



                                         <div class="form-group form-check w-100 float-left custom-control custom-checkbox agreeConsent">

                                            <input type="checkbox" class="custom-control-input" name="supplier_agreeConsent" id="supplier-agreeConsent" checked="checked" required>

                                            <label class="custom-control-label" for="supplier-agreeConsent">I agree to the <a href="javascript:void(0);" class="themeColor">Terms & Conditions</a></label>

                                          </div>



                                         <input type="submit" class="btn btn-primary btnGreen float-right" value="Register">

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>



            <!-- buyer and supplier card section -->

            <div class="col-lg-4 offset-lg-2 col-12 order-1 order-lg-2 px-0">

                <div class="b-s-card-section mt-5 mt-lg-0">

                    <div class="card-section active-tab mr-3 mr-lg-0">

                        <div class="top-img">

                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/10/buyer-benefits.png" class="img-fluid" alt="">

                        </div>

                        <div id="accodion-buyer" class="card-body">

                            <h3 class="card-title themeTitle1">Buyer Benefits</h3>

                            <div class="benefit-list buyer1">

                                <ul>

                                    <li>Get the competitive edge by sourcing unique products</li>

                                    <li>Connect with Caribbean suppliers in our ever-growing database</li>

                                    <li>Be the first to hear of new products and services from the Caribbean</li>

                                    <li>This is your one stop shop for all things Caribbean</li>

                                </ul>

                            </div>

                        </div>

                    </div>



                    <div class="card-section ml-3 ml-lg-0">

                        <div class="top-img">

                            <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/10/supplier-benefits.png" class="img-fluid" alt="">

                        </div>

                        <div id="accodion-supplier" class="card-body">

                            <h3 class="card-title themeTitle1">Supplier Benefits</h3>

                            <div class="benefit-list supplier1">

                                <ul>

                                    <li>Get discovered by international buyers</li>

                                    <li>Showcase your company's products or services</li>

                                    <li>Attract more business and pull in the right leads</li>

                                    <li>With a dedicated company profile your business will be promoted to international buyers</li>

                                    <li>Showcase your products and services to other memebers to discover new supply chain cooperative opportunities</li>

                                    <li>Highlight your projects and experience and give buyers an insight into what you do</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<?php

get_footer();

?>


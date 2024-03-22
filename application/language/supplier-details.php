<?php

/**

* Template Name: Supplier Details

*

* @package WordPress

* @subpackage tci-thedataduck

* @since TCI - The Data Duck 1.0

*/



get_header();

?>

<?php
    $id = $_GET['id']??'';
    // Make API call to get suppliers
    $supplier = apiRequest('api/business-network/c/profile/'.$id.'.json');
    if(isset($supplier['code']) && $supplier['code']=='404') {
        echo "404 Page not found";
        die;
    }

    $title          =  $supplier['title'];
    $logoUrl        = 'https://b2b.ceintelligence.com/'.$supplier['logo_path'];
    $country        = $supplier['country']['common_name'];
    $country_code   = $supplier['country']['ISO_31661_2_letter_code'];
    $product_ranges = explode(',', $supplier['product_range']);
    $products       = $supplier['gtin_products'];
    if(count($products)==0)
        $products   = $supplier['products'];
    $badge          = $supplier['is_buyer']?'BUYER':'SUPPLIER';
    $reviews        = $supplier['company_reviews'];
?>

    <div class="mainContent">

        <div class="container position-relative">

            <div class="row">

                <div class="col-12">

                    <div class="d-md-flex">

                        <div class="winfresh-img mr-md-4">

                            <img src="<?=$logoUrl?>" class="img-fluid" width="160"/>

                        </div>

                        <div class="winfresh-text">

                            <span class="badge <?=$badge=='BUYER'?'badge-primary':''?> mb-2 supplierBadge"><?=$badge?></span>

                            <h1 class="mb-1"><?=$title?></h1>

                            <p><strong>Location:</strong> <?=$country?></p>

                            <p><strong>Website:</strong> <a href="<?=$supplier['web']?>"><?=$supplier['web']?></a></p>

                            <a href="javascript:void(0)" class="btn btn-primary btnGreen btn-enquiry mt-3">Make an equiry</a>

                        </div>

                    </div>

                </div>

            </div>



            <div class="row">

                <div class="popup-enquiry-form">

                    <div class="col-12">

                        <div class="enquiry-form">

                            <div class="modal-header">

                                <h4 class="modal-title">Quick Enquiry</h4>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                    <span aria-hidden="true">×</span>

                                </button>

                            </div>

                            <!--<h4 class="mb-4"><strong>Quick Enquiry</strong></h4>-->

                            <form action="" method="post" class="p-4">

                                <div class="form-group">

                                    <label for="fullName"><small><strong>Full Name:</strong></small></label>

                                    <input type="text" name="name" class="form-control" placeholder="Lucas Clay">

                                </div>

                                <div class="form-group">

                                    <label for="emailAddress"><small><strong>Your Email Address:</strong></small></label>

                                    <input type="email" name="email" class="form-control" placeholder="lucas@brand42.co.uk">

                                </div>

                                <div class="form-group">

                                    <label for="contactNumber"><small><strong>Your Contact Number:</strong></small></label>

                                    <input type="tel" name="contact" class="form-control" placeholder="+44 (0) 7527 125 101">

                                </div>

                              <button type="submit" class="btn btn-primary btnGreen">Make an equiry</button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <div class="container">

            <div class="row mt-5 pt-md-4">

                <div class="col-12">

                    <h5 class="primary-color">Company Overview</h5>

                    <hr />

                    <?php
                        if(!checkIsLoggedIn()) {
                           $loggedOut = 'loggedOut';
                        }
                        else {
                            $loggedOut = '';
                        }
                    ?>
                    <div class="<?php echo $loggedOut; ?>">
                    <p class="mt-4"><small><strong>Address:</strong></small></p>

                    <p class="text-secondary">

                        <?=$supplier['address']?$supplier['address'].'<br/>':''?>
                         <?php

                            if(checkIsLoggedIn()) {
                        ?>

                        <?=$supplier['address2']?$supplier['address2'].'<br/>':''?>

                        <?=$supplier['address3']?$supplier['address3'].'<br/>':''?>

                        <?=$supplier['state']?$supplier['state'].'<br/>':''?>

                        <?=$country?>, <?=$country_code?>

                    </p>
                    </div>


                    <p class="mt-4"><small><strong>About <?=$title?>:</strong></small></p>

                    <p class="text-secondary w-75">

                        <?=$supplier['description']?>

                    </p>

                </div>

            </div>



            <div class="row mt-5">

                <div class="col-12">

                    <h5 class="primary-color">Product Overview</h5>

                    <hr />

                    <p class="mt-4 mb-2"><small><strong>Product Ranges</strong></small></p>

                    <p class="product_ranges">

                        <?php
                            foreach ($product_ranges as $product_range) {
                                echo '<span class="badge badge-primary mb-2">'.$product_range.'</span>';
                            }
                        ?>

                    </p>



                    <div class="product-list mt-3">

                        <p><small><strong>Products:</strong></small></p>

                        <div class="card-deck pb-2">

                            <?php
                                $product_count = 0;
                                foreach ($products as $product):
                                    /*if($product_count==4)
                                        break;*/
                                    if($badge=='SUPPLIER') {
                                        $p_title  = $product['gtin_name'];
                                        $p_image  = 'https://b2b.ceintelligence.com/'.$product['f_path'];
                                        $p_brand  = $product['brand'];
                                        $supplier = $title;
                                    } else {
                                        $p_title = $product['name'];
                                        $p_image = 'https://b2b.ceintelligence.com/'.$product['image_path'];
                                        $p_brand = '';
                                        $supplier = '';
                                    }
                            ?>
                                <div class="col-md-3 mb-3">

                                    <img src="<?=$p_image?>" class="card-img-top" alt="<?=$p_title?>">

                                    <div class="card-body">

                                        <h5 class="card-title"><a href="#" class="link-color"><?=$p_title?></a></h5>

                                        <p class="card-text"><strong>Supplier:</strong> <?=$supplier?></p>

                                        <p class="card-text"><strong>Brand:</strong> <?=$p_brand?></p>

                                    </div>

                                    <div class="card-footer">

                                        <p class="text-muted">

                                            <img src="https://www.thedataduck.in/ceda/wp-content/uploads/2020/10/location-img.png"> Saint Lucia

                                        </p>

                                    </div>

                                </div>

                            <?php
                                $product_count++;
                                endforeach;
                            ?>

                        </div>



                        <div class="text-center"><a href="#" class="btn btn-primary btnGreen mt-3">View Products</a></div>

                    </div>

                </div>

            </div>



            <div class="row mt-5">

                <div class="col-12">

                    <h5 class="primary-color">Reviews</h5>

                    <hr />

                    <div class="review-section">

                        <?php
                            foreach ($reviews as $review):
                        ?>
                        <div class="clientReview">
                            <div class="person-img-info d-flex">

                                <div class="person-img mr-4">

                                    <img src="https://www.thedataduck.in/ceda/wp-content/uploads/2020/10/img-002.jpg" class="img-fluid">

                                </div>

                                <div class="person-info">

                                    <p><?=$review['title']?></p>

                                    <p class="text-muted"><?=$review['name']?></p>

                                    <p class="review-star">

                                        <?php
                                            for ($i=0; $i < 5; $i++) {
                                                if($i+1<=$review['rating']) {
                                                    echo '<img src="https://www.thedataduck.in/ceda/wp-content/uploads/2020/10/favourites-filled-star-green.png" class="img-fluid">';
                                                } else {
                                                    echo '<img src="https://www.thedataduck.in/ceda/wp-content/uploads/2020/10/favourites-filled-star.png" class="img-fluid">';
                                                }
                                            }
                                        ?>

                                    </p>

                                </div>

                            </div>

                            <div class="person-desc mt-3 w-75">

                                <p>

                                    <?=$review['description']?>

                                </p>

                            </div>
                            </div>
                        <?php
                            endforeach;
                        ?>

                        <div class="mt-5">

                            <h5>Why not leave your own review?</h5>

                            <a href="#" class="btn btn-primary btnGreen btn-write-review pl-4 pr-5" data-toggle="modal" data-target="#writeReview">

                                <img src="https://www.thedataduck.in/ceda/wp-content/uploads/2020/10/edit-img.png" class="img-fluid"> Write review

                            </a>

                        </div>

                        <!-- Modal -->

                        <div class="modal fade" id="writeReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                            <div class="modal-dialog" role="document">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h4 class="modal-title" id="exampleModalLabel">Write Review</h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                          <span aria-hidden="true">&times;</span>

                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <form action="" method="post">

                                            <div class="form-group">

                                                <label for="fullName"><small><strong>Full Name:</strong></small></label>

                                                <input type="text" name="name" class="form-control" placeholder="Lucas Clay">

                                            </div>

                                            <div class="form-group">

                                                <label for="subject"><small><strong>Subject:</strong></small></label>

                                                <input type="text" name="subject" class="form-control" placeholder="your subject">

                                            </div>

                                            <div class="form-group">

                                                <label for="starrating">Star Rating</label>

                                                <select class="form-control">

                                                  <option value="1 star">1 Star</option>

                                                  <option value="2 star">2 Star</option>

                                                  <option value="3 star">3 Star</option>

                                                  <option value="4 star">4 Star</option>

                                                  <option value="5 star">5 Star</option>

                                                </select>

                                            </div>

                                            <div class="form-group">

                                                <label for="comment"><small><strong>Comment:</strong></small></label>

                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>

                                            </div>

                                            <button type="submit" class="btn btn-primary btnGreen mb-3">Submit Review</button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
<?php } ?>
                </div>

            </div>

        </div>



        <?php if(!checkIsLoggedIn()) { ?>
            <div class="container">
                <div class="row pt-2">
                    <div class="col-12 pl-0">
                        <div class="jumbotron bg-img1">
                            <div>
                                <h2 class="text-white mb-3">For more details, register for a free account</h2>
                                <div class="benefit-list supplier1">
                                    <ul class="cust-ul-style1 pl-4">

                                        <li>Instant connection to the 100’s of suppliers in our ever-growing database.</li>

                                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</li>

                                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</li>

                                    </ul>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-5">
                                <a href="#" class="btn btn-primary btnGreen mr-4">Register</a>
                                <p class="text-white">Already have an account? <a href="#" class="link-color text-underline">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        </div>

    </div>



<?php

get_footer();

?>
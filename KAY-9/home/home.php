<?php
require '../home/partials/_connection.php';
function get_product($conn,$limit='',$catid='',$productid=''){
            
  $sql = "SELECT * FROM `products` WHERE `status`='1'";
  if($catid!=''){
      $sql.=" and categories_id=$catid ";
  }

  if($productid!=''){
      $sql.=" and id=$productid ";
  }
  
  if($limit!=''){
      $sql.="limit $limit";
  }
  $result=mysqli_query($conn,$sql);
  $product=Array();
  while($row=mysqli_fetch_assoc($result)){
      $product[]=$row;
  }
  return $product;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Rowdies&display=swap" rel="stylesheet">
    <title>E-commerce</title>
  <style>
  *{
    font-family: 'Rowdies', cursive;
  }
  .carousel-indicators li{
    background-color:black;
  }
 
  </style>
  </head>
  <body>
  <?php
  $page = 'home';
        include "../home/partials/_nav.php";
        
  ?>

<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="../images/products/slider1.jpg" class="d-block w-100" alt="..." width="1400px" height="500px">
      <div class="carousel-caption d-none d-md-block">
     <p>New hair-care startups are offering custom shampoo and conditioner formulas based on hair type and styling goals.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../images/products/slider2.jpg" class="d-block w-100" alt="..." width="1400px" height="500px">
      <div class="carousel-caption d-none d-md-block">
       <p style="color:black">Dog Hygiene & Cleaning</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="../images/products/slider3.jpg" class="d-block w-100" alt="..." width="1400px" height="500px">
      <div class="carousel-caption d-none d-md-block">
      <p style="color:pink">Charlotte’s Web (CW) Paws Hemp Oil For Dogs And Other Pets - 30ml</p>
     
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="header header-inverse h-fullscreen pb-80 " style="background-color: #0f1113;">
<div class="container " style="display:flex;">
<div style="margin-top:30px;margin-left:-70px">
<iframe width="650" height="400" src="https://www.youtube.com/embed/5H5t6-VDgk0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<div style="color:white;padding:40px">
<h3>why and which dog shampoos to use for dogs</h3>

<p style="margin: 28px auto;">Introducing KAY-9 Shampoo , Conditioner , Body Wash !</p>
</div>
</div>
</div>
<div class="container my-4">
  
    <h1  class="text-center">CATEGORIES</h1>
    <h3  class="text-center">Conditioner</h3>
    <div class="row">
    <?php
                $get_product=get_product($conn,10,'46','');
                // prx($get_product);
                foreach($get_product as $list){
                  $productid = $list['id'];
    echo '<div class="col-md-4 my-3 ">
        <div class="card" style="width: 22rem; border:none ;">
        <a href="../home/products.php?id='. $productid .'"><img  src="../images/products/'. $list['image'] .'" class="card-img-top" alt="..." style="border-radius:10px;height:400px ;border:1px solid black"></a>
        <div class="card-body">
            <h5 class="card-title text-center">'. $list['name'].'</h5>
            <p class="card-text text-center">'. $list['description'] .'</p>
            
        </div>
        </div>
        </div>';
                }
                ?>
        
    </div>
    <h3  class="text-center">Body Wash</h3>
    <div class="row">
    <?php
                $get_product=get_product($conn,10,'45','');
                // prx($get_product);
                foreach($get_product as $list){
                  $productid = $list['id'];
    echo '<div class="col-md-4 my-3 ">
        <div class="card" style="width: 22rem; border:none ;">
        <a href="../home/products.php?id='. $productid .'"><img  src="../images/products/'. $list['image'] .'" class="card-img-top" alt="..." style="border-radius:10px;height:400px ;border:1px solid black"></a>
        <div class="card-body">
            <h5 class="card-title text-center">'. $list['name'].'</h5>
            <p class="card-text text-center">'. $list['description'] .'</p>
            
        </div>
        </div>
        </div>';
                }
                ?>
        
    </div>
    <h3  class="text-center">Shampoo</h3>
    <div class="row">
    <?php
                $get_product=get_product($conn,10,'44','');
                // prx($get_product);
                foreach($get_product as $list){
                  $productid = $list['id'];
    echo '<div class="col-md-4 my-3 ">
        <div class="card" style="width: 22rem; border:none ;">
        <a href="../home/products.php?id='. $productid .'"><img  src="../images/products/'. $list['image'] .'" class="card-img-top" alt="..." style="border-radius:10px;height:400px ;border:1px solid black"></a>
        <div class="card-body">
            <h5 class="card-title text-center">'. $list['name'].'</h5>
            <p class="card-text text-center">'. $list['description'] .'</p>
            
        </div>
        </div>
        </div>';
                }
                ?>
        
    </div>
</div>
<nav aria-label="breadcrumb" style="padding:10px 10%">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">Home</li>
      </ol>
    </nav>
    <div class="mt-5 mb-5">
	

  <div id="multi-item-partners-smallcardslider" class="carousel slide carousel-multi-item news-multi-carousel" data-interval="5000" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators news-calousel ">
      <li data-target="#multi-item-partners-smallcardslider" data-slide-to="0" class="cardslider" ></li>
              <li data-target="#multi-item-partners-smallcardslider" data-slide-to="1" class="cardslider"></li>
          <li data-target="#multi-item-partners-smallcardslider" data-slide-to="2" class="cardslider active"></li>
          
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
          <!--Slide-->
          <div class="carousel-item item">
        <div class="row row-equal slider-rows">
                                                    <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/skype">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Skype" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b90/0bb/thumb_36_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Skype</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                  
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/whatsapp">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="WhatsApp" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8f/d9d/thumb_35_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">WhatsApp</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                  
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/instagram">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Instagram" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8f/b5e/thumb_34_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Instagram</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                                  
                            </div>
          </div>
          <div class="carousel-item item">
            <div class="row row-equal">
                          
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/vkontakte">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Vkontakte" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8f/8fd/thumb_33_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Vkontakte</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                  
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/telegram">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Telegram" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8f/51d/thumb_32_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Telegram</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                  
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/viber">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Viber" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8f/118/thumb_31_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Viber</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                                  
                            </div>
          </div>
          <div class="carousel-item item active">
            <div class="row row-equal">
                          
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/youtube">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Youtube" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8e/f2b/thumb_30_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Youtube</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                  
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/google">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="Google+" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/b8e/d66/thumb_29_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">Google+</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                  
              
              <!--Slide-->
                                                <div class="col-sm-12 col-lg-4 news-col">
                                              
                    <a class="card-link text-dark" href="/post/linkedin">
                      <div class=" small-card ">
  
                        <div class="card-body wh-backgrnd">
  
                          <div class="row">
                            <div class="col-lg-4 thanks-photo">
  
                              <div class="slider-logo text-center"><img class="img-slider-logo" alt="linkedin" src="http://oct.pkurg.ru/storage/app/uploads/public/5d0/c10/c39/thumb_38_100_100_0_0_crop.png">
  
                              </div>
  
                            </div>
                            <div class=" col-lg-8 small-slider-text my-auto text-center ">
                              <p class="card-text ">linkedin</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
  
                  </div>
                                                  
                                </div>
              </div>
                                      
              
                </div>
        <!--/.Slides-->
        <!--Controls-->
        <a class="left carousel-control carousel-control-prev card-carousel" href="#multi-item-partners-smallcardslider" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left   grey carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control carousel-control-next card-carousel" href="#multi-item-partners-smallcardslider" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right grey  carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
        <!--/.Controls-->
      </div>
    </div>
<!-- <div class="footer" style="padding:20px;background-color:black;">
 <h6 class="text-center" style="color:white">All Right Reserved &copy | 2020 </h6>
</div> -->
<footer class="footer mt-auto py-3" style="background-color:black;">
  <div class="container">
    <span class="text-muted" style="color:white;margin:10px 40%">All Right Reserved &copy | 2020 </span>
  </div>
</footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>
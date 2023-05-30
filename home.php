
<section id="slider"><!--slider-->
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="slider-carousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
              <li data-target="#slider-carousel" data-slide-to="1"></li>
              <li data-target="#slider-carousel" data-slide-to="2"></li>
            </ol>
            
            <div class="carousel-inner">
              <div class="item active">
                <div class="col-sm-6">
                  <h1>Bhayangkari</h1>
                  <h2>Online Shop</h2>
                  <p>Jual-beli pakaian, asesoris, dan produk lainnya secara di mana saja dan kapan saja</p>
                 
                </div>
                <div class="col-sm-6">
                  <img src="images/home/girl1.jpg" class="girl img-responsive" alt="" />
                  <img src="images/home/pricing.png"  class="pricing" alt="" />
                </div>
              </div>
              <div class="item">
                <div class="col-sm-6">
                  <h1>Bhayangkari</h1>
                  <h2>Online Shop</h2>
                  <p>Jual-beli pakaian, asesoris, dan produk lainnya secara di mana saja dan kapan saja</p>
                 
                </div>
                <div class="col-sm-6">
                  <img src="images/home/girl2.jpg" class="girl img-responsive" alt="" />
                  <img src="images/home/pricing.png"  class="pricing" alt="" />
                </div>
              </div>
              
              <div class="item">
                <div class="col-sm-6">
                  <h1>Bhayangkari</h1>
                  <h2>Online Shop</h2>
                  <p>Jual-beli pakaian, asesoris, dan produk lainnya secara di mana saja dan kapan saja</p>
                 
                </div>
                <div class="col-sm-6">
                  <img src="images/home/girl3.jpg" class="girl img-responsive" alt="" />
                  <img src="images/home/pricing.png" class="pricing" alt="" />
                </div>
              </div>
              
            </div>
            
            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
              <i class="fa fa-angle-left"></i>
            </a>
            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
              <i class="fa fa-angle-right"></i>
            </a>
          </div>
          
        </div>
      </div>
    </div>
  </section><!--/slider-->

  <section>
    <div class="container">
      <div class="row">
        <div class="col-sm-3">
            <?php include 'sidebar.php'; ?>
        </div>
        
        <div class="col-sm-9 padding-right">
		
		
		<?php
if (isset($_SESSION['CUSID'])){

	?>
          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Produk Terekomendasi</h2>
            
            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active"> 
<?php
$query = 'SELECT tblproduct.*, tblpromopro.*
FROM tblproduct
LEFT JOIN tblpromopro
ON tblproduct.PROID = tblpromopro.PROID
WHERE tblproduct.PRODESC IN (SELECT atribut1 FROM itemset3 UNION SELECT atribut2 FROM itemset3 UNION SELECT atribut3 FROM itemset3)';
$mydb->setQuery($query);
$res = $mydb->loadResultList();

                    foreach ($res as $result) { 
                  ?>
                      <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" style="height:200px;" />
                          <h2>Rp <?php  echo number_format($result->PRODISPRICE,2, ',', '.'); ?></h2>
                          <p><?php  echo    $result->PRODESC; ?></p>
                           <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </form>
                  <?php } ?>
                </div>
              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>      
            </div>
          </div><!--/recommended_items-->
		  <?php
}
	
?>
		
		
          <div class="features_items"><!--features_items-->
            <h2 class="title text-center">Produk Unggulan</h2>

            <?php
			$count = 12;
			if(!isset($_GET['offset'])){
				$_GET['offset'] = 1;
			}
			$offset = $_GET['offset'];
			$offset_val = ($offset - 1) * $count;
            $query = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
            WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0 limit $offset_val, $count";
			$query_count = "SELECT * FROM `tblpromopro` pr , `tblproduct` p , `tblcategory` c
            WHERE pr.`PROID`=p.`PROID` AND  p.`CATEGID` = c.`CATEGID`  AND PROQTY>0";
            $mydb->setQuery($query);
            $cur = $mydb->loadResultList();
			$mydb->setQuery($query_count);
            $cur_count = $mydb->loadResultList();
			$row_count = count($cur_count);
			$row_count = ceil($row_count / 12);
            foreach ($cur as $result) { 

              ?>
               <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
            <div class="col-sm-4">
              <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                      <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" style="height:200px;"/>
                      <h2>Rp <?php  echo number_format($result->PROPRICE,2, ',', '.'); ?></h2>
                      <p><?php  echo    $result->PRODESC; ?></p>
                      <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                    </div>
                    <div class="product-overlay">
                      <div class="overlay-content">
                        <h2>Rp <?php  echo number_format($result->PROPRICE,2, ',', '.'); ?></h2>
                        <p><?php  echo    $result->PRODESC; ?></p>
                       <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                      </div>
                    </div>
                </div>
                <div class="choose">
                  <ul class="nav nav-pills nav-justified">
                    <li>
                              <?php     
							  
                            if (isset($_SESSION['CUSID'])){  

                              echo ' <a href="'.web_root. 'customer/controller.php?action=addwish&proid='.$result->PROID.'" title="Add to wishlist"><i class="fa fa-plus-square"></i>Add to wishlist</a></a>
                            ';

                             }else{
                               //echo   '<a href="#" title="Add to wishlist" class="proid"  data-target="#smyModal" data-toggle="modal" data-id="'.  $result->PROID.'"><i class="fa fa-plus-square"></i>Add to wishlist</a></a>';
                            }
							  						
                            ?>

                    </li> 
                  </ul>
                </div>
              </div>
            </div>
          </form>
       <?php  } 

	   ?>
            
          </div><!--features_items--> 
         <?php
	   echo '<div style="text-align: center;">';
	   for($i=1;$i<=$row_count;$i++){

			if($offset==$i){
				echo '<a style="pointer-events: none; background: white;color:black;padding:10px;" class="page_number" href="?offset='.$i.'">'.$i.'</a>&nbsp&nbsp';
			}
			else{
				echo '<a style="background: black;color:white;padding:10px;" class="page_number" href="?offset='.$i.'">'.$i.'</a>&nbsp&nbsp';
			}
			
			
			
	   }
	   echo '</div><br><br>';
	   

			?>		 
<?php
if (!isset($_SESSION['CUSID'])){
	?>
          <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Produk Terekomendasi</h2>
            
            <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="item active"> 
<?php
$query = 'SELECT tblproduct.*, tblpromopro.*
FROM tblproduct
LEFT JOIN tblpromopro
ON tblproduct.PROID = tblpromopro.PROID
WHERE tblproduct.PRODESC IN (SELECT atribut1 FROM itemset3 UNION SELECT atribut2 FROM itemset3 UNION SELECT atribut3 FROM itemset3)';
$mydb->setQuery($query);
$res = $mydb->loadResultList();

                    foreach ($res as $result) { 
                  ?>
                      <form   method="POST" action="cart/controller.php?action=add">
            <input type="hidden" name="PROPRICE" value="<?php  echo $result->PROPRICE; ?>">
            <input type="hidden" id="PROQTY" name="PROQTY" value="<?php  echo $result->PROQTY; ?>">

            <input type="hidden" name="PROID" value="<?php  echo $result->PROID; ?>">
                  <div class="col-sm-4">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img src="<?php  echo web_root.'admin/products/'. $result->IMAGES; ?>" alt="" style="height:200px;" />
                          <h2>Rp <?php  echo number_format($result->PRODISPRICE,2, ',', '.'); ?></h2>
                          <p><?php  echo    $result->PRODESC; ?></p>
                           <button type="submit" name="btnorder" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </form>
                  <?php } ?>
                </div>
              </div>
               <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>      
            </div>
          </div><!--/recommended_items-->
		  <?php
}
	
?>
          
        </div>
      </div>
    </div>
  </section>

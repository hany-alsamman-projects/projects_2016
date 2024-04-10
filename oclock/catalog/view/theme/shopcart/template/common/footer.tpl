


<div id="footer-border">

</div>

 <?php 
$displayCustomFooter =  $this->config->get('customFooter_status');


if($displayCustomFooter == 1) {


echo $customFooter; 
}
?>
 <div class="container_12">
  <div id="footer">
    <div class="grid_3">
      <h3><?php echo $text_information; ?></h3>
      <ul>
        <?php foreach ($informations as $information) { ?>
        <li><a href="<?php echo $information['href']; ?>"><?php echo $information['title']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
    <div class="grid_3">
      <h3><?php echo $text_service; ?></h3>
      <ul>
        <li><a href="<?php echo $contact; ?>"><?php echo $text_contact; ?></a></li>
        <li><a href="<?php echo $return; ?>"><?php echo $text_return; ?></a></li>
        <li><a href="<?php echo $sitemap; ?>"><?php echo $text_sitemap; ?></a></li>
      </ul>
    </div>

    <div class="grid_3">
      <h3><?php echo $text_account; ?></h3>
    <ul>
      <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
      <li><a href="<?php echo $order; ?>"><?php echo $text_order; ?></a></li>
      <li><a href="<?php echo $wishlist; ?>"><?php echo $text_wishlist; ?></a></li>
      <li><a href="<?php echo $newsletter; ?>"><?php echo $text_newsletter; ?></a></li>
    </ul>
    </div>
  </div>
  
  <div class="spacer clearfix"></div>

</div>
  <div id="powered">
  <div class="container">
  <div id="payment_images">
  
  <a href="index.php?route=information/contact"><img src="image/flags_bar.jpg"/></a>
  </div>
  
  <div id="powered_text">
        
        <?php echo $powered; ?></div>
        </div>
</div>
</body></html>
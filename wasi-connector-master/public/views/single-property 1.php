<?php include 'search-bar.php';
$c = new Wasi_Connector_Public('wasi-connector', '1.0.0', 'wasico')
?>
<script>var propertyTypes = [];</script>
<div id="wasiAppSingle" class="listing-detail">
  <div class="page-header">
    <h3 class="pull-left">
      <?php echo $single_property->title; ?>
      <sub>
      <?php
      if($single_property->address) {
        echo $single_property->address.', ';
      }
      if($single_property->city_label) {
        echo $single_property->city_label.', ';
      }
      echo $single_property->region_label;
      ?>
      </sub>
    </h3>
    <div class="pull-right pricing">
      <?php $currency_var = $single_property->iso_currency==='EUR' ? '€' : '$' ?>
      <?php if($single_property->for_sale && $single_property->sale_price !== '0') : ?>
        <?php echo '<b>'.__('For Sale', 'wasico').'</b> '.$currency_var.number_format($single_property->sale_price, 0); ?> <span class="currency"><?php echo $single_property->iso_currency ?></span>
      <?php endif; ?>
      <?php if($single_property->for_rent && $single_property->rent_price !== '0') : ?>
        <?php echo '<b>'.__('For Rent', 'wasico').'</b> '.$currency_var.number_format($single_property->rent_price, 0); ?> <span class="currency"><?php echo $single_property->iso_currency ?></span>
      <?php endif; ?>
    </div>
    <div class="clear clearfix"> </div>
  </div>
  <div class="listing-detail-section" id="listing-detail-section-attributes">
    <?php if ($single_property->galleries) {
      $imgs = $single_property->galleries[0];
      $images_html = '';
      foreach ($imgs as $key => $value) {
        if (is_object($value)) {
          if(empty($value->description)) { $value->description = 'img'.$key; }
          // echo "<pre>".print_r($value, true)."</pre>";
          $images_html.= "<img src='{$value->url}' "
            ."data-image='{$value->url_big}' "
            ."alt='{$value->description}' >";
        }
      }
      if(strlen($images_html) > 0) {
        echo '<div id="wasi_gallery" style="visibility:hidden;">'.$images_html.'</div>'; ?>
        <script>
          jQuery(document).ready(function(){
            var g = jQuery("#wasi_gallery");
            g.find('br').remove();
            g.unitegallery({
              gallery_width: "100%",
              gallery_height: 732
            });
            g.css('visibility', 'visible');
          });
        </script>
        <?php
      }
    }
    ?>
    <div class="listing-detail-section-columns">
      <div class="summary">
        <div class="summary-header"><?php _e('Property ID', 'wasico'); ?>: <?php echo $single_property->id_property;
        ?></div>
        <div class="summary-block summary-benefits">
          <div>
            <b><?php _e('Bedrooms', 'wasico'); ?></b><i class="fas fa-bed"></i> <?php echo $single_property->bedrooms ?>
          </div>
          <div>
            <b><?php _e('Bathrooms', 'wasico'); ?></b><i class="fas fa-bath"></i> <?php echo $single_property->bathrooms ?>
          </div>
          <div>
            <b><?php _e('Garages', 'wasico'); ?></b><i class="fas fa-warehouse"></i> <?php echo $single_property->garages ?>
          </div>
          <div>
            <b><?php _e('Floor', 'wasico'); ?></b><i class="fas fa-layer-group"></i> <?php echo  $single_property->floor ?>
          </div>
          <div>
            <b><?php _e('Year built', 'wasico'); ?></b><i class="far fa-calendar-alt"></i> <?php echo  $single_property->building_date ?>
          </div>
          <div>
            <b><?php _e('Area', 'wasico'); ?></b><i class="far fa-square"></i> <?php echo $single_property->area.' '.$single_property->unit_area_label ?>
          </div>
        </div>
        <div class="summary-block summary-description">
          <b><?php _e('Description', 'wasico'); ?></b> <?php
          echo strip_tags($single_property->observations); ?>
        </div>
        <div class="summary-block summary-additional-details">
          <b><?php _e('Additional details', 'wasico'); ?></b>
          <ul>
            <li>
              <b><?php _e('Property type:', 'wasico'); ?></b> <?php
              echo strip_tags(get_wasi_property_type($single_property->id_property_type)); ?>
            </li>
            <li>
              <b><?php _e('Condition:', 'wasico'); ?></b> <?php echo $single_property->property_condition_label ?>
            </li>
            <li>
              <b><?php _e('Maintenance Fee:', 'wasico'); ?></b> <?php
              echo '$'.number_format($single_property->maintenance_fee, 0) ?>
            </li>
            <li>
              <b><?php _e('Floor:', 'wasico'); ?></b> <?php echo $single_property->floor ?>
            </li>
            <li>
              <b><?php _e('Year built:', 'wasico'); ?></b> <?php echo $single_property->building_date ?>
            </li>
            <li>
              <b><?php _e('Stratum:', 'wasico'); ?></b> <?php echo $single_property->stratum ?>
            </li>
          </ul>
        </div>
        <?php if($single_property->features->internal ) : ?>
          <div class="summary-block summary-internal">
            <b><?php _e('Amenities', 'wasico'); ?></b>
            <ul>
              <?php foreach ($single_property->features->internal as $feat) : ?>
                <li>
                  <i class="fas fa-check"></i> <?php echo $feat->nombre; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if($single_property->features->external ) : ?>
          <div class="summary-block summary-external">
            <b><?php _e('Public facilities', 'wasico'); ?></b>
            <ul>
              <?php foreach ($single_property->features->external as $feat) : ?>
                <li>
                  <i class="fas fa-check"></i> <?php echo $feat->nombre; ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <?php if ($single_property->video) : ?>
          <div class="summary-block summary-video">
            <b><?php _e('Property video', 'wasico'); ?></b>
            <?php
            global $wp_embed;
            // $video_h = $video_w/1.61; // 1.61 golden ratio
            echo $wp_embed->run_shortcode( '[embed width="100%"]' . $single_property->video . '[/embed]' );
            ?>
          </div>
        <?php endif; ?>
        <?php if ($single_property->map) : ?>
          <div class="summary-block summary-map">
            <b><?php _e('Property on map', 'wasico'); ?></b>
            <div class="listing-detail-location-wrapper listing-detail-content-box" >
            <iframe src="https://maps.google.com/maps?q=<?php echo $single_property->map; ?>&z=15&output=embed" width="100%" height="380" frameborder="0" style="border:0"></iframe>
            </div>
          </div>
        <?php endif; ?>
      </div>
     
      <div class="sidebar">
       <h3> AGENT <?php
       //$res = getUserProperty('105949');
       //$contact = $c->api->getUserProperty('105949');
       //echo $contact['email']; ?></h3><ul><?php dynamic_sidebar('wasi-sidebar'); ?></ul></div>
    </div>
  </div>
</div>
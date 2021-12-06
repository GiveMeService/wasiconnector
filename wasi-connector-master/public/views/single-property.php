<?php //include 'search-bar.php';
$c = new WasiAPICient();
//echo "stringsajdgsjhgjshgd";
?>
<link rel='stylesheet' id='wasi-connector-css'  href='/wp-content/plugins/wasi-connector-master/public/css/flexslider.css' type='text/css' media='all' />
<link rel='stylesheet' id='wasi-connector-css'  href='/wp-content/plugins/wasi-connector-master/public/css/flexslider-rtl.css' type='text/css' media='all' />
<link rel='stylesheet' href='/wp-content/plugins/wasi-connector-master/public/js/pgw-sliders/pgwslider.min.css' type='text/css' media='all' />

<style>
    .ps-list::-webkit-scrollbar {
        display: none;
    }
    .pgwSlider ul.ps-list {
    	max-height: 618px;
        overflow: auto;
    }
    
    ul.pgwSlider > li, .pgwSlider > .ps-list > li {
        height: 50% !important;
    }
    div#wasi_gallery ul > li {
        max-height: none !important;
    }
    .listing-detail .page-header {
        border-bottom: 1px solid #eee;
    }
    div#wasi_gallery {
        margin: 0;
    }
    #wasi_gallery_container {
    	padding-top: 10px !important;
    }
    div#wasi_gallery {
    	margin: 0 !important;
    }
    div#wasi_gallery ul.ps-list > li img {
    	width: 100% !important;
        object-position: 0 !important;
    }
</style>
<script type='text/javascript' src='/wp-content/plugins/wasi-connector-master/public/js/modernizr.js'></script><script src="https://cdnjs.cloudflare.com/ajax/libs/PgwSlider/2.3.0/pgwslider.min.js" integrity="sha512-Oz0WQx5ADiBluAj9vpDDLDKZRqMvawtS4jtgi4ebPahhvfB6pWlPdoDbr6gPndcVt4uPn/nX1/8rTuDA2B/qBQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><script>var propertyTypes = [];</script>
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
        <?php echo '<b>'.__('Venta', 'wasico').'</b> '.$currency_var.number_format($single_property->sale_price, 0); ?> <span class="currency"><?php echo $single_property->iso_currency ?></span>
      <?php endif; ?>
      <?php if($single_property->for_rent && $single_property->rent_price !== '0') : ?>
        <?php echo '<b>'.__('Arriendo', 'wasico').'</b> '.$currency_var.number_format($single_property->rent_price, 0); ?> <span class="currency"><?php echo $single_property->iso_currency ?></span>
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
          $images_html.= "
              <li>
                  <img src=$value->url "
                    ."data-large-src='{$value->url_big}' "
                    ."data-description='{$value->description}' "
                    ."alt='{$value->description}' /></li>";
        }
      }
      
      if(strlen($images_html) > 0) {
        echo '<div id="wasi_gallery_container">
                <div id="wasi_gallery" style="visibility:hidden;">
                  <ul class="slides pgwSlider" style="text-align: center;">'.$images_html.'</ul>
                </div>
              </div>'; 
    ?>
        <script>jQuery(document).ready(function($) {
              var g = jQuery("#wasi_gallery");
              $('.pgwSlider').pgwSlider({
                adaptiveHeight: true
              });
              g.css('visibility', 'visible');
          });</script>
      
        <?php
      }
    }
    ?>
    <div class="listing-detail-section-columns">
      <div class="summary">
        <div class="summary-header"><?php _e('ID del inmueble', 'wasico'); ?>: <?php echo $single_property->id_property;
        ?></div>
        <div class="summary-block summary-benefits">
          <div style="padding-right: 73px;">
            <b><?php _e('Alcobas', 'wasico'); ?></b><i class="fas fa-bed"></i> <?php echo $single_property->bedrooms ?>
          </div>
          <div style="padding-right: 73px;">
            <b><?php _e('Baños', 'wasico'); ?></b><i class="fas fa-bath"></i> <?php echo $single_property->bathrooms ?>
          </div>
          <div style="padding-right: 73px;">
            <b><?php _e('Parqueaderos', 'wasico'); ?></b><i class="fas fa-warehouse"></i> <?php echo $single_property->garages ?>
          </div>
          <div style="padding-right: 73px;">
            <?php if ($single_property->floor == "") { ?>
                     <b><?php _e('Piso', 'wasico'); ?></b><i class="fas fa-layer-group"></i> N/A
              <?php } else { ?>
                    <b><?php _e('Piso', 'wasico'); ?></b><i class="fas fa-layer-group"></i> <?php echo  $single_property->floor ?>
              <?php } ?>
          </div>
          <div style="padding-right: 73px;">
            <b><?php _e('Año construcción', 'wasico'); ?></b><i class="far fa-calendar-alt"></i> <?php echo  $single_property->building_date ?>
          </div>
          <div style="padding-right: 73px;">
            <b><?php _e('Área', 'wasico'); ?></b><i class="far fa-square"></i> <?php echo $single_property->area.' '.$single_property->unit_area_label ?>
          </div>
        </div>
        <div class="summary-block summary-description">
          <b><?php _e('Descripción', 'wasico'); ?></b> <?php
          echo strip_tags($single_property->observations); ?>
        </div>
        <div class="summary-block summary-additional-details">
          <b><?php _e('Detalles adicionales', 'wasico'); ?></b>
          <ul>
            <li>
              <b><?php _e('Tipo de inmueble:', 'wasico'); ?></b> <?php
              echo strip_tags(get_wasi_property_type($single_property->id_property_type)); ?>
            </li>
            <li>
              <?php if ($single_property->property_condition_label == "Used") { ?>
                  <b><?php _e('Estado:', 'wasico'); ?></b> Usado
              <?php } elseif ($single_property->property_condition_label == "New") { ?>
                  <b><?php _e('Estado:', 'wasico'); ?></b> Nuevo
              <?php } else { ?>
                    <b><?php _e('Estado:', 'wasico'); ?></b> <?php echo $single_property->property_condition_label ?>
              <?php } ?>
            </li>
            <li>
              <b><?php _e('Administración:', 'wasico'); ?></b> <?php
              echo '$'.number_format($single_property->maintenance_fee, 0) ?>
            </li>
            <li>
              <?php if ($single_property->floor == "") { ?>
                     <b><?php _e('Piso:', 'wasico'); ?></b> N/A
              <?php } else { ?>
                   <b><?php _e('Piso:', 'wasico'); ?></b> <?php echo $single_property->floor ?>
              <?php } ?>
            </li>
            <li>
              <b><?php _e('Año constrición:', 'wasico'); ?></b> <?php echo $single_property->building_date ?>
            </li>
            <li>
              <b><?php _e('Estrato:', 'wasico'); ?></b> <?php echo $single_property->stratum ?>
            </li>
          </ul>
        </div>
        <?php if($single_property->features->internal ) : ?>
                   <div class="summary-block summary-internal">
            <b><?php _e('Características internas', 'wasico'); ?></b>
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
            <b><?php _e('Características Alrederores', 'wasico'); ?></b>
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
            <b><?php _e('Vídeo del inmueble', 'wasico'); ?></b>
            <?php
            global $wp_embed;
            // $video_h = $video_w/1.61; // 1.61 golden ratio
            echo $wp_embed->run_shortcode( '[embed width="100%"]' . $single_property->video . '[/embed]' );
            ?>
          </div>
        <?php endif; ?>
        <?php if ($single_property->map) : ?>
          <div class="summary-block summary-map">
            <b><?php _e('Ubicación del inmueble', 'wasico'); ?></b>
            <div class="listing-detail-location-wrapper listing-detail-content-box" >
            <iframe src="https://maps.google.com/maps?q=<?php echo $single_property->map; ?>&z=15&output=embed" width="100%" height="380" frameborder="0" style="border:0"></iframe>
            </div>
          </div>
        <?php endif; ?>
      </div>
      
    
    
      <div class="sidebarq" style="height: fit-content;">
       <?php $res = $c->getUserProperty($single_property->id_user); 
        //  echo "<pre>";
        // var_dump($res);
        if (isset($_POST['propID'])) {
            global $wpdb;
            $table = 'wp_prop_data';
            $data = array('propID' => $_POST['propID'], 'office' => $_POST['office'], 'Address' => $_POST['address'], 'imagelink' => $_POST['imagelink']);
            $format = array('%s','%d');
            $wpdb->insert($table,$data,$format);
            $my_id = $wpdb->insert_id;
        }
require_once ABSPATH . 'wp-admin/includes/upgrade.php';
global $wpdb;
 
$main_sql_create = 'CREATE TABLE wp_prop_data (
    id int,
    propID int,
    imagelink varchar(255),
    office varchar(255),
    Address varchar(255)
);';
          maybe_create_table( 'wp_prop_data',  $main_sql_create );
          
          $prop = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM wp_prop_data WHERE propID = %d ORDER BY id DESC", $single_property->id_user ) );
            
      //echo "<pre>";
          //var_dump($res);
          ?>
      <style type="text/css">
        #mobileview {
            padding: 30px;
            border: 1px solid #e3e3e3;
            webkit-box-shadow: 0 0 5px 2px rgb(0 0 0 / 5%);
    box-shadow: 0 0 5px 2px rgb(0 0 0 / 5%);
        }
        #mobileview h6 {
            text-align: center;
        }
        #mobileview img {
            width: 125px;
        }
        .btndiv {
          background: #337ab7;
    padding: 10px;
    text-align: center;
        }

       #agentform .labl {
    font-size: 14px;
    font-weight: 500;
}
input[type='text'], input[type='password'], input[type='email'], input[type='url'], input[type='tel'], input[type='number'], input[type='range'], input[type='date'], textarea, input.text, input[type='search'] {
  margin: 0 0 10px;
  padding: 4px 10px;
}

label {
    letter-spacing: .2px;
    font-size: 14px;
    font-weight: 500;
}

      
      </style>
      <div id="mobileview" class="mobileviewclass">

        <?php 

       
          if ($prop->imagelink == '') { ?>
            
            <img style="margin-top: -80px;display: block;margin-left: auto;margin-right: auto;width: 100;" src='/wp-content/uploads/2021/07/user-1.png' />

         <?php }else { ?>

            <img style="margin-top: -80px;display: block;margin-left: auto;margin-right: auto;width: 100;" src='<?php  echo ($res->photo) ? $res->photo : $prop->imagelink ?>' />

        <?php   }

        ?>
          <!-- <img style="margin-top: -80px;display: block;margin-left: auto;margin-right: auto;width: 100;" src='<?php  //echo ($res->photo) ? $res->photo : $prop->imagelink ?>' /> -->
          <center><h3 style="line-height: 20px;"> <span style="text-decoration: underline !important;"> Agente:</span> <br> <?php   echo $res->first_name.' '.$res->last_name; ?></h3></center>

      <h6 style="line-height: 20px; text-align: center;">  <span style="color: gray;">Oficina: </span> <span><?php  echo ($res->phone) ? $res->phone : $prop->office;  ?></span> </h6>

      <h6 style="line-height: 20px; text-align: center;">  <span style="color: gray;">Celular: </span> <span><?php  echo ($res->cell_phone) ? $res->cell_phone : '000';  ?></span> </h6>

      <h6 style="line-height: 20px; text-align: center;">  <span style="color: gray;">Email: </span> <span><?php  echo $res->email;  ?></span> </h6>

      <h6 style="line-height: 20px; text-align: center;">  <span style="color: gray;">Dirección: </span> <span><?php  echo ($res->address) ? $res->address : $prop->Address;  ?></span> </h6>

      </div>
      <!-- <div class="btndiv"><a href="#" class="viewlistingbtn" style="color: #fff; font-size: 14px;">View my Listings</a></div> -->
      
         <?php 
          
          if(current_user_can('administrator')) { ?>
        <div id="agentform" style="padding-top: 15px;">
            <form id="propform" action="" method="post" >
                <label class="labl" style="font-size: 14px;
    font-weight: 500;">ID del agente</label>    <input type="text" name="propID" id="propID"  value="<?php echo $single_property->id_user; ?>" readonly /> <label class="labl" style="font-size: 14px;
    font-weight: 500;">URL de la imágen</label> <input type="text" name="imagelink" id="imagelink" value="<?php echo ($prop->imagelink) ? $prop->imagelink: "" ; ?>" /> <label class="labl" style="font-size: 14px;
    font-weight: 500;">Oficina</label>  <input type="text" name="office"  id="office" value="<?php echo ($prop->office) ? $prop->office : "" ; ?>" /> <label class="labl" style="font-size: 14px;
    font-weight: 500;">Dirección</label> <input type="text" name="address"  id="address" value="<?php echo ($prop->Address) ? $prop->Address : "" ; ?>" /> <input type="submit" value="Actualizar" id="submit"  style="width: 100%; background: #337ab7;" />
            </form>
    </div>
          <?php }
          ?>
          
          <ul style="list-style: none; padding-top: 20px; padding-left: 15px; padding-right: 15px;"><?php dynamic_sidebar('wasi-sidebar'); ?></ul></div>
    </div>
  </div>
</div>

 <div>
<?php 
  // $res9 = $c->getUserProperty($single_property->id_user);  
  // echo "<pre>";
  // var_dump($single_property);
  // var_dump($res9);
  // echo ($res9);
 ?></div>
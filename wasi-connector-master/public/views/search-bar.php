<div class="col-md-3 col-xs-12">
<div id="wasiSearchApp" class="wasi_search">
    <form action="/<?php echo $properties_slug; ?>" method="GET" role="form" class="<?php echo $instance['formClass'] ?>" v-on:submit.prevent="wasiSearchProperties">

<?php 
  
     $data = $parent->getAPIClient()->getPropertyStatus();   
    //This will get property status like: For Sale, For Rent ......

    $propertyTypes = $parent->getAPIClient()->getPropertyTypes();
    //This will get types of property like: duplex, house, villa, hotel ......

    $wasiCountries = $parent->getAPIClient()->getCountries();
    //This will get list of country from api data
  
    $regions = $parent->getAPIClient()->getRegions(1);
    // This will get state list of countries (in this function we get region only Colombia country)

    $cities = $parent->getAPIClient()->getCities(2);
    // This will get city list of states  (in this function we get cities only Antioquia state)


    $citywithproperty = $parent->getAPIClient()->getcitybyproperty();
    
   //$zonewithproperty = $parent->getAPIClient()->getZones();
    //print_r($zonewithproperty);
 ?>

        <div class="listing-search-bar">
        
            <div>
    <label for="prop_type">Buscar</label>
    <input type="text" name="match" v-model="filters.match" placeholder="¿Qué inmueble buscas?"/>
  </div>
        
        
  <div>
    <label for="prop_status">Estado de la propiedad</label>
    <select class="selectpicker" name="for_type" id="for_type" v-model="filters.for_type">
                        <option value="0"><?php _e('Seleccionar', 'wasico'); ?></option>

                        <?php foreach ($data as $key => $status) {
                          if ($status == "For Rent") {
                            echo '<option value="' . $key . '">Arriendo</option>';
                          } elseif ($status == "For Sale") {
                            echo '<option value="' . $key . '">Venta</option>';
                          }
                          // } else {
                          //   echo '<option value="' . $key . '">' . $status . '</option>';
                          // }
                        } ?>
                    </select>

  </div>
  <div>
    <label for="prop_type">Tipo de inmueble</label>
    <select class="selectpicker" name="id_property_type" id="id_property_type" v-model="filters.id_property_type">
                        <option value="0"><?php _e('Seleccionar', 'wasico'); ?></option>
                        <?php foreach ($propertyTypes as $type) {

                            if (empty($instance['types'])) {
                                echo '<option value="' . $type->id_property_type . '">' . $type->nombre . '</option>';
                            } else {
                                if (in_array($type->id_property_type, $types)) {
                                    echo '<option value="' . $type->id_property_type . '">' . $type->nombre . '</option>';
                                }
                            }
                        } ?>
                    </select>
  </div>
  <div>
    <label for="prop_type">Habitaciones</label>
    <select class="selectpicker" name="min_bedrooms" id="min_bedrooms" v-model="filters.min_bedrooms">
                    <option value="0"><?php _e('Seleccionar', 'wasico'); ?></option>
                    <?php for ($i = 1; $i <= 10; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } ?>
                </select>
  </div>
  
  
  <div>
    <label for="prop_type">Cuartos de baño</label>
    <select class="selectpicker" name="min_bathrooms" id="min_bathrooms" v-model="filters.bathrooms">
                    <option value="0" selected><?php _e('Seleccionar', 'wasico'); ?></option>
                    <?php for ($i = 1; $i <= 10; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    } ?>
                </select>
  </div>
  
  <div class="search-location-box">

   <!--  <label for="prop_location">Location</label>
     <select class="selectpicker" name="contact-country" id="contact-country" v-model="contact.id_country" v-on:change="changeLocationCountry">
                    <option value="0"><?php // _e('Select country', 'wasico'); ?></option>
                    <?php //foreach ($wasiCountries as $country) {
                        //if (empty($instance['countries'])) {
                        //    echo '<option value="' . $country->id_country . '">' . $country->name . '</option>';
                      //  } else {
                       //     if (in_array($country->iso, $countries)) {
                       //         echo '<option value="' . $country->id_country . '">' . $country->name . '</option>';
                    //        }
                 //       }
                //    } ?>
                </select>  -->

                <!-- <div class="form-group">
                <label for="contact-region"><?php // _e('Region', 'wasico'); ?>:</label>
                <select class="selectpicker" name="contact-region" id="contact-region" v-model="contact.id_region" v-on:change="changeLocationRegion">
                  <option value="0"><?php //_e('Select Region', 'wasico'); ?></option>
                     <?php //foreach ($regions as $region) {
                        
                          //  echo '<option value="' . $region->id_region . '">' . $region->name . '</option>';
                       
                           
                        
                  //  } ?>
                </select>
            </div> -->

            <div class="form-group">
                <label for="contact-city"><?php _e('Ubicación', 'wasico'); ?>:</label>
                
                <select class="selectpicker" name="contact-country" id="contact-country" v-model="contact.id_country" v-on:change="changeLocationCountry">
                    <option value="0"><?php  _e('Seleccionar', 'wasico'); ?></option>
                    <?php foreach ($wasiCountries as $country) {
                        if (empty($instance['countries'])) {
                            echo '<option value="' . $country->id_country . '">' . $country->name . '</option>';
                        } else {
                            if (in_array($country->iso, $countries)) {
                                echo '<option value="' . $country->id_country . '">' . $country->name . '</option>';
                            }
                       }
                   } ?>
                </select>
                
               
                <label for="contact-region"><?php _e('Región', 'wasico'); ?>:</label>
                <select class="selectpicker" name="contact-region" id="contact-region" v-model="contact.id_region" v-on:change="changeLocationRegion">
                  <option value="0"><?php _e('Seleccionar', 'wasico'); ?></option>
                     <?php foreach ($regions as $region) {
                        
                            echo '<option value="' . $region->id_region . '">' . $region->name . '</option>';
                       
                           
                        
                    } ?>
                </select>
                <label for="contact-city"><?php _e('Ciudad', 'wasico'); ?>:</label>
                <select class="selectpicker" name="contact-city" id="contact-city" v-model="contact.id_city" v-on:change="changeLocationCity">
                  <option value="0"><?php _e('Seleccionar', 'wasico'); ?></option>
                   <?php foreach ($citywithproperty as $city) {
                        
                            echo '<option value="' . $city->id_city . '">' . $city->name . '</option>';
                       
                           
                        
                    } ?>
                </select>
                
                
               
                
                
                
                
                
                
            </div>
			
			<!-- <div class="form-group">
                <label for="contact-city"><?php //_e('Precio Mínimo', 'wasico'); ?>:</label>
				<input type="text" name="min_price" v-model="filters.min_price" />
        <input type="number" value="1" min="1" max="999999999" name="min_price" v-model="filters.min_price" />
			</div>	 -->
			<div class="form-group">
                <label for="contact-city"><?php _e('Precio Máximo', 'wasico'); ?>:</label>
				<!-- <input type="text" name="min_price" v-model="filters.max_price" /> -->
        <input type="number" value="1" min="0" max="999999999" name="min_price" v-model="filters.max_price" />
			</div>
			
			
			<div class="form-group">
                <label for="min_area"><?php _e('Min Area', 'wasico'); ?>:</label>
				<!-- <input type="text" name="min_price" v-model="filters.max_price" /> -->
				<input type="text" name="min_area" v-model="filters.min_area" />
			</div>
			
			<div class="form-group">
                <label for="max_area"><?php _e('Max Area', 'wasico'); ?>:</label>
				<!-- <input type="text" name="min_price" v-model="filters.max_price" /> -->
				<input type="text" name="max_area" v-model="filters.max_area" />
			</div>
			
			
  </div>
  
  
	
    

        <div class="form-group col-xs-12">
            <button id="search-btn1" class="<?php echo $instance['submitClass'] ?>" data-cleaned-text="!!" data-loading-text="<?php _e('Buscando...', 'wasico'); ?>..."><?php _e('Buscar'); ?></button>
        </div>
        
        
        
        
        
        
        </div>
    </form>
</div>
<?php if (empty($_GET) && !empty($keyAux)) { ?>
    <script>
        function clickBuscar1() {
            document.getElementById("search-btn1").click()

        };

        document.addEventListener("DOMContentLoaded", clickBuscar1);
    </script>
<?php
}
?>

<style type="text/css">
  #wasiSearchApp {
    padding-bottom: 30px;
  }
</style>
</div>
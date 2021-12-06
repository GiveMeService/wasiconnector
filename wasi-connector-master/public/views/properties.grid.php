

<?php if(wp_is_mobile()){ ?>
<?php include 'search-bar.php'; ?>

<div id="wasiApp" class="col-md-9 col-xs-12 listings-row propertiesGrid1">
    <div v-show="app_ready===true && loading===false && properties.length<=0" class="listings-not-found text-center" v-cloak>
        <h3><?php _e('¡Propiedades no encontradas!', 'wasico'); ?></h3>
        <span><?php _e('Vuelve a intentarlo con diferentes filtros.', 'wasico'); ?></span>
    </div>
    <div v-show="app_ready===true && loading===true" class="listings-not-found text-center" v-cloak>
        <h3><?php _e('Buscando propiedades...', 'wasico'); ?></h3>
    </div>

    <article class="listing-container gridtemplate" v-for="prop in properties" v-cloak>
      <div class="listing-column">
        <div class="listing-column-image-wrapper">
          <a v-bind:href="'<?php echo home_url('/').$atts['propertyPage']; ?>?id='+prop.id_property"
             class="listing-column-image" v-bind:style="prop.thumbnail">
          </a>
          <div class="listing-column-label for-sale" v-if="prop.for_sale=='true' && prop.sale_price>0">Venta</div>
          <div class="listing-column-label for-rent" v-if="prop.rent_price=='true' && prop.rent_price>0">Arriendo</div>
          <div class="listing-column-label id_property_type1">{{getPropertyType(prop.id_property_type)}}</div>
        </div>
        <div class="listing-column-title">
          <h3><a v-bind:href="'<?php echo home_url('/').$atts['propertyPage']; ?>?id='+prop.id_property" >{{prop.title}}</a></h3>
        </div>
        <div class="listing-column-address">
          <a href="" v-bind:data-map-coordinate="prop.map"><i class="fas fa-map-marker-alt"></i> <address
                v-html="prop.city_label+', '+prop
          .region_label"></address></a>
        </div>
        <div class="listing-column-date">
          Añadido: {{prop.created_at | formatDate}}
        </div>

        <div class="listing-column-details">
          <div>
            <b><?php _e('Alcobas', 'wasico'); ?></b><i class="fas fa-bed"></i> {{prop.bedrooms}}
          </div>
          <div>
            <b><?php _e('Baños', 'wasico'); ?></b><i class="fas fa-bath"></i> {{prop.bathrooms}}
          </div>
          <div>
            <b><?php _e('Parqueaderos', 'wasico'); ?></b><i class="fas fa-warehouse"></i> {{prop.garages}}
          </div>
        </div>

        <div class="listing-column-label-special">
          <span v-if="prop.for_sale=='true' && prop.sale_price>0"><b>Venta</b>{{prop.sale_price | formatNumber}}
            {{prop.iso_currency}}</span>
          <span v-if="prop.for_rent=='true' && prop.rent_price>0"><b>Arriendo</b>{{prop.rent_price | formatNumber}}
            {{prop.iso_currency}}</span>
          <span v-if="prop.sale_price==0 && prop.rent_price==0">0</span>
        </div>
      </div>
    </article>

    <!-- pagination: -->
    <nav aria-label="Page navigation" class="nav-container pagination hidden"
        v-show="total_pages>0 && total_properties>properties_per_page" v-cloak>
      <ul class="pagination-inner">
        <!--li>
          <a href="#" aria-label="Previous" v-on:click="previousPage()">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li-->
        <li v-for="page in total_pages" v-bind:class="activePageClass(page)">
            <a href="#" v-on:click.stop="paginate(page)">{{page}}</a>
        </li>
        <!--li>
          <a href="#" aria-label="Next" v-on:click="nextPage()">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li-->
      </ul>
    </nav>
</div>
<?php }else{ ?>


<div id="wasiApp" class="col-md-9 col-xs-12 listings-row propertiesGrid1">
    <div v-show="app_ready===true && loading===false && properties.length<=0" class="listings-not-found text-center" v-cloak>
        <h3><?php _e('¡Propiedades no encontradas!', 'wasico'); ?></h3>
        <span><?php _e('Vuelve a intentarlo con diferentes filtros.', 'wasico'); ?></span>
    </div>
    <div v-show="app_ready===true && loading===true" class="listings-not-found text-center" v-cloak>
        <h3><?php _e('Buscando propiedades...', 'wasico'); ?></h3>
    </div>

    <article class="listing-container gridtemplate" v-for="prop in properties" v-cloak>
      <div class="listing-column">
        <div class="listing-column-image-wrapper">
          <a v-bind:href="'<?php echo home_url('/').$atts['propertyPage']; ?>?id='+prop.id_property"
             class="listing-column-image" v-bind:style="prop.thumbnail">
          </a>
          <div class="listing-column-label for-sale" v-if="prop.for_sale=='true' && prop.sale_price>0">Venta</div>
          <div class="listing-column-label for-sale forsale2" v-if="prop.for_sale!=='true' && prop.sale_price>0">Venta</div>
          <div class="listing-column-label for-rent" v-if="prop.rent_price=='true' && prop.rent_price>0">Arriendo</div>
          <div class="listing-column-label for-other1" >{{getPropertyType(prop.id_property_type)}}</div>
        </div>
        <div class="listing-column-title">
          <h3><a v-bind:href="'<?php echo home_url('/').$atts['propertyPage']; ?>?id='+prop.id_property" >{{prop.title}}</a></h3>
        </div>
        <div class="listing-column-label-special">
          <span v-if="prop.for_sale=='true' && prop.for_rent!=='true' && prop.sale_price>0">{{prop.sale_price | formatNumber}}
            {{prop.iso_currency}}</span>
          <span v-if="prop.for_rent=='true' && prop.for_sale!=='true' && prop.rent_price>0">{{prop.rent_price | formatNumber}}
            {{prop.iso_currency}}</span>
          <span v-if="prop.sale_price==0 && prop.rent_price==0">0</span>
          <span v-if="prop.for_sale=='true' && prop.for_rent=='true'">{{prop.sale_price | formatNumber}}
            {{prop.iso_currency}}</span>
        </div>
        <!-- <div class="listing-column-description">
          <?php  //$text = "{{prop.observations}}";
                 //echo strip_tags($text); ?>
        </div>
        <div class="listing-column-description-button"> 
          <a v-bind:href="'<?php //echo home_url('/').$atts['propertyPage']; ?>?id='+prop.id_property" ><span>Ver más</span></a>
        </div> -->
        <!-- <div class="listing-column-address">
          <a href="" v-bind:data-map-coordinate="prop.map"><i class="fas fa-map-marker-alt"></i> <address
                v-html="prop.city_label+', '+prop
          .region_label"></address></a>
        </div> -->
        <!-- <div class="listing-column-date">
          Añadido: {{prop.created_at | formatDate}}
        </div> -->

        <div class="listing-column-details">
          <div>
            <b><?php _e('Alcobas', 'wasico'); ?></b><i class="fas fa-bed"></i> {{prop.bedrooms}}
          </div>
          <div>
            <b><?php _e('Baños', 'wasico'); ?></b><i class="fas fa-bath"></i> {{prop.bathrooms}}
          </div>
          <div>
            <b><?php _e('Parqueaderos', 'wasico'); ?></b><i class="fas fa-warehouse"></i> {{prop.garages}}
          </div>
        </div>

        
      </div>
    </article>

    <!-- pagination: -->
    <nav aria-label="Page navigation" class="nav-container pagination hidden"
        v-show="total_pages>0 && total_properties>properties_per_page" v-cloak>
      <ul class="pagination-inner">
        <!--li>
          <a href="#" aria-label="Previous" v-on:click="previousPage()">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li-->
        <li v-for="page in total_pages" v-bind:class="activePageClass(page)">
            <a href="#" v-on:click.stop="paginate(page)">{{page}}</a>
        </li>
        <!--li>
          <a href="#" aria-label="Next" v-on:click="nextPage()">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li-->
      </ul>
    </nav>
</div>

<?php include 'search-bar.php'; ?>
<?php } ?>

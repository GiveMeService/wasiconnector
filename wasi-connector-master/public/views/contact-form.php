<div id="wasiContactApp" class="wasi_contact">
    <form action="#" method="POST" role="form" class="<?php echo $instance['formClass'] ?>"
        v-on:submit.prevent="wasiContactOwner" style="padding: 10px; border: 1px solid #e3e3e3; webkit-box-shadow: 0 0 5px 2px rgb(0 0 0 / 5%); box-shadow: 0 0 5px 2px rgb(0 0 0 / 5%);">
		<!-- <h1><?php 
            //echo $contact[0]; ?></h1> -->
        <div class="form-group">
            <label for="contact-name" style="font-size: 14px;font-weight: 500;">* <?php _e('Nombre', 'wasico'); ?>:</label>
            <input id="contact-name" placeholder="<?php _e('Nombre', 'wasico'); ?>" name="contact-name" type="text" class="form-control inp-text" v-model="contact.name" required>
        </div>

        <div class="form-group">
            <label for="contact-email" style="font-size: 14px;font-weight: 500;">* <?php _e('Email', 'wasico'); ?>:</label>
            <input id="contact-email" placeholder="<?php _e('Email', 'wasico'); ?>" name="contact-email" type="text" class="form-control inp-text" v-model="contact.email" required>
        </div>

        <div class="form-group">
            <label for="contact-phone" style="font-size: 14px;font-weight: 500;"><?php _e('Teléfono', 'wasico'); ?>:</label>
            <input id="contact-phone" placeholder="<?php _e('Teléfono', 'wasico'); ?>" name="contact-phone" type="text" class="form-control inp-text" v-model="contact.phone">
        </div>


        <!-- <div class="form-group">
            <label for="contact-country"><?php _e('Your country', 'wasico'); ?>:</label>
            <select class="selectpicker" name="contact-country" id="contact-country" 
                v-model="contact.id_country" v-on:change="changeLocationCountry">
                <option value="0"><?php _e('Select country', 'wasico'); ?></option>
                <?php foreach ($wasiCountries as $country) {
                    echo '<option value="'.$country->id_country.'">'.$country->name.'</option>';
                } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="contact-region"><?php _e('Region', 'wasico'); ?>:</label>
            <select class="selectpicker" name="contact-region" id="contact-region" 
                v-model="contact.id_region" v-on:change="changeLocationRegion">
                <option v-for="region in location.regions" v-bind:value="region.id_region">
                    {{region.name}}
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="contact-city"><?php _e('City', 'wasico'); ?>:</label>
            <select class="selectpicker" name="contact-city" id="contact-city" 
                v-model="contact.id_city">
                <option v-for="city in location.cities" v-bind:value="city.id_city">
                    {{city.name}}
                </option>
            </select>
        </div>
 -->

        <div class="form-group">
            <label for="contact-message" style="font-size: 14px;font-weight: 500;">* <?php _e('Asunto', 'wasico'); ?>:</label>
            <textarea id="contact-message" name="contact-message" required
                class="form-control" rows="9" v-model="contact.message"
                placeholder="<?php _e("Estoy enteresado en esta propiedad.", 'wasico'); ?>"></textarea>
        </div>


        <div class="form-group">
            <button id="wasi-contact-btn formProperties" style="width: 100%; padding: 14px;" class="<?php echo $instance['submitClass'] ?>"
                data-cleaned-text="!!" data-loading-text="Enviando..."><?php _e('Enviar'); ?></button>
            <span id="contact-ajax-send" class="hidden">
                <img src="data:image/gif;base64,R0lGODlhEAAQAPIAAP///wAAAMLCwkJCQgAAAGJiYoKCgpKSkiH/C05FVFNDQVBFMi4wAwEAAAAh/hpDcmVhdGVkIHdpdGggYWpheGxvYWQuaW5mbwAh+QQJCgAAACwAAAAAEAAQAAADMwi63P4wyklrE2MIOggZnAdOmGYJRbExwroUmcG2LmDEwnHQLVsYOd2mBzkYDAdKa+dIAAAh+QQJCgAAACwAAAAAEAAQAAADNAi63P5OjCEgG4QMu7DmikRxQlFUYDEZIGBMRVsaqHwctXXf7WEYB4Ag1xjihkMZsiUkKhIAIfkECQoAAAAsAAAAABAAEAAAAzYIujIjK8pByJDMlFYvBoVjHA70GU7xSUJhmKtwHPAKzLO9HMaoKwJZ7Rf8AYPDDzKpZBqfvwQAIfkECQoAAAAsAAAAABAAEAAAAzMIumIlK8oyhpHsnFZfhYumCYUhDAQxRIdhHBGqRoKw0R8DYlJd8z0fMDgsGo/IpHI5TAAAIfkECQoAAAAsAAAAABAAEAAAAzIIunInK0rnZBTwGPNMgQwmdsNgXGJUlIWEuR5oWUIpz8pAEAMe6TwfwyYsGo/IpFKSAAAh+QQJCgAAACwAAAAAEAAQAAADMwi6IMKQORfjdOe82p4wGccc4CEuQradylesojEMBgsUc2G7sDX3lQGBMLAJibufbSlKAAAh+QQJCgAAACwAAAAAEAAQAAADMgi63P7wCRHZnFVdmgHu2nFwlWCI3WGc3TSWhUFGxTAUkGCbtgENBMJAEJsxgMLWzpEAACH5BAkKAAAALAAAAAAQABAAAAMyCLrc/jDKSatlQtScKdceCAjDII7HcQ4EMTCpyrCuUBjCYRgHVtqlAiB1YhiCnlsRkAAAOwAAAAAAAAAAAA==" alt="Send">
            </span>
        </div>
        <div class="alert alert-success" role="alert" id="wasiResponseContact" style="display: none"></div>

    </form>
</div>
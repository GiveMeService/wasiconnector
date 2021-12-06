<?php

// shortocode: [wasi-properties]
function renderWasiSearch($parent, $instance) {

    if(isset($instance['formclass'])) {
        $instance['formClass'] = $instance['formclass'];
    }
    if(isset($instance['submitclass'])) {
        $instance['submitClass'] = $instance['submitclass'];
    }

    $instance = shortcode_atts(
        array(
            'formClass' => 'row',
            'submitClass' => 'btn btn-primary',
            'filter'=>'',
            'countries'=>'',
            'btype'=>"0",
            'types'=>'',
            'type'=>''
        ), $instance, 'wasi-search' );

    if(!$instance) { $instance = []; }
    $filter=explode(",", $instance['filter']);
    $countries=explode(",", $instance['countries']);
    $keyAux="";
    $statusAux="";
    $types=explode(",", $instance['types']);
    $keyType="";
    $nombreType="";
    $propertyStatus = $parent->getAPIClient()->getPropertyStatus();
    $propertyTypes = $parent->getAPIClient()->getPropertyTypes();
    $wasiCountries = $parent->getAPIClient()->getCountries();
    if (!empty($instance['btype'])) {
        foreach ($propertyStatus as $key => $status) {
            if ($key == $instance['btype']) {
                $keyAux=$key;
                $statusAux=$status;
            }
        }
    }
    if (!empty($instance['type'])) {
        foreach ($propertyTypes  as $key => $type) {
            if ($type->id_property_type == $instance['type']) {
                $keyType=$type->id_property_type;
                $nombreType=$type->name;
            }
        }
    }
    // $atts['propertyTypes'] = $parent->getAPIClient()->getPropertyTypes();
    // $atts['propertyPage'] = get_post($parent->getWasiData()['property_single_page'])->post_name;

    ob_start();

    require_once('views/search.php');
    require_once('views/search-bar.php');

    $out = ob_get_clean();
    return $out;
}
<?php

function gcplaces_create_places_custom_taxonomy() {

  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Edit Type' ),
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type Name' ),
    'menu_name' => __( 'Types' ),
  );

  register_taxonomy('place-type', array('place'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'place-type' ),
  ));

  /*
  wp_insert_term( 'Place', 'types', $args = array() );
  wp_insert_term( 'TouristDestination', 'types', $args = array() );
  wp_insert_term( 'LocalBusiness', $taxonomy, $args = array() );
  */
}
add_action( 'init', 'gcplaces_create_places_custom_taxonomy', 0 );

function gcplaces_create_places_terms() {
  if( !term_exists( 'Place', 'place-type' ) ) {
    wp_insert_term(
      'Place',
      'place-type',
      array(
        'description' => 'Place as described by Schema.org.',
        'slug'        => 'place'
      )
    );
  }

  $parent_term = term_exists( 'Place', 'place-type' ); // array is returned if taxonomy is given
  $parent_term_id = $parent_term['term_id'];

  if( !term_exists( 'TouristDestination', 'place-type' ) ) {
    wp_insert_term(
      'TouristDestination',
      'place-type',
      array(
        'description' => 'TouristDestination as described by Schema.org.',
        'slug'        => 'tourist-destination',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'LocalBusiness', 'place-type' ) ) {
    wp_insert_term(
      'LocalBusiness',
      'place-type',
      array(
        'description' => 'LocalBusiness as described by Schema.org.',
        'slug'        => 'local-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'Accommodation', 'place-type' ) ) {
    wp_insert_term(
      'Accommodation',
      'place-type',
      array(
        'description' => 'Accommodation as described by Schema.org.',
        'slug'        => 'accommodation',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'AdministrativeArea', 'place-type' ) ) {
    wp_insert_term(
      'AdministrativeArea',
      'place-type',
      array(
        'description' => 'AdministrativeArea as described by Schema.org.',
        'slug'        => 'administrative-area',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'CivicStructure', 'place-type' ) ) {
    wp_insert_term(
      'CivicStructure',
      'place-type',
      array(
        'description' => 'CivicStructure as described by Schema.org.',
        'slug'        => 'civic-structure',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'Landform', 'place-type' ) ) {
    wp_insert_term(
      'Landform',
      'place-type',
      array(
        'description' => 'Landform as described by Schema.org.',
        'slug'        => 'landform',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'LandmarksOrHistoricalBuildings', 'place-type' ) ) {
    wp_insert_term(
      'LandmarksOrHistoricalBuildings',
      'place-type',
      array(
        'description' => 'LandmarksOrHistoricalBuildings as described by Schema.org.',
        'slug'        => 'landmarks-or-historical-buildings',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'Residence', 'place-type' ) ) {
    wp_insert_term(
      'Residence',
      'place-type',
      array(
        'description' => 'Residence as described by Schema.org.',
        'slug'        => 'residence',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'TouristAttraction', 'place-type' ) ) {
    wp_insert_term(
      'TouristAttraction',
      'place-type',
      array(
        'description' => 'TouristAttraction as described by Schema.org.',
        'slug'        => 'tourist-attraction',
        'parent'      => $parent_term_id
      )
    );
  }

  // Add Local Business child taxonomies
  $parent_term = term_exists( 'LocalBusiness', 'place-type' );
  $parent_term_id = $parent_term['term_id'];

  if( !term_exists( 'AnimalShelter', 'place-type' ) ) {
    wp_insert_term(
      'AnimalShelter',
      'place-type',
      array(
        'description' => 'AnimalShelter as described by Schema.org.',
        'slug'        => 'animal-shelter',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'ArchiveOrganization', 'place-type' ) ) {
    wp_insert_term(
      'ArchiveOrganization',
      'place-type',
      array(
        'description' => 'ArchiveOrganization as described by Schema.org.',
        'slug'        => 'archive-organization',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'AutomotiveBusiness', 'place-type' ) ) {
    wp_insert_term(
      'AutomotiveBusiness',
      'place-type',
      array(
        'description' => 'AutomotiveBusiness as described by Schema.org.',
        'slug'        => 'automotive-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'ChildCare', 'place-type' ) ) {
    wp_insert_term(
      'ChildCare',
      'place-type',
      array(
        'description' => 'ChildCare as described by Schema.org.',
        'slug'        => 'child-care',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'Dentist', 'place-type' ) ) {
    wp_insert_term(
      'Dentist',
      'place-type',
      array(
        'description' => 'Dentist as described by Schema.org.',
        'slug'        => 'dentist',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'DryCleaningOrLaundry', 'place-type' ) ) {
    wp_insert_term(
      'DryCleaningOrLaundry',
      'place-type',
      array(
        'description' => 'DryCleaningOrLaundry as described by Schema.org.',
        'slug'        => 'dry-cleaning-or-laundry',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'EmergencyService', 'place-type' ) ) {
    wp_insert_term(
      'EmergencyService',
      'place-type',
      array(
        'description' => 'EmergencyService as described by Schema.org.',
        'slug'        => 'emergency-service',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'EmploymentAgency', 'place-type' ) ) {
    wp_insert_term(
      'EmploymentAgency',
      'place-type',
      array(
        'description' => 'EmploymentAgency as described by Schema.org.',
        'slug'        => 'employment-agency',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'EntertainmentBusiness', 'place-type' ) ) {
    wp_insert_term(
      'EntertainmentBusiness',
      'place-type',
      array(
        'description' => 'EntertainmentBusiness as described by Schema.org.',
        'slug'        => 'entertainment-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'FinancialService', 'place-type' ) ) {
    wp_insert_term(
      'FinancialService',
      'place-type',
      array(
        'description' => 'FinancialService as described by Schema.org.',
        'slug'        => 'financial-service',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'FoodEstablishment', 'place-type' ) ) {
    wp_insert_term(
      'FoodEstablishment',
      'place-type',
      array(
        'description' => 'FoodEstablishment as described by Schema.org.',
        'slug'        => 'food-establishment',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'GovernmentOffice', 'place-type' ) ) {
    wp_insert_term(
      'GovernmentOffice',
      'place-type',
      array(
        'description' => 'GovernmentOffice as described by Schema.org.',
        'slug'        => 'government-office',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'HealthAndBeautyBusiness', 'place-type' ) ) {
    wp_insert_term(
      'HealthAndBeautyBusiness',
      'place-type',
      array(
        'description' => 'HealthAndBeautyBusiness as described by Schema.org.',
        'slug'        => 'health-and-beauty-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'HomeAndConstructionBusiness', 'place-type' ) ) {
    wp_insert_term(
      'HomeAndConstructionBusiness',
      'place-type',
      array(
        'description' => 'HomeAndConstructionBusiness as described by Schema.org.',
        'slug'        => 'home-and-construction-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'InternetCafe', 'place-type' ) ) {
    wp_insert_term(
      'InternetCafe',
      'place-type',
      array(
        'description' => 'InternetCafe as described by Schema.org.',
        'slug'        => 'internet-cafe',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'LegalService', 'place-type' ) ) {
    wp_insert_term(
      'LegalService',
      'place-type',
      array(
        'description' => 'LegalService as described by Schema.org.',
        'slug'        => 'legal-service',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'Library', 'place-type' ) ) {
    wp_insert_term(
      'Library',
      'place-type',
      array(
        'description' => 'Library as described by Schema.org.',
        'slug'        => 'library',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'LodgingBusiness', 'place-type' ) ) {
    wp_insert_term(
      'LodgingBusiness',
      'place-type',
      array(
        'description' => 'LodgingBusiness as described by Schema.org.',
        'slug'        => 'lodging-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'MedicalBusiness', 'place-type' ) ) {
    wp_insert_term(
      'MedicalBusiness',
      'place-type',
      array(
        'description' => 'MedicalBusiness as described by Schema.org.',
        'slug'        => 'medical-business',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'ProfessionalService', 'place-type' ) ) {
    wp_insert_term(
      'ProfessionalService',
      'place-type',
      array(
        'description' => 'ProfessionalService as described by Schema.org.',
        'slug'        => 'professional-service',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'RadioStation', 'place-type' ) ) {
    wp_insert_term(
      'RadioStation',
      'place-type',
      array(
        'description' => 'RadioStation as described by Schema.org.',
        'slug'        => 'radio-station',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'RealEstateAgent', 'place-type' ) ) {
    wp_insert_term(
      'RealEstateAgent',
      'place-type',
      array(
        'description' => 'RealEstateAgent as described by Schema.org.',
        'slug'        => 'real-estate-agent',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'RecyclingCenter', 'place-type' ) ) {
    wp_insert_term(
      'RecyclingCenter',
      'place-type',
      array(
        'description' => 'RecyclingCenter as described by Schema.org.',
        'slug'        => 'recycling-center',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'SelfStorage', 'place-type' ) ) {
    wp_insert_term(
      'SelfStorage',
      'place-type',
      array(
        'description' => 'SelfStorage as described by Schema.org.',
        'slug'        => 'self-storage',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'ShoppingCenter', 'place-type' ) ) {
    wp_insert_term(
      'ShoppingCenter',
      'place-type',
      array(
        'description' => 'ShoppingCenter as described by Schema.org.',
        'slug'        => 'shopping-center',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'SportsActivityLocation', 'place-type' ) ) {
    wp_insert_term(
      'SportsActivityLocation',
      'place-type',
      array(
        'description' => 'SportsActivityLocation as described by Schema.org.',
        'slug'        => 'sports-activity-location',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'Store', 'place-type' ) ) {
    wp_insert_term(
      'Store',
      'place-type',
      array(
        'description' => 'Store as described by Schema.org.',
        'slug'        => 'store',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'TelevisionStation', 'place-type' ) ) {
    wp_insert_term(
      'TelevisionStation',
      'place-type',
      array(
        'description' => 'TelevisionStation as described by Schema.org.',
        'slug'        => 'television-station',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'TouristInformationCenter', 'place-type' ) ) {
    wp_insert_term(
      'TouristInformationCenter',
      'place-type',
      array(
        'description' => 'TouristInformationCenter as described by Schema.org.',
        'slug'        => 'tourist-information-center',
        'parent'      => $parent_term_id
      )
    );
  }

  if( !term_exists( 'TravelAgency', 'place-type' ) ) {
    wp_insert_term(
      'TravelAgency',
      'place-type',
      array(
        'description' => 'TravelAgency as described by Schema.org.',
        'slug'        => 'travel-agency',
        'parent'      => $parent_term_id
      )
    );
  }
}

add_action( 'init', 'gcplaces_create_places_terms', 0 );

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

  $taxonomies = array(
    array(
      'name' => 'TouristDestination',
      'slug' => 'tourist-destination',
      'parent' => 'Place'
    ),
    array(
      'name' => 'LocalBusiness',
      'slug' => 'local-business',
      'parent' => 'Place'
    ),
      array(
        'name' => 'AnimalShelter',
        'slug' => 'animal-shelter',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'ArchiveOrganization',
        'slug' => 'archive-organization',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'AutomotiveBusiness',
        'slug' => 'automotive-business',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'ChildCare',
        'slug' => 'child-care',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'Dentist',
        'slug' => 'dentist',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'DryCleaningOrLaundry',
        'slug' => 'dry-cleaning-or-laundry',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'EmergencyService',
        'slug' => 'emergency-service',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'EmploymentAgency',
        'slug' => 'employment-agency',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'EntertainmentBusiness',
        'slug' => 'entertainment-business',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'FinancialService',
        'slug' => 'financial-service',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'FoodEstablishment',
        'slug' => 'food-establishment',
        'parent' => 'LocalBusiness'
      ),
        array(
          'name' => 'Bakery',
          'slug' => 'bakery',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'BarOrPub',
          'slug' => 'bar-or-pub',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'Brewery',
          'slug' => 'brewery',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'CafeOrCoffeeShop',
          'slug' => 'cafe-or-coffee-shop',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'Distillery',
          'slug' => 'distillery',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'FastFoodRestaurant',
          'slug' => 'fast-food-restaurant',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'IceCreamShop',
          'slug' => 'ice-cream-shop',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'Restaurant',
          'slug' => 'restaurant',
          'parent' => 'FoodEstablishment'
        ),
        array(
          'name' => 'Winery',
          'slug' => 'winery',
          'parent' => 'FoodEstablishment'
        ),
      array(
        'name' => 'GovernmentOffice',
        'slug' => 'government-office',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'HealthAndBeautyBusiness',
        'slug' => 'health-and-beauty-business',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'HomeAndConstructionBusiness',
        'slug' => 'home-and-construction-business',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'InternetCafe',
        'slug' => 'internet-cafe',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'LegalService',
        'slug' => 'legal-service',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'Library',
        'slug' => 'library',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'LodgingBusiness',
        'slug' => 'lodging-business',
        'parent' => 'LocalBusiness'
      ),
        array(
          'name' => 'BedAndBreakfast',
          'slug' => 'bed-and-breakfast',
          'parent' => 'LodgingBusiness'
        ),
        array(
          'name' => 'Campground',
          'slug' => 'campground',
          'parent' => 'LodgingBusiness'
        ),
        array(
          'name' => 'Hostel',
          'slug' => 'hostel',
          'parent' => 'LodgingBusiness'
        ),
        array(
          'name' => 'Hotel',
          'slug' => 'hotel',
          'parent' => 'LodgingBusiness'
        ),
        array(
          'name' => 'Motel',
          'slug' => 'motel',
          'parent' => 'LodgingBusiness'
        ),
        array(
          'name' => 'Resort',
          'slug' => 'resort',
          'parent' => 'LodgingBusiness'
        ),
      array(
        'name' => 'MedicalBusiness',
        'slug' => 'medical-business',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'ProfessionalService',
        'slug' => 'professional-service',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'RadioStation',
        'slug' => 'radio-station',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'RealEstateAgent',
        'slug' => 'real-estate-agent',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'RecyclingCenter',
        'slug' => 'recycling-center',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'SelfStorage',
        'slug' => 'self-storage',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'ShoppingCenter',
        'slug' => 'shopping-center',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'SportsActivityLocation',
        'slug' => 'sports-activity-location',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'Store',
        'slug' => 'store',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'TelevisionStation',
        'slug' => 'television-station',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'TouristInformationCenter',
        'slug' => 'tourist-information-center',
        'parent' => 'LocalBusiness'
      ),
      array(
        'name' => 'TravelAgency',
        'slug' => 'travel-agency',
        'parent' => 'LocalBusiness'
      ),
    array(
      'name' => 'Accommodation',
      'slug' => 'accommodation',
      'parent' => 'Place'
    ),
      array(
        'name' => 'Apartment',
        'slug' => 'apartment',
        'parent' => 'Accommodation'
      ),
      array(
        'name' => 'CampingPitch',
        'slug' => 'camping-pitch',
        'parent' => 'Accommodation'
      ),
      array(
        'name' => 'House',
        'slug' => 'house',
        'parent' => 'Accommodation'
      ),
      array(
        'name' => 'Room',
        'slug' => 'room',
        'parent' => 'Accommodation'
      ),
      array(
        'name' => 'Suite',
        'slug' => 'suite',
        'parent' => 'Accommodation'
      ),
    array(
      'name' => 'AdministrativeArea',
      'slug' => 'administrative-area',
      'parent' => 'Place'
    ),
    array(
      'name' => 'CivicStructure',
      'slug' => 'civic-structure',
      'parent' => 'Place'
    ),
    array(
      'name' => 'Landform',
      'slug' => 'landform',
      'parent' => 'Place'
    ),
    array(
      'name' => 'LandmarksOrHistoricalBuildings',
      'slug' => 'landmarks-or-historical-buildings',
      'parent' => 'Place'
    ),
    array(
      'name' => 'Residence',
      'slug' => 'residence',
      'parent' => 'Place'
    ),
    array(
      'name' => 'TouristAttraction',
      'slug' => 'tourist-attraction',
      'parent' => 'Place'
    ),
  );

  foreach ($taxonomies as $taxonomy) {
    $parent_term = term_exists( $taxonomy['parent'], 'place-type' ); // array is returned if taxonomy is given
    $parent_term_id = $parent_term['term_id'];

    if( !term_exists( $taxonomy['name'], 'place-type' ) ) {
      wp_insert_term(
        $taxonomy['name'],
        'place-type',
        array(
          'description' => $taxonomy['name'] . ' as described by Schema.org.',
          'slug'        => $taxonomy['slug'],
          'parent'      => $parent_term_id
        )
      );
    }
  }
}

add_action( 'init', 'gcplaces_create_places_terms', 0 );

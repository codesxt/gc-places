<?php

add_action( 'admin_menu', 'gcplaces_menu' );

function gcplaces_menu() {
	add_menu_page(
    'Great Chile Places',
    'GC Places',
    'manage_options',
    'gc-places/gc-places-admin-page.php',
    'gcplaces_admin_page',
    'dashicons-media-code',
    null
  );
}

function gcplaces_admin_page(){
	?>
	<div class="wrap">
		<h1>Great Chile Places</h1>
    <p>
      Aquí se documenta el functionamiento del plugin Great Chile Places,
      desarrollado para añadir funcionalidades al sitio Great Chile.
    </p>
    <h2>Shortcodes</h2>
    <p>
      A continuación se listan los shortcodes definidos por este plugin y
      sus parámetros respectivos.
    </p>

    <h3>[place_map]</h3>
    <p>
      Se usa en la página de un post tipo Place.
      Muestra un mapa con la ubicación del post.
    </p>
    <table class="plainview_sdk_table widefat">
    	<thead>
    		<tr>
    			<th>Parámetro</th>
          <th>Opcional</th>
          <th>Ejemplo</th>
    			<th>Descripción</th>
    		</tr>
    	</thead>
    	<tbody>
        <tr>
          <td>post_id</td>
          <td>Opcional</td>
    			<td>123</td>
    			<td>
            Define el post del que se mostrará la ubicación.
            Si se omite, se utilizará el post de la página actual.
          </td>
    		</tr>
    		<tr>
          <td>height</td>
          <td>Opcional</td>
    			<td>400px</td>
    			<td>
            Define la altura del mapa.
          </td>
    		</tr>
    	</tbody>
    </table>

    <h3>[car_pickup_dropoff_map]</h3>
    <p>
      Se usa en la página de un post tipo Car.
      Muestra un mapa las ubicaciones de Pickup y Dropoff.
    </p>
    <table class="plainview_sdk_table widefat">
    	<thead>
    		<tr>
    			<th>Parámetro</th>
          <th>Opcional</th>
          <th>Ejemplo</th>
    			<th>Descripción</th>
    		</tr>
    	</thead>
    	<tbody>
    		<tr>
          <td>height</td>
          <td>Opcional</td>
    			<td>400px</td>
    			<td>
            Define la altura del mapa.
          </td>
    		</tr>
    	</tbody>
    </table>

    <h3>[all_places_map]</h3>
    <p>
      Se usa en cualquier página.
      Muestra un mapa las ubicaciones de todos los post tipo Place registrados.
    </p>
    <table class="plainview_sdk_table widefat">
    	<thead>
    		<tr>
    			<th>Parámetro</th>
          <th>Opcional</th>
          <th>Ejemplo</th>
    			<th>Descripción</th>
    		</tr>
    	</thead>
    	<tbody>
    		<tr>
          <td>height</td>
          <td>Opcional</td>
    			<td>400px</td>
    			<td>
            Define la altura del mapa.
          </td>
    		</tr>
    	</tbody>
    </table>
	</div>
	<?php
}

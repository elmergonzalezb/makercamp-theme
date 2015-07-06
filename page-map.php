<?php /* Template Name: Find a camp page */ ?>

<?php get_header(); ?>

	<section class="banner">
		<div class="container-fluid">
			<h1>Find a camp</h1>

			<p>Maker Camp is an online summer camp that happens everywhere around the world. But you can meet your neighbors
				who are taking part in Maker Camp too! Many libraries, makerspaces, and community centers are hosting Maker
				Camps for the kids in their communities.
			</p>
		</div>
	</section>

	<section class="camps-map">
		<h1 class="container-fluid">Is there a campsite close to you? Join the fun </h1>
		<iframe src="https://www.google.com/maps/d/embed?mid=znSdL4uF4CiE.k7sHDldZCKys"></iframe>
		<div class="container-fluid">
			<h1 class="hide-in-mobile container-fluid">... or start a new campsite</h1>

			<p>If you can’t find a nearby site in the list or the map, talk to your local library, makerspace, Boys & Girls Club,
				or community center about hosting Maker Camp for the kids in your community. Maker Camp Affiliate
				Sites receive a package of materials for making and for promoting the camp, while supplies last. Remember that
				whether or not you are able to find an organization to host Maker Camp, you can still be a part of Maker Camp no
				matter where you are, because it is online and free!
			</p>
		</div>
	</section>

<?php
/**
 * Get all addresses from json file
 */
$addresses = json_decode( file_get_contents( dirname( __FILE__ ) . '/camp_addresses.json' ), TRUE );

/**
 * Sort the JSON array by country
 */
usort( $addresses, function ( $a, $b ) {
	return strcmp( $a[ "Country" ], $b[ "Country" ] );
} );
?>

	<section class="camp-search">
		<div class="container-fluid">
			<div class="form-group camp-filters clearfix">
				<div class="form-group has-feedback">
					<input type="search" class="form-control camp-list-search" placeholder="Search affiliates" id="inputSuccess2" />
					<span class="glyphicon glyphicon-search form-control-feedback"></span>
				</div>

				<div class="btn-group camp-list-filter">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Country <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Show all</a>
						</li>
						<?php
						if ( ! empty( $addresses ) && is_array( $addresses ) ) :
							$echoed_countries     = array();
							$echoed_continents    = array();
							$countries_continents = array();
							foreach ( $addresses as $key => $address ) : ?>
								<?php
								if ( in_array( $address[ 'Country' ], $echoed_countries ) ) {
									continue;
								}

								$countries_continents[ $key ][ 'Country' ]   = $echoed_countries[ ] = $address[ 'Country' ];
								$countries_continents[ $key ][ 'Continent' ] = $address[ 'Continent' ];
								?>

								<li>
									<a href="#"><?php echo $address[ 'Country' ]; ?></a>
								</li>
							<?php endforeach;

						endif;
						?>
					</ul>
				</div>

				<div class="btn-group camp-list-filter-continents">
					<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Continent <span class="caret"></span>
					</button>
					<ul class="dropdown-menu">
						<li>
							<a href="#">Show all</a>
						</li>
						<?php
						if ( ! empty( $addresses ) && is_array( $addresses ) ) :
							$echoed_continents = array();
							foreach ( $addresses as $address ) : ?>
								<?php
								if ( in_array( $address[ 'Continent' ], $echoed_continents ) ) {
									continue;
								}
								$echoed_continents[ ] = $address[ 'Continent' ];
								?>

								<li>
									<a href="#"><?php echo $address[ 'Continent' ]; ?></a>
								</li>
							<?php endforeach;
						endif;
						?>
					</ul>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-striped map-list" data-countries-continents="<?php echo htmlentities( json_encode( $countries_continents ) ); ?>" data-addresses="<?php echo htmlentities( json_encode( $addresses ) ); ?>">
					<thead class="map-list-header">
					<tr>
						<th style="width:55px;">Country</th>
						<th style="width:50px;">State</th>
						<th style="width:80px;">Postal code</th>
						<th style="width:140px;">City</th>
						<th style="width:258px;">Organization</th>
						<th style="width:81px;">Accepting</th>
					</tr>
					</thead>
					<tbody>
					<?php
					if ( ! empty( $addresses ) && is_array( $addresses ) ) :
						foreach ( $addresses as $address ) : ?>
							<tr>
								<td><?php echo $address[ 'Country' ]; ?></td>
								<td><?php echo $address[ 'State' ]; ?></td>
								<td><?php echo $address[ 'Postal Code' ]; ?></td>
								<td><?php echo $address[ 'City' ]; ?></td>
								<td>
									<a href="<?php echo $address[ 'Website' ]; ?>"><?php echo $address[ 'Company' ]; ?></a>
								</td>
								<td><?php echo $address[ 'Accepting' ]; ?></td>

							</tr>
						<?php endforeach;
					endif;
					?>
					</tbody>
				</table>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
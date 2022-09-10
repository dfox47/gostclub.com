
<?php // map
$mapX = '55.7470937';
$mapY = '37.5372205'; ?>

<div id="contacts_map" class="contacts_map"></div>

<script src="//api-maps.yandex.ru/2.1/?apikey=eed2b879-5209-4581-8167-71583aa7db36&lang=ru_RU"></script>

<script>
	ymaps.ready(function () {
		var map = new ymaps.Map('contacts_map', {
			center: [<?=$mapX;?>, <?=$mapY;?>],
			'stylers': {
				"hue": "#ddb472",
				'lightness': 1
			},
			zoom: 13
		});

		map.geoObjects.add(new ymaps.Placemark([<?=$mapX;?>, <?=$mapY;?>], {
				//hintContent: "<?//=$googleAdress;?>//"
			},{
				iconLayout: 'default#imageWithContent',
				iconImageHref: '/wp-content/themes/broker2022/i/icons/map.svg',
				iconImageSize: [30, 42],
				iconImageOffset: [-15, -42]
			})
		);
	});

	function initMapContacts() {
		let mapDiv = document.querySelector('.contacts_mapX')

		if (!mapDiv) return

		// coordinates
		let myLatLng = {
			lat: <?php echo $mapX ?>,
			lng: <?php echo $mapY ?>
		};

		// edit class for a map
		let map = new google.maps.Map(document.querySelector('.contacts_mapX'), {
			center:     myLatLng,
			zoom:       15
		});

		// styles | examples https://snazzymaps.com/
		let styles = [
			{
				"featureType": "administrative",
				"elementType": "labels.text.fill",
				"stylers": [
					{
						"color": "#444444"
					}
				]
			},
			{
				"featureType": "landscape",
				"elementType": "all",
				"stylers": [
					{
						"color": "#f2f2f2"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road",
				"elementType": "all",
				"stylers": [
					{
						"saturation": -100
					},
					{
						"lightness": 45
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "labels.icon",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "all",
				"stylers": [
					{
						"color": "#ddb472"
					},
					{
						"visibility": "on"
					}
				]
			}
		];

		// styles to map
		map.setOptions({styles: styles});

		// marker on map [START]
		let imgHeight   = 26
		let imgWidth    = 22

		let image = {
			url: '/wp-content/themes/broker2022/i/icons/map.svg',
			size: new google.maps.Size(imgWidth, imgHeight),
			origin: new google.maps.Point(0, 0),
			anchor: new google.maps.Point(imgWidth / 2, imgHeight)
		};
		// marker on map [END]

		// тут создается блок, всплывающий по клику на маркер. Удобен чтоб добавить небольшой текст-описание или подсказку.
		let contentString = '<div id="map-content">' +
			'<div id="siteNotice">' +
			'</div>' +
			'<h2 id="firstHeading" class="firstHeading"></h2>' +
			'<div id="bodyContent"></div>' +
			'</div>';

		let infowindow = new google.maps.InfoWindow({
			content: contentString,
			maxWidth: 270
		});

		// здесь создается сам маркер и применяются параметры отображения
		let marker = new google.maps.Marker({
			animation:  google.maps.Animation.DROP,
			icon:       image,
			map:        map,
			position:   myLatLng,
			title:      '....'
		});

		let myOptions = {
			draggable: !("ontouchend" in document)
		};

		marker.addListener('click', function () {
			infowindow.open(map, marker);
		});
	}
</script>

<!--<script async src="//maps.googleapis.com/maps/api/js?key=--><?php //echo googleMapsApi; ?><!--&callback=initMapContacts"></script>-->

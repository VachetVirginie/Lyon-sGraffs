<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Title Page</title>

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
        <style>
        body{
            /* padding-top: 50px; */
        }
        #map{
            width: 100%;
            height: 600px;
            color:black;
            margin-top:25px;
       
        }
        #bodyContent{
            width:50%;
            height:50%;
        }
        </style>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="htttps://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    

        @yield('content')

        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

         <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDE24Sg4vYQzgP4y_Fq0fMw1iG_en6dgnU&signed_in=true&libraries=places"></script> 


        <script src="{{asset('js/jquery.geocomplete.js')}}"></script>

        <script> $('#address').geocomplete();</script>

        <script>

        </script>

        @if(Request::is('locations'))

            <script type="text/javascript">
            
        
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat: 45.753319, lng: 4.8599179},
                 styles:[ { "elementType": "geometry", "stylers": [ { "color": "#ebe3cd" } ] }, { "elementType": "labels.text.fill", "stylers": [ { "color": "#523735" } ] }, { "elementType": "labels.text.stroke", "stylers": [ { "color": "#f5f1e6" } ] }, { "featureType": "administrative", "elementType": "geometry.stroke", "stylers": [ { "color": "#c9b2a6" } ] }, { "featureType": "administrative.land_parcel", "elementType": "geometry.stroke", "stylers": [ { "color": "#dcd2be" } ] }, { "featureType": "administrative.land_parcel", "elementType": "labels.text.fill", "stylers": [ { "color": "#ae9e90" } ] }, { "featureType": "landscape.natural", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "poi", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "poi", "elementType": "labels.text.fill", "stylers": [ { "color": "#93817c" } ] }, { "featureType": "poi.park", "elementType": "geometry.fill", "stylers": [ { "color": "#a5b076" } ] }, { "featureType": "poi.park", "elementType": "labels.text.fill", "stylers": [ { "color": "#447530" } ] }, { "featureType": "road", "elementType": "geometry", "stylers": [ { "color": "#f5f1e6" } ] }, { "featureType": "road.arterial", "elementType": "geometry", "stylers": [ { "color": "#fdfcf8" } ] }, { "featureType": "road.highway", "elementType": "geometry", "stylers": [ { "color": "#f8c967" } ] }, { "featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [ { "color": "#e9bc62" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry", "stylers": [ { "color": "#e98d58" } ] }, { "featureType": "road.highway.controlled_access", "elementType": "geometry.stroke", "stylers": [ { "color": "#db8555" } ] }, { "featureType": "road.local", "elementType": "labels.text.fill", "stylers": [ { "color": "#806b63" } ] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "transit.line", "elementType": "labels.text.fill", "stylers": [ { "color": "#8f7d77" } ] }, { "featureType": "transit.line", "elementType": "labels.text.stroke", "stylers": [ { "color": "#ebe3cd" } ] }, { "featureType": "transit.station", "elementType": "geometry", "stylers": [ { "color": "#dfd2ae" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#b9d3c2" } ] }, { "featureType": "water", "elementType": "labels.text.fill", "stylers": [ { "color": "#92998d" } ] } ]
                //style carte
                
            });

            var bounds = new google.maps.LatLngBounds();
            
            var listInfoWindow = []

            @if($points)

                @isset($points[0]) 
                    var myLatLng = {lat: {{$points[0]->lat}}, lng: {{$points[0]->lng}}};
                    map.setCenter(myLatLng);
                    bounds.extend(myLatLng);
                    
                @endisset

                @foreach($points as $point)
                    var position = new google.maps.LatLng({{$point->lat}}, {{$point->lng}});
                    var marker{{$point->id}} = new google.maps.Marker({
                        position: position,
                        map: map,
                        title: '{{$point->name}}',
                         icon: {
       path: google.maps.SymbolPath.BACKWARD_CLOSED_ARROW,
  
       scale: 3,
    //   strokeColor: '' //style marker
    },
 
                    });

                    bounds.extend(position);
                    
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">{{$point->name}}</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Adresse: {{$point->name}}</b>.</p>'+
            '<p>"<img src="{{ asset('thumbs/' . $point->image->name) }}">"</p>'+
            '</div>'+
            '</div>';

                    var infowindow{{$point->id}} = new google.maps.InfoWindow({
                        content:contentString
                         //"{{$point->name}}". "<img  style='width:20px;height:20px;'src='{{ asset('thumbs/' . $point->image->name) }}'>"
                        });

                        // listInfoWindow.push(infowindow{{$point->id}});
                        

                        marker{{$point->id}}.addListener('mouseover', function() {
                            // hideAllInfoWindow();
                            infowindow{{$point->id}}.open(map, marker{{$point->id}});
                        });
 
                   
                    
                @endforeach
            @endif
           
            map.fitBounds(bounds);

            </script>

        @endif
    </body>
</html>
<?php
include 'includes/connect.php';
if($_SESSION['delivery_sid']==session_id())
{
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Locate Address</title>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4jFCoT3S8jZACU-7JoH3R3T1UxRdbGxo&callback=initMap&libraries=places&v=weekly"
                defer
        ></script>
        <style type="text/css">
            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
            #map {
                height: 100%;
            }

            /* Optional: Makes the sample page fill the window. */
            html,
            body {
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .controls {
                margin-top: 10px;
                border: 1px solid transparent;
                border-radius: 2px 0 0 2px;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                height: 32px;
                outline: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
            }

            #origin-input,
            #destination-input {
                background-color: #fff;
                font-family: Roboto;
                font-size: 15px;
                font-weight: 300;
                margin-left: 12px;
                padding: 0 11px 0 13px;
                text-overflow: ellipsis;
                width: 200px;
            }

            #origin-input:focus,
            #destination-input:focus {
                border-color: #4d90fe;
            }

            #mode-selector {
                color: #fff;
                background-color: #4d90fe;
                margin-left: 12px;
                padding: 5px 11px 0px 11px;
            }

            #mode-selector label {
                font-family: Roboto;
                font-size: 13px;
                font-weight: 300;
            }
        </style>
        <script>
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script
            // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
            function initMap() {
                const map = new google.maps.Map(document.getElementById("map"), {
                    mapTypeControl: false,
                    center: { lat: -33.8688, lng: 151.2195 },
                    zoom: 16,
                    fullscreenControl: false,
                    streetViewControl: false,
                    zoomControl: false,
                });
                new AutocompleteDirectionsHandler(map);
            }

            class AutocompleteDirectionsHandler {
                constructor(map) {
                    this.map = map;
                    this.originPlaceId = "";
                    this.destinationPlaceId = "";
                    this.travelMode = google.maps.TravelMode.WALKING;
                    this.directionsService = new google.maps.DirectionsService();
                    this.directionsRenderer = new google.maps.DirectionsRenderer();
                    this.directionsRenderer.setMap(map);
                    const originInput = document.getElementById("origin-input");
                    const destinationInput = document.getElementById("destination-input");
                    const modeSelector = document.getElementById("mode-selector");
                    const originAutocomplete = new google.maps.places.Autocomplete(
                        originInput
                    );
                    // Specify just the place data fields that you need.
                    originAutocomplete.setFields(["place_id"]);
                    const destinationAutocomplete = new google.maps.places.Autocomplete(
                        destinationInput
                    );
                    // Specify just the place data fields that you need.
                    destinationAutocomplete.setFields(["place_id"]);
                    this.setupClickListener(
                        "changemode-walking",
                        google.maps.TravelMode.WALKING
                    );
                    this.setupClickListener(
                        "changemode-transit",
                        google.maps.TravelMode.TRANSIT
                    );
                    this.setupClickListener(
                        "changemode-driving",
                        google.maps.TravelMode.DRIVING
                    );
                    this.setupPlaceChangedListener(originAutocomplete, "ORIG");
                    this.setupPlaceChangedListener(destinationAutocomplete, "DEST");
                    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
                        originInput
                    );
                    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
                        destinationInput
                    );
                    this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(
                        modeSelector
                    );
                }
                // Sets a listener on a radio button to change the filter type on Places
                // Autocomplete.
                setupClickListener(id, mode) {
                    const radioButton = document.getElementById(id);
                    radioButton.addEventListener("click", () => {
                        this.travelMode = mode;
                        this.route();
                    });
                }
                setupPlaceChangedListener(autocomplete, mode) {
                    autocomplete.bindTo("bounds", this.map);
                    autocomplete.addListener("place_changed", () => {
                        const place = autocomplete.getPlace();

                        if (!place.place_id) {
                            window.alert("Please select an option from the dropdown list.");
                            return;
                        }

                        if (mode === "ORIG") {
                            this.originPlaceId = place.place_id;
                        } else {
                            this.destinationPlaceId = place.place_id;
                        }
                        this.route();
                    });
                }
                route() {
                    if (!this.originPlaceId || !this.destinationPlaceId) {
                        return;
                    }
                    const me = this;
                    this.directionsService.route(
                        {
                            origin: { placeId: this.originPlaceId },
                            destination: { placeId: this.destinationPlaceId },
                            travelMode: this.travelMode,
                        },
                        (response, status) => {
                            if (status === "OK") {
                                me.directionsRenderer.setDirections(response);
                            } else {
                                window.alert("Directions request failed due to " + status);
                            }
                        }
                    );
                }
            }
        </script>
    </head>
    <body>
    <div style="display: none">
        <input
                    id="origin-input"
                    class="controls"
                    type="text"
                    placeholder="Enter origin location"
            />

            <input
                    id="destination-input"
                    class="controls"
                    type="text"
                    placeholder="Enter destination location"
            />
        <div id="mode-selector" class="controls" style="background-color: #a21318;">
            <input
                    type="radio"
                    name="type"
                    id="changemode-walking"
                    hidden
            />
            <a name="back" id="back" href="delivery-dashboard.php" style="font-size: 20px;text-decoration: none;color: white;width: 100%;height: 100%;">X</a>
            <input type="radio" name="type" id="changemode-transit" hidden />
            <label for="changemode-transit" hidden>Transit</label>

            <input type="radio" name="type" id="changemode-driving" checked="checked" hidden />
            <label for="changemode-driving" hidden>Driving</label>
        </div>
    </div>
    <div id="map"></div>
    </body>
    </html>

    <?php
}
else
{
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin.php");
    }
    else{
        header("location:login.php");
    }
}
?>
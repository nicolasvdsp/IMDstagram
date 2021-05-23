let currentCity = document.querySelector('#location');
getLocation();

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getLatLong);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function getLatLong(position) {
    let lat = position.coords.latitude;
    console.log(lat); 
    let long = position.coords.longitude;
    console.log(long); 

    getCity(lat, long);
}

function getCity(lat, long){
    let key = "830f3a3c0fdb4b1fbaae8e1d5e96373f";
    let url = `https://api.opencagedata.com/geocode/v1/json?q=${lat}+${long}&pretty=1&key=${key}`;

    fetch(url).then((response) => {
        return response.json();
    }).then((json) => {
        console.log(json);

        let city = json.results['0'].components['town'];
        console.log(city);
        
        document.querySelector('#location').value = city;
    });
    
    
}
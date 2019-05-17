var res = new Array();
var startPos;
var geoOptions = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 5 * 60 * 1000
}

var geoSuccess = function(position) {
  res[0] = position.coords.latitude;
  res[1] = position.coords.longitude;
  if (res)
  {
    updateLocation(res, 0);
  }
  else{
    updateLocation([0, 0], 1);
  }
};
var geoError = function(error) {
    console.debug('getting from IP');
    updateLocation([0, 0], 1);
};

function getUserLocation()
{
    navigator.geolocation.getCurrentPosition(geoSuccess, geoError, geoOptions);
}

function updateLocation( pos, errno )
{

    $.ajax({
        url: '/index.php/location/updatelocation',
        type: 'POST',
        data: {
            lon: pos[0],
            lat: pos[1],
            err: errno
        }
    }).done(function(data){
            console.log('pos updated ' + data);
    }).fail(
      function(error)
      {
        console.log(error.responseText);
      }
    );
}
console.log('Getlocation');
getUserLocation();
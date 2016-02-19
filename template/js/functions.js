function locate() {
  $.get('http://172.17.10.24:8080/master/map/locate', function(object){
      alert('location: '+object.location);
  });
}

function resume(state) {
    $.ajax({
        url: 'http://172.17.10.24:8080/master/session/set/state/'+state+'',
        dataType: 'json',
        timeout: 3000,
        success: function(data) {
            var obj = jQuery.parseJSON(JSON.stringify(data));
            console.log(obj.stateChanged)
            if(!obj.stateChanged) {
                alert('Session state resumed.');
                window.location.href = "master.php?resume=true";
            }
        }, error: function() {
            alert('Error getting state from session...');
        }
    });
}

function stopSession() {
  $.get('/master/session/stop', function(object){
      alert(object.state);
  });
}
function createPassword() {
  console.log("inside create");
  alert("inside create");
}

function startSession() {
  $.get('http://172.17.10.24:8080/master/session/state', function(object){
      alert('Session state: '+object.state);
      window.location.href = '/master/location.html';
  });
}

function stopSession() {
  $.get('/master/session/stop', function(object){
      alert(object.state);
  });
}

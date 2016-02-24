var serverLink = 'http://localhost:8080';

function startSession() {
  $.get(serverLink+'/master/session/state', function(object){
      alert('Session state: '+object.state);
      window.location.href = '/master/location.html';
  });
}

function stopSession() {
  $.get('/master/session/stop', function(object){
      alert(object.state);
  });
}

function endsWith(str, suffix) {
    return str.indexOf(suffix, str.length - suffix.length) !== -1;
}

jQuery(document).ready(function($) {
  // Check if the cookie is set and set the switch accordingly
  var switchElem = $('#my-switch-toggle');
  var pageMainContainer = $('html');

  // Handle switch change event
  switchElem.change(function() {
    if ($(this).prop('checked')) {
      // Set the cookie to true
      enableCSS('blocksy-darkmode-colors-css-css');
      setCookie('dark_mode', 'true', 7);
      pageMainContainer.addClass('temp-enable-css');
    } else {
      // Set the cookie to false
      disableCSS('blocksy-darkmode-colors-css-css');
      setCookie('dark_mode', 'false', 7);
      pageMainContainer.removeClass('temp-enable-css');
    }
    console.log($(this).prop('checked'));
  });

  if (getCookie('dark_mode') == 'true') {
    enableCSS('blocksy-darkmode-colors-css-css');
    switchElem.prop('checked', true);
  } else {
    disableCSS('blocksy-darkmode-colors-css-css');
    switchElem.prop('checked', false);
  }
function disableCSS(id) {
  $('#' + id).prop('disabled', true);
}

function enableCSS(id) {
  $('#' + id).prop('disabled', false);
}

function getCookie(name) {
  var cookies = document.cookie.split(';');
  for (var i = 0; i < cookies.length; i++) {
    var cookie = cookies[i].trim();
    if (cookie.indexOf(name + '=') == 0) {
      return cookie.substring(name.length + 1);
    }
  }
  return '';
}

function setCookie(name, value, days) {
  var date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  var expires = 'expires=' + date.toUTCString();
  document.cookie = name + '=' + value + '; ' + expires + '; path=/';
}

});


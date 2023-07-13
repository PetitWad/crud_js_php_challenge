$(document).ready(() => {
  $('#logUser').submit((e) => {
    e.preventDefault();

    var dataForm = $('#logUser')[0];
    var formData = new FormData(dataForm);
    $.ajax({
      url: "http://localhost/crud_js_php/src/controller/logController.php",
      type: "POST",
      dataType: "json",
      cache: false,
      contentType: false,
      processData: false,
      data: formData,

      success: function (response) {
        if (response.status === true) {
          $("#logUser")[0].reset();
          Toastify({
            text: response.message,
            duration: 3000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
              background: "linear-gradient(to right, #00b09b, #96c93d)"
            }
          }).showToast();

          window.location.replace(
            "http://localhost/crud_js_php/src/home.php"
          );
        } else {
          Toastify({
            text: response.message,
            duration: 5000,
            close: true,
            gravity: "top",
            position: "right",
            stopOnFocus: true,
            style: {
              background: "linear-gradient(to right, rgba(255,0,0,1), rgba(255,0,0,0.5))"
            }
          }).showToast();
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      }
    });
  });
});

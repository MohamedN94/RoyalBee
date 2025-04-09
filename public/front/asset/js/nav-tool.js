var jqToast = (function ($) {
    // create the container if it doesn't exist
    var $toastContainer = $('.toast-container');
    if ($toastContainer.length === 0) {
      $('body').append($('<div>').addClass('toast-container'));
    }

    var getOptions = function (opts) {
      return $.extend({},
      {
        displayTime: 3000,
        fadeTime: 1750,
        text: ''
      },
      opts);
    };

    var closeToast = function ($toast, fadeTime) {
      // Add the fading class and remove the 'click' binding
      $toast
        .addClass('fading')
        .off('click');

      // Fade the toast message out and remove it
      $toast.fadeOut(fadeTime, function () {
        //$toast.remove();
      });
    }

    var addToast = function (type, options) {
      var iconName = '';
      // Determine icon type
      switch (type) {
        case 'success':
          iconName = 'fa-check';
          break;
        case 'error':
          iconName = 'fa-times';
          break;
      }

      // Build the icon element
      var $icon = $('<div>').addClass('icon').append($('<i>').addClass('fa ' + iconName));

      // Build the toast message and add it to the container
      var $toast = $('<div>')
        .addClass('toast ' + type)
        .append($icon)
        .append($('<div>').addClass('text').text(options.text));

      $('.toast-container').append($toast);

      // Close the toast message
      $toast.on('click', function () {
        closeToast($toast, options.fadeTime);
      });

      // Automatic fade
      setTimeout(function () {
        closeToast($toast, options.fadeTime);
      }, options.displayTime);
    }

    var successToast = function (opts) {
      var options = getOptions(opts);
      addToast('success', options);
    }

    var errorToast = function (opts) {
      var options = getOptions(opts);
      addToast('error', options);
    }

    return {
      success: function (opts) {
        successToast(opts);
      },
      error: function (opts) {
        errorToast(opts);
      }
    }
  })(jQuery);

  $(document).ready(function () {
    $('.addToCart').on('click', function (e) {
      $(this).closest(".option-item").removeClass("active");
      var fadeTime = $('#txtFadeTime').val() || 1750;
      var text = "تم اضافة للعربة بنجاح";
      var type = 'success';

      var toastMethod = (type === 'success')
        ? jqToast.success
        : jqToast.error;

      toastMethod({
        fadeTime: fadeTime,
        text: text
      });
    });
  });

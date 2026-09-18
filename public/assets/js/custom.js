const SwalDelete = (formSubmit) => {
  // console.log(formSubmit.html());
  Swal.fire({
    title: 'Confirmation!',
    text: 'Are you sure to delete this data?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1',
    },
    buttonsStyling: false,
  }).then(function (result) {
    if (result.value) {
      formSubmit.submit();
    }
  });
};

const SwalDeleteSelected = (formSubmit) => {
  ValChecked = [];
  $('.CheckboxRow:checked').each(function () {
    ValChecked.push($(this).attr('data-id'));
  });
  formSubmit.find('.id_hidden').remove();
  setTimeout(() => {
    $.each(ValChecked, function (index, value) {
      formSubmit.append(
        $('<input>')
          .attr('type', 'hidden')
          .attr('class', 'id_hidden')
          .attr('name', 'id[]') // Menambahkan "[]" pada nama untuk mengirim sebagai array di server
          .val(value)
      );
      // .appendTo('#form-update-multiple');
    });
  }, 0);
  Swal.fire({
    title: 'Confirmation!',
    text: 'Are you sure to delete this data?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya',
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-outline-danger ms-1',
    },
    buttonsStyling: false,
  }).then(function (result) {
    if (result.value) {
      formSubmit.submit();
    }
  });
};

const CheckTotalChecked = (elementIds) => {
  var TotalOfCheckBoxRow = $('input.CheckboxRow').length;
  var TotalOfChecked = $('input.CheckboxRow:checked').length;
  if (TotalOfChecked > 0) {
    elementIds.forEach((id) => {
      $(id).removeClass('disabled');
    });
    if (TotalOfCheckBoxRow == TotalOfChecked) {
      $('#CheckAll').prop('checked', true);
    } else {
      $('#CheckAll').prop('checked', false);
    }
  } else {
    elementIds.forEach((id) => {
      $(id).addClass('disabled');
    });
    $('#CheckAll').prop('checked', false);
  }
};

// Untuk upload file 
  let accountUserImage = document.getElementById('uploadedAvatar');
  const fileInput = document.querySelector('.account-file-input'),
      resetFileInput = document.querySelector('.account-image-reset');

  if (accountUserImage) {
      const resetImage = accountUserImage.src;
      fileInput.onchange = () => {
          if (fileInput.files[0]) {
              accountUserImage.src = window.URL.createObjectURL(fileInput.files[0]);
          }
      };
      resetFileInput.onclick = () => {
          fileInput.value = '';
          accountUserImage.src = resetImage;
      };
  }
//

$(document).ready(function () {
  if ($.fn.flatpickr) {
    $(".flatpickr").flatpickr({
      enableTime: true,
      dateFormat: 'Y-m-d H:i'
    });
  }
  // $('#form').submit(function (e) {
  //   $(this).find('button[type=submit]').prop('disabled', true);
  //   this.submit();
  // });
});

(function () {
  const clipboardList = [].slice.call(
    document.querySelectorAll('.clipboard-btn')
  );
  if (typeof ClipboardJS !== 'undefined') {
    clipboardList.map(function (clipboardEl) {
      const clipboard = new ClipboardJS(clipboardEl);
      clipboard.on('success', function (e) {
        if (e.action == 'copy') {
          toastr['success']('', 'Copied to Clipboard!!');
        }
      });
    });
  } else {
    clipboardList.map(function (clipboardEl) {
      clipboardEl.setAttribute('disabled', true);
    });
  }

  const popoverTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="popover"]')
  );
  const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  var numeralMasks = document.querySelectorAll('.numeral-mask');
  numeralMasks.forEach(function (numeralMask) {
    new Cleave(numeralMask, {
      numeral: true,
      numeralThousandsGroupStyle: 'thousand',
      numeralDecimalMark: ',',
      delimiter: '.',
    });
  });

  
})();


function debounce(func, wait) {
  let timeout;
  return function() {
      const context = this, args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(() => func.apply(context, args), wait);
  };
}
jQuery(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
    },
  });

  $('a#productCartDelete').on('click', function (event) {
    event.preventDefault();
    // get the uuid from link's data-id prop
    let id = $(this).attr('data-id');
    // get closest row
    let row = $(this).closest('tr');

    if (id != undefined) {
      $.ajax({
        url: '/cart/' + id,
        type: 'DELETE',
        data: {
          id: id,
        },
        dataType: 'json',
        success: function () {
          row.remove();
          id, (row = undefined);
        },
        error: function (data) {
          console.log(data.errors);
          id, (row = undefined);
        },
      });
    }
  });

  $('a#procuctSender').on('click', function (event) {
    event.preventDefault();
    let id = $(this).attr('data-id');

    if (id !== undefined) {
      $.ajax({
        url: '/cart',
        type: 'POST',
        data: {
          id: id,
        },
        dataType: 'json',
        success: function () {
          $('div#productSuccessAlert').show();
          window.setTimeout(() => {
            $('div#productSuccessAlert')
              .fadeTo(500, 0)
              .slideUp(500, function () {
                $(this).hide();
              });
          }, 4000);

          id = undefined;
        },
        error: function (data) {
          console.log('Error: ', data.responseJSON.errors);
          $('div#productErrorAlert').show();
          window.setTimeout(function () {
            $('div#productErrorAlert')
              .fadeTo(500, 0)
              .slideUp(500, function () {
                $(this).hide();
              })
              .toggle();
          }, 4000);
          id = undefined;
        },
      });
    }
  });

  $('button#product_delete').on('click', function () {
    $('div#productDeleteModal').modal({
      backdrop: 'static',
      keyboard: false,
      show: true,
    });

    let id = $(this).attr('value');
    let satir = $(this).closest('tr');

    $('button#confirmProductDelete').on('click', function () {
      if (id !== undefined && satir !== undefined) {
        $.ajax({
          url: '/products/' + id,
          type: 'DELETE',
          data: {
            satir: id,
          },
          dataType: 'json',
          success: function (data) {
            if (data.success) {
              satir.remove();
            }
            id, (satir = undefined);
          },
          error: function (data) {
            console.log('Error: ', data.responseJSON.errors);
            id, (satir = undefined);
          },
        });
      }
    });

    $('button#confirmCancelProductDelete').on('click', function () {
      id, (satir = undefined);
    });

    $('button#confirmCloseProductDelete').on('click', function () {
      id, (satir = undefined);
    });
  });

  $('button#category_delete').on('click', function () {
    $('div#categoryDeleteModal').modal({
      backdrop: 'static',
      keyboard: false,
      show: true,
    });

    let id = $(this).attr('value');
    let satir = $(this).closest('tr');

    $('button#confirmCategoryDelete').on('click', function () {
      if (id !== undefined && satir !== undefined) {
        $.ajax({
          url: '/categories/' + id,
          type: 'DELETE',
          data: {
            satir: id,
          },
          dataType: 'json',
          success: function (data) {
            if (data.success) {
              satir.remove();
            }
            id, (satir = undefined);
          },
          error: function (data) {
            console.log('Error: ', data.responseJSON.errors);
            id, (satir = undefined);
          },
        });
      }
    });

    $('button#confirmCancelCategoryDelete').on('click', function () {
      id, (satir = undefined);
    });

    $('button#confirmCloseCategoryDelete').on('click', function () {
      id, (satir = undefined);
    });
  });

  $('button#product_edit').on('click', function () {
    $('div#productEditModal').modal({
      backdrop: 'static',
      keyboard: false,
      show: true,
    });

    let id = $(this).attr('value');
    let satir = $(this).closest('tr');

    $.ajax({
      url: '/singleProduct/' + id,
      type: 'GET',
      data: {
        satir: id,
      },
      dataType: 'json',
      success: function (data) {
        if (data.success) {
          $('input#productName').val(data.success.product_name);
          $('input#description').val(data.success.description);
          $('input#price').val(data.success.price);

          var opt = `<option value="${data.success.category_id}">${data.success.category_name}</option>`;
          $('select#category_id').append(opt);
          // $.each(data.success, function () {
          //   var opt = `<option value="${this.category_id}">${this.category_name}</option>`;
          //   $('select#category_id').append(opt);
          // });

          //$('select#category_id').val(data.success.category_name);
          console.log(data.success.product_id);
        }
        id, (satir = undefined);
      },
      error: function (data) {
        console.log('Error: ', data.responseJSON.errors);
        id, (satir = undefined);
      },
    });

    $('button#confirmProductEdit').on('click', function () {
      if (id !== undefined && satir !== undefined) {
        $.ajax({
          url: '/singleProduct/' + id,
          type: 'GET',
          data: {
            satir: id,
          },
          dataType: 'json',
          success: function (data) {
            if (data.success) {
              var tr = `<tr id="${data.success.product_id}"><td>${data.success.product_id}</td><td>${data.success.product_name}</td></tr>`;
              $('#tbody').append(tr);
              console.log(data.success.product_id, tr);
            }
            id, (satir = undefined);
          },
          error: function (data) {
            console.log('Error: ', data.responseJSON.errors);
            id, (satir = undefined);
          },
        });
      }
    });

    $('button#confirmCancelProductEdit').on('click', function () {
      id, (satir = undefined);
    });

    $('button#confirmCloseProductEdit').on('click', function () {
      id, (satir = undefined);
    });
  });

  $('#name').attr('maxLength', 12);
  let name = $('#name').val();
  console.log(name);
  let name_length = $('#name').attr('maxLength');
  $('#name').val('');
  console.log(name);
  $('form#shityForm').validate({
    rules: {
      name: {
        required: true,
        minlength: name_length ? name_length : 13,
      },
      email: {
        required: true,
        email: true,
      },
      tax_number: {
        required: true,
        number: true,
        minlength: 2,
        maxlength: 11,
      },
    },
  });
});

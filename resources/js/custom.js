jQuery(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
    },
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
});

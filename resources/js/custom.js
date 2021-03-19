jQuery(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
    },
  });

  $.productRemove = $('button#product_delete').on('click', function () {
    $('div#productDeleteModal').modal('show');
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

  $.categoryRemove = $('button#category_delete').on('click', function () {
    $('div#categoryDeleteModal').modal('show');
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

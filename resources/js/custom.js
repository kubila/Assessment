jQuery(function () {
  $('#myDataTable').DataTable();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name=csrf-token]').attr('content'),
    },
  });
});

"use strict";
 $(".delete_item").on('click', function(e){

    var inputdata = {};
        inputdata[BDTASK.csrf_token()] = BDTASK.csrf_hash();
        inputdata['theme'] = $(this).attr('data_id');
    var item_name = $(this).attr('data_id');

    swal({
         title: "Are you sure?",
         text: "You will not be able to recover this theme!",
         type: "warning",
         confirmButtonText: "Yes, delete it!",
        confirmButtonColor: '#3085d6',
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        cancelButtonText: "No, cancel plx!",
        cancelButtonColor: '#d33'
     }).then((willDelete) => {
         if (willDelete.value) {
             $.ajax({
                type: 'POST',
                url: BDTASK.getSiteAction('admin/addon/theme/theme_delete'),
                data: inputdata,
                 success: function(data) {
                      $(".theme_"+item_name).remove();
                      swal("Deleted!", "Your theme has been deleted.", "success");
                 },
                 error: function() {
                    swal("Failed!", "Failed Please try again", "error");
                 }
              })
         } else {
             swal("Cancelled", "Your theme file is safe :)", "success");
         }
     });
 });
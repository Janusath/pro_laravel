

{{-- add employee ajax --}}
<script>
    $(function() {

      // add new employee ajax request
      $("#add_entrepreneur_registration_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_entrepreneur_registration_btn").text('Add');
        $.ajax({
          url: '{{ route('admin_add_enterpreneur_user_store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
    if (response.status == 200) {
        Swal.fire(
            'Added!',
            'Registered Successfully!',
            'success'
        );
        // Reload or update your data table
        fetchAllEnterpreneurUser();

        $("#add_entrepreneur_registration_btn").text('Add Registration');
        $("#add_entrepreneur_registration_form")[0].reset();
        $("#addEntrepreneurRegistrationModal").modal('hide');

    } else if (response.status == 422) {
        // Handle validation errors
        var errorsHtml = '<ul>';
        $.each(response.errors, function (key, value) {
            errorsHtml += '<li>' + value[0] + '</li>';
        });
        errorsHtml += '</ul>';
        Swal.fire({
            icon: 'error',
            title: 'Validation Error',
            html: errorsHtml,
        });
         fetchAllEnterpreneurUser();
    }
}

        });
      });

      // fetch all employees ajax request
      fetchAllEnterpreneurUser();

      function fetchAllEnterpreneurUser() {
        $.ajax({
          url: '{{ route('admin_add_enterpreneur_user_show') }}',
          method: 'get',
          success: function(response) {
            $("#show_all_time_slot").html(response);
            $("table").DataTable({
              order: [0, 'desc']
            });
          }
        });
      }

    });
  </script>


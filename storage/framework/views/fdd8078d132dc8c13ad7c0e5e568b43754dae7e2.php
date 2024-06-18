<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Place</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <!-- Your existing content -->
        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="department">
                <h3><?php echo e($department->DEP_NAME); ?></h3>
                <a type="button" class="btn btn-success" style="float: right;" data-toggle="modal" data-target="#editPlaceModal" data-id="<?php echo e($department->DEP_ID); ?>">Засах</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Edit Place Modal -->
    <div class="modal fade" id="editPlaceModal" tabindex="-1" role="dialog" aria-labelledby="editPlaceModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPlaceModalLabel">Edit Department</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- The form content will be loaded here via AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#editPlaceModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var depId = button.data('id'); // Extract info from data-* attributes
                var modal = $(this);

                // Load the form via AJAX
                $.ajax({
                    url: '/editplace/' + depId,
                    method: 'GET',
                    success: function(response) {
                        modal.find('.modal-body').html(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $('#saveChanges').click(function() {
                var form = $('#editPlaceModal').find('form');
                var formData = form.serialize();

                $.ajax({
                    url: form.attr('action'),
                    method: form.attr('method'),
                    data: formData,
                    success: function(response) {
                        // Handle success (e.g., close modal, update UI, etc.)
                        $('#editPlaceModal').modal('hide');
                        location.reload(); // Reload the page to see the changes (optional)
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\dastone\resources\views/updateplace.blade.php ENDPATH**/ ?>
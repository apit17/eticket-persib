<script type="text/javascript">
$(document).ready(function() {
    $('#transactionMenu').addClass('in');
    $('#procurement-menu a').addClass('active-menu');
    $('#date').datepicker({ dateFormat: 'dd-mm-yy'});
    // The maximum number of options
    var MAX_OPTIONS = 5;
    $('#form-procurement')
        // Add button click handler
        .on('click', '.addButton', function() {
            var $template = $('#optionTemplate'),
                $clone    = $template
                                .clone()
                                .removeClass('hide')
                                .removeAttr('id')
                                .insertBefore($template),
                $option   = $clone.find('[name="products[]"]');
        })

        // Remove button click handler
        .on('click', '.removeButton', function() {
            var $row    = $(this).parents('.form-group'),
                $option = $row.find('[name="products[]"]');

            // Remove element containing the option
            $row.remove();
        })

        // Called after adding new field
        .on('added.field.fv', function(e, data) {
            if (data.field === 'products[]') {
                if ($('#form-procurement').find(':visible[name="products[]"]').length >= MAX_OPTIONS) {
                    $('#form-procurement').find('.addButton').attr('disabled', 'disabled');
                }
            }
        })

        // Called after removing the field
        .on('removed.field.fv', function(e, data) {
           if (data.field === 'products[]') {
                if ($('#form-procurement').find(':visible[name="products[]"]').length < MAX_OPTIONS) {
                    $('#form-procurement').find('.addButton').removeAttr('disabled');
                }
            }
        });
});


</script>
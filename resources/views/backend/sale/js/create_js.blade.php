<script type="text/javascript">
$(document).ready(function() {
    $('#transactionMenu').addClass('in');
    $('#sale-menu a').addClass('active-menu');
    $('#date').datepicker({ dateFormat: 'dd-mm-yy', maxDate: '+0D'});
    // The maximum number of options
    var MAX_OPTIONS = 5;
    $('#form-sale')
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
                if ($('#form-sale').find(':visible[name="products[]"]').length >= MAX_OPTIONS) {
                    $('#form-sale').find('.addButton').attr('disabled', 'disabled');
                }
            }
        })

        // Called after removing the field
        .on('removed.field.fv', function(e, data) {
           if (data.field === 'products[]') {
                if ($('#form-sale').find(':visible[name="products[]"]').length < MAX_OPTIONS) {
                    $('#form-sale').find('.addButton').removeAttr('disabled');
                }
            }
        });

});

function setSender(val)
{
    if (val == 1) {
        $('#sender_other').addClass('hide').prop('required',false);
    } else {
        $('#sender_other').removeClass('hide').prop('required',true);
    }
}

</script>
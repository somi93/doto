$(document).ready(function () {
    $('body').on('keyup','.search-dropdown',function() {
        var term = $(this).val().toLowerCase();
        $(this).closest('.dropdown-menu').find('li').each(function() {
            if ($(this).hasClass('search-box')) {}
            else {
                var listValue = $(this).text();
                if (listValue.toLowerCase().indexOf(term) >= 0) {
                    $(this).removeClass('hidden');
                } else {
                    $(this).addClass('hidden');
                }
            }
        })
    });
    $('body').on('click', '.dropdown-item', function () {
        var id = $(this).find('span').data('id');
        var value = $(this).find('span').text();
        $(this).closest('.dropdown').find('.dropdown-value').val(id);
        $(this).closest('.dropdown').find('.tour_value').html(value);
    })
})
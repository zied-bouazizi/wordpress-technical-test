$(document).ready(function () {

    $('.list').isotope({
        itemSelector: '.list-item',
    });

    // Filter items on button click
    $('.filter-button-group').on('click', 'li', function () {
        var filterValue = $(this).attr('data-filter');
        $('.list').isotope({ filter: filterValue });
        $('.filter-button-group li').removeClass('active');
        $(this).addClass('active');
    });
})

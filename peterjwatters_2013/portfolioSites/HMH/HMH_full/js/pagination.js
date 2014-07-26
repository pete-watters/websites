$.fn.pagination = function(widgetID, pageSize, startRow, totalRows) {
     var show_per_page, number_of_items ,number_of_pages,navigation_html, current_link;
    //how many items per page to show
    show_per_page = pageSize;
    //getting the amount of elements inside content div
    number_of_items = $(widgetID + ' .pageableList').children().size();
    //calculate the number of pages we are going to have
    number_of_pages = Math.ceil(number_of_items / show_per_page);

    //set the value of our hidden input fields
    $('#current_page').val(0);
    $('#show_per_page').val(show_per_page);

    navigation_html = '<ul>';
    navigation_html += '<li class="previous_link"><a><i class="icon-caret-left icon-large"></i> Previous</a></li>';
    navigation_html += '';
    current_link = 0;
    while (number_of_pages > current_link) {
        navigation_html += '<li class="page_link" id="' + current_link + '">';
        navigation_html += '<a id="page-' + current_link + '">' + (current_link + 1) + '</a>';
        navigation_html += '</li>';
        current_link++;
    }
    navigation_html += '<li class="next_link"><a>Next <i class="icon-caret-right icon-large"></i></a></li>';
    navigation_html += '</ul>';

    // add the pagination widget html
    $('.pagination').html(navigation_html);
    //add active class to the first page link
    $('.pagination .page_link:first').addClass('active');
    //hide all the elements inside content div
    $(widgetID + ' .pageableList').children().css('display', 'none');

    //and show the first n (show_per_page) elements
    $(widgetID + ' .pageableList').children().slice(0, show_per_page).css('display', 'block');

    $('.previous_link').on("click", function() {
        new_page = parseInt($('#current_page').val()) - 1;
        //if there is an item before the current active link run the function
        if ($('.active').prev('.page_link').length == true) {
            go_to_page(new_page);
        }
    });

    $('.next_link').on("click", function() {
        new_page = parseInt($('#current_page').val()) + 1;
        //if there is an item after the current active link run the function
        if ($('.active').next('.page_link').length == true) {
            go_to_page(new_page);
        }
    });

    $('.page_link').on("click", function() {
        go_to_page($(this).attr("id"));
    });


    var go_to_page = function(page_num) {
            //get the number of items shown per page
            var show_per_page, start_from, end_on, get_box;
            show_per_page = parseInt($('#show_per_page').val());
            //get the element number where to start the slice from
            start_from = page_num * show_per_page;
            //get the element number where to end the slice
            end_on = start_from + show_per_page;
            get_box = $(".page_link")[page_num];
            //hide all children elements of content div, get specific items and show them
            $(widgetID + ' .pageableList').children().css('display', 'none').slice(start_from, end_on).css('display', 'block');

            /*get the page link that has longdesc attribute of the current page and add active class to it and remove that class from previously active page link*/
            $(".pagination").find('li.active').removeClass("active");
            $(get_box).addClass("active");
            //update the current page input field
            $('#current_page').val(page_num);
        }
}
$(document).ready(function() {

    var pageCount = $("#pagecount").data('totalpage');

    function searchAjax() {
        var url = $("#feecback_filter").attr("action");
        var data = $("#feecback_filter").serialize();
        var searchText = $("#feecback_filter_search").attr("value");
        $('#loader').show();
        $.ajax({
            type: "POST",
            url: url, // Or your url generator like Routing.generate('discussion_create')
            data: data,
            dataType: "html",
            success: function(data) {
                $("#update_listing").html(data);
                $('#loader').hide();

                pageCount = $("#pagecount").data('totalpage');
                currentPage = $("#feecback_filter_page").attr('value');
                $("#next").show();
                $("#prev").show();
                if (pageCount < 1)
                {
                    $("#next").hide();
                    $("#prev").hide();
                }
                if (currentPage == 0)
                {
                    $("#prev").hide();
                }
                if (currentPage == pageCount - 1)
                {
                    $("#next").hide();
                }
            }
        });

        return false;
    }

    $('#feecback_filter_statuses').change(function() {
        $("#feecback_filter_page").attr('value', 0);
        searchAjax();

    });

    $('#feecback_filter_search').on('input', function() {
        $("#feecback_filter_page").attr('value', 0);
        searchAjax();

    });


    if (pageCount > 1)
    {
        var currentPage = $("#feecback_filter_page").attr('value');
        if (currentPage == 0)
        {
            $("#prev").hide();
        }
        $("#next").click(function(e) {
            e.preventDefault();
            pageCount = $("#pagecount").data('totalpage');
            var pageValue = $("#feecback_filter_page").attr('value');
            var pageNo = parseInt(pageValue);
            pageNo++;
            $("#feecback_filter_page").attr('value', pageNo);
            searchAjax();
        });

        $("#prev").click(function(e) {
            e.preventDefault();
            pageCount = $("#pagecount").data('totalpage');
            var pageValue = $("#feecback_filter_page").attr('value');
            var pageNo = parseInt(pageValue);
            if (pageNo > 0)
            {
                pageNo--;
            }
            $("#feecback_filter_page").attr('value', pageNo);
            searchAjax();
        });
    }
    else
    {
        $("#next").hide();
        $("#prev").hide();
    }

});

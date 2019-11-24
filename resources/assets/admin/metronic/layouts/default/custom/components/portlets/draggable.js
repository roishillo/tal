var PortletDraggable = function () {

    return {
        //main function to initiate the module
        init: function () {
            $("#m_sortable_portlets").sortable({
                connectWith: ".m-portlet__head",
                items: ".m-portlet", 
                opacity: 0.8,
                handle : '.m-portlet__head',
                coneHelperSize: true,
                placeholder: 'm-portlet--sortable-placeholder',
                forcePlaceholderSize: true,
                tolerance: "pointer",
                helper: "clone",
                tolerance: "pointer",
                forcePlaceholderSize: !0,
                helper: "clone",
                cancel: ".m-portlet--sortable-empty", // cancel dragging if portlet is in fullscreen mode
                revert: 250, // animation in milliseconds
                update: function(b, c) {
                    if (c.item.prev().hasClass("m-portlet--sortable-empty")) {
                        c.item.prev().before(c.item);
                    }
                    var data = $(this).sortable('serialize');
                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: 'stations/sort',
                        success: function (response) {
                            $('.station-order').each(function(index, item){

                                item.innerHTML = `#${index+1}`;
                            });
                        }
                    });

                }
            });
        }
    };
}();

jQuery(document).ready(function() {
    PortletDraggable.init();
});
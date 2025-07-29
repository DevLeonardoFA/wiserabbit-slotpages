jQuery( ($) => {

    $("#WRSP_quantity_slots, #WRSP_order").on("change", (e) => {
        
        $.ajax({
            url: WRSP.ajaxurl,
            method: "POST",
            data: {
                action: "WRSP_Options",
                quantity_slots: $("#WRSP_quantity_slots").val(),
                order: $("#WRSP_order").val(),
                nonce: WRSP.nonce
            }  
        })
        .success((response) => {
            $("#WRSP_slots").html(response);
        });

    });


    $("#WRSP_loadmore").click(() => {

        $ids = $("#WRSP_slots .SlotCard").map((i, el) => $(el).data("post")).toArray();

        $.ajax({
            url: WRSP.ajaxurl,
            method: "POST",
            data: {
                action: "WRSP_LoadMore",
                ids: $ids,
                quantity_slots: $("#WRSP_quantity_slots").val(),
                order: $("#WRSP_order").val(),
                nonce: WRSP.nonce
            }  
        })
        .success((response) => {

            if(response == "No more posts"){
                $("#WRSP_slots").append(response);
                $("#WRSP_loadmore").remove();
                return;
            }
            
            $("#WRSP_slots").append(response);

        });
    });


});
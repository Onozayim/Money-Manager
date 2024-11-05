$(document).ready(function() {
    console.log("hola");

    $.ajax({
            type: "POST",
            url: "/expense_sub_categories",
            data: {
                id: $(this).find(":selected").val()
            },
            success: function(data) {
                $("#sub_categoria").empty();

                $("#sub_categoria").append($('<option>', {
                        value: "",
                        text: "Seleccione una Sub-categoría"
                    }));

                data.data.forEach(cat => {
                    $("#sub_categoria").append($('<option>', {
                        value: cat.id,
                        text: cat.name
                    }));
                })

                const subCatId = $("#subCatId").val();

                if(subCatId) {
                    $("#sub_categoria").val(subCatId);
                }
            }
        })

    $("#categoria").on("change", function() {
        $.ajax({
            type: "POST",
            url: "/expense_sub_categories",
            data: {
                id: $(this).find(":selected").val()
            },
            success: function(data) {
                $("#sub_categoria").empty();

                $("#sub_categoria").append($('<option>', {
                        value: "",
                        text: "Seleccione una Sub-categoría"
                    }));

                data.data.forEach(cat => {
                    $("#sub_categoria").append($('<option>', {
                        value: cat.id,
                        text: cat.name
                    }));
                })
            }
        })
    });
})
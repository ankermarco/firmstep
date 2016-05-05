var app = {
    init: function () {
        $("input").prop('required', true);

        app.handleForm();
        app.formSubmit();
    },

    handleForm: function () {
        $('.btn-group input[type=radio]').bind('change', function () {
            var el =  $(this).val();
            if (el == "anonymous") {
                $("fieldset.form-group").hide();
                $("input").prop('required', false);
            }else if (el == "citizen") {
                $("fieldset.form-group").show();
                $("#organisation-section").hide();
                $("input").prop('required', true);
            }else {
                $("fieldset.form-group").show();
                $("#organisation-section").show();
                $("input").prop('required', true);
            }
        });
    },
    formSubmit: function () {
        $("form").submit(function () {

            var service = $('input[name=services]:checked').val();
            var customerType = $('input[name=customerType]:checked').val();

            var formData = $("form").serialize();

            $.ajax({
                method: "POST",
                url: "/api/v1/queues/create",
                data: formData,
                dataType: "json",
                statusCode: {
                    200: function (data) {
                        var html = '<tr><th>' + data.id + '</th><td>'
                            + data.customerType + '</td><td>'
                            + data.name + '</td><td>'
                            + data.service + '</td><td>'
                            + data.queuedAt + '</td></tr>';

                        $('.table > tbody').append(html);
                        $('.alert-success').fadeIn(600).delay(600).fadeOut(1500);
                        //$('.alert').addClass('alert-success');
                    },
                    404: function () {
                        $('.alert-danger').fadeIn().fadeOut('slow');
                    }
                }

            });
            event.preventDefault();
        });
    },

};

$(document).ready(function () {
    app.init();
});



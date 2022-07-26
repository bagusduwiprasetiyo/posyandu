var loginFalse = function () {
    $('#modalLogin').modal('show');
}


if (isLoginFalse == '1') {
    loginFalse();
}



var registrasiSuccess = function () {
    $('#modalRegis').modal('show');
}

if (isregistrasiSuccess == '1') {
    registrasiSuccess();
}
var pushNotif = function (m) {
    return '<div class="alert alert-danger" role="alert" style="font-size: 12px; width: 100%;"><i class="fa fa-exclamation-triangle"></i><i> Pastikan <b>' + m + '</b>.</i></div>';
}
var login = function () {
    $('#formLogin').validate({
        messages: {
            password: {
                required: pushNotif('Password Harus di Isi'),
                minlength: pushNotif('Password di isi dengan benar, minimal 8 karakter')
            }
        },
        highlight: function (e) {
            $(e).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function (e) {
            $(e).closest('.form-control').removeClass('is-invalid');
            $(e).closest('.form-control').addClass('is-valid');
        },
        success: function (e) {
            $(e).closest('.form-control').removeClass('is-invalid');
            $(e).closest('.form-control').addClass('is-valid');
        },
    });
}
$('#btn-login').on('click', function () {

    $('#formLogin').submit()
});

var registrasi = function () {


    $('#formRegistrasi').on('submit', function (e) {
        if ($(this).valid()) {
            $(this).submit();
        } else {
            e.preventDefault();
        }
    });


    $('#formRegistrasi').validate({
        rules: {
            regisPassword: {
                required: true
            },
            verifRegisPassword: {
                required: true,
                equalTo: '#regisPassword'
            }
        },
        highlight: function (e) {
            $(e).closest('.form-control').addClass('is-invalid');
        },
        unhighlight: function (e) {
            $(e).closest('.form-control').removeClass('is-invalid');
            $(e).closest('.form-control').addClass('is-valid');
        },
        success: function (e) {
            $(e).closest('.form-control').removeClass('is-invalid');
            $(e).closest('.form-control').addClass('is-valid');
        },

    });

    $('input[name=no_tlp], input[name=nik]').on('keyup', function () {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
    });


    var invalidNik = false;


    $('input[name=nik]').on('change keyup keypress', function () {

        $('#alertNik').remove();
        invalidNik = false;

        if (jQuery.inArray($(this).val(), nik) != -1) {

            $(this).after(`<p style="color:red;" id="alertNik">Nik telah terdaftar!</p>`);

            invalidNik = true;

        }
    });



    invalidUsername = false;

    $('input[name=regisUsername]').on('change keypress keyup', function () {

        $('#alertUsername').remove();
        invalidUsername = false;

        if (jQuery.inArray($(this).val(), username) != -1) {

            $(this).after(`<p style="color:red;" id="alertUsername">username tidak tersedia!</p>`);

            invalidUsername = true;

        }

    });

    $('input[name=regisUsername]').on('change keyup keypress', function () {
        const newVal = $(this).val().toLowerCase();
        $(this).val(newVal);
    });


    $('input[name=nama], input[name=alamat]').on('keyup', function () {

        capital = $(this).val().toLowerCase().replace(/\b[a-z]/g, function (letter) {
            return letter.toUpperCase();
        });

        $(this).val(capital);

    });



    var next = function () {
        if ($('#formRegistrasi').valid() && !invalidNik) {
            $('.part_1').hide('slow', function () {
                $(this).attr('hidden', true);
            });

            $('.part_2').attr('hidden', false).show('slow');

        }
    }

    var back = function () {
        $('.part_2').hide('slow', function () {
            $(this).attr('hidden', true);
        });

        $('.part_1').attr('hidden', false).show('slow');
    }

    $('#submitRegis').on('click', function () {
        if ($('#formRegistrasi').valid() && !invalidUsername) {

            if ($('#posyandu_id').val() != '') {
                $('#formRegistrasi')[0].submit();
            } else {
                $('#posyanduHelp').attr('style', 'color:red;');
            }
        }
    });

    registrasi.next = next;
    registrasi.back = back;

}

registrasi()
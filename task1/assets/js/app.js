const leapYear = {

    ajaxMethod: 'POST',

    showMessage: function (message, isError = false) {

        if ($('.response-message').length) {
            $('.response-message').text(message);
        } else {
            $('.form-body').after('Response:&nbsp; <span class="response-message">' + message + '</span>');
        }

        if (isError) {
            $('.response-message').addClass('error');
        } else {
            $('.response-message').removeClass('error');
        }
    },

    check: function () {

        const year = $('#year');
        const formData = new FormData();
        formData.append('year', year.val());

        $.ajax({
            url: '/task1/check',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (result) {

                if (result === '0') {
                    leapYear.showMessage('Input error', true);
                }

                if (result === '1') {
                    leapYear.showMessage('The entered year is not a leap year');
                }

                if (result === '2') {
                    leapYear.showMessage('The entered year is a leap year');
                }

            }
        });
    }
};
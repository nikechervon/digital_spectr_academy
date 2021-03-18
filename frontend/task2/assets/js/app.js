const words = {

    ajaxMethod: 'POST',

    showError: function (input, inputError, message) {

        if (!inputError.length) {
            input.after('<span class="error">' + message + '</span>');
        }
    },

    search: function () {

        const prefix = $('#prefix');
        const wordsList = $('#words');

        const prefixError = $('#prefix + .error');
        const wordsError = $('#words + .error');
        const wordsItems = $('.words__list');

        const formData = new FormData();

        formData.append('prefix', prefix.val());
        formData.append('words', wordsList.val());

        $.ajax({
            url: '/backend/task2/search',
            type: this.ajaxMethod,
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (json) {

                var obj = jQuery.parseJSON(json);

                if (obj.result === 1001) {
                    words.showError(prefix, prefixError, 'Empty Prefix field');
                } else {
                    prefixError.remove();
                }

                if (obj.result === 1002) {
                    words.showError(wordsList, wordsError, 'Please enter at least 1 word');
                } else {
                    wordsError.remove();
                }

                if (obj.data) {
                    if (obj.data.length === 0) {

                        wordsItems.empty();
                        wordsItems.append('<li class="words__list_item">No words found</li>');
                    } else {

                        wordsItems.empty();
                        obj.data.forEach(
                            word => wordsItems.append('<li class="words__list_item">' + word + '</li>')
                        );
                    }
                }
            }
        });
    }
};
$("#prefix").keyup(function(event){
    if(event.keyCode === 13){
        words.search();
    }
});

$("#words").keyup(function(event){
    if(event.keyCode === 13){
        words.search();
    }
});

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
                wordsItems.empty();

                if (obj.result === 1001) {
                    words.showError(prefix, prefixError, 'Пустое поле префикса');
                } else {
                    prefixError.remove();
                }

                if (obj.result === 1002) {
                    words.showError(wordsList, wordsError, 'Введите хотя бы 1 слово');
                } else {
                    wordsError.remove();
                }

                if (obj.result === 1003) {
                    if (obj.data.length === 0) {
                        wordsItems.append(
                            '<li class="words__list_item">Слов не найдено</li>'
                        );
                    } else {
                        obj.data.forEach(
                            word => wordsItems.append(
                                '<li class="words__list_item">' + word + '</li>'
                            )
                        );
                    }
                }
            }
        });
    }
};
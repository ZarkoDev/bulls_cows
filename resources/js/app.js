require('./bootstrap');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function addGlobalErrors(message) {
    $('#globalErrors').text(message);
    $('#globalErrors').addClass('d-block');
}

function removeGlobalErrors() {
    $('#globalErrors').removeClass('d-block');
}

function addGlobalSuccesses(message) {
    $('#globalSuccesses').text(message);
    $('#globalSuccesses').addClass('d-block');
}

function addGuessRow(data, number) {
    var guessRow = $('#guessExample').clone();
    guessRow.removeAttr("id");
    guessRow.find('.guessNumber').text(number);
    guessRow.find('.guessBulls').text(data['bulls']);
    guessRow.find('.guessCows').text(data['cows']);
    guessRow.attr("hidden", false);

    $('#previousGuessesBody').prepend(guessRow);
}

function sendGuessNumber(number) {
    $.ajax({
        url: '/guessNumber',
        type: 'post',
        dataType: 'json',
        data: { number: number},
        success: function (data) {
            if('error' in data) {
                addGlobalErrors(data['error']);
            } else {
                removeGlobalErrors();
                addGuessRow(data, number);
            }
                
            if('isCompleted' in data) {
                addGlobalSuccesses('Congratiolations, you found all numbers');
                $('#numberGuess').prop('disabled', true);
                $('#checkNumber').prop('disabled', true);
            }
        },
    });
}

$('#numberGuess').on('keyup', function(element) {
    var newNumberGuess = $('#numberGuess').val().replace(/\D/g,'');
    $('#numberGuess').val(newNumberGuess.substring(0, 4));
});

$('#checkNumber').on('click', function () {
    var currentNumber = $('#numberGuess').val();
    
    if (currentNumber.length === 0) {
        addGlobalErrors('Missing guess number');
        return;
    }

    sendGuessNumber(currentNumber);
});

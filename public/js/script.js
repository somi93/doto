$(function() {
    var note = $('#note'),
        ts = new Date(2017, 9, 1),
        newYear = true;

    $('#countdown').countdown({
        timestamp: ts,
        callback: function(days, hours, minutes, seconds) {
            var message = "Countdown To International 7<a href='/admin' style='color:#ccc'>!</a>";
            note.html(message);
        }
    });

});
/**
 * Init time ago.
 *
 *
 * @param $scope
 */
$(function() {
    $.timeago.settings.cutoff = 7 * 86400000;//milliseconds
    $.timeago.settings.allowFuture = true

    $("time.timeago").timeago();
});
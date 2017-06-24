(function () {
    //perform any set up here

    //toggles a loading overlay
    window.toggleOverlay = function (value) {
        if (value === null) {
            $("#overlay").toggleClass('hidden');
        }else {
            $("#overlay").toggleClass('hidden', value);
        }
    }

})();

(function () {
    //perform any set up here

    //adds nice addify capability to a form
    window.formAddify = function (collection) {
        return function () {
            var prototype = collection.data('prototype');
            console.log("sdfdsf");
        };
    };

    window.toggleOverlay = function (value) {
        if (value === null) {
            $("#overlay").toggleClass('hidden');
        }else {
            $("#overlay").toggleClass('hidden', value);
        }
    }

})();

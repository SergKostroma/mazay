jQuery.event.special.touchstart = {
    setup: function (_, ns, handle) {
        this.addEventListener("touchstart", handle, {passive: true});
    }
};

function initHeader() {
    var $header;
    if (window.screen.width <= 991) {
        $header = $(".js-header-mobile");
    } else {
        $header = $(".js-header");
    }
    var top = $(window).scrollTop();
    calcHeader(top, $header, prevTop);
    var prevTop = top;
    $(window).on("scroll", function (e) {
        top = $(window).scrollTop();
        calcHeader(top, $header, prevTop);
        prevTop = top;
    });
}


function calcHeader(top, $header, prevTop) {

    if (top <= window.screen.height && window.screen.width > 991) {
        $header.removeClass("active");
        $header.addClass("hide");
        return false;
    } else {
        $header.removeClass("hide");
        $header.addClass("active");
    }
    // console.log(top);
    // console.log(prevTop);
    // console.log(window.screen.height);
    //
    // if (top > 0) {
    //     $header.addClass("active");
    // } else {
    //     $header.removeClass("active");
    // }
    // if (prevTop > top || top <= 0) {
    //     $header.removeClass("hide");
    // } else if (top > $header.height()) {
    //     $header.addClass("hide");
    // }
}


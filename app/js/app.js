$(document).ready(function (){
    initSlider();
    initAccordion();
    scrollLink();
    zoomOnScroll();
    burger();
    height();
    other();
    if ($("[data-has-calendar='y']").length > 0) {
        daterangepickerSettings();
    }
    initAnimation();
    initHeader();
    forms();
    modal();
});
loader();



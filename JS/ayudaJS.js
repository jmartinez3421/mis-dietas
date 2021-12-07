$(document).ready(function(){
    calcularAlturaMarginTopSection();

    $(window).resize(calcularAlturaMarginTopSection);

    function calcularAlturaMarginTopSection(){
        let section = $("section");
        let header = $("nav.navbar");
        let footer = $("footer");

        let alturaSection = $(window).height() - header.height() - footer.height() - 10;
        section.css("min-height", alturaSection);
        section.css("margin-top", header.height() + 10);
    }
});
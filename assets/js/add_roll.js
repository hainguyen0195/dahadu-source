function onScroll() {
    var e = $(".call_showin");
    $(e).each(function() {
        $(this).isInViewport() ? $(this).addClass("on-show") : $(this).removeClass("on-show");
    });
}

function updateProgressBar() {
    var t = {
        on: e.fn.on,
        bind: e.fn.bind
    };
    e.each(t, function(a) {
        e.fn[a] = function() {
            var e, i = [].slice.call(arguments),
            o = i.pop(),
            l = i.pop();
            return i.push(function() {
                var t = this,
                a = arguments;
                clearTimeout(e), e = setTimeout(function() {
                    l.apply(t, [].slice.call(a))
                }, o)
            }), t[a].apply(this, isNaN(o) ? arguments : i)
        }
    })
}(jQuery), $.fn.isInViewport = function() {
    var e = $(this).offset().top,
    t = e + $(this).outerHeight(),
    a = $(window).scrollTop(),
    i = a + $(window).height();
    return t > a && i + 60 > e
};

function AniText() {
    $(".title-page").addClass("show"), $(".title-page h1").children().children().each(function(e) {
        var t = $(this);
        setTimeout(function() {
            $(t).addClass("move")
        }, 100 * (e + 1))
    })
}

$(window).load(function(){
    setTimeout(function(){
       onScroll();
   },300);
   //  setTimeout(function(){
   //     AniText();
   // },300);
});

$(window).scroll(function(){
    onScroll();
});

// $(document).ready(function() {
//    $(".title-page > h1").lettering("words").children("span").lettering().children("span").lettering();
// });

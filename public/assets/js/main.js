$(document).ready(function()
{
    // Tab switching functionality
    $('#login-tab').click(function() {
        $(this).addClass('active');
        $('#signup-tab').removeClass('active');
    });

    $('#signup-tab').click(function() {
        $(this).addClass('active');
        $('#login-tab').removeClass('active');
    });

    // Form submission (prevent default for demo)

});

$(document).ready(function()
{
    $(".tab-btn").click(function()
    {
        var tab = $(this).data("tab");

        $(".tab-btn").removeClass("active");
        $(this).addClass("active");

        $(".tab-content").removeClass("active");
        $("#" + tab).addClass("active");
    });
});


//
// $(document).ready(function ()
// {
//     setTimeout(function ()
//     {
//         $("#preloader").fadeOut(200, function ()
//         {
//             $("#content").fadeIn(200); // إظهار المحتوى بعد إخفاء اللودر
//         });
//     }, 2000);
// });
//

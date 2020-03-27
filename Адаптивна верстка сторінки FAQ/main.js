$('.menu-button').on('click', function()
{
    $('.mobile-menu').css('display','flex');
});
$('.close').on('click', function()
{
    $('.mobile-menu').css('display','none');
});

$('.close-modal').on('click', function()
{
    $('.layer').css('display', 'none');
    $('body').css('overflow','scroll');
});
$(document).ready(function()
{
  function preloader()
{
    $(() => {
        setTimeout(() => {
            let p = $('.preloader');
            p.css('display', 'none');
        }, 1000);

        console.log(1);
    });
}
preloader();

$.ajax({
  url: 'server.php',
  success: function(data) {
    $('#brand').html(data).selectmenu();
  }
});
$('#brand').on('change', function()
{
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data: 'brand='+$('#brand').val(),
        success: function(data) {
          $('#model').html(data).selectmenu();
        }
      });
});

$('#model').on('change', function()
{
    $.ajax({
        url: 'server.php',
        method: 'POST',
        data: 'brand='+$('#brand').val()+'&model='+$('#model').val(),
        success: function(data) {
          $('#type').html(data).selectmenu();;
        }
      });
});


});
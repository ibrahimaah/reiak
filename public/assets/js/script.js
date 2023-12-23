
window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    const preloader = document.getElementById('preloader');
    const content = document.getElementById('content');
  
    loader.style.display = 'none';
    preloader.style.display = 'none';
    content.style.display = 'block';
  });
(function logoSlider() {

    $('#logo-slide .active').each(function () {
        
        if(!$(this).is(':last-child')) {
            $(this).delay(2000).fadeOut(1000, function () {
                $(this).removeClass('active').next().addClass('active').fadeIn();
                logoSlider()
            });
        } else {
            $(this).delay(3000).fadeOut(1000, function () {
                $(this).removeClass('active');

                $('#logo-slide p').eq(0).addClass('active').fadeIn();

                logoSlider()
            });
        }

    });

}());
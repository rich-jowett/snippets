document.getElementById('hamburger').addEventListener('click', function () {
    if (document.body.classList.contains('nav-active')) {
        document.body.classList.remove('nav-active');
    } else {
        document.body.classList.add('nav-active');
    }
});

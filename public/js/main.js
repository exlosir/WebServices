/*Выдвижное меню*/
    $('.burger-menu-icon').on('click',function(e){
        e.preventDefault();
        $(this).toggleClass('burger-menu-icon-active');
        $('.nav-left-wrapper').toggleClass('nav-left-wrapper-active');
        $('.nav-left').toggleClass('nav-left-active');
        $('.nav-left-button').toggleClass('nav-left-button-active');
    });


/*Подпись к инпутам*/
$(document).ready(function(){

    $(".form").find('.form-input').each(function(){
        _this = $(this);
        _label = _this.prev();
        if(_this.val() !== '')
            _label.addClass('label-active');
    });

$('.form').find('input, textarea, select').on('keyup blur focus change', function (e) {
    var _this = $(this),
        _label = _this.prev();


    if(e.type === 'keyup') {
        if(_this.val() === '') {
            _label.removeClass('label-active label-focus');
        }else {
            _label.addClass('label-active label-focus');
        }
    }

    else if (e.type === 'blur') {
        if(_this.val() === '') {
            _label.removeClass('label-active label-focus');
        }else {
            _label.removeClass('label-focus')
        }
    }

    else if (_this.type === 'focus') {
        if(_this.val() === '') {
            _label.removeClass('label-focus');
        }else {
            _label.addClass('label-focus');
        }
    }

    if( e.type === "focus") {
        if(!_label.hasClass('label-active') && _this.val() === '') {
            _label.addClass('label-active');
        }else {
            if(_this.val() === '')
                _label.removeClass('label-active');
        }
    }

    else if (e.type === 'keyup') {
        if(!_label.hasClass('label-active') && _this.val() === '') {
            _label.removeClass('label-active');
        }else {
            _label.addClass('label-active');
        }
    }

    else if(e.type === 'change') {
        if(_this.val() !== '') {
            _label.addClass('label-active');
        }else {
            _label.removeClass('label-active');
        }
    }

    // else if (e.type === 'load') {
    //     if(_this.val() === '') {
    //         _label.addClass('label-active');
    //     }
    // }




});
    $('#CategoryCollapse').collapse();

});
// $('.form').find('input, textarea, select').on('focus', function(e){
//     e.preventDefault();
//     if($(this).val() !== ''){
//         $(this).prev().addClass('label-focus');
//     }else {
//         $(this).prev().removeClass('label-focus');
//     }
// });




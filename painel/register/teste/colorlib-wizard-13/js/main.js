(function($) {

    var form = $("#signup-form");
    // form.steps({
    //     headerTag: "h3",
    //     bodyTag: "fieldset",
    //     transitionEffect: "slideLeft",
    //     labels: {
    //         previous : 'Previous',
    //         next : 'Next <i class="zmdi zmdi-long-arrow-down"></i>',
    //         finish : 'Submit',
    //         current : ''
    //     },
    //     titleTemplate : '<span class="title">#title#</span>',
    //     onInit : function (event, currentIndex) { 
    //         // Suppress (skip) "Warning" step if the user is old enough.
    //     },
    //     onStepChanging: function (event, currentIndex, newIndex)
    //     {
    //         form.validate().settings.ignore = ":disabled,:hidden";
    //         return form.valid();
    //     },
    //     onFinishing: function (event, currentIndex)
    //     {
    //         form.validate().settings.ignore = ":disabled";
    //         return form.valid();
    //     },
    //     onFinished: function (event, currentIndex)
    //     {
    //         alert('Sumited');
    //     },
    //     onStepChanged: function (event, currentIndex, priorIndex)
    //     {

         
    //     }
    // });

    $(".acc-wizard").accwizard({
        addButtons  : true,
        nextText : 'Next',
        nextClasses : 'au-btn',
        backClasses : 'au-btn au-btn-back'
    });

    // $('.panel-group .panel-default').on('click', function() {
    //     $('.panel-group').find('.active').removeClass("active");
    //     $(this).addClass("active");
    // });
    $('.panel').on('show.bs.collapse', function (e) {
        $(this).addClass('active');
    })
    $('.panel').on('hide.bs.collapse', function (e) {
        $(this).removeClass('active');
    })
    // jQuery(this).toggleClass('isOpen');

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        email: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });

    $.dobPicker({
        daySelector: '#birth_date',
        monthSelector: '#birth_month',
        yearSelector: '#birth_year',
        dayDefault: 'DD',
        monthDefault: 'MM',
        yearDefault: 'YYYY',
        minimumAge: 0,
        maximumAge: 120
    });

    $('#national').parent().append('<ul id="newnational" class="select-list" name="national"></ul>');
    $('#national option').each(function(){
        var background = $(this).data('url');
        $('#newnational').append('<li value="' + $(this).val() + '"><img src="'+ background +'" alt="">'+$(this).text()+'</li>');
    });
    $('#national').remove();
    $('#newnational').attr('id', 'national');
    $('#national li').first().addClass('init');
    $("#national").on("click", ".init", function() {
        $(this).closest("#national").children('li:not(.init)').toggle();
    });
    
    var allOptions = $("#national").children('li:not(.init)');
    $("#national").on("click", "li:not(.init)", function() {
        allOptions.removeClass('selected');
        $(this).addClass('selected');
        $("#national").children('.init').html($(this).html());
        allOptions.toggle();
    });

})(jQuery);
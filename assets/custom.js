jQuery(document).ready(function ($) {
	
    // Smooth scroll inner links to section
	$(document).on('click', '.inner-buttons a[href^="#"], .home-sliding-panel a[href^="#"]', function (event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top
		}, 500);
    });

    // Toggle Variables bar
    $('.variables-bar-toggle a').on('click',function (e) {
        e.preventDefault();
        var isRetracted = $('.variables-bar').hasClass('retracted');
        isRetracted ? $('.variables-bar').removeClass('retracted'): $('.variables-bar').addClass('retracted')
    });

    // Toggle panel
    $('.home-sliding-panel .sliding-panel-handle').on('click',function (e) {
        e.preventDefault();
        $('.home-sliding-panel').toggleClass('slided-in')
    });

if ($('body').hasClass('single-scripture')){

    var urlParams = new URLSearchParams(window.location.search);

    if(urlParams.get('myname')){
        var theName = urlParams.get('myname');
        $('.blessed-name').html('<strong>'+theName+'</strong>');
        //remove the loader when the name is set
        $('.roller-container').addClass('hidden')
    }else{
        var theName = "Loved One"
    }

    if(urlParams.get('gender')){
        var theGender = urlParams.get('gender');
        updateGender(theGender);
    }else{
        var theGender = "neutral"
    }
    
}

$('#update_variables').on('click',function (e) {
    updateValues();
});

function updateValues() {

    let person = $('#name_input').val();
    let gender = $('#gender_select').val()

    if (person == null || person == "") {
        theName = "Loved One"
    } else {
      theName = person
    }  
    
    if (gender == null || gender == "") {
        theGender = "neutral"
    } else {
      theGender = gender
    } 

    $('.blessed-name').html('<strong>'+theName+'</strong>');
    updateGender(theGender);

    if( person == null || person == "" ){
        $('.roller-container').removeClass('hidden')
    }else{
        $('.roller-container').addClass('hidden')
    }

}

function updateGender(theGender){

    if(theGender=='neutral'){
        $('.gender-they').html('they');
        $('.gender-their').html('their');
        $('.gender-them').html('them');
    }else if(theGender=='female'){
        $('.gender-they').html('she');
        $('.gender-their').html('her');
        $('.gender-them').html('her');
    }else if(theGender=='male'){
        $('.gender-they').html('he');
        $('.gender-their').html('his');
        $('.gender-them').html('him');
    }
}

});
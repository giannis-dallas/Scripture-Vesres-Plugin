jQuery(document).ready(function ($) {
	
    // Smooth scroll inner links to section
	$(document).on('click', '.inner-buttons a[href^="#"]', function (event) {
		event.preventDefault();

		$('html, body').animate({
			scrollTop: $($.attr(this, 'href')).offset().top
		}, 500);
    });

    // Toggle Variables bar
    $('.variables-bar-toggle a').on('click',function (e) {
        e.preventDefault();
        console.log('click');
        var isRetracted = $('.variables-bar').hasClass('retracted');
        isRetracted ? $('.variables-bar').removeClass('retracted'): $('.variables-bar').addClass('retracted')
    })

if ($('body').hasClass('single-scripture')){

    // var isWedding = $('#main>article').hasClass('category-wedding')
    // var hasGneder = $('#main>article').hasClass('category-pronoun')
    
    // var theGroom = urlParams.get('bride');
    // var theBride = urlParams.get('groom');
        
    // if (!theName && !isWedding){
    //     scripture_Promt();
    // }
    // if (!theBride && isWedding){
    //     bride_scripture_Promt();
    // }
    // if (!theGroom && isWedding){
    //     groom_scripture_Promt();
    // }
    // if (!theGender && hasGneder){
    //     gender_scripture_Promt();
    // }

    // $('.blessed-bride-name').html('<strong>'+theBride+'</strong>');
    // $('.blessed-groom-name').html('<strong>'+theGroom+'</strong>');

    // get parameters from URL and update the values accordingly
    // if not params set the defaults

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

// function scripture_Promt() {

//     let person = prompt("Please enter your name:", "");
//     if (person == null || person == "") {
//         theName = "Loved One"
//     } else {
//       theName = person
//     }    
// }
// function bride_scripture_Promt() {

//     let bride = prompt("Please enter the Bride's name:", "");
//     if (bride == null || bride == "") {
//         theBride = "the Bride"
//     } else {
//       theBride = bride
//     }    
// }

// function groom_scripture_Promt() {

//     let groom = prompt("Please enter the Groom's name:", "");
//     if (groom == null || groom == "") {
//         theGroom = "the Groom"
//     } else {
//       theGroom = groom
//     }    

// }
// function gender_scripture_Promt() {

//     let gender = prompt("Please enter 'he' or 'she' for the prayer's use, as appropriate.", "");
//     if (gender == null || gender == "") {
//         theGender = "they"
//     } else {
//       theGender = gender
//     }    
// }

});
/* Author:

*/
$(window).load(function () {
	$(".rslides").responsiveSlides({
		auto         :true, // Boolean: Animate automatically, true or false
		speed        :1000, // Integer: Speed of the transition, in milliseconds
		timeout      :4000, // Integer: Time between slide transitions, in milliseconds
		pager        :false, // Boolean: Show pager, true or false
		nav          :false, // Boolean: Show navigation, true or false
		random       :false, // Boolean: Randomize the order of the slides, true or false
		pause        :false, // Boolean: Pause on hover, true or false
		pauseControls:false, // Boolean: Pause when hovering controls, true or false
		prevText     :"Previous", // String: Text for the "previous" button
		nextText     :"Next", // String: Text for the "next" button
		maxwidth     :"", // Integer: Max-width of the slideshow, in pixels
		controls     :"", // Selector: Where controls should be appended to, default is after the 'ul'
		namespace    :"rslides", // String: change the default namespace used
		before       :function () {
		}, // Function: Before callback
		after        :function () {
		}     // Function: After callback
	});
	/* index.php - loads first product in black bg  */
	$('#myTab a:first').tab('show');
	$('#myTab a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
	});
	/* Modal */
	$('#myModal').modal({
    keyboard: false,
    backdrop: 'static'
  });

    $('a[href="#mini-contact"]').click(function () {
	    $('html, body').animate({ scrollTop: $('#mini-contact').offset().top }, 900);
	});
  /* Remove atribute width in MSIE8 */
	function badBrowser(){
    if($.browser.msie && parseInt($.browser.version) <= 8){
      return true;
    }
    return false;
  }
  if(badBrowser()){
    $('.gallery-icon img').each(function(){
      $(this).removeAttr('width');
      $(this).removeAttr('height');
    });
  }


});

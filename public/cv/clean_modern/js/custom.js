$(document).ready(function(e) {
		
        // This function attached focus and blur events with input elements
        		var addFocusAndBlur = function($input, $val){
        			
        			$input.focus(function(){
        				if (this.value == $val) {this.value = '';}
        			});
        			
        			$input.blur(function(){
        				if (this.value == '') {this.value = $val;}
        			});
        		}
	
		// Example code to attach the events
		function fieldCheck(){
				addFocusAndBlur(jQuery('#name'),'Full Name');
				addFocusAndBlur(jQuery('#email'),'Email Address');
				addFocusAndBlur(jQuery('#number'),'Phone Number');
				addFocusAndBlur(jQuery('#message'),'Message');
			}
		
		
		// Content Height Animation
		
		function contHeight(){
			
			var currentContentHeight = $('#content').height();
			var wrapperHeight = $('#wrapper').height();
			
			
			}
		
		
		// Work LeftWrap Fix Code
		
		function portLeftGrow(){
				$('.port-list li').children('.desc').removeClass('leftgrow');
				$('.port-list li').each(function(index, element) {
					var eleCount = index + 1;
					if(eleCount%3 == 0){
							$('.port-list li:nth-child('+eleCount+')')
																	.children('.desc')
																	.addClass('leftgrow');
					}
                });
		}
		
		// Work Hover Code
		
		function portHover(){
				$('.work-image').hover(function(){
						
						$(this)
								.stop()
								.animate({
											opacity: .8
										},300);
								
						$(this)
								.parent('a')
								.parent('figure')
								.siblings('.desc')
								.not('.leftgrow')
								.stop()
								.css('display','block')
								.animate({
											left: '191px',
											opacity: 1
										 },300, function(){
															$(this).children('.descin').fadeIn(300);
														}
										);
						
						$(this)
								.parent('a')
								.parent('figure')
								.siblings('.leftgrow')
								.stop().css('display','block')
								.animate({
											left: '-207px',
											opacity: 1
										 },300, function(){
															$(this).children('.descin').fadeIn(300);
														 }
										);
						
							
				}, function(){
							$(this)
									.stop()
									.animate({
												opacity: 1
											},300);
								
							$(this)
									.parent('a')
									.parent('figure')
									.siblings('.desc')
									.not('.leftgrow')
									.stop()
									.animate({
												left: '140px',
												opacity: 0
											 }, 500, function(){ 
																	$(this).css('display','none');
																	$(this).children('.descin').css('display', 'none');
															  }
											);
							
							$(this)
									.parent('a')
									.parent('figure')
									.siblings('.leftgrow')
									.stop()
									.animate({
												left: '-170px',
												opacity: 0
											}, 500, function(){ 
																	$(this).css('display','none');
																	$(this).children('.descin').css('display', 'none');
															});
				});
		}
		
		
		// Work Filters
		
		function portFilter(){
				var allElements = $('.port-list').html();
				$('.portfolio .filter-by a').click(function(e){
						
						var filterClass = $(this).attr('data-filter'); 
						
						$('.port-list').animate({opacity: 0}, 500, function(){
								$('.port-list').empty();
								$('.port-list').html(allElements);
								$('.port-list li').not('.'+filterClass).remove();
								portLeftGrow(filterClass);
								portHover();
								$('.prettyPhoto').prettyPhoto();
								$('.port-list').animate({opacity: 1}, 500);
						});
						e.preventDefault();
				});
		}
		
		
		
		// Selectbox code
		
		function selectboxes(){
				$('#interested').selectbox();	
		}
		
		
		// Contact Form Code
		
		// Form Ajax Plugin : http://www.malsup.com/jquery/form/
		var contact_options = { 
							target: '#message-sent',
							beforeSubmit: function(){
													$('#loading').fadeIn('fast');
													$('#message-sent').fadeOut('fast');
											}, 
							success: function(){
												$('#loading').fadeOut('fast');
												$('#message-sent').fadeIn('fast');
												$('#contact-form').resetForm();
											}
			};
			
		// Contact Form AJAX Function for Contact Page

		var contactFromFn = function(){
				$('#contact-form').validate({
					submitHandler: function(form) {
				   		$(form).ajaxSubmit(contact_options);
				   }
				});
		}

		
		
		// Skill levels animation
		
		function skillBars() {
				$('.skill-list li .level span').css('width','0px');
				$('.skill-list li .level span').each(function(index, element) {
						
						var plevel = $(this).attr('title');
						$(this).animate({width: plevel+'%'}, 1500);
		        });
		}
		
		// Wrapper Height Animation
		
		function heightAnimation() {
			
			var curContentHeight = $('#content').height();
			var totalHeight = curContentHeight + 220;
			if(totalHeight > 532){
				$('#wrapper').animate({height: totalHeight+'px'}, 1000);
			} else {
				$('#wrapper').animate({height: '532px'}, 1000);
			}
				
		}

		// Function for page switch
		
		var firstContact = $('.homepage-section').html();
		
		$('#content').html(firstContact);
		
		function contentInsert(titleClicked){
				
				var theContents = '<h2>No Content Loaded</h2>'
				
				if(titleClicked == 'homepage') { 
						
						theContents = $('.homepage-section').html(); 
				
				} else if(titleClicked == 'work') { 
						
						theContents = $('.work-section').html(); 
				} else if(titleClicked == 'resume') {  
				
						theContents = $('.resume-section').html(); 
						
				} else if(titleClicked == 'contact') {  
				
						theContents = $('.contact-section').html(); 
				
				}
				
				$('#content').html(theContents);
		}
		
		
		
		$('.main-nav ul li a').click(function(e){
			
			var curWrapHeight = $('#wrapper').height();
			$('#wrapper').height(curWrapHeight);
			
			var parent_this = $(this).parent('li');
			var pageRef = $(this).attr('title');
			$('#content').fadeOut(500, function(){
					$('#page-loader').fadeIn(500);
					
					
					contentInsert(pageRef);
				
					$('#page-loader').fadeOut(500, function(){
							
							heightAnimation();
							
							$('#content').fadeIn(500);
							$('.main-nav ul li').removeClass('active');
							parent_this.addClass('active');
							
							if(pageRef == 'resume'){ 
									skillBars(); 
								}
							
							if(pageRef == 'contact'){
									selectboxes();
									contactFromFn();
									fieldCheck();
								}
							
							if(pageRef == 'work'){
									portHover();
									portLeftGrow();
									portFilter();
									$('.prettyPhoto').prettyPhoto();
								}
					});
			});
			
			e.preventDefault();
		
		});
		
});
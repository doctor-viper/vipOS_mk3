	
	function initPage(){};


  $(document).ready(function(){
    

    if($('.carousel').length) {
	    
	    var slideIndex = 0;
	    showSlides();

	    function showSlides() {
	      var i;
	      var slides = document.getElementsByClassName("carousel-container");
	      for (i = 0; i < slides.length; i++) {
	        slides[i].style.display = "none";
	      }
	      slideIndex++;
	      if (slideIndex > slides.length) {slideIndex = 1}
	      slides[slideIndex-1].style.display = "block";
	      setTimeout(showSlides, 20000); // Change image every 2 seconds
	    }

	    (function updateOverlay() {
	      $.ajax({
	        type: 'GET',
	        cache: false,
	        url: '/viposmk3/_data/data.json', 
	        dataType: 'json',
	        success: function (data) { 
	          $('.follower-text').text(data.follower);
	          $('.subscriber-text').text(data.subscriber);
	          $('.bits-leader-text').text(data.bits_leader);
	          $('.bits-amt').text(data.bits_amt);
	          $('.goal-text').html(data.goal);

	          $('.sub-count-text').text(data.sub_count);
	          $('.sub-count-goal-text').text(data.goal_num);
	        },
	        complete: function() {
	          // Schedule the next request when the current one's complete
	          setTimeout(updateOverlay, 100);
	        }
	      });
	    })();

	  }


	  if($('.overlay-bar'.length)) {

	  	(function updateOverlay() {
	      $.ajax({
	        type: 'GET',
	        cache: false,
	        url: '/viposmk3/_data/data.json', 
	        dataType: 'json',
	        success: function (data) { 
	          $('.follower-text').text(data.follower);
	          $('.subscriber-text').text(data.subscriber);
	          $('.bits-leader-text').html(data.bits_leader + "&nbsp;&nbsp;@&nbsp;&nbsp;" + data.bits_amt);
	          //$('.bits-amt').text(data.bits_amt);

	          $('.sub-count-text').text(data.sub_count);
	          $('.sub-count-goal-text').text(data.goal_num);
	        },
	        complete: function() {
	          // Schedule the next request when the current one's complete
	          setTimeout(updateOverlay, 100);
	        }
	      });
	    })();


	  }

  });  
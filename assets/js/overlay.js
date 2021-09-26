  $(document).ready(function(){
    
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

  });  
/* --------------------------------
  The Crest - Vince Camuto
  Author: Neil Tan - neil@fueled.com
--------------------------------- */
$(document).ready(function() {

    // Home Carousel 
    $('#home-carousel').nivoSlider({
        effect:'fade',
        animSpeed: 500,
        pauseTime: 6000,
        startSlide: 0,
        randomStart: false
    });
    
    /*
     * Rewriting the Toggle function
    **/
    $(window).load(function() {
      captionHeight = $('.nivo-caption').height() + 40;
    });
    $(document).on('click', 'a.arrow', function(e) {
      currentHeight = captionHeight;
      if($('.nivo-caption').hasClass('up')) {
        $('.nivo-caption').removeClass('up');
        $('a.arrow').removeClass('up');
        $('.nivo-caption').animate({
          //height: currentHeight + 20
          height: currentHeight
        }, 500);
      } else {
        $('.nivo-caption').animate({ height:"20px" }, 500);
        $('.nivo-caption').addClass('up');
        $('a.arrow').addClass('up');
      }
      e.preventDefault();
    });
     
    // Features list
    $('ul#features-list li').slice(-2).css('border-bottom','0');  
    
    // Creating animations for article carousel 
    function captionMoveIn(){
      $('.nivo-caption').slideDown(850, 'easeInOutSine').removeClass('up');
      $('a.arrow').removeClass('up');
    }
    function captionMoveInSmall() {
      $('.nivo-caption').hide().css('height', 'auto');
      $('.nivo-caption').slideDown(850, 'easeInOutSine', function() {
        captionHeight = $('.nivo-caption').height() + 40;
      }).removeClass('up');
      $('a.arrow').removeClass('up');
    }
    
    // Caption Moves Out
    function captionMoveOut(){
      $('.nivo-caption').slideUp(850, 'easeInOutSine', function() {
        captionHeight = $('.nivo-caption').height() + 40;
      });
    }
    
    // Resetting the Height to Auto
    function resetHeight(){
      $('.nivo-caption').height('auto');
    }
    
    // Article Based Carousel
    $('#article-carousel').nivoSlider({
        effect:'fade',
        animSpeed: 500,
        pauseTime: 6000,
        startSlide: 0,
        randomStart: false,
        afterLoad: function(){
          captionMoveIn();
          captionHeight = $('.nivo-caption').height() + 40;
        },
        beforeChange: function(){
          var cH = $('.nivo-caption').height();
          if(cH > 90) {
            resetHeight();
            captionMoveOut();
          }
        },
        afterChange: function() {
          var cH = $('.nivo-caption').height();
          if(cH > 90) {
            captionMoveIn();
          } else {
            captionMoveInSmall();
          }
        }
    });
    
    // Product Carousels
    $(".scroller").scrollable({ circular: true }); //For all of the product Carousels
    
      // Twitter Feed
      $.getJSON("https://api.twitter.com/1/statuses/user_timeline/vincecamuto.json?count=4&include_rts=0&exclude_replies=true&callback=?", function(data) {
       $("#twitter").html("<p class='tweet'>" + data[0].text + "</p>");
      });
      
        // Infinite Scrollage
        $('nav.pagination').hide(); // Hide More Button        
        var count = 0;
        $('#content').infinitescroll({  
          itemSelector: "#content .post",
          animate: true,
          debug: false
        }, function(){
            count++;
            if(count == 3){
              $('nav.pagination').show(); // Show More Button
              $(window).unbind('.infscr');     
            }
            console.log(count); // Remove
        });
        
        // Load More Button
        $('nav.pagination a').click( function(){
            // $('#content div.post').load('post id or query needs to go here');
            console.log('load more clicked!');
                $('nav.pagination').hide();
                $('#content').infinitescroll('retrieve');
                $('nav.pagination').show();
            return false;
        });

        // remove the paginator when we're done.
        $(document).ajaxError(function(e,xhr,opt){
          if (xhr.status == 404) $('nav.pagination a:first').remove();
        });
        
        
    // FILM PAGE FANCYBOX
    $(".video-thumb").click(function() {
        $.fancybox({
          'padding' : 0,
          
          // hide the related video suggestions and autoplay the video
          'href' : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
          'overlayShow' : true,
          'centerOnScroll' : true,
          'speedIn' : 100,
          'speedOut' : 50,
          'width' : 651,
          'height' : 357,
          'type' : 'swf',
          'swf' : {
            'wmode' : 'transparent',
            'allowfullscreen' : 'true'
           }
        });
    return false;
  });
            
}); //JQuery Ready Ends


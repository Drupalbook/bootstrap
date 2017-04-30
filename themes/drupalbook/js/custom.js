(function ($) {
  Drupal.behaviors.portfolioBlock = {
    attach: function (context, settings) {

      $('.view-portfolio-filters > .view-content').once('add-all').prepend('<button class="button" data-filter="*">All</button>');

      // init Isotope
      var $grid = $('.view-gallery-front > .view-content').isotope({
        itemSelector: '.views-row',
        layoutMode: 'fitRows'
      });

      // bind filter button click
      $('.view-portfolio-filters').once().on( 'click', 'button', function() {
        var filterValue = $( this ).attr('data-filter');
        $grid.isotope({ filter: filterValue });
      });

    }
  };
})(jQuery);
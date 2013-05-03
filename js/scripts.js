// PopupThis - the Simplest utility to generate your content popups
//=================================================================

var dc;
(function($){
	dc = 
	{
		init: function()
		{
			var autoDimensions, customWidth, customHeight;
			$('.popupthis').each(function(){
				autoDimensions = ( $(this).data('auto-dimensions') ) ? false : true;
				customWidth = ( $(this).data('custom-width') )? $(this).data('custom-width') : 'auto';
				customHeight = ( $(this).data('custom-height') )? $(this).data('custom-height') : 'auto';
				$(this).fancybox({
			    	width : customWidth,
			    	height : customHeight,
			    	autoDimensions: autoDimensions
				});
			});
		}
	}

})(jQuery); 
	
$(document).ready(function(){
	dc.init();
});
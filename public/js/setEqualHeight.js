jQuery.noConflict();
(function($){
    "use strict";
    $(document).ready(function(){
        $.fn.extend({
            setEqualHeight: function(chunkSize){
                var length = this.length;
                if(typeof(chunkSize) == 'undefined'){chunkSize = length;}
                for (var i=0; i<length; i+=chunkSize){
                    var columns = this.slice(i, i+chunkSize);
                    var max = 0;
                    columns.each(function(){
                        var current = $(this).height();
                        if(current > max) {max = current;}
                    });
                    columns.height(max);
                }
            }
        });
    });
})(jQuery);
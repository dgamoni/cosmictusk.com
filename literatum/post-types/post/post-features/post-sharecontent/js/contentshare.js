/*
 * @build  : 24 Aug, 2013
 * @author : Ram swaroop
 * @company: Compzets.com
 * Modification by Rafael Martín (@kohette) 05 Oct 2014
 */
(function($){
    $.fn.contentshare = function(options) {        
        // fetch options
        var opts = $.extend({},$.fn.contentshare.defaults,options);
        
        $.extend($.fn.contentshare,{
            
            init : function(shareable) {
                $.fn.contentshare.defaults.shareable = shareable;
            },
            getContent : function() {
                var content="";
                for(var i=0;i<opts.shareLinks.length;i++){
                    //content+='<a href="'+opts.shareLinks[i]+this.getSelection()+'" '+((opts.newTab)?"target=\"_blank\"":"")+'><i>&#'+opts.shareIcons[i]+';<i></a>';
                    var lefts = (screen.width/2)-(450/2);
                    var tops = (screen.height/2)-(350/2);
                    content+='<a onclick="window.open('+ "'" + opts.shareLinks[i]+this.getSelection() + "'" +  ",'','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=450,height=350, top=" + tops + ", left=" + lefts + "')"    + '"><i>&#'+opts.shareIcons[i]+';<i></a>';
                }
                return content;
            },
            getSelection : function(option) {
                if(window.getSelection){
                    return (option=='string')?encodeURIComponent($.trim(window.getSelection().getRangeAt(0).toString())):window.getSelection().getRangeAt(0);
                }
                else if(document.selection){
                    return (option=='string')?encodeURIComponent($.trim(document.selection.createRange().text)):document.selection.createRange();
                }
            },                
            showTooltip : function() {
                this.clear();
                if(this.getSelection('string').length < opts.minLength)
                    return;
                var range = this.getSelection();
                var newNode = document.createElement("mark");
                var content = this.getContent()

                range.surroundContents(newNode);
                $('mark').addClass(opts.className);
                $('.'+opts.className).tooltipster({trigger:'custom',interactive:true,content:content,animation:opts.animation});
                $('.'+opts.className).tooltipster('show');
              

            },
            
            clear : function() {
                $('.'+opts.className).tooltipster('hide');
                $('mark').contents().unwrap();
                $('mark').remove();
            }
        });        
        
        // initialize the awesome plugin
        $.fn.contentshare.init(this);
    };
    
    // default options
    $.fn.contentshare.defaults = {
        shareable  : {},
        shareIcons : ["xe90a","xe908"],
        shareLinks : ["http://www.facebook.com/sharer/sharer.php?s=100&u="+document.URL+"&title="+document.title+"&summary=" , "http://twitter.com/intent/tweet?url="+document.URL+"&text="],
        minLength  : 5,
        newTab     : true,
        className  : "contentshare",
        animation  : "fade"
    };

}(jQuery));

// calling the plugin on DOM ready
jQuery(document).ready(function(){
    jQuery("article p").contentshare();
    jQuery.fn.contentshare.defaults.shareable.on('mouseup',function(){
        jQuery.fn.contentshare.showTooltip();
    });            
});
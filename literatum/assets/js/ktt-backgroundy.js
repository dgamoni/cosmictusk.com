/**
* Carga imagenes de fondo en un elemento (div, span, etc)
* use: jQuery( ".ktt-backgroundy" ).ktt_backgroundy();
*/
jQuery.fn.ktt_backgroundy = function() {

    /**
    * Obtenemos la version thumb de la imagen
    */
    var thumb = this.data( "background-thumb");

    /**
    * Obtenemos la version large de la imagen
    */
    var large = this.data( "background-large");

    /**
    * Guardamos una referencia al elemento padre
    */
    var this_elem = this;

    /**
    * Lo ponemos relative
    */
    this_elem.css("position", "relative");
    //this_elem.css("overflow", "auto");

    /**
    * Vamos a meter el contenido del elemento en un nuevo div que pondremos
    * con position absolute para que el contenido aparezca siempre por encima
    * de los divs que contienen las imagenes de fondo
    */
    var content_div = jQuery('<div/>', {'html':this_elem.html()})
    .css("position", "relative")
    .css("width", "100%")
    .css("z-index", "10")
    .css("height", "100%")

    /**
    * Añadimos el div al elementos
    */
    this_elem.html('').prepend(content_div);

    /**
    * En primer lugar cargamos la imagen pequeñita
    */
    var img = jQuery("<img />").attr('src', thumb)
      .load(function() {
          if (this.complete || typeof this.naturalWidth != "undefined" || this.naturalWidth != 0) {

              var thumb_div = jQuery('<div/>')
              .addClass('bg-loady-thumb')
              .css("opacity", "0")
              .css("position", "absolute")
              .css("width", "100%")
              .css("height", "100%")
              .css("z-index", "1")
              .css("background-position", "center center")
              .css("background-size", "cover")
              .css("background-image", "url('" + this.src + "')")

              .css('filter','blur(5px)')
              .css('webkitFilter','blur(5px)')
              .css('mozFilter','blur(5px)')
              .css('oFilter','blur(5px)')
              .css('msFilter','blur(5px)');

              /**
              * Añadimos el div al elementos
              */
              this_elem.prepend(thumb_div);

              /**
              * Animamos el opacity
              */
              thumb_div.fadeTo("fast", 1);


              /**
              * Una vez que hemos cargado el thumb vamos a intentar cargar la imagen larges
              */
              var img = jQuery("<img />").attr('src', large)
                .load(function() {
                    if (this.complete || typeof this.naturalWidth != "undefined" || this.naturalWidth != 0) {

                        var large_div = jQuery('<div/>')
                        .addClass('bg-loady-large')
                        .css("opacity", "0")
                        .css("position", "absolute")
                        .css("width", "100%")
                        .css("height", "100%")
                        .css("z-index", "2")
                        .css("background-position", "center center")
                        .css("background-size", "cover")
                        .css("background-image", "url('" + this.src + "')")

                        /**
                        * Añadimos el div al elementos
                        */
                        this_elem.prepend(large_div);

                        /**
                        * Animamos el opacity
                        */
                        large_div.fadeTo("slow", 1, function() {
                            thumb_div.remove();
                        });



                    }
                });


          }
      });




};

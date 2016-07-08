<div id="footer" class="navbar navbar-fixed-bottom navbar-default">
    <div class="footer" >
          <div class="col-md-4"> </div>
              <div class=" col-md-4" style="text-align: center; bottom:0">
                <h4>  © 2016 Copyright: <a href="http://www.AnsQuick.com"> AnsQuick.com </a></h4>
              </div>
          <div class="col-md-4"></div>
        </div>
      </div>
      </div>
        </body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<!-- x-editable Jquery (bootstrap version) -->
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>


<!--Jquery for Autocomplete -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="<?php echo base_url('js/index.js'); ?>"></script>

<script type="text/javascript">

jQuery(document).ready(function(){
                function split( val ) {
                    return val.split( /,\s*/ );
                }
                function extractLast( term ) {
                    return split( term ).pop();
                }

                $('#tags').autocomplete({
                minLength : 1,
                    source: function( request, response ) {
                              $.getJSON( "http://www.AnsQuick.com/index.php/TagSuggester", {
                                  term: extractLast( request.term )
                              }, response );
                            },
										appendTo : $('#postQuestionForm'),
										autoFocus:true,
                    select: function( event, ui ) {
                              var terms = split( this.value );
                              // remove the current input
                              terms.pop();
                              // add the selected item
                              terms.push( ui.item.value );
                              // add placeholder to get the comma-and-space at the end
                              terms.push( "" );
                              this.value = terms.join( ", " );
                              return false;
                             }


              });
        $("#searchBox").autocomplete({
          minLength : 1,
          source: function( request, response ) {
                    $.getJSON( "http://www.AnsQuick.com/index.php/TagSuggester", {
                        term: extractLast( request.term )
                    }, response );
                  },
          appendTo : $('#searchBoxForm'),
          autoFocus:true,
          select: function( event, ui ) {
              window.location.replace("http://www.ansquick.com/index.php/tag/recent/"+ui.item.value);
                    return false;
                   }
        });


});

</script>

</html>

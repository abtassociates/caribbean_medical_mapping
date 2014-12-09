$(function(){
  $('[data-method]').each(function(){
    var $node = $(this);
    $('body').append(function(){

      var $form = $("<form action='"+$node.attr('href')+"' method='POST' style='display:none'>"+
                  "   <input type='hidden' name='_method' value='"+$node.attr('data-method')+"'>"+
                  "</form>").removeAttr('href').attr('style','cursor:pointer;');

      $node.click(function(e){
        e.preventDefault();
        confirm_delete($form);
      });

      return $form;
    });
  });
});


function confirm_delete($form){
	if(confirm('Delete?')){
		$form.submit();
	}else{
    $form.remove();
  }
}

function get_form_method(form){

  var $pseudo = $(form).find('input[name=_method]');

  var method = $pseudo ?
               $pseudo.val() :
               $form.attr('method');
  
  return method;
}

// widget enhancement

$('.chosen').chosen({
  placeholder_text_multiple: 'select choice(s)',
  placeholder_text_single: 'type or select',
  allow_single_deselect: true
});

$('.chosen-no-search').chosen({disable_search: true});

$('.date').datepicker({ dateFormat: "yy-mm-dd" });

$('.colorpicker').colorpicker();

$('.popup').popover({trigger: 'hover'});
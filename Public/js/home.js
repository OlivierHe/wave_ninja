/**
 *  * Created by Olivier Herzog on 14/08/2017.
 */
$(document).ready(function () {
    $('.pagination li a').click(function(e){
        e.preventDefault();
        $val = $(this).html();
        $visNum = 0;
        $('.pagination li a').each(function() {
            //console.log($val+ ' ' + $(this).html());
            if ($val === $(this).html()) {
                $(this).parent().addClass('active');
            }else {
                $(this).parent().removeClass('active');
            }
        });
        $maxPage = $(this).html()* 3;
        $('.post').each(function() {
          $id = $(this).data("id") + 1;
          if($id <= $maxPage && $id >= $maxPage - 2) {
              $(this).removeAttr('hidden');
              // permet de supprimer le bottom paginate
              // si moins de 3 articles visibles
              $visNum ++;
              if($visNum < 3) {
                  $(".pagibot").attr("hidden",true);
              }else {
                  $(".pagibot").attr("hidden",false);
              }
          }else{
              $(this).attr("hidden", true);
          }
        });

    });

});

/**
 *  * Created by Olivier Herzog on 14/08/2017.
 */
$(document).ready(function () {

   function urlPrev(){
     
     $urlPrevImg = $("#previmg").attr("src");
     $result = $urlPrevImg.split('/');
     $result[6] = $("#donne").val();
     $result[7] = $("#heureprev").val();
     $result = $result.join("/");
     $("#previmg").attr("src",$result);
  }

  function getPrevRange(){
    // affiche l'array correspondant à la date array vide si pas de prev pour date;
    $('select#heureprev option').remove();
    $arrPrevFiles = $('#prevfiles').data('prevfiles');
    $currHour = $('#currhour').data('currhour');


    $b = $.grep($arrPrevFiles, function(item) {
      return item.indexOf($( "input[name='_submit']" ).val()) >= 0;
   });

   if($b.length == 0 ) {
      swal(
        'Erreur de prévision',
        'Pas de prévision à l\'heure ou la date donnée',
        'error'
      );
        return 'error';
   }

  $selIndex = 0;
  $animRun = true;
  $anim = 'blob';

  $.each($b, function (i, item) {
    // va récuperer la valeur de l'heure actuelle dans l'index;
    if(item.substring(11,13) == $currHour) {
      $selIndex = i;
    }
      $('#heureprev').append($('<option>', { 
          value: item,
          text : (item.substring(11,13)) + ":00"
      }));
    });
  // permet de selectionner l'heure correspondante à l'heure actuelle
  $("select#heureprev").prop('selectedIndex', $selIndex);
  $('select').material_select();
  }

  $('.datepicker').pickadate({
    selectMonths: false, // Creates a dropdown to control month
    selectYears: false, // Creates a dropdown of 110 years to control year
    min: true, // mini today
    max: 4, // 
    monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
    monthsShort: ['Jan', 'Fév', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil', 'Août', 'Sept', 'Oct', 'Nov', 'Déc'],
    weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
    weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
    weekdaysLetter: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
    today: 'Aujourd\'hui',
    formatSubmit: 'yyyy-mm-dd',
    close: 'Fermer',
    clear: false,
    format: 'ddd dd mmmm yyyy'
  });

 $('select').material_select();

  getPrevRange();
  urlPrev();
 

  $('#donne').on('change', function() {
      urlPrev();
  });

  $('#dateprev').on('change', function() {
    getPrevRange();
    urlPrev();
  });

  $('#heureprev').on('change', function() {
    urlPrev();
  });

  $('#nextimg').click( function() {
     $("#heureprev > option:selected")
          .prop("selected", false)
          .next()
          .prop("selected", true);
     $('select').material_select();
     urlPrev();
  });



  $('#animateimg').click( function() {
    // toggle animation
       if ($animRun) {
          $anim = setInterval(function(){
                $("#heureprev > option:selected")
                    .prop("selected", false)
                    .next()
                    .prop("selected", true);

               $('select').material_select();
               urlPrev(); 
              }, 500);
          $animRun = false;
         } else {
          clearInterval($anim);
          $animRun = true;
        }    
  });

});

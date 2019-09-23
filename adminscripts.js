jQuery('.lsp-advanced').hide();
jQuery('.lsp-show-advanced').click(function(){
  jQuery('.lsp-advanced').toggle();
});



jQuery('.lsp-advanced2').hide();
jQuery('.lsp-show-advanced2').click(function(){
  jQuery('.lsp-advanced2').toggle();
});





if((jQuery('select[name=lsp-set-type]').val()=='local') || (jQuery('select[name=lsp-set-type]').val()=='localCities')){
  jQuery('input[name=lsp-exclude-states]').parent().hide();
  jQuery('input[name=lsp-exclude-countries]').parent().hide();
  jQuery('input[name=lsp-add-countries]').parent().hide();
  jQuery('input[name=lsp-national-population-limit]').parent().hide();
  jQuery('input[name=lsp-international-population-limit]').parent().hide();
}
if((jQuery('select[name=lsp-set-type]').val()=='national') || (jQuery('select[name=lsp-set-type]').val()=='nationalStates') || (jQuery('select[name=lsp-set-type]').val()=='nationalCities')){
  jQuery('input[name=lsp-exclude-states]').parent().show();
  jQuery('input[name=lsp-exclude-countries]').parent().hide();
  jQuery('input[name=lsp-add-countries]').parent().hide();
  jQuery('input[name=lsp-national-population-limit]').parent().show();
  jQuery('input[name=lsp-international-population-limit]').parent().hide();
}
if((jQuery('select[name=lsp-set-type]').val()=='international') || (jQuery('select[name=lsp-set-type]').val()=='internationalCountries') || (jQuery('select[name=lsp-set-type]').val()=='internationalStates') || (jQuery('select[name=lsp-set-type]').val()=='internationalCities')){
  jQuery('input[name=lsp-exclude-states]').parent().show();
  jQuery('input[name=lsp-exclude-countries]').parent().show();
  jQuery('input[name=lsp-add-countries]').parent().show();
  jQuery('input[name=lsp-national-population-limit]').parent().show();
  jQuery('input[name=lsp-international-population-limit]').parent().show();

}
jQuery('select[name=lsp-set-type]').change(function(){
  if((jQuery('select[name=lsp-set-type]').val()=='local') || (jQuery('select[name=lsp-set-type]').val()=='localCities')){
    jQuery('input[name=lsp-exclude-states]').parent().hide();
    jQuery('input[name=lsp-exclude-countries]').parent().hide();
    jQuery('input[name=lsp-add-countries]').parent().hide();
    jQuery('input[name=lsp-national-population-limit]').parent().hide();
    jQuery('input[name=lsp-international-population-limit]').parent().hide();
  }
  if((jQuery('select[name=lsp-set-type]').val()=='national') || (jQuery('select[name=lsp-set-type]').val()=='nationalStates') || (jQuery('select[name=lsp-set-type]').val()=='nationalCities')){
    jQuery('input[name=lsp-exclude-states]').parent().show();
    jQuery('input[name=lsp-exclude-countries]').parent().hide();
    jQuery('input[name=lsp-add-countries]').parent().hide();
    jQuery('input[name=lsp-national-population-limit]').parent().show();
    jQuery('input[name=lsp-international-population-limit]').parent().hide();

  }
  if((jQuery('select[name=lsp-set-type]').val()=='international') || (jQuery('select[name=lsp-set-type]').val()=='internationalCountries') || (jQuery('select[name=lsp-set-type]').val()=='internationalStates') || (jQuery('select[name=lsp-set-type]').val()=='internationalCities')){
    jQuery('input[name=lsp-exclude-states]').parent().show();
    jQuery('input[name=lsp-exclude-countries]').parent().show();
    jQuery('input[name=lsp-add-countries]').parent().show();
    jQuery('input[name=lsp-national-population-limit]').parent().show();
    jQuery('input[name=lsp-international-population-limit]').parent().show();
  }
});

jQuery('.pform').hide();
jQuery('#pformapi').show();



jQuery('#submitter').click(function(e){
    

  jQuery('#lsp-locationData1').val(jQuery('#location1 input, #location1 select').serialize());
  jQuery('#location1').remove();

});


jQuery('#menu-posts-localproject li:nth-child(6)').removeClass('current').attr('target','_blank');
jQuery('#menu-posts-localproject li:nth-child(7)').removeClass('current').attr('target','_blank');



jQuery('.storeLocation').hide();

if(jQuery('#storelocations').val()=='yes')jQuery('.storeLocation').show();
if(jQuery('#storelocations').val()!='yes')jQuery('.storeLocation').hide();

jQuery('#storelocations').change(function(){
  if(jQuery('#storelocations').val()=='yes')jQuery('.storeLocation').show();
  if(jQuery('#storelocations').val()=='no')jQuery('.storeLocation').hide();
});

jQuery('#showMoreReviewsDiv').hide();
jQuery('#showMoreReviews').click(function(){
  jQuery('#showMoreReviewsDiv').toggle();
  jQuery('#showMoreReviews').hide();
});





jQuery('#moreReviewOptions').hide();
jQuery('#showMoreReviewOptions').click(function(event){
event.preventDefault();
jQuery('#moreReviewOptions').toggle();
});

jQuery('#feedbackdiv').hide();
jQuery('#feedbacklink').click(function(){
  jQuery('.pform').hide();
  jQuery('#feedbackdiv').toggle();
});


jQuery('#advanced').click(function(){
jQuery('.pform').hide();
jQuery('#aform').show();
jQuery('#portfoliolinks').toggle();
});







jQuery('.percents').hide();
jQuery('#percent1').show();

jQuery('.discern').hide();
if(jQuery('#lspbiztype').val()=='lsec') jQuery('.discern').show();
jQuery('#lspbiztype').change(function(){
  if(jQuery('#lspbiztype').val()=='lsec') jQuery('.discern').show();
  else jQuery('.discern').hide();
});

jQuery('#percent1').click(function(){jQuery('#percent2').show();});
jQuery('#percent2').click(function(){jQuery('#percent3').show();});
jQuery('#percent3').click(function(){jQuery('#percent4').show();});
jQuery('#percent4').click(function(){jQuery('#percent5').show();});
jQuery('#percent5').click(function(){jQuery('#percent6').show();});
jQuery('#percent6').click(function(){jQuery('#percent7').show();});
jQuery('#percent7').click(function(){jQuery('#percent8').show();});
jQuery('#percent8').click(function(){jQuery('#percent9').show();});
jQuery('#percent9').click(function(){jQuery('#percent10').show();});


jQuery('#lsp-services').focus(function(){jQuery('#percent2').show();});
jQuery('#lsp-services2').focus(function(){jQuery('#percent3').show();});
jQuery('#lsp-services3').focus(function(){jQuery('#percent4').show();});
jQuery('#lsp-services4').focus(function(){jQuery('#percent5').show();});
jQuery('#lsp-services5').focus(function(){jQuery('#percent6').show();});
jQuery('#lsp-services6').focus(function(){jQuery('#percent7').show();});
jQuery('#lsp-services7').focus(function(){jQuery('#percent8').show();});
jQuery('#lsp-services8').focus(function(){jQuery('#percent9').show();});
jQuery('#lsp-services9').focus(function(){jQuery('#percent10').show();});


if(jQuery('#lsp-services').val()!='')jQuery('#percent2').show();
if(jQuery('#lsp-services2').val()!='')jQuery('#percent3').show();
if(jQuery('#lsp-services3').val()!='')jQuery('#percent4').show();
if(jQuery('#lsp-services4').val()!='')jQuery('#percent5').show();
if(jQuery('#lsp-services5').val()!='')jQuery('#percent6').show();
if(jQuery('#lsp-services6').val()!='')jQuery('#percent7').show();
if(jQuery('#lsp-services7').val()!='')jQuery('#percent8').show();
if(jQuery('#lsp-services8').val()!='')jQuery('#percent9').show();
if(jQuery('#lsp-services9').val()!='')jQuery('#percent10').show();


jQuery('#lsp-services').change(function(){jQuery('#lsp-suggest1').val(jQuery('#lsp-services').val());});
jQuery('#lsp-services2').change(function(){jQuery('#lsp-suggest2').val(jQuery('#lsp-services2').val());});
jQuery('#lsp-services3').change(function(){jQuery('#lsp-suggest3').val(jQuery('#lsp-services3').val());});
jQuery('#lsp-services4').change(function(){jQuery('#lsp-suggest4').val(jQuery('#lsp-services4').val());});
jQuery('#lsp-services5').change(function(){jQuery('#lsp-suggest5').val(jQuery('#lsp-services5').val());});
jQuery('#lsp-services6').change(function(){jQuery('#lsp-suggest6').val(jQuery('#lsp-services6').val());});
jQuery('#lsp-services7').change(function(){jQuery('#lsp-suggest7').val(jQuery('#lsp-services7').val());});
jQuery('#lsp-services8').change(function(){jQuery('#lsp-suggest8').val(jQuery('#lsp-services8').val());});
jQuery('#lsp-services9').change(function(){jQuery('#lsp-suggest9').val(jQuery('#lsp-services9').val());});
jQuery('#lsp-services10').change(function(){jQuery('#lsp-suggest10').val(jQuery('#lsp-services10').val());});

jQuery('#biztype').change(function(){
  if(jQuery('#biztype').val() == 'media') jQuery('.localsetup').hide();
  if(jQuery('#biztype').val() != 'media') jQuery('.localsetup').show();
})
if(jQuery('#biztype').val() == 'media'){ jQuery('.localsetup').hide();}
if(jQuery('#biztype').val() != 'media'){ jQuery('.localsetup').show();}





jQuery('#mapsboosterdiv').hide();
jQuery('#mapsboosterlink').click(function(){
  jQuery('#mapsboosterdiv').toggle();
})


jQuery('#blogboosterdiv').hide();
jQuery('#blogboosterlink').click(function(){
  jQuery('#blogboosterdiv').toggle();
})



var isholder;
isholder = jQuery('#menuurl').html();
jQuery('#menuurl').html('');

jQuery('#iservice').change(function(){
  if(jQuery('#iservice').val()=='service')jQuery('#menuurl').html(isholder+'servicesportfolio/'+jQuery('#menuphrase').val().toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-')+'/').toLowerCase();
  if(jQuery('#iservice').val()=='industry')jQuery('#menuurl').html(isholder+'industriesportfolio/'+jQuery('#menuphrase').val().toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-')+'/').toLowerCase();
});
jQuery('#menuphrase').keyup(function(){
  if(jQuery('#iservice').val()=='service')jQuery('#menuurl').html(isholder+'servicesportfolio/'+jQuery('#menuphrase').val().toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-')+'/').toLowerCase();
  if(jQuery('#iservice').val()=='industry')jQuery('#menuurl').html(isholder+'industriesportfolio/'+jQuery('#menuphrase').val().toLowerCase().replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-').replace(' ','-')+'/').toLowerCase();
});

  
jQuery('.lsp-links').hide();
jQuery('.lsp-show-links').click(function(){
  jQuery('.lsp-links').toggle();
});

  jQuery('#colorOptions').hide();
jQuery('#colorsLink').click(function(){
  jQuery('#colorOptions').toggle();
});


jQuery('#splittestsdiv').hide();
jQuery('#splittestslink').click(function(){
  jQuery('#splittestsdiv').toggle();
})

jQuery('#reviewssetupdiv').hide();
jQuery('#reviewssetuplink').click(function(){jQuery('#reviewssetupdiv').toggle()});


jQuery('#portfoliosetupdiv').hide();
jQuery('#portfoliosetuplink').click(function(){jQuery('#portfoliosetupdiv').toggle()});




function ucwords(str){
  return (str+'').replace(/^(.)|\s+(.)/g, function ($1){
    return $1.toUpperCase()
  })
}

jQuery('#publish4').click(function(event){
  event.preventDefault();
  //alert('hi');
  var data = jQuery('#title').val() + tinymce.editors.content.getContent();   
  if(jQuery('#lsp_post_content_topics').val()!="") data = jQuery('#lsp_post_content_topics').val()+"||";
  //alert(data);
  jQuery('#publish7').before('<image id="loading" src=images/loading.gif>');

  jQuery.post(ajaxurl,{'action':'lsp_ajax','data':data,'dataType':'text'},function(response){
    //alert(response);  
    var holder = response.split("THEDIVIDER");

    jQuery('#suggestedfocus').html(holder[0]);
	 //alert(response);		
    var json = JSON.parse(holder[1]);
    //alert(holder[0]);
    //alert(holder[1]);
	   //alert('parsed');  
     //alert(json["results"].length);
    //alert("rolling");
     var suggestedkeywords = "";
     for (var i = 0; i<json["results"].length; i++){
    //  alert(i+json["results"][i]["keyword"]);
      if(json["results"][i]!=null) suggestedkeywords += json["results"][i]["keyword"] + ", ";
     }
     //alert("suggested"+suggestedkeywords);
     jQuery('#suggestedworkin').html(suggestedkeywords);
     //alert('parsed3');
  });
 jQuery('#loading').remove();
});



jQuery('#publish7').click(function(event){
  event.preventDefault();
  //alert('hi');
  var data = jQuery('#title').val() + tinymce.editors.content.getContent();
  if(jQuery('#lsp_post_content_topics').val()!="") data = jQuery('#lsp_post_content_topics').val()+"||";
  //alert(data);
  jQuery('#publish4').after('<image id="loading" src=images/loading.gif>');
  jQuery.post(ajaxurl,{'action':'lsp_ajax','data':data,'dataType':'text'},function(response){
  
    //alert(response);   
    var holder = response.split("THEDIVIDER");

    jQuery('#suggestedfocus').html(holder[0]);
    //alert(response);   
    var json = JSON.parse(holder[1]);
    //alert(holder[0]);
    //alert('parsed');  
    //alert(json["results"].length);
    //alert("rolling");

     var suggestedkeywords = "";
     for (var i = 0; i<json["results"].length; i++){
      //alert(i+json["results"][i]["keyword"]);
      if(json["results"][i]!=null) suggestedkeywords += json["results"][i]["keyword"] + ", ";
     }
     //alert("suggested"+suggestedkeywords);
     jQuery('#suggestedworkin').html(suggestedkeywords);
    //alert('parsed5');
    if(jQuery('#testtitle1').val()=="")jQuery('#testtitle1').val(ucwords(json["results"][0]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle2').val()=="")jQuery('#testtitle2').val(ucwords(json["results"][1]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle3').val()=="")jQuery('#testtitle3').val(ucwords(json["results"][2]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle4').val()=="")jQuery('#testtitle4').val(ucwords(json["results"][3]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle5').val()=="")jQuery('#testtitle5').val(ucwords(json["results"][4]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle6').val()=="")jQuery('#testtitle6').val(ucwords(json["results"][5]["keyword"])+': '+jQuery('#title').val());
  });
jQuery('#loading').remove();
});


jQuery('.stats').hide();
jQuery('#showstats').click(function(){
  jQuery('.stats').show();
});

/*

jQuery('#publish9').click(function(event){
  event.preventDefault();
  //alert('hi');
  var data = jQuery('#title').val() + "," + jQuery('#title').val() + "," + jQuery('#title').val() + "," + tinymce.editors.content.getContent();
  if(jQuery('#lsp_post_content_topics').val()!="")  data = jQuery('#lsp_post_content_topics').val();
  //alert(data);
  jQuery.post(ajaxurl,{'action':'lsp_ajax','data':data,'dataType':'text'},function(response){
  
     //alert(response);   
    var holder = response.split("THEDIVIDER");

    jQuery('#suggestedfocus').html(holder[0]);
     //alert(response);   
    var json = JSON.parse(holder[1]);
    //alert(holder[0]);
     //alert('parsed');  

     var suggestedkeywords = "";
     for (var i = 0; i<100; i++){
      suggestedkeywords += json["results"][i]["keyword"] + ", ";
     }
     jQuery('#suggestedworkin').html(suggestedkeywords);
     //alert('parsed');
    if(jQuery('#testtitle1').val()=="")jQuery('#testtitle1').val(ucwords(json["results"][0]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle2').val()=="")jQuery('#testtitle2').val(ucwords(json["results"][1]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle3').val()=="")jQuery('#testtitle3').val(ucwords(json["results"][2]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle4').val()=="")jQuery('#testtitle4').val(ucwords(json["results"][3]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle5').val()=="")jQuery('#testtitle5').val(ucwords(json["results"][4]["keyword"])+': '+jQuery('#title').val());
    if(jQuery('#testtitle6').val()=="")jQuery('#testtitle6').val(ucwords(json["results"][5]["keyword"])+': '+jQuery('#title').val());
  });
  jQuery('#publish').click();
});*/


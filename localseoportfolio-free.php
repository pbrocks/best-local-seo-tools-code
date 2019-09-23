<?php

/*
Ben Fremer & Best Local SEO Tools, LLC offer this code with NO WARRANTY. IN NO EVENT SHALL BenFremer or the corporation (Best Local SEO Tools, LLC) he sells / offers the plugin and / or plugin subscriptions through be liable to you or any other person or entity for any direct, indirect, incidental, special, punitive, or consequential damages whatsover arising out of your downloading or use of the plugin or subscription services. The aforementioned plugin and services are furnished without any warranty whatsoever, and is not responsible for any direct, indirect or consequential damages that may be incurred by its use. Warranties of merchantability, fitness for any particular purpose, title, and non-infringement, are specifically negated.
Plugin Name: Best Local SEO Tools, WordPress SEO Plugin
Author: Best Local SEO Tools
Author URI: http://www.bestlocalseotools.com
Plugin URI: http://www.bestlocalseotools.com
Description: The easy & powerful SEO plugin / Local SEO plugin for WordPress. Best Local SEO Tools' free version includes a local portfolio with great local seo that helps you rank in search engines for all the cities that you serve while showcasing your work, projects and testimonials, automatic home-page search engine optimziation, a great feedback form / review generator, blog & maps boosters, and even more in premium versions!
Version: 1.0
Author URI: https://profiles.wordpress.org/bestlocalseotools
License: GPLv2
*/


function lsp_clean_archive_title( $title ) {
	$newtitle = explode( ':', $title );
	if ( $newtitle[1] == '' ) {
		return $title;
	} else {
		return $newtitle[1];
	}
	// return preg_replace('#^[\w\d\s]+:\s*#','',strip_tags($title));
}
add_filter( 'get_the_archive_title', 'lsp_clean_archive_title' );

function lsp_reports_scripts() {
	$lsp_language = urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) );
	wp_enqueue_script( 'lsp-reports', plugins_url( 'reportsscripts.js', __FILE__ ), '', '', true );

	wp_add_inline_script(
		'lsp-reports',
		"
    jQuery(document).ready(function(){
        jQuery(function() {
          function log( message ) {
            jQuery( '<div>' ).text( message ).prependTo( '#log' );
            jQuery( '#log' ).scrollTop( 0 );
          }
          jQuery( '[name=lsp-city]' ).autocomplete({
            source: function( request, response ) {
           
              jQuery.ajax({
               
                url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
                
                dataType: 'jsonp',
                data: {
                  q: request.term
                },
                success: function( data ) {
                  response( data );
                }
              });
            },
            minLength: 1,
            select: function( event, ui ) {
              event.preventDefault();
              log( ui.item ?
                'Selected: ' + ui.item.label + 'howdy' :
                'Nothing selected, input was ' + this.value);
                var holder = ui.item.label;
                var exploded = holder.split(',');
                jQuery( '[name=lsp-city]' ).val(exploded[0].trim());
                jQuery( '[name=lsp-state]' ).val(exploded[1].trim());    
            },
            open: function() {
              jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
            },
            close: function() {
              jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
            }
          });
        });


        jQuery(function() {
          function log( message ) {
            jQuery( '<div>' ).text( message ).prependTo( '#log' );
            jQuery( '#log' ).scrollTop( 0 );
          }
          jQuery( '[name=lsp-api-city]' ).autocomplete({
            source: function( request, response ) {
              jQuery.ajax({
               
                url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
                
                dataType: 'jsonp',
                data: {
                  q: request.term
                },
                success: function( data ) {
                  response( data );
                }
              });
            },
            minLength: 1,
            select: function( event, ui ) {
              event.preventDefault();
              log( ui.item ?
                'Selected: ' + ui.item.label + 'howdy' :
                'Nothing selected, input was ' + this.value);
                var holder = ui.item.label;
                var exploded = holder.split(',');
                jQuery( '[name=lsp-api-city]' ).val(exploded[0].trim());
                jQuery( '[name=lsp-api-state]' ).val(exploded[1].trim());    
            },
            open: function() {
              jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
            },
            close: function() {
              jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
            }
          });
        });


        jQuery(function() {
          function log( message ) {
            jQuery( '<div>' ).text( message ).prependTo( '#log' );
            jQuery( '#log' ).scrollTop( 0 );
          }
          jQuery( '[id=city1]' ).autocomplete({
            source: function( request, response ) {
              jQuery.ajax({
               
                url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
                
                dataType: 'jsonp',
                data: {
                  q: request.term
                },
                success: function( data ) {
                  response( data );
                }
              });
            },
            minLength: 1,
            select: function( event, ui ) {
              event.preventDefault();
              log( ui.item ?
                'Selected: ' + ui.item.label + 'howdy' :
                'Nothing selected, input was ' + this.value);
                var holder = ui.item.label;
                var exploded = holder.split(',');
                jQuery( '[id=city1]' ).val(exploded[0].trim());
                jQuery( '[id=state1]' ).val(exploded[1].trim());    
                jQuery( '[id=country1]' ).val(exploded[2].trim());    
            },
            open: function() {
              jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
            },
            close: function() {
              jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
            }
          });
        });

    });"
	);

}
add_action( 'admin_enqueue_scripts', 'lsp_reports_scripts' );

function lsp_reports_styles() {
	wp_enqueue_style( 'lsp-reportscss', plugins_url( '/reportsstyles.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'lsp_reports_styles' );

function lsp_project_scripts() {
	global $current_screen;
	$lsp_language = urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) );
	if ( $current_screen->post_type == 'localproject' ) {
		$lsp_cname = __( 'Client Name / Project Title', 'lsp_text_domain' ) . ':<br>';
	}
	if ( $current_screen->post_type == 'seoabtest' ) {
		$lsp_cname = __( 'Title', 'lsp_text_domain' ) . ':<br>';
	}
	if ( $current_screen->post_type == 'localproject' ) {
		$lsp_dname = 'Your optional description of what you did for the client / who they are goes below -- pictures can be added with the Add Media button. Their-problem/your-solution explanations with search keywords work well for these:';
	}
	wp_enqueue_script( 'lsp-project', plugins_url( 'projectscripts.js', __FILE__ ), '', '', true );
	wp_add_inline_script( 'lsp-project', "jQuery('.postarea').before('" . $lsp_dname . "');" );
	wp_add_inline_script( 'lsp-project', "jQuery('#title-prompt-text').before('" . $lsp_cname . "');" );

	wp_add_inline_script(
		'lsp-project',
		"jQuery(document).ready(function(){
        jQuery(function() {
          function log( message ) {
            jQuery( '<div>' ).text( message ).prependTo( '#log' );
            jQuery( '#log' ).scrollTop( 0 );
          }
          jQuery( '[name=lsp_post_city]' ).autocomplete({
            source: function( request, response ) {
              jQuery.ajax({
                url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
                dataType: 'jsonp',
                data: {
                  q: request.term
                },
                success: function( data ) {
                  response( data );
                }
              });
            },
            minLength: 1,
            select: function( event, ui ) {
              event.preventDefault();
              log( ui.item ?
                'Selected: ' + ui.item.label + 'howdy' :
                'Nothing selected, input was ' + this.value);
                var holder = ui.item.label;
                var exploded = holder.split(',');
                jQuery( '[name=lsp_post_city]' ).val(exploded[0].trim());
                jQuery( '[name=lsp_post_state]' ).val(exploded[1].trim());    
            },
            open: function() {
              jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
            },
            close: function() {
              jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
            }
          });
        });

    });

  jQuery('#lsp_post_testimonial').change(function(){
   jQuery('#lsp_post_show').val('yes');
  });

"
	);

}
add_action( 'admin_enqueue_scripts', 'lsp_project_scripts' );

function lsp_project_styles() {
	wp_enqueue_style( 'lsp-projectcss', plugins_url( '/projectstyles.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'lsp_project_styles' );

function lsp_admin_scripts() {
	$lsp_language = urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) );
	wp_enqueue_script( 'lsp-admin', plugins_url( 'adminscripts.js', __FILE__ ), '', '', true );

	// pbrocks
	if ( isset( $_GET['taxonomy'] ) && ! empty( sanitize_text_field( $_GET['taxonomy'] ) ) && lsp_get_option( 'lsp-optimize-taxes0' ) == 'yes' ) {
		wp_add_inline_script(
			'lsp-admin',
			"
			jQuery('#poststuff').hide();
			jQuery('#wp-admin-bar-wpseo-menu').hide(); 
			jQuery('.column-wpseo_score').hide()
			jQuery('.column-wpseo_score_readability').hide()
		"
		);
	}

	if ( sanitize_text_field( $_GET['user_id'] ) && lsp_get_option( 'lsp-optimize-authors0' ) == 'yes' ) {
		wp_add_inline_script(
			'lsp-admin',
			"
        jQuery('#wpseo_author_title').parent().parent().parent().hide();
        jQuery('#wordpress-seo').hide();"
		);
	}

	if ( lsp_get_option( 'lsp-preview-urls' ) != 'yes' ) {
		wp_add_inline_script(
			'lsp-admin',
			"
        var mystr = window.location.href;
        if(mystr.indexOf('edit.php?post_type=localproject')>-1){
        jQuery('.column-wpseo-score').hide();
        jQuery('#wpseo-score').html('');}"
		);
	}

	$lsp_warn = __( 'You need to first fill out and save your Reputation Builder settings above for this work.', 'lsp_text_domain' );
	if ( lsp_get_option( 'lsp-reviews-name' ) == '' ) {
		wp_add_inline_script(
			'lsp-admin',
			"
        jQuery('#keywordslink3').click(function(event){event.preventDefault();alert('" . $lsp_warn . "')})"
		);
	}

		$lsp_save  = __( 'Save and Continue >>', 'lsp_text_domain' );
	  $lsp_warning = __( 'Please be sure to select a Service Used so this can show up in your Local Portfolio', 'lsp_text_domain' );

	$lsp_warn2 = __( 'The state / province name needs to be the *full state name* in order for this system to work properly.', 'lsp_text_domain' );

	$lsp_warn5 = __( 'You need to first fill out and save your basic settings above.', 'lsp_text_domain' );

	if ( lsp_get_option( 'lsp-services' ) == '' ) {
		wp_add_inline_script(
			'lsp-admin',
			"
        jQuery('#serviceslink3').click(function(event){event.preventDefault();alert('" . $lsp_warn5 . "')})"
		);
	}

	wp_add_inline_script(
		'lsp-admin',
		"jQuery('#lsp-api-state').blur(function(){
      if(jQuery('#lsp-api-state').val().length < 3) alert('" . $lsp_warn2 . "');
    });
    jQuery('#lsp_post_state').blur(function(){
      if(jQuery('#lsp_post_state').val().length < 3) alert('" . $lsp_warn2 . "');
    });"
	);

	if ( $_GET['post_type'] == 'localproject' ) {
		wp_add_inline_script(
			'lsp-admin',
			"
jQuery('#publish').click(function(event){
  if(jQuery('#servicesportfolio-all input:checked').length == 0 ){
  event.preventDefault()
  alert('" . $lsp_warning . "')
} 
});"
		);
	}

	wp_add_inline_script(
		'lsp-admin',
		"
  
  
     

  
  
        jQuery(document).ready(function(){
        jQuery('#keywordslink2, #feedbacklink').click(function(){
        jQuery('#submitter2').hide();
        jQuery('#submitter').val('" . $lsp_save .
		"');
        });
        jQuery('#menu-posts-localproject a').first().attr('href','" . admin_url() . "edit.php?post_type=localproject&page=localseoportfolio-free.php');
        jQuery('#menu-posts-localproject a').eq(6).attr('href','" . admin_url() . "edit.php?post_type=localproject&page=localseoportfolio-free.php&reports=true');
        //jQuery('#menu-posts-localproject a:nth-child(3)').hide();
        //jQuery('#menu-posts-localproject a:nth-child(3)').hide();
        jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(8)').removeClass('current');
        jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(9)').removeClass('current');
        jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(10)').removeClass('current');
        jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(8) a').attr('href','http://www.bestlocalseotools.com/#comparison');
        jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(9) a').attr('href','http://www.bestlocalseotools.com/?page_id=83');
        jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(10) a').attr('href','http://www.bestlocalseotools.com/?page_id=146');
        });
        //jQuery('#menu-posts-localproject li:nth-child(4)').hide();
        //jQuery('#menu-posts-localproject li:nth-child(5)').hide();
        jQuery('#tagsdiv-industriesportfolio').prependTo('#side-sortables');
        jQuery('#tagsdiv-servicesportfolio').prependTo('#side-sortables');
        

        jQuery(document).ready(function(){
          jQuery('[name=lsp-text-color]').val('" . get_option( 'lsp-text-color' ) . "');
          jQuery('[name=lsp-link-color]').val('" . get_option( 'lsp-link-color' ) . "');
          jQuery('[name=lsp-header-color]').val('" . get_option( 'lsp-header-color' ) . "');
          jQuery('[name=lsp-homepage-footer-links-background-color]').val('" . get_option( 'lsp-homepage-footer-links-background-color' ) . "');
        });


        "
	);

	if ( sanitize_text_field( $_GET['reports'] ) ) {
		wp_add_inline_script(
			'lsp-admin',
			"
            jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(6)').removeClass('current');jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(8)').removeClass('current');"
		);
	} else {
		wp_add_inline_script( 'lsp-admin', "jQuery('#menu-posts-localproject .wp-submenu:nth-child(2) li:nth-child(7)').removeClass('current');" );
	}

		wp_add_inline_script(
			'lsp-admin',
			"
        jQuery('#portfolioapilink').click(function(){
          jQuery('.pform').hide();
          jQuery('#pformapi').show();
          jQuery('#submitter').val('" . $lsp_save . "');
        });"
		);

		wp_add_inline_script(
			'lsp-admin',
			"
        jQuery('#keywordslink').click(function(){
          jQuery('.pform').hide();
          jQuery('#kform').show();
          jQuery('#submitter').val('" . $lsp_save . "');
        });"
		);

		wp_add_inline_script(
			'lsp-admin',
			"
        jQuery('#keywordslink2').click(function(){
          jQuery('.pform').hide();
          jQuery('#kform2').show();
          jQuery('#submitter').val('" . $lsp_save . "');
        });"
		);

		wp_add_inline_script(
			'lsp-admin',
			"
          jQuery('#kform3').hide();
        jQuery('#keywordslink3').click(function(){
          //jQuery('.pform').hide();
          //jQuery('#submitter2').hide();
          //jQuery('#kform3').toggle();
          //jQuery('#submitter').val('" . $lsp_save . "');
        });"
		);

			$lsp_ph1  =
		__( 'We offer ', 'lsp_text_domain' );
			$lsp_ph2  =
		__( ' services for ', 'lsp_text_domain' );
			$lsp_ph3  =
		__( '. You can see who we have provided ', 'lsp_text_domain' );
			$lsp_ph4  =
		__( ' services for around [city], [state] below. Please contact us if you have any questions.', 'lsp_text_domain' );
			$lsp_ph5  =
		__( 'We offer ', 'lsp_text_domain' );
			$lsp_ph6  =
		__( ' services for ', 'lsp_text_domain' );
			$lsp_ph7  =
		__( '. You can see who we have provided ', 'lsp_text_domain' );
			$lsp_ph8  =
		__( ' services for around [city], [state] below. Please contact us if you have any questions.', 'lsp_text_domain' );
			$lsp_ph9  =
		__( 'We offer ', 'lsp_text_domain' );
			$lsp_ph10 =
		__( ' services for ', 'lsp_text_domain' );
			$lsp_ph11 =
		__( '. You can see who we have provided ', 'lsp_text_domain' );
			$lsp_ph12 =
		__( ' services for below. Please contact us if you have any questions.', 'lsp_text_domain' );

		wp_add_inline_script(
			'lsp-admin',
			"
jQuery('input[name=lsp-services]').change(function(){
  if(jQuery('textarea[name=lsp-api-intro-text]').val()=='' || tinyMCE.get('lsp-api-intro-text').getContent() == ''){
    jQuery('textarea[name=lsp-api-intro-text]').val('" . $lsp_ph1 . "'+jQuery('input[name=lsp-services]').val()+'" . $lsp_ph2 . '[city], [state]' . $lsp_ph3 . "'+jQuery('input[name=lsp-services]').val()+'" . $lsp_ph4 . "');
    tinyMCE.get('lsp-api-intro-text').setContent('" . $lsp_ph5 . "'+jQuery('input[name=lsp-services]').val()+'" . $lsp_ph6 . '[city], [state]' . $lsp_ph7 . "'+jQuery('input[name=lsp-services]').val()+'" . $lsp_ph8 . "');
  }
});

jQuery('input[name=lsp-keyphrase]').change(function(){
  if(jQuery('textarea[name=lsp-intro-text]').val()==''){
    jQuery('textarea[name=lsp-intro-text]').val('" . $lsp_ph9 . "'+jQuery('input[name=lsp-keyphrase]').val()+'" . $lsp_ph10 . '[city], [state]' . $lsp_ph11 . "'+jQuery('input[name=lsp-keyphrase]').val()+
'" . $lsp_ph12 . "');
  }
});

jQuery(document).ready(function(){
jQuery(function() {
  function log( message ) {
    jQuery( '<div>' ).text( message ).prependTo( '#log' );
    jQuery( '#log' ).scrollTop( 0 );
  }
  jQuery( '[name=lsp-city]' ).autocomplete({
    source: function( request, response ) {
   
      jQuery.ajax({
       
        url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
        
        dataType: 'jsonp',
        data: {
          q: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    minLength: 1,
    select: function( event, ui ) {
      event.preventDefault();
      log( ui.item ?
        'Selected: ' + ui.item.label + 'howdy' :
        'Nothing selected, input was ' + this.value);
        var holder = ui.item.label;
        var exploded = holder.split(',');
        jQuery( '[name=lsp-city]' ).val(exploded[0].trim());
        jQuery( '[name=lsp-state]' ).val(exploded[1].trim());    
    },
    open: function() {
      jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
    },
    close: function() {
      jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
    }
  });
});


jQuery(function() {
  function log( message ) {
    jQuery( '<div>' ).text( message ).prependTo( '#log' );
    jQuery( '#log' ).scrollTop( 0 );
  }
  jQuery( '[name=lsp-api-city]' ).autocomplete({
    source: function( request, response ) {
      jQuery.ajax({
        url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
        dataType: 'jsonp',
        data: {
          q: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    minLength: 1,
    select: function( event, ui ) {
      event.preventDefault();
      log( ui.item ?
        'Selected: ' + ui.item.label + 'howdy' :
        'Nothing selected, input was ' + this.value);
        var holder = ui.item.label;
        var exploded = holder.split(',');
        jQuery( '[name=lsp-api-city]' ).val(exploded[0].trim());
        jQuery( '[name=lsp-api-state]' ).val(exploded[1].trim());    
    },
    open: function() {
      jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
    },
    close: function() {
      jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
    }
  });
});




jQuery(function() {
  function log( message ) {
    jQuery( '<div>' ).text( message ).prependTo( '#log' );
    jQuery( '#log' ).scrollTop( 0 );
  }
  jQuery( '[id=city1]' ).autocomplete({
    source: function( request, response ) {
      jQuery.ajax({
       
        url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
        
        dataType: 'jsonp',
        data: {
          q: request.term
        },
        success: function( data ) {
          response( data );
        }
      });
    },
    minLength: 1,
    select: function( event, ui ) {
      event.preventDefault();
      log( ui.item ?
        'Selected: ' + ui.item.label + 'howdy' :
        'Nothing selected, input was ' + this.value);
        var holder = ui.item.label;
        var exploded = holder.split(',');
        jQuery( '[id=city1]' ).val(exploded[0].trim());
        jQuery( '[id=state1]' ).val(exploded[1].trim());    
        jQuery( '[id=country1]' ).val(exploded[2].trim());    
    },
    open: function() {
      jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
    },
    close: function() {
      jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
    }
  });
});





});





"
		);

}
add_action( 'admin_enqueue_scripts', 'lsp_admin_scripts' );

function lsp_admin_styles() {
	wp_enqueue_style( 'lsp-admincss', plugins_url( '/adminstyles.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'lsp_admin_styles' );

function lsp_feedback_scripts() {
	$lsp_language = urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) );

	wp_enqueue_script( 'jquery-ui-core' );
	wp_enqueue_script( 'jquery-ui-autocomplete' );
	wp_enqueue_script( 'lsp-ratings1', plugins_url( '/star-rating/jquery.MetaData.js', __FILE__ ), '', '', true );
	wp_enqueue_script( 'lsp-ratings2', plugins_url( '/star-rating/jquery.rating.js', __FILE__ ), '', '', true );

	wp_enqueue_script( 'lsp-feedback', plugins_url( 'feedbackscripts.js', __FILE__ ), '', '', true );

	wp_add_inline_script(
		'lsp-feedback',
		"



    jQuery('.hover-star').rating({
      focus: function(value, link){
        var tip = jQuery('#hover-test');
        tip[0].data = tip[0].data || tip.html();
        tip.html(link.title || 'value: '+value);
      },
      blur: function(value, link){
        var tip = jQuery('#hover-test');
        jQuery('#hover-test').html(tip[0].data || '');
      }
    });
    jQuery(document).ready(function(){
    jQuery(function() {
      function log( message ) {
        jQuery('<div>').text( message ).prependTo( '#log' );
        jQuery('#log').scrollTop( 0 );
      }
      jQuery('[name=city2]').autocomplete({
        source: function( request, response ) {
          jQuery.ajax({
            url: 'http://www.bestlocalseotools.com/index3.php?lang='+'" . $lsp_language . "'+'&request=ajaxcities',
            
            dataType: 'jsonp',
            data: {
              q: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        minLength: 1,
        select: function( event, ui ) {
          event.preventDefault();
          log( ui.item ?
            'Selected: ' + ui.item.label + 'howdy' :
            'Nothing selected, input was ' + this.value);
            var holder = ui.item.label;
            var exploded = holder.split(',');
            jQuery( '[name=city2]' ).val(exploded[0].trim());
            jQuery( '[name=state2]' ).val(exploded[1].trim());    
        },
        open: function() {
          jQuery( this ).removeClass( 'ui-corner-all' ).addClass( 'ui-corner-top' );
        },
        close: function() {
          jQuery( this ).removeClass( 'ui-corner-top' ).addClass( 'ui-corner-all' );
        }
      });
      })});

        "
	);
}
add_action( 'wp_enqueue_scripts', 'lsp_feedback_scripts' );

function lsp_feedback_styles() {
	wp_enqueue_style( 'lsp-feedbackcss', plugins_url( '/feedbackstyles.css', __FILE__ ) );
	wp_enqueue_style( 'lsp-feedbackcss2', plugins_url( '/star-rating/jquery.rating.css', __FILE__ ) );
	wp_enqueue_style( 'lsp-feedbackcss3', plugins_url( 'jquery-ui.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'lsp_feedback_styles' );



// Escaping Output Helper, Used for Many But Not All
function lsp_get_option( $term ) {
	return sanitize_text_field( get_option( $term ) );
}

// Escaping Output Helper, Used for Many But Not All
function lsp_get_post_meta( $postid, $term, $truefalse ) {
	return sanitize_text_field( get_post_meta( $postid, $term, $truefalse ) );
}

function lsp_dashboard_widgets() {
	wp_add_dashboard_widget( 'lsp_dashboard_widget', 'Best Local SEO Tools Reports', 'lsp_dashboard_function' );
}
add_action( 'wp_dashboard_setup', 'lsp_dashboard_widgets' );

function lsp_dashboard_function() {     ?>
		<a href="http://www.bestlocalseotools.com" target="_blank">
		<?php
		_e( 'Upgrade to Premium', 'lsp_text_domain' );
		?>
		</a>
<br>

  <b>
	<?php
	if ( $plus == false ) {
		_e( 'Local Portfolio SEO Visits So Far This Month:', 'lsp_text_domain' );
	}
	if ( $plus ) {
		_e( 'Local Portfolio SEO Visits So Far This Subscription Period:', 'lsp_text_domain' );
	}
	?>
   </b>
<br>
	<?php
	$amount = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php?request=viewcount&key=' . lsp_get_option( 'lsp-api-key' ) );
	if ( $amount < 1 ) {
		echo '0';
	} else {
		echo $amount;
	}
	?>
<br>
  <b>
	<?php
	_e( 'Monthly Feedback Score / By Employee:', 'lsp_text_domain' );
	?>
	</b>

 <div id='container' style='width: 100%;'>

		<img width="100%" src="
		<?php
		echo plugins_url( 'reports.jpg', __FILE__ );
		?>
		">

	</div>    
  

	<?php
}



// Service Area Shortcode
function lsp_servicearea( $atts ) {
	return wp_kses(
		get_option( 'lsp_content' ),
		array(
			'a' => array(
				'href'  => array(),
				'title' => array(),
			),
		)
	);
}
add_shortcode( 'servicearea', 'lsp_servicearea' );



// Testimonials Shortcode
function lsp_testimonials( $atts ) {
	$lsp_sc_holder == '';
	global $wpdb;
	$result = $wpdb->get_results(
		$wpdb->prepare(
			"
		SELECT ID 
		FROM $wpdb->posts, $wpdb->postmeta 
		WHERE post_type='localproject' 
		AND post_status = 'publish' 
		AND meta_key = 'lsp_post_testimonial' 
		AND meta_value != '' 
		AND $wpdb->postmeta.post_id = $wpdb->posts.ID 
		ORDER BY menu_order 
		DESC
    "
		)
	);
	$i      = 0;
	foreach ( $result as $entry ) {
		// echo $entry->ID;
		$i++;
		if ( $i > 40 ) {
			break;
		}
		?>
	<p>
		<?php
		$lsp_sc_holder .= '<p>';
		// get_post_meta($entry->ID,'lsp_post_testimonial', true)
		$lsp_sc_holder .= '"' . trim( wp_trim_words( get_post_meta( $entry->ID, 'lsp_post_testimonial', true ), $num_words = 65, $more = '...' ), '"“”�' ) . '"';
		$lsp_sc_holder .= "<br><span style='float:right;clear:both'><b>";
		$lsp_sc_holder .= get_post_meta( $entry->ID, 'lsp_post_client_name', true );
		$lsp_sc_holder .= '</b><br>';
		$lsp_sc_holder .= get_post_meta( $entry->ID, 'lsp_post_client_city', true );
		$lsp_sc_holder .= "</span></p><hr style='clear:both'>";
		?>
		<?php

	}
	return $lsp_sc_holder;
}
add_shortcode( 'mytestimonials', 'lsp_testimonials' );


add_filter( 'is_protected_meta', 'lsp_is_protected_meta_filter', 10, 2 );
function lsp_is_protected_meta_filter( $protected, $meta_key ) {
	return $meta_key == 'lsp_post_industry' ? true : $protected;
}


add_filter( 'is_protected_meta', 'lsp_is_protected_meta_filter2', 10, 2 );
function lsp_is_protected_meta_filter2( $protected, $meta_key ) {
	return $meta_key == 'lsp_post_tags' ? true : $protected;
}

add_filter( 'the_content', 'lsp_internallinks', 9999 );
function lsp_internallinks( $content ) {
	return $content;
}


// Content for the Local Portfolio page
add_filter( 'the_content', 'lsp_localportfoliocontent', 9999 );
function lsp_localportfoliocontent( $content ) {
	global $post;
	global $wp_query;
	if ( ( $post->ID == lsp_get_option( 'lsp-ptemplate-id' ) ) && $wp_query->query_vars['city'] == '' && ( ! ( strstr( $_SERVER['REQUEST_URI'], 'feedback' ) ) ) ) {
		$newContent = wp_kses(
			get_option( 'lsp_content' ),
			array(
				'a' => array(
					'href'  => array(),
					'title' => array(),
				),
			)
		);
		$newContent = preg_replace( '/style=(["\'])[^\1]*?\1/i', '', $newContent, -1 );
		$newContent = strip_tags( $newContent, '<a><div><p>' );

		return $newContent;
	} else {
		return $content;
	}
}



// The Featured Posts Section Content
add_filter( 'the_content', 'lsp_featuredpostscontent', 9999 );
function lsp_featuredpostscontent( $content ) {
	global $post;
	global $wp_query;
	if ( ( $post->ID == lsp_get_option( 'lsp-ptemplate-id2' ) ) && $wp_query->query_vars['city'] == '' && ( ! ( strstr( $_SERVER['REQUEST_URI'], 'feedback' ) ) ) ) {
		$newContent = '';

		$theseTypes = 'post';
		if ( lsp_get_option( 'lsp-archive-types' ) ) {
			$theseTypes = explode( ',', "'post','" . str_replace( ',', "','", lsp_get_option( 'lsp-archive-types' ) ) . "'" );
		}

		$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$my_query = new WP_Query(
			array(
				'post_type' => $theseTypes,
				'orderby'   => 'meta_value_num',
				'meta_key'  => '_seo-visits-count',
				'order'     => 'DESC',
				'paged'     => $paged,
			)
		);
		if ( $my_query->have_posts() ) {
			while ( $my_query->have_posts() ) {
				$my_query->the_post();
				$newContent .= "<a href='" . get_the_permalink() . "'>" . get_the_title() . '</a><br>' . get_the_excerpt() . '<br><br>';
			}
			if ( get_previous_posts_link() ) {
				$newContent .= get_previous_posts_link( __( '<< Previous Page', 'lsp_text_domain' ) ) . ' | ';
			}
			$newContent .= get_next_posts_link( __( 'Show More Posts >>', 'lsp_text_domain' ), $my_query->max_num_pages );

		}
		wp_reset_postdata();
		return $content . $newContent;
	} else {
		return $content;
	}
}


// The Featured Products Section Content
add_filter( 'the_content', 'lsp_popularproductscontent', 9999 );
function lsp_popularproductscontent( $content ) {
	global $post;
	global $wp_query;
	if ( ( $post->ID == lsp_get_option( 'lsp-ptemplate-id2' ) ) && $wp_query->query_vars['city'] == '' && ( ! ( strstr( $_SERVER['REQUEST_URI'], 'feedback' ) ) ) ) {
		$newContent = '';
		$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		$my_query   = new WP_Query(
			array(
				'post_type' => 'product',
				'orderby'   => 'meta_value_num',
				'meta_key'  => '_seo-visits-count',
				'order'     => 'DESC',
				'paged'     => $paged,
			)
		);
		if ( $my_query->have_posts() ) {
			while ( $my_query->have_posts() ) {
				$my_query->the_post();
				$newContent .= "<a href='" . get_the_permalink() . "'>" . get_the_title() . '</a><br>' . get_the_excerpt() . '<br><br>';
			}
			if ( get_previous_posts_link() ) {
				$newContent .= get_previous_posts_link( __( '<< Previous Page', 'lsp_text_domain' ) ) . ' | ';
			}
			$newContent .= get_next_posts_link( __( 'Show More Posts >>', 'lsp_text_domain' ), $my_query->max_num_pages );

		}
		wp_reset_postdata();
		return $content . $newContent;
	} else {
		return $content;
	}
}



// a helper function
function lsp_get_permalink( $item ) {
	if ( is_int( $item ) ) {
		return get_permalink( $item );
	} else {
		return $item;
	}
}


function lsp_error_notice() {
	if ( lsp_get_option( 'permalink_structure' ) == '' ) :
		?>
  <div class="error notice">
	<p>
		<?php
		_e( 'Permalinks (in your settings) need to be enabled to non-default for Best Local SEO Tools to work.', 'lsp_text_domain' );
		?>
	</p>
  </div>
  
		<?php
	endif;
}
add_action( 'admin_notices', 'lsp_error_notice' );


// To work better with Yoast
add_filter( 'wpseo_opengraph_title', 'lsp_mysite_ogtitle', 999 );
function lsp_mysite_ogtitle( $title ) {
	return lsp_keyphrase_one_title( $title );
}

// For Internationalization
function lsp_load_plugin_textdomain() {
	 load_plugin_textdomain( 'lsp_text_domain', false, basename( dirname( __FILE__ ) ) . '' );
}
add_action( 'plugins_loaded', 'lsp_load_plugin_textdomain' );


// Helper function for geo-service connecting
function lsp_wp_httpget( $url ) {
	$fHolder = '';
	// $fHolder = wp_remote_retrieve_body(wp_remote_get($url, array('timeout' => 105)));
	$fHolder = wp_remote_retrieve_body( wp_remote_get( $url, array( 'timeout' => 75 ) ) );
	// This was bugging out a lot on installs so we added this as an additional fallback
	/*
	if(ini_get('allow_url_fopen')){
	  if($fHolder=="")$fHolder = file_get_contents($url);
	}*/
	if ( $fHolder ) {
		return $fHolder;
	}
	return 'There was an error with contacting the service. Please check your Best Local SEO Tools settings like the state *full name* and city name. Some cities may cause bugs because they are not in our database. If that is the case -- please try a different city (center of service area).';
}


function lsp_wp_httppost( $url, $data ) {
	$fHolder = '';
	$fHolder = wp_remote_retrieve_body(
		wp_remote_post(
			$url,
			array(
				'timeout' => 105,
				'body'    => array(
					'data',
					$data,
				),
			)
		)
	);
	$fHolder = wp_remote_retrieve_body(
		wp_remote_post(
			$url,
			array(
				'timeout' => 45,
				'body'    => array(
					'data',
					$data,
				),
			)
		)
	);
	if ( $fHolder ) {
		return $fHolder;
	}
	return 'There was an error with contacting the service. Please check your Best Local SEO Tools settings like the state *full name* and city name. Some cities may cause bugs because they are not in our database. If that is the case -- please try a different city (center of service area).';
}

// For the reputation builder form variables
function lsp_custom_rewrite_tagp() {
	add_rewrite_tag( '%feedbackpostid%', '([^&]+)' );
	add_rewrite_tag( '%feedbackkey%', '([^&]+)' );

}
add_action( 'init', 'lsp_custom_rewrite_tagp', 10, 0 );

// For the reputation builder form variables
function lsp_custom_rewrite_rule_portfolio() {
	add_rewrite_rule( '^feedback/([^/]*)/([^/]*)/?', 'index.php?page_id=' . lsp_get_option( 'lsp-ptemplate-id' ) . '&feedbackpostid=' . $matches[1] . '&feedbackkey=' . $matches[2], 'top' );
	add_rewrite_rule( '^feedback/?', 'index.php?page_id=' . lsp_get_option( 'lsp-ptemplate-id' ), 'top' );
}

add_action( 'init', 'lsp_custom_rewrite_rule_portfolio', 10, 0 );

function lsp_projects_endpoint() {
	add_rewrite_rule( '^lsp_projects/([^/]*)/?', 'index.php?lsp_portfolio=$matches[1]', 'top' );
}
add_action( 'init', 'lsp_projects_endpoint', 10, 0 );

function lsp_projects_endpoint2() {
	add_rewrite_tag( '%lsp_portfolio%', '([^&]+)' );
}
add_action( 'init', 'lsp_projects_endpoint2', 10, 0 );

function lsp_projects_print() {
	if ( $_GET['portfolioquery'] ) {
		$k = '';
		$k = $_GET['portfolioquery'];
		if ( $k == 1 ) {
			$k = '';
		}

		/*
		global $wpdb;
		$query2 = "SELECT a.meta_value as city, b.meta_value as state, d.meta_value as country FROM ".$wpdb->prefix."postmeta a, ".$wpdb->prefix."postmeta b, ".$wpdb->prefix."postmeta c, ".$wpdb->prefix."postmeta d WHERE c.meta_value LIKE '%%".get_option('lsp-keyphrase'.$k)."%%' AND a.meta_key='lsp_post_city' AND b.meta_key='lsp_post_state' AND c.meta_key='lsp_post_tags' AND d.meta_key='lsp_post_country' AND a.post_id = b.post_id AND b.post_id = c.post_id";

			  global $wpdb;
			  $citystates = $wpdb->get_results($query2);
			  $projectsCounter = 0;
			  $projectsString .= "";
			  foreach ($citystates as $citystate) {
				error_reporting(0);
				if($projectsCounter>10000) break;
				if(!(in_array($citystate->city.",".$citystate->state,$projectArray)))$projectsString .= $citystate->city.",".$citystate->state.",".$citystate->country."|";
				$projectArray[$projectsCounter]= $citystate->city.",".$citystate->state;
				$projectsCounter++;
			  }
		*/

		global $wpdb;
		$query2 = 'SELECT * FROM ' . $wpdb->prefix . "lsp_localprojects WHERE lsp_lp_tags LIKE '%%" . lsp_get_option( 'lsp-keyphrase' . $k ) . "%%' AND lsp_lp_status = 'publish'";

		// $query2 = "SELECT a.meta_value as city, b.meta_value as state FROM ".$wpdb->prefix."postmeta a, ".$wpdb->prefix."postmeta b, ".$wpdb->prefix."postmeta c WHERE c.meta_value LIKE '%%".get_option('lsp-keyphrase'.$i)."%%' AND a.meta_key='lsp_post_city' AND b.meta_key='lsp_post_state' AND c.meta_key='lsp_post_tags' AND a.post_id = b.post_id AND b.post_id = c.post_id";
		  // echo $query2;
		  // $query2 = $wpdb->prepare($query2);
		  global $wpdb;
		  $citystates      = $wpdb->get_results( $query2 );
		  $projectsCounter = 0;
		  $projectsString .= '';
		foreach ( $citystates as $citystate ) {
			if ( $projectsCounter > 10000 ) {
				break;
			}
			$pstring = get_post_meta( $citystates->lsp_lp_postid, 'lsp_post_city', true ) . ',' . get_post_meta( $citystates->lsp_lp_postid, 'lsp_post_state', true );

			$projectArray[ $projectsCounter ] = $pstring;
			if ( ! ( in_array( $citystate->city . ',' . $citystate->state, $projectArray ) ) ) {
				$projectsString .= $pstring . ',' . 'US' . '|';
			}
			$projectsCounter++;
		}
		echo $projectsString;
		die();

	}
}
add_action( 'template_redirect', 'lsp_projects_print' );



// Taking control of the title tag for the portfolio section
function lsp_my_title( $title, $separator, $position ) {
	global $post;
	if ( lsp_get_option( 'lsp-ptemplate-id' ) == $post->ID ) {
		remove_action( 'wp_head', 'jetpack_og_tags' );
		if ( defined( 'WPSEO_VERSION' ) ) {
			global $wpseo_front;
			remove_action(
				'wp_head',
				array(
					$wpseo_front,
					'head',
				),
				1
			);
		}
		if ( defined( 'AIOSEOP_VERSION' ) ) {
			global $aiosp;
			remove_action(
				'wp_head',
				array(
					$aiosp,
					'wp_head',
				)
			);
		}
		remove_action( 'wp_head', 'rel_canonical' );
		add_filter( 'aioseop_canonical_url', __false );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	}
	return $title;
}
add_filter( 'wp_title', 'lsp_my_title', 20, 3 );


// Overriding Yoast on the Portfolio Section / Reputation Builder
function lsp_undoyoast() {
	global $post;
	if ( lsp_get_option( 'lsp-ptemplate-id' ) == $post->ID ) {

		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'parent_post_rel_link' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link' );
		remove_action( 'wp_head', 'wp_generator' );

		add_filter( 'wpseo_canonical', '__return_false' );
		add_filter( 'aioseop_canonical_url', __false );
		add_filter( 'wpseo_title', '__return_false', 99 );
		add_filter( 'wpseo_metadesc', '__return_false' );
		remove_action( 'wp_head', 'wpseo_opengraph', 20 );
	}
}
add_action( 'wp_head', 'lsp_undoyoast', 1 );

/*
add_action('template_redirect','lsp_clean_wpseo');
function lsp_clean_wpseo(){
  global $post;
  if(get_option('lsp-ptemplate-id') == $post->ID ){
	global $wpseo_front;
	if(defined($wpseo_front)){
	  remove_action('wp_head',array($wpseo_front,'head'),1);
	}
	else{
	  $wpseoholder = WPSEO_Frontend::get_instance();
	  remove_action('wp_head',array($wpseoholder,'head'),1);
	}
  }
}*/


// Custom excerpts for portfolio
add_filter( 'the_content', 'lsp_singles_excerpt', 99999 );
function lsp_singles_excerpt( $content ) {
	global $post;
	if ( ( is_tax( 'servicesportfolio' ) || is_tax( 'industriesportfolio' ) || $post->ID == lsp_get_option( 'lsp-ptemplate-id' ) ) && lsp_get_option( 'lsp-preview-urls' ) == 'yes' ) {

		$counterz = round( str_word_count( $content ) / 3 ) * 2;

		return $content;

	}
	return $content;
}



// used by the geo-service to get the appropriate cities
global $mylanguage;
$languageHolder = explode( '-', get_bloginfo( 'language' ) );
$mylanguage     = $languageHolder[0];


// Portfolio Meta Tags
function lsp_headermeta() {
	 global $post;
	$nowUrl = ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	global $post;
	if ( lsp_get_option( 'lsp-ptemplate-id' ) == $post->ID ) {
		$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
		if ( $currentSlugArray[4] ) {
			$currentSlug = $currentSlugArray[2];
		} else {
			$currentSlug = $currentSlugArray[1];
		}
		$currentTerm = str_replace( '-', ' ', $currentSlug );
		global $wp_query;

		// if(get_option('lsp-biztype')=='ls2') echo "<title>" . stripslashes(ucwords($currentTerm)) . __(' near ', 'lsp_text_domain') . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['city'])))) . ", " . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['state'])))) ."</title>";
		// else echo "<title>".stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['city'])))) . ", " . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['state'])))) . " " . stripslashes(ucwords($currentTerm)) ."</title>";
		echo "<meta name='description' value=" . '"' . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) . ', ' . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) . ' ' . ucwords( $currentTerm ) . ' - ' . ucwords( $currentTerm ) . __( ' for ', 'lsp_text_domain' ) . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) . ', ' . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) . '"' . '>';
		echo "<meta name='keywords' value=" . '"' . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) . ', ' . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) . ' ' . ucwords( $currentTerm ) . ' - ' . ucwords( $currentTerm ) . __( ' for ', 'lsp_text_domain' ) . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) . ', ' . ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) . '"' . '>';

		// if(get_option('lsp-biztype')=='ls2') echo "<title>" . stripslashes(ucwords($currentTerm)) . __(' near ', 'lsp_text_domain') . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['city'])))) . ", " . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['state'])))) ."</title>";
		// else echo "<title>".stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['city'])))) . ", " . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['state'])))) . " " . stripslashes(ucwords($currentTerm)) ."</title>";
	}
}
add_action( 'wp_head', 'lsp_headermeta', 0 );



global $title_string;
$title_string = __( 'Local Portfolio', 'lsp_text_domain' );
global $title_string2;
$title_string2 = __( 'Featured Posts Archive', 'lsp_text_domain' );
global $title_string3;
$title_string3 = __( 'Popular Products Archive', 'lsp_text_domain' );



add_filter( 'wp_list_pages_excludes', 'lsp_exclude' );
function lsp_exclude( $output = '' ) {
	array_push( $output, lsp_get_option( 'lsp-ptemplate-id' ) );
	return $output;
}

// For Portfolio & Reputation Builder Variable Passing
function custom_rewrite_tag() {
	add_rewrite_tag( '%city%', '([^&]+)' );
	add_rewrite_tag( '%state%', '([^&]+)' );
	add_rewrite_tag( '%country%', '([^&]+)' );

	add_rewrite_tag( '%name%', '([^&]+)' );
	add_rewrite_tag( '%email%', '([^&]+)' );
	add_rewrite_tag( '%phone%', '([^&]+)' );

	add_rewrite_tag( '%description%', '([^&]+)' );
	add_rewrite_tag( '%suggestions%', '([^&]+)' );
	add_rewrite_tag( '%lsp_settings%', '([^&]+)' );

	global $post;
	if ( lsp_get_option( 'lsp-ptemplate-id' ) == $post->ID ) {
		remove_action( 'wp_head', 'jetpack_og_tags' );
		if ( defined( 'WPSEO_VERSION' ) ) {
			global $wpseo_front;
			remove_action(
				'wp_head',
				array(
					$wpseo_front,
					'head',
				),
				1
			);
		}
		if ( defined( 'AIOSEOP_VERSION' ) ) {
			global $aiosp;
			remove_action(
				'wp_head',
				array(
					$aiosp,
					'wp_head',
				)
			);
		}
		remove_action( 'wp_head', 'rel_canonical' );
		add_filter( 'aioseop_canonical_url', __false );
		remove_action( 'wp_head', 'index_rel_link' );
		remove_action( 'wp_head', 'start_post_rel_link' );
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	}
	return $title;

}
add_action( 'init', 'custom_rewrite_tag', 10, 0 );


// The main rewrite rule for the portfolio sections
function lsp_custom_rewrite_rule() {
	if ( lsp_get_option( 'lsp-keyphrase' ) ) {
		add_rewrite_rule( '^([^/]*)/' . str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase' ) ) . '/([^/]*)/([^/]*)/?', 'index.php?page_id=' . lsp_get_option( 'lsp-ptemplate-id' ) . '&country=$matches[1]&city=$matches[2]&state=$matches[3]', 'top' );
	}
}
add_action( 'init', 'lsp_custom_rewrite_rule', 10, 0 );


// Logs the date of installation for future-version compatibility
if ( ! ( lsp_get_option( 'lsp-date' ) ) ) {
	update_option( 'lsp-date', date( 'Y-m-d' ) );
}

function lsp_admin_notice_success() {
	if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) {

		$postscount = wp_count_posts( 'localproject' );

		if ( $postscount->publish < 10 ) :
			?>
	<div class="notice notice-success">
	<p>
			<?php
			_e( 'We strongly recommend that you have at least 10 - 20 local projects / testimonials / reviews for your local portfolio so it can rank well. Please add them ', 'lsp_text_domain' );
			?>
  <a href="
			<?php
			echo site_url();
			?>
  /wp-admin/post-new.php?post_type=localproject">
			<?php
			_e( 'here', 'lsp_text_domain' );
			?>
  </a>.
	</p>
	</div>

	
			<?php
	   endif;
	}

}
add_action( 'admin_notices', 'lsp_admin_notice_success' );

function lsp_homepage_title() {
	$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	global $post;
	if ( get_option( 'lsp-auto-adjust' ) == 'yes' && is_front_page() ) {
		$zstring = '';
		if ( get_option( 'lsp-services' ) ) {
			$zstring = get_option( 'lsp-services' );
		}
		if ( get_option( 'lsp-services2' ) ) {
			$zstring .= ', ' . get_option( 'lsp-services2' );
		}
		if ( get_option( 'lsp-services3' ) ) {
			$zstring .= ', ' . get_option( 'lsp-services3' );
		}

		$bigCity = get_option( 'lsp-biggest-city' );
		if ( $bigCity ) {
			$bigCity = $bigCity . ' ';
		}
		global $post;
		if ( get_post_meta( $post->ID, '_lsp_post_locktitle', true ) != 'yes' && get_option( 'lsp-biztype' ) != 'ls2' ) {
			echo '<title>' . $bigCity . get_option( 'lsp-api-city' ) . ', ' . get_option( 'lsp-api-state' ) . ' ' . ucwords( $zstring ) . '</title>';
		}
		if ( get_post_meta( $post->ID, '_lsp_post_locktitle', true ) != 'yes' && get_option( 'lsp-biztype' ) == 'ls2' ) {
			echo '<title>' . ucwords( $zstring ) . __( ' near ', 'lsp_text_domain' ) . $bigCity . get_option( 'lsp-api-city' ) . ', ' . get_option( 'lsp-api-state' ) . '</title>';
		}
	}

	// EDITPOINT
	if ( get_option( 'lsp-posts-adjust' ) != 'no' && get_post_type() == 'localproject' && get_post_meta( $post->ID, 'lsp_project_terms', true ) != '' ) {
		if ( get_option( 'lsp-biztype' ) != 'ls2' ) {
			echo '<title>' . get_post_meta( $post->ID, 'lsp_project_terms', true ) . '</title>';
		}
		if ( get_option( 'lsp-biztype' ) == 'ls2' ) {
			echo '<title>' . get_post_meta( $post->ID, 'lsp_project_terms', true ) . '</title>';
		}
	}

}
add_action( 'wp_head', 'lsp_homepage_title', 0 );



function lsp_prescribed_title( $title ) {
	$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	global $post;

	global $post;
	if ( get_option( 'lsp-ptemplate-id' ) == $post->ID ) {
		$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
		if ( $currentSlugArray[4] ) {
			$currentSlug = $currentSlugArray[2];
		} else {
			$currentSlug = $currentSlugArray[1];
		}
		$currentTerm = str_replace( '-', ' ', $currentSlug );
		global $wp_query;

		if ( get_option( 'lsp-biztype' ) == 'ls2' ) {
			return stripslashes( ucwords( $currentTerm ) ) . __( ' near ', 'lsp_text_domain' ) . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . '';
		} else {
			return '' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . ' ' . stripslashes( ucwords( $currentTerm ) ) . '';
		}
	}

	if ( lsp_get_option( 'lsp-auto-adjust' ) == 'yes' && is_front_page() ) {
		$zstring = '';
		if ( lsp_get_option( 'lsp-services' ) ) {
			$zstring = lsp_get_option( 'lsp-services' );
		}
		if ( lsp_get_option( 'lsp-services2' ) ) {
			$zstring .= ', ' . lsp_get_option( 'lsp-services2' );
		}
		if ( lsp_get_option( 'lsp-services3' ) ) {
			$zstring .= ', ' . lsp_get_option( 'lsp-services3' );
		}
		$bigCity = lsp_get_option( 'lsp-biggest-city' );
		if ( $bigCity ) {
			$bigCity = $bigCity . ' ';
		}
		if ( get_option( 'lsp-biztype' ) != 'ls2' ) {
			echo '<title>' . $bigCity . get_option( 'lsp-api-city' ) . ', ' . get_option( 'lsp-api-state' ) . ' ' . ucwords( $zstring ) . '</title>';
		}
		if ( get_option( 'lsp-biztype' ) == 'ls2' ) {
			echo '<title>' . ucwords( $zstring ) . __( ' near ', 'lsp_text_domain' ) . $bigCity . get_option( 'lsp-api-city' ) . ', ' . get_option( 'lsp-api-state' ) . '</title>';
		}
		return $bigCity . lsp_get_option( 'lsp-api-city' ) . ', ' . lsp_get_option( 'lsp-api-state' ) . ' ' . ucwords( $zstring );
	} else {
		return $title;
	}

}
add_filter( 'wp_title', 'lsp_prescribed_title', 99999, 1 );
add_filter( 'get_the_archive_title', 'lsp_prescribed_title', 99999, 1 );

add_filter( 'wpseo_title', 'lsp_prescribed_title', 100 );
add_filter( 'wpseo_title', 'lsp_prescribed_title', 100, 1 );
add_filter( 'wpseo_title', 'lsp_prescribed_title', 99999 );
add_filter( 'wpseo_title', 'lsp_prescribed_title', 99999, 1 );

// Set Titles on Pages Created with Plugin
function lsp_keyphrase_one_page_title( $title ) {
	$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
	if ( $currentSlugArray[4] ) {
		$currentSlug = $currentSlugArray[2];
	} else {
		$currentSlug = $currentSlugArray[1];
	}

	if ( $currentSlug == 'feedback' && sanitize_text_field( $_GET['description2'] ) ) {
		return __( 'Feedback from ', 'lsp_text_domain' ) . sanitize_text_field( $_GET['name2'] );
	}

	if ( $currentSlug == 'feedback' ) {
		return __( 'Give Feedback', 'lsp_text_domain' );
	}
	$currentTerm = str_replace( '-', ' ', $currentSlug );

	if ( get_the_ID() == lsp_get_option( 'lsp-ptemplate-id' ) && ( ( lsp_get_option( 'lsp-keyphrase' ) == $currentTerm ) ) ) {
		global $wp_query;

		if ( ( $wp_query->query_vars['city'] != 'list' ) && ( $wp_query->query_vars['state'] != 'list' ) ) {

			if ( lsp_get_option( 'lsp-biztype' ) == 'ls2' ) {
				echo '<title>' . stripslashes( ucwords( $currentTerm ) ) . __( ' near ', 'lsp_text_domain' ) . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . '</title>';
			} else {
				echo '<title>' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . ' ' . stripslashes( ucwords( $currentTerm ) ) . '</title>';
			}
			if ( lsp_get_option( 'lsp-biztype' ) == 'ls2' ) {
				return stripslashes( ucwords( $currentTerm ) ) . __( ' near ', 'lsp_text_domain' ) . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . '';
			} else {
				return stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . ' ' . stripslashes( ucwords( $currentTerm ) ) . '';
			}
			// return stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['city'])))) . ", " . stripslashes(ucwords(str_replace("-", " ", urldecode($wp_query->query_vars['state'])))) . " " . stripslashes(ucwords($currentTerm)) . "";
		} else {
			return stripslashes( ucwords( $currentTerm ) );
		}
	}

	return $title;
}
add_filter( 'pre_get_document_title', 'lsp_keyphrase_one_page_title', 99999999, 5 );


// Set Title Tags on Pages Created with Plugin
function lsp_keyphrase_one_page_title2( $title ) {
	$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
	if ( $currentSlugArray[4] ) {
		$currentSlug = $currentSlugArray[2];
	} else {
		$currentSlug = $currentSlugArray[1];
	}

	if ( $currentSlug == 'feedback' && sanitize_text_field( $_GET['description2'] ) ) {
		return __( 'Feedback from ', 'lsp_text_domain' ) . sanitize_text_field( $_GET['name2'] );
	}
	if ( $currentSlug == 'feedback' ) {
		return __( 'Give Feedback', 'lsp_text_domain' );
	}
	$currentTerm = str_replace( '-', ' ', $currentSlug );

	if ( get_the_ID() == lsp_get_option( 'lsp-ptemplate-id' ) && ( ( lsp_get_option( 'lsp-keyphrase' ) == $currentTerm ) ) ) {
		global $wp_query;
		if ( ( $wp_query->query_vars['city'] != 'list' ) && ( $wp_query->query_vars['state'] != 'list' ) ) {

			return stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . ' ' . stripslashes( ucwords( $currentTerm ) ) . '';
		} else {
			return stripslashes( ucwords( $currentTerm ) );
		}
	}
	return $title;
}
add_filter( 'wp_title', 'lsp_keyphrase_one_page_title2', 99999999, 1 );

// Title filtering
function lsp_keyphrase_one_title( $title ) {
	if ( in_the_loop() ) {
		$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
		if ( $currentSlugArray[4] ) {
			$currentSlug = $currentSlugArray[2];
		} else {
			$currentSlug = $currentSlugArray[1];
		}
		if ( $currentSlug == 'feedback' && sanitize_text_field( $_GET['description2'] ) ) {
			return __( 'Feedback from ', 'lsp_text_domain' ) . sanitize_text_field( $_GET['name2'] );
		}

		if ( $currentSlug == 'feedback' ) {
			return __( 'Give Feedback', 'lsp_text_domain' );
		}

		$currentTerm = str_replace( '-', ' ', $currentSlug );

		if ( get_the_ID() == lsp_get_option( 'lsp-ptemplate-id' ) && ( ( lsp_get_option( 'lsp-keyphrase' ) == $currentTerm ) ) ) {
			global $wp_query;

			if ( ( $wp_query->query_vars['city'] != 'list' ) && ( $wp_query->query_vars['state'] != 'list' ) ) {
				return stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ) ) ) . ', ' . stripslashes( ucwords( str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ) ) ) . ' ' . stripslashes( ucwords( $currentTerm ) ) . '';
			} else {
				return stripslashes( ucwords( $currentTerm ) );
			}
		}
		return $title;
	}
	return $title;
}
add_filter( 'the_title', 'lsp_keyphrase_one_title', 9999999, 5 );

// Home Page Optimizer Filter
function lsp_headermeta2() {
	global $post;

	$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
	if ( $currentSlugArray[4] ) {
		$currentSlug = $currentSlugArray[2];
	} else {
		$currentSlug = $currentSlugArray[1];
	}
	$currentTerm = str_replace( '-', ' ', $currentSlug );
	global $wp_query;

	global $post;

	$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
	if ( $currentSlugArray[4] ) {
		$currentSlug = $currentSlugArray[2];
	} else {
		$currentSlug = $currentSlugArray[1];
	}
		$currentTerm = str_replace( '-', ' ', $currentSlug );
		global $wp_query;

	if ( $currentSlug == 'review' ) {
		echo "<script>
    window.location = '" . get_option( 'lsp-reviews-url' ) . "'</script>";
		die( 'Redirecting' );
	}

	if ( $currentSlug == 'getreviews' ) {
		global $plus;
		$lspplus = curlfallback( 'http://www.bestlocalseotools.com/index3.php' . '?plus=' . urlencode( get_option( 'lsp-api-key' ) ) . '&request=pluscheck' );
		if ( $lspplus ) {
			$plus = $lspplus;
		}

		if ( $plus == 0 ) {
			echo "<script>
      window.location = '" . site_url() . '/wp-admin/post-new.php?post_type=localproject' . "'</script>";
			die( 'Redirecting' );
		}
		if ( $plus ) {
			echo "<script>
      window.location = '" . 'http://www.prolocalseotools.com/?key=' . get_option( 'lsp-api-key' ) . '&domain=' . urlencode( site_url() ) . '&name5=' . urlencode( get_bloginfo( 'name' ) ) . '&turbo=' . get_option( 'lsp-turbomode' ) . '&url=' . urlencode( get_option( 'lsp-reviews-url' ) ) . "'</script>";
			die( 'Redirecting' );
		}
	}

	if ( $currentSlug == 'addproject' ) {
		echo "<script>
    window.location = '" . site_url() . '/wp-admin/post-new.php?post_type=localproject' . "'</script>";
		die( 'Redirecting' );
	}

	if ( $currentSlug == get_option( 'lsp-requests-slug' ) ) {

		if ( get_option( 'lsp-requests-slug' ) ) {
			echo "<script>window.location = 'http://www.prolocalseotools.com/?key=" . get_option( 'lsp-api-key' ) . '&domain=' . urlencode( site_url() ) . '&name5=' . urlencode( get_bloginfo( 'name' ) ) . '&turbo=' . get_option( 'lsp-turbomode' ) . '&url=' . urlencode( get_option( 'lsp-reviews-url' ) ) . "'</script>";
			die( 'Redirecting' );
		}
		// echo $nowUrl ."??". site_url()."/".get_option('lsp-requests-slug');
		// if(strstr($nowUrl,site_url()."/".get_option('lsp-requests-slug')))wp_redirect('http://www.bestlocalseotools.com/getfeedback');
	}

	$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	if ( $prescription[ $post->ID ] ) {
		$current_url = $post->ID;
	}
	$prescription = lsp_get_option( 'lsp-prescription' );
	if ( lsp_get_option( 'lsp-ptemplate-id' ) != $post->ID ) {

		if ( lsp_get_option( 'lsp-auto-adjust' ) == 'yes' && is_front_page() && lsp_get_post_meta( $post->ID, '_lsp_post_autooptimize', true ) != 'no' && lsp_get_post_meta( $post->ID, '_lsp_post_locktitle', true ) != 'yes' ) {
			$zstring = '';
			if ( lsp_get_option( 'lsp-services' ) ) {
				$zstring = lsp_get_option( 'lsp-services' );
			}
			if ( lsp_get_option( 'lsp-services2' ) ) {
				$zstring .= ', ' . lsp_get_option( 'lsp-services2' );
			}
			if ( lsp_get_option( 'lsp-services3' ) ) {
				$zstring .= ', ' . lsp_get_option( 'lsp-services3' );
			}

			$bigCity = lsp_get_option( 'lsp-biggest-city' );
			if ( $bigCity ) {
				$bigCity = $bigCity . ' ';
			}

			echo "<meta name='description' value=" . '"' . $bigCity . ucwords( lsp_get_option( 'lsp-api-city' ) ) . ', ' . ucwords( lsp_get_option( 'lsp-api-state' ) ) . ' ' . $zstring . '"' . '>';
			echo "<meta name='keywords' value=" . '"' . $bigCity . ucwords( lsp_get_option( 'lsp-api-city' ) ) . ', ' . ucwords( lsp_get_option( 'lsp-api-state' ) ) . ' ' . $zstring . '"' . '>';

		}
	}

}
add_action( 'wp_head', 'lsp_headermeta2', 1 );
 // add_action('wpseo_metadesc', function(){return false;}, 1);
// add_action('wpseo_metadesc', 'lsp_headermeta2', 1);
// for tracking to not send multiple emails as content filter is perhaps repeatedly run
global $runner;
global $pageContent;
$pageContent = '';
$runner      = 0;
function lsp_keyphrase_one_content( $content ) {
	global $runner;
	global $pageContent;
	$runner++;
	$currentSlug      = '';
	$functionPhrase   = '';
	$currentSlugArray = explode( '/', $_SERVER['REQUEST_URI'] );
	if ( $currentSlugArray[4] ) {
		$currentSlug = $currentSlugArray[2];
	} else {
		$currentSlug = $currentSlugArray[1];
	}

	if ( lsp_get_option( 'lsp-star-minimum' ) == '' ) {
		$filterholder = 4;
	} else {
		$filterholder = lsp_get_option( 'lsp-star-minimum' );
	}

	if ( $currentSlug == 'feedback' && ! ( sanitize_text_field( $_GET['name2'] ) ) ) {
		$emailholder = '';
		if ( sanitize_email( $_GET['email2'] ) ) {
			$emailholder = sanitize_email( $_GET['email2'] );
		}

		if ( lsp_get_option( 'lsp-reviews-loc' ) && lsp_get_option( 'lsp-storeLocations' ) == 'yes' ) {

			if ( lsp_get_option( 'lsp-reviews-loc' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc2' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc2' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc3' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc3' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc4' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc4' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc5' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc5' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc6' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc6' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc7' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc7' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc8' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc8' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc9' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc9' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc10' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc10' );
			}

			if ( lsp_get_option( 'lsp-reviews-loc11' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc11' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc12' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc12' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc13' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc13' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc14' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc14' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc15' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc15' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc16' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc16' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc17' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc17' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc18' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc18' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc19' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc19' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc20' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc20' );
			}

			if ( lsp_get_option( 'lsp-reviews-loc21' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc21' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc22' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc22' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc23' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc23' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc24' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc24' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc25' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc25' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc26' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc26' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc27' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc27' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc28' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc28' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc29' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc29' );
			}
			if ( lsp_get_option( 'lsp-reviews-loc30' ) ) {
				$storelocations[] = lsp_get_option( 'lsp-reviews-loc30' );
			}

			$storelocations = array_unique( $storelocations );

			$storelocationsInput  = '<br><select name="storelocation">';
			$storelocationsInput .= '<option value="">' . __( 'Store Location', 'lsp_text_domain' ) . '</option>';
			for ( $i = 0; $i < sizeof( $storelocations ); $i++ ) {
				$storelocationsInput .= '<option value="' . $storelocations[ $i ] . '">' . $storelocations[ $i ] . '</option>';
			}
			$storelocationsInput .= '"</select><br>';
		}

		$nameholder = __( 'Your Name (required)', 'lsp_text_domain' );

		return __( 'Please give us feedback regarding your experience with us.', 'lsp_text_domain' ) . '<br><form  style="max-width:500px" action="' . site_url() . '/feedback/' . '" method="get">' . '
      
    <input class="hover-star" type="radio" name="test-3B-rating-1" value="1" title="Very poor"/>
    <input class="hover-star" type="radio" name="test-3B-rating-1" value="2" title="Poor"/>
    <input class="hover-star" type="radio" name="test-3B-rating-1" value="3" title="Average"/>
    <input class="hover-star" type="radio" name="test-3B-rating-1" value="4" title="Good"/>
    <input class="hover-star" type="radio" name="test-3B-rating-1" value="5" title="Very Good"/>
    <span id="hover-test" style="margin:0 0 0 20px;">How do you rate your experience?</span>

      <br><input name="name2" type="text" placeholder="' . $nameholder . '" style="width:100%;max-width:500px"><br><textarea name="description2" rows="4" placeholder="' . __( 'Please describe how your experience went', 'lsp_text_domain' ) . '" style="float:left;clear:both;width:100%;max-width:500px"></textarea><br><textarea name="suggestions2" rows="4" placeholder="' . __( 'How could we improve?', 'lsp_text_domain' ) . '" style="width:100%;max-width:500px;clear:both"></textarea>
    ' . '' . '
      <br><input type="text" name="email2" placeholder="' . __( 'Your Email Address', 'lsp_text_domain' ) . '" style="width:100%;max-width:500px"><br><input type="text" name="city2" value="' . $emailholder . '"" placeholder="' . __( 'Your City', 'lsp_text_domain' ) . '" style="width:100%;max-width:500px"><br><input type="text" name="state2" placeholder="' . __( 'Your State / Province (full state name)', 'lsp_text_domain' ) . '" style="width:100%;max-width:500px"><br>' . $employeesInput . $storelocationsInput . $questionsInput . $captchaInput . '<input type="submit" value="' . __( 'Share Feedback', 'lsp_text_domain' ) . '"></form>' . '
   ' . '
    ' . '' . '
    </div>';
	} elseif ( $currentSlug == 'feedback' && ( sanitize_text_field( $_GET['test-3B-rating-1'] ) >= 0 ) ) {

		global $wpdb;
		$thisresult = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key FROM $wpdb->postmeta WHERE meta_value = %s", $_SERVER['REMOTE_ADDR'] ) );
		$haveip     = 0;

		$thisresult = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, post_id FROM $wpdb->postmeta WHERE meta_value = %s", sanitize_email( $_GET['email2'] ) ) );
		global $emailpostid;

		$eholder;
		$haveemail   = 0;
		$emailpostid = '';
		foreach ( $thisresult as $test ) {
			$haveemail = 1;
			global $emailpostid;
			$eholder = $test->post_id;

			$emailpostid = $test->post_id;
		}

		if ( $haveip == 1 ) {
			return __( "We have received feedback from this IP address already, and thus don't send further feedback to prevent spam. If this is a store kiosk, the IP address can be whitelisted in the settings. Please contact the business through other means if you are trying to send non-spam communications. The presumed IP Address of this computer is ", 'lsp_text_domain' ) . $_SERVER['REMOTE_ADDR'];
			$jsString = '';
			if ( ( strstr( lsp_get_option( 'lsp-kiosk-ip' ), $_SERVER['REMOTE_ADDR'] ) ) ) {
				$jsString = "<meta http-equiv='refresh' content='300;url=" . get_site_url() . "'>";
			}
		}

		if ( $haveip == 0 && $haveemail == 0 ) {

			$autopublish = 'draft';
			if ( lsp_get_option( 'lsp-testimonials-auto-publish' ) == 'yes' ) {
				$autopublish = 'publish';
			}

			$post = array(
				'post_content'   => '',
				'post_title'     => sanitize_text_field( $_GET['name2'] ),
				'post_status'    => $autopublish,
				'post_type'      => 'localproject',
				'comment_status' => 'closed',
				'page_template'  => '',
			);

			$id = wp_insert_post( $post );

			$myKey     = lsp_get_option( 'lsp-api-key' );
			$country   = 'US'; // just placeholder -- the geo service uses city & state to figure this out
			$latitude  = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_GET['city2'] ) ) . '&state=' . urlencode( sanitize_text_field( $_GET['state2'] ) ) . '&request=latitude' );
			$longitude = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_GET['city2'] ) ) . '&state=' . urlencode( sanitize_text_field( $_GET['state2'] ) ) . '&request=longitude' );
			$country   = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_GET['city2'] ) ) . '&state=' . urlencode( sanitize_text_field( $_GET['state2'] ) ) . '&request=country' );

			update_post_meta( $id, 'lsp_post_latitude', $latitude );
			update_post_meta( $id, 'lsp_post_longitude', $longitude );
			update_post_meta( $id, 'lsp_post_country', $country );

			update_post_meta( $id, 'lsp_post_ip', $_SERVER['REMOTE_ADDR'] );

			update_post_meta( $id, 'lsp_post_score', (int) ( sanitize_text_field( $_GET['test-3B-rating-1'] ) ) );
			update_post_meta( $id, 'lsp_post_testimonial', sanitize_text_field( $_GET['description2'] ) );
			update_post_meta( $id, 'lsp_post_city', sanitize_text_field( $_GET['city2'] ) );
			update_post_meta( $id, 'lsp_post_state', sanitize_text_field( $_GET['state2'] ) );
			update_post_meta( $id, 'lsp_post_client_name', sanitize_text_field( $_GET['name2'] ) );
			update_post_meta( $id, 'lsp_post_email', sanitize_email( $_GET['email2'] ) );

			update_post_meta( $id, 'lsp_post_storelocation', sanitize_text_field( $_GET['storelocation'] ) );

			update_post_meta( $id, '_lsp_post_date', date( 'Y-m-d' ) );

			$reviewssites = '';
			if ( lsp_get_option( 'lsp-reviews-name' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name2' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name2' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url2' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name3' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name3' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url3' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name4' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name4' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url4' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name5' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name5' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url5' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name6' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name6' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url6' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name7' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name7' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url7' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name8' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name8' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url8' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name9' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name9' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url9' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name10' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name10' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url10' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name11' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name11' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url11' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name12' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name12' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url12' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name13' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name13' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url13' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name14' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name14' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url14' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name15' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name15' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url15' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name16' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name16' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url16' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name17' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name17' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url17' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name18' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name18' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url18' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name19' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name19' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url19' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name20' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name20' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url20' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name21' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name21' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url21' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name22' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name22' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url22' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name23' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name23' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url23' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name24' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name24' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url24' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name25' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name25' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url25' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name26' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name26' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url26' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name27' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name27' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url27' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name28' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name28' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url28' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name29' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name29' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url29' ) );
			}
			if ( lsp_get_option( 'lsp-reviews-name30' ) ) {
				$reviewssites .= "\n" . lsp_get_option( 'lsp-reviews-name30' ) . ': ' . esc_url( lsp_get_option( 'lsp-reviews-url30' ) );
			}

			if ( $runner == 1 && ( sanitize_text_field( $_GET['test-3B-rating-1'] ) >= lsp_get_option( 'lsp-star-minimum' ) ) ) {
				wp_mail( sanitize_email( $_GET['email2'] ), __( "Thank you for your feedback! We'd appreciate it if you could review us on these sites as well:", 'lsp_text_domain' ), __( 'Such reviews help our business and we would really appreciate it!', 'lsp_text_domain' ) . "\n\n" . $reviewssites );
				$runner = $runner + 1;
			}
		}

		if ( $haveip == 0 && $haveemail == 1 ) {

			global $emailpostid;

			global $wpdb;
			$thisresult = $wpdb->get_results( $wpdb->prepare( "SELECT meta_key, post_id FROM $wpdb->postmeta WHERE meta_value = %s", sanitize_email( $_GET['email2'] ) ) );
			global $emailpostid;

			$eholder;
			$emailpostid = '';
			foreach ( $thisresult as $test ) {
				$haveemail = 1;
				global $emailpostid;
				$eholder     = $test->post_id;
				$emailpostid = $test->post_id;
			}

			if ( $emailpostid ) {
				$id = $emailpostid;
			}

			$myKey     = lsp_get_option( 'lsp-api-key' );
			$country   = 'US'; // just placeholder -- the geo service uses city & state to figure this out
			$latitude  = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_GET['city2'] ) ) . '&state=' . urlencode( sanitize_text_field( $_GET['state2'] ) ) . '&request=latitude' );
			$longitude = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_GET['city2'] ) ) . '&state=' . urlencode( sanitize_text_field( $_GET['state2'] ) ) . '&request=longitude' );
			$country   = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_GET['city2'] ) ) . '&state=' . urlencode( sanitize_text_field( $_GET['state2'] ) ) . '&request=country' );

			update_post_meta( $emailpostid, 'lsp_post_score', sanitize_text_field( $_GET['test-3B-rating-1'] ) );
			update_post_meta( $emailpostid, 'lsp_post_testimonial', sanitize_text_field( $_GET['description2'] ) );

			update_post_meta( $id, 'lsp_post_latitude', $latitude );
			update_post_meta( $id, 'lsp_post_longitude', $longitude );
			update_post_meta( $id, 'lsp_post_country', $country );

			update_post_meta( $id, 'lsp_post_ip', $_SERVER['REMOTE_ADDR'] );

			update_post_meta( $id, 'lsp_post_score', sanitize_text_field( $_GET['test-3B-rating-1'] ) );
			update_post_meta( $id, 'lsp_post_testimonial', sanitize_text_field( $_GET['description2'] ) );
			update_post_meta( $id, 'lsp_post_city', sanitize_text_field( $_GET['city2'] ) );
			update_post_meta( $id, 'lsp_post_state', sanitize_text_field( $_GET['state2'] ) );

			update_post_meta( $id, 'lsp_post_client_name', sanitize_text_field( $_GET['name2'] ) );
			update_post_meta( $id, 'lsp_post_email', sanitize_email( $_GET['email2'] ) );

			update_post_meta( $id, 'lsp_post_storelocation', sanitize_text_field( $_GET['storelocation'] ) );

			update_post_meta( $id, '_lsp_post_date', date( 'Y-m-d' ) );

			if ( lsp_get_option( 'lsp-testimonials-auto-publish' ) == 'yes' && sanitize_text_field( $_GET['test-3B-rating-1'] ) >= $filterholder ) {
				update_post_meta( $id, 'lsp_post_show', 'yes' );
			}

			$suggestionsstring = '';

		}
	}

	$reviewssites = '';

	if ( strstr( $_SERVER['HTTP_REFERER'], site_url() ) ) {
		if ( lsp_get_option( 'lsp-reviews-name' ) ) {
			$reviewssites .= '<b>' . __( 'Please review us on:', 'lsp_text_domain' ) . "</b><br><a href='" . esc_url( lsp_get_option( 'lsp-reviews-url' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name2' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url2' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name2' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name3' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url3' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name3' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name4' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url4' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name4' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name5' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url5' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name5' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name6' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url6' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name6' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name7' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url7' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name7' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name8' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url8' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name8' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name9' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url9' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name9' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name10' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url10' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name10' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name11' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url11' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name11' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name12' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url12' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name12' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name13' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url13' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name13' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name14' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url14' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name14' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name15' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url15' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name15' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name16' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url16' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name16' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name17' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url17' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name17' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name18' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url18' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name18' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name19' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url19' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name19' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name20' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url20' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name20' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name21' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url21' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name21' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name22' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url22' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name22' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name23' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url23' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name23' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name24' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url24' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name24' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name25' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url25' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name25' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name26' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url26' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name26' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name27' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url27' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name27' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name28' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url28' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name28' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name29' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url29' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name29' ) ) . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-reviews-name30' ) ) {
			$reviewssites .= "<a href='" . esc_url( lsp_get_option( 'lsp-reviews-url30' ) ) . "' target='_blank'>" . esc_url( lsp_get_option( 'lsp-reviews-name30' ) ) . '</a><br>';
		}
	}

	$extratext = '';
	if ( strstr( $_SERVER['HTTP_REFERER'], site_url() ) ) {
		$extratext .= '<br>' . __( 'Your feedback / review:', 'lsp_text_domain' ) . '<br>' . sanitize_text_field( $_GET['description2'] );
	} else {
		$extratext .= '<br>' . __( 'Their feedback / review:', 'lsp_text_domain' ) . '<br>' . sanitize_text_field( $_GET['description2'] );
	}

	if ( $currentSlug == 'feedback' && ( sanitize_text_field( $_GET['name2'] ) ) ) {

		$jsString = '';
		if ( ( strstr( lsp_get_option( 'lsp-kiosk-ip' ), $_SERVER['REMOTE_ADDR'] ) ) ) {
			$jsString = "<meta http-equiv='refresh' content='300;url=" . get_site_url() . "'>";
		}

		if ( sanitize_text_field( $_GET['test-3B-rating-1'] ) < $filterholder ) {
			return __( 'Thank you for your feedback.', 'lsp_text_domain' ) . $jsString;
		}

		if ( strstr( $_SERVER['HTTP_REFERER'], site_url() ) ) {
			if ( sanitize_text_field( $_GET['test-3B-rating-1'] ) >= $filterholder ) {
				global $plus;

				wp_mail( sanitize_email( $_GET['email2'] ), __( 'Thank you for your feedback! Please help spread the word!', 'lsp_text_domain' ), __( 'Thank you for your feedback! Could you please also share your experience with your friends and review us on the sites listed below? Such reviews help our business and we would really appreciate it! Thank you!', 'lsp_text_domain' ) . "\n" . $reviewssites );
				global $plus;
				if ( $plus && ( $haveip == 0 && $haveemail == 0 ) && $runner == 1 ) {
					wp_mail( sanitize_email( lsp_get_option( 'admin_email' ) ), sanitize_text_field( $_GET['name2'] ) . __( ' gave you feedback.', 'lsp_text_domain' ), __( 'You can view it and publish the project to your portfolio at ', 'lsp_text_domain' ) . network_site_url( '/' ) . 'wp-admin/post.php?post=' . $id . '&action=edit .' . $suggestionsstring );
					$runner = $runner + 1;
				}

				return $reviewssites . $extratext . $jsString;
			}
		} else {
			return $extratext;
		}
	}

	$currentTerm = str_replace( '-', ' ', $currentSlug );

	$functionCountry = strtoupper( $currentSlugArray[1] );

	global $wp_query;
	if ( get_the_ID() == lsp_get_option( 'lsp-ptemplate-id' ) && ( ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase' ) ) ) ) && $wp_query->query_vars['city'] && $wp_query->query_vars['state'] ) {
		global $pageContent;
		if ( $pageContent == '' ) {
			$pageContent = do_shortcode( get_localportfolio_content( $currentTerm, str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ), str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ), $functionCountry ) );
		}
		return $pageContent;
	}

	if ( lsp_get_option( 'lsp-keyphrase-override' ) == $currentTerm ) {
		$phraseNum = 1;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override2' ) == $currentTerm ) {
		$phraseNum = 2;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override3' ) == $currentTerm ) {
		$phraseNum = 3;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override4' ) == $currentTerm ) {
		$phraseNum = 4;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override5' ) == $currentTerm ) {
		$phraseNum = 5;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override6' ) == $currentTerm ) {
		$phraseNum = 6;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override7' ) == $currentTerm ) {
		$phraseNum = 7;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override8' ) == $currentTerm ) {
		$phraseNum = 8;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override9' ) == $currentTerm ) {
		$phraseNum = 9;
	}
	if ( lsp_get_option( 'lsp-keyphrase-override10' ) == $currentTerm ) {
		$phraseNum = 10;
	}

	if ( get_the_ID() == lsp_get_option( 'lsp-ptemplate-id' ) && ( ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override2' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override3' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override4' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override5' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override6' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override7' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override8' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override9' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override10' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override2' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override3' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override4' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override5' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override6' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override7' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override8' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override9' ) ) ) || ( $currentSlug == str_replace( ' ', '-', lsp_get_option( 'lsp-keyphrase-override10' ) ) ) ) && $wp_query->query_vars['city'] && $wp_query->query_vars['state'] ) {
		global $pageContent;
		if ( $phraseNum == 1 && $pageContent == '' ) {
			$pageContent = do_shortcode( get_localportfolio_content( lsp_get_option( 'lsp-keyphrase' ), str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ), str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ), $functionCountry ) );
		}
		if ( $phraseNum > 1 && $pageContent == '' ) {
			$pageContent = do_shortcode( get_localportfolio_content( lsp_get_option( 'lsp-keyphrase' . $phraseNum ), str_replace( '-', ' ', urldecode( $wp_query->query_vars['city'] ) ), str_replace( '-', ' ', urldecode( $wp_query->query_vars['state'] ) ), $functionCountry ) );
		}
	}
	global $pageContent;

	if ( $runner != 1 ) {
		return $content;
	}

	if ( $pageContent != '' ) {
		return $pageContent;
	} else {
		return $content;
	}
}
add_filter( 'the_content', 'lsp_keyphrase_one_content', 9999999 );


// The Local Portfolio Footer Links
function lsp_get_content() {
	global $post;
	if ( ( lsp_get_option( 'lsp-cities-all-pages' ) != 'none' ) && ( ( lsp_get_option( 'lsp-api-city' ) != '' ) && ( lsp_get_option( 'lsp-publish-now' ) == 'yes' || ( ( current_user_can( 'administrator' ) ) && ( lsp_get_option( 'lsp-publish-now' ) == 'preview' ) ) ) && ( lsp_get_option( 'lsp-ptemplate-id' ) != $post->ID ) && ( is_home() || is_front_page() || ( ( lsp_get_option( 'lsp-cities-all-pages' ) != 'no' ) ) ) ) ) {

		$total_cities = lsp_get_option( 'lsp-max-cities' );

		$total_portfolios = 0;

		if ( ( lsp_get_option( 'lsp-keyphrase' ) && ( lsp_get_option( 'lsp-publish-now' ) == 'yes' || lsp_get_option( 'lsp-publish-now' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase2' ) && ( lsp_get_option( 'lsp-publish-now2' ) == 'yes' || lsp_get_option( 'lsp-publish-now2' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio2' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase3' ) && ( lsp_get_option( 'lsp-publish-now3' ) == 'yes' || lsp_get_option( 'lsp-publish-now3' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio3' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase4' ) && ( lsp_get_option( 'lsp-publish-now4' ) == 'yes' || lsp_get_option( 'lsp-publish-now4' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio4' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase5' ) && ( lsp_get_option( 'lsp-publish-now5' ) == 'yes' || lsp_get_option( 'lsp-publish-now5' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio5' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase6' ) && ( lsp_get_option( 'lsp-publish-now6' ) == 'yes' || lsp_get_option( 'lsp-publish-now6' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio6' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase7' ) && ( lsp_get_option( 'lsp-publish-now7' ) == 'yes' || lsp_get_option( 'lsp-publish-now7' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio7' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase8' ) && ( lsp_get_option( 'lsp-publish-now8' ) == 'yes' || lsp_get_option( 'lsp-publish-now8' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio8' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase9' ) && ( lsp_get_option( 'lsp-publish-now9' ) == 'yes' || lsp_get_option( 'lsp-publish-now9' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio9' ) == 'yes' ) {
			$total_portfolios += 1;
		}
		if ( ( lsp_get_option( 'lsp-keyphrase10' ) && ( lsp_get_option( 'lsp-publish-now10' ) == 'yes' || lsp_get_option( 'lsp-publish-now10' ) == 'preview' ) ) && lsp_get_option( 'lsp-makeportfolio10' ) == 'yes' ) {
			$total_portfolios += 1;
		}

		$percentsCount = 0;
		if ( lsp_get_option( 'lsp-percent' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent' );
		}
		if ( lsp_get_option( 'lsp-percent2' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent2' );
		}
		if ( lsp_get_option( 'lsp-percent3' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent3' );
		}
		if ( lsp_get_option( 'lsp-percent4' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent4' );
		}
		if ( lsp_get_option( 'lsp-percent5' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent5' );
		}
		if ( lsp_get_option( 'lsp-percent6' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent6' );
		}
		if ( lsp_get_option( 'lsp-percent7' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent7' );
		}
		if ( lsp_get_option( 'lsp-percent8' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent8' );
		}
		if ( lsp_get_option( 'lsp-percent9' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent9' );
		}
		if ( lsp_get_option( 'lsp-percent10' ) ) {
			$percentsCount += lsp_get_option( 'lsp-percent10' );
		}

		$cities_per_portfolio = $total_cities / $total_portfolios;

		$cities_per_portfolio = round( $cities_per_portfolio );

		$lsp_content = '';

		if ( lsp_get_option( 'lsp-footer-links' ) != 'no' ) {

			if ( wp_kses(
				get_option( 'lsp_content' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) ) {
				return wp_kses(
					get_option( 'lsp_content' ),
					array(
						'a' => array(
							'href'  => array(),
							'title' => array(),
						),
					)
				);
			}

			$classString = '';
			$bgString    = '';
			if ( lsp_get_option( 'lsp-add-classes' ) ) {
				$classString = " class='" . lsp_get_option( 'lsp-add-classes' ) . "'";
			}
			if ( lsp_get_option( 'lsp-homepage-footer-links-background-color' ) ) {
				$bgString = " style='clear:both;background:#" . esc_attr( lsp_get_option( 'lsp-homepage-footer-links-background-color' ) ) . "'";
			} else {
				$bgString = " style='clear:both;'";
			}

			$lsp_content .= '<div' . $bgString . $classString . "><font color='" . esc_attr( lsp_get_option( 'lsp-text-color' ) ) . "'><br><br>";

			global $plus;
			$plus = lsp_get_option( 'lsp-plus' );
			if ( $plus < 1 ) {
				$total_portfolios = 1;
			}

			// Code for multiple portfolios support
			for ( $i = 1; $i <= 1; $i++ ) {
				$goorno = '0';
				if ( $i == 1 && lsp_get_option( 'lsp-makeportfolio' ) == 'yes' && lsp_get_option( 'lsp-services' ) != '' ) {
					$goorno = '1';
				}
				if ( $i > 1 && lsp_get_option( 'lsp-makeportfolio' . $i ) == 'yes' && lsp_get_option( 'lsp-services' . $i ) != '' ) {
					$goorno = '1';
				}

				if ( $goorno ) {
					if ( $i == 1 ) {
						if ( lsp_get_option( 'lsp-footer-intro' ) == '' ) {
							$lsp_content .= __( "You can see who we've worked with near you that you might know for a reference by browsing our hierarchical portfolio directory below. ", 'lsp_text_domain' );
						} else {
							$lsp_content .= lsp_get_option( 'lsp-footer-intro' ) . ' ';
						}
					}
					if ( $i == 1 ) {
						$lsp_content .= __( 'For ', 'lsp_text_domain' ) . lsp_get_option( 'lsp-keyphrase' ) . __( ', cities we serve include ', 'lsp_text_domain' );
					}

					if ( $i > 1 ) {
						$lsp_content .= __( 'For ', 'lsp_text_domain' ) . lsp_get_option( 'lsp-keyphrase' . $i ) . __( ', cities we serve include ', 'lsp_text_domain' );
					}

					if ( $i == 1 ) {
						if ( lsp_get_option( 'lsp-keyphrase-override' ) ) {
							$main_portfolio_term = lsp_get_option( 'lsp-keyphrase-override' );
						} else {
							$main_portfolio_term = lsp_get_option( 'lsp-keyphrase' );
						}
					}

					if ( $i > 1 ) {
						if ( lsp_get_option( 'lsp-keyphrase-override' . $i ) ) {
							$main_portfolio_term = lsp_get_option( 'lsp-keyphrase-override' . $i );
						} else {
							$main_portfolio_term = lsp_get_option( 'lsp-keyphrase' . $i );
						}
					}

					// For only showing cities where
					$k = '';
					if ( $i > 1 ) {
						$k = $i;
					}

					/*
					global $wpdb;
					$query2 = "SELECT a.meta_value as city, b.meta_value as state, d.meta_value as country FROM " . $wpdb->prefix . "postmeta a, " . $wpdb->prefix . "postmeta b, " . $wpdb->prefix . "postmeta c, " . $wpdb->prefix . "postmeta d WHERE c.meta_value LIKE '%%" . lsp_get_option('lsp-keyphrase' . $k) . "%%' AND a.meta_key='lsp_post_city' AND b.meta_key='lsp_post_state' AND c.meta_key='lsp_post_tags' AND d.meta_key='lsp_post_country' AND a.post_id = b.post_id AND b.post_id = c.post_id";

					global $wpdb;
					$citystates      = $wpdb->get_results($query2);
					$projectsCounter = 0;
					$projectsString .= "";
					foreach ($citystates as $citystate) {
						if ($projectsCounter > 100)
							break;
						$projectArray[$projectsCounter] = $citystate->city . "," . $citystate->state;
						$projectsString .= $citystate->city . "," . $citystate->state . "," . $citystate->country . "|";
						$projectsCounter++;
					}*/

					$z = '1';
					if ( $i > 1 ) {
						$z = $i;
					}
					$projectsString = site_url() . '/?portfolioquery=' . $z;

					$ref = 0;
					$ref = $_SERVER['HTTP_REFERER'] . '|' . site_url();

					$total_cities = lsp_get_option( 'lsp-max-cities' );

					$percentsCount = 0;
					if ( lsp_get_option( 'lsp-percent' ) && lsp_get_option( 'lsp-makeportfolio' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent' );
					}
					if ( lsp_get_option( 'lsp-percent2' ) && lsp_get_option( 'lsp-makeportfolio2' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent2' );
					}
					if ( lsp_get_option( 'lsp-percent3' ) && lsp_get_option( 'lsp-makeportfolio3' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent3' );
					}
					if ( lsp_get_option( 'lsp-percent4' ) && lsp_get_option( 'lsp-makeportfolio4' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent4' );
					}
					if ( lsp_get_option( 'lsp-percent5' ) && lsp_get_option( 'lsp-makeportfolio5' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent5' );
					}
					if ( lsp_get_option( 'lsp-percent6' ) && lsp_get_option( 'lsp-makeportfolio6' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent6' );
					}
					if ( lsp_get_option( 'lsp-percent7' ) && lsp_get_option( 'lsp-makeportfolio7' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent7' );
					}
					if ( lsp_get_option( 'lsp-percent8' ) && lsp_get_option( 'lsp-makeportfolio8' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent8' );
					}
					if ( lsp_get_option( 'lsp-percent9' ) && lsp_get_option( 'lsp-makeportfolio9' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent9' );
					}
					if ( lsp_get_option( 'lsp-percent10' ) && lsp_get_option( 'lsp-makeportfolio10' ) == 'yes' ) {
						$percentsCount += lsp_get_option( 'lsp-percent10' );
					}

					global $plus;
					if ( $plus > 0 ) {

						if ( $i == 1 ) {
							$cities_per_portfolio = ( $total_cities * ( (int) ( lsp_get_option( 'lsp-percent' ) ) / $percentsCount ) );
						}
						if ( $i > 1 ) {
							$cities_per_portfolio = ( $total_cities * ( (int) ( lsp_get_option( 'lsp-percent' . $i ) ) / $percentsCount ) );
						}
					} else {
						$cities_per_portfolio = $total_cities;
					}

					$cities_per_portfolio = round( $cities_per_portfolio );
					if ( $i == 1 ) {
						$holder = 'http://www.bestlocalseotools.com/index3.php?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . lsp_get_option( 'lsp-api-key' ) . '&setType=' . urlencode( lsp_get_option( 'lsp-set-type' ) ) . '&city=' . urlencode( lsp_get_option( 'lsp-city' ) ) . '&state=' . urlencode( lsp_get_option( 'lsp-state' ) ) . '&request=cities' . '&radius=' . lsp_get_option( 'lsp-radius' ) . '&exclude=' . urlencode( lsp_get_option( 'lsp-exclude-cities' ) ) . '&count=' . $cities_per_portfolio . '&lplimit=' . urlencode( lsp_get_option( 'lsp-local-population-limit' ) ) . '&splimit=' . urlencode( lsp_get_option( 'lsp-state-population-limit' ) ) . '&nplimit=' . urlencode( lsp_get_option( 'lsp-national-population-limit' ) ) . '&iplimit=' . urlencode( lsp_get_option( 'lsp-international-population-limit' ) ) . '&lpmaxlimit=' . urlencode( lsp_get_option( 'lsp-local-max-limit' ) ) . '&spmaxlimit=' . urlencode( lsp_get_option( 'lsp-state-max-limit' ) ) . '&npmaxlimit=' . urlencode( lsp_get_option( 'lsp-national-max-limit' ) ) . '&ipmaxlimit=' . urlencode( lsp_get_option( 'lsp-international-max-limit' ) ) . '&addcities=' . urlencode( lsp_get_option( 'lsp-add-cities' ) ) . '&excludecities=' . urlencode( lsp_get_option( 'lsp-exclude-cities' ) ) . '&addstates=' . urlencode( lsp_get_option( 'lsp-add-states' ) ) . '&excludestates=' . urlencode( lsp_get_option( 'lsp-exclude-states' ) ) . '&addcountries=' . urlencode( lsp_get_option( 'lsp-add-countries' ) ) . '&localfocus=' . urlencode( lsp_get_option( 'lsp-local-focus' ) ) . '&statefocus=' . urlencode( lsp_get_option( 'lsp-state-focus' ) ) . '&countryfocus=' . urlencode( lsp_get_option( 'lsp-country-focus' ) ) . '&internationalfocus=' . urlencode( lsp_get_option( 'lsp-state-focus' ) ) . '&onlycities=' . urlencode( $onlyCities ) . '&onlystates=' . urlencode( $onlyStates ) . '&onlycountries=' . urlencode( $onlyCountries ) . '&projectsString=' . urlencode( $projectsString ) . '&huh=' . $ref;
					}
					if ( $i > 1 && $plus > 0 ) {
						$holder = 'http://www.bestlocalseotools.com/index3.php?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . lsp_get_option( 'lsp-api-key' ) . '&setType=' . urlencode( lsp_get_option( 'lsp-set-type' . $i ) ) . '&city=' . urlencode( lsp_get_option( 'lsp-city' . $i ) ) . '&state=' . urlencode( lsp_get_option( 'lsp-state' . $i ) ) . '&request=cities' . '&radius=' . lsp_get_option( 'lsp-radius' . $i ) . '&exclude=' . urlencode( lsp_get_option( 'lsp-exclude-cities' . $i ) ) . '&count=' . $cities_per_portfolio . '&lplimit=' . urlencode( lsp_get_option( 'lsp-local-population-limit' . $i ) ) . '&splimit=' . urlencode( lsp_get_option( 'lsp-state-population-limit' . $i ) ) . '&nplimit=' . urlencode( lsp_get_option( 'lsp-national-population-limit' . $i ) ) . '&iplimit=' . urlencode( lsp_get_option( 'lsp-international-population-limit' . $i ) ) . '&lpmaxlimit=' . urlencode( lsp_get_option( 'lsp-local-max-limit' . $i ) ) . '&spmaxlimit=' . urlencode( lsp_get_option( 'lsp-state-max-limit' . $i ) ) . '&npmaxlimit=' . urlencode( lsp_get_option( 'lsp-national-max-limit' . $i ) ) . '&ipmaxlimit=' . urlencode( lsp_get_option( 'lsp-international-max-limit' . $i ) ) . '&addcities=' . urlencode( lsp_get_option( 'lsp-add-cities' . $i ) ) . '&excludecities=' . urlencode( lsp_get_option( 'lsp-exclude-cities' . $i ) ) . '&addstates=' . urlencode( lsp_get_option( 'lsp-add-states' . $i ) ) . '&excludestates=' . urlencode( lsp_get_option( 'lsp-exclude-states' . $i ) ) . '&addcountries=' . urlencode( lsp_get_option( 'lsp-add-countries' . $i ) ) . '&localfocus=' . urlencode( lsp_get_option( 'lsp-local-focus' . $i ) ) . '&statefocus=' . urlencode( lsp_get_option( 'lsp-state-focus' . $i ) ) . '&countryfocus=' . urlencode( lsp_get_option( 'lsp-country-focus' . $i ) ) . '&internationalfocus=' . urlencode( lsp_get_option( 'lsp-state-focus' . $i ) ) . '&onlycities=' . urlencode( $onlyCities ) . '&onlystates=' . urlencode( $onlyStates ) . '&onlycountries=' . urlencode( $onlyCountries ) . '&projectsString=' . urlencode( $projectsString ) . '&huh=' . $ref;
					}

					$geo_string       = lsp_wp_httpget( $holder );
					$geo_array        = explode( '|', $geo_string );
					$geo_string_final = '';

					$len = count( $geo_array );
					$j   = 0;
					// $geo_array = array_unique($geo_array);
					// sort($geo_array);
					foreach ( $geo_array as $geo ) {
						$explodedgeo = explode( ',', $geo );
						if ( $geo == '' ) {
							break;
						}
						if ( $j != $len - 2 ) {
							$geo_string_final .= '<a href="' . home_url() . '/';
							$geo_string_final .= strtolower( trim( $explodedgeo[3] ) ) . '/';
							$geo_string_final .= str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . '</a>, ';
						} else {
							if ( $len == 2 ) {
								$geo_string_final .= ' <a href="' . home_url() . '/';
							} else {
								$geo_string_final .= __( ' and ', 'lsp_text_domain' ) . '<a href="' . home_url() . '/';
							}
							$geo_string_final .= strtolower( trim( $explodedgeo[3] ) ) . '/';
							$geo_string_final .= str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . '</a>. ';
						}
						$j++;
					}
					$lsp_content .= $geo_string_final;

				}
			}

			// echo "TEST" . $lsp_content;
			$lsp_content .= '</font></div>';
			update_option( 'lsp_cities', $geo_string );
			update_option( 'lsp_content', $lsp_content );
			return $lsp_content;
		}
	} else {
		return '';
	}
}



$my_theme = wp_get_theme();
if ( $my_theme->get( 'Name' ) == 'Twenty Fifteen' ) {
	add_action( 'fl_after_footer', 'lsp_print_content' );
	add_action( 'twentyfifteen_credits', 'lsp_print_content' );
	add_action( 'twentyfifteen_credits', 'lsp_signature' );
	add_action( 'twentyfifteen_credits', 'lsp_metas' );
} elseif ( $my_theme->get( 'Name' ) == 'Twenty Fourteen' ) {
	add_action( 'fl_after_footer', 'lsp_print_content' );
	add_action( 'twentyfourteen_credits', 'lsp_print_content' );
	add_action( 'twentyfourteen_credits', 'lsp_signature' );
	add_action( 'twentyfourteen_credits', 'lsp_metas' );
} elseif ( $my_theme->get( 'Name' ) == 'Twenty Sixteen' ) {
	add_action( 'fl_after_footer', 'lsp_print_content' );
	add_action( 'twentysixteen_credits', 'lsp_print_content' );
	add_action( 'twentysixteen_credits', 'lsp_signature' );
	add_action( 'twentysixteen_credits', 'lsp_metas' );
} elseif ( $my_theme->get( 'Name' ) == 'Twenty Seventeen' ) {
	add_action( 'fl_after_footer', 'lsp_print_content' );
	add_action( 'twentyseventeen_credits', 'lsp_print_content' );
	add_action( 'twentyseventeen_credits', 'lsp_signature' );
	add_action( 'twentyseventeen_credits', 'lsp_metas' );
} else {
	add_action( 'fl_after_footer', 'lsp_print_content' );
	add_action( 'wp_footer', 'lsp_print_content' );
	add_action( 'wp_footer', 'lsp_signature' );
	add_action( 'wp_footer', 'lsp_metas' );
}


function lsp_print_content() {
	$chosen = lsp_get_content();
	// Footer Links Better Support for Common Themes
	echo '<center>' . $chosen;
	echo '</center>';

}

// Credits Link
function lsp_signature() {
	global $post;
	if ( lsp_get_option( 'lsp-ptemplate-id' ) == $post->ID && lsp_get_option( 'lsp-sig' ) != 'no' ) {
		echo '<center>';
		_e( 'Developed with ', 'lsp_text_domain' );
		echo '<a href="http://www.bestlocalseotools.com" target="_blank">Best Local SEO Tools</a>';
		echo '</center>';
	}
}
add_action( 'wp_footer', 'lsp_print_content' );
add_action( 'wp_footer', 'lsp_signature' );
add_action( 'wp_footer', 'lsp_metas' );

// Print Store Schema, Log SEO visits to posts for the Blog / Ecommerce Boosters
function lsp_metas() {
	global $post;

	$visitsCount = lsp_get_post_meta( $post->ID, '_seo-visits-count', true );

	$tester = 0;
	if ( strstr( $_SERVER['HTTP_REFERER'], 'google.co' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'yahoo.co' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'bing.com' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'yandex.ru' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'altavista.com' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'fast' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'baidu.com' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'excite.com' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'baidu' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'duckduckgo' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'aol' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'naver' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'daum' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'dogpile' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'ask.com' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'rambler' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'search.com' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'haosou' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'shenma' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'easou' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'youdao' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'sougou' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'soso' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], '7search' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'seznam' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'biglobe' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'entireweb' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'lycos' ) ) {
		$tester = 1;
	}
	if ( strstr( $_SERVER['HTTP_REFERER'], 'ecosia' ) ) {
		$tester = 1;
	}

	if ( $tester ) {
		$visitsCount = 1 + $visitsCount;
	}

	if ( $tester ) {
		update_post_meta( $post->ID, '_seo-visits-count', $visitsCount );
	}

	parse_str( lsp_get_option( 'lsp-locationData1' ), $term1 );
	$nowUrl = ( isset( $_SERVER['HTTPS'] ) ? 'https' : 'http' ) . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	if ( ( $nowUrl == $term1['lsp-addressIDURL1'] ) || ( ( is_front_page() || is_home() ) && $term1['lsp-addressIDURL1'] == '' ) ) {
		lsp_printschema( $term1 );
	}
}

// Schema Helper
function lsp_printdays( $start, $stop ) {
	echo '"dayOfWeek":[';

	$dayHolder = '';
	if ( $start <= 1 && $stop >= 1 ) {
		$dayHolder .= '"Sunday",';
	}
	if ( $start <= 2 && $stop >= 2 ) {
		$dayHolder .= '"Monday",';
	}
	if ( $start <= 3 && $stop >= 3 ) {
		$dayHolder .= '"Tuesday",';
	}
	if ( $start <= 4 && $stop >= 4 ) {
		$dayHolder .= '"Wednesday",';
	}
	if ( $start <= 5 && $stop >= 5 ) {
		$dayHolder .= '"Thursday",';
	}
	if ( $start <= 6 && $stop >= 6 ) {
		$dayHolder .= '"Friday",';
	}
	if ( $start <= 7 && $stop >= 7 ) {
		$dayHolder .= '"Saturday",';
	}
	$dayHolder = rtrim( $dayHolder, ',' );
	echo $dayHolder . '],';
}

// Schema Printer, I saw no way to set the "type" attribute with https://developer.wordpress.org/reference/functions/wp_enqueue_script/ nor https://developer.wordpress.org/reference/functions/wp_add_inline_script/
function lsp_printschema( $termData ) {

	if ( $termData['lsp-addressIDURL1'] == '' && $termData['lsp-addressName1'] ) {
		$termData['lsp-addressIDURL1'] = site_url();
	}
	echo '


    <script type="application/ld+json">{
          "@context":"http://schema.org",
          "@type":"' . $termData['lsp-addressType1'] . '",
          "@id":"' . $termData['lsp-addressIDURL1'] . '",
          "name":"' . $termData['lsp-addressName1'] . '",';

	if ( $termData['lsp-addressBusinessImageURL1'] ) {
		echo '"image":"' . $termData['lsp-addressBusinessImageURL1'] . '",';
	} else {
		echo '"image":"' . site_url() . '/favicon.ico' . '",';
	}
	echo '"logo":"' . $termData['lsp-addressImageURL1'] . '",
          "address":{
            "@type": "PostalAddress",
            "streetAddress": "' . $termData['lsp-address1'] . '",
            "addressLocality":"' . $termData['lsp-addressLocality1'] . '",
            "addressRegion":"' . $termData['addressRegion1'] . '",
            "postalCode":"' . $termData['lsp-postalCode1'] . '",
            "addressCountry":"' . $termData['lsp-addressCountry1'] . '"
          },
          "telephone":"' . $termData['lsp-addressTelephone1'] . '",
          "description":"' . $termData['lsp-addressDescription1'] . '",
          ';

	echo '"openingHoursSpecification":[';

	echo '

          ]
';

	echo '
          }';
	echo '}

    }</script>';

}





// Modified url to post_id code
function lsp_url_to_postid( $url ) {
	if ( is_int( $url ) ) {
		return $url;
	}

	$newurl = str_replace( get_site_url(), '', $url );

	$newurl = ltrim( $newurl, '/' );
	$newurl = rtrim( $newurl, '/' );

	$postnew = get_page_by_path( $newurl );
	if ( $postnew->ID == '' ) {
		$explodedpath = explode( '/', $newurl );
		$postnew      = get_page_by_path( $explodedpath[1], OBJECT, $explodedpath[0] );
		if ( $postnew->ID ) {
			return $postnew->ID;
		}
	}
	if ( $postnew->ID == '' ) {
		$postnew = get_page_by_path( $newurl, OBJECT, 'post' );
		if ( $postnew->ID ) {
			return $postnew->ID;
		}
	}

	if ( $postnew->ID == '' ) {
		$postnew = url_to_postid( $newurl );
		if ( $postnew ) {
			return $postnew;
		}
	}
	return $postnew->ID;
}



add_action( 'admin_menu', 'lsp_menu' );
function lsp_menu() {
	add_options_page( __( 'Best Local SEO Tools Options', 'lsp_text_domain' ), __( 'Best Local SEO Tools', 'lsp_text_domain' ), 'manage_options', 'localseoportfolio', 'lsp_options' );

}


// Plugin Settings Code
function lsp_options() {
	// nonce check
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
		check_admin_referer( 'lsp-check', 'lsp-nonce' );
	}

	if ( ! ( current_user_can( 'administrator' ) ) ) {
		die( __( 'You do not have administrator privileges for this.', 'lsp_text_domain' ) );
	}

	// consent requirement enforcement
	if ( $_POST['lsp-agree'] == 'no' ) {
		die( __( 'Acceptance of data-sending back and forth is required to use Best Local SEO Tools.', 'lsp_text_domain' ) );
	}

	// this defaults to not show via the activation hook
	if ( $_POST['lsp-agree'] == 'yes' ) {
		update_option( 'lsp-sig', 'yes' );
	}

	if ( $_POST['lsp-agree'] == 'yes' || $_POST['lsp-agree'] == 'yes2' ) {
		update_option( 'lsp-agree', $_POST['lsp-agree'] );
	}

	if ( $_GET['lsp-agree-reset'] ) {
		update_option( 'lsp-agree', 'no' );
	}

	if ( $_GET['lsp-alt-filter-all'] ) {
		update_option( 'lsp-alt-filter-all', $_GET['lsp-alt-filter-all'] );
	}

	// more ata sending consent enforcement to use the plugin
	if ( lsp_get_option( 'lsp-agree' ) != 'yes' && lsp_get_option( 'lsp-agree' ) != 'yes2' && ( ( sanitize_text_field( $_GET['page'] ) == '' && sanitize_text_field( $_GET['post_type'] ) == 'localproject' ) || ( sanitize_text_field( $_GET['reports'] ) == 'true' && sanitize_text_field( $_GET['post_type'] ) == 'localproject' ) ) ) {
		die( __( 'Acceptance of data-sending back and forth is required to use Best Local SEO Tools.', 'lsp_text_domain' ) );
	}

	if ( $_POST['lsp-services'] && $_POST['lsp-largest-city'] && $_POST['lsp-largest-city'] != $_POST['lsp-api-city'] ) {
		update_option( 'lsp-biggest-city', sanitize_text_field( $_POST['lsp-largest-city'] ) . __( ' and ', 'lsp_text_domain' ) );
	}

	global $wpdb;

	global $citiesAlsoHolder;
	$citiesAlsoHolder = '';

	global $citiesAlsoHolder2;
	$citiesAlsoHolder2 = '';

	// initialization of variables
	$lsp_success           = lsp_get_option( 'lsp-success' );
	$lsp_focus_percent     = lsp_get_option( 'lsp-focus-percent' );
	$lsp_conversion_url    = lsp_get_option( 'lsp-conversion-url' );
	$lsp_conversion_value  = lsp_get_option( 'lsp-conversion-value' );
	$lsp_conversion_url2   = lsp_get_option( 'lsp-conversion-url2' );
	$lsp_conversion_value2 = lsp_get_option( 'lsp-conversion-value2' );
	$lsp_conversion_url3   = lsp_get_option( 'lsp-conversion-url3' );
	$lsp_conversion_value3 = lsp_get_option( 'lsp-conversion-value3' );
	$lsp_cpm               = lsp_get_option( 'lsp-cpm' );
	$lsp_split1            = lsp_get_option( 'lsp-split1' );
	$lsp_split2            = lsp_get_option( 'lsp-split2' );
	$lsp_split3            = lsp_get_option( 'lsp-split3' );
	$lsp_split4            = lsp_get_option( 'lsp-split4' );

	$lsp_reviews_loc   = lsp_get_option( 'lsp-reviews-loc' );
	$lsp_reviews_loc2  = lsp_get_option( 'lsp-reviews-loc2' );
	$lsp_reviews_loc3  = lsp_get_option( 'lsp-reviews-loc3' );
	$lsp_reviews_loc4  = lsp_get_option( 'lsp-reviews-loc4' );
	$lsp_reviews_loc5  = lsp_get_option( 'lsp-reviews-loc5' );
	$lsp_reviews_loc6  = lsp_get_option( 'lsp-reviews-loc6' );
	$lsp_reviews_loc7  = lsp_get_option( 'lsp-reviews-loc7' );
	$lsp_reviews_loc8  = lsp_get_option( 'lsp-reviews-loc8' );
	$lsp_reviews_loc9  = lsp_get_option( 'lsp-reviews-loc9' );
	$lsp_reviews_loc10 = lsp_get_option( 'lsp-reviews-loc10' );
	$lsp_reviews_loc11 = lsp_get_option( 'lsp-reviews-loc11' );
	$lsp_reviews_loc12 = lsp_get_option( 'lsp-reviews-loc12' );
	$lsp_reviews_loc13 = lsp_get_option( 'lsp-reviews-loc13' );
	$lsp_reviews_loc14 = lsp_get_option( 'lsp-reviews-loc14' );
	$lsp_reviews_loc15 = lsp_get_option( 'lsp-reviews-loc15' );
	$lsp_reviews_loc16 = lsp_get_option( 'lsp-reviews-loc16' );
	$lsp_reviews_loc17 = lsp_get_option( 'lsp-reviews-loc17' );
	$lsp_reviews_loc18 = lsp_get_option( 'lsp-reviews-loc18' );
	$lsp_reviews_loc19 = lsp_get_option( 'lsp-reviews-loc19' );
	$lsp_reviews_loc20 = lsp_get_option( 'lsp-reviews-loc20' );
	$lsp_reviews_loc21 = lsp_get_option( 'lsp-reviews-loc21' );
	$lsp_reviews_loc22 = lsp_get_option( 'lsp-reviews-loc22' );
	$lsp_reviews_loc23 = lsp_get_option( 'lsp-reviews-loc23' );
	$lsp_reviews_loc24 = lsp_get_option( 'lsp-reviews-loc24' );
	$lsp_reviews_loc25 = lsp_get_option( 'lsp-reviews-loc25' );
	$lsp_reviews_loc26 = lsp_get_option( 'lsp-reviews-loc26' );
	$lsp_reviews_loc27 = lsp_get_option( 'lsp-reviews-loc27' );
	$lsp_reviews_loc28 = lsp_get_option( 'lsp-reviews-loc28' );
	$lsp_reviews_loc29 = lsp_get_option( 'lsp-reviews-loc29' );
	$lsp_reviews_loc30 = lsp_get_option( 'lsp-reviews-loc30' );

	$lsp_reviews_name11 = lsp_get_option( 'lsp-reviews-name11' );
	$lsp_reviews_name12 = lsp_get_option( 'lsp-reviews-name12' );
	$lsp_reviews_name13 = lsp_get_option( 'lsp-reviews-name13' );
	$lsp_reviews_name14 = lsp_get_option( 'lsp-reviews-name14' );
	$lsp_reviews_name15 = lsp_get_option( 'lsp-reviews-name15' );
	$lsp_reviews_name16 = lsp_get_option( 'lsp-reviews-name16' );
	$lsp_reviews_name17 = lsp_get_option( 'lsp-reviews-name17' );
	$lsp_reviews_name18 = lsp_get_option( 'lsp-reviews-name18' );
	$lsp_reviews_name19 = lsp_get_option( 'lsp-reviews-name19' );
	$lsp_reviews_name20 = lsp_get_option( 'lsp-reviews-name20' );
	$lsp_reviews_name21 = lsp_get_option( 'lsp-reviews-name21' );
	$lsp_reviews_name22 = lsp_get_option( 'lsp-reviews-name22' );
	$lsp_reviews_name23 = lsp_get_option( 'lsp-reviews-name23' );
	$lsp_reviews_name24 = lsp_get_option( 'lsp-reviews-name24' );
	$lsp_reviews_name25 = lsp_get_option( 'lsp-reviews-name25' );
	$lsp_reviews_name26 = lsp_get_option( 'lsp-reviews-name26' );
	$lsp_reviews_name27 = lsp_get_option( 'lsp-reviews-name27' );
	$lsp_reviews_name28 = lsp_get_option( 'lsp-reviews-name28' );
	$lsp_reviews_name29 = lsp_get_option( 'lsp-reviews-name29' );
	$lsp_reviews_name30 = lsp_get_option( 'lsp-reviews-name30' );

	$lsp_reviews_url11 = esc_url( lsp_get_option( 'lsp-reviews-url11' ) );
	$lsp_reviews_url12 = esc_url( lsp_get_option( 'lsp-reviews-url12' ) );
	$lsp_reviews_url13 = esc_url( lsp_get_option( 'lsp-reviews-url13' ) );
	$lsp_reviews_url14 = esc_url( lsp_get_option( 'lsp-reviews-url14' ) );
	$lsp_reviews_url15 = esc_url( lsp_get_option( 'lsp-reviews-url15' ) );
	$lsp_reviews_url16 = esc_url( lsp_get_option( 'lsp-reviews-url16' ) );
	$lsp_reviews_url17 = esc_url( lsp_get_option( 'lsp-reviews-url17' ) );
	$lsp_reviews_url18 = esc_url( lsp_get_option( 'lsp-reviews-url18' ) );
	$lsp_reviews_url19 = esc_url( lsp_get_option( 'lsp-reviews-url19' ) );
	$lsp_reviews_url20 = esc_url( lsp_get_option( 'lsp-reviews-url20' ) );
	$lsp_reviews_url21 = esc_url( lsp_get_option( 'lsp-reviews-url21' ) );
	$lsp_reviews_url22 = esc_url( lsp_get_option( 'lsp-reviews-url22' ) );
	$lsp_reviews_url23 = esc_url( lsp_get_option( 'lsp-reviews-url23' ) );
	$lsp_reviews_url24 = esc_url( lsp_get_option( 'lsp-reviews-url24' ) );
	$lsp_reviews_url25 = esc_url( lsp_get_option( 'lsp-reviews-url25' ) );
	$lsp_reviews_url26 = esc_url( lsp_get_option( 'lsp-reviews-url26' ) );
	$lsp_reviews_url27 = esc_url( lsp_get_option( 'lsp-reviews-url27' ) );
	$lsp_reviews_url28 = esc_url( lsp_get_option( 'lsp-reviews-url28' ) );
	$lsp_reviews_url29 = esc_url( lsp_get_option( 'lsp-reviews-url29' ) );
	$lsp_reviews_url30 = esc_url( lsp_get_option( 'lsp-reviews-url30' ) );

	$lsp_captcha_question = lsp_get_option( 'lsp-captcha-question' );
	$lsp_captcha_answer   = lsp_get_option( 'lsp-captcha-answer' );

	$lsp_employeeslist = lsp_get_option( 'lsp-employeeslist' );

	$lsp_requests_slug = lsp_get_option( 'lsp-requests-slug' );
	$lsp_archive_types = lsp_get_option( 'lsp-archive-types' );

	$lsp_email_title   = lsp_get_option( 'lsp-email-title' );
	$lsp_email_message = lsp_get_option( 'lsp-email-message' );

	$lsp_storelocations = lsp_get_option( 'lsp-storelocations' );

	$lsp_turbomode = lsp_get_option( 'lsp-turbomode' );

	$lsp_schema = lsp_get_option( 'lsp-schema' );

	$lsp_optimize_authors0 = lsp_get_option( 'lsp-optimize-authors0' );
	$lsp_optimize_taxes0   = lsp_get_option( 'lsp-optimize-taxes0' );

	$lsp_media_redirect = lsp_get_option( 'lsp-media-redirect' );

	$lsp_auto_adjust = lsp_get_option( 'lsp-auto-adjust' );

	$lsp_api_intro_text                  = get_option( 'lsp-api-intro-text' );
	$lsp_hide_intro_text                 = lsp_get_option( 'lsp-hide-intro-text' );
	$lsp_api_post_blog                   = lsp_get_option( 'lsp-api-post-blog' );
	$lsp_api_hide_attribution            = lsp_get_option( 'lsp-api-hide-attribution' );
	$lsp_api_contact_form                = lsp_get_option( 'lsp-api-contact-form' );
	$lsp_api_email_addresses             = lsp_get_option( 'lsp-api-email-addresses' );
	$lsp_api_form_header                 = lsp_get_option( 'lsp-api-form-header' );
	$lsp_set_type0                       = lsp_get_option( 'lsp-set-type0' );
	$lsp_exclude_cities0                 = lsp_get_option( 'lsp-exclude-cities0' );
	$lsp_exclude_states0                 = lsp_get_option( 'lsp-exclude-states0' );
	$lsp_exclude_countries0              = lsp_get_option( 'lsp-exclude-countries0' );
	$lsp_add_countries0                  = lsp_get_option( 'lsp-add-countries0' );
	$lsp_hide_headlines0                 = lsp_get_option( 'lsp-hide-headlines0' );
	$lsp_local_focus0                    = (int) ( lsp_get_option( 'lsp-local-focus0' ) );
	$lsp_country_focus0                  = (int) ( lsp_get_option( 'lsp-country-focus0' ) );
	$lsp_state_focus0                    = (int) ( lsp_get_option( 'lsp-state-focus0' ) );
	$lsp_local_population_limit0         = (int) ( lsp_get_option( 'lsp-local-population-limit0' ) );
	$lsp_national_population_limit0      = (int) ( lsp_get_option( 'lsp-national-population-limit0' ) );
	$lsp_international_population_limit0 = (int) ( lsp_get_option( 'lsp-international-population-limit0' ) );
	$lsp_local_max_limit0                = (int) ( lsp_get_option( 'lsp-local-max-limit0' ) );
	$lsp_national_max_limit0             = (int) ( lsp_get_option( 'lsp-national-max-limit0' ) );
	$lsp_international_max_limit0        = (int) ( lsp_get_option( 'lsp-international-max-limit0' ) );
	$lsp_how_far0                        = (int) ( lsp_get_option( 'lsp-how-far0' ) );

	$lsp_ignore_types = lsp_get_option( 'lsp-ignore-types' );
	$lsp_publish_now0 = lsp_get_option( 'lsp-publish-now0' );
	$lsp_sig          = lsp_get_option( 'lsp-sig' );

	$lsp_kiosk_ip = lsp_get_option( 'lsp-kiosk-ip' );

	$lsp_biztype = lsp_get_option( 'lsp-biztype' );
	// 1-10
	$lsp_services   = lsp_get_option( 'lsp-services' );
	$lsp_services2  = lsp_get_option( 'lsp-services2' );
	$lsp_services3  = lsp_get_option( 'lsp-services3' );
	$lsp_services4  = lsp_get_option( 'lsp-services4' );
	$lsp_services5  = lsp_get_option( 'lsp-services5' );
	$lsp_services6  = lsp_get_option( 'lsp-services6' );
	$lsp_services7  = lsp_get_option( 'lsp-services7' );
	$lsp_services8  = lsp_get_option( 'lsp-services8' );
	$lsp_services9  = lsp_get_option( 'lsp-services9' );
	$lsp_services10 = lsp_get_option( 'lsp-services10' );
	// 1-10
	$lsp_percent   = (int) ( lsp_get_option( 'lsp-percent' ) );
	$lsp_percent2  = (int) ( lsp_get_option( 'lsp-percent2' ) );
	$lsp_percent3  = (int) ( lsp_get_option( 'lsp-percent3' ) );
	$lsp_percent4  = (int) ( lsp_get_option( 'lsp-percent4' ) );
	$lsp_percent5  = (int) ( lsp_get_option( 'lsp-percent5' ) );
	$lsp_percent6  = (int) ( lsp_get_option( 'lsp-percent6' ) );
	$lsp_percent7  = (int) ( lsp_get_option( 'lsp-percent7' ) );
	$lsp_percent8  = (int) ( lsp_get_option( 'lsp-percent8' ) );
	$lsp_percent9  = (int) ( lsp_get_option( 'lsp-percent9' ) );
	$lsp_percent10 = (int) ( lsp_get_option( 'lsp-percent10' ) );

	// 1-10
	$lsp_productservice   = lsp_get_option( 'lsp-productservice' );
	$lsp_productservice2  = lsp_get_option( 'lsp-productservice2' );
	$lsp_productservice3  = lsp_get_option( 'lsp-productservice3' );
	$lsp_productservice4  = lsp_get_option( 'lsp-productservice4' );
	$lsp_productservice5  = lsp_get_option( 'lsp-productservice5' );
	$lsp_productservice6  = lsp_get_option( 'lsp-productservice6' );
	$lsp_productservice7  = lsp_get_option( 'lsp-productservice7' );
	$lsp_productservice8  = lsp_get_option( 'lsp-productservice8' );
	$lsp_productservice9  = lsp_get_option( 'lsp-productservice9' );
	$lsp_productservice10 = lsp_get_option( 'lsp-productservice10' );

	$lsp_api_city                  = lsp_get_option( 'lsp-api-city' );
	$lsp_api_state                 = lsp_get_option( 'lsp-api-state' );
	$lsp_api_radius                = (int) ( lsp_get_option( 'lsp-api-radius' ) );
	$lsp_star_minimum              = (int) ( lsp_get_option( 'lsp-star-minimum' ) );
	$lsp_testimonials_auto_publish = lsp_get_option( 'lsp-testimonials-auto-publish' );
	// 1-10
	$lsp_reviews_name   = lsp_get_option( 'lsp-reviews-name' );
	$lsp_reviews_name2  = lsp_get_option( 'lsp-reviews-name2' );
	$lsp_reviews_name3  = lsp_get_option( 'lsp-reviews-name3' );
	$lsp_reviews_name4  = lsp_get_option( 'lsp-reviews-name4' );
	$lsp_reviews_name5  = lsp_get_option( 'lsp-reviews-name5' );
	$lsp_reviews_name6  = lsp_get_option( 'lsp-reviews-name6' );
	$lsp_reviews_name7  = lsp_get_option( 'lsp-reviews-name7' );
	$lsp_reviews_name8  = lsp_get_option( 'lsp-reviews-name8' );
	$lsp_reviews_name9  = lsp_get_option( 'lsp-reviews-name9' );
	$lsp_reviews_name10 = lsp_get_option( 'lsp-reviews-name10' );
	// 1-10
	$lsp_reviews_url     = esc_url( lsp_get_option( 'lsp-reviews-url' ) );
	$lsp_reviews_url2    = esc_url( lsp_get_option( 'lsp-reviews-url2' ) );
	$lsp_reviews_url3    = esc_url( lsp_get_option( 'lsp-reviews-url3' ) );
	$lsp_reviews_url4    = esc_url( lsp_get_option( 'lsp-reviews-url4' ) );
	$lsp_reviews_url5    = esc_url( lsp_get_option( 'lsp-reviews-url5' ) );
	$lsp_reviews_url6    = esc_url( lsp_get_option( 'lsp-reviews-url6' ) );
	$lsp_reviews_url7    = esc_url( lsp_get_option( 'lsp-reviews-url7' ) );
	$lsp_reviews_url8    = esc_url( lsp_get_option( 'lsp-reviews-url8' ) );
	$lsp_reviews_url9    = esc_url( lsp_get_option( 'lsp-reviews-url9' ) );
	$lsp_reviews_url10   = esc_url( lsp_get_option( 'lsp-reviews-url10' ) );
	$lsp_set_type0       = lsp_get_option( 'lsp-set-type0' );
	$lsp_exclude_cities0 = lsp_get_option( 'lsp-exclude-cities0' );
	$lsp_add_cities0     = lsp_get_option( 'lsp-add-cities0' );
	$lsp_abbreviations0  = lsp_get_option( 'lsp-abbreviations0' );
	$lsp_exclude_states0 = lsp_get_option( 'lsp-exclude-states0' );
	$lsp_add_states0     = lsp_get_option( 'lsp-add-states0' );

	$lsp_exclude_countries0 = lsp_get_option( 'lsp-exclude-countries0' );
	$lsp_add_countries0     = lsp_get_option( 'lsp-add-countries0' );
	// 1-10
	if ( lsp_get_option( 'lsp-form-header' ) == '' ) {
		update_option( 'lsp-form-header', __( 'Get a Quote!', 'lsp_text_domain' ) );
	}

	$lsp_ptemplate_id = (int) ( lsp_get_option( 'lsp-ptemplate-id' ) );

	$lsp_homepage_text = lsp_get_option( 'lsp-homepage-text' );

	$lsp_api_key = lsp_get_option( 'lsp-api-key' );

	$lsp_autoadjust = lsp_get_option( 'lsp-autoadjust' );

	$lsp_post_blog = lsp_get_option( 'lsp-post-blog' );

	$lsp_worked_location = lsp_get_option( 'lsp-worked-location' );

	$lsp_add_classes        = lsp_get_option( 'lsp-add-classes' );
	$lsp_footer_intro       = lsp_get_option( 'lsp-footer-intro' );
	$lsp_linking_sentence   = lsp_get_option( 'lsp-linking-sentence' );
	$lsp_served_sentence    = lsp_get_option( 'lsp-served-sentence' );
	$lsp_served_sentence2   = lsp_get_option( 'lsp-served-sentence2' );
	$lsp_portfolio_format   = lsp_get_option( 'lsp-portfolio-format' );
	$lsp_optimize_portfolio = lsp_get_option( 'lsp-optimize-portfolio' );

	$lsp_footer_links = lsp_get_option( 'lsp-footer-links' );

	$lsp_enable_categories = lsp_get_option( 'lsp-enable-categories' );
	$lsp_preview_urls      = lsp_get_option( 'lsp-preview-urls' );

	$lsp_use_widget   = lsp_get_option( 'lsp-use-widget' );
	$lsp_text_color   = (int) ( lsp_get_option( 'lsp-text-color' ) );
	$lsp_link_color   = (int) ( lsp_get_option( 'lsp-link-color' ) );
	$lsp_header_color = (int) ( lsp_get_option( 'lsp-header-color' ) );

	$lsp_homepage_footer_links_background_color = lsp_get_option( 'lsp-homepage-footer-links-background-color' );
	$lsp_hide_attribution                       = lsp_get_option( 'lsp-hide-attribution' );
	$lsp_cities_all_pages                       = lsp_get_option( 'lsp-cities-all-pages' );
	$lsp_show_all_projects                      = lsp_get_option( 'lsp-show-all-projects' );

	$lsp_max_cities              = (int) ( lsp_get_option( 'lsp-max-cities' ) );
	$lsp_how_far                 = (int) ( lsp_get_option( 'lsp-how-far' ) );
	$lsp_hide_headlines          = lsp_get_option( 'lsp-hide-headlines' );
	$lsp_intro_text              = lsp_get_option( 'lsp-intro-text' );
	$lsp_city                    = lsp_get_option( 'lsp-city' );
	$lsp_state                   = lsp_get_option( 'lsp-state' );
	$lsp_keyphrase               = lsp_get_option( 'lsp-keyphrase' );
	$lsp_keyphrase_override      = lsp_get_option( 'lsp-keyphrase-override' );
	$lsp_radius                  = (int) ( lsp_get_option( 'lsp-radius' ) );
	$lsp_only_match_cities       = lsp_get_option( 'lsp-only-match-cities' );
	$lsp_publish_now             = lsp_get_option( 'lsp-publish-now' );
	$lsp_smart_settings          = lsp_get_option( 'lsp-smart-settings' );
	$lsp_local_focus             = lsp_get_option( 'lsp-local-focus' );
	$lsp_state_focus             = lsp_get_option( 'lsp-state-focus' );
	$lsp_country_focus           = lsp_get_option( 'lsp-country-focus' );
	$lsp_local_max_limit         = lsp_get_option( 'lsp-local-max-limit' );
	$lsp_national_max_limit      = lsp_get_option( 'lsp-national-max-limit' );
	$lsp_international_max_limit = lsp_get_option( 'lsp-international-max-limit' );
	$lsp_contact_form            = lsp_get_option( 'lsp-contact-form' );
	$lsp_email_addresses         = sanitize_email( lsp_get_option( 'lsp-email-addresses' ) );
	$lsp_form_header             = lsp_get_option( 'lsp-form-header' );
	$lsp_footer_classes          = lsp_get_option( 'lsp-footer-classes' );
	$lsp_smaller_cities_text     = lsp_get_option( 'lsp-smaller-cities-text' );
	$lsp_api_smaller_cities      = lsp_get_option( 'lsp-api-smaller-cities' );
	$lsp_smaller_cities          = lsp_get_option( 'lsp-smaller-cities' );
		$lsp_set_type            = lsp_get_option( 'lsp-set-type' );
		$lsp_exclude_cities      = lsp_get_option( 'lsp-exclude-cities' );
		$lsp_add_cities          = lsp_get_option( 'lsp-add-cities' );
	// -- use abbreviations or not?
	$lsp_abbreviations      = lsp_get_option( 'lsp-abbreviations' );
		$lsp_exclude_states = lsp_get_option( 'lsp-exclude-states' );
		$lsp_add_states     = lsp_get_option( 'lsp-add-states' );
	// -- use abbreviations or not?
	$lsp_local_population_limit             = (int) ( lsp_get_option( 'lsp-local-population-limit' ) );
		$lsp_national_population_limit      = (int) ( lsp_get_option( 'lsp-national-population-limit' ) );
		$lsp_international_population_limit = (int) ( lsp_get_option( 'lsp-international-population-limit' ) );
		$lsp_exclude_countries              = lsp_get_option( 'lsp-exclude-countries' );
		$lsp_add_countries                  = lsp_get_option( 'lsp-add-countries' );
	// show nearest or same-city stuff (nearest)
	$lsp_largest_city = lsp_get_option( 'lsp-largest-city' );

	$lsp_makeportfolio = lsp_get_option( 'lsp-makeportfolio' );

	$lsp_localportfolio_links   = lsp_get_option( 'lsp-localportfolio-links' );
	$lsp_blog_booster           = lsp_get_option( 'lsp-blog-booster' );
	$lsp_attach                 = lsp_get_option( 'lsp-attach' );
	$lsp_boosterarchive         = lsp_get_option( 'lsp-boosterarchive' );
	$lsp_widgetlink             = lsp_get_option( 'lsp-widgetlink' );
	$lsp_attachproducts         = lsp_get_option( 'lsp-attachproducts' );
	$lsp_boosterarchiveproducts = lsp_get_option( 'lsp-boosterarchiveproducts' );
	$lsp_widgetlinkproducts     = lsp_get_option( 'lsp-widgetlinkproducts' );
	$lsp_locationData1          = lsp_get_option( 'lsp-locationData1' );

	flush_rewrite_rules();
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
	// Save settings if that form is submitted
	if ( isset( $_POST['lsp-post-blog'] ) ) {

		wp_insert_term( $_POST['lsp-services'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services2'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services3'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services4'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services5'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services6'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services7'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services8'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services9'], 'servicesportfolio' );
		wp_insert_term( $_POST['lsp-services10'], 'servicesportfolio' );

		$lsp_success           = sanitize_text_field( $_POST['lsp-success'] );
		$lsp_focus_percent     = sanitize_text_field( $_POST['lsp-focus-percent'] );
		$lsp_conversion_url    = sanitize_text_field( $_POST['lsp-conversion-url'] );
		$lsp_conversion_value  = sanitize_text_field( $_POST['lsp-conversion-value'] );
		$lsp_conversion_url2   = sanitize_text_field( $_POST['lsp-conversion-url2'] );
		$lsp_conversion_value2 = sanitize_text_field( $_POST['lsp-conversion-value2'] );
		$lsp_conversion_url3   = sanitize_text_field( $_POST['lsp-conversion-url3'] );
		$lsp_conversion_value3 = sanitize_text_field( $_POST['lsp-conversion-value3'] );
		$lsp_cpm               = sanitize_text_field( $_POST['lsp-cpm'] );
		$lsp_split1            = sanitize_text_field( $_POST['lsp-split1'] );
		$lsp_split2            = sanitize_text_field( $_POST['lsp-split2'] );
		$lsp_split3            = sanitize_text_field( $_POST['lsp-split3'] );
		$lsp_split4            = sanitize_text_field( $_POST['lsp-split4'] );

		$lsp_media_redirect = sanitize_text_field( $_POST['lsp-media-redirect'] );

		$lsp_email_title   = sanitize_text_field( $_POST['lsp-email-title'] );
		$lsp_email_message = sanitize_text_field( $_POST['lsp-email-message'] );

		$lsp_requests_slug = sanitize_text_field( $_POST['lsp-requests-slug'] );
		$lsp_turbomode     = sanitize_text_field( $_POST['lsp-turbomode'] );

		$lsp_archive_types = sanitize_text_field( $_POST['lsp-archive-types'] );

		$lsp_storelocations = sanitize_text_field( $_POST['lsp-storelocations'] );
		$lsp_largest_city   = sanitize_text_field( $_POST['lsp-largest-city'] );

		$lsp_reviews_loc   = sanitize_text_field( $_POST['lsp-reviews-loc'] );
		$lsp_reviews_loc2  = sanitize_text_field( $_POST['lsp-reviews-loc2'] );
		$lsp_reviews_loc3  = sanitize_text_field( $_POST['lsp-reviews-loc3'] );
		$lsp_reviews_loc4  = sanitize_text_field( $_POST['lsp-reviews-loc4'] );
		$lsp_reviews_loc5  = sanitize_text_field( $_POST['lsp-reviews-loc5'] );
		$lsp_reviews_loc6  = sanitize_text_field( $_POST['lsp-reviews-loc6'] );
		$lsp_reviews_loc7  = sanitize_text_field( $_POST['lsp-reviews-loc7'] );
		$lsp_reviews_loc8  = sanitize_text_field( $_POST['lsp-reviews-loc8'] );
		$lsp_reviews_loc9  = sanitize_text_field( $_POST['lsp-reviews-loc9'] );
		$lsp_reviews_loc10 = sanitize_text_field( $_POST['lsp-reviews-loc10'] );
		$lsp_reviews_loc11 = sanitize_text_field( $_POST['lsp-reviews-loc11'] );
		$lsp_reviews_loc12 = sanitize_text_field( $_POST['lsp-reviews-loc12'] );
		$lsp_reviews_loc13 = sanitize_text_field( $_POST['lsp-reviews-loc13'] );
		$lsp_reviews_loc14 = sanitize_text_field( $_POST['lsp-reviews-loc14'] );
		$lsp_reviews_loc15 = sanitize_text_field( $_POST['lsp-reviews-loc15'] );
		$lsp_reviews_loc16 = sanitize_text_field( $_POST['lsp-reviews-loc16'] );
		$lsp_reviews_loc17 = sanitize_text_field( $_POST['lsp-reviews-loc17'] );
		$lsp_reviews_loc18 = sanitize_text_field( $_POST['lsp-reviews-loc18'] );
		$lsp_reviews_loc19 = sanitize_text_field( $_POST['lsp-reviews-loc19'] );
		$lsp_reviews_loc20 = sanitize_text_field( $_POST['lsp-reviews-loc20'] );
		$lsp_reviews_loc21 = sanitize_text_field( $_POST['lsp-reviews-loc21'] );
		$lsp_reviews_loc22 = sanitize_text_field( $_POST['lsp-reviews-loc22'] );
		$lsp_reviews_loc23 = sanitize_text_field( $_POST['lsp-reviews-loc23'] );
		$lsp_reviews_loc24 = sanitize_text_field( $_POST['lsp-reviews-loc24'] );
		$lsp_reviews_loc25 = sanitize_text_field( $_POST['lsp-reviews-loc25'] );
		$lsp_reviews_loc26 = sanitize_text_field( $_POST['lsp-reviews-loc26'] );
		$lsp_reviews_loc27 = sanitize_text_field( $_POST['lsp-reviews-loc27'] );
		$lsp_reviews_loc28 = sanitize_text_field( $_POST['lsp-reviews-loc28'] );
		$lsp_reviews_loc29 = sanitize_text_field( $_POST['lsp-reviews-loc29'] );
		$lsp_reviews_loc30 = sanitize_text_field( $_POST['lsp-reviews-loc30'] );

		$lsp_reviews_name11 = sanitize_text_field( $_POST['lsp-reviews-name11'] );
		$lsp_reviews_name12 = sanitize_text_field( $_POST['lsp-reviews-name12'] );
		$lsp_reviews_name13 = sanitize_text_field( $_POST['lsp-reviews-name13'] );
		$lsp_reviews_name14 = sanitize_text_field( $_POST['lsp-reviews-name14'] );
		$lsp_reviews_name15 = sanitize_text_field( $_POST['lsp-reviews-name15'] );
		$lsp_reviews_name16 = sanitize_text_field( $_POST['lsp-reviews-name16'] );
		$lsp_reviews_name17 = sanitize_text_field( $_POST['lsp-reviews-name17'] );
		$lsp_reviews_name18 = sanitize_text_field( $_POST['lsp-reviews-name18'] );
		$lsp_reviews_name19 = sanitize_text_field( $_POST['lsp-reviews-name19'] );
		$lsp_reviews_name20 = sanitize_text_field( $_POST['lsp-reviews-name20'] );
		$lsp_reviews_name21 = sanitize_text_field( $_POST['lsp-reviews-name21'] );
		$lsp_reviews_name22 = sanitize_text_field( $_POST['lsp-reviews-name22'] );
		$lsp_reviews_name23 = sanitize_text_field( $_POST['lsp-reviews-name23'] );
		$lsp_reviews_name24 = sanitize_text_field( $_POST['lsp-reviews-name24'] );
		$lsp_reviews_name25 = sanitize_text_field( $_POST['lsp-reviews-name25'] );
		$lsp_reviews_name26 = sanitize_text_field( $_POST['lsp-reviews-name26'] );
		$lsp_reviews_name27 = sanitize_text_field( $_POST['lsp-reviews-name27'] );
		$lsp_reviews_name28 = sanitize_text_field( $_POST['lsp-reviews-name28'] );
		$lsp_reviews_name29 = sanitize_text_field( $_POST['lsp-reviews-name29'] );
		$lsp_reviews_name30 = sanitize_text_field( $_POST['lsp-reviews-name30'] );

		$lsp_reviews_url11 = sanitize_text_field( $_POST['lsp-reviews-url11'] );
		$lsp_reviews_url12 = sanitize_text_field( $_POST['lsp-reviews-url12'] );
		$lsp_reviews_url13 = sanitize_text_field( $_POST['lsp-reviews-url13'] );
		$lsp_reviews_url14 = sanitize_text_field( $_POST['lsp-reviews-url14'] );
		$lsp_reviews_url15 = sanitize_text_field( $_POST['lsp-reviews-url15'] );
		$lsp_reviews_url16 = sanitize_text_field( $_POST['lsp-reviews-url16'] );
		$lsp_reviews_url17 = sanitize_text_field( $_POST['lsp-reviews-url17'] );
		$lsp_reviews_url18 = sanitize_text_field( $_POST['lsp-reviews-url18'] );
		$lsp_reviews_url19 = sanitize_text_field( $_POST['lsp-reviews-url19'] );
		$lsp_reviews_url20 = sanitize_text_field( $_POST['lsp-reviews-url20'] );
		$lsp_reviews_url21 = sanitize_text_field( $_POST['lsp-reviews-url21'] );
		$lsp_reviews_url22 = sanitize_text_field( $_POST['lsp-reviews-url22'] );
		$lsp_reviews_url23 = sanitize_text_field( $_POST['lsp-reviews-url23'] );
		$lsp_reviews_url24 = sanitize_text_field( $_POST['lsp-reviews-url24'] );
		$lsp_reviews_url25 = sanitize_text_field( $_POST['lsp-reviews-url25'] );
		$lsp_reviews_url26 = sanitize_text_field( $_POST['lsp-reviews-url26'] );
		$lsp_reviews_url27 = sanitize_text_field( $_POST['lsp-reviews-url27'] );
		$lsp_reviews_url28 = sanitize_text_field( $_POST['lsp-reviews-url28'] );
		$lsp_reviews_url29 = sanitize_text_field( $_POST['lsp-reviews-url29'] );
		$lsp_reviews_url30 = sanitize_text_field( $_POST['lsp-reviews-url30'] );

		$lsp_captcha_question = sanitize_text_field( $_POST['lsp-captcha-question'] );
		$lsp_captcha_answer   = sanitize_text_field( $_POST['lsp-captcha-answer'] );

		$lsp_api_intro_text                   = stripslashes( wp_kses_post( $_POST['lsp-api-intro-text'] ) );
		$lsp_hide_intro_text                  = sanitize_text_field( $_POST['lsp-hide-intro-text'] );
		$lsp_api_post_blog                    = sanitize_text_field( $_POST['lsp-api-post-blog'] );
		$lsp_api_hide_attribution             = sanitize_text_field( $_POST['lsp-api-hide-attribution'] );
		$lsp_api_contact_form                 = sanitize_text_field( $_POST['lsp-api-contact-form'] );
		$lsp_api_email_addresses              = sanitize_text_field( $_POST['lsp-api-email-addresses'] );
		$lsp_api_form_header                  = sanitize_text_field( $_POST['lsp-api-form-header'] );
		$lsp_set_type0                        = sanitize_text_field( $_POST['lsp-set-type0'] );
		$lsp_exclude_cities0                  = sanitize_text_field( $_POST['lsp-exclude-cities0'] );
		$lsp_exclude_states0                  = sanitize_text_field( $_POST['lsp-exclude-states0'] );
		$lsp_exclude_countries0               = sanitize_text_field( $_POST['lsp-exclude-countries0'] );
		$lsp_add_countries0                   = sanitize_text_field( $_POST['lsp-add-countries0'] );
		$lsp_hide_headlines0                  = sanitize_text_field( $_POST['lsp-hide-headlines0'] );
		$lsp_local_focus0                     = sanitize_text_field( $_POST['lsp-local-focus0'] );
		$lsp_country_focus0                   = sanitize_text_field( $_POST['lsp-country-focus0'] );
		$lsp_state_focus0                     = sanitize_text_field( $_POST['lsp-state-focus0'] );
		$lsp_local_population_limit0          = sanitize_text_field( $_POST['lsp-local-population-limit0'] );
		$lsp_national_population_limit0       = sanitize_text_field( $_POST['lsp-national-population-limit0'] );
		$lsp_international_population_limit0  = sanitize_text_field( $_POST['lsp-international-population-limit0'] );
		$lsp_local_max_limit0                 = sanitize_text_field( $_POST['lsp-local-max-limit0'] );
		$lsp_national_max_limit0              = sanitize_text_field( $_POST['lsp-national-max-limit0'] );
		$lsp_international_max_limit0         = sanitize_text_field( $_POST['lsp-international-max-limit0'] );
		$lsp_how_far0                         = sanitize_text_field( $_POST['lsp-how-far0'] );
		$lsp_override_image_alts0             = sanitize_text_field( $_POST['lsp-override-image-alts0'] );
		$lsp_override_theme_image_alts0       = sanitize_text_field( $_POST['lsp-override-theme-image-alts0'] );
		$lsp_optimize_urls0                   = sanitize_text_field( $_POST['lsp-optimize-urls0'] );
		$lsp_optimize_page_titles0            = sanitize_text_field( $_POST['lsp-optimize-page-titles0'] );
		$lsp_auto_set_focus_terms0            = sanitize_text_field( $_POST['lsp-auto-set-focus-terms0'] );
		$lsp_optimize_page_meta_descriptions0 = sanitize_text_field( $_POST['lsp-optimize-page-meta-descriptions0'] );
		$lsp_optimize_internal_links0         = sanitize_text_field( $_POST['lsp-optimize-internal-links0'] );
		$lsp_ignore_types                     = sanitize_text_field( $_POST['lsp-ignore-types'] );
		$lsp_publish_now0                     = sanitize_text_field( $_POST['lsp-publish-now0'] );
		$lsp_sig                              = sanitize_text_field( $_POST['lsp-sig'] );

		$lsp_schema            = sanitize_text_field( $_POST['lsp-schema'] );
		$lsp_optimize_authors0 = sanitize_text_field( $_POST['lsp-optimize-authors0'] );
		$lsp_optimize_taxes0   = sanitize_text_field( $_POST['lsp-optimize-taxes0'] );

		$lsp_biztype = sanitize_text_field( $_POST['lsp-biztype'] );
		// 1-10
		$lsp_services   = sanitize_text_field( $_POST['lsp-services'] );
		$lsp_services2  = sanitize_text_field( $_POST['lsp-services2'] );
		$lsp_services3  = sanitize_text_field( $_POST['lsp-services3'] );
		$lsp_services4  = sanitize_text_field( $_POST['lsp-services4'] );
		$lsp_services5  = sanitize_text_field( $_POST['lsp-services5'] );
		$lsp_services6  = sanitize_text_field( $_POST['lsp-services6'] );
		$lsp_services7  = sanitize_text_field( $_POST['lsp-services7'] );
		$lsp_services8  = sanitize_text_field( $_POST['lsp-services8'] );
		$lsp_services9  = sanitize_text_field( $_POST['lsp-services9'] );
		$lsp_services10 = sanitize_text_field( $_POST['lsp-services10'] );
		// 1-10
		$lsp_percent   = sanitize_text_field( $_POST['lsp-percent'] );
		$lsp_percent2  = sanitize_text_field( $_POST['lsp-percent2'] );
		$lsp_percent3  = sanitize_text_field( $_POST['lsp-percent3'] );
		$lsp_percent4  = sanitize_text_field( $_POST['lsp-percent4'] );
		$lsp_percent5  = sanitize_text_field( $_POST['lsp-percent5'] );
		$lsp_percent6  = sanitize_text_field( $_POST['lsp-percent6'] );
		$lsp_percent7  = sanitize_text_field( $_POST['lsp-percent7'] );
		$lsp_percent8  = sanitize_text_field( $_POST['lsp-percent8'] );
		$lsp_percent9  = sanitize_text_field( $_POST['lsp-percent9'] );
		$lsp_percent10 = sanitize_text_field( $_POST['lsp-percent10'] );

		// 1-10
		$lsp_productservice   = sanitize_text_field( $_POST['lsp-productservice'] );
		$lsp_productservice2  = sanitize_text_field( $_POST['lsp-productservice2'] );
		$lsp_productservice3  = sanitize_text_field( $_POST['lsp-productservice3'] );
		$lsp_productservice4  = sanitize_text_field( $_POST['lsp-productservice4'] );
		$lsp_productservice5  = sanitize_text_field( $_POST['lsp-productservice5'] );
		$lsp_productservice6  = sanitize_text_field( $_POST['lsp-productservice6'] );
		$lsp_productservice7  = sanitize_text_field( $_POST['lsp-productservice7'] );
		$lsp_productservice8  = sanitize_text_field( $_POST['lsp-productservice8'] );
		$lsp_productservice9  = sanitize_text_field( $_POST['lsp-productservice9'] );
		$lsp_productservice10 = sanitize_text_field( $_POST['lsp-productservice10'] );

		$lsp_api_city                  = sanitize_text_field( $_POST['lsp-api-city'] );
		$lsp_api_state                 = sanitize_text_field( $_POST['lsp-api-state'] );
		$lsp_api_radius                = sanitize_text_field( $_POST['lsp-api-radius'] );
		$lsp_star_minimum              = sanitize_text_field( $_POST['lsp-star-minimum'] );
		$lsp_testimonials_auto_publish = sanitize_text_field( $_POST['lsp-testimonials-auto-publish'] );
		// 1-10
		$lsp_reviews_name   = sanitize_text_field( $_POST['lsp-reviews-name'] );
		$lsp_reviews_name2  = sanitize_text_field( $_POST['lsp-reviews-name2'] );
		$lsp_reviews_name3  = sanitize_text_field( $_POST['lsp-reviews-name3'] );
		$lsp_reviews_name4  = sanitize_text_field( $_POST['lsp-reviews-name4'] );
		$lsp_reviews_name5  = sanitize_text_field( $_POST['lsp-reviews-name5'] );
		$lsp_reviews_name6  = sanitize_text_field( $_POST['lsp-reviews-name6'] );
		$lsp_reviews_name7  = sanitize_text_field( $_POST['lsp-reviews-name7'] );
		$lsp_reviews_name8  = sanitize_text_field( $_POST['lsp-reviews-name8'] );
		$lsp_reviews_name9  = sanitize_text_field( $_POST['lsp-reviews-name9'] );
		$lsp_reviews_name10 = sanitize_text_field( $_POST['lsp-reviews-name10'] );
		// 1-10
		$lsp_reviews_url                     = sanitize_text_field( $_POST['lsp-reviews-url'] );
		$lsp_reviews_url2                    = sanitize_text_field( $_POST['lsp-reviews-url2'] );
		$lsp_reviews_url3                    = sanitize_text_field( $_POST['lsp-reviews-url3'] );
		$lsp_reviews_url4                    = sanitize_text_field( $_POST['lsp-reviews-url4'] );
		$lsp_reviews_url5                    = sanitize_text_field( $_POST['lsp-reviews-url5'] );
		$lsp_reviews_url6                    = sanitize_text_field( $_POST['lsp-reviews-url6'] );
		$lsp_reviews_url7                    = sanitize_text_field( $_POST['lsp-reviews-url7'] );
		$lsp_reviews_url8                    = sanitize_text_field( $_POST['lsp-reviews-url8'] );
		$lsp_reviews_url9                    = sanitize_text_field( $_POST['lsp-reviews-url9'] );
		$lsp_reviews_url10                   = sanitize_text_field( $_POST['lsp-reviews-url10'] );
		$lsp_set_type0                       = sanitize_text_field( $_POST['lsp-set-type0'] );
		$lsp_exclude_cities0                 = sanitize_text_field( $_POST['lsp-exclude-cities0'] );
		$lsp_add_cities0                     = sanitize_text_field( $_POST['lsp-add-cities0'] );
		$lsp_abbreviations0                  = sanitize_text_field( $_POST['lsp-abbreviations0'] );
		$lsp_exclude_states0                 = sanitize_text_field( $_POST['lsp-exclude-states0'] );
		$lsp_add_states0                     = sanitize_text_field( $_POST['lsp-add-states0'] );
		$lsp_local_population_limit0         = sanitize_text_field( $_POST['lsp-local-population-limit0'] );
		$lsp_national_population_limit0      = sanitize_text_field( $_POST['lsp-national-population-limit0'] );
		$lsp_international_population_limit0 = sanitize_text_field( $_POST['lsp-international-population-limit0'] );
		$lsp_exclude_countries0              = sanitize_text_field( $_POST['lsp-exclude-countries0'] );
		$lsp_add_countries0                  = sanitize_text_field( $_POST['lsp-add-countries0'] );

		$lsp_makeportfolio = sanitize_text_field( $_POST['lsp-makeportfolio'] );

		$lsp_localportfolio_links = sanitize_text_field( $_POST['lsp-localportfolio-links'] );

		$lsp_success = sanitize_text_field( $_POST['lsp-success'] );

		$lsp_blog_booster           = sanitize_text_field( $_POST['lsp-blog-booster'] );
		$lsp_attach                 = sanitize_text_field( $_POST['lsp-attach'] );
		$lsp_boosterarchive         = sanitize_text_field( $_POST['lsp-boosterarchive'] );
		$lsp_widgetlink             = sanitize_text_field( $_POST['lsp-widgetlink'] );
		$lsp_attachproducts         = sanitize_text_field( $_POST['lsp-attachproducts'] );
		$lsp_boosterarchiveproducts = sanitize_text_field( $_POST['lsp-boosterarchiveproducts'] );
		$lsp_widgetlinkproducts     = sanitize_text_field( $_POST['lsp-widgetlinkproducts'] );
		$lsp_locationData1          = sanitize_text_field( $_POST['lsp-locationData1'] );

		$lsp_auto_adjust = sanitize_text_field( $_POST['lsp-auto-adjust'] );

		$lsp_post_blog = sanitize_text_field( $_POST['lsp-post-blog'] );

		$lsp_api_key    = sanitize_text_field( $_POST['lsp-api-key'] );
		$lsp_autoadjust = sanitize_text_field( $_POST['lsp-autoadjust'] );
		$lsp_use_widget = sanitize_text_field( $_POST['lsp-use-widget'] );

		$lsp_text_color                             = (int) ( sanitize_text_field( $_POST['lsp-text-color'] ) );
		$lsp_link_color                             = (int) ( sanitize_text_field( $_POST['lsp-link-color'] ) );
		$lsp_header_color                           = (int) ( sanitize_text_field( $_POST['lsp-header-color'] ) );
		$lsp_homepage_footer_links_background_color = (int) ( sanitize_text_field( $_POST['lsp-homepage-footer-links-background-color'] ) );

		$lsp_hide_attribution = sanitize_text_field( $_POST['lsp-hide-attribution'] );

		$lsp_enable_categories = sanitize_text_field( $_POST['lsp-enable-categories'] );
		$lsp_preview_urls      = sanitize_text_field( $_POST['lsp-preview-urls'] );

		$hastupdates = false;
		$autoupdate  = false;
		if ( sanitize_text_field( $_POST['hasautoupdates'] ) == 'yes' ) {
			$hasupdates = true;
		}
		if ( sanitize_text_field( $_POST['lsp-auto-adjust'] ) == 'yes' || sanitize_text_field( $_POST['lsp-auto-adjust'] ) == 'onlyportfolios' ) {
			$autoupdate = true;
		}

		$lsp_city               = sanitize_text_field( $_POST['lsp-api-city'] );
		$lsp_state              = sanitize_text_field( $_POST['lsp-api-state'] );
		$lsp_keyphrase          = strtolower( sanitize_text_field( $_POST['lsp-services'] ) );
		$lsp_keyphrase_override = strtolower( sanitize_text_field( $_POST['lsp-keyphrase-override'] ) );
		$lsp_radius             = sanitize_text_field( $_POST['lsp-api-radius'] );
		if ( sanitize_text_field( $_POST['lsp-api-radius'] ) > 15 && $plus == 0 ) {
			$lsp_radius = 15;
		}

		$lsp_cities_all_pages  = sanitize_text_field( $_POST['lsp-cities-all-pages'] );
		$lsp_show_all_projects = sanitize_text_field( $_POST['lsp-show-all-projects'] );

		$lsp_max_cities = sanitize_text_field( $_POST['lsp-max-cities'] );
		$lsp_how_far    = sanitize_text_field( $_POST['lsp-how-far0'] );

		$lsp_hide_headlines    = sanitize_text_field( $_POST['lsp-hide-headlines0'] );
		$lsp_intro_text        = (string) wp_kses_post( $_POST['lsp-api-intro-text'] );
		$lsp_only_match_cities = sanitize_text_field( $_POST['lsp-only-match-cities'] );
		$lsp_publish_now       = sanitize_text_field( $_POST['lsp-publish-now0'] );

		$lsp_smart_settings = sanitize_text_field( $_POST['lsp-smart-settings0'] );
		$lsp_local_focus    = sanitize_text_field( $_POST['lsp-local-focus0'] );
		$lsp_state_focus    = sanitize_text_field( $_POST['lsp-state-focus0'] );
		$lsp_country_focus  = sanitize_text_field( $_POST['lsp-country-focus0'] );

		if ( $_POST['lsp-local-max-limit0'] ) {
			$lsp_local_max_limit = sanitize_text_field( $_POST['lsp-local-max-limit0'] );
		} else {
			$lsp_local_max_limit = '100000000';
		}
		if ( $_POST['lsp-national-max-limit0'] ) {
			$lsp_national_max_limit = sanitize_text_field( $_POST['lsp-national-max-limit0'] );
		} else {
			$lsp_national_max_limit = '100000000';
		}
		if ( $_POST['lsp-international-max-limit0'] ) {
			$lsp_international_max_limit = sanitize_text_field( $_POST['lsp-international-max-limit0'] );
		} else {
			$lsp_international_max_limit = '100000000';
		}

		$lsp_worked_location = sanitize_text_field( $_POST['lsp-worked-location'] );

		$lsp_add_classes        = sanitize_text_field( $_POST['lsp-add-classes'] );
		$lsp_footer_intro       = sanitize_text_field( $_POST['lsp-footer-intro'] );
		$lsp_linking_sentence   = sanitize_text_field( $_POST['lsp-linking-sentence'] );
		$lsp_served_sentence    = sanitize_text_field( $_POST['lsp-served-sentence'] );
		$lsp_served_sentence2   = sanitize_text_field( $_POST['lsp-served-sentence2'] );
		$lsp_portfolio_format   = sanitize_text_field( $_POST['lsp-portfolio-format'] );
		$lsp_optimize_portfolio = sanitize_text_field( $_POST['lsp-optimize-portfolio'] );

		$lsp_footer_links = sanitize_text_field( $_POST['lsp-footer-links'] );

		$lsp_contact_form    = sanitize_text_field( $_POST['lsp-contact-form'] );
		$lsp_email_addresses = sanitize_text_field( $_POST['lsp-email-addresses'] );
		$lsp_form_header     = sanitize_text_field( $_POST['lsp-form-header'] );
		$lsp_footer_classes  = sanitize_text_field( $_POST['lsp-footer-classes'] );

		$lsp_smaller_cities_text = sanitize_text_field( $_POST['lsp-smaller-cities-text'] );
		$lsp_smaller_cities      = sanitize_text_field( $_POST['lsp-smaller-cities'] );
		$lsp_api_smaller_cities  = sanitize_text_field( $_POST['lsp-api-smaller-cities'] );

		$lsp_set_type       = sanitize_text_field( $_POST['lsp-set-type0'] );
		$lsp_exclude_cities = sanitize_text_field( $_POST['lsp-exclude-cities0'] );
		$lsp_add_cities     = sanitize_text_field( $_POST['lsp-add-cities0'] );
		$lsp_abbreviations  = sanitize_text_field( $_POST['lsp-abbreviations0'] );
		$lsp_exclude_states = sanitize_text_field( $_POST['lsp-exclude-states0'] );
		$lsp_add_states     = sanitize_text_field( $_POST['lsp-add-states0'] );
		if ( ! ( $hasupdates && $autoupdate ) ) {
			$lsp_local_population_limit = sanitize_text_field( $_POST['lsp-local-population-limit0'] );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			$lsp_national_population_limit = sanitize_text_field( $_POST['lsp-national-population-limit0'] );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			$lsp_international_population_limit = sanitize_text_field( $_POST['lsp-international-population-limit0'] );
		}
		$lsp_exclude_countries = sanitize_text_field( $_POST['lsp-exclude-countries0'] );
		$lsp_add_countries     = sanitize_text_field( $_POST['lsp-add-countries0'] );
		if ( $lsp_city ) {
			$country        = 'US';
			$key            = 'key';
			$lsp_latitude1  = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . sanitize_text_field( $_POST['lsp-api-city'] ) . '&state=' . sanitize_text_field( $_POST['lsp-api-state'] ) . '&country=' . $country . '&request=latitude&save=1&url=' . get_site_url() . '&email=' . sanitize_email( lsp_get_option( 'admin_email' ) ) );
			$lsp_longitude1 = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . sanitize_text_field( $_POST['lsp-api-city'] ) . '&state=' . sanitize_text_field( $_POST['lsp-api-state'] ) . '&country=' . $country . '&request=longitude' );
		}

		update_option( 'lsp_content', '' ); // de-cache on settings save

		update_option( 'lsp-success', $lsp_success, 'yes' );
		update_option( 'lsp-focus-percent', $lsp_focus_percent, 'yes' );
		update_option( 'lsp-conversion-url', $lsp_conversion_url, 'yes' );
		update_option( 'lsp-conversion-value', $lsp_conversion_value, 'yes' );
		update_option( 'lsp-conversion-url2', $lsp_conversion_url2, 'yes' );
		update_option( 'lsp-conversion-value2', $lsp_conversion_value2, 'yes' );
		update_option( 'lsp-conversion-url3', $lsp_conversion_url3, 'yes' );
		update_option( 'lsp-conversion-value3', $lsp_conversion_value3, 'yes' );
		update_option( 'lsp-cpm', $lsp_cpm, 'yes' );
		update_option( 'lsp-split1', $lsp_split1, 'yes' );
		update_option( 'lsp-split2', $lsp_split2, 'yes' );
		update_option( 'lsp-split3', $lsp_split3, 'yes' );
		update_option( 'lsp-split4', $lsp_split4, 'yes' );

		update_option( 'lsp-email-title', $lsp_email_title, 'yes' );
		update_option( 'lsp-email-message', $lsp_email_message, 'yes' );

		update_option( 'lsp-turbomode', $lsp_turbomode, 'yes' );

		update_option( 'lsp-archive-types', $lsp_archive_types, 'yes' );

		update_option( 'lsp-storelocations', $lsp_storelocations, 'yes' );

		update_option( 'lsp-reviews-loc', $lsp_reviews_loc, 'yes' );
		update_option( 'lsp-reviews-loc2', $lsp_reviews_loc2, 'yes' );
		update_option( 'lsp-reviews-loc3', $lsp_reviews_loc3, 'yes' );
		update_option( 'lsp-reviews-loc4', $lsp_reviews_loc4, 'yes' );
		update_option( 'lsp-reviews-loc5', $lsp_reviews_loc5, 'yes' );
		update_option( 'lsp-reviews-loc6', $lsp_reviews_loc6, 'yes' );
		update_option( 'lsp-reviews-loc7', $lsp_reviews_loc7, 'yes' );
		update_option( 'lsp-reviews-loc8', $lsp_reviews_loc8, 'yes' );
		update_option( 'lsp-reviews-loc9', $lsp_reviews_loc9, 'yes' );
		update_option( 'lsp-reviews-loc10', $lsp_reviews_loc10, 'yes' );
		update_option( 'lsp-reviews-loc11', $lsp_reviews_loc11, 'yes' );
		update_option( 'lsp-reviews-loc12', $lsp_reviews_loc12, 'yes' );
		update_option( 'lsp-reviews-loc13', $lsp_reviews_loc13, 'yes' );
		update_option( 'lsp-reviews-loc14', $lsp_reviews_loc14, 'yes' );
		update_option( 'lsp-reviews-loc15', $lsp_reviews_loc15, 'yes' );
		update_option( 'lsp-reviews-loc16', $lsp_reviews_loc16, 'yes' );
		update_option( 'lsp-reviews-loc17', $lsp_reviews_loc17, 'yes' );
		update_option( 'lsp-reviews-loc18', $lsp_reviews_loc18, 'yes' );
		update_option( 'lsp-reviews-loc19', $lsp_reviews_loc19, 'yes' );
		update_option( 'lsp-reviews-loc20', $lsp_reviews_loc20, 'yes' );
		update_option( 'lsp-reviews-loc21', $lsp_reviews_loc21, 'yes' );
		update_option( 'lsp-reviews-loc22', $lsp_reviews_loc22, 'yes' );
		update_option( 'lsp-reviews-loc23', $lsp_reviews_loc23, 'yes' );
		update_option( 'lsp-reviews-loc24', $lsp_reviews_loc24, 'yes' );
		update_option( 'lsp-reviews-loc25', $lsp_reviews_loc25, 'yes' );
		update_option( 'lsp-reviews-loc26', $lsp_reviews_loc26, 'yes' );
		update_option( 'lsp-reviews-loc27', $lsp_reviews_loc27, 'yes' );
		update_option( 'lsp-reviews-loc28', $lsp_reviews_loc28, 'yes' );
		update_option( 'lsp-reviews-loc29', $lsp_reviews_loc29, 'yes' );
		update_option( 'lsp-reviews-loc30', $lsp_reviews_loc30, 'yes' );

		update_option( 'lsp-reviews-name11', $lsp_reviews_name11, 'yes' );
		update_option( 'lsp-reviews-name12', $lsp_reviews_name12, 'yes' );
		update_option( 'lsp-reviews-name13', $lsp_reviews_name13, 'yes' );
		update_option( 'lsp-reviews-name14', $lsp_reviews_name14, 'yes' );
		update_option( 'lsp-reviews-name15', $lsp_reviews_name15, 'yes' );
		update_option( 'lsp-reviews-name16', $lsp_reviews_name16, 'yes' );
		update_option( 'lsp-reviews-name17', $lsp_reviews_name17, 'yes' );
		update_option( 'lsp-reviews-name18', $lsp_reviews_name18, 'yes' );
		update_option( 'lsp-reviews-name19', $lsp_reviews_name19, 'yes' );
		update_option( 'lsp-reviews-name20', $lsp_reviews_name20, 'yes' );
		update_option( 'lsp-reviews-name21', $lsp_reviews_name21, 'yes' );
		update_option( 'lsp-reviews-name22', $lsp_reviews_name22, 'yes' );
		update_option( 'lsp-reviews-name23', $lsp_reviews_name23, 'yes' );
		update_option( 'lsp-reviews-name24', $lsp_reviews_name24, 'yes' );
		update_option( 'lsp-reviews-name25', $lsp_reviews_name25, 'yes' );
		update_option( 'lsp-reviews-name26', $lsp_reviews_name26, 'yes' );
		update_option( 'lsp-reviews-name27', $lsp_reviews_name27, 'yes' );
		update_option( 'lsp-reviews-name28', $lsp_reviews_name28, 'yes' );
		update_option( 'lsp-reviews-name29', $lsp_reviews_name29, 'yes' );
		update_option( 'lsp-reviews-name30', $lsp_reviews_name30, 'yes' );

		update_option( 'lsp-reviews-url11', $lsp_reviews_url11, 'yes' );
		update_option( 'lsp-reviews-url12', $lsp_reviews_url12, 'yes' );
		update_option( 'lsp-reviews-url13', $lsp_reviews_url13, 'yes' );
		update_option( 'lsp-reviews-url14', $lsp_reviews_url14, 'yes' );
		update_option( 'lsp-reviews-url15', $lsp_reviews_url15, 'yes' );
		update_option( 'lsp-reviews-url16', $lsp_reviews_url16, 'yes' );
		update_option( 'lsp-reviews-url17', $lsp_reviews_url17, 'yes' );
		update_option( 'lsp-reviews-url18', $lsp_reviews_url18, 'yes' );
		update_option( 'lsp-reviews-url19', $lsp_reviews_url19, 'yes' );
		update_option( 'lsp-reviews-url20', $lsp_reviews_url20, 'yes' );
		update_option( 'lsp-reviews-url21', $lsp_reviews_url21, 'yes' );
		update_option( 'lsp-reviews-url22', $lsp_reviews_url22, 'yes' );
		update_option( 'lsp-reviews-url23', $lsp_reviews_url23, 'yes' );
		update_option( 'lsp-reviews-url24', $lsp_reviews_url24, 'yes' );
		update_option( 'lsp-reviews-url25', $lsp_reviews_url25, 'yes' );
		update_option( 'lsp-reviews-url26', $lsp_reviews_url26, 'yes' );
		update_option( 'lsp-reviews-url27', $lsp_reviews_url27, 'yes' );
		update_option( 'lsp-reviews-url28', $lsp_reviews_url28, 'yes' );
		update_option( 'lsp-reviews-url29', $lsp_reviews_url29, 'yes' );
		update_option( 'lsp-reviews-url30', $lsp_reviews_url30, 'yes' );

		update_option( 'lsp-captcha-question', $lsp_captcha_question, 'yes' );
		update_option( 'lsp-captcha-answer', $lsp_captcha_answer, 'yes' );

		update_option( 'lsp-employeeslist', $lsp_employeeslist, 'yes' );

		update_option( 'lsp-media-redirect', $lsp_media_redirect, 'yes' );

		update_option( 'lsp-auto-adjust', $lsp_auto_adjust, 'yes' );
		update_option( 'lsp-api-intro-text', $lsp_api_intro_text, 'yes' );
		update_option( 'lsp-hide-intro-text', $lsp_hide_intro_text, 'yes' );
		update_option( 'lsp-api-post-blog', $lsp_api_post_blog, 'yes' );
		update_option( 'lsp-api-hide-attribution', $lsp_api_hide_attribution, 'yes' );
		update_option( 'lsp-api-contact-form', $lsp_api_contact_form, 'yes' );
		update_option( 'lsp-api-email-addresses', $lsp_api_email_addresses, 'yes' );
		update_option( 'lsp-api-form-header', $lsp_api_form_header, 'yes' );
		update_option( 'lsp-set-type0', $lsp_set_type0, 'yes' );
		update_option( 'lsp-exclude-cities0', $lsp_exclude_cities0, 'yes' );
		update_option( 'lsp-exclude-states0', $lsp_exclude_states0, 'yes' );
		update_option( 'lsp-exclude-countries0', $lsp_exclude_countries0, 'yes' );
		update_option( 'lsp-add-countries0', $lsp_add_countries0, 'yes' );
		update_option( 'lsp-hide-headlines0', $lsp_hide_headlines0, 'yes' );
		update_option( 'lsp-local-focus0', $lsp_local_focus0, 'yes' );
		update_option( 'lsp-country-focus0', $lsp_country_focus0, 'yes' );
		update_option( 'lsp-state-focus0', $lsp_state_focus0, 'yes' );
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-local-population-limit0', $lsp_local_population_limit0, 'yes' );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-national-population-limit0', $lsp_national_population_limit0, 'yes' );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-international-population-limit0', $lsp_international_population_limit0, 'yes' );
		}
		update_option( 'lsp-local-max-limit0', $lsp_local_max_limit0, 'yes' );
		update_option( 'lsp-national-max-limit0', $lsp_national_max_limit0, 'yes' );
		update_option( 'lsp-international-max-limit0', $lsp_international_max_limit0, 'yes' );
		update_option( 'lsp-how-far0', $lsp_how_far0, 'yes' );

		update_option( 'lsp-ignore-types', $lsp_ignore_types, 'yes' );
		update_option( 'lsp-publish-now0', $lsp_publish_now0, 'yes' );
		update_option( 'lsp-sig', $lsp_sig, 'yes' );

		update_option( 'lsp-additional-suggest', $lsp_additional_suggest, 'yes' );
		update_option( 'lsp-additional-suggest2', $lsp_additional_suggest2, 'yes' );
		update_option( 'lsp-additional-suggest3', $lsp_additional_suggest3, 'yes' );
		update_option( 'lsp-additional-suggest4', $lsp_additional_suggest4, 'yes' );
		update_option( 'lsp-additional-suggest5', $lsp_additional_suggest5, 'yes' );
		update_option( 'lsp-additional-suggest6', $lsp_additional_suggest6, 'yes' );
		update_option( 'lsp-additional-suggest7', $lsp_additional_suggest7, 'yes' );
		update_option( 'lsp-additional-suggest8', $lsp_additional_suggest8, 'yes' );
		update_option( 'lsp-additional-suggest9', $lsp_additional_suggest9, 'yes' );
		update_option( 'lsp-additional-suggest10', $lsp_additional_suggest10, 'yes' );

		update_option( 'lsp-kiosk-ip', $lsp_kiosk_ip, 'yes' );

		update_option( 'lsp-biztype', $lsp_biztype, 'yes' );
		// 1-10
		update_option( 'lsp-services', $lsp_services, 'yes' );
		update_option( 'lsp-services2', $lsp_services2, 'yes' );
		update_option( 'lsp-services3', $lsp_services3, 'yes' );
		update_option( 'lsp-services4', $lsp_services4, 'yes' );
		update_option( 'lsp-services5', $lsp_services5, 'yes' );
		update_option( 'lsp-services6', $lsp_services6, 'yes' );
		update_option( 'lsp-services7', $lsp_services7, 'yes' );
		update_option( 'lsp-services8', $lsp_services8, 'yes' );
		update_option( 'lsp-services9', $lsp_services9, 'yes' );
		update_option( 'lsp-services10', $lsp_services10, 'yes' );
		// 1-10
		update_option( 'lsp-percent', $lsp_percent, 'yes' );
		update_option( 'lsp-percent2', $lsp_percent2, 'yes' );
		update_option( 'lsp-percent3', $lsp_percent3, 'yes' );
		update_option( 'lsp-percent4', $lsp_percent4, 'yes' );
		update_option( 'lsp-percent5', $lsp_percent5, 'yes' );
		update_option( 'lsp-percent6', $lsp_percent6, 'yes' );
		update_option( 'lsp-percent7', $lsp_percent7, 'yes' );
		update_option( 'lsp-percent8', $lsp_percent8, 'yes' );
		update_option( 'lsp-percent9', $lsp_percent9, 'yes' );
		update_option( 'lsp-percent10', $lsp_percent10, 'yes' );

		// 1-10
		update_option( 'lsp-productservice', $lsp_productservice, 'yes' );
		update_option( 'lsp-productservice2', $lsp_productservice2, 'yes' );
		update_option( 'lsp-productservice3', $lsp_productservice3, 'yes' );
		update_option( 'lsp-productservice4', $lsp_productservice4, 'yes' );
		update_option( 'lsp-productservice5', $lsp_productservice5, 'yes' );
		update_option( 'lsp-productservice6', $lsp_productservice6, 'yes' );
		update_option( 'lsp-productservice7', $lsp_productservice7, 'yes' );
		update_option( 'lsp-productservice8', $lsp_productservice8, 'yes' );
		update_option( 'lsp-productservice9', $lsp_productservice9, 'yes' );
		update_option( 'lsp-productservice10', $lsp_productservice10, 'yes' );

		update_option( 'lsp-api-city', $lsp_api_city, 'yes' );
		update_option( 'lsp-api-state', $lsp_api_state, 'yes' );
		update_option( 'lsp-api-radius', $lsp_api_radius, 'yes' );
		update_option( 'lsp-star-minimum', $lsp_star_minimum, 'yes' );
		update_option( 'lsp-testimonials-auto-publish', $lsp_testimonials_auto_publish, 'yes' );
		// 1-10
		update_option( 'lsp-reviews-name', $lsp_reviews_name, 'yes' );
		update_option( 'lsp-reviews-name2', $lsp_reviews_name2, 'yes' );
		update_option( 'lsp-reviews-name3', $lsp_reviews_name3, 'yes' );
		update_option( 'lsp-reviews-name4', $lsp_reviews_name4, 'yes' );
		update_option( 'lsp-reviews-name5', $lsp_reviews_name5, 'yes' );
		update_option( 'lsp-reviews-name6', $lsp_reviews_name6, 'yes' );
		update_option( 'lsp-reviews-name7', $lsp_reviews_name7, 'yes' );
		update_option( 'lsp-reviews-name8', $lsp_reviews_name8, 'yes' );
		update_option( 'lsp-reviews-name9', $lsp_reviews_name9, 'yes' );
		update_option( 'lsp-reviews-name10', $lsp_reviews_name10, 'yes' );
		// 1-10
		update_option( 'lsp-reviews-url', $lsp_reviews_url, 'yes' );
		update_option( 'lsp-reviews-url2', $lsp_reviews_url2, 'yes' );
		update_option( 'lsp-reviews-url3', $lsp_reviews_url3, 'yes' );
		update_option( 'lsp-reviews-url4', $lsp_reviews_url4, 'yes' );
		update_option( 'lsp-reviews-url5', $lsp_reviews_url5, 'yes' );
		update_option( 'lsp-reviews-url6', $lsp_reviews_url6, 'yes' );
		update_option( 'lsp-reviews-url7', $lsp_reviews_url7, 'yes' );
		update_option( 'lsp-reviews-url8', $lsp_reviews_url8, 'yes' );
		update_option( 'lsp-reviews-url9', $lsp_reviews_url9, 'yes' );
		update_option( 'lsp-reviews-url10', $lsp_reviews_url10, 'yes' );
		update_option( 'lsp-set-type0', $lsp_set_type0, 'yes' );
		update_option( 'lsp-exclude-cities0', $lsp_exclude_cities0, 'yes' );
		update_option( 'lsp-add-cities0', $lsp_add_cities0, 'yes' );
		update_option( 'lsp-abbreviations0', $lsp_abbreviations0, 'yes' );
		update_option( 'lsp-exclude-states0', $lsp_exclude_states0, 'yes' );
		update_option( 'lsp-add-states0', $lsp_add_states0, 'yes' );
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-local-population-limit0', $lsp_local_population_limit0, 'yes' );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-national-population-limit0', $lsp_national_population_limit0, 'yes' );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-international-population-limit0', $lsp_international_population_limit0, 'yes' );
		}
		update_option( 'lsp-exclude-countries0', $lsp_exclude_countries0, 'yes' );
		update_option( 'lsp-add-countries0', $lsp_add_countries0, 'yes' );

		update_option( 'lsp-post-blog', $lsp_post_blog, 'yes' );

		update_option( 'lsp-api-key', $lsp_api_key, 'yes' );
		update_option( 'lsp-mozrank', $lsp_mozrank, 'yes' );
		update_option( 'lsp-autoadjust', $lsp_autoadjust, 'yes' );
		update_option( 'lsp-use-widget', $lsp_use_widget, 'yes' );

		update_option( 'lsp-hide-attribution', $lsp_hide_attribution, 'yes' );

		update_option( 'lsp-worked-location', $lsp_worked_location, 'yes' );

		update_option( 'lsp-add-classes', $lsp_add_classes, 'yes' );
		update_option( 'lsp-footer-intro', $lsp_footer_intro, 'yes' );
		update_option( 'lsp-linking-sentence', $lsp_linking_sentence, 'yes' );
		update_option( 'lsp-served-sentence', $lsp_served_sentence, 'yes' );
		update_option( 'lsp-served-sentence2', $lsp_served_sentence2, 'yes' );
		update_option( 'lsp-portfolio-format', $lsp_portfolio_format, 'yes' );
		update_option( 'lsp-optimize-portfolio', $lsp_optimize_portfolio, 'yes' );

		update_option( 'lsp-footer-links', $lsp_footer_links, 'yes' );

		update_option( 'lsp-enable-categories', $lsp_enable_categories, 'yes' );
		update_option( 'lsp-preview-urls', $lsp_preview_urls, 'yes' );

		update_option( 'lsp-text-color', $lsp_text_color, 'yes' );
		update_option( 'lsp-link-color', $lsp_link_color, 'yes' );
		update_option( 'lsp-header-color', $lsp_header_color, 'yes' );
		update_option( 'lsp-homepage-footer-links-background-color', $lsp_homepage_footer_links_background_color, 'yes' );

		update_option( 'lsp-city', $lsp_city, 'yes' );
		update_option( 'lsp-state', $lsp_state, 'yes' );
		update_option( 'lsp-keyphrase', $lsp_keyphrase, 'yes' );
		update_option( 'lsp-keyphrase-override', $lsp_keyphrase_override, 'yes' );
		update_option( 'lsp-radius', $lsp_radius, 'yes' );

		update_option( 'lsp-cities-all-pages', $lsp_cities_all_pages, 'yes' );
		update_option( 'lsp-show-all-projects', $lsp_show_all_projects, 'yes' );

		update_option( 'lsp-max-cities', $lsp_max_cities, 'yes' );
		update_option( 'lsp-how-far', $lsp_how_far, 'yes' );

		update_option( 'lsp-hide-headlines', $lsp_hide_headlines, 'yes' );
		update_option( 'lsp-intro-text', $lsp_intro_text, 'yes' );
		update_option( 'lsp-only-match-cities', $lsp_only_match_cities, 'yes' );
		update_option( 'lsp-publish-now', $lsp_publish_now, 'yes' );

		update_option( 'lsp-smart-settings', $lsp_smart_settings, 'yes' );
		update_option( 'lsp-local-focus', $lsp_local_focus, 'yes' );
		update_option( 'lsp-state-focus', $lsp_state_focus, 'yes' );
		update_option( 'lsp-country-focus', $lsp_country_focus, 'yes' );

		update_option( 'lsp-local-max-limit', $lsp_local_max_limit, 'yes' );
		update_option( 'lsp-national-max-limit', $lsp_national_max_limit, 'yes' );
		update_option( 'lsp-international-max-limit', $lsp_international_max_limit, 'yes' );

		update_option( 'lsp-contact-form', $lsp_contact_form, 'yes' );
		update_option( 'lsp-email-addresses', $lsp_email_addresses, 'yes' );
		update_option( 'lsp-form-header', $lsp_form_header, 'yes' );
		update_option( 'lsp-footer-classes', $lsp_footer_classes, 'yes' );
		update_option( 'lsp-smaller-cities-text', $lsp_smaller_cities_text, 'yes' );
		update_option( 'lsp-smaller-cities', $lsp_smaller_cities, 'yes' );
		update_option( 'lsp-api-smaller-cities', $lsp_api_smaller_cities, 'yes' );

		update_option( 'lsp-set-type', $lsp_set_type, 'yes' );
		update_option( 'lsp-exclude-cities', $lsp_exclude_cities, 'yes' );
		update_option( 'lsp-add-cities', $lsp_add_cities, 'yes' );
		update_option( 'lsp-abbreviations', $lsp_abbreviations, 'yes' );
		update_option( 'lsp-exclude-states', $lsp_exclude_states, 'yes' );
		update_option( 'lsp-add-states', $lsp_add_states, 'yes' );
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-local-population-limit', $lsp_local_population_limit, 'yes' );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-national-population-limit', $lsp_national_population_limit, 'yes' );
		}
		if ( ! ( $hasupdates && $autoupdate ) ) {
			update_option( 'lsp-international-population-limit', $lsp_international_population_limit, 'yes' );
		}
		update_option( 'lsp-exclude-countries', $lsp_exclude_countries, 'yes' );
		update_option( 'lsp-add-countries', $lsp_add_countries, 'yes' );
		update_option( 'lsp-latitude1', $lsp_latitude1, 'yes' );
		update_option( 'lsp-longitude1', $lsp_longitude1, 'yes' );

		update_option( 'lsp-largest-city', $lsp_largest_city, 'yes' );

		update_option( 'lsp-makeportfolio', $lsp_makeportfolio, 'yes' );

		update_option( 'lsp-localportfolio-links', $lsp_localportfolio_links, 'yes' );

		update_option( 'lsp-success', $lsp_success, 'yes' );

		update_option( 'lsp-blog-booster', $lsp_blog_booster, 'yes' );
		update_option( 'lsp-attach', $lsp_attach, 'yes' );
		update_option( 'lsp-boosterarchive', $lsp_boosterarchive, 'yes' );
		update_option( 'lsp-widgetlink', $lsp_widgetlink, 'yes' );
		update_option( 'lsp-attachproducts', $lsp_attachproducts, 'yes' );
		update_option( 'lsp-boosterarchiveproducts', $lsp_boosterarchiveproducts, 'yes' );
		update_option( 'lsp-widgetlinkproducts', $lsp_widgetlinkproducts, 'yes' );
		update_option( 'lsp-locationData1', $lsp_locationData1, 'yes' );
		?>



  <div class="updated"><p><strong>
		<?php
		_e( 'Settings have been saved.', 'lsp_text_domain' );
		?>
	</strong></p></div>
		<?php

	}
	echo '<div class="wrap">';
	echo '<h2>' . __( 'Best Local SEO Tools Settings', 'lsp_text_domain' ) . '</h2>';
	?>


	<?php
	if ( sanitize_text_field( $_GET['reports'] ) ) :
		?>

		<a href="http://www.bestlocalseotools.com" target="_blank">
		<?php
		_e( 'Upgrade to Premium', 'lsp_text_domain' );
		?>
		</a>
<br>

  <b>
		<?php
		_e(
			'Local Portfolio SEO Visits This

   Month:',
			'lsp_text_domain'
		);
		?>
		</b>
<br>
		<?php
		$amount = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php?request=viewcount&key=' . lsp_get_option( 'lsp-api-key' ) );

		if ( $amount < 1 ) {
			echo '0';
		} else {
			echo $amount;
		}
		?>
<br>


  <b>
		<?php
		_e( 'Monthly Feedback Score / By Employee:', 'lsp_text_domain' );
		?>
	</b>

 <div id='container' style='width: 100%;'>


		<img width="100%" src="
		<?php
		echo plugins_url( 'reports2.jpg', __FILE__ );
		?>
		">

	</div>
	


		<?php
	endif;
	?>



	<?php
	if ( ! ( sanitize_text_field( $_GET['reports'] ) ) ) :
		?>


 


<!-- This is the Plugin Options Screen UI Below -->


		<?php
		// if(lsp_get_option('lsp-agree')=="yes" || lsp_get_option('lsp-agree')=="yes2"):
		if ( 0 ) :
			?>


<a href="#" id="portfolioapilink">
			<?php
			_e( '1) Setup', 'lsp_text_domain' );
			?>
</a>

| <a href="
			<?php
			echo site_url();
			?>
/wp-admin/post-new.php?post_type=localproject" target="_blank">
			<?php
			_e( '2) Fill Out Local Portfolio', 'lsp_text_domain' );
			?>
</a>

<!--
| <a href="#" id="feedbacklink">
			<?php
			_e( '2) Reputation Builder Setup', 'lsp_text_domain' );
			?>
</a>
-->
| <a href="#" id="keywordslink3">
			<?php
			_e( '3) Request Feedback / Generate Reviews', 'lsp_text_domain' );
			?>
</a>

<!--| <a href="#" id="keywordslink2">
			<?php
			_e( '4) (optional) Local Portfolio Settings', 'lsp_text_domain' );
			?>
</a>-->

<?php endif; ?>
</center></div>  





<form name="lsp-options" method="post" action="edit.php?post_type=localproject&page=localseoportfolio-free.php&refresh=true" enctype="multipart/form-data">
  





  <div id="pform1" class="pform">

  <br><h3>
		<?php
			_e( 'Portfolio', 'lsp_text_domain' );
		?>
	 1:</h3>

  <p>
		<?php
			_e( 'Override Auto-Optimize Settings', 'lsp_text_domain' );
		?>
	 <br>
  <select name="lsp-override">
	<option value="no" 
		<?php
		if ( $lsp_override == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'No', 'lsp_text_domain' );
		?>
</option>
	<option value="yes" 
		<?php
		if ( $lsp_override == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'Yes', 'lsp_text_domain' );
		?>
</option>
  </select></p>


  <p>
		<?php
			_e( 'City (center of service area):', 'lsp_text_domain' );
		?>
	 <br>
   <input type="text" name="lsp-city" value="
		<?php
			echo $lsp_city;
		?>
	" size="40"></p>

  <p>
		<?php
			_e( 'State / Province (full state name):', 'lsp_text_domain' );
		?>
	 <br>
   <input type="text" name="lsp-state" value="
		<?php
			echo $lsp_state;
		?>
	" size="40"></p>

  <p>
		<?php
			_e( 'Key Phrase or Key Word: (the main Service or Product your offer)', 'lsp_text_domain' );
		?>
	 <br>
   <input type="text" name="lsp-keyphrase" value="
		<?php
			echo $lsp_keyphrase;
		?>
	" size="40"></p>

   <p>
		<?php
			_e( 'Radius Served in miles ', 'lsp_text_domain' );
		?>
	<font color='#aaaaaa' size='-1'>
		<?php
			_e( '(this is a square area with side-to-side diameter equal to roughly twice the radius)', 'lsp_text_domain' );
		?>
</font> <br>
   <input type="text" name="lsp-radius" value="
		<?php
			echo $lsp_radius;
		?>
	" size="5"></p>

		  <p>
		<?php
			_e( 'Intro Text:', 'lsp_text_domain' );
		?>
	<font color='#aaaaaa'>
		<?php
			_e( "(goes at the top of each city's portfolio page -- generally speaking, more text about your services/products here and in your project descriptions causes better rankings)", 'lsp_text_domain' );
		?>
</font><br> 
  <textarea rows="4" cols="50" name="lsp-intro-text">
		<?php
			echo $lsp_intro_text;
		?>
	</textarea><font color="#aaaaaa" size="-1"><br>
		<?php
			_e( 'Placeholders of', 'lsp_text_domain' );
		?>
 [city] and [state] 
		<?php
			_e( 'will be dynamically replaced to match the page the visitor is viewing.', 'lsp_text_domain' );
		?>
 </font>


		<?php
			_e( 'Publish Now?', 'lsp_text_domain' );
		?>
		 <br>
  <select name="lsp-publish-now">
	<option value="yes" 
		<?php
		if ( $lsp_publish_now == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'Yes', 'lsp_text_domain' );
		?>
</option>
	<option value="no" 
		<?php
		if ( $lsp_publish_now == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'No', 'lsp_text_domain' );
		?>
</option>
  </select></p>



   <br> <a href="#" onclick="return false;" class="lsp-show-advanced">
		<?php
			_e( 'Show Advanced Controls', 'lsp_text_domain' );
		?>
	</a><br>

<div class="lsp-advanced">

<p>
		<?php
			_e( '(optional) Key Phrase or Key Word Override SEO Term:', 'lsp_text_domain' );
		?>
 <br><font color='#aaaaaa'>
		<?php
			_e( "(for the above service keyphrase, optimize its portfolio for this keyphrase -- for instance, if someone put 'Immigration Law' for the keyphrase above which is then used for tagging project / client posts, but wanted to SEO their portfolio for the term 'Immigration Lawyer', they would put 'Immigration Lawyer' below)</font>", 'lsp_text_domain' );
		?>
</a><br>
	   <input type="text" name="lsp-keyphrase-override" value="
		<?php
			echo $lsp_keyphrase_override;
		?>
		" size="40"></p>

   <p>
		<?php
			_e( "Up to how far away should we show projects / clients on a city's portfolio page (in miles)", 'lsp_text_domain' );
		?>
	 <br>
  <select name="lsp-how-far">
	  <option value="auto" 
		<?php
		if ( $lsp_how_far == 'auto' || $lsp_how_far == '' ) {
			echo 'selected';
		}
		?>
		>
		<?php
			_e( 'auto-handle this (recommended)', 'lsp_text_domain' );
		?>
</option>
	  <option value="1000" 
		<?php
		if ( $lsp_how_far == '90' ) {
			echo 'selected';
		}
		?>
		>1000</option>
	  <option value="300" 
		<?php
		if ( $lsp_how_far == '50' ) {
			echo 'selected';
		}
		?>
		>300</option>
	  <option value="100" 
		<?php
		if ( $lsp_how_far == '25' ) {
			echo 'selected';
		}
		?>
		>100</option>
	  <option value="50" 
		<?php
		if ( $lsp_how_far == '15' ) {
			echo 'selected';
		}
		?>
		>50</option>
	  <option value="25" 
		<?php
		if ( $lsp_how_far == '10' ) {
			echo 'selected';
		}
		?>
		>25</option>
	  <option value="10" 
		<?php
		if ( $lsp_how_far == '5' ) {
			echo 'selected';
		}
		?>
		>10</option>
	  <option value="0" 
		<?php
		if ( $lsp_how_far == '0' && $lsp_how_far != '' ) {
			echo 'selected';
		}
		?>
		>0 
		<?php
			_e( '(only shows same-city matches)', 'lsp_text_domain' );
		?>
</option>

	</select>
   </p>
  

  <p>
		<?php
			_e( 'Portfolio Type / Set Coverage:', 'lsp_text_domain' );
		?>
	 <br>
  <select name="lsp-set-type">
	<option value="local" 
		<?php
		if ( $lsp_set_type == 'local' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'Local', 'lsp_text_domain' );
		?>
</option>
	<option value="localCities" 
		<?php
		if ( $lsp_set_type == 'localCities' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'Local (Only Cities I Have Clients In)', 'lsp_text_domain' );
		?>
</option>
	
  </select>
  </p>

	<p>
		<?php
			_e( "Local Set City Population Minimum (for getting it's own portfolio page):", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-local-population-limit" value="
		<?php
			echo $lsp_local_population_limit;
		?>
			" size="40"></p>


  <p>
		<?php
			_e( 'Exclude Cities:', 'lsp_text_domain' );
		?>
	 <br>
	<input type="text" name="lsp-exclude-cities" value="
		<?php
			echo $lsp_exclude_cities;
		?>
	" size="40"></p>


  <p>
		<?php
			_e( 'Exclude Countries:', 'lsp_text_domain' );
		?>
	 <br>
	<input type="text" name="lsp-exclude-countries" placeholder="
		<?php
			_e( 'English 2 letter country code(s), comma separate multiple', 'lsp_text_domain' );
		?>
	" value="
		<?php
			echo $lsp_exclude_countries;
		?>
" size="40"></p>

  <p>
		<?php
			_e( 'Only These Countries:', 'lsp_text_domain' );
		?>
	 <br>
	<input type="text" name="lsp-add-countries" placeholder="
		<?php
			_e( 'English 2 letter country code(s), comma separate multiple', 'lsp_text_domain' );
		?>
	" value="
		<?php
			echo $lsp_add_countries;
		?>
" size="40"></p>

  <p>
		<?php
			_e( 'Project / Client Entry Headlines:', 'lsp_text_domain' );
		?>
	<br>
  <select name="lsp-hide-headlines">
	<option value="tags" 
		<?php
		if ( $lsp_hide_headlines == 'tags' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'Use Location + Service/Product Tags Used', 'lsp_text_domain' );
		?>
</option>
	<option value="title" 
		<?php
		if ( $lsp_hide_headlines == 'title' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'Use The Title I Set', 'lsp_text_domain' );
		?>
</option>
	<option value="none" 
		<?php
		if ( $lsp_hide_headlines == 'none' ) {
			echo 'selected';
		}
		?>
	>
		<?php
			_e( 'No Headlines', 'lsp_text_domain' );
		?>
</option>
  </select>
  </p>

 <!--
  <p>
		<?php
			_e( 'Local Area Percent Focus', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-local-focus" value="
		<?php
			echo $lsp_local_focus;
		?>
	" size="40">

  <p>
		<?php
			_e( 'Home Country Percent Focus', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-country-focus" value="
		<?php
			echo $lsp_country_focus;
		?>
	" size="40">
  <br>

  <p>
		<?php
			_e( 'International Percent Focus', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-state-focus" value="
		<?php
			echo $lsp_state_focus;
		?>
	" size="40">


  <font color='#aaaaaa'><br><br>
		<?php
			_e( 'The options below can help get more portfolio pages to rank. Alternatively, our premium version is going to be able to automatically and intelligently set these for you', 'lsp_text_domain' );
		?>
	</font>
  


  <p>
		<?php
			_e( "National Set City Population Minimum (for getting it's own portfolio page)", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-national-population-limit" value="
		<?php
			echo $lsp_national_population_limit;
		?>
	" size="40">

  <p>
		<?php
			_e( "International Set City Population Minimum (for getting it's own portfolio page):", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-international-population-limit" value="
		<?php
			echo $lsp_international_population_limit;
		?>
	" size="40">
</p>

  <p>
		<?php
			_e( "Local Set City Population Maximum (for getting it's own portfolio page):", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-local-max-limit" value="
		<?php
			echo $lsp_local_max_limit;
		?>
	" size="40">

  <p>
		<?php
			_e( "National Set City Population Maximum (for getting it's own portfolio page)", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-national-max-limit" value="
		<?php
			echo $lsp_national_max_limit;
		?>
	" size="40">

  <p>
		<?php
			_e( "International Set City Population Maximum (for getting it's own portfolio page):", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-international-max-limit" value="
		<?php
			echo $lsp_international_max_limit;
		?>
	" size="40">
</p>
-->

<br>
</div>

		<?php
		endif;
	?>

	<?php
		global $plus;

	if ( $plus == 0 ) :
		?>

<br><a href="http://www.bestlocalseotools.com" target="_blank">
		<?php
		_e( 'Upgrade to Premium at bestlocalseotools.com', 'lsp_text_domain' );
		?>
</a> 
		<?php
		_e( 'to get the full version and unlock additional features.', 'lsp_text_domain' );
		?>
 


		<?php
		endif;
	?>

  </div>


<div id="aform" class="pform">

  </div>

	<?php if ( lsp_get_option( 'lsp-agree' ) != 'yes' && lsp_get_option( 'lsp-agree' ) != 'yes2' ) : ?>

<div id="pformapi" class="pform">

<p>
		<?php
		_e( 'The plugin needs to send data back-and-forth from your site to our servers to retrieve geographic data, for usage tracking, and for notifications. Authorize it to do so?', 'lsp_text_domain' );
		?>
 <br>
  <select name="lsp-agree">
	<!--<option value="yes" 
		<?php
		if ( $lsp_agree == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
</option>-->
<option value="yes2" 
		<?php
		if ( $lsp_agree == 'yes2' ) {
			echo 'selected';
		}
		?>
>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
</option>

	<option value="no" 
		<?php
		if ( $lsp_agree == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
</option>
  </select></p>



<?php endif; ?>



	<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>

<div id="pformapi" class="pform">
  

  


  <p><a href="http://www.bestlocalseotools.com/seo-software-prices/" target="_blank"><?php _e( 'Your Premium API Key (increases limits / enables premium features with full plugin -- click here for more info):', 'lsp_text_domain' ); ?></a> <br>
	<input type="text" name="lsp-api-key" value="<?php echo $lsp_api_key; ?>" size="40"><input type="submit" name="upgrade" class="button-primary" id="upgrade" value="<?php esc_attr_e( 'Upgrade & Save Settings', 'lsp_text_domain' ); ?>" /></p>
  
 




<!-- <option value="lsec" 
		<?php
		if ( $lsp_biztype == 'lsec' ) {
			echo 'selected';
		}
		?>
>
		<?php
		_e( 'Local Services & Ecommerce Products', 'lsp_text_domain' );
		?>
</option>-->

<!--  <h3>
		<?php
		_e( 'Premium Software Key & Auto-Settings', 'lsp_text_domain' );
		?>
</h3> -->

 <span class="biztype" id="biztype">
		<?php
		_e( 'What kind of business are you?', 'lsp_text_domain' );
		?>
	<br>
	<select id="lspbiztype" name="lsp-biztype">
	<option value="ls" 
		<?php
		if ( $lsp_biztype == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Services - We Go To Them', 'lsp_text_domain' );
		?>
</option>
	<option value="ls2" 
		<?php
		if ( $lsp_biztype == 'ls2' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Services - They Come To Us', 'lsp_text_domain' );
		?>
</option>
   
	<option value="ec" 
		<?php
		if ( $lsp_biztype == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce / Products', 'lsp_text_domain' );
		?>
</option>
	<option value="media" 
		<?php
		if ( $lsp_biztype == 'media' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Blogger / Media Company', 'lsp_text_domain' );
		?>
</option>
  </select>
  </span><br>


  <span class="localsetup">
  <p>
		<?php
		_e( 'City (center of service area):', 'lsp_text_domain' );
		?>
	 <br>
   <input type="text" name="lsp-api-city" value="
		<?php
		echo $lsp_api_city;
		?>
	" size="40"></p>

  <p>
		<?php
		_e( 'State / Province (full state name):', 'lsp_text_domain' );
		?>
	 <br>
   <input type="text" id="lsp-api-state" name="lsp-api-state" value="
		<?php
		echo $lsp_api_state;
		?>
	" size="40"></p>
<input type="hidden" name="lsp-autooptimize" id="autooptimize" size="40">
  <p>
		<?php
		_e( 'Radius Served in Miles', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-api-radius" value="
		<?php
		echo $lsp_api_radius;
		?>
	" size="5">
  </p>
 
  <p>
		<?php
		_e( 'Largest Nearby City Served:', 'lsp_text_domain' );
		?>
	 <br>
   <input type="text" name="lsp-largest-city" value="
		<?php
		echo $lsp_largest_city;
		?>
	" size="40"></p>
</span>

 <span class="percents" id="percent1">
		<?php
		_e( 'Your Search Main Terms / Service Offered / Product Offered:', 'lsp_text_domain' );
		?>
	<br>
		<?php
		_e( 'Term #1', 'lsp_text_domain' );
		?>
	<input placeholder="
		<?php
		_e( 'Your main term/service', 'lsp_text_domain' );
		?>
" type="text" id="lsp-services" name="lsp-services" value="
		<?php
		echo $lsp_services;
		?>
" size="30">  <input type="text" name="lsp-percent" value="
		<?php
		echo $lsp_percent;
		?>
" size="4">%
  <select class="discern" name="lsp-productservice">
	<option value="" 
		<?php
		if ( $lsp_productservice == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
  <select name="lsp-makeportfolio">
	<option value="yes" 
		<?php
		if ( $lsp_makeportfolio != 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
		?>
</option>
	<option value="no" 
		<?php
		if ( $lsp_makeportfolio == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
		?>
</option>
  </select>
  </span>

 <span class="percents" id="percent2"> <br>
		<?php
		_e( 'Term #2', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services2" name="lsp-services2" value="
		<?php
		echo $lsp_services2;
		?>
" size="30"> <input type="text" name="lsp-percent2" value="
		<?php
		echo $lsp_percent2;
		?>
" size="4">%
  
  <select class="discern" name="lsp-productservice2">
	<option value="" 
		<?php
		if ( $lsp_productservice2 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice2 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice2 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
  <select name="lsp-makeportfolio2">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio2 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio2 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>

  </span>

 <span class="percents" id="percent3"> <br>
		<?php
		_e( 'Term #3', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services3" name="lsp-services3" value="
		<?php
		echo $lsp_services3;
		?>
" size="30"> <input type="text" name="lsp-percent3" value="
		<?php
		echo $lsp_percent3;
		?>
" size="4">%
  
	<select class="discern" name="lsp-productservice3">
	<option value="" 
		<?php
		if ( $lsp_productservice3 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice3 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice3 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
	<select name="lsp-makeportfolio3">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio3 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio3 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>

  </span>

 <span class="percents" id="percent4"> <br>
		<?php
		_e( 'Term #4', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services4" name="lsp-services4" value="
		<?php
		echo $lsp_services4;
		?>
" size="30"> <input type="text" name="lsp-percent4" value="
		<?php
		echo $lsp_percent4;
		?>
" size="4">%
	<select class="discern" name="lsp-productservice4">
	<option value="" 
		<?php
		if ( $lsp_productservice4 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice4 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice4 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
  <select name="lsp-makeportfolio4">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio4 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio4 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>

  </span>

 <span class="percents" id="percent5"> <br>
		<?php
		_e( 'Term #5', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services5" name="lsp-services5" value="
		<?php
		echo $lsp_services5;
		?>
" size="30"> <input type="text" name="lsp-percent5" value="
		<?php
		echo $lsp_percent5;
		?>
" size="4">%
	<select class="discern" name="lsp-productservice5">
	<option value="" 
		<?php
		if ( $lsp_productservice5 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice5 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice5 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
<select name="lsp-makeportfolio5">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio5 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio5 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>
  </span>

 <span class="percents" id="percent6"> <br>
		<?php
		_e( 'Term #6', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services6" name="lsp-services6" value="
		<?php
		echo $lsp_services6;
		?>
" size="30"> <input type="text" name="lsp-percent6" value="
		<?php
		echo $lsp_percent6;
		?>
" size="4">%
  
	<select class="discern" name="lsp-productservice6">
	<option value="" 
		<?php
		if ( $lsp_productservice6 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice6 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice6 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
  <select name="lsp-makeportfolio6">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio6 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio6 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
		endif;
		?>

  </span>

 <span class="percents" id="percent7"> <br>
		<?php
		_e( 'Term #7', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services7" name="lsp-services7" value="
		<?php
		echo $lsp_services7;
		?>
" size="30"> <input type="text" name="lsp-percent7" value="
		<?php
		echo $lsp_percent7;
		?>
" size="4">%
  
	<select class="discern" name="lsp-productservice7">
	<option value="" 
		<?php
		if ( $lsp_productservice7 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice7 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice7 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
  <select name="lsp-makeportfolio7">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio7 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio7 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
		endif;
		?>
  </span>

 <span class="percents" id="percent8"> <br>
		<?php
		_e( 'Term #8', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services8" name="lsp-services8" value="
		<?php
		echo $lsp_services8;
		?>
" size="30"> <input type="text" name="lsp-percent8" value="
		<?php
		echo $lsp_percent8;
		?>
" size="4">%
  
	<select class="discern" name="lsp-productservice8">
	<option value="" 
		<?php
		if ( $lsp_productservice8 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice8 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice8 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
<select name="lsp-makeportfolio8">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio8 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio8 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>
  </span>

 <span class="percents" id="percent9"> <br>
		<?php
		_e( 'Term #9', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services9" name="lsp-services9" value="
		<?php
		echo $lsp_services9;
		?>
" size="30"> <input type="text" name="lsp-percent9" value="
		<?php
		echo $lsp_percent9;
		?>
" size="4">%
	<select class="discern" name="lsp-productservice9">
	<option value="" 
		<?php
		if ( $lsp_productservice9 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice9 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice9 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
  <select name="lsp-makeportfolio9">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio9 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio9 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>
  </span>

   <span class="percents" id="percent10"> <br>
		<?php
		_e( 'Term #10', 'lsp_text_domain' );
		?>
	<input type="text" id="lsp-services10" name="lsp-services10" value="
		<?php
		echo $lsp_services10;
		?>
" size="30"> <input type="text" name="lsp-percent10" value="
		<?php
		echo $lsp_percent10;
		?>
" size="4">%
  
  <select class="discern" name="lsp-productservice10">
	<option value="" 
		<?php
		if ( $lsp_productservice10 == 'ls' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Is this a service or product?', 'lsp_text_domain' );
		?>
</option>
	<option value="lsec" 
		<?php
		if ( $lsp_productservice10 == 'lsec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Local Service / Term', 'lsp_text_domain' );
		?>
</option>
	<option value="ec" 
		<?php
		if ( $lsp_productservice10 == 'ec' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Ecommerce Product', 'lsp_text_domain' );
		?>
</option>
  </select>
		<?php
		global $plus;
		if ( $plus != 0 ) :
			?>
  <select name="lsp-makeportfolio10">
	<option value="yes" 
			<?php
			if ( $lsp_makeportfolio10 == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Make A Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_makeportfolio10 != 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Do Not Make Local Portfolio For This', 'lsp_text_domain' );
			?>
</option>
  </select>
			<?php
			endif;
		?>
  </span>

  
 

<p>
		<?php
		_e( 'Publish/Use the Powerful Local Portfolios System?', 'lsp_text_domain' );
		?>
 <br>
  <select name="lsp-publish-now0">
	<option value="yes" 
		<?php
		if ( $lsp_publish_now == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
</option>
	<option value="no" 
		<?php
		if ( $lsp_publish_now == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
</option>
	<option value="preview" 
		<?php
		if ( $lsp_publish_now == 'preview' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Preview Mode', 'lsp_text_domain' );
		?>
</option>

  </select></p>
  
  
   <p>
		<?php
		_e( 'Also Create a Traditional Portfolio at ', 'lsp_text_domain' );
		echo "<a href='" . home_url() . '/ourwork/' . "' target='_blank'>" . home_url() . '/ourwork/</a> ';
		_e( '(you can add service/industry filter widgets)', 'lsp_text_domain' );
		?>
	 <br>
	<select name="lsp-enable-categories">
	  <option value="no" 
		<?php
		if ( $lsp_enable_categories == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
</option>
	  <option value="yes" 
		<?php
		if ( $lsp_enable_categories == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
</option>
	</select></p>



	<p>
		<?php
		_e( 'Optimize the Home Page Title Tag?', 'lsp_text_domain' );
		?>
	 <br>
	<select name="lsp-auto-adjust" id="optimizes">
  
	<option value="yes" 
		<?php
		if ( $lsp_auto_adjust == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
</option>
  
	<option value="no" 
		<?php
		if ( $lsp_auto_adjust == 'no' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
</option>

		<?php
	endif;
	?>
  </select>
  </p>
  
  

	<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>

  <a href="#" id="portfoliosetuplink"><u>
		<?php
		_e( 'Local Portfolio Settings', 'lsp_text_domain' );
		?>
  </a></u><br><?php endif; ?>
<span id="portfoliosetupdiv" style="display:block;padding:20px!important">

  
<div id="kform27" class="pform7">
  <p>
	<?php
	echo '<b>';
	_e( 'Intro Text', 'lsp_text_domain' );
	echo '</b>';
	_e( " (goes at the top of each city's portfolio page  -- generally speaking, more text about your services/products here and in your project descriptions causes better rankings):", 'lsp_text_domain' );
	?>
	 <br>
	<!--
  <textarea rows="4" cols="50" name="lsp-api-intro-textNah">
	<?php
	echo $lsp_api_intro_text;
	?>
  </textarea>-->

	<?php
	wp_editor(
		$lsp_api_intro_text,
		'lsp-api-intro-text',
		array(
			'editor_height' => 100,
		)
	);
	?>
  <font color="#aaaaaa" size="-1"><br>
	<?php
	_e( 'Placeholders of', 'lsp_text_domain' );
	?>
	 [city] 
	<?php
	_e( 'and', 'lsp_text_domain' );
	?>
 [state] 
	<?php
	_e( 'will be dynamically replaced to match the page the visitor is viewing.', 'lsp_text_domain' );
	?>
 <!-- If you don't have many clients/testimonials in the system, having this section be longer generally helps SEO in our experience. --> </font>
  </p>

	<?php
	_e( 'Optional Additional Settings', 'lsp_text_domain' );
	?>
<br>

 <a href="#" onclick="return false;" id="colorsLink">
	<?php
	_e( 'Color, Styling and Text Options' );
	?>
	</a>
  <div id="colorOptions"></font>
  <p>
	<?php
	_e( 'Color, Styling and Text Options', 'lsp_text_domain' );
	?>
	<br><font color='#aaaaaa'>
	<?php
	_e( "You can set the colors for all your portfolio pages below as color names or hexadecimal codes like #ff0000. It is important to make sure the text shows. Highlighting a portfolio page's content and your home page's footer is one way to make sure.", 'lsp_text_domain' );
	?>
</font><br>
	<a href="https://www.webpagefx.com/web-design/color-picker/" target="_blank">
	<?php
	_e( 'Footer Text Color:', 'lsp_text_domain' );
	?>
	</a> <br>
	#<input type="text" class="color {required:false}"  name="lsp-text-color" value="
	<?php
	echo $lsp_text_color;
	?>
	" size="40"></p>
	<p><a href="https://www.webpagefx.com/web-design/color-picker/" target="_blank">
	<?php
	_e( 'Link Color:', 'lsp_text_domain' );
	?>
	</a> <br>
	#<input type="text" class="color {required:false}"   name="lsp-link-color" value="
	<?php
	echo $lsp_link_color;
	?>
	" size="40"></p>
	<p><a href="https://www.webpagefx.com/web-design/color-picker/" target="_blank">
	<?php
	_e( 'Text Header Color:', 'lsp_text_domain' );
	?>
	</a> <br>
	#<input type="text" class="color {required:false}"   name="lsp-header-color" value="
	<?php
	echo $lsp_header_color;
	?>
	" size="40"></p>
	<p><a href="https://www.webpagefx.com/web-design/color-picker/" target="_blank">
	<?php
	_e( 'Homepage Footer Links Background Color:', 'lsp_text_domain' );
	?>
	</a> <br>
	#<input type="text" class="color {required:false}"   name="lsp-homepage-footer-links-background-color" value="
	<?php
	echo $lsp_homepage_footer_links_background_color;
	?>
	" size="40"></p>
  

	<p>
	<?php
	_e( 'Add this HTML class to the portfolio links footer section:', 'lsp_text_domain' );
	?>
	 <br>
	<input type="text" name="lsp-add-classes" value="
	<?php
	echo $lsp_add_classes;
	?>
	" size="40"></p>

	<p>
	<?php
	_e( 'Footer Intro Sentence:', 'lsp_text_domain' );
	?>
	 <br>
	<input type="text" name="lsp-footer-intro" value="
	<?php
	echo $lsp_footer_intro;
	?>
	" size="40"></p>
<!--
	<p>
	<?php
	_e( 'Footer Section Linking Sentence', 'lsp_text_domain' );
	?>
	 <br>
	<input type="text" name="lsp-linking-sentence" value="
	<?php
	echo $lsp_linking_sentence;
	?>
	" size="40"></p> -->

	<p>
	<?php
	_e( 'Other Cities Served Linking Sentence', 'lsp_text_domain' );
	?>
	 <br>
	<input type="text" name="lsp-served-sentence" value="
	<?php
	echo $lsp_served_sentence;
	?>
	" size="40"></p>

<p><?php _e( 'Too-Small Cities Served Linking Sentence', 'lsp_text_domain' ); ?> <br>
	<input type="text" name="lsp-served-sentence2" value="<?php echo $lsp_served_sentence2; ?>" size="40"></p>

	<p>
	<?php
	_e( "Show 'Worked With' and 'Location' on entries which have them:", 'lsp_text_domain' );
	?>
	 <br>
	<select name="lsp-worked-location">
	  <option value="no" 
	  <?php
		if ( $lsp_worked_location == 'no' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'No', 'lsp_text_domain' );
	?>
</option>
	  <option value="yes" 
	  <?php
		if ( $lsp_worked_location == 'yes' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'Yes', 'lsp_text_domain' );
	?>
</option>
	</select></p>


	<p>
	<?php
	_e( 'List nearby portfolio pages as section titles or cities list:', 'lsp_text_domain' );
	?>
	 <br>
	<select name="lsp-portfolio-format">
	  <option value="sectiontitles" 
	  <?php
		if ( $lsp_portfolio_format == 'sectiontitles' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'Section Titles', 'lsp_text_domain' );
	?>
</option>
	  <option value="citiesstateslist" 
	  <?php
		if ( $lsp_portfolio_format == 'citiesstateslist' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'Cities And States Only', 'lsp_text_domain' );
	?>
</option>
	  <option value="citieslist" 
	  <?php
		if ( $lsp_portfolio_format == 'citieslist' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'Cities Only', 'lsp_text_domain' );
	?>
</option>
	</select></p>



   



	<p>
	<?php
	_e( 'Use showcase URLs with preview text', 'lsp_text_domain' );
	?>
	 <br>
	<select name="lsp-preview-urls">
	  <option value="no" 
	  <?php
		if ( $lsp_preview_urls == 'no' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'No', 'lsp_text_domain' );
	?>
</option>
	  <option value="yes" 
	  <?php
		if ( $lsp_preview_urls == 'yes' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'Yes', 'lsp_text_domain' );
	?>
</option>
	</select></p>



  <p>
	<?php
	_e( "Clarify & List Smaller Cities Served Nearby If They Didn't Get Their Own Portfolio Section?", 'lsp_text_domain' );
	?>
	 <br>
  <select name="lsp-api-smaller-cities">
	<option value="yes" 
	<?php
	if ( $lsp_api_smaller_cities == 'yes' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'Yes', 'lsp_text_domain' );
	?>
</option>
	<option value="no" 
	<?php
	if ( $lsp_api_smaller_cities == 'no' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'No', 'lsp_text_domain' );
	?>
</option>
  </select></p>


  <p>
	<?php
	_e( "Show the 'Developed with' Link", 'lsp_text_domain' );
	?>
	 <br>
  <select name="lsp-sig">
	<option value="yes" 
	<?php
	if ( $lsp_sig == 'yes' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'Yes', 'lsp_text_domain' );
	?>
</option>
	<option value="no" 
	<?php
	if ( $lsp_sig == 'no' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'No', 'lsp_text_domain' );
	?>
</option>
  </select></p>


	<p>
	<?php
	_e( 'Show the footer links to your portfolio pages on all pages?', 'lsp_text_domain' );
	?>
	<br>
	  <select name="lsp-cities-all-pages">
		<option value="yes" 
		<?php
		if ( $lsp_cities_all_pages != 'no' && $lsp_cities_all_pages != 'none' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'Yes (recommended)', 'lsp_text_domain' );
	?>
</option>
		<option value="no" 
		<?php
		if ( $lsp_cities_all_pages == 'no' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'No - Just on the Homepage', 'lsp_text_domain' );
	?>
</option>
		<option value="none" 
		<?php
		if ( $lsp_cities_all_pages == 'none' ) {
			echo 'selected';
		}
		?>
		>
	<?php
	_e( 'No - I am going to link to them some other way', 'lsp_text_domain' );
	?>
</option>
	  </select></p>






  </div>



<br>
<a href="#" onclick="return false;" class="lsp-show-links">
	<?php
	_e( 'Get Portfolio URLs for Links / Menus', 'lsp_text_domain' );
	?>
</a>

<div class="lsp-links">
	<?php
	_e( '"Enable Industry / Service Category Portfolios" must be turned on in the Styling section to use these. They can be further styled by a web designer using custom taxonomy and archive templates.', 'lsp_text_domain' );
	?>
<br>



	<?php
	_e( 'Create a Portfolio Link for Where ', 'lsp_text_domain' );
	?>
<select name='iservice' id='iservice'>
  <option id='service' value='service'>
	<?php
	_e( 'Service', 'lsp_text_domain' );
	?>
	</option>
  <option id='industry' value='industry'>
	<?php
	_e( 'Industry', 'lsp_text_domain' );
	?>
	</option>
  </select>
	<?php
	_e( 'Is ', 'lsp_text_domain' );
	?>
<input type="text" name="menuphrase" id="menuphrase">
<br>
	<?php
	_e( 'The URL for the above content is', 'lsp_text_domain' );
	?>
<span id="menuurl">
	<?php
	echo home_url() . '/ourwork/';
	?>
</span>

  </div>












<br>


 <a href="#" onclick="return false;" class="lsp-show-advanced">
	<?php
	_e( 'Show Advanced Controls', 'lsp_text_domain' );
	?>
	</a>

<div class="lsp-advanced">









  <p>
	<?php
		_e( 'Exclude Cities:', 'lsp_text_domain' );
	?>
	 <br>
	<input type="text" name="lsp-exclude-cities0" value="
	<?php
		echo $lsp_exclude_cities0;
	?>
	" size="40"></p>

 <p>
	<?php
		_e( "Local Set City Population Minimum (for getting it's own portfolio page):", 'lsp_text_domain' );
	?>
	 <br>
  <input type="text" name="lsp-local-population-limit0" value="
	<?php
		echo $lsp_local_population_limit0;
	?>
		" size="40"></p>
  <p>
	<?php
		_e( "Local Set City Population Maximum (for getting it's own portfolio page):", 'lsp_text_domain' );
	?>
	 <br>
  <input type="text" name="lsp-local-max-limit0" value="
	<?php
		echo $lsp_local_max_limit0;
	?>
		" size="40"></p>

<!--
  <p>
	<?php
		_e( 'Add Cities:', 'lsp_text_domain' );
	?>
	 <br>
  <input type="text" name="lsp-add-cities0" value="
	<?php
		echo $lsp_add_cities0;
	?>
	" size="40">-->
<!--
  <p>
	<?php
		_e( 'Use Abbreviations Instead:', 'lsp_text_domain' );
	?>
	 <br>
  <input type="text" name="lsp-abbreviations0" value="
	<?php
		echo $lsp_abbreviations0;
	?>
	" size="40">-->

  <p>
	<?php
		_e( 'Exclude States:', 'lsp_text_domain' );
	?>
	 <br>
	<input type="text" name="lsp-exclude-states0" value="
	<?php
		echo $lsp_exclude_states0;
	?>
	" size="40"></p>





<p>
	<?php
	_e( 'Post portfolio items to the blog as well?', 'lsp_text_domain' );
	?>
<br>
  <select name="lsp-post-blog">
	<option value="yes" 
	<?php
	if ( $lsp_post_blog == 'yes' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'Yes', 'lsp_text_domain' );
	?>
</option>
	<option value="no" 
	<?php
	if ( $lsp_post_blog != 'yes' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'No', 'lsp_text_domain' );
	?>
</option>
  </select></p>

  <p>
	<?php
		_e( 'Portfolio Type / Set Coverage:', 'lsp_text_domain' );
	?>
	 <br>
  <select name="lsp-set-type0">
	<option value="local" 
	<?php
	if ( $lsp_set_type0 == 'local' ) {
		echo 'selected';
	}
	?>
	>
	<?php
		_e( 'Local', 'lsp_text_domain' );
	?>
</option>
	<option value="localCities" 
	<?php
	if ( $lsp_set_type0 == 'localCities' ) {
		echo 'selected';
	}
	?>
	>
	<?php
		_e( 'Local (Only Cities I Have Clients In)', 'lsp_text_domain' );
	?>
</option>
	
  </select>
  </p>



<p>
	<?php
	_e( 'Maximum portfolio city pages to list on footer (total for all portfolios -- 90 is the recommended amount for max SEO boost):', 'lsp_text_domain' );
	?>
 <br>
<select name="lsp-max-cities">
	<option value="90" 
	<?php
	if ( $lsp_max_cities == '90' ) {
		echo 'selected';
	}
	?>
	>90</option>
	<option value="50" 
	<?php
	if ( $lsp_max_cities == '50' ) {
		echo 'selected';
	}
	?>
	>50</option>
	<option value="25" 
	<?php
	if ( $lsp_max_cities == '25' ) {
		echo 'selected';
	}
	?>
	>25</option>
	<option value="15" 
	<?php
	if ( $lsp_max_cities == '15' ) {
		echo 'selected';
	}
	?>
	>15</option>
	<option value="10" 
	<?php
	if ( $lsp_max_cities == '10' ) {
		echo 'selected';
	}
	?>
	>10</option>
	<option value="5" 
	<?php
	if ( $lsp_max_cities == '5' ) {
		echo 'selected';
	}
	?>
	>5</option>

  </select>
   </p>



<p>
	<?php
	_e( 'Hide the Portfolio Page Intro Text?', 'lsp_text_domain' );
	?>
<br>
<select name="lsp-hide-intro-text">
  <option value="no" 
	<?php
	if ( $lsp_hide_intro_text != 'yes' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'No (recommended)', 'lsp_text_domain' );
	?>
</option>
  <option value="yes" 
	<?php
	if ( $lsp_hide_intro_text == 'yes' ) {
		echo 'selected';
	}
	?>
	>
	<?php
	_e( 'Yes', 'lsp_text_domain' );
	?>
</option>
</select></p>




  

<!--
  <p>
	<?php
		_e( 'Add States:', 'lsp_text_domain' );
	?>
	 <br>
  <input type="text" name="lsp-add-states9" value="
	<?php
		echo $lsp_add_states9;
	?>
	" size="40">-->

<p>
	<?php
		_e( "Up to how far away should we show projects / clients on a city's portfolio page (in miles)", 'lsp_text_domain' );
	?>
 <br>
  <select name="lsp-how-far0">
	  <option value="auto" 
	  <?php
		if ( $lsp_how_far0 == 'auto' || $lsp_how_far0 == '' ) {
			echo 'selected';
		}
		?>
		>
	<?php
		_e( 'auto-handle this (recommended)', 'lsp_text_domain' );
	?>
</option>
	  <option value="1000" 
	  <?php
		if ( $lsp_how_far0 == '90' ) {
			echo 'selected';
		}
		?>
		>1000</option>
	  <option value="300" 
	  <?php
		if ( $lsp_how_far0 == '50' ) {
			echo 'selected';
		}
		?>
		>300</option>
	  <option value="100" 
	  <?php
		if ( $lsp_how_far0 == '25' ) {
			echo 'selected';
		}
		?>
		>100</option>
	  <option value="50" 
	  <?php
		if ( $lsp_how_far0 == '15' ) {
			echo 'selected';
		}
		?>
		>50</option>
	  <option value="25" 
	  <?php
		if ( $lsp_how_far0 == '10' ) {
			echo 'selected';
		}
		?>
		>25</option>
	  <option value="10" 
	  <?php
		if ( $lsp_how_far0 == '5' ) {
			echo 'selected';
		}
		?>
		>10</option>
	  <option value="0" 
	  <?php
		if ( $lsp_how_far0 == '0' && $lsp_how_far0 != '' ) {
			echo 'selected';
		}
		?>
		>0 
	<?php
		_e( '(only shows same-city matches)', 'lsp_text_domain' );
	?>
</option>
	</select>
   </p>

	<?php
	global $plus;
	// echo "PLUS HERE" .$plus;
	if ( $plus ) :
		?>

  <p>
		<?php
		_e( 'Exclude Countries:', 'lsp_text_domain' );
		?>
	 <br>
	<input type="text" name="lsp-exclude-countries0" placeholder="
		<?php
		_e( 'English 2 letter country code(s), comma separate multiple', 'lsp_text_domain' );
		?>
	" value="
		<?php
		echo $lsp_exclude_countries0;
		?>
" size="40"></p>

  <p>
		<?php
		_e( 'Only These Countries:', 'lsp_text_domain' );
		?>
	 <br>
	<input type="text" name="lsp-add-countries0" placeholder="
		<?php
		_e( 'English 2 letter country code(s), comma separate multiple', 'lsp_text_domain' );
		?>
	" value="
		<?php
		echo $lsp_add_countries0;
		?>
" size="40"></p>

  <p>
		<?php
		_e( 'Project / Client Entry Headlines:', 'lsp_text_domain' );
		?>
	<br>
  <select name="lsp-hide-headlines0">
	<option value="tags" 
		<?php
		if ( $lsp_hide_headlines0 == 'tags' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Use Location + Service/Product Tags Used', 'lsp_text_domain' );
		?>
</option>
	<option value="title" 
		<?php
		if ( $lsp_hide_headlines0 == 'title' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Use The Title I Set', 'lsp_text_domain' );
		?>
</option>
	<option value="none" 
		<?php
		if ( $lsp_hide_headlines0 == 'none' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'No Headlines', 'lsp_text_domain' );
		?>
</option>
  </select>
  </p>




  
  <!--
  <p><b>
		<?php
		_e( 'Use smart settings? (requires premium version key -- helps to optimally rank your directory pages and avoid the not ranking, supplemental index -- https://en.wikipedia.org/wiki/Supplemental_Result)', 'lsp_text_domain' );
		?>
	</b><br>
  <select name="lsp-smart-settings0">
	<option value="yes" 
		<?php
		if ( $lsp_smart_settings0 == 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
</option>
	<option value="no" 
		<?php
		if ( $lsp_smart_settings0 != 'yes' ) {
			echo 'selected';
		}
		?>
	>
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
</option>
  </select></p>-->

  <p>
		<?php
		_e( 'Local Area Percent Focus', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-local-focus0" value="
		<?php
		echo $lsp_local_focus0;
		?>
	" size="40">



  <p>
		<?php
		_e( 'Home Country Percent Focus', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-country-focus0" value="
		<?php
		echo $lsp_country_focus0;
		?>
	" size="40">
  <br>

  <p>
		<?php
		_e( 'International Percent Focus', 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-state-focus0" value="
		<?php
		echo $lsp_state_focus0;
		?>
	" size="40">

  <font color='#aaaaaa'><br><br>
		<?php
		_e( 'The options below can help get more portfolio pages to rank. Alternatively, our premium version is going to be able to automatically and intelligently set these for you', 'lsp_text_domain' );
		?>
	</font>
 

  <p>
		<?php
		_e( "National Set City Population Minimum (for getting it's own portfolio page)", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-national-population-limit0" value="
		<?php
		echo $lsp_national_population_limit0;
		?>
	" size="40">

  <p>
		<?php
		_e( "International Set City Population Minimum (for getting it's own portfolio page):", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-international-population-limit0" value="
		<?php
		echo $lsp_international_population_limit0;
		?>
	" size="40">
</p>



  <p>
		<?php
		_e( "National Set City Population Maximum (for getting it's own portfolio page)", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-national-max-limit0" value="
		<?php
		echo $lsp_national_max_limit0;
		?>
	" size="40">

  <p>
		<?php
		_e( "International Set City Population Maximum (for getting it's own portfolio page):", 'lsp_text_domain' );
		?>
	 <br>
  <input type="text" name="lsp-international-max-limit0" value="
		<?php
		echo $lsp_international_max_limit0;
		?>
	" size="40">
</p>




		<?php
	endif;
	?>




	<?php
	global $plus;
	if ( $plus == 0 ) :
		?>
<br><br><a href="http://www.bestlocalseotools.com" target="_blank">
		<?php
		_e( 'Upgrade to Premium at bestlocalseotools.com', 'lsp_text_domain' );
		?>
</a> 
		<?php
		_e( 'to get the full version and unlock additional features.', 'lsp_text_domain' );
		?>
 
		<?php
	endif;
	?>

  </div></div>
  <br>
</span>
  
	<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>
  <a id="serviceslink3" href="
		<?php
		echo site_url();
		?>
	/wp-admin/post-new.php?post_type=localproject" target="_blank">
		<?php
		_e( '(after settings save) Fill Out Local Portfolio (at least 10-20 entries)', 'lsp_text_domain' );
		?>
</a>
  <br><?php endif; ?>
	<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>
<a href="#" id="reviewssetuplink"><u>
		<?php
		_e( 'Reputation Builder Settings', 'lsp_text_domain' );
		?>
  </a></u><br><?php endif; ?>
<span id="reviewssetupdiv" style="display:block;padding-left:20px">
<div id="feedbackdivnope" class="pformnope">
 
	  <?php
		if ( 1 ) :
			?>
<br>
			<?php _e( 'Quick & Easy URLs:', 'lsp_text_domain' ); ?>
<br>
			<?php echo '<a href=' . site_url() . '/getreviews' . " target='_blank'>" . site_url() . '/getreviews' . '</a> - '; ?>
			<?php _e( 'Your quick review-request URL for sending review requests out', 'lsp_text_domain' ); ?><br>
			<?php echo '<a href=' . site_url() . '/feedback' . " target='_blank'>" . site_url() . '/feedback' . '</a> - '; ?>
			<?php _e( 'Your Reputation Builder feedback form URL (works nice on a store sign, in verbal requests, or in the navigation menu)', 'lsp_text_domain' ); ?><br>
			<?php echo '<a href=' . site_url() . '/addproject' . " target='_blank'>" . site_url() . '/addproject' . '</a> - '; ?>
			<?php _e( 'Your quick add-a-project URL', 'lsp_text_domain' ); ?><br>
			<?php echo '<a href=' . site_url() . '/review' . " target='_blank'>" . site_url() . '/review' . '</a> - '; ?>
			<?php _e( 'Your quick direct review-request URL (redirects to reviews site #1)', 'lsp_text_domain' ); ?><br>
			<?php
			// _e('You can add one or more of these as a menu item on your website, or put it on a sign in your store, or easily verbally request that customers give you feedback at that URL. The "From" name on email is going to be set from the site title in your settings at Settings > General', 'lsp_text_domain');
			?>
<br>
  <b>
			<?php
			_e( 'Please set up your reviews sites & settings below:', 'lsp_text_domain' );
			?>
	</b>

  
  
<br>
  
  <p>
			<?php
			_e( 'Show Reviews Links to Feedback Givers with Minimum Amount of Stars', 'lsp_text_domain' );
			?>
	<br>
  
  <select name="lsp-star-minimum"> 
	<option value="4" 
			<?php
			if ( $lsp_star_minimum == '' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '4 (default)', 'lsp_text_domain' );
			?>
</option>
	<option value="1" 
			<?php
			if ( $lsp_star_minimum == '1' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '1', 'lsp_text_domain' );
			?>
</option>
	<option value="2" 
			<?php
			if ( $lsp_star_minimum == '2' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '2', 'lsp_text_domain' );
			?>
</option>
	<option value="3" 
			<?php
			if ( $lsp_star_minimum == '3' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '3', 'lsp_text_domain' );
			?>
</option>
	<option value="4" 
			<?php
			if ( $lsp_star_minimum == '4' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '4', 'lsp_text_domain' );
			?>
</option>
	<option value="5" 
			<?php
			if ( $lsp_star_minimum == '5' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '5', 'lsp_text_domain' );
			?>
</option>
  </select></p>


  <p>
			<?php
			_e( 'Auto-publish testimonials and publish reviews of at least this star rating?', 'lsp_text_domain' );
			?>
	<br>
	  <select name="lsp-testimonials-auto-publish">
		<option value="no" 
			<?php
			if ( $lsp_testimonials_auto_publish != 'yes' ) {
				echo 'selected';
			}
			?>
		>
			<?php
			_e( 'No', 'lsp_text_domain' );
			?>
</option>
		<option value="yes" 
			<?php
			if ( $lsp_testimonials_auto_publish == 'yes' ) {
				echo 'selected';
			}
			?>
		>
			<?php
			_e( 'Yes', 'lsp_text_domain' );
			?>
</option>
	  </select></p>


			<?php
			_e( "Reviews Site #1 Name (ie 'Google', 'Yelp', 'Facebook', etc.)", 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name" value="
			<?php
			echo $lsp_reviews_name;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #1', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url" value="
			<?php
			echo $lsp_reviews_url;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc" value="
			<?php
			echo $lsp_reviews_loc;
			?>
	" size="40">
  <br></span>

			<?php
			_e( 'Reviews Site #2 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name2" value="
			<?php
			echo $lsp_reviews_name2;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #2', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url2" value="
			<?php
			echo $lsp_reviews_url2;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc2" value="
			<?php
			echo $lsp_reviews_loc2;
			?>
	" size="40">
<br></span>

			<?php
			_e( 'Reviews Site #3', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name3" value="
			<?php
			echo $lsp_reviews_name3;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #3', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url3" value="
			<?php
			echo $lsp_reviews_url3;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc3" value="
			<?php
			echo $lsp_reviews_loc3;
			?>
	" size="40">
<br></span>


			<?php
			_e( 'Reviews Site #4 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name4" value="
			<?php
			echo $lsp_reviews_name4;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #4', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url4" value="
			<?php
			echo $lsp_reviews_url4;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc4" value="
			<?php
			echo $lsp_reviews_loc4;
			?>
	" size="40">
<br></span>

<a href="#" id="showMoreReviews">
			<?php
			_e( 'Add More Reviews Sites', 'lsp_text_domain' );
			?>
</a><br>
<div id="showMoreReviewsDiv">


			<?php
			_e( 'Reviews Site #5 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name5" value="
			<?php
			echo $lsp_reviews_name5;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #5', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url5" value="
			<?php
			echo $lsp_reviews_url5;
			?>
	" size="40">
<br>



<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc5" value="
			<?php
			echo $lsp_reviews_loc5;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #6 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name6" value="
			<?php
			echo $lsp_reviews_name6;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #6', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url6" value="
			<?php
			echo $lsp_reviews_url6;
			?>
	" size="40">
<br>



<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc6" value="
			<?php
			echo $lsp_reviews_loc6;
			?>
	" size="40">
<br></span>



			<?php
			_e( 'Reviews Site #7 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name7" value="
			<?php
			echo $lsp_reviews_name7;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #7', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url7" value="
			<?php
			echo $lsp_reviews_url7;
			?>
	" size="40">
<br>


<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc7" value="
			<?php
			echo $lsp_reviews_loc7;
			?>
	" size="40">
<br></span>


			<?php
			_e( 'Reviews Site #8 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name8" value="
			<?php
			echo $lsp_reviews_name8;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #8', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url8" value="
			<?php
			echo $lsp_reviews_url8;
			?>
	" size="40">
<br> 


<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc8" value="
			<?php
			echo $lsp_reviews_loc8;
			?>
	" size="40">
<br></span>


			<?php
			_e( 'Reviews Site #9 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name9" value="
			<?php
			echo $lsp_reviews_name9;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #9', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url9" value="
			<?php
			echo $lsp_reviews_url9;
			?>
	" size="40">
<br>


<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc9" value="
			<?php
			echo $lsp_reviews_loc9;
			?>
	" size="40">
<br></span>

			<?php
			_e( 'Reviews Site #10 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name10" value="
			<?php
			echo $lsp_reviews_name10;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #10', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url10" value="
			<?php
			echo $lsp_reviews_url10;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc10" value="
			<?php
			echo $lsp_reviews_loc10;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #11 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name11" value="
			<?php
			echo $lsp_reviews_name11;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #11', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url11" value="
			<?php
			echo $lsp_reviews_url11;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc11" value="
			<?php
			echo $lsp_reviews_loc11;
			?>
	" size="40">
<br></span>



			<?php
			_e( 'Reviews Site #12 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name12" value="
			<?php
			echo $lsp_reviews_name12;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #12', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url12" value="
			<?php
			echo $lsp_reviews_url12;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc12" value="
			<?php
			echo $lsp_reviews_loc12;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #13 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name13" value="
			<?php
			echo $lsp_reviews_name13;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #13', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url13" value="
			<?php
			echo $lsp_reviews_url13;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc13" value="
			<?php
			echo $lsp_reviews_loc13;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #14 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name14" value="
			<?php
			echo $lsp_reviews_name14;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #14', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url14" value="
			<?php
			echo $lsp_reviews_url14;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc14" value="
			<?php
			echo $lsp_reviews_loc14;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #15 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name15" value="
			<?php
			echo $lsp_reviews_name15;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #15', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url15" value="
			<?php
			echo $lsp_reviews_url15;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc15" value="
			<?php
			echo $lsp_reviews_loc15;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #16 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name16" value="
			<?php
			echo $lsp_reviews_name16;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #16', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url16" value="
			<?php
			echo $lsp_reviews_url16;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc16" value="
			<?php
			echo $lsp_reviews_loc16;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #17 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name17" value="
			<?php
			echo $lsp_reviews_name17;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #17', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url17" value="
			<?php
			echo $lsp_reviews_url17;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc17" value="
			<?php
			echo $lsp_reviews_loc17;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #18 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name18" value="
			<?php
			echo $lsp_reviews_name18;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #18', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url18" value="
			<?php
			echo $lsp_reviews_url18;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc18" value="
			<?php
			echo $lsp_reviews_loc18;
			?>
	" size="40">
<br></span>



			<?php
			_e( 'Reviews Site #19 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name19" value="
			<?php
			echo $lsp_reviews_name19;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #19', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url19" value="
			<?php
			echo $lsp_reviews_url19;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc19" value="
			<?php
			echo $lsp_reviews_loc19;
			?>
	" size="40">
<br></span>




			<?php
			_e( 'Reviews Site #20 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name20" value="
			<?php
			echo $lsp_reviews_name20;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #20', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url20" value="
			<?php
			echo $lsp_reviews_url20;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc20" value="
			<?php
			echo $lsp_reviews_loc20;
			?>
	" size="40">
<br></span>





			<?php
			_e( 'Reviews Site #21 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name21" value="
			<?php
			echo $lsp_reviews_name21;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #21', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url21" value="
			<?php
			echo $lsp_reviews_url21;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc21" value="
			<?php
			echo $lsp_reviews_loc21;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #22 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name22" value="
			<?php
			echo $lsp_reviews_name22;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #22', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url22" value="
			<?php
			echo $lsp_reviews_url22;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc22" value="
			<?php
			echo $lsp_reviews_loc22;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #23 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name23" value="
			<?php
			echo $lsp_reviews_name23;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #23', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url23" value="
			<?php
			echo $lsp_reviews_url23;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc23" value="
			<?php
			echo $lsp_reviews_loc23;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #24 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name24" value="
			<?php
			echo $lsp_reviews_name24;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #24', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url24" value="
			<?php
			echo $lsp_reviews_url24;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc24" value="
			<?php
			echo $lsp_reviews_loc24;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #25 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name25" value="
			<?php
			echo $lsp_reviews_name25;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #25', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url25" value="
			<?php
			echo $lsp_reviews_url25;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc25" value="
			<?php
			echo $lsp_reviews_loc25;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #26 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name26" value="
			<?php
			echo $lsp_reviews_name26;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #26', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url26" value="
			<?php
			echo $lsp_reviews_url26;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc26" value="
			<?php
			echo $lsp_reviews_loc26;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #27 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name27" value="
			<?php
			echo $lsp_reviews_name27;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #27', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url27" value="
			<?php
			echo $lsp_reviews_url27;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc27" value="
			<?php
			echo $lsp_reviews_loc27;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #28 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name28" value="
			<?php
			echo $lsp_reviews_name28;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #28', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url28" value="
			<?php
			echo $lsp_reviews_url28;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc28" value="
			<?php
			echo $lsp_reviews_loc28;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #29 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name29" value="
			<?php
			echo $lsp_reviews_name29;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #29', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url29" value="
			<?php
			echo $lsp_reviews_url29;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc29" value="
			<?php
			echo $lsp_reviews_loc29;
			?>
	" size="40">
<br></span>






			<?php
			_e( 'Reviews Site #30 Name', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-name30" value="
			<?php
			echo $lsp_reviews_name30;
			?>
	" size="40">
  <br>

			<?php
			_e( 'Your Profile URL at Reviews Site #30', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-reviews-url30" value="
			<?php
			echo $lsp_reviews_url30;
			?>
	" size="40">
<br>

<span class="storeLocation">
			<?php
			_e( 'for Store Location Named:', 'lsp_text_domain' );
			?>
 <br>
  <input type="text" name="lsp-reviews-loc30" value="
			<?php
			echo $lsp_reviews_loc30;
			?>
	" size="40">
<br></span>

  



</div>




<a href="#" id="showMoreReviewOptions">
			<?php
			_e( 'More Options', 'lsp_text_domain' );
			?>
</a><br>

<div id="moreReviewOptions">


			<?php
			_e( 'Captcha Question (optional -- this is to prevent spam)', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-captcha-question" value="
			<?php
			echo $lsp_captcha_question;
			?>
	" size="40">
<br>


			<?php
			_e( 'Captcha Answer (optional)', 'lsp_text_domain' );
			?>
			 <br>
  <input type="text" name="lsp-captcha-answer" value="
			<?php
			echo $lsp_captcha_answer;
			?>
	" size="40">
<br>



  </div>





  </div>  
  
  </span>

			<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>
  <a href='<?php echo site_url() . '/getreviews/'; ?>' target="_blank" id="keywordslink3"><?php _e( '(after settings save) Request Feedback / Generate Reviews', 'lsp_text_domain' ); ?></a> 
  <br><?php endif; ?>
<span id="kform3" style="display:block;padding-left:20px">
			<?php
			_e( 'In the free version, email requests (whose deliverability is less certain) can be sent from the', 'lsp_text_domain' );
			?>
			 <a href="
			<?php
			echo admin_url() . 'post-new.php?post_type=localproject';
			?>
" target="_blank">
			<?php
			_e( 'Add a Project / Testimonial', 'lsp_text_domain' );
			?>
</a> 
			<?php
			_e( 'screen.', 'lsp_text_domain' );
			?>
	  <br><br></span>
			<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>
  <a id="mapsboosterlink"><u>
				<?php
				_e( 'Maps Booster Settings', 'lsp_text_domain' );
				?>
			</u></a><br><?php endif; ?>
  <span id="mapsboosterdiv" style="display:block;padding-left:20px">

<input type="hidden" name="lsp-locationData1" id="lsp-locationData1" value="
			<?php
			echo $lsp_locationData1;
			?>
" size="30">

 <span class="location1" id="location1">
			<?php
			parse_str( lsp_get_option( 'lsp-locationData1' ), $term );
			?>

<p>
			<?php
			_e( 'Business Type (from schema.org):', 'lsp_text_domain' );
			?>
 <br>
<select name="lsp-addressType1">
<option value="">
			<?php
			_e( 'Please Select', 'lsp_text_domain' );
			?>
</option>
  <option value="AnimalShelter" 
			<?php
			if ( $term['lsp-addressType1'] == 'AnimalShelter' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Animal Shelter', 'lsp_text_domain' );
			?>
</option>
  <option value="AutomotiveBusiness" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutomotiveBusiness' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Automotive Business', 'lsp_text_domain' );
			?>
</option>
  <option value="AutoDealer" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutoDealer' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutoDealer', 'lsp_text_domain' );
			?>
</option>
  <option value="AutoPartsStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutoPartsStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutoPartsStore', 'lsp_text_domain' );
			?>
</option>
  <option value="AutoRental" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutoRental' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutoRental', 'lsp_text_domain' );
			?>
</option>
  <option value="AutoRepair" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutoRepair' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutoRepair', 'lsp_text_domain' );
			?>
</option>
  <option value="AutoWash" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutoWash' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutoWash', 'lsp_text_domain' );
			?>
</option>
  <option value="GasStation" 
			<?php
			if ( $term['lsp-addressType1'] == 'GasStation' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->GasStation', 'lsp_text_domain' );
			?>
</option>
  <option value="MotorcycleDealer" 
			<?php
			if ( $term['lsp-addressType1'] == 'MotorcycleDealer' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MotorcycleDealer', 'lsp_text_domain' );
			?>
</option>
  <option value="MotorcycleRepair" 
			<?php
			if ( $term['lsp-addressType1'] == 'MotorcycleRepair' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MotorcycleRepair', 'lsp_text_domain' );
			?>
</option>
  <option value="ChildCare" 
			<?php
			if ( $term['lsp-addressType1'] == 'ChildCare' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'ChildCare', 'lsp_text_domain' );
			?>
</option>
  <option value="Dentist" 
			<?php
			if ( $term['lsp-addressType1'] == 'Dentist' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Dentist', 'lsp_text_domain' );
			?>
</option>
  <option value="DryCleaningOrLaundry" 
			<?php
			if ( $term['lsp-addressType1'] == 'DryCleaningOrLaundry' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'DryCleaningOrLaundry', 'lsp_text_domain' );
			?>
</option>
  <option value="EmergencyService" 
			<?php
			if ( $term['lsp-addressType1'] == 'EmergencyService' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'EmergencyService', 'lsp_text_domain' );
			?>
</option>
  <option value="FireStation" 
			<?php
			if ( $term['lsp-addressType1'] == 'FireStation' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->FireStation', 'lsp_text_domain' );
			?>
</option>
  <option value="Hospital" 
			<?php
			if ( $term['lsp-addressType1'] == 'Hospital' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Hospital', 'lsp_text_domain' );
			?>
</option>
  <option value="PoliceStation" 
			<?php
			if ( $term['lsp-addressType1'] == 'PoliceStation' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->PoliceStation', 'lsp_text_domain' );
			?>
</option>
  <option value="EmploymentAgency" 
			<?php
			if ( $term['lsp-addressType1'] == 'EmploymentAgency' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'EmploymentAgency', 'lsp_text_domain' );
			?>
</option>
  <option value="EntertainmentBusiness" 
			<?php
			if ( $term['lsp-addressType1'] == 'EntertainmentBusiness' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'EntertainmentBusiness', 'lsp_text_domain' );
			?>
</option>
  <option value="AmusementPark" 
			<?php
			if ( $term['lsp-addressType1'] == 'AmusementPark' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AmusementPark', 'lsp_text_domain' );
			?>
</option>
  <option value="ArtGallery" 
			<?php
			if ( $term['lsp-addressType1'] == 'ArtGallery' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ArtGallery', 'lsp_text_domain' );
			?>
</option>
  <option value="ComedyClub" 
			<?php
			if ( $term['lsp-addressType1'] == 'ComedyClub' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ComedyClub', 'lsp_text_domain' );
			?>
</option>
  <option value="MovieTheater" 
			<?php
			if ( $term['lsp-addressType1'] == 'MovieTheater' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MovieTheater', 'lsp_text_domain' );
			?>
</option>
  <option value="NightClub" 
			<?php
			if ( $term['lsp-addressType1'] == 'NightClub' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->NightClub', 'lsp_text_domain' );
			?>
</option>
  <option value="FinancialService" 
			<?php
			if ( $term['lsp-addressType1'] == 'FinancialService' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'FinancialService', 'lsp_text_domain' );
			?>
</option>
  <option value="AccountingService" 
			<?php
			if ( $term['lsp-addressType1'] == 'AccountingService' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AccountingService', 'lsp_text_domain' );
			?>
</option>
  <option value="AutomatedTeller" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutomatedTeller' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutomatedTeller', 'lsp_text_domain' );
			?>
</option>
  <option value="BankOrCreditUnion" 
			<?php
			if ( $term['lsp-addressType1'] == 'BankOrCreditUnion' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BankOrCreditUnion', 'lsp_text_domain' );
			?>
</option>
  <option value="InsuranceAgency" 
			<?php
			if ( $term['lsp-addressType1'] == 'InsuranceAgency' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->InsuranceAgency', 'lsp_text_domain' );
			?>
</option>
  <option value="FoodEstablishment" 
			<?php
			if ( $term['lsp-addressType1'] == 'FoodEstablishment' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'FoodEstablishment', 'lsp_text_domain' );
			?>
</option>
  <option value="Bakery" 
			<?php
			if ( $term['lsp-addressType1'] == 'Bakery' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Bakery', 'lsp_text_domain' );
			?>
</option>
  <option value="BarOrPub" 
			<?php
			if ( $term['lsp-addressType1'] == 'BarOrPub' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BarOrPub', 'lsp_text_domain' );
			?>
</option>
  <option value="Brewery" 
			<?php
			if ( $term['lsp-addressType1'] == 'Brewery' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Brewery', 'lsp_text_domain' );
			?>
</option>
  <option value="CafeOrCoffeeShop" 
			<?php
			if ( $term['lsp-addressType1'] == 'CafeOrCoffeeShop' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->CafeOrCoffeeShop', 'lsp_text_domain' );
			?>
</option>
  <option value="FastFoodRestaurant" 
			<?php
			if ( $term['lsp-addressType1'] == 'FastFoodRestaurant' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->FastFoodRestaurant', 'lsp_text_domain' );
			?>
</option>
  <option value="IceCreamShop" 
			<?php
			if ( $term['lsp-addressType1'] == 'IceCreamShop' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->IceCreamShop', 'lsp_text_domain' );
			?>
</option>
  <option value="Restaurant" 
			<?php
			if ( $term['lsp-addressType1'] == 'Restaurant' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Restaurant', 'lsp_text_domain' );
			?>
</option>
  <option value="Winery" 
			<?php
			if ( $term['lsp-addressType1'] == 'Winery' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Winery', 'lsp_text_domain' );
			?>
</option>
  <option value="GovernmentOffice" 
			<?php
			if ( $term['lsp-addressType1'] == 'GovernmentOffice' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'GovernmentOffice', 'lsp_text_domain' );
			?>
</option>
  <option value="PostOffice" 
			<?php
			if ( $term['lsp-addressType1'] == 'PostOffice' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->PostOffice', 'lsp_text_domain' );
			?>
</option>
  <option value="HealthAndBeautyBusiness" 
			<?php
			if ( $term['lsp-addressType1'] == 'HealthAndBeautyBusiness' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'HealthAndBeautyBusiness', 'lsp_text_domain' );
			?>
</option>
  <option value="BeautySalon" 
			<?php
			if ( $term['lsp-addressType1'] == 'BeautySalon' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BeautySalon', 'lsp_text_domain' );
			?>
</option>
  <option value="DaySpa" 
			<?php
			if ( $term['lsp-addressType1'] == 'DaySpa' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->DaySpa', 'lsp_text_domain' );
			?>
</option>
  <option value="HairSalon" 
			<?php
			if ( $term['lsp-addressType1'] == 'HairSalon' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HairSalon', 'lsp_text_domain' );
			?>
</option>
  <option value="HealthClub" 
			<?php
			if ( $term['lsp-addressType1'] == 'HealthClub' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HealthClub', 'lsp_text_domain' );
			?>
</option>
  <option value="NailSalon" 
			<?php
			if ( $term['lsp-addressType1'] == 'NailSalon' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->NailSalon', 'lsp_text_domain' );
			?>
</option>
  <option value="TattooParlor" 
			<?php
			if ( $term['lsp-addressType1'] == 'TattooParlor' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->TattooParlor', 'lsp_text_domain' );
			?>
</option>
  <option value="HomeAndConstructionBusiness" 
			<?php
			if ( $term['lsp-addressType1'] == 'HomeAndConstructionBusiness' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'HomeAndConstructionBusiness', 'lsp_text_domain' );
			?>
</option>
  <option value="Electrician" 
			<?php
			if ( $term['lsp-addressType1'] == 'Electrician' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Electrician', 'lsp_text_domain' );
			?>
</option>
  <option value="GeneralContractor" 
			<?php
			if ( $term['lsp-addressType1'] == 'GeneralContractor' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->GeneralContractor', 'lsp_text_domain' );
			?>
</option>
  <option value="HVACBusiness" 
			<?php
			if ( $term['lsp-addressType1'] == 'HVACBusiness' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HVACBusiness', 'lsp_text_domain' );
			?>
</option>
  <option value="HousePainter" 
			<?php
			if ( $term['lsp-addressType1'] == 'HousePainter' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HousePainter', 'lsp_text_domain' );
			?>
</option>
  <option value="Locksmith" 
			<?php
			if ( $term['lsp-addressType1'] == 'Locksmith' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Locksmith', 'lsp_text_domain' );
			?>
</option>
  <option value="MovingCompany" 
			<?php
			if ( $term['lsp-addressType1'] == 'MovingCompany' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MovingCompany', 'lsp_text_domain' );
			?>
</option>
  <option value="Plumber" 
			<?php
			if ( $term['lsp-addressType1'] == 'Plumber' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Plumber', 'lsp_text_domain' );
			?>
</option>
  <option value="RoofingContractor" 
			<?php
			if ( $term['lsp-addressType1'] == 'RoofingContractor' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->RoofingContractor', 'lsp_text_domain' );
			?>
</option>
  <option value="InternetCafe" 
			<?php
			if ( $term['lsp-addressType1'] == 'InternetCafe' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'InternetCafe', 'lsp_text_domain' );
			?>
</option>
  <option value="LegalService" 
			<?php
			if ( $term['lsp-addressType1'] == 'LegalService' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'LegalService', 'lsp_text_domain' );
			?>
</option>
  <option value="Attorney" 
			<?php
			if ( $term['lsp-addressType1'] == 'Attorney' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Attorney', 'lsp_text_domain' );
			?>
</option>
  <option value="Notary" 
			<?php
			if ( $term['lsp-addressType1'] == 'Notary' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Notary', 'lsp_text_domain' );
			?>
</option>
  <option value="Library" 
			<?php
			if ( $term['lsp-addressType1'] == 'Library' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Library', 'lsp_text_domain' );
			?>
</option>
  <option value="LodgingBusiness" 
			<?php
			if ( $term['lsp-addressType1'] == 'LodgingBusiness' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'LodgingBusiness', 'lsp_text_domain' );
			?>
</option>
  <option value="BedAndBreakfast" 
			<?php
			if ( $term['lsp-addressType1'] == 'BedAndBreakfast' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BedAndBreakfast', 'lsp_text_domain' );
			?>
</option>
  <option value="Campground" 
			<?php
			if ( $term['lsp-addressType1'] == 'Campground' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Campground', 'lsp_text_domain' );
			?>
</option>
  <option value="Hostel" 
			<?php
			if ( $term['lsp-addressType1'] == 'Hostel' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Hostel', 'lsp_text_domain' );
			?>
</option>
  <option value="Hotel" 
			<?php
			if ( $term['lsp-addressType1'] == 'Hotel' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Hotel', 'lsp_text_domain' );
			?>
</option>
  <option value="Motel" 
			<?php
			if ( $term['lsp-addressType1'] == 'Motel' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Motel', 'lsp_text_domain' );
			?>
</option>
  <option value="Resort" 
			<?php
			if ( $term['lsp-addressType1'] == 'Resort' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Resort', 'lsp_text_domain' );
			?>
</option>
  <option value="ProfessionalService" 
			<?php
			if ( $term['lsp-addressType1'] == 'ProfessionalService' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'ProfessionalService', 'lsp_text_domain' );
			?>
</option>
  <option value="RadioStation" 
			<?php
			if ( $term['lsp-addressType1'] == 'RadioStation' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'RadioStation', 'lsp_text_domain' );
			?>
</option>
  <option value="RealEstateAgent" 
			<?php
			if ( $term['lsp-addressType1'] == 'RealEstateAgent' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'RealEstateAgent', 'lsp_text_domain' );
			?>
</option>
  <option value="RecyclingCenter" 
			<?php
			if ( $term['lsp-addressType1'] == 'RecyclingCenter' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'RecyclingCenter', 'lsp_text_domain' );
			?>
</option>
  <option value="SelfStorage" 
			<?php
			if ( $term['lsp-addressType1'] == 'SelfStorage' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'SelfStorage', 'lsp_text_domain' );
			?>
</option>
  <option value="ShoppingCenter" 
			<?php
			if ( $term['lsp-addressType1'] == 'ShoppingCenter' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'ShoppingCenter', 'lsp_text_domain' );
			?>
</option>
  <option value="SportsActivityLocation" 
			<?php
			if ( $term['lsp-addressType1'] == 'SportsActivityLocation' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'SportsActivityLocation', 'lsp_text_domain' );
			?>
</option>
  <option value="BowlingAlley" 
			<?php
			if ( $term['lsp-addressType1'] == 'BowlingAlley' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BowlingAlley', 'lsp_text_domain' );
			?>
</option>
  <option value="ExerciseGym" 
			<?php
			if ( $term['lsp-addressType1'] == 'ExerciseGym' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ExerciseGym', 'lsp_text_domain' );
			?>
</option>
  <option value="GolfCourse" 
			<?php
			if ( $term['lsp-addressType1'] == 'GolfCourse' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->GolfCourse', 'lsp_text_domain' );
			?>
</option>
  <option value="HealthClub" 
			<?php
			if ( $term['lsp-addressType1'] == 'HealthClub' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HealthClub', 'lsp_text_domain' );
			?>
</option>
  <option value="PublicSwimmingPool" 
			<?php
			if ( $term['lsp-addressType1'] == 'PublicSwimmingPool' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->PublicSwimmingPool', 'lsp_text_domain' );
			?>
</option>
  <option value="SkiResort" 
			<?php
			if ( $term['lsp-addressType1'] == 'SkiResort' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->SkiResort', 'lsp_text_domain' );
			?>
</option>
  <option value="SportsClub" 
			<?php
			if ( $term['lsp-addressType1'] == 'SportsClub' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->SportsClub', 'lsp_text_domain' );
			?>
</option>
  <option value="StadiumOrArena" 
			<?php
			if ( $term['lsp-addressType1'] == 'StadiumOrArena' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->StadiumOrArena', 'lsp_text_domain' );
			?>
</option>
  <option value="TennisComplex" 
			<?php
			if ( $term['lsp-addressType1'] == 'TennisComplex' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->TennisComplex', 'lsp_text_domain' );
			?>
</option>
  <option value="Store" 
			<?php
			if ( $term['lsp-addressType1'] == 'Store' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Store', 'lsp_text_domain' );
			?>
</option>
  <option value="AutoPartsStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'AutoPartsStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->AutoPartsStore', 'lsp_text_domain' );
			?>
</option>
  <option value="BikeStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'BikeStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BikeStore', 'lsp_text_domain' );
			?>
</option>
  <option value="BookStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'BookStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->BookStore', 'lsp_text_domain' );
			?>
</option>
  <option value="ClothingStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'ClothingStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ClothingStore', 'lsp_text_domain' );
			?>
</option>
  <option value="ComputerStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'ComputerStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ComputerStore', 'lsp_text_domain' );
			?>
</option>
  <option value="ConvenienceStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'ConvenienceStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ConvenienceStore', 'lsp_text_domain' );
			?>
</option>
  <option value="DepartmentStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'DepartmentStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->DepartmentStore', 'lsp_text_domain' );
			?>
</option>
  <option value="ElectronicsStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'ElectronicsStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ElectronicsStore', 'lsp_text_domain' );
			?>
</option>
  <option value="Florist" 
			<?php
			if ( $term['lsp-addressType1'] == 'Florist' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->Florist', 'lsp_text_domain' );
			?>
</option>
  <option value="FurnitureStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'FurnitureStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->FurnitureStore', 'lsp_text_domain' );
			?>
</option>
  <option value="GardenStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'GardenStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->GardenStore', 'lsp_text_domain' );
			?>
</option>
  <option value="GroceryStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'GroceryStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->GroceryStore', 'lsp_text_domain' );
			?>
</option>
  <option value="HardwareStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'HardwareStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HardwareStore', 'lsp_text_domain' );
			?>
</option>
  <option value="HobbyShop" 
			<?php
			if ( $term['lsp-addressType1'] == 'HobbyShop' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HobbyShop', 'lsp_text_domain' );
			?>
</option>
  <option value="HomeGoodsStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'HomeGoodsStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->HomeGoodsStore', 'lsp_text_domain' );
			?>
</option>
  <option value="JewelryStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'JewelryStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->JewelryStore', 'lsp_text_domain' );
			?>
</option>
  <option value="LiquorStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'LiquorStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->LiquorStore', 'lsp_text_domain' );
			?>
</option>
  <option value="MensClothingStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'MensClothingStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MensClothingStore', 'lsp_text_domain' );
			?>
</option>
  <option value="MovieRentalStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'MovieRentalStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MovieRentalStore', 'lsp_text_domain' );
			?>
</option>
  <option value="MusicStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'MusicStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->MusicStore', 'lsp_text_domain' );
			?>
</option>
  <option value="OfficeEquipmentStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'OfficeEquipmentStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->OfficeEquipmentStore', 'lsp_text_domain' );
			?>
</option>
  <option value="OutletStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'OutletStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->OutletStore', 'lsp_text_domain' );
			?>
</option>
  <option value="PawnShop" 
			<?php
			if ( $term['lsp-addressType1'] == 'PawnShop' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->PawnShop', 'lsp_text_domain' );
			?>
</option>
  <option value="PetStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'PetStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->PetStore', 'lsp_text_domain' );
			?>
</option>
  <option value="ShoeStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'ShoeStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ShoeStore', 'lsp_text_domain' );
			?>
</option>
  <option value="SportingGoodsStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'SportingGoodsStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->SportingGoodsStore', 'lsp_text_domain' );
			?>
</option>
  <option value="TireShop" 
			<?php
			if ( $term['lsp-addressType1'] == 'TireShop' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->TireShop', 'lsp_text_domain' );
			?>
</option>
  <option value="ToyStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'ToyStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->ToyStore', 'lsp_text_domain' );
			?>
</option>
  <option value="WholesaleStore" 
			<?php
			if ( $term['lsp-addressType1'] == 'WholesaleStore' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( '->WholesaleStore', 'lsp_text_domain' );
			?>
</option>
  <option value="TelevisionStation" 
			<?php
			if ( $term['lsp-addressType1'] == 'TelevisionStation' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'TelevisionStation', 'lsp_text_domain' );
			?>
</option>
  <option value="TouristInformationCenter" 
			<?php
			if ( $term['lsp-addressType1'] == 'TouristInformationCenter' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'TouristInformationCenter', 'lsp_text_domain' );
			?>
</option>
  <option value="TravelAgency" 
			<?php
			if ( $term['lsp-addressType1'] == 'TravelAgency' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'TravelAgency', 'lsp_text_domain' );
			?>
</option>
</select>

<br>
			<?php
			_e( 'Business / Location Name:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressName1" value="
			<?php
			echo $term['lsp-addressName1'];
			?>
" size="40">
<br>
			<?php
			_e( 'Location Website URL:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressURL1" value="
			<?php
			echo $term['lsp-addressURL1'];
			?>
" size="40">
<br>
			<?php
			_e( 'Business Street Address:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-address1" value="
			<?php
			echo $term['lsp-address1'];
			?>
" size="40">
<br>
			<?php
			_e( 'City:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressLocality1" id="city1" value="
			<?php
			echo $term['lsp-addressLocality1'];
			?>
" size="40">
<br>
			<?php
			_e( 'State / Region (Full State Name):', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressRegion1" id="state1" value="
			<?php
			echo $term['lsp-addressRegion1'];
			?>
" size="40">
<br>
			<?php
			_e( 'Postal Code:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-postalCode1" value="
			<?php
			echo $term['lsp-postalCode1'];
			?>
" size="40">
<br>
			<?php
			_e( '2-character Country Code:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressCountry1" id="country1" placeholder="US" value="
			<?php
			echo $term['lsp-addressCountry1'];
			?>
" size="40">
<br>
			<?php
			_e( 'Phone Number:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressTelephone1" value="
			<?php
			echo $term['lsp-addressTelephone1'];
			?>
" size="40">
<br>
			<?php
			_e( 'Business Logo Image URL:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressImageURL1" value="
			<?php
			echo $term['lsp-addressImageURL1'];
			?>
" size="40">
<br>
			<?php
			_e( 'Business Image URL:', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressBusinessImageURL1" value="
			<?php
			echo $term['lsp-addressBusinessImageURL1'];
			?>
" size="40">

<br>

			<?php
			_e( 'Location URL (if left blank, will be set to home page -- each location must have its own):', 'lsp_text_domain' );
			?>
			 <br>
<input type="text" name="lsp-addressIDURL1" value="
			<?php
			echo $term['lsp-addressIDURL1'];
			?>
" size="40">
<br>


<!--
 <input type="text" class="dateSelector" name="lsp-locationDate1" value="
			<?php
			echo $term['lsp-locationDate1'];
			?>
	" size="12"> 
			<?php
			_e( ' - ', 'lsp_text_domain' );
			?>
 <input type="text" name="lsp-locationDate2" class="dateSelector" value="
			<?php
			echo $term['lsp-locationDate2'];
			?>
	" size="12">
-->
</p>
	


</span>





















  

  </span>
			<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>
	<a id="blogboosterlink"><u>
				<?php
				_e( 'Posts Ranking Booster Settings (for blogs with lots of posts)', 'lsp_text_domain' );
				?>
			</u></a><br><?php endif; ?>
  <span id="blogboosterdiv" style="display:block;padding-left:20px">
<p>

			<?php
			_e( 'Link to the Featured Posts Archive from the Widget? ', 'lsp_text_domain' );
			?>
			 <br>
   <select name="lsp-widgetlink">
	<option value="yes" 
			<?php
			if ( $lsp_widgetlink == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Yes', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_widgetlink == 'no' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'No', 'lsp_text_domain' );
			?>
</option>
  </select>
<br>


			<?php
			global $plus;
			if ( $plus ) :
				?>
  <p>
				<?php
				_e( 'Post type slugs to include in the featured posts archive:', 'lsp_text_domain' );
				?>
	 <br>
	<input type="text" placeholder="
				<?php
				_e( '(comma separated slug names)', 'lsp_text_domain' );
				?>
	" name="lsp-archive-types" value="
				<?php
				echo $lsp_archive_types;
				?>
" size="40"></p>
				<?php
		endif;
			?>


			<?php
			_e( 'Link to the Hot Products Archive from the Hot Products Widget? ', 'lsp_text_domain' );
			?>
			 <br>
   <select name="lsp-widgetlinkproducts">
	<option value="yes" 
			<?php
			if ( $lsp_widgetlinkproducts == 'yes' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Yes', 'lsp_text_domain' );
			?>
</option>
	<option value="no" 
			<?php
			if ( $lsp_widgetlinkproducts == 'no' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'No', 'lsp_text_domain' );
			?>
</option>
  </select>

</p>


  </span>






<!--
<a id="splittestslink"><u><?php _e( 'A/B Tests Settings & Defaults', 'lsp_text_domain' ); ?></u></a><br><br> -->
  <span id="splittestsdiv">

			<?php _e( 'Focus SEO on ', 'lsp_text_domain' ); ?> 
<select name="lsp-success" id="lsp-success">
	<option value="conversions" 
			<?php
			if ( $lsp_success == 'conversions' ) {
				echo 'selected';}
			?>
			><?php _e( 'Conversions (with Pageviews as Tiebreaker)', 'lsp_text_domain' ); ?></option>
	<option value="pageviews" 
			<?php
			if ( $lsp_success == 'pageviews' ) {
				echo 'selected';}
			?>
			><?php _e( 'Pageviews from SEO', 'lsp_text_domain' ); ?></option>
	<option value="both" 
			<?php
			if ( $lsp_success == 'both' ) {
				echo 'selected';}
			?>
			><?php _e( 'Both Conversions & Pageviews from SEO to Maximize Value Per My Settings', 'lsp_text_domain' ); ?></option>
  </select>
<br>

<!--
			<?php _e( 'Focus on conversions (the rest is focused on pageviews)', 'lsp_text_domain' ); ?> <input type="text" name="lsp-focus-percent" placeholder="<?php _e( '100', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_focus_percent; ?>" size="5">%
-->

	<p><?php _e( 'Conversion URL & Value:', 'lsp_text_domain' ); ?> <br>
<input type="text" name="lsp-conversion-url" placeholder="<?php _e( 'Conversion URL', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_conversion_url; ?>" size="40">
 $<input type="text" name="lsp-conversion-value" placeholder="<?php _e( 'value', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_conversion_value; ?>" size="7"><br>

			<?php _e( 'Conversion URL 2 & Value:', 'lsp_text_domain' ); ?> <br>
<input type="text" name="lsp-conversion-url2" placeholder="<?php _e( 'Conversion URL', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_conversion_url2; ?>" size="40">
 $<input type="text" name="lsp-conversion-value2" placeholder="<?php _e( 'value', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_conversion_value2; ?>" size="7"><br>

			<?php _e( 'Conversion URL 3 & Value:', 'lsp_text_domain' ); ?> <br>
<input type="text" name="lsp-conversion-url3" placeholder="<?php _e( 'Conversion URL', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_conversion_url3; ?>" size="40">
 $<input type="text" name="lsp-conversion-value3" placeholder="<?php _e( 'value', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_conversion_value3; ?>" size="7"><br>
			<?php _e( 'CPM (for Bloggers / Media Companies):', 'lsp_text_domain' ); ?> <br>
$<input type="text" name="lsp-cpm" placeholder="<?php _e( 'CPM', 'lsp_text_domain' ); ?>" value="<?php echo $lsp_cpm; ?>" size="7"><br>


			<?php _e( 'SEO A/B titles tests defaults - start optimizing posts that are', 'lsp_text_domain' ); ?> <input type="text" name="lsp-split1" value="<?php echo $lsp_split1; ?>" size="5"> <?php _e( 'days and older and test them for', 'lsp_text_domain' ); ?> <input type="text" name="lsp-split2" value="<?php echo $lsp_split2; ?>" size="5"> <?php _e( 'days per variation', 'lsp_text_domain' ); ?>.
<br>
			<?php _e( 'Wait', 'lsp_text_domain' ); ?> <input type="text" name="lsp-split3" value="<?php echo $lsp_split3; ?>" size="5"> <?php _e( "days to gain baseline data. Don't optimize posts with at least", 'lsp_text_domain' ); ?> <input type="text" name="lsp-split4" value="<?php echo $lsp_split4; ?>" size="5"> <?php _e( 'SEO visits per month', 'lsp_text_domain' ); ?>.
<br>

			<?php _e( 'Only try this on posts ID#', 'lsp_text_domain' ); ?> <input type="text" name="lsp-split5" value="<?php echo $lsp_split5; ?>" size="5"> <?php _e( 'to', 'lsp_text_domain' ); ?> <input type="text" name="lsp-split6" value="<?php echo $lsp_split6; ?>" size="5">.
<br>
			<?php _e( 'Start optimizing on', 'lsp_text_domain' ); ?> 


<select name="lsp-newerolder">
	<option value="newer" 
			<?php
			if ( $lsp_newerolder == 'newer' ) {
				echo 'selected';}
			?>
			><?php _e( 'Newer', 'lsp_text_domain' ); ?></option>
	<option value="older" 
			<?php
			if ( $lsp_newerolder == 'older' ) {
				echo 'selected';}
			?>
			><?php _e( 'Older', 'lsp_text_domain' ); ?></option>
  </select>
			<?php _e( 'posts', 'lsp_text_domain' ); ?>.
<br>
			<?php _e( 'I have approximately', 'lsp_text_domain' ); ?> <input type="text" name="lsp-split7" value="<?php echo $lsp_split7; ?>" size="5"> <?php _e( 'pages / posts on my site', 'lsp_text_domain' ); ?>.
-->
</p>

</span>








 
  </div>

  </span>



<div class="lsp-advanced2">

  </div>

  </div>

<div id="kform3old" class="pform">
<br>
			<?php
			_e( 'In the free version, email requests (whose deliverability is less certain) can be sent from the', 'lsp_text_domain' );
			?>
			 <a href="
			<?php
			echo admin_url() . 'post-new.php?post_type=localproject';
			?>
" target="_blank">
			<?php
			_e( 'Add a Project / Testimonial', 'lsp_text_domain' );
			?>
</a> 
			<?php
			_e( 'screen.', 'lsp_text_domain' );
			?>
</div>





  
<!--
	<option value="yes2" 
			<?php
			if ( $lsp_auto_adjust == 'yes2' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Yes - But Only Content I Have Not Uniquely Optimized', 'lsp_text_domain' );
			?>
</option>
	<option value="suggestions" 
			<?php
			if ( $lsp_auto_adjust == 'suggestions' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Only Show Me the Suggestions Where I Have Not Optimized', 'lsp_text_domain' );
			?>
</option>
	<option value="suggestions2" 
			<?php
			if ( $lsp_auto_adjust == 'suggestions2' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Only Show Me the Suggestions Where I Have Not Marked', 'lsp_text_domain' );
			?>
</option>
	<option value="suggestions3" 
			<?php
			if ( $lsp_auto_adjust == 'suggestions3' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Only Show Me the Suggestions Where I Have Marked', 'lsp_text_domain' );
			?>
</option>
	<option value="suggestions4" 
			<?php
			if ( $lsp_auto_adjust == 'suggestions4' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Show Me the Suggestions For My Entire Site', 'lsp_text_domain' );
			?>
</option>
	<option value="yes3" 
			<?php
			if ( $lsp_auto_adjust == 'yes3' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Yes - But Only Content I Have Not Marked', 'lsp_text_domain' );
			?>
</option>
	<option value="yes4" 
			<?php
			if ( $lsp_auto_adjust == 'yes4' ) {
				echo 'selected';
			}
			?>
	>
			<?php
			_e( 'Yes - But Only Content I Have Marked', 'lsp_text_domain' );
			?>
</option>

  </select></p>  -->



<!--
  Yes / No / Yes, but not my theme img alts / (Hidden) Yes, But Use Yoast Settings For Posts Where I
  Have Them
  Override Image Alts - Yes / No
  ??? Internal Links - Yes / No
  (hidden) Overwrite Focus Keywords? - Yes / No

  URLs - Yes / No 
  Alts - Yes / No / Yes, Only Where Lacking
  Theme Alts - Yes / No / Yes, Only Where Lacking
  
  Titles - Yes / No / (hidden) Use Yoast Post Titles
  Meta Descriptions - Yes / No / (hidden) Use Yoast Post Descriptions
  (hidden) Auto-Set Recommended Yoast Focus Terms - No / Yes / Only Where I have not set

	<p>
			<?php
			_e( "Your Site's Moz Rank (used to auto-adjust settings, findable at http://opensiteexplorer.org):", 'lsp_text_domain' );
			?>
	 <br>
  <input type="text" name="lsp-mozrank" value="
			<?php
			echo $lsp_mozrank;
			?>
	" size="40">
-->

</div>





<div id="kform" class="pform">




			<?php
			global $plus;

			if ( $plus == 0 ) :
				?>



<br><a href="http://www.bestlocalseotools.com" target="_blank">
				<?php
				_e( 'Upgrade to Premium at bestlocalseotools.com', 'lsp_text_domain' );
				?>
</a> 
				<?php
				_e( 'to get the full version and unlock additional features.', 'lsp_text_domain' );
				?>
 


				<?php
	endif;
			?>
 <span class="scores" id="score1"><b>
			<?php
			_e( "Additional / Suggested Keywords -- adding / rating these can help improve your site's automatic SEO", 'lsp_text_domain' );
			?>
	</b><br>
  


</div>

<br>
<?php endif; ?>
  <hr />

  <p class="submit">
	<?php wp_nonce_field( 'lsp-check', 'lsp-nonce' ); ?>
  <input type="submit" name="Submit" class="button-primary" id="submitter" value="
	<?php
	esc_attr_e( 'Save and Continue >>', 'lsp_text_domain' );
	?>
	" />
  </p>

  </form>


  </div>


	<?php
}


// for making a menu item
function lsp_tutorial() { }

// for making a menu item
function lsp_premium() { }


add_action( 'admin_menu', 'lsp_cpt_settings_menu' );
function lsp_cpt_settings_menu() {
	add_submenu_page( 'edit.php?post_type=localproject', __( 'Settings / Setup', 'lsp_text_domain' ), __( 'Settings / Setup', 'lsp_text_domain' ), 'edit_posts', basename( __FILE__ ), 'lsp_options' );
}

add_action( 'admin_menu', 'lsp_options2' );
function lsp_options2() {
	add_submenu_page( 'edit.php?post_type=localproject', __( 'Reports', 'lsp_text_domain' ), __( 'Reports', 'lsp_text_domain' ), 'edit_posts', basename( __FILE__ ), 'lsp_options' );
}

add_action( 'admin_menu', 'lsp_upgrade_to_premium' );
function lsp_upgrade_to_premium() {
	 add_submenu_page( 'edit.php?post_type=localproject', __( 'Upgrade to Premium', 'lsp_text_domain' ), __( 'Upgrade to Premium', 'lsp_text_domain' ), 'edit_posts', basename( __FILE__ ), 'lsp_premium' );
}

add_action( 'admin_menu', 'lsp_pro_tips_menu' );
function lsp_pro_tips_menu() {
	add_submenu_page( 'edit.php?post_type=localproject', __( 'Pro Tips', 'lsp_text_domain' ), __( 'Pro Tips', 'lsp_text_domain' ), 'edit_posts', basename( __FILE__ ), 'lsp_pro_tips' );
}

add_action( 'admin_menu', 'lsp_tutorial_menu' );
function lsp_tutorial_menu() {
	add_submenu_page( 'edit.php?post_type=localproject', __( 'Tutorial', 'lsp_text_domain' ), __( 'Tutorial', 'lsp_text_domain' ), 'edit_posts', basename( __FILE__ ), 'lsp_tutorial' );
}

// for making a menu item
function lsp_pro_tips() {
}

function lsp_activate() {
	// credits link defaults to off
	update_option( 'lsp-sig', 'no' );

	if ( lsp_get_option( 'lsp-split1' ) == '' ) {
		update_option( 'lsp-split1', '60', 'yes' );
	}
	if ( lsp_get_option( 'lsp-split2' ) == '' ) {
		update_option( 'lsp-split2', '30', 'yes' );
	}
	if ( lsp_get_option( 'lsp-split3' ) == '' ) {
		update_option( 'lsp-split3', '30', 'yes' );
	}
	if ( lsp_get_option( 'lsp-split4' ) == '' ) {
		update_option( 'lsp-split4', '1', 'yes' );
	}

	if ( lsp_get_option( 'lsp-locationData1' ) == '' ) {
		update_option( 'lsp-locationData1', 'placeholdertemp=yes' );
	}
	update_option( 'lsp-activated', 'yes' );

	if ( lsp_get_option( 'lsp-percent' ) == '' ) {
		update_option( 'lsp-percent', '100', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent2' ) == '' ) {
		update_option( 'lsp-percent2', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent3' ) == '' ) {
		update_option( 'lsp-percent3', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent4' ) == '' ) {
		update_option( 'lsp-percent4', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent5' ) == '' ) {
		update_option( 'lsp-percent5', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent6' ) == '' ) {
		update_option( 'lsp-percent6', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent7' ) == '' ) {
		update_option( 'lsp-percent7', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent8' ) == '' ) {
		update_option( 'lsp-percent8', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent9' ) == '' ) {
		update_option( 'lsp-percent9', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-percent10' ) == '' ) {
		update_option( 'lsp-percent10', '0', 'yes' );
	}
	if ( lsp_get_option( 'lsp-alt-filter-all' ) == '' ) {
		update_option( 'lsp-alt-filter-all', 'yes', 'yes' );
	}

	if ( lsp_get_option( 'lsp-email-title' ) == '' ) {
		update_option( 'lsp-email-title', get_bloginfo( 'name' ) . __( ' would like your feedback!', 'lsp_text_domain' ) );
	}
	if ( lsp_get_option( 'lsp-email-message' ) == '' ) {
		update_option( 'lsp-email-message', __( 'Would you please give us your feedback about your experience with us at ', 'lsp_text_domain' ) . get_bloginfo( 'url' ) . "/feedback ?\n\nThanks,\n\n" . get_bloginfo( 'name' ) );
	}

	add_option( 'Activated_Plugin', 'localseoportfolio' );
	global $wpdb;
	global $title_string;
	global $title_string2;
	global $title_string3;
	update_option( 'lsp-title-string', $title_string );
	update_option( 'lsp-title-string2', $title_string2 );
	update_option( 'lsp-title-string3', $title_string3 );

	if ( lsp_get_option( 'lsp-title-string' ) ) {
		if ( lsp_get_option( 'lsp-national-population-limit' ) == '' ) {
			update_option( 'lsp-national-population-limit', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit' ) == '' ) {
			update_option( 'lsp-international-population-limit', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit2' ) == '' ) {
			update_option( 'lsp-national-population-limit2', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit2' ) == '' ) {
			update_option( 'lsp-international-population-limit2', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit3' ) == '' ) {
			update_option( 'lsp-national-population-limit3', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit3' ) == '' ) {
			update_option( 'lsp-international-population-limit3', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit4' ) == '' ) {
			update_option( 'lsp-national-population-limit4', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit4' ) == '' ) {
			update_option( 'lsp-international-population-limit4', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit5' ) == '' ) {
			update_option( 'lsp-national-population-limit5', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit5' ) == '' ) {
			update_option( 'lsp-international-population-limit5', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit6' ) == '' ) {
			update_option( 'lsp-national-population-limit6', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit6' ) == '' ) {
			update_option( 'lsp-international-population-limit6', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit7' ) == '' ) {
			update_option( 'lsp-national-population-limit7', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit7' ) == '' ) {
			update_option( 'lsp-international-population-limit7', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit8' ) == '' ) {
			update_option( 'lsp-national-population-limit8', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit8' ) == '' ) {
			update_option( 'lsp-international-population-limit8', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit9' ) == '' ) {
			update_option( 'lsp-national-population-limit9', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit9' ) == '' ) {
			update_option( 'lsp-international-population-limit9', 100000 );
		}
		if ( lsp_get_option( 'lsp-national-population-limit10' ) == '' ) {
			update_option( 'lsp-national-population-limit10', 10000 );
		}
		if ( lsp_get_option( 'lsp-international-population-limit10' ) == '' ) {
			update_option( 'lsp-international-population-limit10', 100000 );
		}
	}
	global $wpdb;

	update_option( 'lsp-language', get_bloginfo( 'language' ) );
	global $title_string;
	global $title_string2;
	global $title_string3;

	$myrow = $wpdb->get_row( 'SELECT * FROM ' . $wpdb->prefix . "posts WHERE post_title = '" . $title_string . "' AND post_status = 'publish'", 'ARRAY_A' );
	if ( $myrow['ID'] ) {
		update_option( 'lsp-ptemplate-id', $myrow['ID'] );
	} else {
		$post = array(
			'post_content'   => '',
			'post_name'      => str_replace( ' ', '-', $title_string ),
			'post_title'     => $title_string,
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'comment_status' => 'closed',
			'page_template'  => 'page.php',
		);

		$new_lsp_ptemplate_id = wp_insert_post( $post );
		update_option( 'lsp-ptemplate-id', $new_lsp_ptemplate_id );
	}

	flush_rewrite_rules();
	global $wp_rewrite;
	$wp_rewrite->flush_rules();

	$myrow = $wpdb->get_row( 'SELECT * FROM ' . $wpdb->prefix . "posts WHERE post_title = '" . $title_string2 . "' AND post_status = 'publish'", 'ARRAY_A' );
	if ( $myrow['ID'] ) {
		update_option( 'lsp-ptemplate-id2', $myrow['ID'] );
	} else {
		$post2                = array(
			'post_content'   => '',
			'post_name'      => str_replace( ' ', '-', $title_string2 ),
			'post_title'     => $title_string2,
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'comment_status' => 'closed',
			'page_template'  => 'page.php',
		);
		$new_lsp_ptemplate_id = wp_insert_post( $post2 );
		update_option( 'lsp-ptemplate-id2', $new_lsp_ptemplate_id );
	}

	flush_rewrite_rules();
	global $wp_rewrite;
	$wp_rewrite->flush_rules();

	$myrow = $wpdb->get_row( 'SELECT * FROM ' . $wpdb->prefix . "posts WHERE post_title = '" . $title_string3 . "' AND post_status = 'publish'", 'ARRAY_A' );
	if ( $myrow['ID'] ) {
		update_option( 'lsp-ptemplate-id3', $myrow['ID'] );
	} else {
		$post3                = array(
			'post_content'   => '',
			'post_name'      => str_replace( ' ', '-', $title_string3 ),
			'post_title'     => $title_string3,
			'post_status'    => 'publish',
			'post_type'      => 'page',
			'comment_status' => 'closed',
			'page_template'  => 'page.php',
		);
		$new_lsp_ptemplate_id = wp_insert_post( $post3 );
		update_option( 'lsp-ptemplate-id3', $new_lsp_ptemplate_id );
	}

	flush_rewrite_rules();
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
register_activation_hook( __FILE__, 'lsp_activate' );


function load_plugin() {
	if ( is_admin() && lsp_get_option( 'Activated_Plugin' ) == 'localseoportfolio' ) {

		delete_option( 'Activated_Plugin' );

		if ( ! ( sanitize_text_field( $_GET['activate-multi'] ) ) ) {
			wp_redirect( 'edit.php?post_type=localproject&page=localseoportfolio-free.php' );
			exit;
		}
	}
}
add_action( 'admin_init', 'load_plugin' );




// Local Portfolio Custom Post Type / Taxonomy Setup Below
add_action( 'init', 'local_seo_register_post_type' );
function local_seo_register_post_type() {
	$portfolioson = false;
	if ( lsp_get_option( 'lsp-enable-categories' ) == 'yes' ) {
		$portfolioson = true;
	} else {
		$portfolioson = false;
	}

	$catholder = true;
	if ( lsp_get_option( 'lsp-enable-categories' ) != 'yes' ) {
		$catholder = false;
	}

	$archiveholder = false;
	if ( lsp_get_option( 'lsp-preview-urls' ) == 'yes' ) {
		$archiveholder = true;
	}

	$labels = array(
		'name'                       => __( 'Services Provided / Products Bought', 'lsp_text_domain' ),
		'label'                      => __( 'Services Provided', 'lsp_text_domain' ),
		'menu_name'                  => __( 'Services Provided', 'lsp_text_domain' ),
		'all_items'                  => __( 'All Services', 'lsp_text_domain' ),
		'edit_item'                  => __( 'Edit Service', 'lsp_text_domain' ),
		'view_item'                  => __( 'View Service', 'lsp_text_domain' ),
		'update_item'                => __( 'Update Service', 'lsp_text_domain' ),
		'add_new_item'               => __( 'Add New Service / Product', 'lsp_text_domain' ),
		'new_item_name'              => __( 'New Service', 'lsp_text_domain' ),
		'parent_item'                => __( 'Parent Service', 'lsp_text_domain' ),
		'parent_item_colon'          => __( 'Parent Service:', 'lsp_text_domain' ),
		'search_items'               => __( 'Search Services', 'lsp_text_domain' ),
		'popular_items'              => __( 'Popular Services', 'lsp_text_domain' ),
		'separate_items_with_commas' => __( 'Please Separate Services Used / Products Bought with Commas. So these show in your portfolio, at least one of these should match a main term in your setup, like ' . lsp_get_option( 'lsp-services' ) . '', 'lsp_text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove services', 'lsp_text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used services', 'lsp_text_domain' ),
		'not_found'                  => __( 'No services found', 'lsp_text_domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'label'             => __( 'Services Used / Products Bought', 'lsp_text_domain' ),
		'show_ui'           => true,
		'public'            => $portfolioson,
		'query_var'         => 'servicesportfolio',
		'show_admin_column' => false,
		'rewrite'           => array(
			'slug'       => 'ourwork/servicesportfolio',
			'with_front' => false,
		),
	);
	register_taxonomy( 'servicesportfolio', 'localproject', $args );

	$labels = array(
		'name'                       => __( 'Project Industry / Industries', 'lsp_text_domain' ),
		'label'                      => __( 'Industries', 'lsp_text_domain' ),
		'menu_name'                  => __( 'Industries', 'lsp_text_domain' ),
		'all_items'                  => __( 'All Industries', 'lsp_text_domain' ),
		'edit_item'                  => __( 'Edit Industry', 'lsp_text_domain' ),
		'view_item'                  => __( 'View Industry', 'lsp_text_domain' ),
		'update_item'                => __( 'Update Industry', 'lsp_text_domain' ),
		'add_new_item'               => __( 'Add New Industry', 'lsp_text_domain' ),
		'new_item_name'              => __( 'New Industry', 'lsp_text_domain' ),
		'parent_item'                => __( 'Parent Industry', 'lsp_text_domain' ),
		'parent_item_colon'          => __( 'Parent Industry:', 'lsp_text_domain' ),
		'search_items'               => __( 'Search Industries', 'lsp_text_domain' ),
		'popular_items'              => __( 'Popular Industries', 'lsp_text_domain' ),
		'separate_items_with_commas' => __( 'Please Separate Items with Commas', 'lsp_text_domain' ),
		'add_or_remove_items'        => __( 'Add or remove industries', 'lsp_text_domain' ),
		'choose_from_most_used'      => __( 'Choose from the most used industries', 'lsp_text_domain' ),
		'not_found'                  => __( 'No industries found', 'lsp_text_domain' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'label'             => __( 'Industries', 'lsp_text_domain' ),
		'show_ui'           => true,
		'public'            => $portfolioson,
		'query_var'         => 'industriesportfolio',
		'show_admin_column' => false,
		'rewrite'           => array(
			'slug'       => 'ourwork/industriesportfolio',
			'with_front' => false,
		),
	);
	register_taxonomy( 'industriesportfolio', 'localproject', $args );

	$labels = array(
		'name'               => __( 'Portfolio', 'lsp_text_domain' ),
		'singular_name'      => __( 'Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'menu_name'          => 'Best Local SEO Tools Setup',
		'all_items'          => __( 'All Projects / Jobs / Testimonials / Reviews', 'lsp_text_domain' ),
		'add_new'            => __( 'Add a Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'add_new_item'       => __( 'Add New Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'edit'               => __( 'Edit', 'lsp_text_domain' ),
		'edit_item'          => __( 'Edit Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'new_item'           => __( 'New Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'view'               => __( 'View', 'lsp_text_domain' ),
		'view_item'          => __( 'View Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'search_items'       => __( 'Search Projects / Jobs / Testimonials / Reviews', 'lsp_text_domain' ),
		'not_found'          => __( 'No Projects / Jobs / Testimonials / Reviews', 'lsp_text_domain' ),
		'not_found_in_trash' => __( 'No Projects / Jobs / Testimonials / Reviews Items Found in Trash', 'lsp_text_domain' ),
		'parent'             => __( 'Parent Project / Job / Testimonial / Review', 'lsp_text_domain' ),
		'supports'           => array( 'title', 'editor', 'thumbnail' ),
	);

	$args = array(
		'labels'              => $labels,
		'description'         => __( '', 'lsp_text_domain' ),
		'public'              => $archiveholder,
		'menu_icon'           => 'http://www.bestlocalseotools.com/icon.png',
		'show_ui'             => true,
		'has_archive'         => $catholder,
		'show_in_menu'        => true,
		'menu_position'       => 7,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'publicly_queryable'  => $archiveholder,
		'rewrite'             => array(
			'slug'       => 'ourwork',
			'with_front' => true,
		),
		'query_var'           => $archiveholder,
	);
	register_post_type( 'localproject', $args );

	/*
	$labels = array(
		"name" => __("SEO / A/B Tests", "lsp_text_domain"),
		"singular_name" => __("SEO / A/B Test", "lsp_text_domain"),
		"menu_name" => "SEO / A/B Tests",
		"all_items" => __("All SEO / A/B Tests", "lsp_text_domain"),
		"add_new" => __("Add an SEO / A/B Test", "lsp_text_domain"),
		"add_new_item" => __("Add New SEO / A/B Test", "lsp_text_domain"),
		"edit" => __("Edit", "lsp_text_domain"),
		"edit_item" => __("Edit SEO A/B / Test", "lsp_text_domain"),
		"new_item" => __("New SEO / A/B Test", "lsp_text_domain"),
		"view" => __("View", "lsp_text_domain"),
		"view_item" => __("View SEO / A/B Test", "lsp_text_domain"),
		"search_items" => __("Search SEO / A/B Tests", "lsp_text_domain"),
		"not_found" => __("No SEO / A/B Tests", "lsp_text_domain"),
		"not_found_in_trash" => __("No SEO / A/B Tests Found in Trash", "lsp_text_domain"),
		"parent" => __("Parent SEO / A/B Test", "lsp_text_domain")
	);

	$args = array(
		"labels" => $labels,
		"description" => __("Add Your SEO A/B Tests Here", "lsp_text_domain"),
		"public" => false,
		"menu_icon" => "http://www.bestlocalseotools.com/icon.png",
		"show_ui" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"menu_position" => 7,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"publicly_queryable" => false,
		"query_var" => false,
		"supports" => array('title'),
	);
	register_post_type("seoabtest", $args);
	*/
	add_post_type_support( 'localproject', 'page-attributes' );

}



function add_portfolio_type_to_query( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		if ( lsp_get_option( 'lsp-post-blog' ) == 'yes' ) {
			$query->set(
				'post_type',
				array(
					'post',
					'localproject',
				)
			);
		}
	}
}
add_action( 'pre_get_posts', 'add_portfolio_type_to_query' );




add_action( 'admin_init', 'lsp_meta_box' );
function lsp_meta_box() {
	add_meta_box( 'lsp_meta_box_details', __( 'Project / Client Details', 'lsp_text_domain' ), 'lsp_meta_box_details_display', 'localproject', 'normal', 'high' );

	$post_types = get_post_types(
		array(
			'public' => true,
		)
	);

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

}


function lsp_meta_box_details_display( $localproject ) {

	$lsp_post_workedwith    = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_workedwith', true ) ) );
	$lsp_post_storelocation = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_storelocation', true ) ) );

	$lsp_post_city           = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_city', true ) ) );
	$lsp_post_state          = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_state', true ) ) );
	$lsp_post_country        = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_country', true ) ) );
	$lsp_post_tags           = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_tags', true ) ) );
	$lsp_post_industry       = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_industry', true ) ) );
	$lsp_post_client_name    = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_client_name', true ) ) );
	$lsp_post_testimonial    = esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_testimonial', true ) );
	$lsp_post_client_website = esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_client_website', true ) );
	$lsp_post_client_phone   = ucwords( esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_client_phone', true ) ) );

	$lsp_post_score = esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_score', true ) );
	$lsp_post_show  = esc_html( lsp_get_post_meta( $localproject->ID, 'lsp_post_show', true ) );
	$lsp_post_email = esc_html( sanitize_email( lsp_get_post_meta( $localproject->ID, 'lsp_post_email', true ) ) );

	?>


	<?php if ( lsp_get_option( 'lsp-agree' ) != 'yes' && lsp_get_option( 'lsp-agree' ) != 'yes2' ) : ?>
		<?php _e( 'Acceptance of data-sending back and forth is required to use this plugin. This can be set in the settings.', 'lsp_text_domain' ); ?>
	<?php endif; ?>

	<?php if ( lsp_get_option( 'lsp-agree' ) == 'yes' || lsp_get_option( 'lsp-agree' ) == 'yes2' ) : ?>
  <table style="width:100%">
	
	</tr>
	  <td>
		<?php
		_e( 'Client Name*', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_client_name" value='
		<?php
		echo $lsp_post_client_name;
		?>
		' /></td>
	</tr>


	<tr>
	  <td>
		<?php
		_e( 'Their Testimonial', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" id="lsp_post_testimonial" name="lsp_post_testimonial" value='
		<?php
		echo $lsp_post_testimonial;
		?>
		' /></td>
	</tr>

	<tr>
	  <td class="specialtd">
		<?php
		_e( 'City*', 'lsp_text_domain' );
		?>
		:</td><td style="width:100%">
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_city" value='
		<?php
		echo $lsp_post_city;
		?>
		' /></td>
	</tr>
	<tr>
	  <td>
		<?php
		_e( 'State / Province (full state name)*', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" id="lsp_post_state" name="lsp_post_state" value='
		<?php
		echo $lsp_post_state;
		?>
		' /></td>


	<tr>
	  <td>
		<?php
		_e( 'Their 1-5 Experience Review Score', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_score" value='
		<?php
		echo $lsp_post_score;
		?>
		' /></td>
	</tr>
	

	<tr>
	  <td>
		<?php
		_e( 'Worked With', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_workedwith" value='
		<?php
		echo $lsp_post_workedwith;
		?>
		' /></td>
	</tr>

	<tr>
	  <td>
		<?php
		_e( 'Store Location', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_storelocation" value='
		<?php
		echo $lsp_post_storelocation;
		?>
		' /></td>
	</tr>

	<tr>
	  <td>
		<?php
		_e( 'Their Website / Social Media URL', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_client_website" value='
		<?php
		echo $lsp_post_client_website;
		?>
		' /></td>
	</tr>

	<tr>
	  <td>
		<?php
		_e( 'Their Phone Number', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_client_phone" value='
		<?php
		echo $lsp_post_client_phone;
		?>
		' /></td>
	</tr>

	<tr>
	  <td>
		<?php
		_e( 'Their Email Address', 'lsp_text_domain' );
		?>
		:</td><td>
	  <input type='text' style="width:100%;min-width:200px" name="lsp_post_email" value='
		<?php
		echo $lsp_post_email;
		?>
		' /></td>
	</tr>
  
	 <tr>
	  <td>
		<?php
		_e( 'Email Them a Request for Feedback/Review/Testimonial?', 'lsp_text_domain' );
		?>
		:</td><td>
		<select name="lsp_post_request" id="lsp_post_request">
	  <option value="no">
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
		</option>
	  <option value="yes">
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
		</option>
	</select>
	</td>
	</tr>

	<tr>
	  <td>
		<?php
		_e( 'Show Their Review/Testimonial', 'lsp_text_domain' );
		?>
		:</td><td>
	  <select id="lsp_post_show" name="lsp_post_show">
	  <option value="no"
		<?php
		if ( $lsp_post_show != 'yes' ) :
			?>
	 selected
			<?php
	endif;
		?>
		>
		<?php
		_e( 'No', 'lsp_text_domain' );
		?>
</option>
	  <option value="yes"
		<?php
		if ( $lsp_post_show == 'yes' ) :
			?>
	 selected
			<?php
	endif;
		?>
		>
		<?php
		_e( 'Yes', 'lsp_text_domain' );
		?>
  </option>
	</select>
	</td>
	</tr>

  </table>
<?php endif; ?>


	<?php
	global $post;
	global $current_screen;
	if ( sanitize_text_field( $_GET['post_type'] ) == 'localproject' || $current_screen->post_type == 'localproject' ) :
		?>


		<?php
	endif;
	?>
	  

	  
	  

	<?php
}

add_action( 'untrash_post', 'lsp_post_fields_delete3', 10, 2 );
function lsp_post_fields_delete3( $post_id ) {
	if ( get_post_type( $post_id ) == 'localproject' ) {
		global $wpdb;
		$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->prefix . "lsp_localprojects SET lsp_lp_status = 'publish' WHERE lsp_lp_postid = %d", $post_id ) );
	}
}

add_action( 'wp_trash_post', 'lsp_post_fields_delete2', 10, 2 );
function lsp_post_fields_delete2( $post_id ) {
	if ( get_post_type( $post_id ) == 'localproject' ) {
		global $wpdb;
		$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->prefix . "lsp_localprojects SET lsp_lp_status = 'trash' WHERE lsp_lp_postid = %d", $post_id ) );
	}
}


add_action( 'before_delete_post', 'lsp_post_fields_delete', 10, 2 );
function lsp_post_fields_delete( $post_id ) {
	if ( get_post_type( $post_id ) == 'localproject' ) {
		global $wpdb;
		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'lsp_localprojects WHERE lsp_lp_postid = %d', $post_id ) );
	}
}

// Save the project custom post type metas
add_action( 'save_post', 'lsp_post_fields_save', 10, 2 );
function lsp_post_fields_save( $post_id = false, $post = false ) {

	$thispost      = get_post( $post_id );
	$termsstring   = '';
	$service_terms = wp_get_object_terms( $thispost->ID, 'servicesportfolio' );
	if ( ! empty( $service_terms ) ) {
		if ( ! is_wp_error( $service_terms ) ) {
			$termcounter = 0;
			foreach ( $service_terms as $term ) {
				$termcounter++;
				if ( $termcounter > 1 ) {
					$termsstring .= ',';
				}
				$termsstring .= ucwords( $term->name );
			}
		}
	}
	update_post_meta( $post_id, 'lsp_post_tags', $termsstring );

	$termsstring    = '';
	$industry_terms = wp_get_object_terms( $thispost->ID, 'industriesportfolio' );
	if ( ! empty( $industry_terms ) ) {
		if ( ! is_wp_error( $industry_terms ) ) {
			$termcounter = 0;
			foreach ( $industry_terms as $term ) {
				$termcounter++;
				if ( $termcounter > 1 ) {
					$termsstring .= ',';
				}
				$termsstring .= ucwords( $term->name );
			}
		}
	}
	update_post_meta( $post_id, 'lsp_post_industry', $termsstring );

	if ( ( sanitize_text_field( $_POST['_lsp_post_autooptimize'] ) ) && sanitize_text_field( $_POST['_lsp_post_autooptimize'] ) != '' ) {
		update_post_meta( $post_id, '_lsp_post_autooptimize', sanitize_text_field( $_POST['_lsp_post_autooptimize'] ) );
	}

	if ( ( sanitize_text_field( $_POST['_lsp_post_lockfocus'] ) ) && sanitize_text_field( $_POST['_lsp_post_lockfocus'] ) != '' ) {
		update_post_meta( $post_id, '_lsp_post_lockfocus', sanitize_text_field( $_POST['_lsp_post_lockfocus'] ) );
	}

	if ( ( sanitize_text_field( $_POST['_lsp_post_locktitle'] ) ) && sanitize_text_field( $_POST['_lsp_post_locktitle'] ) != '' ) {
		update_post_meta( $post_id, '_lsp_post_locktitle', sanitize_text_field( $_POST['_lsp_post_locktitle'] ) );
	}

	if ( ( sanitize_text_field( $_POST['_lsp_post_lockalts'] ) ) && sanitize_text_field( $_POST['_lsp_post_lockalts'] ) != '' ) {
		update_post_meta( $post_id, '_lsp_post_lockalts', sanitize_text_field( $_POST['_lsp_post_lockalts'] ) );
	}

	if ( ( sanitize_text_field( $_POST['_lsp_post_lockurl'] ) ) && sanitize_text_field( $_POST['_lsp_post_lockurl'] ) != '' ) {
		update_post_meta( $post_id, '_lsp_post_lockurl', sanitize_text_field( $_POST['_lsp_post_lockurl'] ) );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_city'] ) ) && sanitize_text_field( $_POST['lsp_post_city'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_city', sanitize_text_field( $_POST['lsp_post_city'] ) );
	}
	if ( ( sanitize_text_field( $_POST['lsp_post_state'] ) ) && sanitize_text_field( $_POST['lsp_post_state'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_state', sanitize_text_field( $_POST['lsp_post_state'] ) );
	}
	if ( ( sanitize_text_field( $_POST['lsp_post_country'] ) ) && sanitize_text_field( $_POST['lsp_post_country'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_country', sanitize_text_field( $_POST['lsp_post_country'] ) );
	}

	if ( ( sanitize_email( $_POST['lsp_post_email'] ) ) && sanitize_email( $_POST['lsp_post_email'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_email', sanitize_email( $_POST['lsp_post_email'] ) );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_show'] ) ) && sanitize_text_field( $_POST['lsp_post_show'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_show', sanitize_text_field( $_POST['lsp_post_show'] ) );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_score'] ) ) && sanitize_text_field( $_POST['lsp_post_score'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_score', sanitize_text_field( $_POST['lsp_post_score'] ) );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_workedwith'] ) ) && sanitize_text_field( $_POST['lsp_post_workedwith'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_workedwith', sanitize_text_field( $_POST['lsp_post_workedwith'] ) );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_storelocation'] ) ) && sanitize_text_field( $_POST['lsp_post_storelocation'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_storelocation', sanitize_text_field( $_POST['lsp_post_storelocation'] ) );
	}

	if ( lsp_get_post_meta( $post_id, '_lsp_post_date', true ) == '' ) {
		update_post_meta( $post_id, '_lsp_post_date', date( 'Y-m-d' ) );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_client_name'] ) ) && sanitize_text_field( $_POST['lsp_post_client_name'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_client_name', sanitize_text_field( $_POST['lsp_post_client_name'] ) );
	}
	if ( ( sanitize_text_field( $_POST['lsp_post_testimonial'] ) ) && sanitize_text_field( $_POST['lsp_post_testimonial'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_testimonial', sanitize_text_field( $_POST['lsp_post_testimonial'] ) );
	}
	if ( esc_url( sanitize_text_field( $_POST['lsp_post_client_website'] ) ) && sanitize_text_field( $_POST['lsp_post_client_website'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_client_website', sanitize_text_field( $_POST['lsp_post_client_website'] ) );
	}
	if ( ( sanitize_text_field( $_POST['lsp_post_client_phone'] ) ) && sanitize_text_field( $_POST['lsp_post_client_phone'] ) != '' ) {
		update_post_meta( $post_id, 'lsp_post_client_phone', sanitize_text_field( $_POST['lsp_post_client_phone'] ) );
	}
	if ( ( sanitize_text_field( $_POST['lsp_post_city'] ) ) && ( sanitize_text_field( $_POST['lsp_post_city'] ) != '' ) && ( sanitize_text_field( $_POST['lsp_post_state'] ) ) && ( sanitize_text_field( $_POST['lsp_post_state'] ) != '' ) ) {
		$myKey     = lsp_get_option( 'lsp-api-key' );
		$country   = 'US';
		$latitude  = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_POST['lsp_post_city'] ) ) . '&state=' . urlencode( sanitize_text_field( $_POST['lsp_post_state'] ) ) . '&request=latitude' );
		$longitude = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_POST['lsp_post_city'] ) ) . '&state=' . urlencode( sanitize_text_field( $_POST['lsp_post_state'] ) ) . '&request=longitude' );
		$country   = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( sanitize_text_field( $_POST['lsp_post_city'] ) ) . '&state=' . urlencode( sanitize_text_field( $_POST['lsp_post_state'] ) ) . '&request=country' );
		update_post_meta( $post_id, 'lsp_post_latitude', $latitude );
		update_post_meta( $post_id, 'lsp_post_longitude', $longitude );
		update_post_meta( $post_id, 'lsp_post_country', $country );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_request'] ) ) && sanitize_text_field( $_POST['lsp_post_request'] ) == 'yes' ) {
		wp_mail( sanitize_email( $_POST['lsp_post_email'] ), get_bloginfo( 'name' ) . __( ' would like your feedback', 'lsp_text_domain' ), __( 'Please give us your feedback about your experience with us at ', 'lsp_text_domain' ) . network_site_url( '/' ) . 'feedback/' ) . '?email2=' . sanitize_email( $_POST['lsp_post_email'] );
	}

	if ( ( sanitize_text_field( $_POST['lsp_post_city'] ) ) && sanitize_text_field( $_POST['lsp_post_city'] ) != '' ) {
		if ( get_post_type( $post_id ) == 'localproject' ) {
			global $wpdb;
			$tags   = get_post_meta( $post_id, 'lsp_post_tags', true );
			$lat    = get_post_meta( $post_id, 'lsp_post_latitude', true );
			$long   = get_post_meta( $post_id, 'lsp_post_longitude', true );
			$status = get_post_status( $post_id );
			$query  = $wpdb->prepare( 'REPLACE INTO ' . $wpdb->prefix . 'lsp_localprojects VALUES (%d, %s, %f, %f, %s)', $post_id, $tags, $lat, $long, $status );
			$wpdb->query( $query );
		}
	}

}


function get_localportfolio_content( $keyPhrase, $city, $state, $country ) {

	flush_rewrite_rules();
	global $wp_rewrite;
	$wp_rewrite->flush_rules();

	$city      = stripslashes( str_replace( '-', ' ', $city ) );
	$state     = stripslashes( str_replace( '-', ' ', $state ) );
	$returnStr = '';

	if ( ( lsp_get_option( 'lsp-keyphrase' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override' ) == $keyPhrase ) ) {
		$phraseNumber = 1;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase2' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override2' ) == $keyPhrase ) ) {
		$phraseNumber = 2;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase3' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override3' ) == $keyPhrase ) ) {
		$phraseNumber = 3;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase4' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override4' ) == $keyPhrase ) ) {
		$phraseNumber = 4;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase5' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override5' ) == $keyPhrase ) ) {
		$phraseNumber = 5;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase6' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override6' ) == $keyPhrase ) ) {
		$phraseNumber = 6;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase7' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override7' ) == $keyPhrase ) ) {
		$phraseNumber = 7;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase8' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override8' ) == $keyPhrase ) ) {
		$phraseNumber = 8;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase9' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override9' ) == $keyPhrase ) ) {
		$phraseNumber = 9;
	}
	if ( ( lsp_get_option( 'lsp-keyphrase10' ) == $keyPhrase ) || ( lsp_get_option( 'lsp-keyphrase-override10' ) == $keyPhrase ) ) {
		$phraseNumber = 10;
	}

	global $wpdb;

	$rangerLat    = '';
	$rangerLong   = '';
	$rangerRadius = '';

	if ( $phraseNumber == 1 ) {
		$rangerLat = lsp_get_option( 'lsp-latitude' );
	}
	if ( $phraseNumber == 1 ) {
		$rangerLong = lsp_get_option( 'lsp-longitude' );
	}
	if ( $phraseNumber == 1 ) {
		$rangerRadius = lsp_get_option( 'lsp-how-far' );
	}

	if ( $phraseNumber > 1 ) {
		$rangerLat = lsp_get_option( 'lsp-latitude' . $phraseNumber );
	}
	if ( $phraseNumber > 1 ) {
		$rangerLong = lsp_get_option( 'lsp-longitude' . $phraseNumber );
	}
	if ( $phraseNumber > 1 ) {
		$rangerRadius = lsp_get_option( 'lsp-how-far' . $phraseNumber );
	}

	if ( $rangerRadius == 'auto' || $rangerRadius == '' ) {
		$rangerRadius = 500;
	}

	$myKey = 'key';

	$myKey = lsp_get_option( 'lsp-api-key' );

	// latitude / longitude for range bounding
	$rangerLat  = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( $city ) . '&state=' . urlencode( $state ) . '&country=' . $country . '&request=latitude' );
	$rangerLong = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php' . '?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . $myKey . '&city=' . urlencode( $city ) . '&state=' . urlencode( $state ) . '&country=' . $country . '&request=longitude' );

	global $wpdb;
	$queryStart = 'SELECT lsp_lp_postid FROM ' . $wpdb->prefix . "lsp_localprojects WHERE lsp_lp_status = 'publish'";
	// if(get_option('lsp-show-all-projects')!="yes") $queryStart .= " AND d.meta_value LIKE '%%%s%%' ";
	$query = $wpdb->prepare(
		"$queryStart AND lsp_lp_tags LIKE '%%%s%%'
  AND lsp_lp_latitude >= %f 
  AND lsp_lp_latitude <= %f 
  AND lsp_lp_longitude >= %f 
  AND lsp_lp_longitude <= %f",
		$keyPhrase,
		( $rangerLat - ( 0 / 52 ) ),
		( $rangerLat + ( 0 / 52 ) ),
		( $rangerLong - ( 0 / 52 ) ),
		( $rangerLat + ( $rangerLong / 52 ) )
	);
	// echo $query;
	// echo "hello";
	$postids = $wpdb->get_results( $query );

	$counter = 0;
	foreach ( $postids as $postid ) {
		$counter++;
	}

	// else $result = mysql_query("SELECT * FROM ( SELECT geoname.name as city, admin1CodesAscii.name as state, geoname.population as population, (3959 * acos( cos( radians($latitude) ) * cos( radians( geoname.latitude) ) * cos( radians( geoname.longitude) - radians($longitude) ) +sin(radians($latitude)) * sin(radians(geoname.latitude)) ) ) AS distance FROM geoname, admin1CodesAscii WHERE geoname.admin1 = admin1CodesAscii.regionCode AND geoname.latitude >". ($latitude - $adjustedRadius) ." AND geoname.latitude <". ($latitude + $adjustedRadius) ." AND geoname.longitude >". ($longitude - $adjustedRadius) ." AND geoname.longitude <". ($longitude + $adjustedRadius) ." ORDER BY distance LIMIT 0,".$count. ") as geotable ORDER BY geotable.city");
	global $wpdb;
	$queryString = "SELECT lsp_lp_postid, (3959 * acos( cos( radians($rangerLat) ) * cos( radians( lsp_lp_latitude) ) * cos( radians( lsp_lp_longitude) - radians($rangerLong) ) +sin(radians($rangerLat)) * sin(radians(lsp_lp_latitude)) ) ) AS distance 
    FROM " . $wpdb->prefix . "lsp_localprojects
    WHERE lsp_lp_status = 'publish'";

	if ( get_option( 'lsp-show-all-projects' ) != 'yes' ) {
		$queryString .= " AND lsp_lp_tags LIKE '%%%s%%' ";
	}

	$queryString .= '
  AND lsp_lp_latitude >= %f 
  AND lsp_lp_latitude <= %f 
  AND lsp_lp_longitude >= %f 
  AND lsp_lp_longitude <= %f
  ORDER BY distance, RAND()';

	$projectsCount3 = wp_count_posts( 'localproject' );

	$projectsCount4 = $projectsCount3->publish;

	$projectsCount5 = 4;

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'local' ) && $projectsCount4 > 12 ) {
		$projectsCount5 = 5;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'local' ) && $projectsCount4 > 24 ) {
		$projectsCount5 = 6;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'local' ) && $projectsCount4 > 36 ) {
		$projectsCount5 = 7;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'national' ) && $projectsCount4 > 120 ) {
		$projectsCount5 = 5;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'national' ) && $projectsCount4 > 240 ) {
		$projectsCount5 = 6;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'national' ) && $projectsCount4 > 360 ) {
		$projectsCount5 = 7;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'international' ) && $projectsCount4 > 600 ) {
		$projectsCount5 = 5;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'international' ) && $projectsCount4 > 1200 ) {
		$projectsCount5 = 6;
	}

	if ( strstr( lsp_get_option( 'lsp-set-type0' ), 'international' ) && $projectsCount4 > 1800 ) {
		$projectsCount5 = 7;
	}

	if ( $rangerRadius == '500' && $counter > 3 ) {
		$queryString .= " LIMIT 0, $counter";
	}

	if ( $rangerRadius == '500' && $counter < 4 ) {
		$queryString .= ' LIMIT 0, ' . $projectsCount5;
	}

	if ( $rangerRadius == '500' && $counter > 3 ) {
		$query = $wpdb->prepare( $queryString, $keyPhrase, ( $rangerLat - ( 0 / 52 ) ), ( $rangerLat + ( 0 / 52 ) ), ( $rangerLong - ( 0 / 52 ) ), ( $rangerLat + ( 0 / 52 ) ) );
	} else {
		if ( $counter < 4 && $rangerRadius == '500' ) {
			$rangerRadius = 1000;
		}
		$query = $wpdb->prepare( $queryString, $keyPhrase, ( $rangerLat - ( $rangerRadius / 52 ) ), ( $rangerLat + ( $rangerRadius / 52 ) ), ( $rangerLong - ( $rangerRadius / 52 ) ), ( $rangerLong + ( $rangerRadius / 52 ) ) );

	}

	$postids = $wpdb->get_results( $query );

	if ( $city == 'list' && $state == 'all' ) {
		if ( sanitize_text_field( $_GET['service'] ) ) {
			global $wpdb;

			$keyword = $keyPhrase;
			$keyword = '%%' . $wpdb->esc_like( $keyword ) . '%%';

			$postids = $wpdb->get_col(
				$wpdb->prepare(
					"
        SELECT DISTINCT post_id FROM {$wpdb->postmeta}
        WHERE meta_key = 'lsp_post_tags' AND meta_value LIKE '%s'
    ",
					$keyword
				)
			);

		}

		if ( sanitize_text_field( $_GET['industry'] ) ) {
			global $wpdb;

			$keyword = $keyPhrase;
			$keyword = '%%' . $wpdb->esc_like( $keyword ) . '%%';

			$postids = $wpdb->get_col(
				$wpdb->prepare(
					"
    SELECT DISTINCT post_id FROM {$wpdb->postmeta}
    WHERE meta_key = 'lsp_post_industry' AND meta_value LIKE '%s'
",
					$keyword
				)
			);

		}
	}

	global $wp_query;

	if ( lsp_get_option( 'lsp-hide-intro-text' ) != 'yes' ) {
		if ( $phraseNumber == 1 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 2 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 3 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 4 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 5 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 6 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 7 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 8 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 9 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
		if ( $phraseNumber == 10 ) {
			$holder_string = wp_kses(
				get_option( 'lsp-api-intro-text' ),
				array(
					'a' => array(
						'href'  => array(),
						'title' => array(),
					),
				)
			) . '<br><br>';
		}
	}
	if ( $city == 'list' && $state == 'all' ) {
		$holder_string = '';
	}

	$holder_string = str_replace( '[city]', ucwords( $city ), $holder_string );
	$holder_string = str_replace( '[state]', ucwords( $state ), $holder_string );
	$holder_string = str_replace( '[City]', ucwords( $city ), $holder_string );
	$holder_string = str_replace( '[CITY]', ucwords( $city ), $holder_string );
	$holder_string = str_replace( '[State]', ucwords( $state ), $holder_string );
	$holder_string = str_replace( '[STATE]', ucwords( $state ), $holder_string );
	$returnStr    .= $holder_string;

	if ( $_POST['personnme'] && $_POST['personemil'] ) {
		wp_mail( explode( ',', lsp_get_option( 'lsp-email-addresses' ) ), __( 'Portfolio Contact Form', 'lsp_text_domain' ), __( 'Name: ', 'lsp_text_domain' ) . $_POST['personnme'] . __( ' Email: ', 'lsp_text_domain' ) . $_POST['personemil'] . __( ' Phone: ', 'lsp_text_domain' ) . $_POST['personphne'] . __( ' Message: ', 'lsp_text_domain' ) . $_POST['lspmessage'] );
	}
	if ( lsp_get_option( 'lsp-contact-form' ) == 'yes' ) {
		$returnStr .= '<center>';
	}
	if ( lsp_get_option( 'lsp-contact-form' ) == 'yes' && $_POST['personnme'] ) {
		$returnStr .= 'Message sent!';
	}
	if ( lsp_get_option( 'lsp-contact-form' ) == 'yes' ) {
		$returnStr .= "<h3><font color='" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . lsp_get_option( 'lsp-form-header' ) . '</font></h3>';
	}
	if ( lsp_get_option( 'lsp-contact-form' ) == 'yes' ) {
		$returnStr .= "<form action='' method='post'>" . __( 'Your Name:', 'lsp_text_domain' ) . "<input name='personnme' type='text'><br>" . __( 'Your Email:', 'lsp_text_domain' ) . "<input name='personemil' type='text'><br>" . __( 'Your Phone:', 'lsp_text_domain' ) . "<input name='personphne' type='text'><br>" . __( 'Message: ', 'lsp_text_domain' ) . "<br><textarea name='lspmessage' rows='2' cols='50'></textarea><br><input type='submit' value='" . __( 'Send', 'lsp_text_domain' ) . "'></form></center><br>";
	}

	$postidscounter = 0;
	foreach ( $postids as $postid ) {
		$postidscounter++;
		global $post;
		$post       = get_post( $postid->lsp_lp_postid );
		$thispostid = $postid->lsp_lp_postid;
		if ( ! ( $postid->lsp_lp_postid ) ) {
			$post       = get_post( $postid );
			$thispostid = $postid;
		}

		if ( $phraseNumber == 1 ) {
			$headline_option = lsp_get_option( 'lsp-hide-headlines0' );
			$explodedTags    = explode( ',', lsp_get_post_meta( $thispostid, 'lsp_post_tags', true ) );
			$compiledTags    = '';
			$tagCounter      = 0;
			foreach ( $explodedTags as $explodedTag ) {
				$tagCounter++;
				if ( ( count( $explodedTags ) != $tagCounter ) && ( count( $explodedTags ) != ( $tagCounter - 1 ) ) ) {
					if ( count( $explodedTags ) != ( $tagCounter + 1 ) ) {
						$compiledTags .= $explodedTag . ', ';
					} else {
						$compiledTags .= $explodedTag . '';
					}
				} elseif ( ( count( $explodedTags ) > 1 ) ) {
					$compiledTags .= __( ' and ', 'lsp_text_domain' ) . $explodedTag;
				}
			}
			$cityMatch = '';

			$servicesHolder = '';
			if ( lsp_get_option( 'lsp-biztype' ) == 'ls' || lsp_get_option( 'lsp-biztype' ) == 'ls2' ) {
				$servicesHolder = __( ' Services', 'lsp_text_domain' );
			}
			if ( lsp_get_option( 'lsp-biztype' ) == 'lsec' && lsp_get_option( 'lsp-productservice' ) == 'lsec' ) {
				$servicesHolder = __( ' Services', 'lsp_text_domain' );
			}

			if ( $tagCounter == 1 ) {
				$compiledTags = lsp_get_post_meta( $thispostid, 'lsp_post_tags', true );
			}
			if ( ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_city', true ) ) == ucwords( $city ) ) {
				$cityMatch = 'yes';
			}
			if ( $headline_option == 'tags' && $cityMatch == 'yes' ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_city', true ) ) . __( ', ', 'lsp_text_domain' ) . ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_state', true ) ) . ' ' . ucwords( $compiledTags ) . '</font></h3>';
			}
			if ( ( $headline_option == 'tags' && $cityMatch != 'yes' ) || ( lsp_get_option( 'lsp-biztype' ) == 'ls2' ) ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . ucwords( $compiledTags ) . $servicesHolder . __( ' Near ', 'lsp_text_domain' ) . ucwords( $city ) . ', ' . ucwords( $state ) . '</font></h3>';
			}
			if ( $headline_option == 'title' ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . get_the_title( $thispostid ) . '</font></h3>';
			}
			if ( $headline_option == 'none' ) {
				$item_headline = '';
			}
			if ( $city == 'list' && $state == 'all' ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . get_the_title( $thispostid ) . '</font></h3>';
			}
		}

		if ( $phraseNumber > 1 ) {
			$headline_option = lsp_get_option( 'lsp-hide-headlines' . $phraseNumber );
			$explodedTags    = explode( ',', lsp_get_post_meta( $thispostid, 'lsp_post_tags', true ) );
			$compiledTags    = '';
			$tagCounter      = 0;

			if ( lsp_get_option( 'lsp-biztype' ) == 'ls' ) {
				$servicesHolder = __( ' services', 'lsp_text_domain' );
			}
			if ( lsp_get_option( 'lsp-biztype' ) == 'lsec' && lsp_get_option( 'lsp-productservice' . $phraseNumber ) == 'lsec' ) {
				$servicesHolder = __( ' services', 'lsp_text_domain' );
			}

			foreach ( $explodedTags as $explodedTag ) {
				$tagCounter++;
				if ( ( count( $explodedTags ) != $tagCounter ) && ( count( $explodedTags ) != ( $tagCounter - 1 ) ) ) {
					if ( count( $explodedTags ) != ( $tagCounter + 1 ) ) {
						$compiledTags .= $explodedTag . ', ';
					} else {
						$compiledTags .= $explodedTag . '';
					}
				} elseif ( ( count( $explodedTags ) > 1 ) ) {
					$compiledTags .= ' & ' . $explodedTag;
				}
			}
			$cityMatch = '';
			if ( $tagCounter == 1 ) {
				$compiledTags = lsp_get_post_meta( $thispostid, 'lsp_post_tags', true );
			}
			if ( ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_city', true ) ) == ucwords( $city ) ) {
				$cityMatch = 'yes';
			}
			if ( $headline_option == 'tags' && $cityMatch == 'yes' ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_city', true ) ) . __( ', ', 'lsp_text_domain' ) . ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_state', true ) ) . ' ' . ucwords( $compiledTags ) . '</font></h3>';
			}
			if ( ( $headline_option == 'tags' && $cityMatch != 'yes' ) || ( lsp_get_option( 'lsp-biztype' ) == 'ls2' ) ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . ucwords( $compiledTags ) . $servicesHolder . __( ' Near ', 'lsp_text_domain' ) . ucwords( $city ) . ', ' . ucwords( $state ) . '</font></h3>';
			}
			if ( $headline_option == 'title' ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . get_the_title( $thispostid ) . '</h3>';
			}
			if ( $headline_option == 'none' ) {
				$item_headline = '';
			}
			if ( $city == 'list' && $state == 'all' ) {
				$item_headline = "<h3><font color='#" . esc_attr( lsp_get_option( 'lsp-header-color' ) ) . "'>" . get_the_title( $thispostid ) . '</font></h3>';
			}
		}

		$returnStr .= "<div style='clear:both'>" . $item_headline;

		if ( $post->post_content ) {
			$returnStr .= '<br>' . __( 'Description: <br>', 'lsp_text_domain' );
		}
		if ( lsp_get_option( 'lsp-preview-urls' ) != 'yes' ) {
			$returnStr .= apply_filters( 'the_content', $post->post_content );
		}
		if ( lsp_get_option( 'lsp-preview-urls' ) == 'yes' ) {

			$counterz   = round( str_word_count( $post->post_content ) / 4 ) * 3;
			$returnStr .= wp_trim_words( $post->post_content, $counterz ) . ' ' . "<a href='" . get_permalink( $thispostid ) . "'>" . __( 'Read More', 'lsp_text_domain' ) . '</a>';
		}
		$returnStr .= "<div style='clear:both'>";
		if ( lsp_get_option( 'lsp-star-minimum' ) == '' ) {
			$filterholder = 4;
		} else {
			$filterholder = lsp_get_option( 'lsp-star-minimum' );
		}

		/*
		$returnStr .= __("Client Name: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_client_name', true) . "";

		if (lsp_get_post_meta($thispostid, 'lsp_post_score', true) && lsp_get_post_meta($thispostid, 'lsp_post_score', true) >= $filterholder) {
			$starString = "";
			for ($i = 0; $i < lsp_get_post_meta($thispostid, 'lsp_post_score', true); $i++) {
				$starString .= "<img src='" . plugins_url(__FILE__) . "/star-rating/singlestar.gif' ";
			}

			$returnStr .= "<br>" . __("1 - 5 Star Review Score: ", "lsp_text_domain") . $starString;
		}

		if (lsp_get_post_meta($thispostid, 'lsp_post_testimonial', true))
			$returnStr .= "<br>" . __("Testimonial: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_testimonial', true);

		$returnStr .= "<br>" . __("City: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_city', true);
		$returnStr .= "<br>" . __("State: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_state', true);
		$returnStr .= "<br>" . __("Services Used: ", "lsp_text_domain") . ucwords(lsp_get_post_meta($thispostid, 'lsp_post_tags', true));


		if (lsp_get_post_meta($thispostid, 'lsp_post_industry', true))
			$returnStr .= "<br>" . __("Industry / Industries: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_industry', true);


		if (lsp_get_option('lsp-worked-location') == "yes") {
			if (lsp_get_post_meta($thispostid, 'lsp_post_workedwith', true)) {
				$returnStr .= "<br>" . __("Worked With: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_workedwith', true);
			}
			if (lsp_get_post_meta($thispostid, 'lsp_post_storelocation', true)) {
				$returnStr .= "<br>" . __("Store Location: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_storelocation', true);
			}
		}

		if (lsp_get_post_meta($thispostid, 'lsp_post_client_website', true)) {
			$theURL = "";
			if (!strstr(strtolower(lsp_get_post_meta($thispostid, 'lsp_post_client_website', true)), "http"))
				$theURL .= "http://";

			$theURL .= strtolower(lsp_get_post_meta($thispostid, 'lsp_post_client_website', true));

			$returnStr .= "<br>" . __("Client Website/URL: ", "lsp_text_domain") . "<a href='" . $theURL . "' target='_blank'>" . lsp_get_post_meta($thispostid, 'lsp_post_client_website', true) . "</a>";
		}

		if (lsp_get_post_meta($thispostid, 'lsp_post_client_phone', true))
			$returnStr .= "<br>" . __("Client Phone Number: ", "lsp_text_domain") . lsp_get_post_meta($thispostid, 'lsp_post_client_phone', true);



		if (current_user_can('administrator'))
			$returnStr .= "<br><a href='" . get_edit_post_link($thispostid) . "'>" . __("Edit", "lsp_text_domain") . "</a>";*/
		$returnStr .= "</div></div><div style='clear:both'><hr></div>";
	}

	wp_reset_query();
	if ( $postidscounter == 0 ) {
		$returnStr .= __( 'Our portfolio for this is currently under construction.', 'lsp_text_domain' ) . ' ';
	}

	if ( $city == 'list' && $state == 'all' ) {
		return $returnStr;
	}

	$myKey = lsp_get_option( 'lsp-api-key' );
	$city  = stripslashes( str_replace( '-', ' ', $city ) );

	$state = stripslashes( str_replace( '-', ' ', $state ) );

	$cityHome            = '';
	$stateHome           = '';
	$radiusHome          = '';
	$localLimit          = '';
	$nationalLimit       = '';
	$internationalLimit  = '';
	$addchar             = '';
	$setType             = '';
	$main_portfolio_term = '';

	if ( $phraseNumber == 1 ) {
		$cityHome            = lsp_get_option( 'lsp-city' );
		$stateHome           = lsp_get_option( 'lsp-state' );
		$radiusHome          = lsp_get_option( 'lsp-radius' );
		$localLimit          = lsp_get_option( 'lsp-local-population-limit' );
		$nationalLimit       = lsp_get_option( 'lsp-national-population-limit' );
		$internationalLimit  = lsp_get_option( 'lsp-international-population-limit' );
		$setType             = lsp_get_option( 'lsp-set-type' );
		$main_portfolio_term = lsp_get_option( 'lsp-keyphrase' );
		if ( lsp_get_option( 'lsp-keyphrase-override' ) ) {
			$main_portfolio_term = lsp_get_option( 'lsp-keyphrase-override' );
		}
	}
	if ( $phraseNumber > 1 ) {
		$addchar             = $phraseNumber;
		$cityHome            = lsp_get_option( 'lsp-city' . $phraseNumber );
		$stateHome           = lsp_get_option( 'lsp-state' . $phraseNumber );
		$radiusHome          = lsp_get_option( 'lsp-radius' . $phraseNumber );
		$localLimit          = lsp_get_option( 'lsp-local-population-limit' . $phraseNumber );
		$nationalLimit       = lsp_get_option( 'lsp-national-population-limit' . $phraseNumber );
		$internationalLimit  = lsp_get_option( 'lsp-international-population-limit' . $phraseNumber );
		$setType             = lsp_get_option( 'lsp-set-type' . $phraseNumber );
		$main_portfolio_term = lsp_get_option( 'lsp-keyphrase' . $phraseNumber );
		if ( lsp_get_option( 'lsp-keyphrase-override' . $phraseNumber ) ) {
			$main_portfolio_term = lsp_get_option( 'lsp-keyphrase-override' . $phraseNumber );
		}
	}

	if ( lsp_get_option( 'lsp-served-sentence' ) != '' ) {
		$returnStr .= lsp_get_option( 'lsp-served-sentence' ) . ' ';
	} else {
		$returnStr .= __( "Other portfolio sections for our work which we've done near ", 'lsp_text_domain' ) . ucwords( $city ) . ', ' . ucwords( $state ) . __( ' include ', 'lsp_text_domain' );
	}

	$i = '';
	if ( $phraseNumber > 1 ) {
		$i = $phraseNumber;
	}

	global $wpdb;
	$query2 = 'SELECT * FROM ' . $wpdb->prefix . "lsp_localprojects WHERE lsp_lp_tags LIKE '%%" . get_option( 'lsp-keyphrase' . $k ) . "%%' AND lsp_lp_status = 'publish'";

	// $query2 = "SELECT a.meta_value as city, b.meta_value as state FROM ".$wpdb->prefix."postmeta a, ".$wpdb->prefix."postmeta b, ".$wpdb->prefix."postmeta c WHERE c.meta_value LIKE '%%".get_option('lsp-keyphrase'.$i)."%%' AND a.meta_key='lsp_post_city' AND b.meta_key='lsp_post_state' AND c.meta_key='lsp_post_tags' AND a.post_id = b.post_id AND b.post_id = c.post_id";
	  // echo $query2;
	  // $query2 = $wpdb->prepare($query2);
	  global $wpdb;
	  $citystates      = $wpdb->get_results( $query2 );
	  $projectsCounter = 0;
	  $projectsString .= '';
	foreach ( $citystates as $citystate ) {
		if ( $projectsCounter > 100 ) {
			break;
		}
		$pstring = get_post_meta( $citystates->lsp_lp_postid, 'lsp_post_city', true ) . ',' . get_post_meta( $citystates->lsp_lp_postid, 'lsp_post_state', true );

		$projectArray[ $projectsCounter ] = $pstring;
		$projectsString                  .= $pstring . ',' . 'US' . '|';
		$projectsCounter++;
	}

	$z = '1';
	if ( $i > 1 ) {
		$z = $i;
	}
	$projectsString = site_url() . '/?portfolioquery=' . $z;

	$ref = 0;
	$ref = $_SERVER['HTTP_REFERER'] . '|' . site_url();

	global $citiesAlsoHolder;

	if ( $citiesAlsoHolder == '' ) {
		// echo 'http://www.bestlocalseotools.com/index3.php?lang=' . urlencode(substr(get_bloginfo('language'), 0, 2)) . '&key=' . lsp_get_option('lsp-api-key') . '&setType=' . urlencode($setType) . '&city=' . urlencode($city) . '&state=' . urlencode($state) . '&cityHome=' . urlencode($cityHome) . '&stateHome=' . urlencode($stateHome) . '&request=citiesAlso&count=20' . '&radius=' . lsp_get_option('lsp-radius' . $i) . '&ua=' . urlencode($_SERVER['HTTP_USER_AGENT']) . '&exclude=' . urlencode(lsp_get_option('lsp-exclude-cities' . $i)) . '&count=' . $cities_per_portfolio . '&lplimit=' . urlencode(lsp_get_option('lsp-local-population-limit' . $i)) . '&splimit=' . urlencode(lsp_get_option('lsp-state-population-limit' . $i)) . '&nplimit=' . urlencode(lsp_get_option('lsp-national-population-limit' . $i)) . '&iplimit=' . urlencode(lsp_get_option('lsp-international-population-limit' . $i)) . '&lpmaxlimit=' . urlencode(lsp_get_option('lsp-local-max-limit' . $i)) . '&spmaxlimit=' . urlencode(lsp_get_option('lsp-state-max-limit' . $i)) . '&npmaxlimit=' . urlencode(lsp_get_option('lsp-national-max-limit' . $i)) . '&ipmaxlimit=' . urlencode(lsp_get_option('lsp-international-max-limit' . $i)) . '&addcities=' . urlencode(lsp_get_option('lsp-add-cities' . $i)) . '&excludecities=' . urlencode(lsp_get_option('lsp-exclude-cities' . $i)) . '&addstates=' . urlencode(lsp_get_option('lsp-add-states' . $i)) . '&excludestates=' . urlencode(lsp_get_option('lsp-exclude-states' . $i)) . '&addcountries=' . urlencode(lsp_get_option('lsp-add-countries' . $i)) . '&localfocus=' . urlencode(lsp_get_option('lsp-local-focus' . $i)) . '&statefocus=' . urlencode(lsp_get_option('lsp-state-focus' . $i)) . '&countryfocus=' . urlencode(lsp_get_option('lsp-country-focus' . $i)) . '&internationalfocus=' . urlencode(lsp_get_option('lsp-international-focus' . $i)) . '&onlycities=' . urlencode($onlyCities) . '&onlystates=' . urlencode($onlyStates) . '&onlycountries=' . urlencode($onlyCountries) . '&projectsString=' . urlencode($projectsString) . '&huh=' . $ref . '&u=' . urlencode(lsp_get_option('siteurl')) . '&c2=0&m=' . urlencode(sanitize_email(lsp_get_option('admin_email')));
		$geo_string = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . lsp_get_option( 'lsp-api-key' ) . '&setType=' . urlencode( $setType ) . '&city=' . urlencode( $city ) . '&state=' . urlencode( $state ) . '&cityHome=' . urlencode( $cityHome ) . '&stateHome=' . urlencode( $stateHome ) . '&request=citiesAlso&count=20' . '&radius=' . lsp_get_option( 'lsp-radius' . $i ) . '&ua=' . urlencode( $_SERVER['HTTP_USER_AGENT'] ) . '&exclude=' . urlencode( lsp_get_option( 'lsp-exclude-cities' . $i ) ) . '&count=' . $cities_per_portfolio . '&lplimit=' . urlencode( lsp_get_option( 'lsp-local-population-limit' . $i ) ) . '&splimit=' . urlencode( lsp_get_option( 'lsp-state-population-limit' . $i ) ) . '&nplimit=' . urlencode( lsp_get_option( 'lsp-national-population-limit' . $i ) ) . '&iplimit=' . urlencode( lsp_get_option( 'lsp-international-population-limit' . $i ) ) . '&lpmaxlimit=' . urlencode( lsp_get_option( 'lsp-local-max-limit' . $i ) ) . '&spmaxlimit=' . urlencode( lsp_get_option( 'lsp-state-max-limit' . $i ) ) . '&npmaxlimit=' . urlencode( lsp_get_option( 'lsp-national-max-limit' . $i ) ) . '&ipmaxlimit=' . urlencode( lsp_get_option( 'lsp-international-max-limit' . $i ) ) . '&addcities=' . urlencode( lsp_get_option( 'lsp-add-cities' . $i ) ) . '&excludecities=' . urlencode( lsp_get_option( 'lsp-exclude-cities' . $i ) ) . '&addstates=' . urlencode( lsp_get_option( 'lsp-add-states' . $i ) ) . '&excludestates=' . urlencode( lsp_get_option( 'lsp-exclude-states' . $i ) ) . '&addcountries=' . urlencode( lsp_get_option( 'lsp-add-countries' . $i ) ) . '&localfocus=' . urlencode( lsp_get_option( 'lsp-local-focus' . $i ) ) . '&statefocus=' . urlencode( lsp_get_option( 'lsp-state-focus' . $i ) ) . '&countryfocus=' . urlencode( lsp_get_option( 'lsp-country-focus' . $i ) ) . '&internationalfocus=' . urlencode( lsp_get_option( 'lsp-international-focus' . $i ) ) . '&onlycities=' . urlencode( $onlyCities ) . '&onlystates=' . urlencode( $onlyStates ) . '&onlycountries=' . urlencode( $onlyCountries ) . '&projectsString=' . urlencode( $projectsString ) . '&huh=' . $ref . '&u=' . urlencode( lsp_get_option( 'siteurl' ) ) . '&c2=0&m=' . urlencode( sanitize_email( lsp_get_option( 'admin_email' ) ) ) );
		global $citiesAlsoHolder;
		$citiesAlsoHolder = $geo_string;
	} else {
		$geo_string = $citiesAlsoHolder;
	}

	if ( $geo_string == 'This account has reached its limit of requests for the Best Local SEO Tools plugin' ) {
		die( '</head><body>' . __( 'This account has reached its pageview request limit with ', 'lsp_text_domain' ) . '<a href=http://www.bestlocalseotools.com>Best Local SEO Tools</a>.</body></html>' );
		// echo "<script>";
		// echo "jQuery('html').html('" . __("This account has reached its pageview request limit with ", "lsp_text_domain") . "<a href=http://www.bestlocalseotools.com>Best Local SEO Tools</a>');</script>";
	}
	$geo_array        = explode( '|', $geo_string );
	$geo_string_final = '';

	$isthere = 0;
	$len     = count( $geo_array );
	$i       = 0;
	foreach ( $geo_array as $geo ) {
		$explodedgeo = explode( ',', $geo );
		if ( $geo == '' ) {
			break;
		}

		if ( strtolower( trim( $explodedgeo[0] ) ) == strtolower( trim( $city ) ) && strtolower( trim( $explodedgeo[1] ) ) == strtolower( trim( $state ) ) ) {
			$isthere = 1;
		} else {
			if ( $i != $len - 2 ) {
				if ( lsp_get_option( 'lsp-portfolio-format' ) == 'sectiontitles' || lsp_get_option( 'lsp-portfolio-format' ) == '' ) {
					$geo_string_final .= '<a href="' . home_url() . '/' . strtolower( trim( $explodedgeo[3] ) ) . '/' . str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . ', ' . $explodedgeo[1] . ' ' . ucwords( $main_portfolio_term ) . '</a>, ';
				}
				if ( lsp_get_option( 'lsp-portfolio-format' ) == 'citiesstateslist' ) {
					$geo_string_final .= '<a href="' . home_url() . '/' . strtolower( trim( $explodedgeo[3] ) ) . '/' . str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . ', ' . $explodedgeo[1] . '</a>, ';
				}
				if ( lsp_get_option( 'lsp-portfolio-format' ) == 'citieslist' ) {
					$geo_string_final .= '<a href="' . home_url() . '/' . strtolower( trim( $explodedgeo[3] ) ) . '/' . str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . '</a>, ';
				}
			} else {
				if ( lsp_get_option( 'lsp-portfolio-format' ) == 'sectiontitles' || lsp_get_option( 'lsp-portfolio-format' ) == '' ) {
					$geo_string_final .= __( ' and ', 'lsp_text_domain' ) . '<a href="' . home_url() . '/' . strtolower( trim( $explodedgeo[3] ) ) . '/' . str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . ', ' . $explodedgeo[1] . ' ' . ucwords( $main_portfolio_term ) . '</a>.';
				}
				if ( lsp_get_option( 'lsp-portfolio-format' ) == 'citiesstateslist' ) {
					$geo_string_final .= __( ' and ', 'lsp_text_domain' ) . '<a href="' . home_url() . '/' . strtolower( trim( $explodedgeo[3] ) ) . '/' . str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . ', ' . $explodedgeo[1] . '</a>.';
				}
				if ( lsp_get_option( 'lsp-portfolio-format' ) == 'citieslist' ) {
					$geo_string_final .= __( ' and ', 'lsp_text_domain' ) . '<a href="' . home_url() . '/' . strtolower( trim( $explodedgeo[3] ) ) . '/' . str_replace( ' ', '-', $main_portfolio_term ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[0] ) ) ) . '/' . str_replace( ' ', '-', strtolower( trim( $explodedgeo[1] ) ) ) . '/' . '">' . $explodedgeo[0] . '</a>.';
				}
			}
		}
		$i++;
	}

	if ( $isthere == 0 || lsp_get_option( 'lsp-publish-now' ) == 'preview' ) {
		$geo_string_final .= '<meta name="robots" content="noindex">';
	}

	$returnStr .= $geo_string_final;

	$i = '';
	if ( $phraseNumber > 1 ) {
		$i = $phraseNumber;
	}

	/*
	global $wpdb;
	$query2 = "SELECT a.meta_value as city, b.meta_value as state, d.meta_value as country FROM " . $wpdb->prefix . "postmeta a, " . $wpdb->prefix . "postmeta b, " . $wpdb->prefix . "postmeta c, " . $wpdb->prefix . "postmeta d WHERE c.meta_value LIKE '%%" . lsp_get_option('lsp-keyphrase' . $k) . "%%' AND a.meta_key='lsp_post_city' AND b.meta_key='lsp_post_state' AND c.meta_key='lsp_post_tags' AND d.meta_key='lsp_post_country' AND a.post_id = b.post_id AND b.post_id = c.post_id";
	global $wpdb;
	$citystates      = $wpdb->get_results($query2);
	$projectsCounter = 0;
	$projectsString .= "";
	foreach ($citystates as $citystate) {
		if ($projectsCounter > 100)
			break;
		$projectArray[$projectsCounter] = $citystate->city . "," . $citystate->state;
		$projectsString .= $citystate->city . "," . $citystate->state . "," . $citystate->country . "|";
		$projectsCounter++;
	}*/

	$z = '1';
	if ( $i > 1 ) {
		$z = $i;
	}
	$projectsString = site_url() . '/?portfolioquery=' . $z;

	$ref = 0;
	$ref = $_SERVER['HTTP_REFERER'] . '|' . site_url();

	global $citiesAlsoHolder2;

	if ( $citiesAlsoHolder2 == '' ) {
		$geo_string2 = lsp_wp_httpget( 'http://www.bestlocalseotools.com/index3.php?lang=' . urlencode( substr( get_bloginfo( 'language' ), 0, 2 ) ) . '&key=' . lsp_get_option( 'lsp-api-key' ) . '&setType=' . urlencode( $setType ) . '&city=' . urlencode( $city ) . '&state=' . urlencode( $state ) . '&cityHome=' . urlencode( $cityHome ) . '&stateHome=' . urlencode( $stateHome ) . '&request=citiesAlso&count=20' . '&radius=' . lsp_get_option( 'lsp-radius' . $i ) . '&ua=' . urlencode( $_SERVER['HTTP_USER_AGENT'] ) . '&exclude=' . urlencode( lsp_get_option( 'lsp-exclude-cities' . $i ) ) . '&count=' . $cities_per_portfolio . '&lplimit=&splimit=&nplimit=&iplimit=&lpmaxlimit=' . urlencode( lsp_get_option( 'lsp-local-population-limit' . $i ) ) . '&spmaxlimit=' . urlencode( lsp_get_option( 'lsp-state-population-limit' . $i ) ) . '&npmaxlimit=' . urlencode( lsp_get_option( 'lsp-national-population-limit' . $i ) ) . '&ipmaxlimit=' . urlencode( lsp_get_option( 'lsp-international-population-limit' . $i ) ) . '&addcities=' . urlencode( lsp_get_option( 'lsp-add-cities' . $i ) ) . '&excludecities=' . urlencode( lsp_get_option( 'lsp-exclude-cities' . $i ) ) . '&addstates=' . urlencode( lsp_get_option( 'lsp-add-states' . $i ) ) . '&excludestates=' . urlencode( lsp_get_option( 'lsp-exclude-states' . $i ) ) . '&addcountries=' . urlencode( lsp_get_option( 'lsp-add-countries' . $i ) ) . '&localfocus=' . urlencode( lsp_get_option( 'lsp-local-focus' . $i ) ) . '&statefocus=' . urlencode( lsp_get_option( 'lsp-state-focus' . $i ) ) . '&countryfocus=' . urlencode( lsp_get_option( 'lsp-country-focus' . $i ) ) . '&internationalfocus=' . urlencode( lsp_get_option( 'lsp-international-focus' . $i ) ) . '&onlycities=' . urlencode( $onlyCities ) . '&onlystates=' . urlencode( $onlyStates ) . '&onlycountries=' . urlencode( $onlyCountries ) . '&projectsString=' . urlencode( $projectsString ) . '&huh=' . $ref . '&c2=1' ); // echo $geo_string;
		global $citiesAlsoHolder2;
		$citiesAlsoHolder2 = $geo_string2;
	} else {
		$geo_string2 = $citiesAlsoHolder2;
	}

	$geo_array        = explode( '|', $geo_string2 );
	$geo_string_final = '';

	$getMore = 0;
	if ( lsp_get_option( 'lsp-api-smaller-cities' ) == 'yes' && ( lsp_get_option( 'lsp-local-population-limit' . $i ) || lsp_get_option( 'lsp-state-population-limit' . $i ) || lsp_get_option( 'lsp-national-international-limit' . $i ) || lsp_get_option( 'lsp-national-population-limit' . $i ) ) ) {
		if ( ! ( strstr( $setType, 'ities' ) ) ) {

			if ( lsp_get_option( 'lsp-served-sentence2' ) != '' ) {
				$returnStr .= lsp_get_option( 'lsp-served-sentence2' ) . ' ';
			} else {
				$returnStr .= __( ' Even though they did not get their own portfolio section, we do also serve the nearby cities of ', 'lsp_text_domain' );
			}
		}
		$getMore = 1;
	}

	$len = count( $geo_array );
	$i   = 0;
	foreach ( $geo_array as $geo ) {
		$explodedgeo = explode( ',', $geo );
		if ( $geo == '' ) {
			break;
		}
		if ( $i != $len - 2 ) {
			$geo_string_final .= $explodedgeo[0] . ', ';
		} else {
			$geo_string_final .= __( 'and', 'lsp_text_domain' ) . ' ' . $explodedgeo[0] . '.';
		}
		$i++;
	}

	if ( lsp_get_option( 'lsp-api-smaller-cities' ) == 'yes' && $getMore == 1 ) {
		$returnStr .= $geo_string_final;
	}

	$returnStr .= '';

	wp_reset_query();
	return $returnStr;

}


// wp_enqueue_script('lsp-color-picker', plugins_url('jscolor.js', __FILE__));
add_action( 'wp_before_admin_bar_render', 'lsp_admin_bar', 999 );

function lsp_admin_bar() {
	global $post;
	if ( $post->ID == lsp_get_option( 'lsp-ptemplate-id' ) ) {
		global $wp_admin_bar;
		$wp_admin_bar->remove_node( 'edit' );

		$args = array(
			'id'    => 'edit',
			'title' => __( 'Edit Portfolio Template', 'lsp_text_domain' ),
			'href'  => get_edit_post_link(),
		);

		$wp_admin_bar->add_node( $args );
	}
}


class lsp_fp_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'lspfp_widget',
			__( 'Featured Posts', 'lsp_text_domain' ),
			array(
				'description' => __( 'Featured Posts Widget & SEO Booster', 'lsp_text_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'lspfp_widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} else {
			echo $args['before_title'] . __( 'Featured Posts', 'lsp_text_domain' ) . $args['after_title'];
		}
		lsp_fp_widget_content();
		echo $args['after_widget'];

	}

}


class lsp_hp_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'lsphp_widget',
			__( 'Popular Products', 'lsp_text_domain' ),
			array(
				'description' => __( 'Popular Products Widget & SEO Booster', 'lsp_text_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'lsphp_widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} else {
			echo $args['before_title'] . __( 'Popular Products', 'lsp_text_domain' ) . $args['after_title'];
		}
		lsp_hp_widget_content();
		echo $args['after_widget'];

	}

}


function lsp_fp_widget_content() {
	global $post;
	global $wp_query;
	$newContent = '';

	$theseTypes = 'post';
	if ( lsp_get_option( 'lsp-archive-types' ) ) {
		$theseTypes = explode( ',', "'post','" . str_replace( ',', "','", lsp_get_option( 'lsp-archive-types' ) ) . "'" );
	}

	$paged    = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$my_query = new WP_Query(
		array(
			'post_count' => 5,
			'post_type'  => $theseTypes,
			'orderby'    => 'meta_value_num',
			'meta_key'   => '_seo-visits-count',
			'order'      => 'DESC',
			'paged'      => $paged,
		)
	);
	if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) {
			$my_query->the_post();
			$newContent .= "<a href='" . get_the_permalink() . "'>" . get_the_title() . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-widgetlink' ) != 'no' ) {
			$newContent .= "<a href='" . get_the_permalink( lsp_get_option( 'lsp-ptemplate-id2' ) ) . "'>" . __( 'More Featured Posts >>', 'lsp_text_domain' ) . '</a><br>';
		}
	}
	wp_reset_postdata();
	echo $newContent;
}

function lsp_hp_widget_content() {
	global $post;
	global $wp_query;
	$newContent = '';
	$paged      = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$my_query   = new WP_Query(
		array(
			'post_count' => 5,
			'post_type'  => 'product',
			'orderby'    => 'meta_value_num',
			'meta_key'   => '_seo-visits-count',
			'order'      => 'DESC',
			'paged'      => $paged,
		)
	);
	if ( $my_query->have_posts() ) {
		while ( $my_query->have_posts() ) {
			$my_query->the_post();
			$newContent .= "<a href='" . get_the_permalink() . "'>" . get_the_title() . '</a><br>';
		}
		if ( lsp_get_option( 'lsp-widgetlinkproducts' ) != 'no' ) {
			$newContent .= "<a href='" . get_the_permalink( lsp_get_option( 'lsp-ptemplate-id3' ) ) . "'>" . __( 'More Popular Products >>', 'lsp_text_domain' ) . '</a><br>';
		}
	}
	wp_reset_postdata();
	echo $newContent;
}

function lsp_fp_load_widget() {
	 register_widget( 'lsp_fp_widget' );
}
add_action( 'widgets_init', 'lsp_fp_load_widget' );

function lsp_hp_load_widget() {
	 register_widget( 'lsp_hp_widget' );
}
add_action( 'widgets_init', 'lsp_hp_load_widget' );




function lsp_localproject_modify_columns( $columns ) {
	$new_columns      = array(
		'lsp_post_city'  => __( 'City', 'lsp_text_domain' ),
		'lsp_post_state' => __( 'State', 'lsp_text_domain' ),
	);
	$filtered_columns = array_merge( $columns, $new_columns );
	return $filtered_columns;
}
add_filter( 'manage_localproject_posts_columns', 'lsp_localproject_modify_columns' );

function lsp_localproject_custom_column_content( $column ) {
	global $post;
	switch ( $column ) {
		case 'lsp_post_city': {
			$content = lsp_get_post_meta( $post->ID, 'lsp_post_city', true );
			echo $content;
		}
			break;

		case 'lsp_post_state': {
			$content = lsp_get_post_meta( $post->ID, 'lsp_post_state', true );
			echo $content;
		}
			break;
	}
}
add_action( 'manage_localproject_posts_custom_column', 'lsp_localproject_custom_column_content' );

function lsp_localproject_custom_columns_sortable( $columns ) {
	$columns['lsp_post_city']  = 'lsp_post_city';
	$columns['lsp_post_state'] = 'lsp_post_state';
	return $columns;
}

add_filter( 'manage_edit-localproject_sortable_columns', 'lsp_localproject_custom_columns_sortable' );

add_action( 'pre_get_posts', 'lsp_localproject_orderby' );
function lsp_localproject_orderby( $query ) {
	if ( ! is_admin() ) {
		return;
	}
	$orderby = $query->get( 'orderby' );
	if ( 'lsp_post_city' == $orderby ) {
		$query->set( 'meta_key', 'lsp_post_city' );
	}
	if ( 'lsp_post_state' == $orderby ) {
		$query->set( 'meta_key', 'lsp_post_state' );
	}

}
































class lsp_sp_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'lspsp_widget',
			__( 'Portfolio by Service', 'lsp_text_domain' ),
			array(
				'description' => __( 'Services Filter Widget', 'lsp_text_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'lspsp_widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} else {
			echo $args['before_title'] . __( 'Portfolio by Service', 'lsp_text_domain' ) . $args['after_title'];
		}
		lsp_sp_widget_content();
		echo $args['after_widget'];

	}

}


class lsp_ip_widget extends WP_Widget {


	function __construct() {
		parent::__construct(
			'lspip_widget',
			__( 'Portfolio by Industry', 'lsp_text_domain' ),
			array(
				'description' => __( 'Industry Filter Widget', 'lsp_text_domain' ),
			)
		);
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'lspip_widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} else {
			echo $args['before_title'] . __( 'Portfolio by Industry', 'lsp_text_domain' ) . $args['after_title'];
		}
		lsp_ip_widget_content();
		echo $args['after_widget'];

	}

}


function lsp_sp_widget_content() {
	global $post;
	global $wp_query;

	$terms = get_terms(
		array(
			'taxonomy'   => 'servicesportfolio',
			'hide_empty' => false,
		)
	);
	foreach ( $terms as $term ) {
		echo "<a href='" . get_term_link( $term->slug, 'servicesportfolio' ) . "'>" . $term->name . '</a><br>';
	}
}

function lsp_ip_widget_content() {
	global $post;
	global $wp_query;

	$terms = get_terms(
		array(
			'taxonomy'   => 'industriesportfolio',
			'hide_empty' => false,
		)
	);
	foreach ( $terms as $term ) {
		echo "<a href='" . get_term_link( $term->slug, 'industriesportfolio' ) . "'>" . $term->name . '</a><br>';
	}
}

function lsp_sp_load_widget() {
	 register_widget( 'lsp_sp_widget' );
}
add_action( 'widgets_init', 'lsp_sp_load_widget' );

function lsp_ip_load_widget() {
	 register_widget( 'lsp_ip_widget' );
}
add_action( 'widgets_init', 'lsp_ip_load_widget' );





function lsp_metacontent( $content ) {
	global $post;
	$post       = get_post();
	$thispostid = get_the_ID();
	$returnStr  = $content;
	if ( get_post_type() == 'localproject' ) {
		$returnStr .= "<div style='clear:both'>";
		$returnStr .= __( 'Client Name: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_client_name', true ) . '';

		if ( lsp_get_option( 'lsp-star-minimum' ) == '' ) {
			$filterholder = 4;
		} else {
			$filterholder = lsp_get_option( 'lsp-star-minimum' );
		}

		if ( lsp_get_post_meta( $thispostid, 'lsp_post_score', true ) && lsp_get_post_meta( $thispostid, 'lsp_post_score', true ) >= $filterholder ) {
			$starString = '';
			for ( $i = 0; $i < lsp_get_post_meta( $thispostid, 'lsp_post_score', true ); $i++ ) {
				$starString .= "<img src='" . plugins_url() . "/best-local-seo-tools/star-rating/singlestar.gif'> ";
			}

			$returnStr .= '<br>' . __( '1 - 5 Star Review Score: ', 'lsp_text_domain' ) . $starString;
		}

		if ( lsp_get_post_meta( $thispostid, 'lsp_post_testimonial', true ) ) {
			$returnStr .= '<br>' . __( 'Testimonial: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_testimonial', true );
		}

		$returnStr .= '<br>' . __( 'City: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_city', true );
		$returnStr .= '<br>' . __( 'State: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_state', true );
		if ( lsp_get_option( 'lsp-biztype' ) != 'ec' ) {
			$returnStr .= '<br>' . __( 'Services Used: ', 'lsp_text_domain' ) . str_replace( ',', ', ', ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_tags', true ) ) );
		} else {
			$returnStr .= '<br>' . __( 'Products / Services Provided: ', 'lsp_text_domain' ) . str_replace( ',', ', ', ucwords( lsp_get_post_meta( $thispostid, 'lsp_post_tags', true ) ) );
		}

		if ( lsp_get_post_meta( $thispostid, 'lsp_post_industry', true ) ) {
			$returnStr .= '<br>' . __( 'Industry / Industries: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_industry', true );
		}

		if ( lsp_get_option( 'lsp-worked-location' ) == 'yes' ) {
			if ( lsp_get_post_meta( $thispostid, 'lsp_post_workedwith', true ) ) {
				$returnStr .= '<br>' . __( 'Worked With: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_workedwith', true );
			}
			if ( lsp_get_post_meta( $thispostid, 'lsp_post_storelocation', true ) ) {
				$returnStr .= '<br>' . __( 'Store Location: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_storelocation', true );
			}
		}

		if ( lsp_get_post_meta( $thispostid, 'lsp_post_client_website', true ) ) {
			$theURL = '';
			if ( ! strstr( strtolower( lsp_get_post_meta( $thispostid, 'lsp_post_client_website', true ) ), 'http' ) ) {
				$theURL .= 'http://';
			}

			$theURL .= strtolower( lsp_get_post_meta( $thispostid, 'lsp_post_client_website', true ) );

			$returnStr .= '<br>' . __( 'Client Website/URL: ', 'lsp_text_domain' ) . "<a href='" . $theURL . "' target='_blank'>" . lsp_get_post_meta( $thispostid, 'lsp_post_client_website', true ) . '</a>';
		}

		if ( lsp_get_post_meta( $thispostid, 'lsp_post_client_phone', true ) ) {
			$returnStr .= '<br>' . __( 'Client Phone Number: ', 'lsp_text_domain' ) . lsp_get_post_meta( $thispostid, 'lsp_post_client_phone', true );
		}

		if ( current_user_can( 'administrator' ) ) {
			$returnStr .= "<br><a href='" . get_edit_post_link( $thispostid ) . "'>" . __( 'Edit', 'lsp_text_domain' ) . '</a>';
		}
	}
	return $returnStr;
}
add_filter( 'the_content', 'lsp_metacontent' );




















function lsp_update_redirect( $oldurl, $newurl ) {
	global $wpdb;
	$query   = 'SELECT new_url FROM ' . $wpdb->prefix . "lsp_redirects WHERE old_url = '%s'";
	$query   = $wpdb->prepare( $query, $oldurl );
	$results = $wpdb->get_results( $query );
	$holder  = '';
	foreach ( $results as $result ) {
		$holder = $result->new_url;
	}
	echo 'LUR4';
	if ( $holder ) {
		$query = 'UPDATE ' . $wpdb->prefix . "lsp_redirects SET new_url = '%s' WHERE old_url = '%s'";
		$query = $wpdb->prepare( $query, $newurl, $oldurl );
		$wpdb->query( $query );
	} else {
		$query = 'INSERT INTO ' . $wpdb->prefix . "lsp_redirects VALUES ('%s' , '%s')";
		$query = $wpdb->prepare( $query, $oldurl, $newurl );
		$wpdb->query( $query );
	}

}

function lsp_get_redirect( $oldurl ) {
	global $wpdb;
	$query = 'SELECT new_url FROM ' . $wpdb->prefix . "lsp_redirects WHERE old_url = '%s'";
	$query = $wpdb->prepare( $query, $oldurl );

	$results = $wpdb->get_results( $query );

	$holder = '';
	if ( $results ) {
		foreach ( $results as $result ) {
			if ( $result->new_url ) {
				$holder = $result->new_url;
			}
		}
	}
	return $holder;
}



function lsp_redirects_activate() {
	global $wpdb;

	$charset_collate = ! empty( $wpdb->charset ) ? "DEFAULT CHARACTER SET $wpdb->charset" : '';

	$table_prefix = $wpdb->base_prefix;

	$sql = "CREATE TABLE {$table_prefix}lsp_redirects (
    old_url varchar(3000) NOT NULL,
    new_url varchar(3000) DEFAULT '' NOT NULL
  ) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	$sql = "CREATE TABLE {$table_prefix}lsp_images (
    img_url varchar(3000) NOT NULL,
    img_tags varchar(3000) DEFAULT '' NOT NULL
  ) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	$sql = "CREATE TABLE {$table_prefix}lsp_linkpoints (
    url varchar(3000) NOT NULL,
    linkwordpoints TEXT DEFAULT '' NOT NULL
  ) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	$sql = "CREATE TABLE {$table_prefix}lsp_localprojects (
    lsp_lp_postid INT NOT NULL COMMENT '',
    lsp_lp_tags VARCHAR(255) COMMENT '',
    lsp_lp_latitude FLOAT COMMENT '',
    lsp_lp_longitude FLOAT COMMENT '',
    lsp_lp_status VARCHAR(90) COMMENT '',
    PRIMARY KEY (lsp_lp_postid),
    KEY index3 (lsp_lp_latitude),
    KEY index4 (lsp_lp_longitude),
    KEY index5 (lsp_lp_status)
  ) $charset_collate;";

	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $sql );

	if ( get_option( 'lsp-schema-updated' ) != 'yes' ) {
		lsp_update_old_schema();
	}
	update_option( 'lsp-schema-updated', 'yes' );

	global $wpdb;
	$sql = "ALTER TABLE {$table_prefix}lsp_localprojects ADD FULLTEXT index6 (lsp_lp_tags);";
	$wpdb->query( $sql );

}
register_activation_hook( __FILE__, 'lsp_redirects_activate' );


function lsp_update_old_schema() {
	global $wpdb;
	global $db;

	global $wpdb;
	$queryStart = 'SELECT ID FROM ' . $wpdb->prefix . "posts WHERE post_type = 'localproject' AND post_status = 'publish' ";
	$postids    = $wpdb->get_results( $query );
	foreach ( $postids as $postid ) {
		$postid = $postid->ID;
		$tags   = get_post_meta( $postid, 'lsp_post_tags', true );
		$lat    = get_post_meta( $postid, 'lsp_post_latitude', true );
		$long   = get_post_meta( $postid, 'lsp_post_longitude', true );
		$status = get_post_status( $postid );
		$query  = $wpdb->prepare( 'REPLACE INTO ' . $wpdb->prefix . 'lsp_localprojects VALUES (%d, %s, %f, %f, %2)', $postid, $tags, $lat, $long, $status );
		$wpdb->query( $query );
	}

}



add_action( 'template_redirect', 'lsp_redirect_redirect' );
function lsp_redirect_redirect() {
	if ( get_option( 'lsp-activated' ) == 'yes' ) {
		global $post;
		$plink = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		global $post;
		if ( $post->ID ) {
			$plink = $post->ID;
		}
		if ( substr( $plink, -1 ) == '/' ) {
			$plink = substr( $plink, 0, -1 );
		}

		if ( lsp_get_redirect( 'lspredirect_' . $plink ) && lsp_get_redirect( 'lspredirect_' . $plink ) != $post->ID ) {

			$flink2 = rtrim( get_permalink( lsp_get_redirect( 'lspredirect_' . $plink ) ), '/' );
			$plink2 = rtrim( $plink, '/' );
			$blink2 = rtrim( get_site_url(), '/' );

			if ( $flink2 != $plink2 && $flink2 != $blink2 ) {
				 wp_redirect( get_permalink( lsp_get_redirect( 'lspredirect_' . $plink ) ), 301 );
			}
			wp_reset_postdata();

		}
	}
}



function lsp_deactivate() {

	global $wpdb;
	$query2 = 'SELECT * FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_lsp_old_name'";

	$results = $wpdb->get_results( $query2 );

	foreach ( $results as $post ) {

		$thispostid = $post->post_id;

		if ( get_post_meta( $thispostid, '_lsp_old_name', true ) ) {
			// echo $thispostid . " " . get_post_meta($thispostid,'_lsp_old_name', true) . " ";
			if ( lsp_get_redirect( 'lspredirect_' . get_permalink( $post->post_id ) ) ) {
				lsp_update_redirect( 'lspredirect_' . get_permalink( $post->post_id ), '' );
			}

			if ( lsp_get_redirect( 'lspredirect_' . $post->post_id ) ) {
				lsp_update_redirect( 'lspredirect_' . $post->post_id, '' );
			}

			wp_update_post(
				array(
					'ID'        => $post->post_id,
					'post_name' => get_post_meta( $thispostid, '_lsp_old_name', true ),
				)
			);
		}

		if ( get_post_meta( $thispostid, '_focuskwold' ) != '' && get_post_meta( $thispostid, '_focuskwold' ) != 'lsp no value' ) {
			wpseo_set_value( 'focuskw', get_post_meta( $thispostid, '_focuskwold' ), $thispostid );
		}
		if ( get_post_meta( $thispostid, '_focuskwold' ) == 'lsp no value' ) {
			wpseo_set_value( 'focuskw', '', $thispostid );
		}

		if ( get_post_meta( $thispostid, '_titleold' ) != '' && get_post_meta( $thispostid, '_titleold' ) != 'lsp no value' ) {
			wpseo_set_value( 'title', get_post_meta( $thispostid, '_titleold' ), $thispostid );
		}
		if ( get_post_meta( $thispostid, '_titleold' ) == 'lsp no value' ) {
			wpseo_set_value( 'title', '', $thispostid );
		}

		if ( get_post_meta( $thispostid, '_metadescold' ) != '' && get_post_meta( $thispostid, '_metadescold' ) != 'lsp no value' ) {
			wpseo_set_value( 'metadesc', get_post_meta( $thispostid, '_metadescold' ), $thispostid );
		}
		if ( get_post_meta( $thispostid, '_metadescold' ) == 'lsp no value' ) {
			wpseo_set_value( 'metadesc', '', $thispostid );
		}

		if ( get_post_meta( $thispostid, '_metakeyold' ) != '' && get_post_meta( $thispostid, '_metakeyold' ) != 'lsp no value' ) {
			wpseo_set_value( 'metakey', get_post_meta( $thispostid, '_metakeyold' ), $thispostid );
		}
		if ( get_post_meta( $thispostid, '_metakeyold' ) == 'lsp no value' ) {
			wpseo_set_value( 'metakey', '', $thispostid );
		}

		if ( get_post_meta( $thispostid, '_focuskeywordsold', true ) != '' ) {
			update_post_meta( $thispostid, '_yoast_wpseo_focuskeywords', get_post_meta( $thispostid, '_focuskeywordsold', true ) );
		}
	}

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_focuskwold'";
	$results = $wpdb->query( $query2 );

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_titleold'";
	$results = $wpdb->query( $query2 );

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_metadescold'";
	$results = $wpdb->query( $query2 );

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_metakeyold'";
	$results = $wpdb->query( $query2 );

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_focuskeywordsold'";
	$results = $wpdb->query( $query2 );

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "postmeta WHERE meta_key = '_lsp_old_name'";
	$results = $wpdb->query( $query2 );

	$query2  = 'DELETE FROM ' . $wpdb->prefix . "lsp_redirects WHERE old_url LIKE '%%lspredirect_%%'";
	$results = $wpdb->query( $query2 );

	update_option( 'lsp-activated', 'no' );
	update_option( 'lsp-prescription', '' );

	// die("IT RAN");
}

register_deactivation_hook( __FILE__, 'lsp_deactivate' );































add_action( 'admin_init', 'lsp_meta_box3' );
function lsp_meta_box3() {

	$post_types = get_post_types( array( 'public' => true ) );

	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}

	$pluginHolder = get_plugins();

	foreach ( $post_types as $post_type ) {

		// if($pluginHolder['wordpress-seo-premium/wp-seo-premium.php']['Name'] || $pluginHolder['wordpress-seo/wp-seo.php']['Name']) add_meta_box('lsp_meta_box_details2', __('Advanced / Yoast Integration / Overrides for BLST','lsp_text_domain'), 'lsp_meta_box_details_display2',$post_type,'normal','low');
		if ( $post_type != 'localproject' ) {
			add_meta_box( 'lsp_meta_box_details3', __( 'Best Local SEO Tools', 'lsp_text_domain' ), 'lsp_meta_box_details_display3', $post_type, 'side', 'high' );
		}
	}

}




function lsp_meta_box_details_display3( $localproject ) {
	$haveAny      = 0;
	$pluginHolder = get_plugins();
	if ( $pluginHolder['wordpress-seo-premium/wp-seo-premium.php']['Name'] || $pluginHolder['wordpress-seo/wp-seo.php']['Name'] ) :
		$presholder = get_option( 'lsp-prescription' );
		$permholder = get_permalink();

		$presholder = (array) $presholder;
		$permholder = rtrim( $permholder, '/' );
		// $focusholder = $presholder[$permholder];
		global $post;

		$haveAny = 1;
		?>


		<?php echo $focusholder; ?>
<?php endif; ?>


<!--
<b><?php _e( 'Suggested Topic(s) To Write About:', 'lsp_text_domain' ); ?></b>
<br><a href="#"><?php _e( 'Show', 'lsp_text_domain' ); ?></a>
<br>-->
<b><?php _e( "This Content's Specified Topic(s):", 'lsp_text_domain' ); ?></b>
<br>

	<?php
	global $post;
	$lsp_post_content_topics = get_post_meta( $post->ID, 'lsp_post_content_topics', true );
	?>
<input type='text' style="width:100%" id="lsp_post_content_topics" name="lsp_post_content_topics" placeholder ="<?php _e( '(comma separate)', 'lsp_text_domain' ); ?>" value='<?php echo $lsp_post_content_topics; ?>' /><input name="publish4" id="publish4" class="button button-primary button-large" value="<?php _e( 'Analyze', 'lsp_text_domain' ); ?>" type="submit"><!--<input name="publish7" id="publish7" class="button button-primary button-large" value="<?php _e( 'Analyze+Set Test Titles', 'lsp_text_domain' ); ?>" type="submit">-->


<br><!--
<b><?php _e( 'Suggested Focus Keyword(s):', 'lsp_text_domain' ); ?></b><br>
	<?php get_post_meta( $post->ID, 'lsp-focus-keywords', true ); ?>
<div id="suggestedfocus">
	<?php _e( 'Analyze to See', 'lsp_text_domain' ); ?></div>-->
<b><?php _e( 'Suggested Focus Keyword(s) & Keywords To Work Into Content/Titles:', 'lsp_text_domain' ); ?></b>
<div id="suggestedworkin">
	<?php _e( 'Analyze to See', 'lsp_text_domain' ); ?></div>

	<?php

	$termsArray1  = unserialize( get_option( 'lsp-serialized1' ) );
	$termsArray2  = unserialize( get_option( 'lsp-serialized2' ) );
	$termsArray3  = unserialize( get_option( 'lsp-serialized3' ) );
	$termsArray4  = unserialize( get_option( 'lsp-serialized4' ) );
	$termsArray5  = unserialize( get_option( 'lsp-serialized5' ) );
	$termsArray6  = unserialize( get_option( 'lsp-serialized6' ) );
	$termsArray7  = unserialize( get_option( 'lsp-serialized7' ) );
	$termsArray8  = unserialize( get_option( 'lsp-serialized8' ) );
	$termsArray9  = unserialize( get_option( 'lsp-serialized9' ) );
	$termsArray10 = unserialize( get_option( 'lsp-serialized10' ) );

	if ( $termsArray1 ) {
		$termsArrayHolder = array_merge( $termsArray1, $termsArray2 );
	}
	if ( $termsArray2 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray3 );
	}
	if ( $termsArray3 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray4 );
	}
	if ( $termsArray4 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray5 );
	}
	if ( $termsArray5 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray6 );
	}
	if ( $termsArray6 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray7 );
	}
	if ( $termsArray7 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray8 );
	}
	if ( $termsArray8 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray9 );
	}
	if ( $termsArray9 ) {
		$termsArrayHolder = array_merge( $termsArrayHolder, $termsArray10 );
	}

	$suggestionsString = '';
	if ( is_array( $termsArrayHolder ) ) {
		foreach ( $termsArrayHolder as $term ) {
			if ( strstr( $term[0], $focusholder ) ) {
				$suggestionsString .= $term[0] . '<br>';
			}
		}
	}

	?>


	<?php
	if ( $suggestionsString ) :
		$haveAny = 1;
		?>
<br>
<b><?php _e( 'Term Suggestions to Work Into The Content:', 'lsp_text_domain' ); ?></b><br>

<div style="max-height:200px; width:100%; overflow-y:scroll;">
		<?php echo $suggestionsString; ?>
 </div>
<?php endif; ?>


	<?php if ( 0 ) : ?>
 <b>
		<?php
		$haveAny = 1;
		_e( 'Consider Adding a Page Focused On:', 'lsp_text_domain' );
		?>
  </b><br>
 Do E<br>
<?php endif; ?>


	<?php if ( $haveAny == 0 ) : ?>
<script>
jQuery(document).ready(function(){
  //jQuery('#lsp_meta_box_details3').hide();
});
  </script>
	<?php endif; ?>
<!--<input name="publish9" id="publish9" class="button button-primary button-large" value="<?php _e( 'Analyze Auto-Optimize & Publish', 'lsp_text_domain' ); ?>" type="submit">
-->
	<?php
}











function lsp_edit_footer() {
	add_filter( 'admin_footer_text', 'lsp_edit_text', 11 );
}

function lsp_edit_text( $content ) {
	if ( $_GET['page'] == 'localseoportfolio.php' ) {
		flush_rewrite_rules();
	}
	return '';
}

add_action( 'admin_init', 'lsp_edit_footer' );













/*
add_filter('template_include','lsp_page_template',99);
function lsp_page_template($template){
  global $post;
  if(lsp_get_option('lsp-ptemplate-id')==$post->ID && strstr($_SERVER['REQUEST_URI'],'feedback')){
	$new_template = locate_template(array('page.php'));
	if('' != $new_template){
	  return $new_template;
	}
  }
}*/




// include 'newcode.php';
?>

<?php














add_action('admin_init', 'lsp_meta_box5');
function lsp_meta_box5()
{
    add_meta_box('lsp_meta_box_details5', __('SEO / A/B Test Details', 'lsp_text_domain'), 'lsp_meta_box_details_display5', 'seoabtest', 'normal', 'high');
    
    $post_types = get_post_types(array(
        'public' => true
    ));
    
    if (!function_exists('get_plugins')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
}


function lsp_meta_box_details_display5($seoabtest)
{

    $lsp_post_testtype     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_testtype', true));
    $lsp_post_swps     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_swps', true));
    $lsp_post_ttyesno    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_ttyesno', true));
    $lsp_post_tt     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_tt', true));

    $lsp_post_cssjsyesno    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_cssjsyesno', true));
    $lsp_post_cssjs    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_cssjs', true));
    $lsp_post_titlemeta    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_titlemeta', true));



    $lsp_post_v1     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v1', true));
    $lsp_post_v2     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v2', true));
    $lsp_post_v3     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v3', true));
    $lsp_post_v4     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v4', true));
    $lsp_post_v5     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v5', true));
    $lsp_post_v6     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v6', true));
    $lsp_post_v7     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v7', true));
    $lsp_post_v8     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v8', true));
    $lsp_post_v9     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v9', true));
    $lsp_post_v10    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v10', true));
    $lsp_post_v11    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v11', true));
    $lsp_post_v12    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v12', true));
    $lsp_post_v13    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v13', true));
    $lsp_post_v14    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v14', true));
    $lsp_post_v15    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v15', true));
    $lsp_post_v16    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v16', true));
    $lsp_post_v17    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v17', true));
    $lsp_post_v18    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v18', true));
    $lsp_post_v19    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v19', true));
    $lsp_post_v20    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_v20', true));
    $lsp_post_tmtarget    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_tmtarget', true));

    $lsp_post_conversionurls    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_conversionurls', true));

    $lsp_post_mvname    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_mvname', true));

    $lsp_post_before_title          = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_before_title', true));
    $lsp_post_after_title         = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_after_title', true));
    $lsp_post_before_description    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_before_description', true));
    $lsp_post_after_description     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_after_description', true));
    $lsp_post_make_description      = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_make_description', true));


    $lsp_post_ab_for     = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_ab_for', true));
    $lsp_post_ab_where   = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_ab_where', true));
    $lsp_post_ab_comp    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_ab_comp', true));
    $lsp_post_ab_value   = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_ab_value', true));
    $lsp_post_find            = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_find', true));

    $lsp_post_targettraffic    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_targettraffic', true));
    $lsp_post_targetpercent    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_targetpercent', true));
    $lsp_post_targetage1    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_targetage1 ', true));
    $lsp_post_targetage2    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_targetage2', true));
    $lsp_post_delay    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_delay', true));
    $lsp_post_duration    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_duration', true));

    $lsp_post_apply         = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_apply', true));

    $lsp_post_testweight    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_testweight', true));




?>


<?php if(lsp_get_option('lsp-agree')!="yes" && lsp_get_option('lsp-agree')!="yes2" ):?>
<?php _e("Acceptance of data-sending back and forth is required to use this plugin. This can be set in the settings.", 'lsp_text_domain'); ?>
   <?php die("");
   endif; ?>

  <?php //if(!(lsp_get_option('lsp-agree')=="yes" || lsp_get_option('lsp-agree')=="yes2" )) ?>
  <table style="width:100%">


 <tr>
      <td class="specialtd"><?php
    _e("Test Type", "lsp_text_domain");
?>:</td><td style="width:100%">
      

  <select id="lsp_post_testtype" name="lsp_post_testtype">
      <option value="regular"<?php
    if ($lsp_post_testtype == "regular"):
?> selected<?php
    endif;
?>><?php
    _e('Regular A/B Test', 'lsp_text_domain');
?></option>
      <option value="seo"<?php
    if ($lsp_post_testtype == "seo"):
?> selected<?php
    endif;
?>><?php
    _e('Site-wide SEO A/B Test - Titles & Descriptions', 'lsp_text_domain');
?></option>

 <option value="seocontent"<?php
    if ($lsp_post_testtype == "seo"):
?> selected<?php
    endif;
?>><?php
    _e('SEO A/B Test - Page Content', 'lsp_text_domain');
?></option>

<option value="template"<?php
    if ($lsp_post_testtype == "template"):
?> selected<?php
    endif;
?>><?php
    _e('Page Template / Theme Regular A/B Test', 'lsp_text_domain');
?></option>



<option value="cssjs"<?php
    if ($lsp_post_testtype == "cssjs"):
?> selected<?php
    endif;
?>><?php
    _e('CSS/Javascript Regular A/B Test', 'lsp_text_domain');
?></option>

    </select>

      </td>

    </tr>

<!--
    <tr>
      <td><?php
    _e("Conversion URL(s)", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_conversionurls" value='<?php
    echo $lsp_post_conversionurls;
?>' /></td>
    </tr>
-->

    <tr>

<tr class="tt">
    
      <td class="specialtd"><?php
    _e("Theme / Template to Use", "lsp_text_domain");
?>:</td><td style="width:100%">
      
<input type='text' style="width:100%;min-width:200px" name="lsp_post_tt" value='<?php
    echo $lsp_post_tt;
?>' />

      </td>

    </tr>





<tr class="cssjs">
    
      <td class="specialtd"><?php
    _e("CSS / JS Code (added to header)", "lsp_text_domain");
?>:</td><td style="width:100%">
      
<input type='text' style="width:100%;min-width:200px" name="lsp_post_cssjs" value='<?php
    echo $lsp_post_cssjs;
?>' />

      </td>
    </tr>

    <tr class="v1">

      <td class="specialtd"><span class="vtext"><?php
    _e("Variation #1", "lsp_text_domain");
    ?></span>


    <?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test1Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test1Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test1Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test1Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>




    :</td><td style="width:100%">
      
<input id="1" type='text' style="width:100%;min-width:200px" name="lsp_post_v1" value='<?php
    echo $lsp_post_v1;
?>' />

      </td>
    </tr>
    <tr class="versions v2">
      <td class="specialtd"><?php
    _e("Variation #2", "lsp_text_domain");
?>

<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test2Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test2Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test2Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test2Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:

</td><td style="width:100%">
      
<input id="2" type='text' style="width:100%;min-width:200px" name="lsp_post_v2" value='<?php
    echo $lsp_post_v2;
?>' />

      </td>
    </tr>
    <tr class="versions v3">
    
      <td class="specialtd"><?php
    _e("Variation #3", "lsp_text_domain");
?>

<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test3Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test3Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test3Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test3Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:


</td><td style="width:100%">
      
<input id="3" type='text' style="width:100%;min-width:200px" name="lsp_post_v3" value='<?php
    echo $lsp_post_v3;
?>' />

      </td>
    </tr>
    <tr class="versions v4">
    
      <td class="specialtd"><?php
    _e("Variation #4", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test4Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test4Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test4Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test4Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:


</td><td style="width:100%">
      
<input id="4" type='text' style="width:100%;min-width:200px" name="lsp_post_v4" value='<?php
    echo $lsp_post_v4;
?>' />

      </td>
    </tr>
 

    <tr class="versions v5">
      <td class="specialtd"><?php
    _e("Variation #5", "lsp_text_domain");
?>

<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test5Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test5Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test5Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test5Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:

</td><td style="width:100%">
      
<input id="5" type='text' style="width:100%;min-width:200px" name="lsp_post_v5" value='<?php
    echo $lsp_post_v5;
?>' />

      </td>
    </tr>
    <tr class="versions v6">
      <td class="specialtd"><?php
    _e("Variation #6", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test6Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test6Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test6Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test6Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="6" type='text' style="width:100%;min-width:200px" name="lsp_post_v6" value='<?php
    echo $lsp_post_v6;
?>' />

      </td>
    </tr>
    <tr class="versions v7">
      <td class="specialtd"><?php
    _e("Variation #7", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test7Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test7Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test7Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test7Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="7" type='text' style="width:100%;min-width:200px" name="lsp_post_v7" value='<?php
    echo $lsp_post_v7;
?>' />

      </td>
    </tr>
    <tr class="versions v8">
      <td class="specialtd"><?php
    _e("Variation #8", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test8Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test8Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test8Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test8Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="8" type='text' style="width:100%;min-width:200px" name="lsp_post_v8" value='<?php
    echo $lsp_post_v8;
?>' />

      </td>
    </tr>
    <tr class="versions v9">
      <td class="specialtd"><?php
    _e("Variation #9", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test9Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test9Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test9Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test9Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="9" type='text' style="width:100%;min-width:200px" name="lsp_post_v9" value='<?php
    echo $lsp_post_v9;
?>' />

      </td>
    </tr>
    <tr class="versions v10">
      <td class="specialtd"><?php
    _e("Variation #10", "lsp_text_domain");
?>

<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test10Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test10Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test10Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test10Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:

:</td><td style="width:100%">
      
<input id="10" type='text' style="width:100%;min-width:200px" name="lsp_post_v10" value='<?php
    echo $lsp_post_v10;
?>' />

      </td>
    </tr>


 <tr class="versions v11">
      <td class="specialtd"><?php
    _e("Variation #11", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test11Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test11Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test11Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test11Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="11" type='text' style="width:100%;min-width:200px" name="lsp_post_v11" value='<?php
    echo $lsp_post_v11;
?>' />

      </td>
    </tr>
    <tr class="versions v12">
      <td class="specialtd"><?php
    _e("Variation #12", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test12Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test12Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test12Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test12Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:

    :</td><td style="width:100%">
      
<input id="12" type='text' style="width:100%;min-width:200px" name="lsp_post_v12" value='<?php
    echo $lsp_post_v12;
?>' />

      </td>
    </tr>
    <tr class="versions v13">
    
      <td class="specialtd"><?php
    _e("Variation #13", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test13Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test13Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test13Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test13Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="13" type='text' style="width:100%;min-width:200px" name="lsp_post_v13" value='<?php
    echo $lsp_post_v13;
?>' />

      </td>
    </tr>

    <tr class="versions v14">
    
      <td class="specialtd"><?php
    _e("Variation #14", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test14Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test14Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test14Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test14Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="14" type='text' style="width:100%;min-width:200px" name="lsp_post_v14" value='<?php
    echo $lsp_post_v14;
?>'/>

      </td>
    </tr>
 
    <tr class="versions v15">
      <td class="specialtd"><?php
    _e("Variation #15", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test15Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test15Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test15Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test15Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="15" type='text' style="width:100%;min-width:200px" name="lsp_post_v15" value='<?php
    echo $lsp_post_v15;
?>' />

      </td>
    </tr>

    <tr class="versions v16">
      <td class="specialtd"><?php
    _e("Variation #16", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test16Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test16Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test16Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test16Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="16" type='text' style="width:100%;min-width:200px" name="lsp_post_v16" value='<?php
    echo $lsp_post_v16;
?>' />

      </td>
    </tr>

    <tr class="versions v17">
      <td class="specialtd"><?php
    _e("Variation #17", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test17Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test17Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test17Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test17Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="17" type='text' style="width:100%;min-width:200px" name="lsp_post_v17" value='<?php
    echo $lsp_post_v17;
?>' />

      </td>
    </tr>
    <tr class="versions v18">
      <td class="specialtd"><?php
    _e("Variation #18", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test18Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test18Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test18Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test18Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="18" type='text' style="width:100%;min-width:200px" name="lsp_post_v18" value='<?php
    echo $lsp_post_v18;
?>' />

      </td>
    </tr>
    <tr class="versions v19">
      <td class="specialtd"><?php
    _e("Variation #19", "lsp_text_domain");
?>



<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test19Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test19Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test19Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test19Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="19" type='text' style="width:100%;min-width:200px" name="lsp_post_v19" value='<?php
    echo $lsp_post_v19;
?>' />

      </td>
    </tr>

    <tr class="versions v20">
      <td class="specialtd"><?php
    _e("Variation #20", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test20Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test20Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test20Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test20Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>:</td><td style="width:100%">
      
<input id="20" type='text' style="width:100%;min-width:200px" name="lsp_post_v20" value='<?php
    echo $lsp_post_v20;
?>' />

      </td>
    </tr>




<tr class="replace">
      <td><?php
    _e("Replace This Text / Code With My Versions", "lsp_text_domain");
?>


<?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test0Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test0Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test0Value', true);
    if($lsp_val=="")$lsp_val = 0;
    $lsp_ps = get_post_meta($post->ID, '_lsp_Test0Profit', true);
    if($lsp_ps=="")$lsp_ps = 0;
    ?>
    <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value / $", "lsp_text_domain");
    ?><?php echo $lsp_ps; ?> <?php
    _e("profit logged", "lsp_text_domain");
    ?>)</span>

:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_tmtarget" value='<?php
    echo $lsp_post_tmtarget;
?>' /></td>
    </tr>








<!--
 <tr>
      <td class="specialtd"><?php
    _e("Site-Wide or Page-Specific?", "lsp_text_domain");
?>:</td><td style="width:100%">
      

  <select id="lsp_post_swps" name="lsp_post_swps">
      <option value="sw"<?php
    if ($lsp_post_swps == "sw"):
?> selected<?php
    endif;
?>><?php
    _e('Site-Wide', 'lsp_text_domain');
?></option>
      <option value="ps"<?php
    if ($lsp_post_swps == "ps"):
?> selected<?php
    endif;
?>><?php
    _e('Page-Specific', 'lsp_text_domain');
?></option>
    </select>

      </td>
    </tr>
    <tr>
-->

<!--

 <tr class="ttyesno">
      <td class="specialtd"><?php
    _e("Is this page template test / theme switch test?", "lsp_text_domain");
?>:</td><td style="width:100%">
      

  <select id="lsp_post_ttyesno" name="lsp_post_ttyesno">
      <option value="no"<?php
    if ($lsp_post_ttyesno == "no"):
?> selected<?php
    endif;
?>><?php
    _e('No', 'lsp_text_domain');
?></option>
      <option value="yes"<?php
    if ($lsp_post_ttyesno == "yes"):
?> selected<?php
    endif;
?>><?php
    _e('Yes', 'lsp_text_domain');
?></option>
    </select>

      </td>
    </tr>
    -->
<!--




 <tr class="cssjsyesno">
      <td class="specialtd"><?php
    _e("Is this a CSS / Javascript Test?", "lsp_text_domain");
?>:</td><td style="width:100%">
      

  <select id="lsp_post_cssjsyesno" name="lsp_post_cssjsyesno">
      <option value="no"<?php
    if ($lsp_post_cssjsyesno == "no"):
?> selected<?php
    endif;
?>><?php
    _e('No', 'lsp_text_domain');
?></option>
      <option value="yes"<?php
    if ($lsp_post_cssjsyesno == "yes"):
?> selected<?php
    endif;
?>><?php
    _e('Yes', 'lsp_text_domain');
?></option>
    </select>

      </td>
    </tr>
    <tr>
-->





<!--

 <tr>
      <td class="specialtd"><?php
    _e("Only run this on the title / meta description", "lsp_text_domain");
?>:</td><td style="width:100%">
      

  <select id="lsp_post_titlemeta" name="lsp_post_titlemeta">
      <option value="no"<?php
    if ($lsp_post_ab_for == "no"):
?> selected<?php
    endif;
?>><?php
    _e('No', 'lsp_text_domain');
?></option>
      <option value="yes"<?php
    if ($lsp_post_ab_for == "yes"):
?> selected<?php
    endif;
?>><?php
    _e('Yes', 'lsp_text_domain');
?></option>
    </select>

      </td>
    </tr>


-->
    <tr class="versions v1">






       


<tr class="tm">
      <td><?php
    _e("Before Title", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_before_title" value='<?php
    echo $lsp_post_before_title;
?>' /></td>
    </tr>


<tr class="tm">
      <td><?php
    _e("After Title", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_after_title" value='<?php
    echo $lsp_post_after_title;
?>' /></td>
    </tr>

    <tr class="tm">
      <td><?php
    _e("Before Description", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" id="lsp_post_before_description" name="lsp_post_before_description" value='<?php
    echo $lsp_post_before_description;
?>' /></td>
    </tr>

    <tr class="tm">
      <td><?php
    _e("After Description", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_after_description" value='<?php
    echo $lsp_post_after_description;
?>' /></td>
    </tr>


    <tr class="tm">
      <td><?php
    _e("Make Description", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_make_description" value='<?php
    echo $lsp_post_make_description;
?>' /></td>
    </tr>




<!--
    <tr class="mvtn">
      <td><?php
    _e("Multivariate Test Name?", "lsp_text_domain");
?>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_mvname" value='<?php
    echo $lsp_post_mvname;
?>' /></td>
    </tr>
-->


     <tr class="mvtn">
      <td><?php
    _e("Editor Wrap Code to Swap", "lsp_text_domain");
?>:</td><td>
      <?php
      global $post;
      if(!($post->ID)):
        _e("Save to Get", "lsp_text_domain");
      endif;
       if(($post->ID)):
        echo "[test".$post->ID."]Your Wrapped Original Content Here[/test]";
      endif;
      ?>
      </td>
    </tr>
    <tr class="mvtn">
      <td><?php
    _e("Developer PHP Wrap Code to Swap", "lsp_text_domain");
?>:</td><td>
     <?php
      global $post;
      if(!($post->ID)):
        _e("Save to Get", "lsp_text_domain");
      endif;
       if(($post->ID)):
        echo "<br>&lt;?php if(lsp_test(".$post->ID.")): ?&gt;<br>Your Wrapped Original Content Here<br>&lt;?php endif;?>";
      endif;
?>
      </td>
    </tr>
  






    <tr><td colspan="2"><a id="targetlsp"><?php
    _e("Targetting Options", "lsp_text_domain");
    ?></a></td></tr>

    <tr class="targeting">
      <td class="specialtd"><?php
    _e("For ", "lsp_text_domain");
?>:</td><td style="width:100%">
      
  <select id="lsp_post_ab_for" name="lsp_post_ab_for">
<option value=""<?php
    if ($lsp_post_ab_for == ""):
?> selected<?php
    endif;
?>><?php
    _e('Select', 'lsp_text_domain');
?></option>

      <option value="posts"<?php
    if ($lsp_post_ab_for == "posts"):
?> selected<?php
    endif;
?>><?php
    _e('Posts/Pages', 'lsp_text_domain');
?></option>
      <option value="archives"<?php
    if ($lsp_post_ab_for == "archives"):
?> selected<?php
    endif;
?>><?php
    _e('Archives', 'lsp_text_domain');
?></option>
    </select>
      </td>
    </tr>

    <tr class="targeting">

      <td><?php
    _e("Where ", "lsp_text_domain");
?>:</td><td>


<select id="lsp_post_ab_where" name="lsp_post_ab_where">
      
      <option value=""<?php
    if($lsp_post_ab_where == ""):
?> selected<?php
    endif;
?>><?php
    _e('Optionally Select', 'lsp_text_domain');
?></option>

      <option value="posttype"<?php
    if($lsp_post_ab_where == "posttype"):
?> selected<?php
    endif;
?>><?php
    _e('Post Type Slug', 'lsp_text_domain');
?></option>

<option value="tax"<?php
    if($lsp_post_ab_where == "tax"):
?> selected<?php
    endif;
?>><?php
    _e('Category / Tag / Taxonomy Value', 'lsp_text_domain');
?></option>
<!--
      <option value="postmeta"<?php
    if($lsp_post_ab_where == "postmeta"):
?> selected<?php
    endif;
?>><?php
    _e('Post Meta', 'lsp_text_domain');
?></option> -->

<option value="pageid"<?php
    if($lsp_post_ab_where == "postmeta"):
?> selected<?php
    endif;
?>><?php
    _e('Post/Page ID', 'lsp_text_domain');
?></option>

    </select>


      </td>
    </tr>
    





    <tr class="targeting">
      <td class="specialtd">
      <?php
    _e('Equals', 'lsp_text_domain');
?>
        <!--
          <select id="lsp_post_ab_comp" name="lsp_post_ab_comp">

       <option value=""<?php
    if ($lsp_post_ab_comp == ""):
?> selected<?php
    endif;
?>><?php
    _e('Select', 'lsp_text_domain');
?></option> 


      <option value="equals"<?php
    if ($lsp_post_ab_comp == "equals"):
?> selected<?php
    endif;
?>><?php
    _e('Equals', 'lsp_text_domain');
?></option>
      <option value="greaterthan"<?php
    if ($lsp_post_ab_comp == "greaterthan"):
?> selected<?php
    endif;
?>><?php
    _e('Is Greater Than', 'lsp_text_domain');
?></option>

      <option value="lessthan"<?php
    if ($lsp_post_ab_comp == "lessthan"):
?> selected<?php
    endif;
?>><?php
    _e('Is Less Than', 'lsp_text_domain');
?></option>


    </select>-->
    
      </td><td style="width:100%">
      <input type='text' style="width:100%;min-width:200px" name="lsp_post_ab_value" value='<?php
    echo $lsp_post_ab_value;
?>' />

      </td>
    </tr>






  

     <tr class="targeting">
      <td class="specialtd"><?php
    _e("Target What Percent of Pages?", "lsp_text_domain");
?>:</td><td style="width:100%">
      
<input type='text' style="width:100%;min-width:200px" name="lsp_post_targetpercent" value='<?php
    echo $lsp_post_targetpercent;
?>' />

      </td>
    </tr>

  <tr class="targeting">
      <td class="specialtd"><?php
    _e("Target Pages with Weekly Traffic Under", "lsp_text_domain");
?>:</td><td style="width:100%">
      
<input type='text' style="width:100%;min-width:200px" name="lsp_post_targettraffic" value='<?php
    echo $lsp_post_targettraffic;
?>' />


     <tr class="targeting">
      <td class="specialtd"><?php
    _e("Target Post Age Between?", "lsp_text_domain");
?>:</td><td style="width:100%">

<input type='text' style="width:45%;min-width:200px" id="lsp_post_targetage1" name="lsp_post_targetage1" value='<?php
    echo $lsp_post_targetage1;
?>' /><input type='text' style="width:45%;min-width:200px;float:right" id="lsp_post_targetage2" name="lsp_post_targetage2" value='<?php
    echo $lsp_post_targetage2;
?>' />

      </td>
    </tr>


     <tr class="trial">
      <td class="specialtd"><?php
    _e("Trial Delay To Collect Data (in Days)", "lsp_text_domain");
?>:</td><td style="width:100%">
      
<input type='text' style="width:100%;min-width:200px" name="lsp_post_delay" id="lsp_post_delay" value='<?php
    echo $lsp_post_delay;
?>' />

      </td>
    </tr>



      </td>
    </tr>


 <tr class="trial trialduration">
      <td class="specialtd"><?php
    _e("Trial Duration (last 14 days logged)", "lsp_text_domain");
?>:</td><td style="width:100%">
      
<input type='text' style="width:100%;min-width:200px" name="lsp_post_duration" id="lsp_post_duration" value='<?php
    echo $lsp_post_duration;
?>' />

      </td>
    </tr>
    


<tr>
      <td class="specialtd"><?php
    _e("Apply the Current Winner To All?", "lsp_text_domain");
?>:</td><td style="width:100%">

  <select id="lsp_post_apply" name="lsp_post_apply">
      
<option value="no"<?php
    if ($lsp_post_apply != "yes"):
?> selected<?php
    endif;
?>><?php
    _e('No', 'lsp_text_domain');
?></option>

      <option value="yes"<?php
    if ($lsp_post_apply == "yes"):
?> selected<?php
    endif;
?>><?php
    _e('Yes', 'lsp_text_domain');
?></option>
      
    </select>

      </td>
    </tr>

<!--
    <tr class="winnerweight">
      <td class="specialtd"><?php
    _e("Weight Winner Selection By", "lsp_text_domain");
?>:</td><td style="width:100%">
      
 <select id="lsp_post_testweight" name="lsp_post_testweight">
      <option value="pageviews"<?php
    if ($lsp_post_testweight == "pageviews"):
?> selected<?php
    endif;
?>><?php
    _e('Pageviews', 'lsp_text_domain');
?></option>
      <option value="conversions"<?php
    if ($lsp_post_testweight == "conversions"):
?> selected<?php
    endif;
?>><?php
    _e('Conversions', 'lsp_text_domain');
?></option>
  <option value="profit"<?php
    if ($lsp_post_testweight == "profit"):
?> selected<?php
    endif;
?>><?php
    _e('Order Profit', 'lsp_text_domain');
?></option>
  <option value="overall"<?php
    if ($lsp_post_testweight == "overall"):
?> selected<?php
    endif;
?>><?php
    _e('Overall Profit (pageviews x CPM, conversions x their value, profit on orders)', 'lsp_text_domain');
?></option>

    </select> -->

      </td>
    </tr>




    <tr>
      <td><a href="#" id="showstats"><?php
    _e("Click Here To Show Stats", "lsp_text_domain");
    ?></a></td><td>
     <?php
    // _e("<b>TBD</b> Percent More/Less Traffic With This Version (X visits vs X visits)", "lsp_text_domain");
?></td>
    </tr>





  </table>

<script>


jQuery('.versions').hide();
jQuery('.tt').hide();
jQuery('.cssjs').hide();
jQuery('.tm').hide();
jQuery('.winnerweight').hide();
jQuery('.targeting').hide();



jQuery('#targetlsp').click(function(){
  jQuery('.targeting').toggle();
})

jQuery('.v1').show();
jQuery('#1').focus(function(){
  jQuery('.v2').show();
});
if(jQuery('#1').val())jQuery('.v2').show();


jQuery('#2').focus(function(){
  jQuery('.v3').show();
});
if(jQuery('#2').val())jQuery('.v3').show();

jQuery('#3').focus(function(){
  jQuery('.v4').show();
});
if(jQuery('#3').val())jQuery('.v4').show();

jQuery('#4').focus(function(){
  jQuery('.v5').show();
});
if(jQuery('#4').val())jQuery('.v5').show();

jQuery('#5').focus(function(){
  jQuery('.v6').show();
});
if(jQuery('#5').val())jQuery('.v6').show();

jQuery('#6').focus(function(){
  jQuery('.v7').show();
});
if(jQuery('#6').val())jQuery('.v7').show();

jQuery('#7').focus(function(){
  jQuery('.v8').show();
});
if(jQuery('#7').val())jQuery('.v8').show();

jQuery('#8').focus(function(){
  jQuery('.v9').show();
});
if(jQuery('#8').val())jQuery('.v9').show();

jQuery('#9').focus(function(){
  jQuery('.v10').show();
});
if(jQuery('#9').val())jQuery('.v10').show();

jQuery('#10').focus(function(){
  jQuery('.v11').show();
});
if(jQuery('#10').val())jQuery('.v11').show();

jQuery('#11').focus(function(){
  jQuery('.v12').show();
});
if(jQuery('#11').val())jQuery('.v12').show();

jQuery('#12').focus(function(){
  jQuery('.v13').show();
});
if(jQuery('#12').val())jQuery('.v13').show();

jQuery('#13').focus(function(){
  jQuery('.v14').show();
});
if(jQuery('#13').val())jQuery('.v14').show();

jQuery('#14').focus(function(){
  jQuery('.v15').show();
});
if(jQuery('#14').val())jQuery('.v15').show();

jQuery('#15').focus(function(){
  jQuery('.v16').show();
});
if(jQuery('#15').val())jQuery('.v16').show();

jQuery('#16').focus(function(){
  jQuery('.v17').show();
});
if(jQuery('#16').val())jQuery('.v17').show();

jQuery('#17').focus(function(){
  jQuery('.v18').show();
});
if(jQuery('#17').val())jQuery('.v18').show();

jQuery('#18').focus(function(){
  jQuery('.v19').show();
});
if(jQuery('#18').val())jQuery('.v19').show();

jQuery('#19').focus(function(){
  jQuery('.v20').show();
});
if(jQuery('#19').val())jQuery('.v20').show();



jQuery('#lsp_post_testtype').change(function(){

  if(jQuery('#lsp_post_testtype').val()=='regular'){jQuery('#targetlsp').hide();jQuery('.mvtn').show();jQuery('.vtext').html('Variation #1');jQuery('.tm').hide();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').show();jQuery('.trial').hide();}
  if(jQuery('#lsp_post_testtype').val()=='seo'){jQuery('#targetlsp').show();if(jQuery('#lsp_post_delay').val()=="0")jQuery('#lsp_post_delay').val('7') ;
jQuery('.mvtn').hide();jQuery('.vtext').html('Variation #1');jQuery('.tm').show();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').show();jQuery('.trial').show();}

  if(jQuery('#lsp_post_testtype').val()=='seocontent'){jQuery('#targetlsp').hide();if(jQuery('#lsp_post_delay').val()=="0")jQuery('#lsp_post_delay').val('7') 
jQuery('.mvtn').show();jQuery('.vtext').html('Variation #1');jQuery('.tm').hide();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').show();jQuery('.trial').show();}

  if(jQuery('#lsp_post_testtype').val()=='template'){jQuery('#targetlsp').show();jQuery('.mvtn').hide();jQuery('.vtext').html('Theme / Template Slug to Use Variation #1');jQuery('.tt').hide();jQuery('.versions').hide();jQuery('.tm').hide();jQuery('.trial').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').hide();}

  if(jQuery('#lsp_post_testtype').val()=='cssjs'){jQuery('#targetlsp').show();jQuery('.mvtn').hide();jQuery('.vtext').html('CSS / JS Code to Use (added to header) Variation #1');jQuery('.cssjs').hide();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.trial').hide();jQuery('.tm').hide();jQuery('.v1').show();jQuery('.replace').hide();}


  if(jQuery('#1').val())jQuery('.v2').show();
  if(jQuery('#2').val())jQuery('.v3').show();
  if(jQuery('#3').val())jQuery('.v4').show();
  if(jQuery('#4').val())jQuery('.v5').show();
  if(jQuery('#5').val())jQuery('.v6').show();
  if(jQuery('#6').val())jQuery('.v7').show();
  if(jQuery('#7').val())jQuery('.v8').show();
  if(jQuery('#8').val())jQuery('.v9').show();
  if(jQuery('#9').val())jQuery('.v10').show();
  if(jQuery('#10').val())jQuery('.v11').show();
  if(jQuery('#11').val())jQuery('.v12').show();
  if(jQuery('#12').val())jQuery('.v13').show();
  if(jQuery('#13').val())jQuery('.v14').show();
  if(jQuery('#14').val())jQuery('.v15').show();
  if(jQuery('#15').val())jQuery('.v16').show();
  if(jQuery('#16').val())jQuery('.v17').show();
  if(jQuery('#17').val())jQuery('.v18').show();
  if(jQuery('#18').val())jQuery('.v19').show();
  if(jQuery('#19').val())jQuery('.v20').show();

});
if(jQuery('#lsp_post_testtype').val()=='regular'){}
if(jQuery('#lsp_post_testtype').val()=='seo'){jQuery('.tm').show();}

if(jQuery('#lsp_post_testtype').val()=='seocontent'){}

if(jQuery('#lsp_post_testtype').val()=='template'){jQuery('.tt').show();}

if(jQuery('#lsp_post_testtype').val()=='cssjs'){jQuery('.cssjs').show();}




if(jQuery('#lsp_post_testtype').val()=='regular'){jQuery('#targetlsp').hide();jQuery('.mvtn').show();jQuery('.vtext').html('Variation #1');jQuery('.tm').hide();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').show();jQuery('.trial').hide();}
  if(jQuery('#lsp_post_testtype').val()=='seo'){jQuery('#targetlsp').show();if(jQuery('#lsp_post_delay').val()=="0")jQuery('#lsp_post_delay').val('7') 
jQuery('.mvtn').hide();jQuery('.vtext').html('Variation #1');jQuery('.tm').show();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').show();jQuery('.trial').show();}

  if(jQuery('#lsp_post_testtype').val()=='seocontent'){jQuery('#targetlsp').hide();if(jQuery('#lsp_post_delay').val()=="0")jQuery('#lsp_post_delay').val('7');jQuery('.trial').show();
jQuery('.mvtn').show();jQuery('.vtext').html('Variation #1');jQuery('.tm').hide();jQuery('.versions').hide();jQuery('.tt').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').show();}

  if(jQuery('#lsp_post_testtype').val()=='template'){jQuery('#targetlsp').show();jQuery('.mvtn').hide();jQuery('.vtext').html('Theme / Template Slug to Use Variation #1');jQuery('.tt').hide();jQuery('.versions').hide();jQuery('.tm').hide();jQuery('.trial').hide();jQuery('.cssjs').hide();jQuery('.v1').show();jQuery('.replace').hide();}

  if(jQuery('#lsp_post_testtype').val()=='cssjs'){jQuery('#targetlsp').show();jQuery('.mvtn').hide();jQuery('.vtext').html('CSS / JS Code to Use (added to header) Variation #1');jQuery('.cssjs').hide();jQuery('.versions').hide();jQuery('.trial').hide();jQuery('.tt').hide();jQuery('.tm').hide();jQuery('.v1').show();jQuery('.replace').hide();}




jQuery('#lsp_post_targetage1').datepicker();
jQuery('#lsp_post_targetage2').datepicker();
jQuery('#lsp_post_targetage1').datepicker("option","dateFormat","yy-mm-dd");
jQuery('#lsp_post_targetage2').datepicker("option","dateFormat","yy-mm-dd");

if(jQuery('#lsp_post_delay').val()=="")jQuery('#lsp_post_delay').val('0');
if(jQuery('#lsp_post_duration').val()=="")jQuery('#lsp_post_duration').val('30');

/*
jQuery('#lsp_post_swps').change(function(){
  if(jQuery('#lsp_post_swps').val()=='sw'){
    jQuery('.target').show();
  }
  if(jQuery('#lsp_post_swps').val()=='ps'){
    jQuery('.target').hide();
  }
});
if(jQuery('#lsp_post_swps').val()=='sw'){
  jQuery('.target').show();
}
if(jQuery('#lsp_post_swps').val()=='ps'){
  jQuery('.target').hide();
}

jQuery('#lsp_post_ttyesno').change(function(){

});
if(jQuery('#lsp_post_ttyesno').val()=='yes'){}
if(jQuery('#lsp_post_ttyesno').val()=='no'){}

jQuery('#lsp_post_cssjsyesno').change(function(){

});
if(jQuery('#lsp_post_cssjsyesno').val()=='yes'){}
if(jQuery('#lsp_post_cssjsyesno').val()=='no'){}

jQuery('#lsp_post_titlemeta').change(function(){

});
if(jQuery('#lsp_post_titlemeta').val()=='yes'){}
if(jQuery('#lsp_post_titlemeta').val()=='no'){}
*/



</script>

<?php // } ?>




<?php
    global $post;
    global $current_screen;
    if (sanitize_text_field($_GET['post_type']) == "seoabtest" || $current_screen->post_type == 'seoabtest'):
?>


<?php
    endif;
?>  


  <?php
}





add_action('admin_init', 'lsp_meta_box6');
function lsp_meta_box6()
{
    $post_types = get_post_types(array(
        'public' => true
    ));
    foreach($post_types as $post_type){
      if($post_type!="seoabtest" && $post_type!="localproject")add_meta_box('lsp_meta_box_details6', __('SEO A/B Tests', 'lsp_text_domain'), 'lsp_meta_box_details_display6', $post_type, 'normal', 'default');
    }
    if (!function_exists('get_plugins')) {
        require_once ABSPATH . 'wp-admin/includes/plugin.php';
    }
}

function lsp_meta_box_details_display6($seoabtest)
{
    $lsp_testtitle1    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_testtitle1', true));
    $lsp_testdescription1    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_testdescription1', true));
    $lsp_testtitle2    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_testtitle2', true));
    $lsp_testdescription2    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_testdescription2', true));
    $lsp_seturl        = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_seturl', true));   
    $lsp_robotitle1    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_robotitle1', true));
    $lsp_robotitle2    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_robotitle2', true));
    $lsp_robotitle3    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_robotitle3', true));
    $lsp_robotitle4    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_robotitle4', true));
    $lsp_seturl    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_seturl', true));
    $lsp_setwinner    = esc_html(lsp_get_post_meta($seoabtest->ID, '_lsp_post_setwinner', true));

?>

  <?php if(lsp_get_option('lsp-agree')=="yes" || lsp_get_option('lsp-agree')=="yes2" ):?>
  <table style="width:100%">
    <tr>
      <td class="specialtd"><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test1Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test1Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test1Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Test Title 1", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td style="width:100%">
      <input id="testtitle1" type='text' style="width:100%;min-width:200px" name="_lsp_post_testtitle1" value='<?php
    echo $lsp_testtitle1;
?>' /></td>
    </tr>
    <tr>
      <td><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test1Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test1Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test1Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Test Description 1", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td>
      <input type='text' style="width:100%;min-width:200px" name="_lsp_post_testdescription1" value='<?php
    echo $lsp_testdescription1;
?>' /></td>
    </tr>
      <td><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test2Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test2Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test2Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Test Title 2", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td>
      <input id="testtitle2" type='text' style="width:100%;min-width:200px" name="_lsp_post_testtitle2" value='<?php
    echo $lsp_testtitle2;
?>' /></td>
    </tr>
    <tr>
      <td>
        <b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test2Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test2Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test2Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Test Description 2", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:

      </td><td>
      <input type='text' style="width:100%;min-width:200px" name="_lsp_post_testdescription2" value='<?php
    echo $lsp_testdescription2;
?>' /></td>
    </tr>
    
</tr>
      <td><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test3Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test3Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test3Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Robo/Extra Title 1", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td>
      <input id="testtitle3" type='text' style="width:100%;min-width:200px" name="_lsp_post_robotitle1" value='<?php
    echo $lsp_robotitle1;
?>' /></td>
    </tr>
    </tr>
    <td><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test4Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test4Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test4Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Robo/Extra Title 2", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td>
    <input id="testtitle4" type='text' style="width:100%;min-width:200px" name="_lsp_post_robotitle2" value='<?php
    echo $lsp_robotitle2;
    ?>' /></td>
    </tr>


</tr>
      <td><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test5Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test5Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test5Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Robo/Extra Title 3", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td>
      <input id="testtitle5" type='text' style="width:100%;min-width:200px" name="_lsp_post_robotitle3" value='<?php
    echo $lsp_robotitle3;
?>' /></td>
    </tr>
    </tr>
    <td><b><?php
    $lsp_vs = get_post_meta($post->ID, '_lsp_Test6Traffic', true);
    if($lsp_vs=="")$lsp_vs = 0;
    $lsp_cs = get_post_meta($post->ID, '_lsp_Test6Conversions', true);
    if($lsp_cs=="")$lsp_cs = 0;
    $lsp_val = get_post_meta($post->ID, '_lsp_Test6Value', true);
    if($lsp_val=="")$lsp_val = 0;
    _e("Robo/Extra Title 4", "lsp_text_domain");
    ?></b> <span class="stats">(<?php echo $lsp_vs; ?> <?php
    _e("views / ", "lsp_text_domain");
    ?><?php echo $lsp_cs; ?> <?php
    _e("conversions / $", "lsp_text_domain");
    ?><?php echo $lsp_val; ?> <?php
    _e("value logged)", "lsp_text_domain");
    ?></span>:</td><td>
    <input id="testtitle6" type='text' style="width:100%;min-width:200px" name="_lsp_post_robotitle4" value='<?php
    echo $lsp_robotitle4;
    ?>' /></td>
    </tr>

  <tr>
      <td><?php
    _e("Set URL to Tested Title?", "lsp_text_domain");
?>:</td><td>
        <select name="_lsp_post_seturl" id="_lsp_post_seturl">
      <option value="yes" <?php
            if ($lsp_seturl == "yes")
                echo "selected";
?>><?php
    _e('Yes', 'lsp_text_domain');
?></option>
      <option value="no" <?php
            if ($lsp_seturl == "no")
                echo "selected";
?>><?php
    _e('No', 'lsp_text_domain');
?></option>
    </select>
    </td>
    </tr>

    <tr>
      <td><br><?php
    _e("Auto-Set Winning Version?", "lsp_text_domain");
?>:<br><a href="#" id="showstats"><?php
    _e("Show Test Stats", "lsp_text_domain");
    ?></a></td><td>
        <select name="_lsp_post_setwinner" id="_lsp_post_setwinner">
      <option value="yes" <?php
            if ($lsp_setwinner == "yes")
                echo "selected";
?>><?php
    _e('Yes', 'lsp_text_domain');
?></option>
      <option value="no" <?php
            if ($lsp_setwinner == "no")
                echo "selected";
?>><?php
    _e('No', 'lsp_text_domain');
?></option>
    </select>
    </td>
    </tr>

  </table>
<?php endif;?>


<?php
    global $post;
    global $current_screen;
    if (sanitize_text_field($_GET['post_type']) == "seoabtest" || $current_screen->post_type == 'seoabtest'):
?>


<?php
    endif;
?>  

      
    <?php
?>
  

  <?php
}







// Save the a/b test custom post type metas
add_action('save_post', 'lsp_post_fields_save5', 10, 2);
function lsp_post_fields_save5($post_id = false, $post = false)
{
  $thispost = get_post($post_id);
    
  
  if ((sanitize_text_field($_POST['lsp_post_testtype'])) && sanitize_text_field($_POST['lsp_post_testtype']) != '') {
    update_post_meta($post_id, '_lsp_post_testtype', sanitize_text_field($_POST['lsp_post_testtype']));
  }
  if ((sanitize_text_field($_POST['lsp_post_swps'])) && sanitize_text_field($_POST['lsp_post_swps']) != '') {
    update_post_meta($post_id, '_lsp_post_swps', sanitize_text_field($_POST['lsp_post_swps']));
  }
  if ((sanitize_text_field($_POST['lsp_post_ttyesno'])) && sanitize_text_field($_POST['lsp_post_ttyesno']) != '') {
    update_post_meta($post_id, '_lsp_post_ttyesno', sanitize_text_field($_POST['lsp_post_ttyesno']));
  }
  if ((sanitize_text_field($_POST['lsp_post_tt'])) && sanitize_text_field($_POST['lsp_post_tt']) != '') {
    update_post_meta($post_id, '_lsp_post_tt', sanitize_text_field($_POST['lsp_post_tt']));
  }
  if ((sanitize_text_field($_POST['lsp_post_cssjsyesno'])) && sanitize_text_field($_POST['lsp_post_cssjsyesno']) != '') {
    update_post_meta($post_id, '_lsp_post_cssjsyesno', sanitize_text_field($_POST['lsp_post_cssjsyesno']));
  }
  if ((sanitize_text_field($_POST['lsp_post_cssjs'])) && sanitize_text_field($_POST['lsp_post_cssjs']) != '') {
    update_post_meta($post_id, '_lsp_post_cssjs', sanitize_text_field($_POST['lsp_post_cssjs']));
  }
  if ((sanitize_text_field($_POST['lsp_post_titlemeta'])) && sanitize_text_field($_POST['lsp_post_titlemeta']) != '') {
    update_post_meta($post_id, '_lsp_post_titlemeta', sanitize_text_field($_POST['lsp_post_titlemeta']));
  }

  $versionscount = 0;
  if ((wp_strip_all_tags($_POST['lsp_post_v1'])) && wp_strip_all_tags($_POST['lsp_post_v1']) != '') {
    update_post_meta($post_id, '_lsp_post_v1', wp_strip_all_tags($_POST['lsp_post_v1']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v2'])) && wp_strip_all_tags($_POST['lsp_post_v2']) != '') {
    update_post_meta($post_id, '_lsp_post_v2', wp_strip_all_tags($_POST['lsp_post_v2']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v3'])) && wp_strip_all_tags($_POST['lsp_post_v3']) != '') {
    update_post_meta($post_id, '_lsp_post_v3', wp_strip_all_tags($_POST['lsp_post_v3']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v4'])) && wp_strip_all_tags($_POST['lsp_post_v4']) != '') {
    update_post_meta($post_id, '_lsp_post_v4', wp_strip_all_tags($_POST['lsp_post_v4']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v5'])) && wp_strip_all_tags($_POST['lsp_post_v5']) != '') {
    update_post_meta($post_id, '_lsp_post_v5', wp_strip_all_tags($_POST['lsp_post_v5']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v6'])) && wp_strip_all_tags($_POST['lsp_post_v6']) != '') {
    update_post_meta($post_id, '_lsp_post_v6', wp_strip_all_tags($_POST['lsp_post_v6']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v7'])) && wp_strip_all_tags($_POST['lsp_post_v7']) != '') {
    update_post_meta($post_id, '_lsp_post_v7', wp_strip_all_tags($_POST['lsp_post_v7']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v8'])) && wp_strip_all_tags($_POST['lsp_post_v8']) != '') {
    update_post_meta($post_id, '_lsp_post_v8', wp_strip_all_tags($_POST['lsp_post_v8']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v9'])) && wp_strip_all_tags($_POST['lsp_post_v9']) != '') {
    update_post_meta($post_id, '_lsp_post_v9', wp_strip_all_tags($_POST['lsp_post_v9']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v10'])) && wp_strip_all_tags($_POST['lsp_post_v10']) != '') {
    update_post_meta($post_id, '_lsp_post_v10', wp_strip_all_tags($_POST['lsp_post_v10']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v11'])) && wp_strip_all_tags($_POST['lsp_post_v11']) != '') {
    update_post_meta($post_id, '_lsp_post_v11', wp_strip_all_tags($_POST['lsp_post_v11']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v12'])) && wp_strip_all_tags($_POST['lsp_post_v12']) != '') {
    update_post_meta($post_id, '_lsp_post_v12', wp_strip_all_tags($_POST['lsp_post_v12']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v13'])) && wp_strip_all_tags($_POST['lsp_post_v13']) != '') {
    update_post_meta($post_id, '_lsp_post_v13', wp_strip_all_tags($_POST['lsp_post_v13']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v14'])) && wp_strip_all_tags($_POST['lsp_post_v14']) != '') {
    update_post_meta($post_id, '_lsp_post_v14', wp_strip_all_tags($_POST['lsp_post_v14']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v15'])) && wp_strip_all_tags($_POST['lsp_post_v15']) != '') {
    update_post_meta($post_id, '_lsp_post_v15', wp_strip_all_tags($_POST['lsp_post_v15']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v16'])) && wp_strip_all_tags($_POST['lsp_post_v16']) != '') {
    update_post_meta($post_id, '_lsp_post_v16', wp_strip_all_tags($_POST['lsp_post_v16']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v17'])) && wp_strip_all_tags($_POST['lsp_post_v17']) != '') {
    update_post_meta($post_id, '_lsp_post_v17', wp_strip_all_tags($_POST['lsp_post_v17']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v18'])) && wp_strip_all_tags($_POST['lsp_post_v18']) != '') {
    update_post_meta($post_id, '_lsp_post_v18', wp_strip_all_tags($_POST['lsp_post_v18']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v19'])) && wp_strip_all_tags($_POST['lsp_post_v19']) != '') {
    update_post_meta($post_id, '_lsp_post_v19', wp_strip_all_tags($_POST['lsp_post_v19']));
    $versionscount++;
  }
  if ((wp_strip_all_tags($_POST['lsp_post_v20'])) && wp_strip_all_tags($_POST['lsp_post_v20']) != '') {
    update_post_meta($post_id, '_lsp_post_v20', wp_strip_all_tags($_POST['lsp_post_v20']));
    $versionscount++;
  }

  if ((sanitize_text_field($_POST['lsp_post_conversionurls'])) && sanitize_text_field($_POST['lsp_post_conversionurls']) != '') {
    update_post_meta($post_id, '_lsp_post_conversionurls', sanitize_text_field($_POST['lsp_post_conversionurls']));
  }

  if ((sanitize_text_field($_POST['lsp_post_tmtarget'])) && sanitize_text_field($_POST['lsp_post_tmtarget']) != '') {
    update_post_meta($post_id, '_lsp_post_tmtarget', sanitize_text_field($_POST['lsp_post_tmtarget']));
  }
  if ((sanitize_text_field($_POST['lsp_post_mvname'])) && sanitize_text_field($_POST['lsp_post_mvname']) != '') {
    update_post_meta($post_id, '_lsp_post_mvname', sanitize_text_field($_POST['lsp_post_mvname']));
  }    
  
  if ((sanitize_text_field($_POST['lsp_post_ab_for'])) && sanitize_text_field($_POST['lsp_post_ab_for']) != '') {
    update_post_meta($post_id, '_lsp_post_ab_for', sanitize_text_field($_POST['lsp_post_ab_for']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_ab_where'])) && sanitize_text_field($_POST['lsp_post_ab_where']) != '') {
    update_post_meta($post_id, '_lsp_post_ab_where', sanitize_text_field($_POST['lsp_post_ab_where']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_ab_comp'])) && sanitize_text_field($_POST['lsp_post_ab_comp']) != '') {
    update_post_meta($post_id, '_lsp_post_ab_comp', sanitize_text_field($_POST['lsp_post_ab_comp']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_ab_value'])) && sanitize_text_field($_POST['lsp_post_ab_value']) != '') {
    update_post_meta($post_id, '_lsp_post_ab_value', sanitize_text_field($_POST['lsp_post_ab_value']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_before_title'])) && sanitize_text_field($_POST['lsp_post_before_title']) != '') {
    update_post_meta($post_id, '_lsp_post_before_title', sanitize_text_field($_POST['lsp_post_before_title']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_after_title'])) && sanitize_text_field($_POST['lsp_post_after_title']) != '') {
    update_post_meta($post_id, '_lsp_post_after_title', sanitize_text_field($_POST['lsp_post_after_title']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_before_description'])) && sanitize_text_field($_POST['lsp_post_before_description']) != '') {
    update_post_meta($post_id, '_lsp_post_before_description', sanitize_text_field($_POST['lsp_post_before_description']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_after_description'])) && sanitize_text_field($_POST['lsp_post_after_description']) != '') {
    update_post_meta($post_id, '_lsp_post_after_description', sanitize_text_field($_POST['lsp_post_after_description']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_make_description'])) && sanitize_text_field($_POST['lsp_post_make_description']) != '') {
    update_post_meta($post_id, '_lsp_post_make_description', sanitize_text_field($_POST['lsp_post_make_description']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_find'])) && sanitize_text_field($_POST['lsp_post_find']) != '') {
    update_post_meta($post_id, '_lsp_post_find', sanitize_text_field($_POST['lsp_post_find']));
  }

  if ((sanitize_text_field($_POST['lsp_post_targettraffic'])) && sanitize_text_field($_POST['lsp_post_targettraffic']) != '') {
    update_post_meta($post_id, '_lsp_post_targettraffic', sanitize_text_field($_POST['lsp_post_targettraffic']));
  }
  if ((sanitize_text_field($_POST['lsp_post_targetpercent'])) && sanitize_text_field($_POST['lsp_post_targetpercent']) != '') {
    update_post_meta($post_id, '_lsp_post_targetpercent', sanitize_text_field($_POST['lsp_post_targetpercent']));
  }
  if ((sanitize_text_field($_POST['lsp_post_targetage1'])) && sanitize_text_field($_POST['lsp_post_targetage1']) != '') {
    update_post_meta($post_id, '_lsp_post_targetage1', sanitize_text_field($_POST['lsp_post_targetage1']));
  }
  if ((sanitize_text_field($_POST['lsp_post_targetage2'])) && sanitize_text_field($_POST['lsp_post_targetage2']) != '') {
    update_post_meta($post_id, '_lsp_post_targetage2', sanitize_text_field($_POST['lsp_post_targetage2']));
  }
  if ((sanitize_text_field($_POST['lsp_post_delay'])) && sanitize_text_field($_POST['lsp_post_delay']) != '') {
    update_post_meta($post_id, '_lsp_post_delay', sanitize_text_field($_POST['lsp_post_delay']));
  }
  if ((sanitize_text_field($_POST['lsp_post_duration'])) && sanitize_text_field($_POST['lsp_post_duration']) != '') {
    update_post_meta($post_id, '_lsp_post_duration', sanitize_text_field($_POST['lsp_post_duration']));
  }
  
  if ((sanitize_text_field($_POST['lsp_post_apply'])) && sanitize_text_field($_POST['lsp_post_apply']) != '') {
    update_post_meta($post_id, '_lsp_post_apply', sanitize_text_field($_POST['lsp_post_apply']));
  }

  if ((sanitize_text_field($_POST['lsp_post_testweight'])) && sanitize_text_field($_POST['lsp_post_testweight']) != '') {
    update_post_meta($post_id, '_lsp_post_testweight', sanitize_text_field($_POST['lsp_post_testweight']));
  }

  update_post_meta($post_id, '_lspversionscount', sanitize_text_field($versionscount));


  if ((wp_strip_all_tags($_POST['lsp_post_v1'])) && wp_strip_all_tags($_POST['lsp_post_v1']) != '') {
    update_post_meta($post_id, '_lsp_post_v1', wp_strip_all_tags($_POST['lsp_post_v1']));
  }
/*
  if((get_post_meta($post_id,'_lsp_TestCurrentVersion',true)!="" && get_post_meta($post_id,'_lsp_post_v1',true) != $_POST['lsp_post_v1'] )||(get_post_meta($post_id,'_lsp_TestCurrentVersion',true)=="" && wp_strip_all_tags($_POST['_lsp_post_testtitle1']))){
    update_post_meta($post_id, '_lsp_TestCurrentVersion', 0);
    update_post_meta($post_id, '_lsp_TestWinningVersion', '');
    update_post_meta($post_id, '_lsp_TestStartTime', time());
    lsp_cron_general_test($post_id);
  }
*/
  
}





// Save the project custom post type metas
add_action('save_post', 'lsp_post_fields_save6', 10, 2);
function lsp_post_fields_save6($post_id = false, $post = false)
{
    $thispost = get_post($post_id);
    //if ((sanitize_text_field($_POST['_lsp_post_testtitle1'])) && sanitize_text_field($_POST['_lsp_post_testtitle1']) != '') {
        update_post_meta($post_id, '_lsp_post_testtitle1', sanitize_text_field($_POST['_lsp_post_testtitle1']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_testdescription1'])) && sanitize_text_field($_POST['_lsp_post_testdescription1']) != '') {
        update_post_meta($post_id, '_lsp_post_testdescription1', sanitize_text_field($_POST['_lsp_post_testdescription1']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_testtitle2'])) && sanitize_text_field($_POST['_lsp_post_testtitle2']) != '') {
        update_post_meta($post_id, '_lsp_post_testtitle2', sanitize_text_field($_POST['_lsp_post_testtitle2']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_testdescription2'])) && sanitize_text_field($_POST['_lsp_post_testdescription2']) != '') {
        update_post_meta($post_id, '_lsp_post_testdescription2', sanitize_text_field($_POST['_lsp_post_testdescription2']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_seturl'])) && sanitize_text_field($_POST['_lsp_post_seturl']) != '') {
        update_post_meta($post_id, '_lsp_post_seturl', sanitize_text_field($_POST['_lsp_post_seturl']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_robotitle1'])) && sanitize_text_field($_POST['_lsp_post_robotitle1']) != '') {
      update_post_meta($post_id, '_lsp_post_robotitle1', sanitize_text_field($_POST['_lsp_post_robotitle1']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_robotitle2'])) && sanitize_text_field($_POST['_lsp_post_robotitle2']) != '') {
      update_post_meta($post_id, '_lsp_post_robotitle2', sanitize_text_field($_POST['_lsp_post_robotitle2']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_robotitle3'])) && sanitize_text_field($_POST['_lsp_post_robotitle3']) != '') {
      update_post_meta($post_id, '_lsp_post_robotitle3', sanitize_text_field($_POST['_lsp_post_robotitle3']));
    //}
    //if ((sanitize_text_field($_POST['_lsp_post_robotitle4'])) && sanitize_text_field($_POST['_lsp_post_robotitle4']) != '') {
      update_post_meta($post_id, '_lsp_post_robotitle4', sanitize_text_field($_POST['_lsp_post_robotitle4']));
    //}
      update_post_meta($post_id, '_lsp_post_seturl', sanitize_text_field($_POST['_lsp_post_seturl']));
    //if ((sanitize_text_field($_POST['_lsp_post_setwinner'])) && sanitize_text_field($_POST['_lsp_post_setwinner']) != '') {
      update_post_meta($post_id, '_lsp_post_setwinner', sanitize_text_field($_POST['_lsp_post_setwinner']));
    //}

    if($_POST['_lsp_post_testtitle1']!="" && $_POST['_lsp_post_testtitle1']!= get_post_meta($post->ID, '_lsp_post_testtitle1', true)){
      //Test6Value, Test6Traffic, Test6Conversions
        update_post_meta($thispost->ID,'_lsp_TestDone',"");
        update_post_meta($thispost->ID,'_lsp_TestWinningVersion',"");
        update_post_meta($thispost->ID,'_lsp_Test0Value',"");
        update_post_meta($thispost->ID,'_lsp_Test1Value',"");
        update_post_meta($thispost->ID,'_lsp_Test2Value',"");
        update_post_meta($thispost->ID,'_lsp_Test3Value',"");
        update_post_meta($thispost->ID,'_lsp_Test4Value',"");
        update_post_meta($thispost->ID,'_lsp_Test5Value',"");
        update_post_meta($thispost->ID,'_lsp_Test6Value',"");
        update_post_meta($thispost->ID,'_lsp_Test0Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test1Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test2Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test3Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test4Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test5Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test6Traffic',"");
        update_post_meta($thispost->ID,'_lsp_Test0Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test1Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test2Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test3Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test4Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test5Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test6Conversions',"");
        update_post_meta($thispost->ID,'_lsp_Test0Profit',"");
        update_post_meta($thispost->ID,'_lsp_Test1Profit',"");
        update_post_meta($thispost->ID,'_lsp_Test2Profit',"");
        update_post_meta($thispost->ID,'_lsp_Test3Profit',"");
        update_post_meta($thispost->ID,'_lsp_Test4Profit',"");
        update_post_meta($thispost->ID,'_lsp_Test5Profit',"");
        update_post_meta($thispost->ID,'_lsp_Test6Profit',"");
        update_post_meta($post_id, '_lsp_TestStartTime', time());
        update_post_meta($post_id, '_lsp_TestCurrentVersion', 0);
        lsp_cron_post_test($post_id);
    }

    if($_POST['_lsp_post_testtitle1']==""){
      update_post_meta($post_id, '_lsp_TestCurrentVersion', "");
    }
/*
    if((get_post_meta($post_id,'_lsp_TestCurrentVersion',true)!="" && get_post_meta($post_id,'_lsp_post_testtitle1',true) != sanitize_text_field($_POST['_lsp_post_testtitle1']) )||(get_post_meta($post_id,'_lsp_TestCurrentVersion',true)=="" && sanitize_text_field($_POST['_lsp_post_testtitle1']))){
      update_post_meta($post_id, '_lsp_TestCurrentVersion', 0);
      update_post_meta($post_id, '_lsp_TestWinningVersion', '');
      update_post_meta($post_id, '_lsp_TestStartTime', time());
      
    }
*/
}

function lsp_cron_post_test($theid){
  $post_id = $theid;
  ///CHECK TO ONLY RUN THIS IF THE POST HAS A TEST ACTIVE
  $currentVersion = 0.00001;
  if(get_post_meta($post_id, '_lsp_TestCurrentVersion', true))$currentVersion = get_post_meta($post_id, '_lsp_TestCurrentVersion', true);

  // 
  // 
  $startTime = get_post_meta($post_id, '_lsp_TestStartTime', true);
  if((time()-$startTime)/($currentVersion*60*60*24*30)>(1*$currentVersion)){
    $curentVersion = $currentVersion+1-0.00001;
    update_post_meta($post_id, '_lsp_TestCurrentVersion', $currentVersion+1);

    global $post;
    $lsp_testtitle1    = esc_html(get_post_meta($post->ID, '_lsp_post_testtitle1', true));
    $lsp_testdescription1    = esc_html(get_post_meta($post->ID, '_lsp_post_testdescription1', true));
    $lsp_testtitle2    = esc_html(get_post_meta($post->ID, '_lsp_post_testtitle2', true));
    $lsp_testdescription2    = esc_html(get_post_meta($post->ID, '_lsp_post_testdescription2', true));
    $lsp_robotitle1    = esc_html(get_post_meta($post->ID, '_lsp_post_robotitle1', true));
    $lsp_robotitle2    = esc_html(get_post_meta($post->ID, '_lsp_post_robotitle2', true));
    $lsp_robotitle3    = esc_html(get_post_meta($post->ID, '_lsp_post_robotitle3', true));
    $lsp_robotitle4    = esc_html(get_post_meta($post->ID, '_lsp_post_robotitle4', true));
    $lsp_seturl        = esc_html(get_post_meta($post->ID, '_lsp_post_seturl', true));
    $lsp_setwinner     = esc_html(get_post_meta($post->ID, '_lsp_post_setwinner', true));
    $lsp_success       = get_option("lsp-success");
    $lsp_cpm       = get_option("lsp-cpm");

    $versionscount = 0;
    if($lsp_testtitle1 || $lsp_testdescription1) $versionscount=$versionscount+1;
    if($lsp_testtitle2 || $lsp_testdescription2) $versionscount=$versionscount+1;
    if($lsp_robotitle1) $versionscount=$versionscount+1;
    if($lsp_robotitle2) $versionscount=$versionscount+1;
    if($lsp_robotitle3) $versionscount=$versionscount+1;
    if($lsp_robotitle4) $versionscount=$versionscount+1;

    $lsp_currentversion    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_TestCurrentVersion', true));

    //if(get_post_meta($post_id, '_lsp_TestWinningVersion', $currentVersion+1));

    if($lsp_seturl=="yes"){
      $thispost = get_post($theid);
      setup_postdata($thispost);

      $value = "";

      if($lsp_currentversion == 1) $value = $lsp_testtitle1;
      if($lsp_currentversion == 2) $value = $lsp_testtitle2;
      if($lsp_currentversion == 3) $value = $lsp_robotitle1;
      if($lsp_currentversion == 4) $value = $lsp_robotitle2;
      if($lsp_currentversion == 5) $value = $lsp_robotitle3;
      if($lsp_currentversion == 6) $value = $lsp_robotitle4;


      $originalName = $thispost->post_name;
      $oldname = get_post_meta($thispostid,'_lsp_old_name', true);

      $insertArray = array( 'ID' => $thispost->ID );

      $newPostSlug = str_replace(",","",$value);
      $newPostSlug = str_replace(" ","-",$value);

      if($oldname != $newPostSlug){
        if(($newPostSlug) && get_post_meta($thispost->ID,'_lsp_old_name',true)=="")update_post_meta($thispost->ID,'_lsp_old_name',$originalName);
        lsp_update_redirect('lspredirect_'.$key,$thispost->ID);
        $insertArray['post_name'] = $newPostSlug;
      }
      wp_update_post($insertArray);
    }

    if($lsp_seturl=="yes" && $lsp_setwinner=="yes" && $lsp_currentversion > $versionscount){
      /// CALCULATE THE WINNER HERE!!!!   Test6Value, Test6Traffic, Test6Conversions
      update_post_meta($thispost->ID,'_lsp_TestDone',"yes");
      update_post_meta($thispost->ID,'_lsp_old_name',"");
      if($lsp_success=="conversions"){
        $logsArray = array();
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test0Conversions',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test1Conversions',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test2Conversions',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test3Conversions',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test4Conversions',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test5Conversions',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test6Conversions',true);
        $maxVersionArray = array_keys($valsArray, max($valsArray));
        $maxVersion = $maxVersionArray[0];
        update_post_meta($thispost->ID,'_lsp_TestWinningVersion',$maxVersion);
      }

      if($lsp_success=="pageviews"){
        $logsArray = array();
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test0Traffic',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test1Traffic',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test2Traffic',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test3Traffic',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test4Traffic',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test5Traffic',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test6Traffic',true);
        $maxVersionArray = array_keys($valsArray, max($valsArray));
        $maxVersion = $maxVersionArray[0];
        update_post_meta($thispost->ID,'_lsp_TestWinningVersion',$maxVersion);
      }

      if($lsp_success=="both"){
        $logsArray = array();
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test0Value',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test1Value',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test2Value',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test3Value',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test4Value',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test5Value',true);
        $logsArray[] = get_post_meta($thispost->ID,'_lsp_Test6Value',true);
        $maxVersionArray = array_keys($valsArray, max($valsArray));
        $maxVersion = $maxVersionArray[0];
        update_post_meta($thispost->ID,'_lsp_TestWinningVersion',$maxVersion);
      }
      //_lsp_TestWinningVersion
      
      $value = "";
      if(get_post_meta($thispost->ID,'_lsp_TestWinningVersion',true) && get_post_meta($thispost->ID,'_lsp_TestDone',true) == "yes"){
        
        $lsp_wv = get_post_meta($thispost->ID,'_lsp_TestWinningVersion',true);

        if($lsp_wv == 1) $value = $lsp_testtitle1;
        if($lsp_wv == 2) $value = $lsp_testtitle2;
        if($lsp_wv == 3) $value = $lsp_robotitle1;
        if($lsp_wv == 4) $value = $lsp_robotitle2;
        if($lsp_wv == 5) $value = $lsp_robotitle3;
        if($lsp_wv == 6) $value = $lsp_robotitle4;

        $thispost = get_post($theid);
        setup_postdata($thispost);

        $originalName = $thispost->post_name;
        $oldname = get_post_meta($thispostid,'_lsp_old_name', true);

        $insertArray = array( 'ID' => $thispost->ID );

        $newPostSlug = str_replace(",","",$value);
        $newPostSlug = str_replace(" ","-",$value);

        if($oldname != $newPostSlug){
          if(($newPostSlug) && get_post_meta($thispost->ID,'_lsp_old_name',true)=="")update_post_meta($thispost->ID,'_lsp_old_name',$originalName);
          lsp_update_redirect('lspredirect_'.$key,$thispost->ID);
          $insertArray['post_name'] = $newPostSlug;
        }
        wp_update_post($insertArray);
      }    
    }
  }
  /// MAYBE SET THE LOCALPROJECT OPTIMIZER IN HERE, TOO?
  ///NEEDS WORK!
  ///if($lsp_currentversion==7)update_post_meta($post_id, '_lsp_TestWinningVersion', $currentVersion+1);
}

//LOOKS DONE
function lsp_update_postseoab_tests(){
  $lsp_all_query = new WP_Query(array('posts_per_page'=>-1, 'post_type' => 'any'));
  while($lsp_all_query->have_posts()){
    $lsp_all_query->the_post();
    //echo $lsp_all_query->post->ID . ", ";
    lsp_cron_post_test($lsp_all_query->post->ID);
    //lsp_cron_general_test($lsp_all_query->post->ID);
  }
  wp_reset_postdata();
}
add_action('init','lsp_update_postseoab_tests');

add_action('lsp_daily_event','lsp_update_postseoab_tests');

wp_schedule_event(time(),'hourly','lsp_daily_event');

/*
TestStartTime, TestRunningYesNo
  TestCurrentVersion
  Test1Value, Test1Traffic, Test1Conversions
  Test2Value, Test2Traffic, Test2Conversions
  Test3Value, Test3Traffic, Test3Conversions
  Test4Value, Test4Traffic, Test4Conversions
  Test5Value, Test5Traffic, Test5Conversions
  Test6Value, Test6Traffic, Test6Conversions
  targettedTerm, targettedCity!
  TestWinningVersion
  MANAGE THE REDIRECTS SOMEHOW!!!
*/

add_action('init','lsp_cookie');
function lsp_cookie(){
  if(!isset($_COOKIE['lsp_cookie'])){
    setcookie("lsp_cookie",rand(0,1000000000),time()+(86400 * 30),"/");

    if(get_post_meta($post_id, '_lsp_TestCurrentVersion', true))$currentVersion = get_post_meta($post_id, '_lsp_TestCurrentVersion', true);
    // NEED POSTID OF THE TEST AND THE VERSION VERSION VIEWED

    if(!isset($_COOKIE['lsp_landingpage']))setcookie("lsp_landingpage",rand(0,1000000000),time()+(86400 * 30),"/");
    if(!isset($_COOKIE['lsp_landingpostid']))setcookie("lsp_landingpostid",rand(0,1000000000),time()+(86400 * 30),"/");

    $lsp_isTest = 0;
    /*foreach(lsp_gettests() as $test){
      //COOKIE THEM THAT THEY HAVE SEEN THE TEST
      lsp_filterthepage($test);
      $lsp_isTest = 1;
    }*/

    $lsp_conversionurl1 = lsp_get_option('lsp-conversion-url');
    $lsp_conversionvalue1 = lsp_get_option('lsp-conversion-value');
    $lsp_conversionurl2 = lsp_get_option('lsp-conversion-url2');
    $lsp_conversionvalue2 = lsp_get_option('lsp-conversion-value2');
    $lsp_conversionurl3 = lsp_get_option('lsp-conversion-url3');
    $lsp_conversionvalue3 = lsp_get_option('lsp-conversion-value3');

    $lsp_cpm = lsp_get_option('lsp-cpm');

    $lsp_tester = 0;
    if(strstr($_SERVER['HTTP_REFERER'],"google.co"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"yahoo.co"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"bing.com"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"yandex.ru"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"altavista.com"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"fast"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"baidu.com"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"excite.com"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"baidu"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"duckduckgo"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"aol"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"naver"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"daum"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"dogpile"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"ask.com"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"rambler"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"search.com"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"haosou"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"shenma"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"easou"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"youdao"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"sougou"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"soso"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"7search"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"seznam"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"biglobe"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"entireweb"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"lycos"))$lsp_tester = 1;
    if(strstr($_SERVER['HTTP_REFERER'],"ecosia"))$lsp_tester = 1;
    
    if($lsp_tester){
      if(!isset($_COOKIE['lsp_seolandingpage']))setcookie("lsp_seolandingpage",rand(0,1000000000),time()+(86400 * 30),"/");
      global $post;
      if(!isset($_COOKIE['lsp_seolandingpostid']))setcookie("lsp_seolandingpostid",$post->ID,time()+(86400 * 30),"/");
      
      global $post;
      //ThisIsATitleTestedPostAndInLast14Days
      //Test1Value, Test1Traffic
      if($post->ID && get_post_meta($post->ID, '_lsp_TestCurrentVersion', true)!==""){
        $lsp_cv = get_post_meta($post->ID, '_lsp_TestCurrentVersion', true);
        if(!isset($_COOKIE['lsp_seolandingpostversion']))setcookie("lsp_seolandingpostversion", $lsp_cv,time()+(86400 * 30),"/");
        $lsp_oldValue = 0;
        if(get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Value', true))$lsp_oldValue = get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Value', true);
        update_post_meta($post->ID,'_lsp_Test'.$lsp_cv.'Value',$lsp_oldValue + ($lsp_cpm /1000 ));
        $lsp_oldValue = 0;
        if(get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Traffic', true))$lsp_oldValue = get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Traffic', true);
        update_post_meta($post->ID,'_lsp_Test'.$lsp_cv.'Traffic',$lsp_oldValue + 1);
      }
    }

    if($lsp_tester && $lsp_isTest){
      
    }





    $tests = lsp_gettests();
    foreach($tests as $test){
      if(!isset($_COOKIE['lsp_testseen_'.$test]))setcookie("lsp_landingpostid",rand(0,1000000000),time()+(86400 * 30),"/");
      if(!isset($_COOKIE['lsp_testseen_'.$test.'_version']))setcookie("lsp_landingpostid",rand(0,1000000000),time()+(86400 * 30),"/");
      /// LOG A TEST REGULAR VIEW/TRAFFIC!!! (post meta)

      get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Traffic', true);
    }

    ///substr_count checker for if they are viewing a test

    $lsp_isConversionURL = 0;

    $lsp_theurl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
    if($lsp_theurl == lsp_get_option('lsp-conversion-url'))$lsp_isConversionURL == 1;
    if($lsp_theurl == lsp_get_option('lsp-conversion-url2'))$lsp_isConversionURL == 1;
    if($lsp_theurl == lsp_get_option('lsp-conversion-url3'))$lsp_isConversionURL == 1;

    /// YOU NEED TO HAVE THE COOKIES FOR THE TEST LOGGED TO GRAB!!!
    if($lsp_isConversionURL){

      global $post;
      $lsp_cv = 0;
      $lsp_cv = get_post_meta($post->ID, '_lsp_TestCurrentVersion', true);
      $lsp_oldValue = 0;
      if($post->ID == $_COOKIE['lsp_seolandingpostid']){
        $lsp_oldValue = get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Conversions', true);
        update_post_meta($post->ID,'_lsp_Test'.$_COOKIE['seolandingpostversion'].'Conversions',$lsp_oldValue + 1);
      }
      // CHECK CONVERSIONS URLS FOR EACH TEST!?...or remove that double feature?    

      // LOG FOR EACH TEST
      // LOG IF SEO POST TEST WAS THE LANDING PAGE -- LOG TO THAT TEST
      // LOG TO REGULAR A/B TESTS...YOU NEED TO SET SOME COOKIES NEXT I THINK!

      /*
      $lsp_oldValue = 0;
        if(get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Traffic', true)$lsp_oldValue = if(get_post_meta($post->ID, '_lsp_Test'.$lsp_cv.'Traffic', true);
        update_post_meta($post->ID,'_lsp_Test'.$lsp_cv.'Traffic',$lsp_oldValue + 1);
        */

      //Give Credit to Landing Page OR PAGE TITLE TEST OR TEST VIEWED
        // FOR TITLE TEST
        // FOR SEO TEST
        // FOR A/B TEST
    }

    if(0){
      /// LOG 20 VARIATIONS' TRAFFIC IN HERE SOMEHWERE SOMEHOW!!!!!
    }
  }
}





function lsp_gettests(){
  //GET ALL THE TESTS
  $lsp_all_query = new WP_Query(array('posts_per_page'=>-1, 'post_type' => 'seoabtest'));
  $testsRunning = array();
  while($lsp_all_query->have_posts()){
    $lsp_all_query->the_post();
    //echo $lsp_all_query->post->ID . ", ";

    $lsp_isatest = 0;

    if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)){
      $slug = "";
      $post_type = get_post_type();
      if($post_type){
        $post_type_data = get_post_type_object($post_type);
        $slug = $post_type_data->rewrite['slug'];
      }

      if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_for',true)=="posts" && is_single()){
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="") $lsp_isatest = 1;
        // 4 Where Options
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="posttype" && is_post_type_archive(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true))  )$lsp_isatest = 1;
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="tax" && has_term(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true)))$lsp_isatest = 1;
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="pageid" && is_single(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true)))$lsp_isatest = 1;
      }

      if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_for',true)=="archives" && is_archive()){
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="") $lsp_isatest = 1;
        // 4 Where Options
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="posttype" && is_post_type_archive(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true))    )$lsp_isatest = 1;
        if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="tax" && 
          (
          is_tax($slug, get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true)) 
          || is_category(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true)) 
          || is_tag(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_value',true)) 
          )
          )$lsp_isatest = 1;
        //NOT AN OPTION BELOW
        //if(get_post_meta($lsp_all_query->post->ID,'lsp_post_ab_where',true)=="pageid" && is_archive()){}
      }
    }

    if($lsp_isatest)$testsRunning[] = $lsp_all_query->post->ID;


    $percentCheck;//?
    //TRIAL LOGGING
    //AUTO-APPLY LOGIC


    $forCheck;
    $whereCheck;
    $comparatorCheck;
    $trafficCheck;
     // different for SEO tests and regular tests!
    $ageCheck;
    $ageCheckStart;
    $ageCheckEnd;
    $trialDelay;
    $trialDuration;

//  update_post_meta($post_id, '_lspversionscount', sanitize_text_field($versionscount));
//  setcookie("lsp_cookie",rand(0,1000000000),time()+(86400 * 30),"/");

  }
  wp_reset_postdata();

  return $testsRunning;
  
//  return POSTIDSOF ALL TESTS;
}


function lsp_filterthepage($testid){
  /*if()add_filter(titlechangefilter)
  if()add_filter(titlebeforefilter)
  if()add_filter(titleafterfilter)
  if()add_filter(descriptionfilter)
  if()add_filter(findandreplacefilter)
  if()add_filter(cssinsertfilter)
  if()add_filter(jsinsertfilter)
*/
}

// wow it worked
/*
function callback($buffer){
  // for each regular a/b test (based on cookie id)
  // seo a/b test on page content (based on URL)
  // seo titles, page template, javascript (specific post)
  // NEED TO LOG ORIGINAL SOMEHOW

  return str_replace('Neighbor',"WHAT",$buffer);



}
function buffer_start(){ob_start("callback");}
function buffer_end(){ob_end_flush();}
add_action('init','buffer_start');
add_action('shutdown','buffer_end');
*/

/// ALSO ADD IN IMAGE FILTERING FOR WHOLE CONTENT IN PREMIUM VERSION!!!! (and check for image filtering limits)
/// ADD IN PROFIT LOGGING!
function lsp_print_test($testid){

}


///SEO PREVIEW MODE
///TESTER CACHING INTEGRATION
///REMOVE OLD URL IF A WINNER IS SET SO DEACTIVATION DOES NOT DELETE IT!!!



































/*
/// THIS CODE GOES IN THE TITLE / DESCRIPTION PART...AS DOES SOME SEO TRAFFIC LOGGING!!!!...not sure where 
add_action('wp','lsp_6titles');
function lsp_6titles(){   
    //  if(get_post_meta(''))

    global $post;
    $lsp_testtitle1    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_testtitle1', true));
    $lsp_testdescription1    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_testdescription1', true));
    $lsp_testtitle2    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_testtitle2', true));
    $lsp_testdescription2    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_testdescription2', true));
    $lsp_seturl        = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_seturl', true));   
    $lsp_robotitle1    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_robotitle1', true));
    $lsp_robotitle2    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_robotitle2', true));
    $lsp_robotitle3    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_robotitle3', true));
    $lsp_robotitle4    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_robotitle4', true));
    $lsp_setwinner    = esc_html(lsp_get_post_meta($post->ID, '_lsp_post_setwinner', true));

    $versionscount = 0;
    if($lsp_testtitle1 || $lsp_testdescription1) $versionscount=$versionscount+1;
    if($lsp_testtitle2 || $lsp_testdescription2) $versionscount=$versionscount+1;
    if($lsp_robotitle1) $versionscount=$versionscount+1;
    if($lsp_robotitle2) $versionscount=$versionscount+1;
    if($lsp_robotitle3) $versionscount=$versionscount+1;
    if($lsp_robotitle4) $versionscount=$versionscount+1;

   // $now = new Date();

    if(get_post_meta($post_id, '_lsp_TestWinningVersion', $currentVersion+1));

}*/




/*
function lsp_log_postseoab_view(){
  global $post;

//  $visitsCount =  lsp_get_post_meta($post->ID,'_seo-visits-count',true);
  
  $tester = 0;
  if(strstr($_SERVER['HTTP_REFERER'],"google.co"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"yahoo.co"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"bing.com"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"yandex.ru"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"altavista.com"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"fast"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"baidu.com"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"excite.com"))$tester = 1;
  if(strstr($_SERVER['HTTP_REFERER'],"baidu"))$tester = 1;

  if($tester)$visitsCount = 1 + $visitsCount;

  if($tester)update_post_meta($post->ID,'_seo-visits-count', $visitsCount);

    parse_str(lsp_get_option('lsp-locationData1'), $term1);
    $nowUrl = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (($nowUrl == $term1['lsp-addressIDURL1']) || ((is_front_page() || is_home()) && $term1['lsp-addressIDURL1'] == ""))
        lsp_printschema($term1);
}
add_action('wp_footer', 'lsp_log_postseoab_view');




*/



//AUTO-OPT ALL PAGES, THEN SPLIT LOW TRAFFIC & NO TRAFFIC PAGES & POSTS AFTER A FEW MONTHS ALL PAGES SLOWLY!?!?!
//...notify when new split tests set so client can check them
// DELAY PERIOD TO A/B TESTS ON POSTS OR A GENERAL PLACE FOR SETTINGS?
// ADD AN OPTION TO SORT LOW TRAFFIC POSTS & PAGES!!!!!! -- MENTION AS A FEATURE!!!!

/*
In the Cron{
  Set Winners
  Auto-Opt More Pages. Set Current Up To # to Show in Settings for Auto-Opt Pages
}


In the reports{
  
}
*/
/*





// go up to 4 robo titles
add_action('lsp_cron_hook','lsp_cron_exec');
wp_schedule_event(time(), 'daily','lsp_cron_hook');
function lsp_cron_exec(){
  //For each SEO a/b test
  //
  //For each post/blog post
  //check start date
  //if needed, change current test version
  //Set a winner
}

register_deactivation_hook(__FILE__, 'lsp_deactivate2');
function lsp_deactivate2(){
  $timestamp = wp_next_schedule('lsp_cron_hook');
}












add_action('init','lsp_cookie');
function lsp_cookie(){
  if(!isset($_COOKIE['lsp_cookie'])){
    setcookie("lsp_cookie",rand(0,1000000000),time()+(86400 * 30),"/");
  }
}

function lsp_testtoversion($tid){
  return (($_COOKIE['lsp_cookie'] % get_post_meta($tid,'lspversionscount')) + 1);
}

function lsp_logview($tid){
  $version = lsp_testtoversion($tid);
  update_post_meta($tid,'viewcount'.$version,get_post_meta($tid,'lspversionscount')+1);
  setcookie("lsp_test",$tid,time()+(86400 * 30),"/");
}

function lsp_logconversion($tid){
  $version = lsp_testtoversion($tid);
  update_post_meta($tid,'viewcount'.$version,get_post_meta($tid,'lspversionscount')+1);
  // for each test (if conversion page for that test, if viewed cookie set)
}



//add_filter('the_content','lsp_testcontent');
//add_filter('wp_title','lsp_testtitle'); 
//add_filter('pre_get_document_title', 'lsp_testhtmltitle', 99999999, 5); // the html title


function lsp_test($pid){
  if(1) return 0;
  else return 1;
}

function lsp_detect_conversions(){
  
}

// only for the site-wides
function lsp_detect_tests(){
    if(get_post_type())
    if(is_tax())
    if(get_post_meta())
    if($post->ID =='')
    if(get_the_date('YYYY-mm-dd'))
}
*/


/*

foreach(lsp_detect_tests() as $testid){
  lsp_set_cookie($testid);
  lsp_filter_contents($testid);
}



for triggered test(s), set test-viewed cookie, log a view (once at most per page)
when conversion url is viewed, log conversion for the test-viewed-version cookies



Filter Everything, then detect tests?



function lsp_filter_content($testid){
  
}

function lsp_filter_contents($testid){
  
}


Bug: Too many cities indexed


Template Name: HOME
Finish A/B Tests UI
Finish A/B Tester
//  - cookie setter
  - detector logic function!
  - content filter
  - cache invalidator
  - full page load filter
Finish SEO A/B Tester
Finish Titles SEO A/B Tester
Finish Analyzer Widget Thing


for each test, 
            if it's on this page view, set a cookie, log a view, woocommerce profit impact integration

            if this is its conversion URL, log a conversion, woocommerce profit impact integration


Discover Tests on This Page, Cookie Setter Incrementer

Set Cookies, Traffic Logging for Tests, Conversion Logging for Tests

Filter Title, Filter Metas, Filter Content, Filter Theme, Filter Page Template, Sitewide find-replacer, Add CSS, Add JS, caching undo
Cron Job Rotating

Reports & multivariate linking

lsp_test function

Keyword API Translator
Content Detector API
Rekognition API limiter

Suggestions Grabber and Filler PHP
Suggestions Grabber and Filler Javascript?

Updater Script with Filler into Settings?...or maybe a cron job?

Merge Plugin(s)
i18n of Plugin(s)


Conversion URLS
Optimize for Traffic or Conversions?

*/



add_action('wp_ajax_lsp_ajax', 'lsp_ajax');

function lsp_ajax(){
  //echo $_POST['data'];
  //echo "RUNNING";
  echo lsp_wp_httppost('http://www.bestlocalseotools.com/getKeywords.php?key='.lsp_get_option('lsp-api-key'),array('body'=> array('data' => strip_tags($_POST['data']) ) ) );
  die("");
}







?>
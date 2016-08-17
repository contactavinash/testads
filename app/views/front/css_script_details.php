<link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/font-awesome.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/bootstrap.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/style-common.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/styles.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/magicmenu.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/animate.css" media="all" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/owl.carousel.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/owl.transitions.css" /> 

<script type="text/javascript" src="<?php echo base_url(); ?>front/js/prototype.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/effects.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/controls.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/js.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/form.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/menu.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.meanmenu.hack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/magicmenu.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/owl.carousel.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>front/css/responsive.css" />

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript"> Themecfg = {"general":{"enabled":"1","jquery":"1","ajaxloading":"","baseUrl":""},"home":"\n            ","list":{"portrait":"2","landscape":"2","tablet":"3","desktop":"2","visibleItems":"3","widthImages":"300","heightImages":"366","height_images":"250","width_images":"200"},"detail":{"imageWidth":"800","zoomWidth":"500","zoomHeight":"700","zoomInner":"1","lightBox":"1","slide":"1","vertical":"0","auto":"0","controls":"1","pager":"0","slideMargin":"20","slideWidth":"100","portrait":"3","landscape":"3","tablet":"3","desktop":"3","visibleItems":"3","relatedSlide":"horizontal","relatedLimit":"10","upsellSlide":"horizontal","upsellLimit":"10","inforTabs":"1","activeTab":"box-description","showTitle":"1","adjustX":"10","adjustY":"0","thumbWidth":"100","thumbHeight":"122","imageHeight":"","thumbSlide":"horizontal","speed":"1000","pause":"100"},"related":{"slide":"1","vertical":"0","auto":"0","controls":"1","pager":"0","speed":"1000","pause":"100","slideMargin":"20","slideWidth":"278","portrait":"1","landscape":"2","tablet":"2","desktop":"3","visibleItems":"3"},"upsell":{"slide":"1","vertical":"0","auto":"0","controls":"1","pager":"0","speed":"1000","pause":"100","slideMargin":"20","slideWidth":"278","portrait":"1","landscape":"2","tablet":"2","desktop":"3","visibleItems":"3"},"crosssell":{"slide":"1","vertical":"0","auto":"0","controls":"1","pager":"0","speed":"1000","pause":"100","slideMargin":"20","slideWidth":"278","portrait":"1","landscape":"2","tablet":"3","desktop":"4","visibleItems":"4"},"labels":{"newLabel":"1","newText":"New","saleLabel":"1","saleText":"Sale","salePercent":"1"},"timer":{"enabled":"1","titleColor":"","timerColor":"","caption":"1","captionColor":""},"color":{"page_color":"#777777","page_background":"#ffffff","link_color":"#777777","link_color_hover":"#ffa800","link_color_active":"#ffa800","button_color":"#ffffff","button_color_hover":"#ffffff","button_background":"#434343","button_background_hover":"#ffa800","labelnew_color":"#ffffff","labelnew_background":"#ffa800","labelsale_color":"#ffffff","labelsale_background":"#ee3434"},"newsletter":{"enabled":"1","firstOnly":"0","timeDelay":"5000","autoClose":"0","timeClose":"10000","width":"800","height":"500","overlayColor":"#353535","background_color":"#ffffff","background_image":"default\/popup.jpg"},"categorysearch":{"enabled":"1","select_category_on_category_pages":"0","show_subcategories":"1","subcategories_level":"3","indentation_text":"-"},"checkout":{"crosssellsSlide":"1"}}
</script>


<script type="text/javascript" src="<?php echo base_url(); ?>front/js/tools.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/15-jquery.uniform-modified.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.ui.core.min.js"></script>

<!-- producttab --->

<link rel="stylesheet" href="<?php echo base_url(); ?>front/css/producttab.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo base_url(); ?>front/js/owl.carousel.js" type="text/javascript"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>front/css/product_list.css" type="text/css" media="all" />
<link rel="stylesheet" href="<?php echo base_url(); ?>front/css/jquery.ui.core.css" type="text/css" media="all" />
<script src="<?php echo base_url(); ?>front/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>front/js/exporting.js"></script>
<script>$(function () {
    $.getJSON('http://localhost/projects/pricecomparison/cashback/create_product_json/4/?callback=?', function (data) {
$('#container').highcharts({
            chart: {
                zoomType: 'x'
            },
            title: {
                text: ''
            },
            subtitle: {
                text: document.ontouchstart === undefined ?
                        '' : ''
            },
            xAxis: {
                type: 'datetime'
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                area: {
                    fillColor: {
                        linearGradient: {
                            x1: 0,
                            y1: 0,
                            x2: 0,
                            y2: 1
                        },
                        stops: [
                            [0, Highcharts.getOptions().colors[0]],
                            [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                        ]
                    },
                    marker: {
                        radius: 2
                    },
                    lineWidth: 1,
                    states: {
                        hover: {
                            lineWidth: 1
                        }
                    },
                    threshold: null
                }
            },

            series: [{
                type: 'area',
                name: 'Product Price <?php echo $currency;?>',
                data: data
            }]
        });
    });
});</script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.min.1.11.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.noconflict.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/bootstrap.min.js"></script>

<!--- PRODUCT DETAIL --->
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.ddslick.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.easing.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/common.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/modernizr.custom.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/enquire.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>front/js/jquery.elevateZoom-3.0.8.min.js"></script>
<link href="<?php echo base_url(); ?>front/css/style.css" rel="stylesheet">
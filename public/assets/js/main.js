jQuery(function($) {'use strict',

	//#main-slider
	$(function(){
		$('#main-slider.carousel').carousel({
			interval: 8000
		});
	});


	// accordian
	$('.accordion-toggle').on('click', function(){
		$(this).closest('.panel-group').children().each(function(){
		$(this).find('>.panel-heading').removeClass('active');
		 });

	 	$(this).closest('.panel-heading').toggleClass('active');
	});

	//Initiat WOW JS
	new WOW().init();

	// portfolio filter
	$(window).load(function(){'use strict';
		var $portfolio_selectors = $('.portfolio-filter >li>a');
		var $portfolio = $('.portfolio-items');
		$portfolio.isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
		
		$portfolio_selectors.on('click', function(){
			$portfolio_selectors.removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			$portfolio.isotope({ filter: selector });
			return false;
		});
	});

	// Contact form
	var form = $('#main-contact-form');
	form.submit(function(event){
		event.preventDefault();
		var form_status = $('<div class="form_status"></div>');
		$.ajax({
			url: $(this).attr('action'),

			beforeSend: function(){
				form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
			}
		}).done(function(data){
			form_status.html('<p class="text-success">' + data.message + '</p>').delay(3000).fadeOut();
		});
	});

	
	//goto top
	$('.gototop').click(function(event) {
		event.preventDefault();
		$('html, body').animate({
			scrollTop: $("body").offset().top
		}, 500);
	});	

	//Pretty Photo
	$("a[rel^='prettyPhoto']").prettyPhoto({
		social_tools: false
	});	




/* PAGE RECAPITULATIVE DES PROCHES */

	/* Renoncement à un article */
	$(".renoncement").click(function(e)
	{
		e.preventDefault();
		if(confirm('Etes-vous sur ?'))
		{
			var key = $(this).attr('data-key');
			var time = $(this).attr('data-time');
			var product_id = $(this).attr('data-product');
			var id = $(this).attr('data-id');
			$.post("/nos-proches/renoncement", { key:key, time:time, product_id:product_id, id:id }, function(data)
			{
			     if(data == 1)
				{
					$("#tr_"+id).fadeOut();
					alert("Vous avez rompu votre engagement concernant cet article");
				}
				else
				{
					alert(data);
				}
			});
		}
		
	});


/* PAGE LISTE DE NAISSANCE */
$(".filter").each(function()
{
	var text = $(this).attr("data-text");
	$(this).html('<span class="glyphicon glyphicon-check"></span> '+text);
});

$(".filter").mousedown(function(e)
{
	e.preventDefault();
	var target = $(this).attr("data-target");
	var statut = $(this).attr("data-statut");
	var text = $(this).attr("data-text");
	if(statut == 0)
	{
		$(this).attr("data-statut", 1).addClass('alert-danger').removeClass('alert-success').html('<span class="glyphicon glyphicon-unchecked"></span> '+text);
		$(target).fadeOut('slow');
	}
	else
	{
		$(this).attr("data-statut", 0).addClass('alert-success').removeClass('alert-danger').html('<span class="glyphicon glyphicon-check"></span> '+text);
		$(target).fadeIn('slow');	
	}
});



	recalculer();
	$("#btn-reservation").hide();

	$("body").on('mousedown','.joffreoupas',function(e)
	{
		e.preventDefault();
		var id = $(this).attr("data-id");
		var checked = $(this).attr("data-checked");
		var select = $(this).attr("data-select");

		var newchecked = (checked == 1) ? 0 : 1;
		$(this).attr("data-checked",newchecked);
		if(newchecked == 1)
		{
			$(this).html('<span class="glyphicon glyphicon-check"></span> J\'offre</a>').addClass('btn-success').removeClass('btn-danger');
			$("#"+id).val(1);	

			/* Avtion sur le select dans le cadre d'une offre mixte */
			if( $("#"+select).length == 1)
			{
				$("#"+select).hide();
			}
		}
		else
		{
			$(this).html('<span class="glyphicon glyphicon-unchecked"></span> J\'offre</a>').addClass('btn-danger').removeClass('btn-success');
			$("#"+id).val(0);	
			if( $("#"+select).length == 1)
			{
				$("#"+select).show();
			}		
		}

		recalculer();
	});

	$("body").on('change','.jefinanceoupas',function(e)
	{
		e.preventDefault();
		var input = $(this).attr('data-input');
		if($(this).val() == 0)
		{
			$(this).addClass('btn-danger').removeClass('btn-success');
			if( $("#"+input).length == 1)
			{
				$("#"+input).show();
			}
		}
		else
		{
			$(this).addClass('btn-success').removeClass('btn-danger');
			if( $("#"+input).length == 1)
			{
				$("#"+input).hide();
			}
		}

		recalculer();

	});

	/* PAGE FINANCEMENTS */
	$(".btn-financement").click(function(e) {
		e.preventDefault();
		var financements = $(this).attr("data-id");
		$.post("/nos-proches/paypal", { financements:financements }, function(data)
			{
			     $('#mainsection').html(data);
			     $("form").eq(1).submit();
			});
	});

});

function recalculer()
{
	var aoffrir = 0;
	$(".offreinput").each(function()
	{
		var el = $(this).prev("a");
		var select = $(el).attr("data-select");

		aoffrir += parseInt($(this).val());
		if($(this).val() == 1)
		{
			$(el).html('<span class="glyphicon glyphicon-check"></span> J\'offre</a>').addClass('btn-success').removeClass('btn-danger');
			if( $("#"+select).length == 1)
			{
				$("#"+select).hide();
			}
		}
		else
		{
			$(el).html('<span class="glyphicon glyphicon-unchecked"></span> J\'offre</a>').addClass('btn-danger').removeClass('btn-success');
			if( $("#"+select).length == 1)
			{
				$("#"+select).show();
			}
		}


	});

	var price = 0;
	$(".jefinanceoupas").each(function()
	{
		var value = $(this).attr('data-value');
		var part = $(this).val();
		price += parseInt(part)*parseInt(value);
		var input = $(this).attr("data-input");
		if($(this).val() == 0)
		{
			$(this).addClass('btn-danger').removeClass('btn-success');
			if( $("#"+input).length == 1)
			{
				$("#"+input).show();
			}
		}
		else
		{
			$(this).addClass('btn-success').removeClass('btn-danger');
			if( $("#"+input).length == 1)
			{
				$("#"+input).hide();
			}
		}



	});	
	if(aoffrir == 0 && price == 0)
	{
		$("#btn-reservation").hide();
	}
	else if(aoffrir > 0 && price == 0)
	{
		$("#btn-reservation").show();
		$("#btn-reservation").html("Je réserve ("+aoffrir+" article(s) à offrir)");
	}
	else if(aoffrir == 0 && price > 0)
	{
		$("#btn-reservation").show();
		$("#btn-reservation").html("Je réserve ("+price+" € de financement)");
	}
	else
	{
		$("#btn-reservation").show();
		$("#btn-reservation").html("Je réserve ("+aoffrir+" article(s) à offrir et "+price+" € de financement)");
	}

	
}
$(document).ready(function(){
	/*--------------------кнопка наверх------------------------*/
	$(window).scroll(function(){
		if ($(window).scrollTop() >= $('.main').offset().top)
			$('.to-top').fadeIn(100);
		else
			$('.to-top').fadeOut(100);
	});
	$('.to-top').click(function(){
		$("body,html").animate({ scrollTop: 0 }, 500);
	});
	/*--------------------------------------------------------*/
	/*--------------------меню вверх--------------------------*/
	/*var max_height = $(window).height() - 100 < 400 ? 515 : $(window).height() - 100;
	$('.text-search-help-overflow').css({
		'max-height' : max_height + 'px'
	});*/
	$('.text-search-help-close').click(function(){
		$('.text-search-help-wrapper').hide();
		$('.text-search-help-close').hide();
	});
	$('#category').change(function(){
		if ($(this).val() == -100)
		{
			$('#category_sub').val(-100);
			$('.header-bottom-form_left.__category_sub').hide();
			$('.header-bottom-form_left.__text').removeClass('__shorter');
		}
		else
		{
			$('.header-bottom-form_left.__category_sub').show();
			$('.header-bottom-form_left.__text').addClass('__shorter');
		}
		$('.header-bottom-form_left.__category_sub').addClass('__load');
		$('#category_sub').attr('disabled', 'disabled');
		$.post("/category/ajaxgetsub/", {id : $(this).val()}, 
			function (data){
				$('#category_sub').html(data);
				$('.header-bottom-form_left.__category_sub').removeClass('__load');
				$('#category_sub').removeAttr('disabled');
				search_book();
		});
	});
	$('#category_sub').change(function(){
		search_book();
	});
	var search_text_timer;
	var search_book = function(){
		var category = $('#category').val();
		var category_sub = $('#category_sub').val();
		var text = $('#search_text').val();
		$('.text-search-help-wrapper').addClass('__load');
		$('.text-search-help-wrapper').show();
		$('.text-search-help-close').show();
		$.post("/site/ajaxsearch/", {category : category, category_sub : category_sub, text : text}, 
			function (data){
				$('.text-search-help').html(data);
				$('.text-search-help-wrapper').removeClass('__load');
		});
	};
	$('#search_text').keyup(function(){
		clearTimeout(search_text_timer);
		search_text_timer = setTimeout(search_book, 1000);
	});
	/*--------------------------------------------------------*/
	/*--------------------меню слева--------------------------*/
	$('.middle-menu-item.__active').find('.middle-menu-sub').show();
	$('.middle-menu-item_title').click(function(){
		if (!$(this).parent().hasClass('__active'))
		{
			$('.middle-menu-sub').slideUp();
			$('.middle-menu-item').removeClass('__active');
			$(this).parent().addClass('__active');
			$(this).parent().find('.middle-menu-sub').slideDown();
		}
		else
		{
			$(this).parent().find('.middle-menu-sub').slideUp();
			$(this).parent().removeClass('__active');
		}
	});
	/*--------------------------------------------------------*/
	/*--------------------скролл меню--------------------------*/
	/*$(document).scroll(function(){
		if ($(window).scrollTop() < $('.header-bottom-wrapper').offset().top)
			$('.header-bottom').removeClass('__fixed');
		else 
			$('.header-bottom').addClass('__fixed');
	});*/
	/*--------------------------------------------------------*/
	/*--------------------загрузка книг на стартовой--------------------------*/
	var start_products_more = 0;
	$('.start-products-more').click(function(){
		$(this).addClass('__load');
		$.post("/site/ajaxbooks/", {begin: start_products_more + 32},
			function (data){
				$('.start-products-list').append(data);
				$('.start-products-more').removeClass('__load');
				start_products_more = start_products_more + 32;
				// itemUpdate();
		});
	});
	/*--------------------------------------------------------*/
	/*--------------------загрузка книг в категории--------------------------*/
	var category_products_more = 0;
	$('.products-pages-more').click(function(){
		$(this).addClass('__load');
		$.post("/category/ajaxbooks/", {begin: category_products_more + 36, category: $('#current_model').val()},
			function (data){
				$('.products-list').append(data);
				$('.products-pages-more').removeClass('__load');
				category_products_more = category_products_more + 36;
				var total_count = $('#total_count').val();
				$('.products-pages-see').html('Показано ' + (category_products_more + 36 > total_count ? total_count : category_products_more + 36) + ' из ' + total_count);
				if (category_products_more + 36 > total_count)
					$('.products-pages-more').hide();
				// itemUpdate();
		});
	});
	/*--------------------------------------------------------*/
	/*--------------------рекомендуем--------------------------*/
	$('.product-recommend-control.__next').click(function(){
		$('.product-recommend-list').animate({'left': '-1041px'}, 'slow');
		$('.product-recommend-control.__next').addClass('__block');
		$('.product-recommend-control.__back').removeClass('__block');
	});
	$('.product-recommend-control.__back').click(function(){
		$('.product-recommend-list').animate({'left': '0px'}, 'slow');
		$('.product-recommend-control.__back').addClass('__block');
		$('.product-recommend-control.__next').removeClass('__block');
	});
	/*--------------------------------------------------------*/
	/*--------------------показать весь текст-----------------*/
	if ($('.product-view-desc p').height() > 270)
	{
		$('.product-view-desc-content').addClass('__limit');
		$('.product-view-desc-content_more').show();
	}
	$('.product-view-desc-content_more').click(function(){
		$('.product-view-desc-content').removeClass('__limit');
		$(this).hide();
	});
	if ($('.product-view-bookone-content').height() > 185)
	{
		$('.product-view-bookone-content').addClass('__limit');
		$('.product-view-bookone-content_more').show();
	}
	$('.product-view-bookone-content_more').click(function(){
		$('.product-view-bookone-content').removeClass('__limit');
		$(this).hide();
	});
	$('.product-review-item').each(function(key, item){
		if ($(item).find('.review-item-content p').height() > 150)
		{
			$(item).find('.review-item-content-wrapper').addClass('__limit');
			$(item).find('.review-item-content-wrapper_more').show();
		}
	});
	$('.product-review-list').on('click', '.review-item-content-wrapper_more', function(){
		$(this).parent().find('.review-item-content-wrapper').removeClass('__limit');
		$(this).hide();
	});
	/*--------------------------------------------------------*/
	/*----------------------оценка отзыва---------------------*/
	$('.review_field_rating li').hover(function(){ 
		for (var i = 0; i < 5; i++)
			if (i <= $(this).index())
				$('.review_field_rating li').eq(i).addClass('__active');
			else
				$('.review_field_rating li').eq(i).removeClass('__active');
	},function(){
		var review_mark = $('#review_mark').val();
		for (var i = 0; i < 5; i++)
			if (i < review_mark)
				$('.review_field_rating li').eq(i).addClass('__active');
			else
				$('.review_field_rating li').eq(i).removeClass('__active');
	});
	$('.review_field_rating li').click(function(){
		$('#review_mark').val($(this).index() + 1);
	});
	/*--------------------------------------------------------*/
	/*--------------------создание отзыва---------------------*/
	$('.review-top-click-mark').click(function(){
		$('.popup_out_review').show();
	});
	$('.review-click-mark').click(function(){
		$('.popup_out_review').show();
	});
	$('.review_form').click(function(){
		return false;
	});
	$('.review_form_close').click(function(){
		$('.review_form').show();
		$('.review_create_success').hide();
		$('.popup_out_review').hide();
	});
	$('.popup_out_review').click(function(){
		$('.review_form').show();
		$('.review_create_success').hide();
		$('.popup_out_review').hide();
	});
	$('.review_create_success_button').click(function(){
		$('.review_form').show();
		$('.review_create_success').hide();
		$('.popup_out_review').hide();
	});
	$('.review_submit').click(function(){
		var review_name = $('#review_name').val();
		var review_mark = $('#review_mark').val();
		var review_message = $('#review_message').val();
		var error;
		if (!review_name)
		{
			error = $('#review_name');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (!(review_mark && review_mark*1))
		{
			error = $('#review_mark');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (!review_message)
		{
			error = $('#review_message');
			error.siblings('.review_field_input_error').fadeIn();
			error.siblings('.review_field_input_error').fadeOut(2000);
		}
		if (!error)
		{
			$(this).addClass('__loader');
			var currentDom = this;
			$.post(
				'/review/ajaxcreate/',
				{
					review_name : review_name,
					review_mark : review_mark,
					review_message : review_message,
					book_id: $('#book_id').val()
				},
				function (data){
					if (data.error)
					{
						var error_save = $('#review_message');
						error_save.siblings('.review_field_input_error').fadeIn();
						error_save.siblings('.review_field_input_error').fadeOut(2000);
					}
					else
					{
						if ($('#review_count').val()*1)
							$('.product-review-list').prepend(data.html);
						else
						{
							$('.product-review-list').html(data.html);
							$('.review-pages').show();
							$('.review-pages-see').html('Показано 1 из 1');
							$('#review_count').val(1);
						}
						$('.review_form').hide();
						$('#review_name').val('');
						$('#review_mark').val(0);
						$('.review_field_rating li').removeClass('__active');
						$('#review_message').val('');
						$('.review_create_success').show();
					}
					$(currentDom).removeClass('__loader');
				}, 'json'
			);
		}
	});
	/*--------------------------------------------------------*/
	/*---------------------Обратная связь---------------------*/
	$('.contacts-feedback span').click(function(){
		$('.popup_out_message').show();
	});
	$('.message_form').click(function(){
		return false;
	});
	$('.message_form_close').click(function(){
		$('.message_form').show();
		$('.message_create_success').hide();
		$('.popup_out_message').hide();
	});
	$('.popup_out_message').click(function(){
		$('.message_form').show();
		$('.message_create_success').hide();
		$('.popup_out_message').hide();
	});
	$('.message_create_success_button').click(function(){
		$('.message_form').show();
		$('.message_create_success').hide();
		$('.popup_out_message').hide();
	});
	$('.message_submit').click(function(){
		var message_name = $('#message_name').val();
		var message_email = $('#message_email').val();
		var message_message = $('#message_message').val();
		var error;
		if (!message_name)
		{
			error = $('#message_name');
			error.siblings('.message_field_input_error').fadeIn();
			error.siblings('.message_field_input_error').fadeOut(2000);
		}
		if (!message_email)
		{
			error = $('#message_email');
			error.siblings('.message_field_input_error').fadeIn();
			error.siblings('.message_field_input_error').fadeOut(2000);
		}
		if (!message_message)
		{
			error = $('#message_message');
			error.siblings('.message_field_input_error').fadeIn();
			error.siblings('.message_field_input_error').fadeOut(2000);
		}
		if (!error)
		{
			$(this).addClass('__loader');
			var currentDom = this;
			$.post(
				'/site/ajaxcreatemessage/',
				{
					message_name : message_name,
					message_email : message_email,
					message_message : message_message,
					url: window.location.href
				},
				function (data){
					$('.message_create_success').show();
					$('.message_form').hide();
					$('#message_name').val('');
					$('#message_email').val('');
					$('#message_message').val('');
					$(currentDom).removeClass('__loader');
				}
			);
		}
	});
	/*--------------------------------------------------------*/
	/*-------------------------Подписка-----------------------*/
	$('.popup_out_subscription').click(function(){
		$('.popup_out_subscription').hide();
	});
	$('.subscription_create_success_button').click(function(){
		$('.popup_out_subscription').hide();
	});
	$('.header-subscription-submit').click(function(){
		var subscription_category = $('#subscription_category').val();
		var subscription_email = $('#subscription_email').val();
		var error;
		if (!subscription_email)
		{
			error = $('#subscription_email');
			error.siblings('.subscription_field_input_error').fadeIn();
			error.siblings('.subscription_field_input_error').fadeOut(2000);
		}
		if (!error)
		{
			$('.popup_out_subscription').show();
			$.post(
				'/site/ajaxsubscription/',
				{
					subscription_category : subscription_category,
					subscription_email : subscription_email
				},
				function (data){
				}
			);
		}
	});
	/*--------------------------------------------------------*/
	/*-----------------загрузка отзывов-----------------------*/
	var review_more = 0;
	$('.review-pages-more').click(function(){
		$(this).addClass('__load');
		$.post("/book/ajaxreviewmore/", {begin: review_more + 10, book_id: $('#book_id').val()},
			function (data){
				$('.product-review-list').append(data);
				$('.review-pages-more').removeClass('__load');
				review_more = review_more + 10;
				var review_count = $('#review_count').val();
				$('.review-pages-see').html('Показано ' + (review_more + 10 > review_count ? review_count : review_more + 10) + ' из ' + review_count);
				if (review_more + 10 > review_count)
					$('.review-pages-more').hide();
				$('.product-review-item').each(function(key, item){
					if ($(item).find('.review-item-content p').height() > 150 && key >= review_more)
					{
						$(item).find('.review-item-content-wrapper').addClass('__limit');
						$(item).find('.review-item-content-wrapper_more').show();
					}
				});
		});
	});
	/*--------------------------------------------------------*/
	/*-------------------link to market-----------------------*/
	$('.link-to-market').click(function(){
		var type = $(this).data('type');
		var book_id = $('#book_id').val();
		
		$('.out_link_inner').addClass('__load');
		$('.popup_out_link').show();

		$.post("/book/ajaxgetmarketlink/", {type: type, book_id: book_id},
			function (data){
				$('.out_link_inner').html(data);
				$('.out_link_inner').removeClass('__load');
		});
	});
	$('.out_link_close').click(function(){
		$('.popup_out_link').hide();
	});
	$('.out_link_button').click(function(){
		$('.popup_out_link').hide();
	});
	/*--------------------------------------------------------*/
	/*----------------------tab in view-----------------------*/
	$('.review-tab li').click(function(){
		var id = $(this).data('id');
		$(this).addClass('__active').siblings().removeClass('__active');
		$('.product-review-list-wrapper.__' + id).addClass('__active').siblings('.product-review-list-wrapper').removeClass('__active');

		switch (id) {
			case 'description':
				var desc_load = $('.product-view-desc-content.__load');
				if (desc_load && desc_load.length)
				{
					var id = $('#book_id').val();
					$.post("/book/ajaxgetdesc/", {id: id},
						function (data){
							$('.product-view-desc-content p').html(data);
							$('.product-view-desc-content').removeClass('__load');
					});
				}
				break;

			case 'review':
				var desc_load = $('.product-review-list.__load_on_active');
				if (desc_load && desc_load.length)
				{
					$.post("/book/ajaxreviewmore/", {begin: 0, book_id: $('#book_id').val()},
						function (data){
							$('.product-review-list').append(data);
							$('.product-review-list').removeClass('__load_on_active');

							$('.product-review-item').each(function(key, item){
								if ($(item).find('.review-item-content p').height() > 150 && key >= review_more)
								{
									$(item).find('.review-item-content-wrapper').addClass('__limit');
									$(item).find('.review-item-content-wrapper_more').show();
								}
							});
					});
				}
				break;
		}
	});
	/*--------------------------------------------------------*/
	/*----------------------save my about---------------------*/
	var saveMyAbout = $('.product-bookone-myabout.__save');
	if (saveMyAbout && saveMyAbout.length)
	{
		$.post("/book/ajaxsavemyabout/", {
			book_id: $('#book_id').val(),
			html: $(saveMyAbout).html(),
		});
	}
	/*--------------------------------------------------------*/
	/*------------------------load city-----------------------*/
	$('.header-city-current').click(function(){
		$('.popup_out_city').show();
		$('.city_popup_content').addClass('__load');

		$.post("/city/ajaxheaderlist/", {},
			function (data){
				$('.city_popup_content').html(data);
				$('.city_popup_content').removeClass('__load');
		});
	});
	$('.popup_out_city').click(function(){
		$('.popup_out_city').hide();
	});
	$('.city_popup_close').click(function(){
		$('.popup_out_city').hide();
	});
	$('.city_popup').click(function(){
		return false;
	});
	$('.city_popup_content').on('click', 'span', function(){
		var id = $(this).data('id');
		$(this).addClass('__load');
		
		$.post("/city/ajaxgeturl/",
			{
				id: id,
				url: window.location.href
			},
			function (data){
				document.location.href = data;
		});
	});
	/*--------------------------------------------------------*/
	/*--------------------подгрузка данных списка-------------*/
	saveCategoryText();
	// itemUpdate();
	// getShop();
	viewUpdate();
	reviewUpdate();
	// setTimeout(getDescription, 1000);
	setTimeout(viewImgUpdate, 1000);
	setTimeout(recommendUpdate, 2000);
	setTimeout(imgUpdate, 1500);
	/*--------------------------------------------------------*/
});

function getDescription()
{
	var desc_load = $('.product-view-desc-content.__load');
	if (desc_load && desc_load.length)
	{
		var id = $('#book_id').val();
		$.post("/book/ajaxgetdesc/", {id: id},
			function (data){
				$('.product-view-desc-content p').html(data);
				$('.product-view-desc-content').removeClass('__load');
				if ($('.product-view-desc p').height() > 270)
				{
					$('.product-view-desc-content').addClass('__limit');
					$('.product-view-desc-content_more').show();
				}
		});
	}
};

function getShop()
{
	var id = $('#book_id').val();
	$.post("/book/ajaxgetshop/", {id: id},
		function (data){
			$('.product-view-compare ul.__shop').html(data);
	});
};

function saveCategoryText()
{
	var list = $('.products-list.__need_save');
	if (list && list.length)
	{
		var total_count = $('#total_count').val();
		var category_id = $('#current_model').val();
		var begin = $('#begin').val();
		var text = $(list).html();
		$.post("/category/ajaxsavetext/", {total_count: total_count, category_id: category_id, text: text, begin: begin},
			function (data){
		});
	}
}

function itemUpdate()
{
	alert('itemUpdate');
	var book_item = $('.products-item.__load').first();
	if (book_item && book_item.length)
	{
		var id_arr = $(book_item).attr('id');
		var id = id_arr.split('_');
		$.post("/site/ajaxgetitem/", {id: id},
			function (data){
				$(book_item).html(data);
				$(book_item).removeClass('__load');
				itemUpdate();
		});
	}
};

function viewUpdate()
{
	var view_load = $('.product-view-info.__load');
	if (view_load && view_load.length)
	{
		var id = $('#book_id').val();
		$.post("/book/ajaxviewupdate/", {id: id},
			function (data){
				$('.product-view-info-price-val span').html(data.price);
				$('.product-view-compare li.__ozon span').html(data.price);
				$('.product-view-info-price-load').hide();
		}, 'json');
	}
};

function reviewUpdate()
{
	var review_load = $('.product-review-list.__load');
	if (review_load && review_load.length)
	{
		var id = $('#book_id').val();
		$.post("/book/ajaxreviewupdate/", {id: id},
			function (data){
				$('.product-review-list').html(data.html);
				$('.product-review-list').removeClass('__load');
				var review_count = data.review_count;
				if (review_count)
				{
					$('.review-pages').show();
					$('#review_count').val(review_count);
					$('.review-pages-see').html('Показано ' + (10 > review_count ? review_count : 10) + ' из ' + review_count);
					if (10 > review_count)
						$('.review-pages-more').hide();
					else
						$('.review-pages-more').show();
					$('.product-review-item').each(function(key, item){
						if ($(item).find('.review-item-content p').height() > 150)
						{
							$(item).find('.review-item-content-wrapper').addClass('__limit');
							$(item).find('.review-item-content-wrapper_more').show();
						}
					});
				}
		}, 'json');
	}
};

function viewImgUpdate()
{
	var img = $('.product-view-img-wrapper.__load img');
	var src = $(img).data('url');
	$(img).attr('src', 'http://static.ozone.ru/multimedia/books_covers' + src);
};

function recommendUpdate()
{
	$('.product-recommend-item.__load .recommend-item-img img').each(function(key, item){
		var src = $(item).data('url');
		$(item).attr('src', 'http://static.ozone.ru/multimedia/books_covers' + src);
	});
};

function imgUpdate()
{
	$('.products-item.__load .products-item-img img').each(function(key, item){
		var src = $(item).data('url');
		$(item).attr('src', 'http://static.ozone.ru/multimedia/books_covers' + src);
	});
};
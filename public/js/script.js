;
var getModels = function (url, data, ajaxContent) {
	(function ($) {
		return $.ajax({
			url: url,
			type: "POST",
			dataType: 'json',
			cache: false,
			data: data,
			error: function (jqXHR, textStatus) {
				return console.log("AJAX Error: " + textStatus);
			},
			success: function (data) {
				
				var brand_models_list = '';
				if (data.models !== undefined){
					$.each(data.models, function (i, model) {
						brand_models_list += '<li>'+model.name+'</li>';
					});
				}
				ajaxContent.html(brand_models_list);
				$('#car_model').val('').focus();
				return console.log(JSON.stringify(data.models));
			}
		}, false)
	})(jQuery);
};

(function ($) {
	
	var car_brand = $("#car_brand");
	var car_model = $("#car_model");
	var add_model = $("#add_model");
	var ajax_content = $("#brand-models");
	var data = {};
	
	var currVal = car_brand.val();
	
	if (currVal != null) {
		console.log(currVal);
		data = {
			'brand_id': currVal
		};
		getModels('/car/model', data, ajax_content);
		car_brand.on("change", function () {
			currVal = $(this).val();
			console.log(currVal);
			data = {
				'brand_id': currVal
			};
			getModels('/car/model', data, ajax_content);
		});
		
		add_model.on("click", function () {
			var model_val = car_model.val();
			if (model_val !== '') {
				console.log(model_val);
				data = {
					'brand_id': currVal,
					'add_model': model_val
				};
				getModels('/car/model', data, ajax_content);
			}
		});
	}
})(jQuery);


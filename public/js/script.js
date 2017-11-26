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
				
				var brand_models_list = '<option value="0" disabled="" selected="" hidden="">Модель...</option>';
				if (data.models !== undefined){
					$.each(data.models, function (i, model) {
						brand_models_list += '<option value="'+model.id+'">'+model.name+'</option>';
					});
				}
				ajaxContent.html(brand_models_list);
				return console.log(JSON.stringify(data.models));
			}
		}, false)
	})(jQuery);
};

(function ($) {
	
	var car_brand = $("#car_brand");
	var car_model = $("#car_model");
	var data = {};
	
	var currVal = car_brand.val();
	
	if (currVal != null) {
		console.log(currVal);
		data = {
			'brand_id': currVal
		};
		car_model.removeAttr('disabled');
		getModels('/car/model', data, car_model);
	}
	
	car_brand.on("change", function () {
		currVal = $(this).val();
		console.log(currVal);
		data = {
			'brand_id': currVal
		};
		car_model.removeAttr('disabled');
		getModels('/car/model', data, car_model);
	});
	
})(jQuery);


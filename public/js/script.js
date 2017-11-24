;
(function($){

		var car_brand = $("#car_brand");
		var currVal = car_brand.val();
		if (currVal != null){
			console.log(currVal);
		}

		car_brand.on("change",function () {
			currVal = $(this).val();
			console.log(currVal);
			getModels('/car/model', currVal);
		})

})(jQuery);

var getModels = function (url, value, ajaxContent) {
	(function ($){
		return $.ajax({
			url: url,
			type: "GET",
			dataType: 'json',
			cache: false,
			data: {
				'brand_id': value
			},
			error: function (jqXHR, textStatus) {
				return console.log("AJAX Error: " + textStatus);
			},
			success: function (data) {
				return console.log(data);
				//return ajaxContent.val(data);
			}
		}, false)
	})(jQuery);
};
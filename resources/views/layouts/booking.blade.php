<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Icons -->
    <script src="https://kit.fontawesome.com/d5a6d7f85a.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @stack('styles')
</head>
<body>
    <div id="app">
        @include('includes.login-navbar')
        <main>
            @yield('content')
        </main>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.js" integrity="sha512-WBbdKQKeIQFarq1hrOxNL/gnp0Tqh25fn0z3X1po+ej8iuHhHdp6Sh9l+tghGw5L1bsvtzjeuSKsL80RW3XdYw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

    <script src="{{ asset('js/booking.js') }}"></script>

    <script>
		function changePrice(event)
		{
			$.ajax({
				type: "post",
				url: "{{ route('price') }}",
				data: {
					"_token": "{{ csrf_token() }}",
					"id": event.target.value
				},
				success: function(data) {
					var element = event.target.id
					var array = element.split("_");
					console.log(data);
					$("#price_"+array[2]).val(data.price);
				},
				error: function(error) {
					console.log(error);
				}
			});
		}
    </script>
    <script>
    let datos = '';
	let existingDates = [];
	var t = 1;
	$(document).ready(function() {
		$.ajax({
			type: "post",
			url: "{{ route('select') }}",
			data: {
				"_token": "{{ csrf_token() }}"
			},
			success: function(data) {
				datos = $.parseJSON(data);
				fill(1);
			},
			error: function(error) {
				console.log(error);
			}
		});
	});

	function fill(id)
	{
		$('#service_id_'+id).append('<option value = "">Seleccione</option>');
		for (var i = 0; i < datos.length; i++) {
			<?php if(isset($selected_service)){ ?>
				var service_id = '<?php echo $selected_service->id; ?>';
			<?php }else{ ?>
				var service_id = '';
            <?php } ?>
			var selected = (datos[i].value == service_id && id == 1) ? 'selected' : '';
			$('#service_id_'+id).append('<option value = \"' + datos[i].value + '\"' + selected +  '>' + datos[i].description + '</option>');
		}
	}

	function remove(index)
	{
		var date = $('#datepicker_' + index).val();
		var time = $("#time_" + index).val();
		var values = date + "_" + time;
		removeItemFromArray(values);
		$("#row_" + index).remove();
		console.log(existingDates);
	}

	function validate(index)
	{
		var date = $('#datepicker_' + index).val();
		var time = $("#time_" + index).val();
		if (date !== "" && time !== ""){
			if(existingDates[index]){
				existingDates.splice(index, 1);
			}
			call_to_controller(date, time, url, index);
		}
	}

	function removeItemFromArray(item) {
    	var i = existingDates.indexOf(item);
		console.log(i);
		if ( i !== -1 ) {
			existingDates.splice(i, 1);
		}
	}

	$("#addRow").click(function()
	{
		t += 1;
		var row = `<tr class="item-row" id="row_${t}">
						<td class="col-1">
							<input class="form-control qty" name="quantity[]" id="quantity_${t}" value="1" type="text" readonly="readonly">
						</td>
						<td class="col-4">
							<select class="form-control" name="service_id[]" id="service_id_${t}" onchange='changePrice(event);'>

							</select>
						</td>
						<td class="col-2">
							<input
								type="text"
								id="datepicker_${t}"
								name="date[]"
								class="form-control date"
								placeholder="{{ __('Select') }}"
								onfocus="(this.type='date')"
								onblur="(this.type='text')"
								onchange="validate(${t})"
							>
							<span class="text-danger" id="date-response_${t}"></span>
						</td>
						<td class="col-2">
							<select class="form-control" name="time[]" id="time_${t}" onchange="validate(${t})">
								<option value="" selected>{{ __('Select') }}</option>
								<option value="06:00">06:00</option>
								<option value="06:30">06:30</option>
								<option value="07:00">07:00</option>
								<option value="07:30">07:30</option>
								<option value="08:00">08:00</option>
								<option value="08:30">08:30</option>
								<option value="09:00">09:00</option>
								<option value="09:30">09:30</option>
								<option value="10:00">10:00</option>
								<option value="10:30">10:30</option>
								<option value="11:00">11:00</option>
								<option value="11:30">11:30</option>
								<option value="12:00">12:00</option>
								<option value="12:30">12:30</option>
								<option value="13:00">13:00</option>
								<option value="13:30">13:30</option>
								<option value="14:00">14:00</option>
								<option value="14:30">14:30</option>
								<option value="15:00">15:00</option>
								<option value="15:30">15:30</option>
								<option value="16:00">16:00</option>
								<option value="16:30">16:30</option>
								<option value="17:00">17:00</option>
								<option value="17:30">17:30</option>
								<option value="18:00">18:00</option>
								<option value="18:30">18:30</option>
								<option value="19:00">19:00</option>
								<option value="19:30">19:30</option>
								<option value="200:00">20:00</option>
							</select>
						</td>
						<td class="col-2">
							<input class="form-control price" name="price[]" id="price_${t}" placeholder="Precio" type="number" value="" readonly="readonly">
						</td>
						<td class="col-1">
							<span class="total" id="subtotal_${t}">0.00</span>
						</td>
						<td>
							<button type="button" onclick="remove(${t})" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
						</td>
					</tr>`;
		$('#rows').append(row);
		fill(t);
	});
    </script>

    <script>
      let date;
      let time;
      let url = "{{route('check.date')}}";

    function call_to_controller(date, time, url, index) {

        $.ajax({
        	type: "post",
          	url: url,
          	data: {"_token": "{{ csrf_token() }}",
                	date: date, time: time, url: url
                },
          	success: function(data) {
				if (data){
					$("#date-response_" + index).html('La fecha está ocupada');
				}else{
					var values = date + '_' + time;
					if(existingDates.includes(values)){
						$("#date-response_" + index).html('La fecha está ocupada');
					}else{
						$("#date-response_" + index).html('');
						existingDates[index] = values;
					}
				}
				console.log(existingDates);
        	},
          	error: function (error) {
            	console.log(error);
          	}
        });
    };
    </script>

    @stack('scripts')
</body>
</html>

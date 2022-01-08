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

      function changePrice()

      {
        var option = $("#service_id :selected").attr("data-price");
        
        document.getElementById('price').value = option;
        
      }
    </script>


    <script>

      let datos = '';

      $(document).ready(function(){

        $.ajax({
          type: "post",
          url: "{{ route('select') }}",
          data: {"_token": "{{ csrf_token() }}"},
          success: function(data) {
            datos = $.parseJSON(data);
            for(var i = 0; i < datos.length; i++) {
                $('#service_id').append('<option value = \"' + datos[i].value + '\" data-price = \"' + datos[i].price + '\">' + datos[i].description + '</option>');
            }
          },
          error: function (error) { 
            console.log(error); 
          }
                                   
        });  
        
      });                                  
    </script>

    <script>
      $("#addRow").click(function(){

        $.ajax({
          type: "post",
          url: "{{ route('select') }}",
          data: {"_token": "{{ csrf_token() }}"},
          success: function(data) {
            datos = $.parseJSON(data);
            for(var i = 0; i < datos.length; i++) {
                $('#service_id').append('<option value = \"' + datos[i].value + '\" data-price = \"' + datos[i].price + '\">' + datos[i].description + '</option>');
            }
          },
          error: function (error) { 
            console.log(error); 
          }
                                   
        }); 
        
      });                                  
    </script>

    <script>
                   
      let date;
      let time;
      let url = "{{route('check.date')}}";

      $('#datepicker').change(function() {
          date = $(this).val();
          if ( $("#time").val()!=="" && $("#datepicker").val() !== "")
          {
            call_to_controller(date, time, url);
          }
      });

      $('#time').change(function() {
          time = $(this).val();
          if ( $("#time").val()!=="" && $("#datepicker").val() !== "")
          {
            call_to_controller(date, time, url);
          }
      });
      

      function call_to_controller(date, time, url) {

        $.ajax({
          type: "post",
          url: url,
          data: {"_token": "{{ csrf_token() }}",
                  date: date, time: time, url: url 
                },
          success: function(data) {
            if (data) 
            {
              $("#date-response").html('La fecha está ocupada');
            } 
            else 
            {
              $("#date-response").html('');
            }
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

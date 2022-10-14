@extends('layouts.app')
@extends('layouts.sidebar.index')
{{-- @section('content') --}}
<div class="container mt-4" style="position: absolute; justify-content: center">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Estadísticas') }}</div>
                <div class="card-body">
                    <canvas id="myChart"  width="400" height="200"></canvas>
                </div>

            </div>
        </div>
    </div>
</div>
{{-- @endsection
 --}}<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var labels =  {{ Js::from($labels) }};
      var users =  {{ Js::from($data) }};
      const data = {
        labels: labels,
        datasets: [{
          label: 'Registro de usuarios',
          backgroundColor: '#fff',
          borderColor: '#042331',
          data: users,
        }]
      };
  
      const config = {
        type: 'line',
        data: data,
        options: {}
      };
  
      const myChart = new Chart(
        document.getElementById('myChart'),
        config
      );
</script>
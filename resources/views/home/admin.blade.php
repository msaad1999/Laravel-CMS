@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Admin Home</h1>
    </div>

    <div class="row">
        @include('layouts.components.card', [
            'textclass' => 'success',
            'title' => 'Users',
            'faIcon' => '<i class="fas fa-users fa-2x text-gray-300"></i>',
            'data' => $users->count(),
        ])
        @include('layouts.components.card', [
            'textclass' => 'success',
            'title' => 'Posts',
            'faIcon' => '<i class="fas fa-book-open fa-2x text-gray-300"></i>',
            'data' => $posts->count(),
        ])
        @include('layouts.components.card', [
            'textclass' => 'success',
            'title' => 'Categories',
            'faIcon' => '<i class="fas fa-file-alt fa-2x text-gray-300"></i>',
            'data' => $categories->count(),
        ])
        @include('layouts.components.card', [
            'textclass' => 'success',
            'title' => 'Comments',
            'faIcon' => '<i class="fas fa-bullhorn fa-2x text-gray-300"></i>',
            'data' => $comments->count() + $replies->count(),
        ])
    </div>

    <div class="row">
        @include('layouts.components.areachart', [
            'id' => 'regAreaChart',
            'heading' => 'Registration Status',
        ])
    </div>

</div>

@endsection

@push('scripts')
<script>
// Registrations Area Chart
var ctx = document.getElementById("regAreaChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: "Earnings",
      lineTension: 0.3,
      backgroundColor: "rgba(78, 115, 223, 0.05)",
      borderColor: "rgba(78, 115, 223, 1)",
      pointRadius: 3,
      pointBackgroundColor: "rgba(78, 115, 223, 1)",
      pointBorderColor: "rgba(78, 115, 223, 1)",
      pointHoverRadius: 3,
      pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
      pointHoverBorderColor: "rgba(78, 115, 223, 1)",
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return '$' + number_format(value);
          }
        },
        gridLines: {
          color: "rgb(234, 236, 244)",
          zeroLineColor: "rgb(234, 236, 244)",
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});
</script>
@endpush



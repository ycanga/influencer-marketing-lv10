 <!-- Order Statistics -->
 <div class="col-md-8 col-lg-8 col-xl-8 order-0 mb-4">
     <div class="card h-100">
         <div class="card-header d-flex align-items-center justify-content-between pb-0">
             <div class="card-title mb-0">
                 <h5 class="m-0 me-2">Kazançlarım</h5>
             </div>
         </div>
         <div class="card-body">
             <div class="d-flex justify-content-between align-items-center mb-3">
                 <div class="d-flex flex-column align-items-center gap-1">
                     <h2 class="mb-2">{{ $totalRevenue }} ₺</h2>
                     <span>Toplam Kazançlarım</span>
                 </div>
                 <div id="inflOrderStatistic"></div>
             </div>
             <ul class="p-0 m-0">
                 @foreach ($allCampaigns as $campaign)
                     <li class="d-flex mb-4 pb-1">
                         <div class="avatar flex-shrink-0 me-3">
                             <img src="{{ $campaign->campaigns->image }}" alt="{{ $campaign->campaigns->name }}">
                         </div>
                         <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                             <div class="me-2">
                                 <h6 class="mb-0">{{ ucfirst($campaign->campaigns->name) }}</h6>
                                 <small class="text-muted">
                                     @if ($campaign->campaigns->type == 'sales')
                                         Satış Kampanyası
                                     @elseif($campaign->campaigns->type == 'click')
                                         Tıklama Kampanyası
                                     @elseif($campaign->campaigns->type == 'multiple')
                                         Çoklu Kampanya
                                     @endif
                                 </small>
                             </div>
                             <div class="user-progress">
                                 @if ($campaign->campaigns->type == 'sales')
                                     <small class="fw-semibold">
                                         <b class="text-primary">{{ $campaign->view_count }}</b> Adet Satış
                                     </small>
                                 @elseif($campaign->campaigns->type == 'click')
                                     <small class="fw-semibold">
                                         {{ $campaign->click_count }} Adet Tıklama
                                     </small>
                                 @elseif($campaign->campaigns->type == 'multiple')
                                     <small class="fw-semibold">
                                         {{ $campaign->view_count }} Adet Satış
                                     </small><br>
                                     <small class="fw-semibold">
                                         {{ $campaign->click_count }} Adet Tıklama
                                     </small>
                                 @endif
                             </div>
                             <div class="user-progress">
                                 <small class="fw-semibold">
                                     {{ $campaign->revenue }} ₺
                                 </small>
                             </div>
                         </div>
                     </li>
                 @endforeach
             </ul>
         </div>
     </div>
 </div>
 <!--/ Order Statistics -->

  <!--/ Total Revenue -->
  <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
    <div class="row">
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <i class='bx bx-wallet'></i>
                    </div>
                    <span class="fw-semibold d-block mb-1">Tahmini Satış Kazancınız</span>
                    <h3 class="card-title text-nowrap mb-2 text-success">{{ $salesRevenue }} ₺</h3>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <i class='bx bxs-hand-up'></i>
                    </div>
                    <span class="fw-semibold d-block mb-1">Tahmini Tıklama Kazancınız</span>
                    <h3 class="card-title mb-2 text-success">{{ $clickRevenue }} ₺</h3>
                </div>
            </div>
        </div>
    </div>
</div>

 @php
     $sales = 0;
     $click = 0;
     $multiple = 0;
 @endphp

 @foreach ($campaignTypes as $campaignType)
     @php
         if ($campaignType->type == 'sales') {
             $sales = $campaignType->total;
         } elseif ($campaignType->type == 'click') {
             $click = $campaignType->total;
         } elseif ($campaignType->type == 'multiple') {
             $multiple = $campaignType->total;
         }
     @endphp
 @endforeach

 <script src="https://code.jquery.com/jquery-3.7.1.slim.js"
     integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
 <script>
     let cardColor, headingColor, axisColor, shadeColor, borderColor;

     cardColor = config.colors.white;
     headingColor = config.colors.headingColor;
     axisColor = config.colors.axisColor;
     borderColor = config.colors.borderColor;

     // Order Statistics Chart
     // --------------------------------------------------------------------
     const chartOrderStatistics = document.querySelector('#inflOrderStatistic'),
         orderChartConfig = {
             chart: {
                 height: 165,
                 width: 180,
                 type: 'donut'
             },
             labels: ['Satış Kampanyası', 'Tıklama Kampanyası', 'Çoklu Kampanya'],
             series: [
                 {{ $sales }}, {{ $click }}, {{ $multiple }}
             ],
             colors: [config.colors.success, config.colors.info, config.colors.primary],
             stroke: {
                 width: 5,
                 colors: cardColor
             },
             dataLabels: {
                 enabled: false,
                 formatter: function(val, opt) {
                     return parseInt(val) + 'Adet';
                 }
             },
             legend: {
                 show: false
             },
             grid: {
                 padding: {
                     top: 0,
                     bottom: 0,
                     right: 15
                 }
             },
             plotOptions: {
                 pie: {
                     donut: {
                         size: '75%',
                         labels: {
                             show: true,
                             value: {
                                 fontSize: '1.5rem',
                                 fontFamily: 'Public Sans',
                                 color: headingColor,
                                 offsetY: -15,
                                 formatter: function(val) {
                                     return parseInt(val) + ' Adet';
                                 }
                             },
                             name: {
                                 offsetY: 20,
                                 fontFamily: 'Public Sans'
                             },
                             total: {
                                 show: true,
                                 fontSize: '0.8125rem',
                                 color: axisColor,
                                 label: 'İşlem',
                                 formatter: function(w) {
                                     return w.globals.seriesTotals.reduce((a, b) => {
                                         return a + b;
                                     }, 0) + ' Adet';
                                 }
                             }
                         }
                     }
                 }
             }
         };
     if (typeof chartOrderStatistics !== undefined && chartOrderStatistics !== null) {
         const statisticsChart = new ApexCharts(chartOrderStatistics, orderChartConfig);
         statisticsChart.render();
     }

     //  $(document).ready(function() {
     //      // Grafik referansı
     //      let totalRevenueChart;
     //      let growthChart;

     //      // İlk yüklemede veri çekme
     //      getChartData().then(function(data) {
     //          renderChart(data);
     //          const growthRates = calculateGrowthRates(data);
     //          renderGrowthChart(growthRates);
     //      });

     //      // weekInput değiştiğinde veri çekme ve grafiği güncelleme
     //      var weekInput = document.getElementById('weekInput');
     //      weekInput.addEventListener('change', function() {
     //          var week = this.value;
     //          getChartData(week).then(function(data) {
     //              renderChart(data);
     //              const growthRates = calculateGrowthRates(data);
     //              renderGrowthChart(growthRates);
     //          });
     //      });

     //      // Total Revenue Report Chart - Bar Chart
     //      function renderChart(data) {
     //          const totalRevenueChartEl = document.querySelector('#revenueWeekChart');

     //          // Mevcut grafiği yok et
     //          if (totalRevenueChart) {
     //              totalRevenueChart.destroy();
     //          }

     //          const totalRevenueChartOptions = {
     //              series: [{
     //                  name: 'Satış Tutarı',
     //                  data: data.map(item => item.revenue) // response verisini buraya yerleştirin.
     //              }],
     //              chart: {
     //                  height: 300,
     //                  stacked: true,
     //                  type: 'bar',
     //                  toolbar: {
     //                      show: false
     //                  }
     //              },
     //              plotOptions: {
     //                  bar: {
     //                      horizontal: false,
     //                      columnWidth: '33%',
     //                      borderRadius: 12,
     //                      startingShape: 'rounded',
     //                      endingShape: 'rounded'
     //                  }
     //              },
     //              colors: [config.colors.primary, config.colors.info],
     //              dataLabels: {
     //                  enabled: false
     //              },
     //              stroke: {
     //                  curve: 'smooth',
     //                  width: 6,
     //                  lineCap: 'round',
     //                  colors: [cardColor]
     //              },
     //              legend: {
     //                  show: true,
     //                  horizontalAlign: 'left',
     //                  position: 'top',
     //                  markers: {
     //                      height: 8,
     //                      width: 8,
     //                      radius: 12,
     //                      offsetX: -3
     //                  },
     //                  labels: {
     //                      colors: axisColor
     //                  },
     //                  itemMargin: {
     //                      horizontal: 10
     //                  }
     //              },
     //              grid: {
     //                  borderColor: borderColor,
     //                  padding: {
     //                      top: 0,
     //                      bottom: -8,
     //                      left: 20,
     //                      right: 20
     //                  }
     //              },
     //              xaxis: {
     //                  categories: ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'],
     //                  labels: {
     //                      style: {
     //                          fontSize: '13px',
     //                          colors: axisColor
     //                      }
     //                  },
     //                  axisTicks: {
     //                      show: false
     //                  },
     //                  axisBorder: {
     //                      show: false
     //                  }
     //              },
     //              yaxis: {
     //                  labels: {
     //                      style: {
     //                          fontSize: '13px',
     //                          colors: axisColor
     //                      }
     //                  }
     //              },
     //              responsive: [{
     //                      breakpoint: 1700,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '32%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 1580,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '35%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 1440,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '42%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 1300,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '48%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 1200,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '40%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 1040,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 11,
     //                                  columnWidth: '48%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 991,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '30%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 840,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '35%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 768,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '28%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 640,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '32%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 576,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '37%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 480,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '45%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 420,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '52%'
     //                              }
     //                          }
     //                      }
     //                  },
     //                  {
     //                      breakpoint: 380,
     //                      options: {
     //                          plotOptions: {
     //                              bar: {
     //                                  borderRadius: 10,
     //                                  columnWidth: '60%'
     //                              }
     //                          }
     //                      }
     //                  }
     //              ],
     //              states: {
     //                  hover: {
     //                      filter: {
     //                          type: 'none'
     //                      }
     //                  },
     //                  active: {
     //                      filter: {
     //                          type: 'none'
     //                      }
     //                  }
     //              }
     //          };
     //          if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
     //              totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
     //              totalRevenueChart.render();
     //          }
     //      }

     //      // Growth Chart - Radial Bar Chart
     //      function renderGrowthChart(data) {
     //          const growthChartEl = document.querySelector('#growthChartValue');

     //          // Mevcut grafiği yok et
     //          if (growthChart) {
     //              growthChart.destroy();
     //          }

     //          const growthChartOptions = {
     //              series: [data[data.length - 1].growthRate], // Son günün büyüme oranı
     //              labels: ['Kazanç Oranı'],
     //              chart: {
     //                  height: 240,
     //                  type: 'radialBar'
     //              },
     //              plotOptions: {
     //                  radialBar: {
     //                      size: 150,
     //                      offsetY: 10,
     //                      startAngle: -150,
     //                      endAngle: 150,
     //                      hollow: {
     //                          size: '55%'
     //                      },
     //                      track: {
     //                          background: cardColor,
     //                          strokeWidth: '100%'
     //                      },
     //                      dataLabels: {
     //                          name: {
     //                              offsetY: 15,
     //                              color: headingColor,
     //                              fontSize: '15px',
     //                              fontWeight: '600',
     //                              fontFamily: 'Public Sans'
     //                          },
     //                          value: {
     //                              offsetY: -25,
     //                              color: headingColor,
     //                              fontSize: '22px',
     //                              fontWeight: '500',
     //                              fontFamily: 'Public Sans'
     //                          }
     //                      }
     //                  }
     //              },
     //              colors: [config.colors.primary],
     //              fill: {
     //                  type: 'gradient',
     //                  gradient: {
     //                      shade: 'dark',
     //                      shadeIntensity: 0.5,
     //                      gradientToColors: [config.colors.primary],
     //                      inverseColors: true,
     //                      opacityFrom: 1,
     //                      opacityTo: 0.6,
     //                      stops: [30, 70, 100]
     //                  }
     //              },
     //              stroke: {
     //                  dashArray: 5
     //              },
     //              grid: {
     //                  padding: {
     //                      top: -35,
     //                      bottom: -10
     //                  }
     //              },
     //              states: {
     //                  hover: {
     //                      filter: {
     //                          type: 'none'
     //                      }
     //                  },
     //                  active: {
     //                      filter: {
     //                          type: 'none'
     //                      }
     //                  }
     //              }
     //          };
     //          if (typeof growthChartEl !== undefined && growthChartEl !== null) {
     //              growthChart = new ApexCharts(growthChartEl, growthChartOptions);
     //              growthChart.render();
     //          }
     //      }
     //  });

     //  // Günden güne artış oranlarını hesaplama
     //  function calculateGrowthRates(data) {
     //      let growthRates = [];

     //      for (let i = 1; i < data.length; i++) {
     //          let previousDayRevenue = data[i - 1].revenue;
     //          let currentDayRevenue = data[i].revenue;

     //          let growthRate = 0;
     //          if (previousDayRevenue !== 0) {
     //              growthRate = ((currentDayRevenue - previousDayRevenue) / previousDayRevenue) * 100;
     //          }

     //          growthRates.push({
     //              day: data[i].day,
     //              growthRate: growthRate
     //          });
     //      }

     //      return growthRates;
     //  }

     //  function getChartData(week = '') {
     //      return new Promise(function(resolve, reject) {
     //          var userId = '{{ auth()->user()->id }}';
     //          $.ajax({
     //              url: `{{ route('weekly.get', ['userId' => ':userId', 'date' => ':week']) }}`.replace(
     //                  ':userId', userId).replace(':week', week),
     //              type: 'GET',
     //              success: function(response) {
     //                  resolve(response);
     //                  updateRevenue(response)
     //              },
     //              error: function(xhr, status, error) {
     //                  reject(error);
     //              }
     //          });
     //      });
     //  }

     //  function updateRevenue(data) {
     //      if (data.length === 0) {
     //          return {
     //              highestRevenueDay: null,
     //              lowestRevenueDay: null
     //          };
     //      }

     //      let highestRevenueDay = data[0];
     //      let lowestRevenueDay = data[0];

     //      for (let i = 1; i < data.length; i++) {
     //          if (data[i].revenue != '0') {
     //              if (data[i].revenue > highestRevenueDay.revenue) {
     //                  highestRevenueDay = data[i];
     //              }
     //              if (data[i].revenue < lowestRevenueDay.revenue && data[i].revenue != '0') {
     //                  lowestRevenueDay = data[i];
     //              }
     //          }
     //      }

     //      document.getElementById('upDate').innerText = highestRevenueDay.day;
     //      document.getElementById('upDateRevenue').innerText = highestRevenueDay.revenue + ' ₺';
     //      document.getElementById('downDate').innerText = lowestRevenueDay.day;
     //      document.getElementById('downDateRevenue').innerText = lowestRevenueDay.revenue + ' ₺';
     //  }
 </script>

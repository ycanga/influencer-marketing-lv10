<div class="col-lg-12 col-md-12 order-1">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bxs-carousel'></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Aktif Kampanya Sayısı</span>
                    <h3 class="card-title mb-2 text-primary">{{ $campaignsCount }} Adet</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-user'></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Kayıtlı İnfluencer Sayısı</span>
                    <h3 class="card-title text-nowrap mb-1 text-primary">{{ $influencerCount }} Adet</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bxs-user'></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Kayıtlı Marka Sayısı</span>
                    <h3 class="card-title text-nowrap mb-1 text-primary">{{ $merchantCount }} Adet</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-help-circle'></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Açık Destek Talebi Sayısı</span>
                    <h3 class="card-title text-nowrap mb-1 text-primary">{{ $supportCount }} Adet</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-md-12 order-1">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bx-dollar-circle'></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Bekleyen Para Çekme Talepleri</span>
                    <h3 class="card-title mb-2 text-primary">{{ $moneyDemands }} Adet</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <i class='bx bxs-wallet'></i>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Bekleyen Bakiye Yükleme Talepleri</span>
                    <h3 class="card-title text-nowrap mb-1 text-primary">{{ $balanceHistory }} Adet</h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Total Revenue -->
<div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
    <div class="card">
        <div class="row row-bordered g-0">
            <div class="col-md-8">
                <h5 class="card-header m-0 me-2 pb-3">Haftalık Satış Değerleri</h5>
                <div id="revenueWeekChart" class="px-2"></div>
            </div>
            <div class="col-md-4">
                <div class="card-body">
                    <div class="text-center">
                        <div class="dropdown">
                            <input type="week" name="" id="weekInput" class="form-control">
                        </div>
                    </div>
                </div>
                <div id="growthChartValue"></div>
                <div class="text-center fw-semibold pt-3 mb-2">Haftalık Değerler</div>

                <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                    <div class="d-flex">
                        <div class="me-2">
                            <span class="badge bg-label-secondary p-2"><i class="bx bx-dollar text-success"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <small id="upDate">2022</small>
                            <h6 class="mb-0" id="upDateRevenue">$32.5k</h6>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="me-2">
                            <span class="badge bg-label-secondary p-2"><i class="bx bx-dollar text-danger"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <small id="downDate">2021</small>
                            <h6 class="mb-0" id="downDateRevenue">$41.2k</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Total Revenue -->

<script src="https://code.jquery.com/jquery-3.7.1.slim.js"
    integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let cardColor, headingColor, axisColor, shadeColor, borderColor;

    cardColor = config.colors.white;
    headingColor = config.colors.headingColor;
    axisColor = config.colors.axisColor;
    borderColor = config.colors.borderColor;

    $(document).ready(function() {
        // Grafik referansı
        let totalRevenueChart;
        let growthChart;

        // İlk yüklemede veri çekme
        getChartData().then(function(data) {
            renderChart(data);
            const growthRates = calculateGrowthRates(data);
            renderGrowthChart(growthRates);
        });

        // weekInput değiştiğinde veri çekme ve grafiği güncelleme
        var weekInput = document.getElementById('weekInput');
        weekInput.addEventListener('change', function() {
            var week = this.value;
            getChartData(week).then(function(data) {
                renderChart(data);
                const growthRates = calculateGrowthRates(data);
                renderGrowthChart(growthRates);
            });
        });

        // Total Revenue Report Chart - Bar Chart
        function renderChart(data) {
            const totalRevenueChartEl = document.querySelector('#revenueWeekChart');

            // Mevcut grafiği yok et
            if (totalRevenueChart) {
                totalRevenueChart.destroy();
            }

            const totalRevenueChartOptions = {
                series: [{
                    name: 'Satış Tutarı',
                    data: data.map(item => item.revenue) // response verisini buraya yerleştirin.
                }],
                chart: {
                    height: 300,
                    stacked: true,
                    type: 'bar',
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '33%',
                        borderRadius: 12,
                        startingShape: 'rounded',
                        endingShape: 'rounded'
                    }
                },
                colors: [config.colors.primary, config.colors.info],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 6,
                    lineCap: 'round',
                    colors: [cardColor]
                },
                legend: {
                    show: true,
                    horizontalAlign: 'left',
                    position: 'top',
                    markers: {
                        height: 8,
                        width: 8,
                        radius: 12,
                        offsetX: -3
                    },
                    labels: {
                        colors: axisColor
                    },
                    itemMargin: {
                        horizontal: 10
                    }
                },
                grid: {
                    borderColor: borderColor,
                    padding: {
                        top: 0,
                        bottom: -8,
                        left: 20,
                        right: 20
                    }
                },
                xaxis: {
                    categories: ['Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi', 'Pazar'],
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: axisColor
                        }
                    },
                    axisTicks: {
                        show: false
                    },
                    axisBorder: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            fontSize: '13px',
                            colors: axisColor
                        }
                    }
                },
                responsive: [{
                        breakpoint: 1700,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '32%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1580,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '35%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1440,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '42%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1300,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '48%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1200,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '40%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 1040,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 11,
                                    columnWidth: '48%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 991,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '30%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 840,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '35%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 768,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '28%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 640,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '32%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 576,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '37%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 480,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '45%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 420,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '52%'
                                }
                            }
                        }
                    },
                    {
                        breakpoint: 380,
                        options: {
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    columnWidth: '60%'
                                }
                            }
                        }
                    }
                ],
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };
            if (typeof totalRevenueChartEl !== undefined && totalRevenueChartEl !== null) {
                totalRevenueChart = new ApexCharts(totalRevenueChartEl, totalRevenueChartOptions);
                totalRevenueChart.render();
            }
        }

        // Growth Chart - Radial Bar Chart
        function renderGrowthChart(data) {
            const growthChartEl = document.querySelector('#growthChartValue');

            // Mevcut grafiği yok et
            if (growthChart) {
                growthChart.destroy();
            }

            const growthChartOptions = {
                series: [data[data.length - 1].growthRate], // Son günün büyüme oranı
                labels: ['Kazanç Oranı'],
                chart: {
                    height: 240,
                    type: 'radialBar'
                },
                plotOptions: {
                    radialBar: {
                        size: 150,
                        offsetY: 10,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            size: '55%'
                        },
                        track: {
                            background: cardColor,
                            strokeWidth: '100%'
                        },
                        dataLabels: {
                            name: {
                                offsetY: 15,
                                color: headingColor,
                                fontSize: '15px',
                                fontWeight: '600',
                                fontFamily: 'Public Sans'
                            },
                            value: {
                                offsetY: -25,
                                color: headingColor,
                                fontSize: '22px',
                                fontWeight: '500',
                                fontFamily: 'Public Sans'
                            }
                        }
                    }
                },
                colors: [config.colors.primary],
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'dark',
                        shadeIntensity: 0.5,
                        gradientToColors: [config.colors.primary],
                        inverseColors: true,
                        opacityFrom: 1,
                        opacityTo: 0.6,
                        stops: [30, 70, 100]
                    }
                },
                stroke: {
                    dashArray: 5
                },
                grid: {
                    padding: {
                        top: -35,
                        bottom: -10
                    }
                },
                states: {
                    hover: {
                        filter: {
                            type: 'none'
                        }
                    },
                    active: {
                        filter: {
                            type: 'none'
                        }
                    }
                }
            };
            if (typeof growthChartEl !== undefined && growthChartEl !== null) {
                growthChart = new ApexCharts(growthChartEl, growthChartOptions);
                growthChart.render();
            }
        }
    });

    // Günden güne artış oranlarını hesaplama
    function calculateGrowthRates(data) {
        let growthRates = [];

        for (let i = 1; i < data.length; i++) {
            let previousDayRevenue = data[i - 1].revenue;
            let currentDayRevenue = data[i].revenue;

            let growthRate = 0;
            if (previousDayRevenue !== 0) {
                growthRate = ((currentDayRevenue - previousDayRevenue) / previousDayRevenue) * 100;
            }

            growthRates.push({
                day: data[i].day,
                growthRate: growthRate
            });
        }

        return growthRates;
    }

    function getChartData(week = '') {
        return new Promise(function(resolve, reject) {
            var userId = '{{ auth()->user()->id }}';
            $.ajax({
                url: `{{ route('admin.weekly.get', ['userId' => ':userId', 'date' => ':week']) }}`
                    .replace(
                        ':userId', userId).replace(':week', week),
                type: 'GET',
                success: function(response) {
                    resolve(response);
                    updateRevenue(response)
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    function updateRevenue(data) {
        if (data.length === 0) {
            return {
                highestRevenueDay: null,
                lowestRevenueDay: null
            };
        }

        let highestRevenueDay = data[0];
        let lowestRevenueDay = data[0];

        for (let i = 1; i < data.length; i++) {
            if (data[i].revenue != '0') {
                if (data[i].revenue > highestRevenueDay.revenue) {
                    highestRevenueDay = data[i];
                }
                if (data[i].revenue < lowestRevenueDay.revenue && data[i].revenue != '0') {
                    lowestRevenueDay = data[i];
                }
            }
        }

        document.getElementById('upDate').innerText = highestRevenueDay.day;
        document.getElementById('upDateRevenue').innerText = highestRevenueDay.revenue + ' ₺';
        document.getElementById('downDate').innerText = lowestRevenueDay.day;
        document.getElementById('downDateRevenue').innerText = lowestRevenueDay.revenue + ' ₺';
    }
</script>

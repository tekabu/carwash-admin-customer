@extends('base.base')

@section('header_title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Customers Card -->
    <div class="col-sm-6 col-xl-4">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ $customersCount }}</h4>
                    <span class="text-muted">Total Customers</span>
                </div>

                <div class="ms-3">
                    <i class="ph-user-list ph-3x text-primary opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Card -->
    <div class="col-sm-6 col-xl-4">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ $usersCount }}</h4>
                    <span class="text-muted">Total Users</span>
                </div>

                <div class="ms-3">
                    <i class="ph-users ph-3x text-success opacity-75"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Transactions Card -->
    <div class="col-sm-6 col-xl-4">
        <div class="card card-body">
            <div class="d-flex align-items-center">
                <div class="flex-fill">
                    <h4 class="mb-0">{{ $transactionsCount }}</h4>
                    <span class="text-muted">Total Transactions</span>
                </div>

                <div class="ms-3">
                    <i class="ph-receipt ph-3x text-info opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <!-- Monthly Transactions Bar Chart -->
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Monthly Transactions - {{ $currentYear }}</h5>
            </div>
            <div class="card-body">
                <div id="monthlyTransactionsChart" style="width: 100%; height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <!-- Package Type Demographics Pie Chart -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Package Type Demographics</h5>
            </div>
            <div class="card-body">
                <div id="packageTypeChart" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>

    <!-- Vehicle Type Demographics Pie Chart -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Vehicle Type Demographics</h5>
            </div>
            <div class="card-body">
                <div id="vehicleTypeChart" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>

    <!-- Guest vs Customer Pie Chart -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Guest vs Customer</h5>
            </div>
            <div class="card-body">
                <div id="guestCustomerChart" style="width: 100%; height: 350px;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('js/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('js/vendor/ui/fullcalendar/main.min.js') }}"></script>
	<script src="{{ asset('js/vendor/tables/datatables/datatables.min.js') }}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
	<script src="https://cdn.datatables.net/plug-ins/2.1.3/sorting/datetime-moment.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>

	<script type="text/javascript">
		$(() => {
			// Monthly Transactions Bar Chart
			const monthlyTransactionsChart = echarts.init(document.getElementById('monthlyTransactionsChart'));
			const monthlyOption = {
				tooltip: {
					trigger: 'axis',
					axisPointer: {
						type: 'shadow'
					}
				},
				grid: {
					left: '3%',
					right: '4%',
					bottom: '3%',
					containLabel: true
				},
				xAxis: {
					type: 'category',
					data: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					axisLabel: {
						interval: 0,
						rotate: 0
					}
				},
				yAxis: {
					type: 'value',
					name: 'Transactions',
					minInterval: 1
				},
				series: [{
					name: 'Transactions',
					type: 'bar',
					data: @json($monthlyData),
					itemStyle: {
						color: '#5470c6'
					},
					barMaxWidth: 50
				}]
			};
			monthlyTransactionsChart.setOption(monthlyOption);

			// Package Type Demographics Pie Chart
			const packageTypeChart = echarts.init(document.getElementById('packageTypeChart'));
			const packageTypeOption = {
				tooltip: {
					trigger: 'item',
					formatter: '{a} <br/>{b}: {c} ({d}%)'
				},
				legend: {
					orient: 'horizontal',
					bottom: 10,
					type: 'scroll'
				},
				series: [{
					name: 'Package Type',
					type: 'pie',
					radius: '60%',
					data: @json($packageTypeDemographics),
					emphasis: {
						itemStyle: {
							shadowBlur: 10,
							shadowOffsetX: 0,
							shadowColor: 'rgba(0, 0, 0, 0.5)'
						}
					},
					label: {
						formatter: '{b}: {c}'
					}
				}]
			};
			packageTypeChart.setOption(packageTypeOption);

			// Vehicle Type Demographics Pie Chart
			const vehicleTypeChart = echarts.init(document.getElementById('vehicleTypeChart'));
			const vehicleTypeOption = {
				tooltip: {
					trigger: 'item',
					formatter: '{a} <br/>{b}: {c} ({d}%)'
				},
				legend: {
					orient: 'horizontal',
					bottom: 10,
					type: 'scroll'
				},
				series: [{
					name: 'Vehicle Type',
					type: 'pie',
					radius: '60%',
					data: @json($vehicleTypeDemographics),
					emphasis: {
						itemStyle: {
							shadowBlur: 10,
							shadowOffsetX: 0,
							shadowColor: 'rgba(0, 0, 0, 0.5)'
						}
					},
					label: {
						formatter: '{b}: {c}'
					}
				}]
			};
			vehicleTypeChart.setOption(vehicleTypeOption);

			// Guest vs Customer Pie Chart
			const guestCustomerChart = echarts.init(document.getElementById('guestCustomerChart'));
			const guestCustomerOption = {
				tooltip: {
					trigger: 'item',
					formatter: '{a} <br/>{b}: {c} ({d}%)'
				},
				legend: {
					orient: 'horizontal',
					bottom: 10
				},
				series: [{
					name: 'Customer Type',
					type: 'pie',
					radius: '60%',
					data: @json($guestDemographics),
					emphasis: {
						itemStyle: {
							shadowBlur: 10,
							shadowOffsetX: 0,
							shadowColor: 'rgba(0, 0, 0, 0.5)'
						}
					},
					label: {
						formatter: '{b}: {c}'
					},
					color: ['#91cc75', '#fac858']
				}]
			};
			guestCustomerChart.setOption(guestCustomerOption);

			// Resize charts on window resize
			window.addEventListener('resize', function() {
				monthlyTransactionsChart.resize();
				packageTypeChart.resize();
				vehicleTypeChart.resize();
				guestCustomerChart.resize();
			});
		});
	</script>
@endsection
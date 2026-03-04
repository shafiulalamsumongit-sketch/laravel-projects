<x-layouts.admin>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <!-- Card 1 -->
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Customers</p>
        <h2 class="text-2xl font-bold mt-2">3,782</h2>
        <span class="text-green-500 text-sm">+11.01%</span>
    </div>

    <!-- Card 2 -->
    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-gray-500">Orders</p>
        <h2 class="text-2xl font-bold mt-2">5,359</h2>
        <span class="text-red-500 text-sm">-9.05%</span>
    </div>

    <!-- Target -->
    <div class="bg-white p-6 rounded-xl shadow text-center">
        <p class="text-gray-500">Monthly Target</p>
        <canvas id="targetChart"></canvas>
    </div>

</div>

<!-- Monthly Sales Chart -->
<div class="bg-white p-6 rounded-xl shadow mt-6">
    <h2 class="font-semibold mb-4">Monthly Sales</h2>
    <canvas id="salesChart"></canvas>
</div>

<script>
    new Chart(document.getElementById('salesChart'), {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Sales',
                data: [500,700,400,600,300,650,450,700,550,600,350,520],
                backgroundColor: '#6366f1'
            }]
        }
    });

    new Chart(document.getElementById('targetChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed','Remaining'],
            datasets: [{
                data: [75,25],
                backgroundColor: ['#6366f1','#e5e7eb']
            }]
        },
        options: {
            cutout: '80%'
        }
    });
</script>

</x-layouts.admin>


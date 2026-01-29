<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            مثال Chart.js
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded">
                <canvas id="myChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['جانفي', 'فيفري', 'مارس', 'أفريل'],
                datasets: [{
                    label: 'المبيعات',
                    data: [12, 19, 3, 8]
                }]
            }
        });
    });
    </script>
</x-app-layout>

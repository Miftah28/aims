<script>
    document.addEventListener("DOMContentLoaded", () => {
        var petugasData = {!! json_encode($petugas) !!};
        var petugas = petugasData.map(item => item.petugas);
        var count = petugasData.map(item => item.count);
        new ApexCharts(document.querySelector("#petugas-sampah"), {
            series: count,
            chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: true
            }
            },
            labels: petugas,
        }).render();
        });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var lokasisampahData = {!! json_encode($lokasisampah) !!};
        var tempat = lokasisampahData.map(item => item.tempat);
        var count = lokasisampahData.map(item => item.count);
        new ApexCharts(document.querySelector("#lokasi"), {
        series: [{
            name: "Sampah Masuk Perkilogram",
            data: count
        }],
        chart: {
            type: 'bar',
            height: 350
        },
        plotOptions: {
            bar: {
            borderRadius: 4,
            horizontal: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        xaxis: {
            categories: tempat,
        }
        }).render();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var sampahperbulanData = {!! json_encode($sampahperbulan) !!};
        new ApexCharts(document.querySelector("#lineChart"), {
        series: [{
            name: "Sampah Masuk Perkilogram",
            data: sampahperbulanData
        }],
        chart: {
            height: 350,
            type: 'line',
            zoom: {
            enabled: false
            }
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        grid: {
            row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
            },
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep','Oct','Nov','Dec'],
        }
        }).render();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        var sampahData = {!! json_encode($kategori) !!};
        var kategori = sampahData.map(item => item.kategori);
        var count = sampahData.map(item => item.count);
        new ApexCharts(document.querySelector("#pieChart"), {
        series: count,
        chart: {
            height: 350,
            type: 'pie',
            toolbar: {
            show: true
            }
        },
        labels: kategori
        }).render();
    });
</script>

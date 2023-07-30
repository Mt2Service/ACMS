<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
				<div class="card card-secondary">
					<div class="card-header pb-0">
						<h4 class="card-title"><i class="fa-solid fa-chart-simple"></i> Yang on server</h4><br>
						<h6 style="float:right;">
						</h6>
					</div>
					<div class="card-body">
						<canvas width="400px" height="170px" id="yang"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>

var myBarChart, MAX_DATA_SET_LENGTH = 5;

function reLoad() {
	$.post("<?=Theme::URL();?>?v=statistics&chart=yang", {
		name: name
	}, function(a) {
		var e = JSON.parse(a);
		adddata(e.online)
	})
}
var stepsizes = 50000000000000,
	canvas = document.getElementById("yang"),
	data = {
		datasets: [{
            label: "Yang on server",
            borderColor: "#EADDCA",
            backgroundColor: "#FFD700",
			fill: true,
            borderWidth: 3
        } ]
    },
    options = {
        scales: {
            yAxes: [{
                type: "linear",
                ticks: {
                    stepSize: stepsizes,
                    suggestedMax: stepsizes + 40,
					 callback: function(value, index, values) {
						if (value >= 1000000000000) {
							return (value / 1000000000000).toFixed(1) + 'kkkk';
						}
						else if (value >= 1000000000) {
							return (value / 1000000000).toFixed(1) + 'kkk';
						} else if (value >= 1000000) {
							return (value / 1000000).toFixed(1) + 'kk';
						} else if (value >= 1000) {
							return (value / 1000).toFixed(1) + 'k';
						} else {
							return value;
						}
					}
                }
            }]
        },
        showLines: !0
    },
    onlineplayers = new Chart.Line(canvas, {
        data: data,
		labels: data,
        options: options
    });

function adddata(a = NaN, r = "") {
    var s = onlineplayers.data.datasets,
        d = onlineplayers.data.labels,
        n = s[0].data,
        i = n.length,
        p = !1;
    i > MAX_DATA_SET_LENGTH && (n.shift(), p = !0), p && (d.shift()), n.push(a), d.push(r), onlineplayers.update()
}
setInterval(reLoad, 3000);



</script>

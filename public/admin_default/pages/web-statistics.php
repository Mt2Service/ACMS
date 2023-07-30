<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
	<div class="container-fluid py-4">
		<div class="row">
			<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
				<div class="card card-secondary">
					<div class="card-header pb-0">
						<h4 class="card-title"><i class="fa-solid fa-chart-simple"></i> &nbsp;Website live users</h4><br>
						<h6 style="float:right;">
						</h6>
					</div>
					<div class="card-body">
						<canvas width="400px" height="170px" id="onlineusers"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 mb-md-0 mb-4">
				<div class="card card-secondary">
					<div class="card-body">
						<div class="row">
							<div class="col-lg-3 col-6">
								<div class="small-box bg-danger">
									<div class="inner">
										<h3 id="uniquevisits"><img style="height:40px;" src="https://i.gifer.com/origin/34/34338d26023e5515f6cc8969aa027bca_w200.gif"></h3>
										<p>Unique Visits</p>
									</div>
									<div class="icon">
										<i class="fa fa-user"></i>
									</div>
								</div>
							</div>
							
							<div class="col-lg-3 col-6">
								<div class="small-box bg-info">
									<div class="inner">
										<h3 id="totalvisits"><img style="height:40px;" src="https://i.gifer.com/origin/34/34338d26023e5515f6cc8969aa027bca_w200.gif"></h3>
										<p>Total Visits</p>
									</div>
									<div class="icon">
										<i class="fa fa-users"></i>
									</div>
								</div>
							</div>
							
							<div class="col-lg-3 col-6">
								<div class="small-box bg-warning">
									<div class="inner">
										<h3 id="sumofdown"><img style="height:40px;" src="https://i.gifer.com/origin/34/34338d26023e5515f6cc8969aa027bca_w200.gif"></h3>
										<p>Total Downloads</p>
									</div>
									<div class="icon">
										<i class="fa fa-download"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="card card-secondary">
					<div class="card-body">
						<div class="row">
							<div id="weblivedetails" style="width:100%;"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>

var myBarChart, MAX_DATA_SET_LENGTH = 5;

function totalvisits() {
	$.post("<?=Theme::URL();?>?v=statistics&chart=totalvisits", function(a) {
		var e = JSON.parse(a);
		document.getElementById("totalvisits").innerHTML = e.online;
	})
}

function weblivedetails() {
	$.post("<?=Theme::URL();?>?v=statistics&chart=weblivedetails", function(a) {
		document.getElementById("weblivedetails").innerHTML = a;
	})
}

function sumofdown() {
	$.post("<?=Theme::URL();?>?v=statistics&chart=sumofdown", function(a) {
		var e = JSON.parse(a);
		document.getElementById("sumofdown").innerHTML = e.online;
	})
}
setInterval(sumofdown, 3000);
setInterval(totalvisits, 3000);
setInterval(weblivedetails, 3000);
function reLoad() {
	$.post("<?=Theme::URL();?>?v=statistics&chart=weblive", {
		name: name
	}, function(a) {
		var e = JSON.parse(a);
		document.getElementById("uniquevisits").innerHTML = e.online;
		adddata(e.online)
	})
}
var stepsizes = 0,
	canvas = document.getElementById("onlineusers"),
	data = {
		datasets: [{
            label: "Unique Visitors",
            borderColor: "#D11621",
            backgroundColor: "#C91D07",
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
                    suggestedMax: stepsizes + 40
				
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

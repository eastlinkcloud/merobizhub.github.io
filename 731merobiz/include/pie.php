<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

<style>
.pie-legend {
  list-style: none;
  margin: 0;
  padding: 0;
}

.pie-legend span {
  display: inline-block;
  width: 14px;
  height: 14px;
  border-radius: 100%;
  margin-right: 16px;
  margin-bottom: -2px;
}

.pie-legend li {
  margin-bottom: 10px;
}
</style>

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.1/Chart.min.js"></script>

<div class="container">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md-12 mb-3">
          <canvas id="property_types" class="pie"></canvas>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
// global options variable
var options = {
  responsive: true,
  easing: 'easeInExpo',
  scaleBeginAtZero: true,
  // you don't have to define this here, it exists inside the global defaults
  legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
}

// PIE
// PROPERTY TYPE DISTRIBUTION
// context
var ctxPTD = $("#property_types").get(0).getContext("2d");
// data
var dataPTD = [
  {
    label: "Total AreaManager",
    color: "#5093ce",
    highlight: "#78acd9",
    value: 10
  },
  {
    label: "Total SalesManager",
    color: "#c7ccd1",
    highlight: "#e3e6e8",
    value: 12
  },
  {
    label: "Total Customers",
    color: "#7fc77f",
    highlight: "#a3d7a3",
    value: 40
  },
  {
    label: "Customer Of AreaManager",
    color: "#fab657",
    highlight: "blue",
    value: 24
  },
]

// Property Type Distribution
var propertyTypes = new Chart(ctxPTD).Pie(dataPTD, options);
// pie chart legend
$("#pie_legend").html(propertyTypes.generateLegend());
</script>

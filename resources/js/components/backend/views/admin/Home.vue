<template>
  <div class="fade-in">
    <div class="row">
      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-primary">
          <div
            class="card-body card-body pb-0 d-flex justify-content-between align-items-start"
          >
            <div>
              <div class="text-value-lg">9.823</div>
              <div>Members online</div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
            <canvas class="chart" id="card-chart1" height="70"></canvas>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-info">
          <div
            class="card-body card-body pb-0 d-flex justify-content-between align-items-start"
          >
            <div>
              <div class="text-value-lg">9.823</div>
              <div>Members online</div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
            <canvas class="chart" id="card-chart2" height="70"></canvas>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-warning">
          <div
            class="card-body card-body pb-0 d-flex justify-content-between align-items-start"
          >
            <div>
              <div class="text-value-lg">9.823</div>
              <div>Members online</div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3" style="height: 70px">
            <canvas class="chart" id="card-chart3" height="70"></canvas>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-3">
        <div class="card text-white bg-danger">
          <div
            class="card-body card-body pb-0 d-flex justify-content-between align-items-start"
          >
            <div>
              <div class="text-value-lg">9.823</div>
              <div>Members online</div>
            </div>
          </div>
          <div class="c-chart-wrapper mt-3 mx-3" style="height: 70px">
            <canvas class="chart" id="card-chart4" height="70"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Traffic &amp; Sales</div>
          <div class="card-body">This is the admin dashboard</div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Home",
};
</script>

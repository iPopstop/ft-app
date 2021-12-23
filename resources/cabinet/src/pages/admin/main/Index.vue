<script>
import {mapState} from 'vuex'

export default {
  name: 'Main',
  metaInfo: {
    title: 'Main'
  },
  data: () => ({}),
  computed: {
    ...mapState('admin', ['dashboard'])
  },
  methods: {
    loadStats() {
      this.$store.dispatch('admin/dashboard', this.search)
    },
  },
  mounted() {
    this.loadStats()
  }
}
</script>
<template>
  <div>
    <div class="title d-flex mb-4 align-items-center justify-content-between">
      <div class="page-header w-100 d-md-flex justify-content-between">
        <div>
          <h3>Статистика</h3>
          <p class="text-muted">На этой странице вы можете ознакомится с интересующими вас параметрами
          </p>
        </div>
        <div class="mt-3 mt-md-0">
          <div id="dashboard-daterangepicker" class="btn btn-outline-light">
            <span>11.12.2021 - 12.12.2021</span>
          </div>
          <a href="#" class="btn btn-primary ml-0 ml-md-2 mt-2 mt-md-0 dropdown-toggle" data-toggle="dropdown" style="
    background: #f6c942;
    color: #000 !IMPORTANT;
">Экспорт</a>
          <div class="dropdown-menu dropdown-menu-right">
            <a href="#" class="dropdown-item">Download</a>
            <a href="#" class="dropdown-item">Print</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body" style="position: relative;">
            <div class="d-flex justify-content-between">
              <h6 class="card-title mb-2">Средние чаевые за месяц</h6>
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-floating">
                  <i class="ti-reload"></i>
                </a>
                <div class="dropdown">
                  <a href="#" data-toggle="dropdown" class="btn btn-floating" aria-haspopup="true"
                     aria-expanded="false">
                    <i class="ti-more-alt"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" x-placement="bottom-end"
                       style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-149px, 35px, 0px);">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </div>
            </div>
            <p class="text-muted mb-4">Средняя арифметическая в рублях</p>
            <div id="sales" style="min-height: 280px;">
              <div id="apexchartshyol7wybj" class="apexcharts-canvas apexchartshyol7wybj light"
                   style="width: 608.94px; height: 265px;">
                <svg id="SvgjsSvg8207" width="608.94" height="265" xmlns="http://www.w3.org/2000/svg" version="1.1"
                     xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"
                     class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(-26, 0)"
                     style="background: transparent;">
                  <g id="SvgjsG8209" class="apexcharts-inner apexcharts-graphical" transform="translate(49.984375, 30)">
                    <defs id="SvgjsDefs8208">
                      <linearGradient id="SvgjsLinearGradient8212" x1="0" y1="0" x2="0" y2="1">
                        <stop id="SvgjsStop8213" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)"
                              offset="0"></stop>
                        <stop id="SvgjsStop8214" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                              offset="1"></stop>
                        <stop id="SvgjsStop8215" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)"
                              offset="1"></stop>
                      </linearGradient>
                      <clipPath id="gridRectMaskhyol7wybj">
                        <rect id="SvgjsRect8217" width="548.955625" height="191.539" x="0" y="0" rx="0" ry="0"
                              fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                      </clipPath>
                      <clipPath id="gridRectMarkerMaskhyol7wybj">
                        <rect id="SvgjsRect8218" width="550.955625" height="193.539" x="-1" y="-1" rx="0" ry="0"
                              fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                      </clipPath>
                    </defs>
                    <rect id="SvgjsRect8216" width="12.19901388888889" height="191.539" x="207.00492617458767" y="0"
                          rx="0" ry="0" fill="url(#SvgjsLinearGradient8212)" opacity="1" stroke-width="0"
                          stroke-dasharray="3" class="apexcharts-xcrosshairs" y2="191.539" filter="none"
                          fill-opacity="0.9" x1="207.00492617458767" x2="207.00492617458767"></rect>
                    <g id="SvgjsG8232" class="apexcharts-xaxis" transform="translate(0, 0)">
                      <g id="SvgjsG8233" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)">
                        <text id="SvgjsText8234" font-family="Inter" x="27.447781250000002" y="220.539"
                              text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f"
                              class="apexcharts-xaxis-label " style="font-family: Inter;">
                          <tspan id="SvgjsTspan8235" style="font-family: Inter;">Jan</tspan>
                          <title>Jan</title></text>
                        <text id="SvgjsText8236" font-family="Inter" x="82.34334375" y="220.539" text-anchor="middle"
                              dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label "
                              style="font-family: Inter;">
                          <tspan id="SvgjsTspan8237" style="font-family: Inter;">Feb</tspan>
                          <title>Feb</title></text>
                        <text id="SvgjsText8238" font-family="Inter" x="137.23890625" y="220.539" text-anchor="middle"
                              dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label "
                              style="font-family: Inter;">
                          <tspan id="SvgjsTspan8239" style="font-family: Inter;">Mar</tspan>
                          <title>Mar</title></text>
                        <text id="SvgjsText8240" font-family="Inter" x="192.13446875000002" y="220.539"
                              text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f"
                              class="apexcharts-xaxis-label " style="font-family: Inter;">
                          <tspan id="SvgjsTspan8241" style="font-family: Inter;">Apr</tspan>
                          <title>Apr</title></text>
                        <text id="SvgjsText8242" font-family="Inter" x="247.03003125000004" y="220.539"
                              text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f"
                              class="apexcharts-xaxis-label " style="font-family: Inter;">
                          <tspan id="SvgjsTspan8243" style="font-family: Inter;">May</tspan>
                          <title>May</title></text>
                        <text id="SvgjsText8244" font-family="Inter" x="301.92559375" y="220.539" text-anchor="middle"
                              dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label "
                              style="font-family: Inter;">
                          <tspan id="SvgjsTspan8245" style="font-family: Inter;">Jun</tspan>
                          <title>Jun</title></text>
                        <text id="SvgjsText8246" font-family="Inter" x="356.82115625" y="220.539" text-anchor="middle"
                              dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label "
                              style="font-family: Inter;">
                          <tspan id="SvgjsTspan8247" style="font-family: Inter;">Jul</tspan>
                          <title>Jul</title></text>
                        <text id="SvgjsText8248" font-family="Inter" x="411.71671875" y="220.539" text-anchor="middle"
                              dominant-baseline="auto" font-size="12px" fill="#373d3f" class="apexcharts-xaxis-label "
                              style="font-family: Inter;">
                          <tspan id="SvgjsTspan8249" style="font-family: Inter;">Aug</tspan>
                          <title>Aug</title></text>
                        <text id="SvgjsText8250" font-family="Inter" x="466.61228124999997" y="220.539"
                              text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f"
                              class="apexcharts-xaxis-label " style="font-family: Inter;">
                          <tspan id="SvgjsTspan8251" style="font-family: Inter;">Sep</tspan>
                          <title>Sep</title></text>
                        <text id="SvgjsText8252" font-family="Inter" x="521.5078437499999" y="220.539"
                              text-anchor="middle" dominant-baseline="auto" font-size="12px" fill="#373d3f"
                              class="apexcharts-xaxis-label " style="font-family: Inter;">
                          <tspan id="SvgjsTspan8253" style="font-family: Inter;">Oct</tspan>
                          <title>Oct</title></text>
                      </g>
                      <line id="SvgjsLine8254" x1="0" y1="192.539" x2="548.955625" y2="192.539" stroke="#78909c"
                            stroke-dasharray="0" stroke-width="1"></line>
                    </g>
                    <g id="SvgjsG8265" class="apexcharts-grid">
                      <g id="SvgjsG8266" class="apexcharts-gridlines-horizontal">
                        <line id="SvgjsLine8277" x1="0" y1="0" x2="548.955625" y2="0" stroke="#e0e0e0"
                              stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8278" x1="0" y1="27.362714285714283" x2="548.955625" y2="27.362714285714283"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8279" x1="0" y1="54.725428571428566" x2="548.955625" y2="54.725428571428566"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8280" x1="0" y1="82.08814285714286" x2="548.955625" y2="82.08814285714286"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8281" x1="0" y1="109.45085714285713" x2="548.955625" y2="109.45085714285713"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8282" x1="0" y1="136.8135714285714" x2="548.955625" y2="136.8135714285714"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8283" x1="0" y1="164.17628571428568" x2="548.955625" y2="164.17628571428568"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                        <line id="SvgjsLine8284" x1="0" y1="191.53899999999996" x2="548.955625" y2="191.53899999999996"
                              stroke="#e0e0e0" stroke-dasharray="0" class="apexcharts-gridline"></line>
                      </g>
                      <g id="SvgjsG8267" class="apexcharts-gridlines-vertical"></g>
                      <line id="SvgjsLine8268" x1="54.895562500000004" y1="192.539" x2="54.895562500000004" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8269" x1="109.79112500000001" y1="192.539" x2="109.79112500000001" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8270" x1="164.6866875" y1="192.539" x2="164.6866875" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8271" x1="219.58225000000002" y1="192.539" x2="219.58225000000002" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8272" x1="274.4778125" y1="192.539" x2="274.4778125" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8273" x1="329.373375" y1="192.539" x2="329.373375" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8274" x1="384.2689375" y1="192.539" x2="384.2689375" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8275" x1="439.1645" y1="192.539" x2="439.1645" y2="198.539" stroke="#78909c"
                            stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8276" x1="494.06006249999996" y1="192.539" x2="494.06006249999996" y2="198.539"
                            stroke="#78909c" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line>
                      <line id="SvgjsLine8286" x1="0" y1="191.539" x2="548.955625" y2="191.539" stroke="transparent"
                            stroke-dasharray="0"></line>
                      <line id="SvgjsLine8285" x1="0" y1="1" x2="0" y2="191.539" stroke="transparent"
                            stroke-dasharray="0"></line>
                    </g>
                    <g id="SvgjsG8220" class="apexcharts-bar-series apexcharts-plot-series">
                      <g id="SvgjsG8221" class="apexcharts-series" rel="1" seriesName="NetxProfit" data:realIndex="0">
                        <path id="apexcharts-bar-area-0"
                              d="M 24.39802777777778 191.539L 24.39802777777778 30.412467757936497Q 30.497534722222227 24.31296081349205 36.59704166666667 30.412467757936497L 36.59704166666667 191.539L 24.39802777777778 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 24.39802777777778 191.539L 24.39802777777778 30.412467757936497Q 30.497534722222227 24.31296081349205 36.59704166666667 30.412467757936497L 36.59704166666667 191.539L 24.39802777777778 191.539"
                              pathFrom="M 24.39802777777778 191.539L 24.39802777777778 191.539L 36.59704166666667 191.539L 36.59704166666667 191.539L 24.39802777777778 191.539"
                              cy="27.362714285714276" cx="85.39309722222224" j="0" val="60"
                              barHeight="164.1762857142857" barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 85.39309722222224 191.539L 85.39309722222224 44.093824900793635Q 91.49260416666668 37.99431795634919 97.59211111111112 44.093824900793635L 97.59211111111112 191.539L 85.39309722222224 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 85.39309722222224 191.539L 85.39309722222224 44.093824900793635Q 91.49260416666668 37.99431795634919 97.59211111111112 44.093824900793635L 97.59211111111112 191.539L 85.39309722222224 191.539"
                              pathFrom="M 85.39309722222224 191.539L 85.39309722222224 191.539L 97.59211111111112 191.539L 97.59211111111112 191.539L 85.39309722222224 191.539"
                              cy="41.044071428571414" cx="146.38816666666668" j="1" val="55"
                              barHeight="150.49492857142857" barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 146.38816666666668 191.539L 146.38816666666668 38.62128204365078Q 152.48767361111112 32.52177509920634 158.58718055555556 38.62128204365078L 158.58718055555556 191.539L 146.38816666666668 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 146.38816666666668 191.539L 146.38816666666668 38.62128204365078Q 152.48767361111112 32.52177509920634 158.58718055555556 38.62128204365078L 158.58718055555556 191.539L 146.38816666666668 191.539"
                              pathFrom="M 146.38816666666668 191.539L 146.38816666666668 191.539L 158.58718055555556 191.539L 158.58718055555556 191.539L 146.38816666666668 191.539"
                              cy="35.57152857142856" cx="207.38323611111113" j="2" val="57"
                              barHeight="155.96747142857143" barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 207.38323611111113 191.539L 207.38323611111113 41.35755347222221Q 213.48274305555557 35.258046527777765 219.58225000000002 41.35755347222221L 219.58225000000002 191.539L 207.38323611111113 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 207.38323611111113 191.539L 207.38323611111113 41.35755347222221Q 213.48274305555557 35.258046527777765 219.58225000000002 41.35755347222221L 219.58225000000002 191.539L 207.38323611111113 191.539"
                              pathFrom="M 207.38323611111113 191.539L 207.38323611111113 191.539L 219.58225000000002 191.539L 219.58225000000002 191.539L 207.38323611111113 191.539"
                              cy="38.307799999999986" cx="268.3783055555556" j="3" val="56" barHeight="153.2312"
                              barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 268.3783055555556 191.539L 268.3783055555556 27.67619632936507Q 274.4778125 21.576689384920623 280.57731944444447 27.67619632936507L 280.57731944444447 191.539L 268.3783055555556 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 268.3783055555556 191.539L 268.3783055555556 27.67619632936507Q 274.4778125 21.576689384920623 280.57731944444447 27.67619632936507L 280.57731944444447 191.539L 268.3783055555556 191.539"
                              pathFrom="M 268.3783055555556 191.539L 268.3783055555556 191.539L 280.57731944444447 191.539L 280.57731944444447 191.539L 268.3783055555556 191.539"
                              cy="24.626442857142848" cx="329.373375" j="4" val="61" barHeight="166.91255714285714"
                              barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 329.373375 191.539L 329.373375 35.88501061507935Q 335.47288194444445 29.785503670634906 341.5723888888889 35.88501061507935L 341.5723888888889 191.539L 329.373375 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 329.373375 191.539L 329.373375 35.88501061507935Q 335.47288194444445 29.785503670634906 341.5723888888889 35.88501061507935L 341.5723888888889 191.539L 329.373375 191.539"
                              pathFrom="M 329.373375 191.539L 329.373375 191.539L 341.5723888888889 191.539L 341.5723888888889 191.539L 329.373375 191.539"
                              cy="32.83525714285713" cx="390.36844444444444" j="5" val="58"
                              barHeight="158.70374285714286" barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 390.36844444444444 191.539L 390.36844444444444 22.203653472222214Q 396.4679513888889 16.10414652777777 402.5674583333333 22.203653472222214L 402.5674583333333 191.539L 390.36844444444444 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 390.36844444444444 191.539L 390.36844444444444 22.203653472222214Q 396.4679513888889 16.10414652777777 402.5674583333333 22.203653472222214L 402.5674583333333 191.539L 390.36844444444444 191.539"
                              pathFrom="M 390.36844444444444 191.539L 390.36844444444444 191.539L 402.5674583333333 191.539L 402.5674583333333 191.539L 390.36844444444444 191.539"
                              cy="19.153899999999993" cx="451.36351388888886" j="6" val="63" barHeight="172.3851"
                              barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 451.36351388888886 191.539L 451.36351388888886 30.412467757936497Q 457.4630208333333 24.31296081349205 463.56252777777775 30.412467757936497L 463.56252777777775 191.539L 451.36351388888886 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 451.36351388888886 191.539L 451.36351388888886 30.412467757936497Q 457.4630208333333 24.31296081349205 463.56252777777775 30.412467757936497L 463.56252777777775 191.539L 451.36351388888886 191.539"
                              pathFrom="M 451.36351388888886 191.539L 451.36351388888886 191.539L 463.56252777777775 191.539L 463.56252777777775 191.539L 451.36351388888886 191.539"
                              cy="27.362714285714276" cx="512.3585833333333" j="7" val="60"
                              barHeight="164.1762857142857" barWidth="12.19901388888889"></path>
                        <path id="apexcharts-bar-area-0"
                              d="M 512.3585833333333 191.539L 512.3585833333333 13.994839186507933Q 518.4580902777777 7.895332242063488 524.5575972222222 13.994839186507933L 524.5575972222222 191.539L 512.3585833333333 191.539"
                              fill="rgba(80,102,225,0.85)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt"
                              stroke-width="0" stroke-dasharray="0" class="apexcharts-bar-area" index="0"
                              clip-path="url(#gridRectMaskhyol7wybj)"
                              pathTo="M 512.3585833333333 191.539L 512.3585833333333 13.994839186507933Q 518.4580902777777 7.895332242063488 524.5575972222222 13.994839186507933L 524.5575972222222 191.539L 512.3585833333333 191.539"
                              pathFrom="M 512.3585833333333 191.539L 512.3585833333333 191.539L 524.5575972222222 191.539L 524.5575972222222 191.539L 512.3585833333333 191.539"
                              cy="10.94508571428571" cx="573.3536527777777" j="8" val="66"
                              barHeight="180.59391428571428" barWidth="12.19901388888889"></path>
                        <g id="SvgjsG8222" class="apexcharts-datalabels"></g>
                      </g>
                    </g>
                    <line id="SvgjsLine8287" x1="0" y1="0" x2="548.955625" y2="0" stroke="#b6b6b6" stroke-dasharray="0"
                          stroke-width="1" class="apexcharts-ycrosshairs"></line>
                    <line id="SvgjsLine8288" x1="0" y1="0" x2="548.955625" y2="0" stroke-dasharray="0" stroke-width="0"
                          class="apexcharts-ycrosshairs-hidden"></line>
                    <g id="SvgjsG8289" class="apexcharts-yaxis-annotations"></g>
                    <g id="SvgjsG8290" class="apexcharts-xaxis-annotations"></g>
                    <g id="SvgjsG8291" class="apexcharts-point-annotations"></g>
                  </g>
                  <g id="SvgjsG8255" class="apexcharts-yaxis" rel="0" transform="translate(16.984375, 0)">
                    <g id="SvgjsG8256" class="apexcharts-yaxis-texts-g">
                      <text id="SvgjsText8257" font-family="Inter" x="20" y="31.7" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">70
                      </text>
                      <text id="SvgjsText8258" font-family="Inter" x="20" y="59.16271428571429" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">60
                      </text>
                      <text id="SvgjsText8259" font-family="Inter" x="20" y="86.62542857142857" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">50
                      </text>
                      <text id="SvgjsText8260" font-family="Inter" x="20" y="114.08814285714286" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">40
                      </text>
                      <text id="SvgjsText8261" font-family="Inter" x="20" y="141.55085714285713" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">30
                      </text>
                      <text id="SvgjsText8262" font-family="Inter" x="20" y="169.01357142857142" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">20
                      </text>
                      <text id="SvgjsText8263" font-family="Inter" x="20" y="196.47628571428572" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">10
                      </text>
                      <text id="SvgjsText8264" font-family="Inter" x="20" y="223.93900000000002" text-anchor="end"
                            dominant-baseline="auto" font-size="11px" fill="#373d3f" class="apexcharts-yaxis-label "
                            style="font-family: Inter;">0
                      </text>
                    </g>
                  </g>
                </svg>
                <div class="apexcharts-legend"></div>
                <div class="apexcharts-tooltip light" style="left: 263.089px; top: 33px;">
                  <div class="apexcharts-tooltip-title" style="font-family: Inter; font-size: 12px;">Apr</div>
                  <div class="apexcharts-tooltip-series-group active" style="display: flex;"><span
                    class="apexcharts-tooltip-marker" style="background-color: rgb(80, 102, 225);"></span>
                    <div class="apexcharts-tooltip-text" style="font-family: Inter; font-size: 12px;">

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center mt-3">
              <a href="#" class="btn btn-primary">
                <i class="ti-download mr-2"></i>Скачать</a>
            </div>
            <div class="resize-triggers">
              <div class="expand-trigger">
                <div style="width: 646px; height: 464px;"></div>
              </div>
              <div class="contract-trigger"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Чаевые</h6>
                <div class="d-flex align-items-center mb-3">
                  <div>
                    <div class="avatar">
                      <span class="avatar-title bg-primary-bright text-primary rounded-pill">
                          <i class="ti-cloud"></i>
                      </span>
                    </div>
                  </div>
                  <div class="font-weight-bold ml-1 font-size-30 ml-3">{{ dashboard.tips_avg }} руб.</div>
                </div>
                <p class="mb-0"><a href="#" class="link-1">Средняя сумма </a>чаевых за указанную дату</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Бонусы</h6>
                <div class="d-flex align-items-center mb-3">
                  <div>
                    <div class="avatar">
                                        <span class="avatar-title bg-info-bright text-info rounded-pill">
                                            <i class="ti-map"></i>
                                        </span>
                    </div>
                  </div>
                  <div class="font-weight-bold ml-1 font-size-30 ml-3">
                    {{ dashboard.bonuses_percent }}
                  </div>
                </div>
                <p class="mb-0"><a class="link-1" href="#">Какой процент</a> посетителей участвует в бонусных акциях</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Активные рефералы</h6>
                <div class="d-flex align-items-center mb-3">
                  <div>
                    <div class="avatar">
                                        <span class="avatar-title bg-secondary-bright text-secondary rounded-pill">
                                            <i class="ti-email"></i>
                                        </span>
                    </div>
                  </div>
                  <div class="font-weight-bold ml-1 font-size-30 ml-3">12.87%</div>
                </div>
                <p class="mb-0"><a class="link-1" href="#">Средний процент </a>активных рефералов за месяц</p>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-body">
                <h6 class="card-title">Положительные отзывы</h6>
                <div class="d-flex align-items-center mb-3">
                  <div>
                    <div class="avatar">
                                        <span class="avatar-title bg-warning-bright text-warning rounded-pill">
                                            <i class="ti-dashboard"></i>
                                        </span>
                    </div>
                  </div>
                  <div class="font-weight-bold ml-1 font-size-30 ml-3">
                    {{ dashboard.plus_percent }}%
                  </div>
                </div>
                <p class="mb-0"><a class="link-1" href="#">Общий процент </a>соотношения положительных отзывов</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
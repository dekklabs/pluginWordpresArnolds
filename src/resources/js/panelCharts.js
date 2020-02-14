var __log = console.log;
var __id  = document.getElementById.bind(document);
// const URL_URI_SITE = "http://burguer.diaeconomico.com";
const URL_URI_SITE = "https://arnoldsburger.dev";

class panelCharts {

    init() {
        this.getDatosFecha()
        this.showLoading()
        this.getDatosMotivos()
    }

    async getDatosFecha() {
        let url = `${URL_URI_SITE}/wp-json/burguer/v1/cantidad-mes`
        let res = await fetch(url)
        let data = await res.json()

        this.showTemplateChart(data)
        this.hideClassFlex()
    }

    hideClassFlex() {
      let template = __id("charTemplate");
      if( template.classList == 'loadingShow' ) {
        template.classList.remove("loadingShow")
      }
    }
    
    showTemplateChart(data) {
      let chart = __id("charTemplate");
      chart.innerHTML = `
        <div class="chart-container" style="position: relative;margin: auto;height: 40vh;">
            <canvas id="myChart"></canvas>
        </div>
      `
      this.chartTrafico(data)
    }

    getFullYear() {
      let dateNow = new Date()
      let year = dateNow.getFullYear()

      return year;
    }

    chartTrafico(fechaCount) {
        let __self = this

        var data = {
          labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
          datasets: [{
            label: `Meses del año ${__self.getFullYear()}`,
            backgroundColor: "#62be256c",
            borderColor: "#05610d",
            borderWidth: 2,
            hoverBackgroundColor: "#2b4e146c",
            hoverBorderColor: "#083a0c",
            data: fechaCount,
          }]
        };
        
        var options = {
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              stacked: true,
              gridLines: {
                display: true,
                color: "rgba(255,99,132,0.2)"
              }
            }],
            xAxes: [{
              gridLines: {
                display: false
              }
            }]
          }
        };
        
        Chart.Bar('myChart', {
          options: options,
          data: data
        });
    }

    showLoading() {
      let contenedor = __id("loadingChart")
      contenedor.innerHTML = `
        <div class="text-center">
          <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
      `
    }

    /* Doughtnout */
    async getDatosMotivos() {
      let url = `${URL_URI_SITE}/wp-json/burguer/v1/cantidad-motivo`
      let res = await fetch(url)
      let data = await res.json()

      this.chartDoughtnout(data);
    }
    chartDoughtnout(motivos) {
      let ctx = __id("motivoChartDoughnut");

      var data = {
          labels: [
              "Cumpleaños",
              "Aniversario",
              "BabyShower",
              "Matine",
              "15 Años",
              "18 Años",
              "50 Años",
          ],
          datasets: [
              {
                  // data: [300, 50, 100, 100, 300, 50, 100],
                  data: motivos,
                  backgroundColor: [
                      "#FF6384",
                      "#36A2EB",
                      "#FFCE56",
                      "#8add64",
                      "#9d58c5",
                      "#da623e",
                      "#e62e2e"
                  ],
                  hoverBackgroundColor: [
                      "#ff6385c4",
                      "#36a3ebc2",
                      "#ffcf56c0",
                      "#8add64b7",
                      "#9d58c5a6",
                      "#da623ec2",
                      "#e62e2ecb"
                  ]
                  
                  
              }]
      };

      var options = { 
        cutoutPercentage:40,
        animation: {
        duration: 0
        }
      };

      var myDoughnutChart = new Chart(ctx, {
          type: 'doughnut',
          data: data,
          options: options
      });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    let charts = new panelCharts();
    charts.init();
})